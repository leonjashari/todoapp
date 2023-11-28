<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();

        return view('Todo', [
            'todos'=> $todos
            ]);
        
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            "title"=> "required",
            "description"=>"nullable"
            ]);
            Todo::create($attributes);
            return redirect()->route('todos.index');
    }

    public function update(Todo $todo)
    {
        $todo->update(['isDone'=> true]);
        return redirect()->route('todos.index');
    }
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index');
    }
}