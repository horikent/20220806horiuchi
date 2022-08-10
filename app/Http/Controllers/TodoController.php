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

	public function add()
    {
        return view('add');
    }
    public function create(TodoRequest $request)
    {
        $form = $request->all();
        Todo::create($form);
        return redirect('/');
	}
    public function edit(Request $request)
    {
        $todo = Todo::find($request->id);
        return view('edit', ['form' => $todo]);
    }
    public function upload(TodoRequest $request)
    {
        $form = $request->all();
        Todo::edit($form);
        return redirect('/');
	}    
    public function delete(Request $request)
    {
        $todo = Todo::find($request->id);
        return view('/', ['form' => $todo]);
    }
    public function remove(TodoRequest $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/');
    }      
}    