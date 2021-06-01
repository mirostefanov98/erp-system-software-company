<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = User::find(Auth::user()->id);
        return view('user.profile', compact('user'));
    }

    public function update_avatar(Request $request)
    {
        if (isset($request->image)) {
            $user = User::find(Auth::user()->id);
            $user->image_path = $request->file('image')->store('images/' . $user->id, 'public');
            $user->save();
        }

        return redirect()->route('profile');
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
                $user = User::find(Auth::user()->id);
                $user->password = Hash::make($request->new_password);
                $user->save();
                return redirect()->back()->with('status', "Password updated!");
            }
        } else {
            return redirect()->back()->with('error', "Old Password dont mach!");
        }
    }
}
