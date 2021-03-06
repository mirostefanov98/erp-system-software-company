<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::sortable()->latest()->paginate(5);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'number' => ['required', 'string', 'max:10'],
            'position' => ['required', 'string', 'max:50'],
            'role' => ['required'],
        ]);

        $user->update($request->all());

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->projects()->detach();
        if ($user->image_path != 'default.png') {
            Storage::disk('public')->delete($user->image_path);
        }
        $user->delete();

        return redirect()->route('users.index');
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => ['required'],
        ]);

        $search = $request->search;

        $users = User::sortable()->where('firstname', 'LIKE', "%{$search}%")
            ->orWhere('lastname', 'LIKE', "%{$search}%")
            ->orWhere('position', 'LIKE', "%{$search}%")
            ->paginate(5);

        return view('users.index', compact('users'));
    }
}
