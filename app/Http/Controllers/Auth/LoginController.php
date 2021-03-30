<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $maxAttempts = 3; // Default is 5
    protected $decayMinutes = 5; // Default is 1


    /**
     * @param $request
     * @param User $user
     * @return RedirectResponse|void
     */
    public function authenticated($request, User $user)
    {
        if ($user->hasRole('isAdmin')){
            return redirect()->route('admin.index');
        }
        elseif ($user->hasRole('isUser')){
            return redirect()->route('report.index');
        }
        else {
            abort(401);
        }
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
