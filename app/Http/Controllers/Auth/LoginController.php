<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Hash;

use App\User;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function loginOrSignIn(Request $request)
    {
        $data = $request->validate([
            'username'     => 'required|string|max:255',
        ]);
        $user = User::where('username', $data['username'])->first();
        if($user) {
            $this->login($request);
        } else {
            $this->register($request);
        }
    }
    
    private function register($request) 
    {
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make('123456')
        ]);
        $this->login($request);
    }

    private function login($request) 
    {
        $credentials = [ 'username' => $request->username, 'password' => '123456' ];

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'auth.login_unsuccessful'], 401);
        }
        $user = User::whereUsername($credentials['username'])->first();

        return response()->json($user->createToken('API Token')->plainTextToken, 200);
    }

    public function logout()
    {
        auth()->guard('web')->logout();
        return response()->json('success', 200);
    }
}
