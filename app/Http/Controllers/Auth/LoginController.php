<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\EventRegister; // Assuming your model is named EventRegister
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;
use Illuminate\Support\Str;
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

    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/app/event/list';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect()->route('login');
    }


    public function userlogout(Request $request)
    {
        $this->performLogout($request);
        //return redirect()->route('users_login');
        return redirect()->route('index');
    }

    public function checkLogin(Request $request)
    {
        // Validate the input data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the email exists in the event_registers table
        $user = EventRegister::where('email', $request->email)->first();

        // If user is found and password matches
        if ($user && Hash::check($request->password, $user->password)) {
            // Store user data in the session
            session(['user' => $user]);

            // Successful login, redirect to the welcome page
            return redirect()->route('profile.view');
        }

        // If login fails, redirect back with error message
        return Redirect::back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ]);
    }



    /*----------  Reset Password Details ----------*/

    public function resetPassword(Request $request)
    {
        // Validate the input data
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if the email exists in the event_registers table
        $user = EventRegister::where('email', $request->email)->first();

        if (!empty($user)) {

            $randomPassword = Str::random(6);
            $newPassword = Hash::make($randomPassword);

            $user->password = $newPassword;
            $user->save();

            Mail::to($user->email)->send(new ResetPassword($user, $randomPassword));


            return redirect()->route('password_request')->with('success', 'Your New Password  has been sent to your email please check there..');
            ;
        } else {

            return Redirect::back()->withErrors([
                'email' => 'Enter email is incorrect.',
            ]);
        }


    }


}
