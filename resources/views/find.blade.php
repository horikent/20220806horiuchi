
<style>
  body {
      background-color: rgb(29, 7, 130);
  }

  .tasksearch {
      margin: 20% 25%;
      height: auto;
      background-color: white;
      background-size: cover;
      border-radius: 10px; 
      padding: 20px;   
  }        

</style>

<div class="tasksearch">
  <h2 class="title">タスク検索</h2>
    @if (Auth::check())
      <p>「{{$user->name . '」でログイン中' .  ''}}</p><button>ログアウト</button><br>    
    @else
      <p>ログインしてください。（<a href="/login">ログイン</a>｜
        <a href="/register">登録</a>）</p>
    @endif  
    <form action="/find" method="POST">
      @csrf
        <input type="text" name="input" value="{{$input}}">
          <div class="tag">
            <select name="tag-select">
              <option value=""></option>
              <option value="家事">家事</option>
              <option value="勉強">勉強</option>
              <option value="運動">運動</option>
              <option value="食事">食事</option>
              <option value="移動">移動</option>
            </select>
          </div>
        <input type="submit" value="検索"><br>
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
          <button type="submit" value="">
            
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
      <a href="/index">戻る</a>
    </button>

