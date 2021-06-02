<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {

        $tasks = $project->tasks()->sortable()->paginate(5);
        return view('tasks.index', compact('tasks', 'project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('tasks.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'priority' => 'required',
        ]);

        $task = new Task;
        $task->name = $request->name;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->status = 0;
        $task->state = 0;
        $task->project_id = $project->id;
        $task->save();

        return redirect()->route('tasks.index', $project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'priority' => 'required',
        ]);

        $task->name = $request->name;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->status = $request->status;
        $task->state = $request->state;
        $task->save();

        return redirect()->route('tasks.index', $task->project_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index', $task->project_id);
    }

    public function change(Task $task)
    {
        return view('tasks.change', compact('task'));
    }

    public function change_update(Request $request, Task $task)
    {
        $task->status = $request->status;
        $task->state = $request->state;
        $task->save();

        return redirect()->route('tasks.index', $task->project_id);
    }

    public function search(Request $request, Project $project)
    {
        $request->validate([
            'search' => ['required'],
        ]);

        $search = $request->search;

        $tasks = $project->tasks()->sortable()
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            })
            ->paginate(5);

        return view('tasks.index', compact('tasks', 'project'));
    }
}
