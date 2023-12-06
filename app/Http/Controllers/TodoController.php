<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Group;

class TodoController extends Controller
{
    public function index(Request $request)
{
    $todos = Auth::user()->todos;

    // Check if a search query is provided
    if ($request->has('search')) {
        $search = $request->input('search');
        $todos = $todos->filter(function ($todo) use ($search) {
            return stripos($todo->title, $search) !== false ||
                   stripos($todo->description, $search) !== false;
        });
    }

    return view('Todo', [
        'todos' => $todos,
    ]);
}
// public function index(Request $request)
// {
//     $todos = Auth::user()->todos;

//     // Check if a search query is provided
//     if ($request->has('search')) {
//         $search = $request->input('search');
//         $todos->where(function ($query) use ($search) {
//             $query->where('title', 'like', '%' . $search . '%')
//                 ->orWhere('description', 'like', '%' . $search . '%');
//         });
//     }

//     // Exclude completed todos
//     $todos->whereNull('completed_at');

//     return view('Todo', [
//         'todos' => $todos,
//     ]);
// }

public function store(Request $request)
{
    $attributes = request()->validate([
        "title" => "required",
        "description" => "nullable",
        "group" => "required|integer",
        "urgent" => "boolean",
    ]);
    
    $attributes['user_id'] = auth()->id();
    $attributes['group'] = $request->input('group');
    $attributes['urgent'] = $request->has('urgent');
    Todo::create($attributes);
    
    return redirect()->back();
}

    public function update(Request $request, Todo $todo)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'urgent' => 'boolean',
        ]);

        $todo->update($validatedData);
       

        return redirect()->route('todos.index');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index');
    }

    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    public function complete(Todo $todo)
    {
        $todo->completed_at = now();
        $todo->save();

        // ...

    
        return Redirect::route('todos.index');
    }

    public function group($group)
    {
        $todos = Auth::user()->todos()->where('group', $group)->get();

        return view('Todo', [
            'todos' => $todos,
        ]);
    }

    // public function done()
    // {
    //     $todos = Auth::user()->todos()->whereNotNull('completed_at')->get();

    //     return view('Todo', [
    //         'todos' => $todos,
    //     ]);
    // }
    public function done()
{
    // Retrieve completed tasks for the authenticated user
    $completedTodos = Auth::user()->todos()->whereNotNull('completed_at')->get();

    return view('done', [
        'completedTodos' => $completedTodos,
    ]);
}

    public function show(Todo $todo)
    {
        return view('todos.show', compact('todo'));
    }
    
    public function urgent()
{
    $user = auth()->user();

    $urgentTodos = $user->todos()
        ->where('urgent', true)
        ->whereNull('completed_at')
        ->get();

    return view('urgent', [
        'urgentTasks' => $urgentTodos,
    ]);
}


public function markAsDone($id)
{
    $todo = Todo::findOrFail($id);
    $todo->markAsDone();
    
    // Check if the task belongs to a group
    if ($todo->group_id) {
        // Redirect to the Done section for the specific group
        return redirect()->route('todos.group.done', ['group' => $todo->group_id]);
    } else {
        // Redirect back to the previous page (where the user initiated the action)
        return redirect()->back();
    }
}

// Method to add a new group
public function addGroup(Request $request)
    {
        $request->validate([
            'newGroup' => 'required|string|max:255|unique:groups,name',
        ]);

        // Create a new group
        $group = Group::create([
            'name' => $request->input('newGroup'),
        ]);

        // Assuming you have a relationship between Todo and Group models
        // Attach the new group to the authenticated user
        auth()->user()->groups()->attach($group);

        // Redirect to the newly created group's tasks
        return redirect()->route('todos.group', ['group' => $group->id]);
    }

public function groupDone($group)
{
    $completedTodos = Auth::user()->todos()
        ->where('group', $group)
        ->whereNotNull('completed_at')
        ->get();

    return view('group_done', [
        'completedTodos' => $completedTodos,
        'group' => $group,
    ]);
}



}