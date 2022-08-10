
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
  
  table {
    display:inline-block 
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
      <input type="text" id="id" name="task" required minlength="1" maxlength="20" size="30">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <input type="submit" value="追加">
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
          <input type="text" id="id" name="task" value=" {{$todo->task}}" size="20">
        </td>    
        <td>
          <form action="/edit" method="POST">
            @csrf
              <button type="submit" class="btn-edit">
                更新
              </button> 
          </form>   
        </td>
        <td>
          <form action="/delete" method="POST">
            <input type="hidden" name="delete" value="{{$todo->id}}">            
              @csrf
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
