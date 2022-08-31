
<style>
  body {
    background-color: rgb(45,25,124);
  }

  .tasksearch-ttl{
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .tasksearch {
    margin: 10% 21%;
    height: auto;
    background-color: white;
    background-size: cover;
    border-radius: 10px; 
    padding: 20px;   
  }        

  .title-container{
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .title-container-login{
    display: flex;
    padding:0 2px;
  }

  a{ text-decoration-line: none;}
  a:link{ color: black;} 
  a:visited { color: black; }
  a:hover { color: white; } 

  #logout a:link{ color: red;} 
  #logout a:visited { color: red; }
  #logout a:hover { color: white; } 

  table {
    border-collapse: separate;
    border-spacing: 3px 10px;
    text-align: center;
    width:100%;
    justify-content: space-between;
  }  

  .tasksearch-ipt{
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .task-ipt{
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

  .tag{
    padding:5px 2px;
  }

  .tag_id{
    font-size:12px;
    padding:7px 2px;
    background:#E9E9ED;
    border-radius: 5px;  
    margin-left:3px;
  }

  .tag_id-result{
    font-size:12px;
    padding:5px 3px;
    background:#E9E9ED;
    border-radius: 5px;  
  }

  .search-btn{
    display: flex;
    justify-content: space-between;
  }

  .btn {
    display: inline-block;
    padding: 0.3em 1em;
    text-decoration-line: none;
    border-radius: 4px;
    transition: .4s;
    background: white;   
    font-weight:bold;
  }

  .btn-lgt{
    color: red;
    border: solid 2.5px red;
    margin:6px 7px;
    margin-top:10px;
    width:60px;
    font-size:12px;
  }

  .btn-lgt:hover {
    background: red;
    color: white;
  }

  .btn-search {
    color: #DC70FA;
    border: solid 2.5px #DC70FA;
    writing-mode: vertical-rl;   
    margin:3px;   
  }

  .btn-search:hover {
    background: #DC70FA;
    color: white;
  }

  .btn-edit{
    color: #FA9770;
    border: solid 2.5px #FA9770;
    writing-mode: vertical-rl;
  }

  .btn-edit:hover {
    background: #FA9770;
    color: white;
  }

  .btn-delete{
    color: #71FADC;
    border: solid 2.5px #71FADC;
    writing-mode: vertical-rl;
  }

  .btn-delete:hover {
    background: #71FADC;
    color: white;
  }

  .btn-rtn{
    color:  black;
    border: solid 2.5px black;
    height:18px;
    font-size:12px;
  }

  .btn-rtn:hover {
    color: white;    
    background: black;
  }

</style>

<body>
<div class="tasksearch">
  <div class="tasksearch-ttl">
    <h2>タスク検索</h2>
      <div class="title-container-login">
        @if (Auth::check())
          <p>「{{$user->name . '」でログイン中' .  ''}}</p>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
              <a :href="route('logout')"
                onclick="event.preventDefault();
                  this.closest('form').submit();" id="logout" class="btn btn-lgt">
                  ログアウト</a>
          </form>
        </button><br>    
        @else
          <META http-equiv="Refresh" content="0;URL=/login">
        @endif
      </div>  
  </div>
    <form action="/find" method="POST">
    @csrf
      <div class="tasksearch-ipt">
        <input type="text" class="task-ipt" name="input"  maxlength="20" >
          <div class="search-btn">
            <select class="tag_id" name="tag_id">
              <option></option>
              @foreach($tags as $tag)
                <option>{{$tag->tag}}</option>
              @endforeach  
            </select>
            <input class="btn btn-search" type="submit" value="検索"><br>
          </div>
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
  @if(@isset($search))
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
          <input type="hidden" name="tag_id">
            <div class="tag-btn">
              <select class="tag_id-result" name="tag_id">
                @foreach($tags as $tag)
                  <option  value="{{$tag->id}}" 
                  @if($tag->id==$input->tag_id) selected @endif>{{$tag->tag}}</option>
                @endforeach  
              </select>
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
    <div class="btn btn-rtn">
      <a href="/index">戻る</a>
    </div>
</div>    
</body>

