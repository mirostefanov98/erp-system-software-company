<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function my_leaves()
    {
        $user = Auth::user();
        $leaves = $user->leaves()->latest()->paginate(5);
        return view('leaves.my_leaves', compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leaves.create');
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
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required',
        ]);

        $leave = new Leave;
        $leave->start_date = $request->start_date;
        $leave->end_date = $request->end_date;
        $leave->description = $request->description;
        $leave->user_id = Auth::user()->id;
        $leave->state = 0;
        $leave->save();

        return redirect()->route('leaves.my_leaves');
    }

    public function change_state(Leave $leave)
    {
        if ($leave->state == 0) {
            $leave->state = 1;
        } else {
            $leave->state = 0;
        }
        $leave->save();
        return redirect()->route('leaves.all_leaves');
    }

    public function destroy(Leave $leave)
    {
        $leave->delete();
        return redirect()->route('leaves.all_leaves');
    }

    public function all_leaves()
    {
        $leaves = Leave::sortable()->latest()->paginate(5);
        return view('leaves.all_leaves', compact('leaves'));
    }
}
