<?php

namespace App\Http\Controllers;

use App\Models\GroupTask;
use Illuminate\Http\Request;

class GroupTaskController extends Controller
{
    public function index($groupId)
    {
        $groupTasks = GroupTask::where('group_id', $groupId)->get();
        return view('group_tasks.index', ['groupTasks' => $groupTasks]);
    }

    public function store(Request $request, $groupId)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
        ]);

        GroupTask::create([
            'group_id' => $groupId,
            'task_name' => $request->input('task_name'),
        ]);

        return redirect()->route('groups.tasks.index', ['groupId' => $groupId])
            ->with('success', 'Task created successfully.');
    }

}