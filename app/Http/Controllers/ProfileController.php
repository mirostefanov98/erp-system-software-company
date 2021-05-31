<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        return view('user.profile', ['user' => Auth::user()]);
    }

    public function update_avatar(Request $request)
    {
        if (isset($request->image)) {
            $user = Auth::user();
            $user->image_path = $request->file('image')->store('images/' . $user->id, 'public');
            $user->save();
        }


        return view('user.profile', ['user' => Auth::user()]);
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'old_password' => ['required'],
            'new_password' => ['required'],
            'confirm_password' => ['required', 'string', 'min:8', 'same:new_password'],
        ]);

        if (Hash::check($request->old_password, Auth::user()->password)) {
            if ($request->new_password == $request->confirm_password) {
                $user = Auth::user();
                $user->password = Hash::make($request->new_password);
                $user->save();
                return redirect()->back()->with('status', "Password updated!");
            }
        } else {
            return redirect()->back()->with('error', "Old Password dont mach!");
        }
    }
}
