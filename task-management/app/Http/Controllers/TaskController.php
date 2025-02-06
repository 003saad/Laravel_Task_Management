<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
class TaskController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $status = $request->input('status');
        $tasks = $request->user()->tasks();

        if ($status === 'completed') {
            $tasks->where('completed', true);
        } elseif ($status === 'pending') {
            $tasks->where('completed', false);
        }

        $tasks = $tasks->orderBy('created_at', 'desc')->get();

        return view('tasks.index', compact('tasks', 'status'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $request->user()->tasks()->create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function toggleComplete(Task $task)
    {
        $this->authorize('update', $task);

        $task->completed = !$task->completed;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task status updated successfully.');
    }
}