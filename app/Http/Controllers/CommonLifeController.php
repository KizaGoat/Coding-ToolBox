<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class CommonLifeController extends Controller
{
    public function index()
    {
        $tasks = Job::all();
        return view('pages.commonLife.index', compact('tasks'));
    }


    public function store(Request $request)
    {

        $validated = $request->validate([
            'queue' => 'required|string|max:255',
            'payload' => 'required|string',
            'available_at' => 'required|integer',
        ]);


        Job::create([
            'queue' => $validated['queue'],
            'payload' => $validated['payload'],
            'attempts' => 0,
            'reserved_at' => null,
            'available_at' => $validated['available_at'],
            'created_at' => time(),
        ]);


        return redirect()->route('commonLife.index')->with('success', 'Tâche ajoutée avec succès.');
    }

    public function complete($id)
    {

        $task = Job::findOrFail($id);


        $task->update(['completed' => true]);


        return redirect()->route('commonLife.index')->with('success', 'Tâche marquée comme terminée.');
    }
}

