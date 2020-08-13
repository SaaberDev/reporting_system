<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param mixed ...$roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $notification = [
            'message' => 'You need Administrative Permission.',
            'alert-type' => 'warning',
        ];

        $user = Auth::user();
        foreach ($roles as $role){
            if(is_null($user)){
                return redirect()->route('login');
            }
            elseif ($user->hasRole($role)){
                return $next($request);
            }
        }
        return redirect()->route('login')->with($notification);
    }
}
