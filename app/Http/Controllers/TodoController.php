<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
            return view('index', ['todos' => $todos]);
    }
    
    public function find()
    {
        return view('find',  ['input' => '']);
    }
    public function search(Request $request)
    {
        $search = Todo::where('task', 'LIKE BINARY',"%{$request->input}%")->get();
        $param = [
            'search' => $search,
            'input' => $request->input
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