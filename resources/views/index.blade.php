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

@if (count($errors) > 0)
<ul>
  @foreach ($errors->all() as $error)
  <li>
    {{$error}}
  </li>
  @endforeach
</ul>
@endif

@section('content')
<div class="todolist">
  <h2 class="title">Todo List</h2>
    <form action="/add" method="post">
      <input type="text" id="id" name="task" required minlength="1" maxlength="20" size="30">
      <input type="submit" value="追加">
    </form>

  <table>
    @csrf
    <tr>
      <th>作成日</th>
      <td>
      </td>
      <th>タスク名</th>
      <td>
        <input type="text" name="" value="{{$form->task}}">
      </td>      
      <form action="/edit" method="POST">
        <th>更新</th>
        <td>
          <input type="submit" value="更新">
        </td>      
      <form action="/delete" method="POST">
        <th>削除</th>
        <td>
          <input type="submit" value="削除">
        </td>
    </tr>
  </table>
@endsection


