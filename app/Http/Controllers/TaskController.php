<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
// use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');


        $tasks = auth()->user()->tasks()->when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })
        // ->latest()
        ->orderBy('created_at', 'desc')
        ->get();
        return view('dashboard', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            // ]);
            
            //here  i use Caarbon to validate date (use carbon\carbon)
            // if ($request->deadline && Carbon::parse($request->deadline)->isPast()) {
            //     return back()->withErrors(['deadline' => 'Attention! "Deadline" déja passee ! ']);
            // }

                        //here does same as the the top, it belongs to carbon library too 
                    'deadline' => 'nullable|date|after_or_equal:today',
                ],[
                'deadline.after_or_equal' => '"Deadline" déja passee !',
                ]);
        

        auth()->user()->tasks()->create($validated);

        return redirect()->route('dashboard')->with('success', 'Tâche ajoutée !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        if ($task->user_id !== auth()->id()) abort(403);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== auth()->id()) abort(403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:todo,in_progress,done',
            // 'deadline' => 'nullable|date',
            'deadline' => 'nullable|date|after_or_equal:today',
                ],[
                'deadline.after_or_equal' => '"Deadline" déja passee !',
                
        ]);

        $task->update($validated);

        return redirect()->route('dashboard')->with('success', 'Tâche mise à jour !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()) abort(403);
        $task->delete();
        return redirect()->route('dashboard');
    }
}
