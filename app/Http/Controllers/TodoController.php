<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $todos = Todo::all();
        $tags = Tag::all();
        $param = [
            'todos' => $todos,
            'tags' => $tags,
            'user' =>$user
        ];
            return view('index', $param);
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
        $search = Todo::where('task', 'LIKE BINARY',"%{$request->input}%")->get();
        $tag_id = Todo::where('tag_id',"{$request->input}")->get();
        $param = [
            'search' => $search,
            'input' => $request->input,
            'tags' => $tags,
            'user' => $user,
            'tag_id'=> $tag_id
        ];
            return view('find', $param);       
    }

    public function create(Request $request)
    {
        $form = $request->all();
        Todo::create($form);
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