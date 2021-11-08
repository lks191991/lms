<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentFavourites;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Video;
use App\Models\Tutor;
use App\Models\Subject;
use App\Models\Classes;
use App\Models\Avatar;
use App\Models\Countries;
use App\User;
use App\Rules\MatchOldPassword;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use GLB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Image;
use Validator;
use Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show Student profile.
     *
     */
    public function profile()
    {

       // session()->forget('newCustomer');
       // session()->forget('userId');
        $student = User::find(Auth::user()->id);

        if (Auth::user()->userRole->role->slug == 'admin') {
            return redirect()->route('backend.dashboard');
        } else if (Auth::user()->userRole->role->slug == 'student') {
			
            return $this->student();
        } else if (Auth::user()->userRole->role->slug == 'tutor') {
            return $this->tutor();
        }
    }
	
	public function updateProfileTutor(Request $request)
    {
        //Retrieve the tutor and update
		$user_id = Auth::user()->id;
        $tutor = Tutor::where('user_id',$user_id)->first();
        $data = $request->all();
        $validator = Validator::make($data, [
                    'first_name' => 'required|min:2',
                    'email' => [
                        'email',
                        'required',
                        'max:180',
                        Rule::unique('users')->where(function ($query) use($user_id) {
                                    return $query->where('id', '<>', $user_id);
                                })
                    ],
                    'mobile' => [
                        'required',
                        'numeric',
                        Rule::unique('tutors')->where(function ($query) use($user_id) {
                                    return $query->where('user_id', '<>', $user_id);
                                })
                    ],
                        ], [
                   // 'password.regex' => "Password must be contains minimum 8 character with at least one lowercase, one uppercase, one digit, one special character",
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                            ->withErrors($validator) // send back all errors to the form
                            ->withInput();
        }

        $tutor->first_name = $data['first_name'];
        $tutor->last_name = $data['last_name'];
        $tutor->email = $data['email'];
        $tutor->mobile = $data['mobile'];
        $tutor->country = $data['country'];
        $tutor->tutor_subject = $data['tutor_subject'];

        $tutor->save(); //persist the data
        //save user other information
        $user_more_info = User::find($tutor->user_id);
        $user_more_info->email = $data['email'];
        $user_more_info->save(); //persist the data

        return redirect()->route('frontend.profile')->with('success', 'Tutor Information Updated Successfully');
    }
	
	public function updateProfileStudent(Request $request)
    {
        //Retrieve the tutor and update
		$user_id = Auth::user()->id;
        $student = Student::where('user_id',$user_id)->first();
        $data = $request->all();
        $validator = Validator::make($data, [
                    'first_name' => 'required|min:2',
                    'email' => [
                        'email',
                        'required',
                        'max:180',
                        Rule::unique('users')->where(function ($query) use($user_id) {
                                    return $query->where('id', '<>', $user_id);
                                })
                    ],
                    'mobile' => [
                        'required',
                        'numeric',
                        Rule::unique('tutors')->where(function ($query) use($user_id) {
                                    return $query->where('user_id', '<>', $user_id);
                                })
                    ],
                        ], [
                   // 'password.regex' => "Password must be contains minimum 8 character with at least one lowercase, one uppercase, one digit, one special character",
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                            ->withErrors($validator) // send back all errors to the form
                            ->withInput();
        }

        $student->first_name = $data['first_name'];
        $student->last_name = $data['last_name'];
        $student->email = $data['email'];
        $student->mobile = $data['mobile'];
        $student->country = $data['country'];

        $student->save(); //persist the data
        //save user other information
        $user_more_info = User::find($student->user_id);
        $user_more_info->email = $data['email'];
        $user_more_info->save(); //persist the data

        return redirect()->route('frontend.profile')->with('success', 'Student Information Updated Successfully');
    }
	
    public function tutor()
    {

        $tutor = User::find(Auth::user()->id);
		$countries = Countries::where(['status' => 1])->select('id', 'name')->orderBy('name', 'ASC')->get();
        return view('frontend.tutor.profile', compact('tutor','countries'));
    }
	
	
	

    public function student()
    {

        $student = User::where("id",Auth::user()->id)->first();
		
		$countries = Countries::where(['status' => 1])->select('id', 'name')->orderBy('name', 'ASC')->get();
        return view('frontend.student.profile', compact('student','countries'));
    }

    public function changePassword()
    {
        return view('frontend.change_password');
    }

	/**
     * change password
     * @param Request $request
     * @return Validator object
     */
    public function changePasswordSave(Request $request) {
        $userid = Auth::user()->id;
		$data = $request->all();
		$validator = Validator::make($data, [
				'current_password' => ['required', new MatchOldPassword],
				'password' => 'required|confirmed|string|min:6',
				],[
					// 'password.regex' => "Password must be contains minimum 8 character with at least one lowercase, one uppercase, one digit, one special character",
				]);
       if ($validator->fails()) {
				return Redirect::back()
					->withErrors($validator) // send back all errors to the form
					->withInput();
			}
			

		$data = $request->all();
		$user = User::find($userid);
		if(!empty($user) && isset($user->id) && !empty($user->id)) {
			$user->password = bcrypt($data['password']);
			$user->save();

			return redirect()->route('frontend.changePassword')->with('success', 'Password Updated Successfully');
        } else {
			return redirect()->route('frontend.changePassword')->with('error', 'Password Updated Successfully');
        }
    }
	
	
	
    public function uploadProfile(Request $request)
    {
        $sender_id = 0;
        $status = 0;
        $messageType = '';
        $message = '';
        $watchCount = 1;
        $src = '';

        $validator = Validator::make($request->all(), [
                    //'profile_image'=>'required|image|dimensions:max_width=212,max_height=150|max:2048'
                    'profile_image' => 'required|image|max:2048'
                        ], [
                        //"required" => ""
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors()->all();
            $status = 0;
            $messageType = 'error';
            $message = collect($errors)->implode('<br>');
        } else {

            $userid = \Auth::user()->id;
            $user = User::find($userid);
            $role_id = $user->role_id;
            $userRole = $user->userRole->role->slug;

            if ($request->hasFile('profile_image')) {
                $logo = $request->file('profile_image');
                $uploadPath = "uploads/student";

                if ($userRole == 'tutor') {
                    /** Below code for save tutor image * */
                    $uploadPath = "uploads/tutor";
                } else {
                    /** Below code for save student image * */
                    $uploadPath = "uploads/student";
                }

                $logoName = time() . mt_rand(10, 100) . '.' . $logo->getClientOriginalExtension();
                $location = public_path($uploadPath);
                if (!file_exists($location)) {
                    mkdir($location);
                }
                $isMoved = $logo->move($location . '/', $logoName);
                $img = Image::make($location . '/' . $logoName);

                if ($role_id == 5) {
                    $update = Student::where('user_id', $user->id)->first();
                    $update->profile_image = $uploadPath . '/' . $logoName;
                    $update->save();
                }
                if ($userRole == 'tutor') {
                    /** Below code for save tutor image * */
                    $update = Tutor::where('user_id', $user->id)->first();
                    $update->profile_image = $uploadPath . '/' . $logoName;
                    $update->save();
                } else {
                    /** Below code for save student image * */
                    $update = Student::where('user_id', $user->id)->first();
                    $update->profile_image = $uploadPath . '/' . $logoName;
                    $update->save();
                }

                $src = url($uploadPath . '/' . $logoName);
                $status = 1;
                $messageType = 'success';
                $message = "Successfully updated your profile.";
            }
        }

        $returnMsg = (object) array(
                    'status' => 200,
                    'errStatus' => $status,
                    'messageType' => $messageType,
                    'message' => $message,
                    'imgsrc' => $src
        );
        $returnData['data'] = $returnMsg;
        return response()->json($returnMsg, 200);
    }

    public function changeAvatar(Request $request)
    {
        $sender_id = 0;
        $status = 0;
        $messageType = 'error';
        $message = 'Please select avatar.';
        $watchCount = 1;
        $src     = '';
        $fileurl = '';
		
		$avatar = Avatar::find($request->avatar_id);
		
		if(!empty($avatar->file_url) && file_exists(public_path($avatar->file_url))){
			$fileurl = $avatar->file_url; 
		}

        if (!empty($request->avatar_id)) {
            $userid = \Auth::user()->id;
            $user = User::find($userid);
            $role_id = $user->role_id;
            $userRole = $user->userRole->role->slug;


            if ($userRole == 'tutor') {
                /** Below code for save tutor  * */
                $update = Tutor::where('user_id', $user->id)->first();
                $update->avatar_id     = $request->avatar_id;
				$update->profile_image = $fileurl;
                $update->save();
            } else {
                /** Below code for save student  * */
                $update = Student::where('user_id', $user->id)->first();
                $update->avatar_id     = $request->avatar_id;
				$update->profile_image = $fileurl;
                $update->save();
            }
			
			$src = $user->userData->profile_or_avatar_image;
			//profile_or_avatar_image
            $status = 1;
            $messageType = 'success';
            $message = "Successfully updated your avatar.";
        }
		
		
		 


        $returnMsg = (object) array(
                    'status' => 200,
                    'errStatus' => $status,
                    'messageType' => $messageType,
                    'message' => $message,
					'imgsrc' => $src
        );
        $returnData['data'] = $returnMsg;
        return response()->json($returnMsg, 200);
    }

    

    /**
     * Uplaod video files
     *
     * @param  string  $uuid
     * @return renderd view
     */
    public function uploadVideoFile($uuid)
    {        
        $video = Video::uuid($uuid);	
        if($video->video_type != 'file' || Auth::user()->id != $video->tutor_id){
            return redirect()->route('front');
        }                
        
        $video_thumb = $video->getVimeoThumb();
        
        return view('frontend.tutor.upload_video_file', compact('video','video_thumb'));
    }
    
}
