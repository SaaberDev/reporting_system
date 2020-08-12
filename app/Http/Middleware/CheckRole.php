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
        $user = Auth::user();

        foreach ($roles as $role){
            if(is_null($user)){
                return redirect()->route('login');
            }
            elseif ($user->hasRole($role)){
                return $next($request);
            }
            else{
                abort(401);
            }
        }
        return $next($request);
    }
}
