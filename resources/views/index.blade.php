<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <link href="css/style.css" media="all" rel="stylesheet" type="text/css" />
  <title>UBB | UnBoughtBook</title>
</head>

<body style="background: url(/image/books2.png);">
@csrf
<div class="todolist">
  <div class="title-container">
    <div class="title-container-ttl">
      <h2>UBB | unbought book today</h2>
    </div>
    <div class="title-container-login">
      @if (Auth::check())
      <p>「{{$user->name .'」でログイン中' .  ''}}</p>
      @if (count($errors) > 0)
      <ul>
        @foreach ($errors->all() as $error)
        <li>
          {{$error}}
        </li>
        @endforeach
      </ul>
      @endif
        <form method="POST" action="{{ route('logout') }}">   
        @csrf
        <a :href="route('logout')"
              onclick="event.preventDefault();
                  this.closest('form').submit();" id="logout" class="btn btn-lgt">ログアウト</a>
          </form>
      @else
        @csrf
        <META http-equiv="Refresh" content="0;URL=/login">
      @endif  
    </div>
  </div>
    <button class="btn btn-find">
      <a href="/find">タスク検索</a>
    </button>
    <form action="/add" method="post">
      @csrf
      <div class="add-task">
        <input type="date"  name="date" required>
        <input type="text" class="text-add" name="book" placeholder="書籍名" required minlength="1" maxlength="40" >
        <input type="text" class="info-add" name="author" placeholder="著者名" minlength="1" maxlength="20" >
        <input type="text" class="info-add" name="publisher" placeholder="出版社" minlength="1" maxlength="20" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <button type="submit" class="btn btn-add">
          追加
        </button>
      </div>
    </form>

  <table>   
    <tr>
      <div class="table-th">
        <th>@sortablelink('date', '日付')</th>
        <th>書籍名</th>
        <th>著者名</th>
        <th>出版社名</th>
        <th>更新</th>
        <th>削除</th>
      </div>     
    </tr>
  <ul>
    <div class="table-td">
      @foreach ($todos as $todo)  
      <tr>  
        <td>
          <p>{{\Carbon\Carbon::parse($todo->date)->format('Y-m-d')}}</p> 
        </td>    
      @if (count($errors) > 0)
      <ul>
        @foreach ($errors->all() as $error)
        <li>
          {{$error}}
        </li>
        @endforeach
      </ul>
      @endif  
      <form action="/edit" method="POST">
        @csrf   
        <td>
          <p>{{$todo->book}}</p>                
          <input type="hidden" name="id" value="{{$todo->id}}">  
        </td>          
        <td>
          <p>{{$todo->author}}</p>                
        </td> 
        <td>
          <p>{{$todo->publisher}}</p>                
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
</body>

</html>