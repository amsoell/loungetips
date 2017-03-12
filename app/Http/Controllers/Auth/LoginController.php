<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login(Request $request) {
        if (Auth::attempt($request->only(['email', 'password'])))
            return redirect()->intended($this->redirectTo);

        // Try old login method
        try {
            $user = User::where('email', $request->get('email'))->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withInput()->with([
                'status' => [
                    'type' => 'danger',
                    'body' => 'Invalid username or password.'
                ]
            ]);
        }

        $opassword = $user->password;
        $osalt = $user->osalt;

        if (sha1($osalt.sha1($request->get('password'))) == $opassword) {
            $user->update(['password' => Hash::make($request->get('password'))]);
            Auth::login($user);
            return redirect()->intended($this->redirectTo);
        }

        $request->session()->flash('status', [
            'type' => 'danger',
            'body' => 'Username or password not found.'
        ]);
        return redirect('/login');
    }
}
