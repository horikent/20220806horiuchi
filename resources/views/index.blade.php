
<style>
  body {
      background-color: rgb(29, 7, 130);
  }

  .todolist {
      margin: 10% 25%;
      width: 500px;
      background-color: white;
      background-size: cover;
      border-radius: 10px; 
      padding: 20px 0 20px 30px;   
  }        
  
  .btn-add {
      display: inline-block;
      padding: 0.3em 1em;
      text-decoration: none;
      color: darkviolet;
      border: solid 2px darkviolet;
      border-radius: 3px;
      transition: .4s;
      background: white;      
  }
  .btn-add:hover {
      background: darkviolet;
      color: white;
}

  .table-ttl {
    padding-bottom: 10px;
    justify-content: space-evenly ;
  }

</style>

<div class="todolist">
  <h2 class="title">Todo List</h2>

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
      <input type="text" name="task" required minlength="1" maxlength="20" size="40">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <input type="submit" class="btn-add" name="task" value="追加">
    </form>

  <table>
    <div class="table-ttl">
      <tr>
        <th>作成日</th>
        <th>タスク名</th>
        <th>更新</th>
        <th>削除</th>
      </tr>     
    </div>
  <ul>
    @foreach ($todos as $todo)  
      <tr>  
        <td>
          {{$todo->created_at}} 
        </td>    
        <td>
          <input type="text" name="task" value=" {{$todo->task}}" size="25">
            <form action="/edit" method="POST">
            @csrf         
              <input type="hidden" name="id" value="{{$todo->id}}">             
              <input type="hidden" name="task" value="{{$todo->task}}">                  
        </td>    
        <td>
              <button type="submit" class="btn-edit">
                更新
              </button> 
            </form>     
        </td>
        <td>
          <form action="/delete" method="POST">
            @csrf            
              <input type="hidden" name="id" value="{{$todo->id}}">            
                <button type="submit" class="btn-delete">
                削除
                </button> 
          </form>  
        <td>
      </tr>     
    @endforeach
  </ul>
  </table>
</div>
