@extends('layouts.default')
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

@section('content')
<div class="todolist">
  <h2 class="title">Todo List</h2>
  <input type="text" id="name" name="task" required minlength="1" maxlength="20" size="30">
  <input type="submit" value="追加">

  <table>
    <tr>
      <th>作成日</th>
      <th>タスク名</th>
      <th>更新</th>
      <th>削除</th>
    </tr>
  @foreach ($todos as $todo)
    <tr>
      <td>
        {{$todo->id}}
      </td>
      <td>
        {{$todo->task}}
      </td>
    </tr>
  @endforeach
  </table>
@endsection


