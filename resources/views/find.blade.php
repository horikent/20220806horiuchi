
<style>
  body {
      background-color: rgb(29, 7, 130);
  }

  .tasksearch-ttl{
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .tasksearch {
      margin: 20% 25%;
      height: auto;
      background-color: white;
      background-size: cover;
      border-radius: 10px; 
      padding: 20px;   
  }        
  .tasksearch-ipt{
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  task-ipt{
    width:80%;
  }

  table {
    border-collapse: separate;
    border-spacing: 8px 10px;
    text-align: center;
    width:100%;
    justify-content: space-between;
  }  

</style>

<div class="tasksearch">
  <div class="tasksearch-ttl">
    <h2>タスク検索</h2>
      @if (Auth::check())
        <p>「{{$user->name . '」でログイン中' .  ''}}</p><button>ログアウト</button><br>    
      @else
        <p>ログインしてください。（<a href="/login">ログイン</a>｜
          <a href="/register">登録</a>）</p>
      @endif  
  </div>
    <form action="/find" method="POST">
    @csrf
      <div class="tasksearch-ipt">
        <input type="text" class="task-ipt" name="input" value="{{$input}}" required minlength="1" maxlength="20" >
            <select class="tag_id" name="tag_id">
              @foreach($tags as $tag)
                <option value="{{$tag->id}}">{{$tag->tag}}</option>
              @endforeach  
            </select>
        <input type="submit" value="検索"><br>
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
  @if(isset($search))
    <div class="table-td">
      @foreach ($search as $input)   
      <tr> 
        <td>
          @if($input->created_at === $input->updated_at)
            {{$input->created_at}}
          @else 
            {{$input->updated_at}} 
          @endif
        </td>    
      <form action="/edit" method="POST">
        @csrf   
        <td>
          <input type="text" class=text-edit name="task" value=" {{$input->task}}" size="20">                   
          <input type="hidden" name="id" value="{{$input->id}}">  
        </td>          
        <td>
          <div class="tag-btn">
            <select>
              <option>{{$input->tag->getTag()}}</option>
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
            <input type="hidden" name="id" value="{{$input->id}}">            
              <button type="submit" class="btn btn-delete">
                削除
              </button> 
          </td>
      </form>  
      </tr>     
    @endforeach
    </div>  
  @endif
  </ul>
  </table>  
    <button>
      <a href="/home">戻る</a>
    </button>

