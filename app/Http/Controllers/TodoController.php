<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $todos = Todo::all();
        $tags = Tag::all();
        $todos= Auth::user()-> todos;
        $param = [
            'todos' => $todos,
            'tags' => $tags,
            'user' =>$user
        ];
            return view('index', $param);
    }

    public function store(Request $request){
        $todo = new Todo();
        $todo -> fill($request -> all());
        $todo -> user_id = Auth::user() -> id;
        $todo -> save();
        return redirect('/index') -> route('index',$todo);
    }    
    
    public function construct()
    {
    $this->middleware('auth');
}

    public function find()
    {
        $tags = Tag::all();
        $user = Auth::user();
        $param = [
        'user' =>$user,
        'tags' => $tags,
        'input' => ''
    ];
        return view('find', $param);
    }

    public function search(Request $request)
    {
        $tags = Tag::all();
        $user = Auth::user();
        $keyword = $request->input;
        $tag_id = $request->tag_id;
        if (!empty($keyword)) {
            $search = Todo::where('task', 'like binary', "%{$keyword}%")->get();
        }
        if (!empty($tag_id)) {
            $search = Todo::where('tag_id', 'like binary', "%{$tag_id}%")->get();
        }
        $param = [
            'search' => $search,
            'tags' => $tags,
            'user' => $user,
        ];
            return view('find', $param);       
    }

    public function create(Request $request)
    {
        $param = [
            'task' => $request->task,
            'created_at'=> $request->created_at, 
            'updated_at'=> $request->updated_at,
            'tag_id'=> $request->tag_id,
            'user_id' =>  $request->user_id
        ];            
        Todo::create($param);
        return redirect('/index');
	}

    public function update(Request $request)
    {
        $form = $request->all();
        unset($form['_token']);        
        Todo::where('id', $request->id)->update($form);
        return redirect('/index ');
	}    
    public function remove(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/index');
    }      
    

}    