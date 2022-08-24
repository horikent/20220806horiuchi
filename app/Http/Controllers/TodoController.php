<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $todos = Todo::all();
        $tag_id= $request->input;
        $param = [
            'todos' => $todos,
            'tag_id' => $tag_id,
            'user' =>$user
        ];
            return view('home', $param);
    }
    
    public function find()
    {
        $user = Auth::user();
        $param = [
        'user' =>$user,
        'input' => ''
    ];
        return view('find', $param);
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $search = Todo::where('task', 'LIKE BINARY',"%{$request->input}%")->get();
        $param = [
            'search' => $search,
            'input' => $request->input,
            'user' =>$user
        ];
            return view('find', $param);       
    }

    public function create(Request $request)
    {
        $form = $request->all();
        Todo::create($form);
        return redirect('/');
	}
    public function update(Request $request)
    {
        $form = $request->all();
        unset($form['_token']);        
        Todo::where('id', $request->id)->update($form);
        return redirect('/');
	}    
    public function remove(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/');
    }      
}    