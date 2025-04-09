<?php

// app/Http/Controllers/TaskController.php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function create(Request $request)
    {
        $task = Task::create([
            'name' => $request->input('task_name'),
            'user_id' => Auth::id(),
        ]);

        return response()->json($task);
    }


    public function toggleCompletion($taskId)
    {
        $task = Task::findOrFail($taskId);


        if ($task->user_id == Auth::id()) {
            $task->completed = !$task->completed;
            $task->save();

            return response()->json($task);
        }

        return response()->json(['error' => 'Tâche non trouvée ou accès interdit'], 403);
    }

    public function delete($taskId)
    {
        $task = Task::findOrFail($taskId);


        if ($task->user_id == Auth::id()) {
            $task->delete();
            return response()->json(['message' => 'Tâche supprimée']);
        }

        return response()->json(['error' => 'Tâche non trouvée ou accès interdit'], 403);
    }


    public function index()
    {
        $tasks = Auth::user()->tasks;
        return response()->json($tasks);
    }

    public function store(Request $request)
    {

        $request->validate([
            'task_name' => 'required|string|max:255',
        ]);


        $task = Task::create([
            'name' => $request->input('task_name'),
            'completed' => false,
        ]);


        return response()->json($task, 201);
    }
}
}

