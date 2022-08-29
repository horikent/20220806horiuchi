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