<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;

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
    
	public function login(Request $request)
	{
		/* $this->validate($request, [
			'email' => 'required|email',
			'password' => 'required|string|min:8',
		]); */
		
		$validator = Validator::make($request->all(), [
			'username' => 'required|string|min:4|max:255|regex:/^(?=.*[a-z]).+$/',
			'password' => 'required|min:6',
		],[
			'username.regex' => "Username contains <li>At least one lowercase</li>"
		]);

        if ($validator->fails()) {
            return redirect('login')->withErrors($validator)->withInput();
        }
		
		$remember_me = $request->has('remember_me') ? true : false; 
		
		if (auth()->attempt(['username' => $request->input('username'), 'password' => $request->input('password')], $remember_me))
		{
			return $this->sendLoginResponse($request);
		}else{
			return redirect()->route('login')->with('error','your username and password are wrong.');
		}
	}
	
    /**
     * @param Request $request
     * @param $user
     *
     * @throws GeneralException
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        /*
         * Check to see if the users account is confirmed and active
         */
        //to do

        //if(!empty($user->mobile_verified_at)){
            if (!$user->status) {
                auth()->logout();
                return redirect()->route('login')->with('error', 'Currently, your account is not active. Please contact to site administrator.');
            } elseif (\Auth::user()->hasRole(['student','tutor'])) {
                return redirect()->route('home');
            } elseif (\Auth::user()->hasRole(['superadmin', 'admin', 'subadmin', 'school'])) {
                // && \Auth::user()->hasPermission('browse.admin')
                return redirect()->route('backend.dashboard');
            }
        //}else{
        //    auth()->logout();
        //    return redirect()->route('login')->with('error', 'Currently, your account is not active. Please Verfiy Your Email.');
        //}
        return redirect('/');
    }
}
