<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks;
        return view('tasks.index', compact('tasks'));
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->validate($request, [
            'status' => 'required|in:started,complete,uncompleted'
        ]);

        $task->status = $request->status;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }
}
