<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
}
