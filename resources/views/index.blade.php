  
<style>
  body {
      background-color: rgb(29, 7, 130);
  }

  .todolist {
      margin: 10% 21%;
      height: auto;
      background-color: white;
      background-size: cover;
      border-radius: 10px; 
      padding: 20px;   
  }        

  .title-container{
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .title-container-login{
    display: flex;
    padding:0 2px;
  }

  .find {
    margin: 5px 0;
    padding: 5px;
    background: white;
    border-radius: 5px;  
    border-color:#adff2f;
  }

  a{
  text-decoration: none;
  color: #adff2f;
  }

  .add-task{
  display: flex;
  align-items: center;
  }

  .text-add{
      border-radius: 5px;  
      border-color: lightgray;
      height: 40px;
      width:80%;
  }

  .text-edit{
      padding:6px 0;
      border-radius: 5px;  
      border-color: lightgray;
      height: 30px;
      width: 100%;
  }

  table {
    border-collapse: separate;
    border-spacing: 8px 10px;
    text-align: center;
    width:100%;
    justify-content: space-between;
  }  

  .tag{
    padding:5px 2px;
  }

  .tag_id{
    font-size:15px;
    padding:7px 2px;
  }

  .btn {
      display: inline-block;
      padding: 0.3em 1em;
      text-decoration: none;
      border-radius: 4px;
      transition: .4s;
      background: white;   
      font-weight:bold;
  }
  .btn-lgt{
      color: red;
  }
  .btn-lgt:hover {
      background: red;
      color: white;
  }

  .btn-add {
      color: mediumorchid;
      border: solid 2.5px mediumorchid;
  }
  .btn-add:hover {
      background: mediumorchid;
      color: white;
}

  .btn-edit{
      color: darkorange;
      border: solid 2.5px darkorange;
      writing-mode: vertical-rl;
  }
  .btn-edit:hover {
      background: darkorange;
      color: white;
}
  .btn-delete{
      color: aquamarine;
      border: solid 2.5px aquamarine;
      writing-mode: vertical-rl;
  }
  .btn-delete:hover {
      background: aquamarine;
      color: white;
}


</style>

<div class="todolist">
  <div class="title-container">
    <div class="title-container-ttl">
      <h2>Todo List</h2>
    </div>
    <div class="title-container-login">
      @if (Auth::check())
      <p>「{{$user->name .'」でログイン中' .  ''}}</p><button class="btn btn-lgt">ログアウト</button><br>    
      @else
      <p>ログインしてください。（<a href="/login">ログイン</a>｜
        <a href="/register">登録</a>）</p>
      @endif  
    </div>
  </div>
    <button class="find">
      <a href="/find">タスク検索</a>
    </button>
    <form action="/add" method="post">
      @csrf
      @if ($errors->has('name'))
        <tr>
          <th>ERROR</th>
          <td>
            {{$errors->first('task')}}
          </td>
        </tr>
      @endif  
      <div class="add-task">
        <input type="text" class="text-add" name="task" required minlength="1" maxlength="20" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <div class="tag">
            <select class="tag_id" name="tag_id">
              @foreach($tags as $tag)
                <option value="{{$tag->id}}">{{$tag->tag}}</option>
              @endforeach  
            </select>
          </div>
        <button type="submit" class="btn btn-add">
          追加
        </button>
      </div>
    </form>

  <table>   
    <tr>
      <div class="table-th">
        <th>作成日</th>
        <th>タスク名</th>
        <th>タグ</th>
        <th>更新</th>
        <th>削除</th>
      </div>     
    </tr>
  <ul>
    <div class="table-td">
      @foreach ($todos as $todo)  
      <tr>  
        <td>
          @if($todo->created_at === $todo->updated_at)
            {{$todo->created_at}}
          @else 
            {{$todo->updated_at}} 
          @endif
        </td>    
      <form action="/edit" method="POST">
        @csrf   
        <td>
          <input type="text" class=text-edit name="task" value=" {{$todo->task}}" size="20">                   
          <input type="hidden" name="id" value="{{$todo->id}}">  
        </td>          
        <td>
          <div class="tag-btn">
            <select>
              <option>{{$todo->tag->getTag()}}</option>
            </select>
          </div>
        </td> 
        <td>
          <button type="submit" class="btn btn-edit">
            更新
          </button> 
        </td> 
      </form>    
      <form action="/delete" method="POST">
        @csrf          
          <td>          
            <input type="hidden" name="id" value="{{$todo->id}}">            
              <button type="submit" class="btn btn-delete">
                削除
              </button> 
          <td>
      </form>  
      </tr>     
      @endforeach
    </div>  
  </ul>
  </table>
</div>