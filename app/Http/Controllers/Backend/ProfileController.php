<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\SchoolManager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Rules\MatchOldPassword;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a user resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
        //get user
        $user = User::findOrFail(auth()->user()->id);     
       // pr($user); exit;
        return view('backend.profile', compact('user'));
    }
	
	 /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Retrieve the user and update
        $user = User::find($id);
		$data = $request->all();
		
		if(Auth::user()->hasRole('school')){
			$school_manager = SchoolManager::where('user_id', $user->id)->first();
			$validator = Validator::make($data, [
				'current_password' => ['required', new MatchOldPassword],
				'first_name' => 'required|min:2|max:180',
				'password' => 'nullable|confirmed|string|min:6',
				 'email' => [
						'email',
						'required',
						'max:180',
						Rule::unique('users')->where(function ($query) use($id) {
										return $query->where('id', '<>', $id);
									})
						], 
				
				],[
					// 'password.regex' => "Password must be contains minimum 8 character with at least one lowercase, one uppercase, one digit, one special character",
				]);
				
		} else {
			
			$validator = Validator::make($data, [
				'current_password' => ['required', new MatchOldPassword],
				//'name' => 'required|min:2|max:180',
				'password' => 'nullable|confirmed|string|min:6',
				/* 'email' => [
						'email',
						'required',
						'max:180',
						Rule::unique('users')->where(function ($query) use($id) {
										return $query->where('id', '<>', $id);
									})
						], */
				
				],[
					// 'password.regex' => "Password must be contains minimum 8 character with at least one lowercase, one uppercase, one digit, one special character",
				]);
		}
		
		
				
				
			
			if ($validator->fails()) {
				return Redirect::back()
					->withErrors($validator) // send back all errors to the form
					->withInput();
			}
			
			if(Auth::user()->hasRole('school')){
				$user->name = $data['first_name'];
				$user->email = $data['email'];
				
				$school_manager->first_name = $data['first_name'];
				$school_manager->last_name = $data['last_name'];
				$school_manager->email = $data['email'];
				$school_manager->save();
			}
		
			//$user->name = $data['name'];
			if(isset($data['password']) && !empty($data['password'])) {
				$user->password = Hash::make($data['password']);
			}
			//$user->email = $data['email'];
			$user->save(); //persist the data
			
			return redirect()->route('backend.profile.index')->with('success','Information Updated Successfully');
		
	}

}