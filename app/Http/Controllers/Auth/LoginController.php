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
    protected $redirectTo = '/app/users/list';

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
            // Successful login, redirect to the welcome page
            return redirect()->route('users_welcome');
        }

        // If login fails, redirect back with error message
        return Redirect::back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ]);
    }

}
