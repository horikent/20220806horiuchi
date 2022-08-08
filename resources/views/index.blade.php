
<style>
  body {
      background-color: rgb(29, 7, 130);
  }

  .todolist {
      margin: 25%;
      height: 250px;
      width: 500px;
      background-color: white;
      border-radius: 10px;    
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
      <td>
      </td>
      <th>タスク名</th>
      <td>

      </td>      
      <form action="/edit" method="POST">
        <th>更新</th>
        <td>

        </td>   
      </form>     
      <form action="/delete" method="POST">
        <th>削除</th>
        <td>

        </td>
      </form>  
    </tr>
</table>



