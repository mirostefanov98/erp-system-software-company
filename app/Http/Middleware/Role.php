<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user_role = '';
        switch (Auth::user()->role) {
            case 0:
                $user_role = 'admin';
                break;
            case 1:
                $user_role = 'project_manager';
                break;
            case 2:
                $user_role = 'developer';
                break;
            case 3:
                $user_role = 'hr';
                break;
        }
        //dd($roles);

        foreach ($roles as $role) {
            if ($role == $user_role) {
                return $next($request);
            }
        }
        return redirect('home');
    }
}
