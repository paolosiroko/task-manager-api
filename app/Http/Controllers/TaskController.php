<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Request $request)
    {
        $validated = $this->validate($request, [
            'title' => 'required',
            'description' => 'nullable',
            'due_date' => 'required|date|after:today',
        ]);

        $task = Task::create($validated);
        return response()->json($task, 201);
    }

    public function index(Request $request)
    {
        $tasks = Task::query();

        // Check if 'status' filter is provided and clean up any extra spaces or newline characters
        if ($request->has('status')) {
            $status = trim($request->input('status')); // Remove trailing newlines or spaces
            $tasks->where('status', $status);
        }

        // Check if 'due_date' filter is provided
        if ($request->has('due_date')) {
            $tasks->where('due_date', $request->due_date);
        }

        // Check if 'search' filter is provided
        if ($request->has('search')) {
            $tasks->where('title', 'like', '%' . $request->search . '%');
        }

        return response()->json($tasks->paginate(10));
    }


    public function show($id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $validated = $this->validate($request, [
            'title' => 'sometimes|required|unique:tasks,title,' . $id,
            'description' => 'nullable',
            'status' => 'in:pending,completed',
            'due_date' => 'sometimes|required|date|after:today',
        ]);

        $task->update($validated);
        return response()->json($task);
    }

    public function destroy($id)
    {
        Task::destroy($id);
        return response()->json(['message' => 'Task deleted']);
    }
}
