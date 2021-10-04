<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Helpers\SiteHelpers;
use App\Helpers\GeoPlugin;
use \App\Models\Student;
use \App\Models\Countries;
use \App\Models\SchoolCategory;
use App\Models\Course;
use App\Models\School;
use App\Models\Tutor;
use App\Models\Classes;
use Illuminate\Auth\Events\Registered;
use App\Mail\sendEmailtoNewuser;
use Illuminate\Support\Facades\Mail;
use Auth;


class RegisterController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /* Redirect to step 2 after register */
    protected $redirectTo = '/register/step2';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => array('step', 'step2', 'step3', 'step4')]);

        /* Below Auth middleware use check auth on it */
        //$this->middleware('auth', ['except' => array('showRegistrationForm', 'step1')]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
		if($data['rejister_as'] == 'student') {
			return Validator::make($data, [
						'first_name' => 'required|regex:/^[a-zA-Z_\-]*$/',
						'last_name' => 'nullable|regex:/^[a-zA-Z_\-]*$/',
						'username' => 'required|string|min:4|max:255|regex:/^[a-zA-Z0-9_\-]*$/|unique:users',
						'password' => 'required|confirmed|string|min:6',
						'email' => 'email|max:255|unique:users',
						'mobile' => 'required|numeric|unique:students',
						'rejister_as' => 'required'
							], [
						'first_name.regex' => "First Name contains <li>The first name must contain alpha characters only</li>",
						'last_name.regex' => "Last Name contains <li>The last name must contain alpha characters only</li>",
						'username.regex' => "Username contains <li>Username can only contain alphanumeric characters</li>",
							// 'password.regex' => "Password contains <ul><li>At least one lowercase</li><li>At least one uppercase</li><li>At least one digit</li><li>At least one special character</li><li>At least it should have 8 characters long</li></ul>",
			]);
		} else  {
		
			return Validator::make($data, [
						'first_name' => 'required|regex:/^[a-zA-Z_\-]*$/',
						'last_name' => 'nullable|regex:/^[a-zA-Z_\-]*$/',
						'username' => 'required|string|min:4|max:255|regex:/^[a-zA-Z0-9_\-]*$/|unique:users',
						'password' => 'required|confirmed|string|min:6',
						'email' => 'email|max:255|unique:users',
						'mobile' => 'required|numeric|unique:tutors',
						'rejister_as' => 'required'
							], [
						'first_name.regex' => "First Name contains <li>The first name must contain alpha characters only</li>",
						'last_name.regex' => "Last Name contains <li>The last name must contain alpha characters only</li>",
						'username.regex' => "Username contains <li>Username can only contain alphanumeric characters</li>",
							// 'password.regex' => "Password contains <ul><li>At least one lowercase</li><li>At least one uppercase</li><li>At least one digit</li><li>At least one special character</li><li>At least it should have 8 characters long</li></ul>",
			]);
		}
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        /* $user = \App\User::find(33)->userData;
          if(!empty($user->email))
          Mail::to('te@dotsquares.com', "New registration on ".env('APP_NAME', 'XtraClass'))->send(new sendEmailtoNewuser($user)); */
        session()->forget('tempCustomer');
        return $this->step(1);
    }

    /**
     * Show registration froms according to step number.
     *
     * @param  int  $num
     * @return form view
     */
    public function step($num = null)
    {
        $sessionUser = (object) array();
        $userRole = "student";
		$diffMinutes  = '00:00';
        if (isset($num) && !empty($num)) {

            if ($num != 1 && empty(session()->get('newCustomer'))) {
                return redirect()->route('frontend.profile');
            } else if ($num == 1) {
                
            } else {

                if (!empty(session('userId'))) {
                    $sessionUser = User::find(session('userId'));
                    $userRole = $sessionUser->userRole->role->slug;
					$otpdetails = DB::table("mobile_verifications")
                                            ->where('user_id', session('userId'))
                                            ->orderBy('id','desc')->first();
											
					if(!empty($otpdetails->id)){
							$diffMinutes = SiteHelpers::createdAtdiffInMinutes($otpdetails->created_at);
							
					}
                } else {
                    return redirect('/register')->with('jsError', "Please complete first step before you can access next steps");
                }
            }

			
            $geoplugin_country_name = GeoPlugin::locate();

            if (isset($geoplugin_country_name) && !empty($geoplugin_country_name)) {

                $country_details = DB::table("countries")->where('name', $geoplugin_country_name)->select('phonecode', 'name')->first();

                if (!isset($country_details->phonecode) && empty($country_details->phonecode)) {
                    $country_details = DB::table("countries")->where('phonecode', 233)->select('phonecode', 'name')->first();
                }
            } else {
                $country_details = DB::table("countries")->where('phonecode', 233)->select('phonecode', 'name')->first();
            }

            $avataricons = DB::table("avatars")->where('status', 1)->select('id', 'avatar_name', 'file_url','icon')->get();
            $courses = Course::where('status', 1)->select('id', 'name')->get();
            $schoolCat = SchoolCategory::where('status', 1)->select('id', 'name')->get();
            $schools = School::where('status', 1)->select('id', 'school_name')->get();
            $classes = Classes::where('status', 1)->select('id', 'class_name')->get();

            return view('auth.register', compact(['num', 'courses', 'schoolCat', 'schools', 'country_details', 'classes', 'avataricons', 'userRole', 'sessionUser','diffMinutes']));
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $data['otp'] = mt_rand(10000, 99999);

        $user = User::create([
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password'])
        ]);

        //$user = User::find(2);

        $role = \DB::table('roles')->where('slug', '=', $data['rejister_as'])->first();  //choose the default role upon user creation.

        /* Below code for assign user role */
        $user->attachRole($role, $user->id);

        $rejister_as = $data['rejister_as'];
        if ($rejister_as == 'student') {
            /* Below code for save student data */
            $user->insertStudent($user, $data);
        }

        if ($rejister_as == 'tutor') {
            /* Below code for save tutor data */
            $user->insertTutor($user, $data);
        }

        /* Below code for send otp to student or  tutor */
        //SiteHelpers::updateOtp($user->id, $data['phone_code'], $data['mobile'], $data['otp']);        
        //$sendOtp = SiteHelpers::sendOtpToUser($data['phone_code'], $data['mobile'], $data['otp']);
        
        /* Send verification to student or  tutor using TWILo */
        $vsid = SiteHelpers::sendOtpUsingTwilio($user->id, $data['phone_code'], $data['mobile']);
        
        session(['vsid' => $vsid]);
        session(['newCustomer' => 1]);
        session(['userId' => $user->id]);

        if (!empty($user->email))
            Mail::to($user->email, "New registration on " . env('APP_NAME', 'Xtra Class'))->send(new sendEmailtoNewuser($user, $rejister_as));

        return $user;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //$this->guard()->login($user);
        return redirect($this->redirectPath());
        // return $this->registered($request, $user)
        //?: redirect($this->redirectPath());
    }

    /**
     * mobile verification after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function step2(Request $request)
    {

        if (!empty(session('userId'))) {
            $sessionUser = User::find(session('userId'));
        } else {
            return redirect('/register')->with('jsError', "Please complete first step before you can access next steps");
        }

        $validator = Validator::make($request->all(), [
                    'mobile' => 'required|numeric|unique:students,mobile,' . $sessionUser->id,
                    'otp' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('registerStep', 2)->withErrors($validator)->withInput();
        }

        $student = Student::where('mobile', $request->all('mobile'))->first();

        if ($student) { 
            if(!empty(session('vsid'))){
                $vsid = session('vsid');
                $code = $request->input('otp');
                $status = SiteHelpers::verifyOtpUsingTwilio($vsid, $code);
                
                if($status == 'approved') {
                    User::where('id', $student->user_id)->update(['mobile_verified_at' => Carbon::now()]);
                    return redirect()->route('registerStep', 3);
                } else {
                    $validator->errors()->add('otp', 'Invalid Code or Expired.');
                    return redirect()->route('registerStep', 2)->withErrors($validator)->withInput();
                }
                
            } else {
                $validator->errors()->add('otp', 'Invalid Code.');
                return redirect()->route('registerStep', 2)->withErrors($validator)->withInput();                
            }
            
        } else {
            $validator->errors()->add('mobile', 'Invlid mobile number');

            return redirect()->route('registerStep', 2)->withErrors($validator)->withInput();
        }
    }

    /**
     * Save extra user details after validate mobile.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function step3(Request $request)
    {

        if (!empty(session('userId'))) {
            $sessionUser = User::find(session('userId'));
        } else {
            return redirect('/register')->with('jsError', "Please complete first step before you can access next steps");
        }

        $data = $request->all();
        if (!empty($request->school_cat) && !empty($request->school_name) && $request->school_cat == School::BASIC_SCHOOL) {
            $schools_details = School::where('school_name', trim($request->input('school_name')))->where('school_category', $request->input('school_cat'))->select('id')->first();

            if (empty($request->course) && !empty($schools_details->id)) {
                $school = School::find($schools_details->id);
                $schoolcourses = Course::where('school_id', $school->id)->first();
                if (!empty($schoolcourses->id)) {
                    $data['course'] = $schoolcourses->id;
                    //$request = collect($data);
                }
            }
        }

 
        $userRole = "student";
        $user = User::find(session('userId'));
        $userRole = $user->userRole->role->slug;

        if ($userRole == 'tutor') {
            $validator = Validator::make($data, [
                        'tutor_subject' => 'required|regex:/^[a-zA-Z0-9_\-]*$/|max:150',
                        'school_name' => 'required|string|max:255',
            ],[
				'tutor_subject.regex' => "Subject Name contains <li>The subject name must contain alphanumeric characters only</li>",
			]);
        } else {
            $validator = Validator::make($data, [
                        'course' => 'required',
                        'school_cat' => 'required',
                        'class_level' => 'required',
                        'school_name' => 'required|string|max:255',
            ]);
        }

        if (empty($schools_details)) {
            $schools_details = School::where('school_name', trim($request->input('school_name')))->where('school_category', $request->input('school_cat'))->select('id')->first();
        }

        if ($validator->fails()) {
            return redirect()->route('registerStep', 3)->withErrors($validator)->withInput();
        }


        if (!isset($schools_details->id) && empty($schools_details->id)) {
            session()->flash('invalid_school', 'Invalid School Name!');
            return redirect()->route('registerStep', 3);
        }
        if ($userRole == 'tutor') {
            $tutor = Tutor::where('user_id', session('userId'))->first();
            $tutor->school_id = $schools_details->id;
            $tutor->tutor_subject = $request->tutor_subject;
            $tutor->save();
        } else {
            $student = Student::where('user_id', session('userId'))->first();
            $student->school_id = $schools_details->id;
            $student->course_id = $data['course'];
            $student->school_category = $data['school_cat'];
            $student->class_id = $data['class_level'];
            $student->save();
        }

        return redirect()->route('registerStep', 4);
    }

    /**
     * Save user avatar or image after validate mobile.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function step4(Request $request)
    {

        if (!empty(session('userId'))) {
            $sessionUser = User::find(session('userId'));
        } else {
            return redirect('/register')->with('jsError', "Please complete first step before you can access next steps");
        }
        //dd($request->all());
        $userRole = "student";
        $user = User::find(session('userId'));
        $userRole = $user->userRole->role->slug;


        //tutor

        if ($userRole == 'tutor') {
            /** Below code for save tutor image * */
            $destinationPath = public_path('/uploads/tutor/');
            $oldImagePath = $sessionUser->userData->profile_image;
            $student = Tutor::where('user_id', $sessionUser->id)->first();
        } else {
            /** Below code for save student image * */
            $destinationPath = public_path('/uploads/student/');
            $oldImagePath = $sessionUser->userData->profile_image;
            $student = Student::where('user_id', $sessionUser->id)->first();
        }

        if (empty($request->input('avatarImage'))) {
            $validator = Validator::make($request->all(), [
                        'user_image' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->route('/register', 3)->withErrors($validator)->withInput();
            }


            $newName = '';

            if ($request->hasFile('user_image')) {
                $fileName = $request->all()['user_image']->getClientOriginalName();
                $file = request()->file('user_image');
                $fileNameArr = explode('.', $fileName);
                $fileNameExt = end($fileNameArr);
                $newName = date('His') . rand() . time() . '__' . $fileNameArr[0] . '.' . $fileNameExt;

                $file->move($destinationPath, $newName);

                //** Below commented code for resize the image **//

                /* $user_config = json_decode(options['user'],true);

                  $img = Image::make(public_path('/uploads/users/'.$newName));
                  $img->resize($user_config['image']['width'], $user_config['image']['height']);
                  $img->save(public_path('/uploads/users/'.$newName)); */

                //** Below code for unlink old image **//
                $oldImage = public_path($oldImagePath);
                if (!empty($oldImagePath) && file_exists($oldImage) && @getImageSize(url($oldImagePath))) {
                    unlink($oldImage);
                }
            }
            if ($userRole == 'tutor') {
                $imagePath = 'uploads/tutor/' . $newName;
            } else {
                $imagePath = 'uploads/student/' . $newName;
            }
            $student->profile_image = $imagePath;
        } else {
            $avatar_id = $request->input('avatarImage');
            $student->avatar_id = $avatar_id;
        }
        $student->save();
        session()->forget('newCustomer');
        session()->forget('userId');
        return redirect('/login')->with('jsSuccess', "Successfully created your account.");
    }

    public function redirectTo()
    {
        return $this->redirectTo;

        /* Bellow commented code for check extra condition before redirection */

        /* if(empty(auth()->user()->mobile_verified_at)){
          auth()->logout();

          \Session::flash('success', 'Registration successfully, we have sent a verification link to your email for activate your profile.!');

          return 'login';
          }else{
          return RouteServiceProvider::HOME;
          } */
    }

    /**
     * verify user by email vedrification link.
     *
     * @redirect to login
     */
    public function verifyUser($token)
    {
        $verifyUser = DB::table('users')->where('token', $token)->first();

        if (isset($verifyUser)) {
            if (empty($verifyUser->email_verified_at)) {
                DB::table('users')->where('token', $token)->update(['email_verified_at' => Carbon::now()]);
                $status = "Your account is verified. You can now login.";
            } else {
                $status = "Your account is already verified. You can now login.";
            }
            return redirect('/login')->with('success', $status);
        } else {
            return redirect('/login')->with('error', "Sorry your verification token not valid.");
        }
    }

}
