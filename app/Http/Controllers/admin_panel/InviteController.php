<?php

    namespace App\Http\Controllers\admin_panel;

    use App\Http\Controllers\Controller;
    use App\Mail\UserInvited;
    use App\Models\Invite;
    use App\Models\User;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Http\Response;
    use Illuminate\View\View;

    class InviteController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return Application|Factory|Response|View
         */
        public function invite()
        {
            return view('admin_panel.pages.invite_user.invite');
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\RedirectResponse
         * @throws \Illuminate\Validation\ValidationException
         */
        public function process(Request $request)
        {
            $rules = [
                'email' => 'required|unique:users,email',
                'password' => 'required',
            ];

            // validate the incoming request data
            $validated = $this->validate($request, $rules);

            if ($validated){
                do {
                    //generate a random string
                    $token = \Str::random();
                } //check if the token already exists and if it does, try again
                while (Invite::where('token', $token)->first());

                //create a new invite record
                $invite = Invite::create([
                    'email' => $request->get('email'),
                    'password' => $request->get('password'),
                    'token' => $token
                ]);
                // send the email
                Mail::to($request->get('email'))->send(new UserInvited($invite));
            }

            // redirect back where we came from
            return redirect()->back();
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param $token
         * @return string
         */
        public function accept($token)
        {
            $notification = [
                'message' => 'Account is activated. Please login.',
                'alert-type' => 'success',
            ];

            // Look up the invite
            if (!$invite = Invite::where('token', $token)->first()) {
                //if the invite doesn't exist do something more graceful than this
                abort(404);
            }

            $explode = explode('@', $invite->email);
            $generateName = \Arr::first($explode);
//            dd($generateName);
            // create the user with the details from the invite
            $user = User::create([
                'name' => $generateName,
                'email' => $invite->email,
                'password' => bcrypt($invite->password),
            ]);
            $user->roles()->attach('2');

            // delete the invite so it can't be used again
            $invite->delete();

            // here you would probably log the user in and show them the dashboard, but we'll just prove it worked
            return redirect('/login')->with($notification);
        }
    }
