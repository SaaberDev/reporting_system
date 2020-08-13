<?php

namespace App\Http\Controllers\admin_panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPasswordValidation;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function change_password()
    {
        return view('admin_panel.pages.auth.change_password');
    }

    public function update_password(AdminPasswordValidation $request)
    {
        $notification = [
            'message' => 'Password Updated Successfully!',
            'alert-type' => 'success_toast',
        ];

        $old_pass = \Auth::user()->password;
        $current_pass = $request->__get('current_pass');
        $new_pass = $request->__get('password');

        if (\Hash::check($current_pass, $old_pass)){
            $users = User::findOrFail(\Auth::id());
            $users->password = Hash::make($new_pass);
            $users->save();
            \Auth::logout();
            return redirect()->route('login')->with($notification);
        } else {
            return redirect()->back()->with('message_error', 'Password do not match our records');
        }
    }
}
