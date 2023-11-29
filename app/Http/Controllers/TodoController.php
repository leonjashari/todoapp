<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
{
    $todos = auth()->user()->todos;

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

    $attributes['user_id'] = auth()->id();

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

    public function edit(Request $request, $id)
{
    $todo = Todo::find($id);
    $todo->title = $request->input('title');
    $todo->description = $request->input('description');
    $todo->save();

    return redirect('/todos');
}
}