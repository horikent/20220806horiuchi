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
        $this->validate($request, Todo::$rules);
        $form = $request->all();
        Todo::create($form);
        return redirect('/');
	}
    public function edit(Request $request)
    {
        $todo = Todo::find($request->id);
        return view('edit', ['form' => $todo]);
    }
    public function update(TodoRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Todo::where('id', $request->id)->update($form);
        return redirect('/');
    }
	
    public function delete(Request $request)
    {
        $todo = Todo::find($request->id);
        return view('delete', ['form' => $todo]);
    }
    public function remove(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/');
    }
	
}

