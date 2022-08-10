
<style>
  body {
      background-color: rgb(29, 7, 130);
  }

  .todolist {
      margin: 25%;
      height: 300px;
      width: 600px;
      background-color: white;
      border-radius: 10px;    
  }        
  
  table {
    display:inline-block 
  }

</style>

  @if (count($errors) > 0)
    <ul>
      @foreach ($errors->all() as $error)
        <li>
          {{$error}}
        </li>
      @endforeach
    </ul>
  @endif

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
  
    <tr>
      <th>作成日</th>
      <th>タスク名</th>
      <th>更新</th>
      <th>削除</th>
    </tr>     
  <ul>
    <li> 
    <tr>  
      <td>
        @foreach ($todos as $todo)
          {{$todo->created_at}} 
        @endforeach
      </td>    
      <td>
        @foreach ($todos as $todo)
          <input type="text" id="id" name="task" value=" {{$todo->task}}" size="20">
        @endforeach
      </td>    
      <td>
        <form action="/edit" method="POST">
          @csrf
            <input type="submit" value="更新"> 
        </form>   
      </td>
      <td>
        <form action="/delete" method="POST">
          @csrf
            <input type="submit" value="削除"> 
        </form>  
      <td>
    </tr>
    </li>   
  </ul>
  </table>

