<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;

class AjaxLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Ajax Login Controller
    |--------------------------------------------------------------
    */

    
   
	public function login(Request $request)
	{
		
		$status         = 0;
		$isAdmin        = 0;
		$messageType    = '';
		$adminUrl       = '';
		$message        = '';
		$returnUrl      = $request->input('returnUrl');
		$reloadIt       = $request->input('reloadIt');
		
		$validator = Validator::make($request->all(), [
			'username' => 'required|string|min:4|max:255',
			'password' => 'required|string|min:6',
		],[
			'username.regex' => "Username contains <li>At least one lowercase</li>"
		]);

        if ($validator->fails()) {
			
            $errors = $validator->errors()->all();
			$status      = 0;
			$messageType = 'error';
			$message     = collect($errors)->implode('<br>');
			
        }else{
			$remember_me = $request->has('remember_me') ? true : false; 
			
			if (auth()->attempt(['username' => $request->input('username'), 'password' => $request->input('password')], $remember_me))
			{
				$status      = 1;
			    $messageType = 'success';
			    $message     = 'You are successfully loged in.';
				
			}else{
				$status      = 0;
			    $messageType = 'error';
			    $message     = 'your username and password are wrong.';
				
			}
		}

        
		if(auth()->check() && auth()->user()->userRole->role->slug == 'admin'){
            $adminUrl = route('backend.dashboard');
            $isAdmin  = 1;
        } else if(auth()->check() && auth()->user()->userRole->role->slug == 'subadmin'){
            $adminUrl = route('backend.dashboard');
            $isAdmin  = 1;
        } else if(auth()->check() && auth()->user()->userRole->role->slug == 'school'){
            $adminUrl = route('backend.dashboard');
            $isAdmin  = 1;
        }

		$returnMsg = (object) array(
			'status'      => 200,
			'errStatus'   => $status,
			'adminUrl'    => $adminUrl,
			'isAdmin'     => $isAdmin,
			'messageType' => $messageType,
			'message'     => $message
			);
		$returnData['data'] = $returnMsg;
        return response()->json($returnMsg,200);
	}
	
    
}
