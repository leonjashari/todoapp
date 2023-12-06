<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class UrgentController extends Controller
{
    public function index()
    {
        $urgentTasks = Todo::where('urgent', true)->get();
        return view('todos.urgent', compact('urgentTasks'));
    }
}