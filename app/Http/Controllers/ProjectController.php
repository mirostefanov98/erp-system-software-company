<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        //$this->middleware('admin');
    }
    public function index()
    {

        $projects = Project::latest()->get();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role', '<>', 3)->where('role', '<>', 0)->get();
        return view('projects.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required',
            'users' => 'required',
        ]);

        $project = new Project;
        $project->name = $request->name;
        $project->state = 0;
        $project->deadline_date = $request->date;
        $project->status = 0;
        $project->save();

        $users = User::find($request->users);
        $project->users()->attach($users);

        return redirect()->route('projects.index');
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
    public function edit(Project $project)
    {
        $users = User::where('role', '<>', 3)->where('role', '<>', 0)->get();
        return view('projects.edit', compact('project', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required',
            'users' => 'required',
        ]);

        $project->name = $request->name;
        $project->state = $request->state;
        $project->deadline_date = $request->date;
        $project->status = $request->status;
        $project->save();

        $users = User::find($request->users);
        $project->users()->sync($users);

        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->users()->detach();
        $project->delete();
        return redirect()->route('projects.index');
    }

    public function my_projects()
    {
        $user = Auth::user();
        $projects = $user->projects;
        return view('projects.my_projects', compact('projects'));
    }
}
