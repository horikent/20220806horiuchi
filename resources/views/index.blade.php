  
<style>
  body {
      background-color: rgb(29, 7, 130);
  }

  .todolist {
      margin: 10% 25%;
      height: auto;
      background-color: white;
      background-size: cover;
      border-radius: 10px; 
      padding: 20px;   
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

.btn {
      display: inline-block;
      padding: 0.3em 1em;
      text-decoration: none;
      border-radius: 4px;
      transition: .4s;
      background: white;   
      font-weight:bold;
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
  <h2 class="title">Todo List</h2>
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
      <input type="text" class="text-add" name="task" required minlength="1" maxlength="20" >
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="tag">
          <select name="tag-select">
            <option value="{{tag_id==1}}"></option>
            <option value="{{tag_id==2}}">家事</option>
            <option value="{{tag_id==3}}">勉強</option>
            <option value="{{tag_id==4}}">運動</option>
            <option value="{{tag_id==5}}">食事</option>
            <option value="{{tag_id==6}}">移動</option>
          </select>
        </div>
        <button type="submit" class="btn btn-add">
          追加
        </button>
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
          <button type="submit">
            @if(isset($tag_id))
              @foreach ($todos as $tag_id)
                <tr>
                  <td>{{$tag_id->getTitle() }}</td>
                </tr>
              @endforeach
            @endif
          </button> 
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