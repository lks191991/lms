<?php

namespace App\Http\Controllers\API;

use App\Models\ReportVideo;
use App\Models\StudentHistory;
use Illuminate\Http\Request;
use App\Mail\sendMailToStudent;
use App\Models\Classes;
use App\Models\Classroom;
use App\Models\Countries;
use App\Models\Course;
use App\Models\Note;
use App\Models\Period;
use App\Models\Question;
use App\Models\School;
use App\Models\SchoolCategory;
use App\Models\Setting;
use App\Models\Student;
use App\Models\StudentDownload;
use App\Models\StudentFavourites;
use App\Models\StudentVideo;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Tutor;
use App\User;
use App\Models\Video;
use App\Helpers\SiteHelpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;
use Image;
use Validator;
use Vimeo\Laravel\Facades\Vimeo;

//use Image;
//use Str;

//use App;

class UserController extends APIController
{
	public $successStatus = 200;
	public $createdStatus = 201;
    public $invalidInputStatus = 400;
	public $unauthorizedStatus = 401;
    public $forbiddenStatus = 403;
    public $notFoundStatus = 404;
    public $alreadyExistsStatus = 409;
    public $existsStatus = 422;
    public $userstatusinactive = 997;
    public $usernotverified = 998;
    public $errorStatus = 999;

	/**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login() {
		$success_msg = __('messages.user_loggedin_successfully');
		$error_msg = __('messages.login_error.invalid_credentials');
		$data = new \stdClass();
		$message = __('messages.login_error.login_failed');
		$status = $this->forbiddenStatus;
        if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){
            $user = Auth::user();

			if($user->status == 1 && $user->deleted_at === NULL &&$user->mobile_verified_at !== NULL ){
				$message = $success_msg;
				$status = $this->createdStatus;

				$user->device_type = request('platform');
				$user->device_token = request('device_token');
				$user->save();

				$client = new \GuzzleHttp\Client();
				$getToken = $client->post(url('/oauth/token'), [
					'form_params' => [
						'grant_type' => 'password',
						'client_id' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_ID'),
						'client_secret' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET'),
						'username' => request('username'),
						'password' => request('password'),
						'scope' => '',
					],
				]);
				$tokenData = json_decode((string) $getToken->getBody(), true);

				//$user->accesstoken = $user->createToken('XtraClass Password Grant Client')->accessToken;
				//pr($user)l
				/*if($user->hasRole(['student'])) {
					$userData = $user->load('student')->toArray();
				} else {
					$userData = $user->toArray();
				}*/
				$respData['access'] = $tokenData['access_token'];
				$respData['refresh'] = $tokenData['refresh_token'];

				return $this->respondCreated([
					'statusCode' => $status,
					'message' => "",
					'data' => $respData,
				]);
			} else if($user->status == 0 && $user->email_verified_at !== NULL) {
				$message = __('messages.login_error.account_deactivated');
				$status = $this->userstatusinactive;
			} else if($user->email_verified_at === NULL) {
				$message = __('messages.login_error.email_not_verified');
				$status = $this->usernotverified;
			}
        } else{
			$message = $error_msg;
			$status = $this->forbiddenStatus;
        }
		return $this->respondCreated([
			'statusCode' => $status,
			'message' => "",
			'data' => $data,
		]);
    }

	/**
     * refresh_token api
     *
     * @return \Illuminate\Http\Response
     */
    public function refresh_token(Request $request) {
		$client = new \GuzzleHttp\Client();
		$getToken = $client->post(url('/oauth/token'), [
			'form_params' => [
				'grant_type' => 'refresh_token',
				'refresh_token' => request('refresh'),
				'client_id' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_ID'),
				'client_secret' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET'),
				'scope' => '',
			],
		]);
		$tokenData = json_decode((string) $getToken->getBody(), true);

		$respData['access'] = $tokenData['access_token'];
		$respData['refresh'] = $tokenData['refresh_token'];

		return $this->respondCreated([
			'statusCode' => $this->createdStatus,
			'message' => '',
			'data' => $respData,
		]);
    }

	/**
     * get_device api
     *
     * @return \Illuminate\Http\Response
     */
    public function save_device(Request $request) {
		$user_id = Auth::user()->id;
		$data = $request->all();

		$user = User::where('id', $user_id)->first();
		if(!empty($user)) {
			$user->device_token = $data['device_token'];
			$user->device_type = $data['platform'];

			if($user->save()){
				$respData = array();
				return $this->respondCreatedWithData([
					'statusCode' => $this->createdStatus,
					'message' => '',
					'data' => new \stdClass(),
				]);
			} else{
				return $this->respondCreated([
					'statusCode' => $this->errorStatus,
					'message' => '',
					'data' => new \stdClass(),
				]);
			}
		}

		return $this->respondCreated([
			'statusCode' => $this->unauthorizedStatus,
			'message' => '',
			'data' => new \stdClass(),
		]);
    }

	/**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request,$id=null) {
		$data = $request->all();

		/*if($data['phone'] != '') {
			$expPhone = explode('-', $data['phone']);
			if(count($expPhone) > 1) {
				$data['mobile'] = trim($expPhone[1]);
				$data['phone_code'] = ltrim(trim($expPhone[0]), '+');
			} else {
				$data['mobile'] = trim($expPhone[0]);
				$data['phone_code'] = 0;
			}
		}*/

		if(($data['username'] != '' && User::where('username', $data['username'])->withTrashed()->exists()) || ($data['phone'] != '' && Student::where('mobile', $data['phone'])->exists())) {
			return $this->respondCreated([
				'statusCode' => $this->existsStatus,
				'message' => '',
				'data' => new \stdClass(),
			]);
		}

		$data['email'] = (isset($data['email']) && $data['email'] != '') ? $data['email'] : null;

		$validation = $this->validateUser($data);

		if ($validation->fails()) {
			return $this->throwValidation($validation->messages()->first());
        }
		$success_msg = __('messages.user_registered_successfully');
		$error_msg = __('messages.user_signup_failed');

		//** Below code for set user obj value set**/
		$data['otp'] = mt_rand(10000, 99999);
		$user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $role = DB::table('roles')->where('slug', '=', 'student')->first();  //choose the default role upon user creation.

		/* Below code for assign user role */
        $user->attachRole($role, $user->id);

		$data['phone_code'] = $data['country_code'];
		$data['mobile'] = $data['phone'];

		/* Below code for save student data */
        $user->insertStudent($user, $data);

		$userData['uuid'] = $user->uuid;


		/* Below code for send otp to student */
		SiteHelpers::updateOtp($user->id, $data['phone_code'], $data['mobile'], $data['otp']);
		//$sendOtp = SiteHelpers::sendOtpToUser($data['phone_code'], $data['mobile'], $data['otp']);

		//Already exists
		//Auth::loginUsingId($user->id, true);

		//$user->accesstoken = $user->createToken('XtraClass Password Grant Client')->accessToken;
		//pr($user)l
		/*if($user->hasRole(['student'])) {
			$userData = $user->load('student')->toArray();
		} else {
			$userData = $user->toArray();
		}*/

		return $this->respondCreatedWithData([
			'statusCode' => $this->createdStatus,
			'message' => "",
			'data' => $userData,
		]);
    }

	/**
     * verify user otp
     * @param Request $request
     * @return Validator object
     */
    public function confirm_phone(Request $request) {
        $data = $request->all();

        $validator = Validator::make($request->all(), [
			'mobile' => 'required|numeric|exists:students,mobile',
			'uuid' => 'required|string|exists:users,uuid',
		]);

        if ($validator->fails()) {
            return $this->throwValidation($validator->messages()->first());
        }

        $user = User::uuid($data['uuid']);
        $student = Student::where('mobile', $data['mobile'])->first();
        if (isset($user->id) && !empty($user->id) && isset($student->id) && !empty($student->id)) {
			if ($data['is_mobile_verified']) {
                User::where('id', $student->user_id)->update(['mobile_verified_at' => Carbon::parse($data['verified_on'])->format('Y-m-d H:i:s')]);
				//delete verified passcode
				DB::table('mobile_otp')->where('user_id', $student->user_id)->delete();
				return $this->respondCreated([
					'statusCode' => $this->createdStatus,
					'message' => '',
					'data' => ['uuid' => $user->uuid],
                ]);
            } else {
                return $this->respondCreated([
					'statusCode' => $this->invalidInputStatus,
					'message' =>  '',
					'data' => [],
                ]);
            }
        } else {
            return $this->respondCreated([
				'statusCode' => $this->unauthorizedStatus,
				'message' => '',
				'data' => new \stdClass(),
            ]);
        }
    }

	/**
     * verify user otp
     * @param Request $request
     * @return Validator object
     */
    public function verifysignupotpDepreceated(Request $request) {
        $data = $request->all();

        $validator = Validator::make($request->all(), [
			'mobile' => 'required|numeric|unique:students,mobile,'.Auth::user()->student->id,
			'otp' => 'required|numeric',
		]);

        if ($validator->fails()) {
            return $this->throwValidation($validator->messages()->first());
        }

        $student = Student::where('mobile', $data['mobile'])->first();
        if (isset($student->id) && !empty($student->id)) {
			$otpdetails = DB::table("mobile_otp")->where('user_id', $student->user_id)->first();

            if (isset($otpdetails->otp) && !empty($otpdetails->otp) && ($otpdetails->otp == $data['otp'])) {
                User::where('id', $student->user_id)->update(['mobile_verified_at' => Carbon::now()]);
				//delete verified passcode
				DB::table('mobile_otp')->where('user_id', $student->user_id)->delete();
				return $this->respondCreated([
					'statusCode' => 200,
					'message' => __('messages.passcode_vefified_successfully'),
					'data' => new \stdClass(),
                ]);
            } else {
                return $this->respondCreated([
					'statusCode' => 999,
					'message' =>  __('messages.passcode_mismatch'),
					'data' => new \stdClass(),
                ]);
            }
        } else {
            return $this->respondCreated([
				'statusCode' => 999,
				'message' => __('messages.invalid_record'),
				'data' => new \stdClass(),
            ]);
        }
    }

	/**
     * step 2 of registration
     * @param Request $request
     * @return Validator object
     */
    public function save_academic_info(Request $request) {
        $data = $request->all();
		$user_id = $data['uuid'];

		$user = User::uuid($data['uuid']);
        if (isset($user->id) && !empty($user->id)) {
			if(isset($data['school_id']) && !empty($data['school_id'])) {
				$school = School::where('uuid',$data['school_id'])->first();
				if(!empty($school)) {
					if($school->school_category == School::BASIC_SCHOOL) {
						$schoolcourses = Course::where('school_id', $school->id)->first();
						if (!empty($schoolcourses->id)) {
							$data['course_id'] = $schoolcourses->uuid;
						}
					}

					$validator = Validator::make($data, [
						'uuid' => 'required|string|exists:users,uuid',
						'institution_id' => 'required|string|exists:school_categories,uuid',
						'school_id' => 'required|string|exists:schools,uuid',
						'course_id' => 'required|string|exists:courses,uuid',
						'class_id' => 'required|string|exists:classes,uuid',
					]);
					if ($validator->fails()) {
						return $this->throwValidation($validator->messages()->first());
					}
					if (Student::where('user_id', $user->id)->exists()) {
						$student = Student::where('user_id', $user->id)->first();

						$institution = SchoolCategory::where('uuid', $data['institution_id'])->select('id')->first();
						$school = School::where('uuid', $data['school_id'])->select('id')->first();
						$course = Course::where('uuid', $data['course_id'])->select('id')->first();
						$class = Classes::where('uuid', $data['class_id'])->select('id')->first();

						$student->school_category = $institution->id;
						$student->school_id = $school->id;
						$student->course_id = $course->id;
						$student->class_id = $class->id;
						$student->save();

						return $this->respondCreated([
							'statusCode' => $this->createdStatus,
							'message' => '',
							'data' => ['uuid' => $user->uuid],
						]);
					} else {
						return $this->respondCreated([
							'statusCode' => $this->invalidInputStatus,
							'message' => __('messages.invalid_record'),
							'data' => [],
						]);
					}
				} else {
					return $this->respondCreated([
						'statusCode' => $this->invalidInputStatus,
						'message' => '',
						'data' => [],
					]);
				}
			} else {
				return $this->respondCreated([
					'statusCode' => $this->invalidInputStatus,
					'message' => '',
					'data' => [],
				]);
			}
		} else {
            return $this->respondCreated([
				'statusCode' => $this->unauthorizedStatus,
				'message' => __('messages.invalid_record'),
				'data' => new \stdClass(),
            ]);
        }
    }

	/**
     * Save user avatar or image after validate mobile.
     *
     * @param  array  $data
     * @return \App\User
     */
	public function save_avatar(Request $request){
		$data = $request->all();
		$user_id = $data['uuid'];

		if (User::where('uuid', $user_id)->exists()) {
			$user = User::uuid($data['uuid']);
			$student = Student::where('user_id', $user->id)->first();

			if ($request->hasFile('avatar_image')) {
				$validator = Validator::make($data, [
					'avatar_image' => 'required|mimes:jpeg,jpg,png',
				]);

				if ($validator->fails()) {
					return $this->throwValidation($validator->messages()->first());
				}

				/** Below code for save student image **/
				$destinationPath = public_path('/uploads/student/');
				$oldImagePath = $student->profile_image;
				$newName = '';
				if ($request->hasFile('avatar_image')) {
					$fileName = $data['avatar_image']->getClientOriginalName();
					$file = request()->file('avatar_image');
					$fileNameArr = explode('.', $fileName);
					$fileNameExt = end($fileNameArr);
					$newName = date('His').rand() . time() . '.' . $fileNameExt;

					$file->move($destinationPath, $newName);

					//** Below code for unlink old image **//
					$oldImage = public_path($oldImagePath);
					if(!empty($oldImagePath) && @getImageSize(url($oldImagePath)) && file_exists($oldImage)) {
						unlink($oldImage);
					}
					$imagePath = 'uploads/student/'.$newName;
					$student->profile_image = $imagePath;
				}
			}else{
				$validator = Validator::make($data, [
					'avatar_id' => 'required|string|exists:avatars,uuid',
				]);

				if ($validator->fails()) {
					return $this->throwValidation($validator->messages()->first());
				}

				$avatar = DB::table('avatars')->where('uuid', $data['avatar_id'])->select('id')->first();
				$student->avatar_id = $avatar->id;
			}
			$student->save();

			return $this->respondCreated([
					'statusCode' => $this->createdStatus,
					'message' => '',
					'data' => new \stdClass(),
				]);
		} else {
			return $this->respondCreated([
				'statusCode' => $this->unauthorizedStatus,
				'message' => '',
				'data' => new \stdClass(),
            ]);
		}
	}

	/**
     * send email passcode to user email
     * @param Request $request
     * @return Validator object
     */
    public function forgot_password(Request $request) {
		$data = $request->all();
        $validation = Validator::make($request->all(), [
			'email' => 'required|email',
        ]);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

		$options = Option::getOption();
        $user = User::select(["id", "email", "name", "lastname"])->where('email', $data['email'])->first();
        if (!isset($user->id) && empty($user->id)) {
            return $this->respondCreated([
				'statusCode' => 999,
				'message' => __('messages.no_record_found_with_email'),
				'data' => new \stdClass(),
            ]);
        }

        $user_id = $user->id;
        $length = 6;
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $passcode = substr(str_shuffle($chars), 0, $length);

		$passcode_exists = DB::table('password_resets')->where('email', $user->email)->count();

        if ($passcode_exists > 0) {
			DB::table('password_resets')->where('email', $user->email)->update([
                        'email' => $user->email, 'token' => $passcode, 'created_at' => date('Y-m-d H:i:s')
                    ]);
        } else {
            DB::table('password_resets')->insert([
                        'email' => $user->email, 'token' => $passcode, 'created_at' => date('Y-m-d H:i:s')
                    ]);
        }

		//Send mail
		$mailTemplate = EmailTemplate::where('id',9)->first();
		if(!empty($mailTemplate) && $mailTemplate->content != ''){
			$mail_from_email = $options['mail_from_email'];
			$mail_from_name = $options['mail_from_name'];
			$admin_name = $options['admin_name'];
			$sitename = $options['site_name'];
			$site_footer = $options['site_footer'];
			$to = $user->email;

			$mailContent = $mailTemplate->content;
			$mailContent = str_replace("##NAME##", $user->name . ' ' . $user->lastname, $mailContent);
			$mailContent = str_replace("##PASSCODE##", $passcode, $mailContent);
			$mailContent = str_replace("##SITEURL##", url('/'), $mailContent);
			$mailContent = str_replace("##SITENAME##", $sitename, $mailContent);
			$mailContent = str_replace("##COPYRIGHT##", $site_footer, $mailContent);

			\Mail::send(['html' => 'emails.emailTemplate'], ['content' => $mailContent], function ($message) use ($to, $mail_from_email, $mail_from_name, $mailTemplate, $mailContent) {
				$message->from($mail_from_email, $mail_from_name);
				$message->to($to)->subject($mailTemplate->subject);
			});
		}
		//Send mail

        return $this->respondCreated([
			'statusCode' => 200,
			'message' => __('messages.check_mail_for_passcode'),
			'data' => array("email" => $user->email),
        ]);
    }

	/**
     * get fan details api
     *
     * @return \Illuminate\Http\Response
     */
    public function get_user_profile() {
		$user = Auth::user();
		$user_id = Auth::user()->id;

		if (Auth::user()->userRole->role->slug == 'student') {
			$userData = DB::table('users')->where('users.id', $user_id)
				->join('students', 'users.id', '=', 'students.user_id')
				->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
				->leftJoin('avatars', 'students.avatar_id', '=', 'avatars.id')
				->leftJoin('countries', 'students.country', '=', 'countries.phonecode')
				/*->leftJoin('schools', function($join) {
					$join->on('schools.id', '=', 'students.school_id');
					$join->where('students.school_id', '>', 0);
				})*/
				->leftJoin('school_categories', 'school_categories.id', '=', 'students.school_category')
				->leftJoin('schools', 'schools.id', '=', 'students.school_id')
				->leftJoin('courses', 'courses.id', '=', 'students.course_id')
				->leftJoin('classes', 'classes.id', '=', 'students.class_id')
				->select(['users.id', 'users.uuid', 'users.email', 'users.username', 'role_user.role_id as usertype', 'students.first_name', 'students.last_name', 'mobile as phone', 'country', 'profile_image', 'avatars.file_url', 'countries.name as country_name', 'school_categories.uuid as institution_id', 'schools.school_category as cat_id', 'schools.uuid as school_id', 'courses.id as co_id', 'courses.uuid as course_id', 'classes.uuid as class_id'])
				->first();

			if($userData->profile_image != "" && file_exists(public_path('/'.$userData->profile_image)) && is_file(public_path('/'.$userData->profile_image))) {
				$userData->profile_image = url('/') . '/' . $userData->profile_image;
			} else {
				$userData->profile_image = url('/') . '/' . $userData->file_url;
			}
			$userData->department_id = '';
			if($userData->cat_id == School::UNIVERSITY && $userData->course_id != ''){
				$getDepartment = Course::where('courses.uuid', $userData->course_id)
						->leftJoin('departments', 'departments.id', '=', 'courses.department_id')
						->select('departments.uuid as department_id')->first();
				if(!empty($getDepartment)) {
					$userData->department_id = $getDepartment->department_id;
				}
			}
			$userData->role = 'student';
			$student_videos = StudentVideo::where('student_id', $userData->id)->pluck('video_id', 'video_id');
			$userData->stat_classes_watched = Video::whereIn('id', $student_videos)->count();
			$userData->stat_questions = Question::where('sender_id', $userData->id)->where('type', 'question')->count();
			$userData->stat_answers = Question::where('sender_id', $userData->id)->where('type', 'reply')->count();
			$userData->stat_downloads = StudentDownload::where([
						'student_id' => $userData->id,
						'status' => 1
					])->count();
            $userData->classes_hosted = 0;
            $userData->notes_added = 0;

			//$userData->lessons_followed = Classes::where('status', 1)->where('course_id', $userData->co_id)->orderBy('class_name', 'asc')->pluck("class_name", "id");
			unset($userData->id, $userData->file_url, $userData->cat_id, $userData->co_id );
			$userData->id = $userData->uuid;
			unset($userData->uuid);
        } else if (Auth::user()->userRole->role->slug == 'tutor') {
			$userData = DB::table('users')->where('users.id', $user_id)
				->join('tutors', 'users.id', '=', 'tutors.user_id')
				->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
				->leftJoin('avatars', 'tutors.avatar_id', '=', 'avatars.id')
				->leftJoin('countries', 'tutors.country', '=', 'countries.phonecode')
				->leftJoin('schools', 'schools.id', '=', 'tutors.school_id')
				->select(['users.id', 'users.uuid', 'users.email', 'users.username', 'role_user.role_id as usertype', 'tutors.first_name', 'tutors.last_name', 'mobile as phone', 'country', 'profile_image', 'tutors.school_id as sch_id','avatars.file_url', 'countries.name as country_name', 'schools.school_category as cat_id', 'schools.uuid as school_id'])
				->first();

			if($userData->profile_image != "" && file_exists(public_path('/'.$userData->profile_image)) && is_file(public_path('/'.$userData->profile_image))) {
				$userData->profile_image = url('/') . '/' . $userData->profile_image;
			} else {
				$userData->profile_image = url('/') . '/' . $userData->file_url;
			}
			$student_videos = StudentVideo::where('student_id', $userData->id)->pluck('video_id', 'video_id');
            $userData->stat_classes_watched = 0;
            $userData->stat_questions = Question::where('sender_id', $userData->id)->where('type', 'question')->count();
            $userData->stat_answers = Question::where('sender_id', $userData->id)->where('type', 'reply')->count();
            $userData->stat_downloads = 0;
			$userData->classes_hosted = Video::whereIn('id', $student_videos)->groupBy('class_id')->count();
			$userData->notes_added = Video::where([
						'tutor_id' => $userData->id,
						'status' => 1
					])->groupBy('topic_id')->count();

			$tutorSchoolCategory = $userData->cat_id;
			$tutorSchoolId = $userData->sch_id;
			$schoolCategory = SchoolCategory::find($tutorSchoolCategory);
			$userData->institution_id = $schoolCategory->uuid;

			$tutorVideos = Video::where('status',1)
								->where('vimeo_status','=','complete')
								->where('tutor_id', $userData->id)
								->select('id', 'tutor_id', 'uuid')
								->get();

			$videos = [];
			if(!empty($tutorVideos)) {
				foreach($tutorVideos as $k => $v) {
					$videos[] = $v['uuid'];
					$videosIds[] = $v['id'];
				}
			}
			$userData->video_ids = $videos;
			$userData->role = 'teacher';
			/*
			$schoolCategoryName = '';
			$defaultArray = array('deparments' => array(), 'courses' => array(), 'classes' => array());

			if ($tutorSchoolCategory == School::BASIC_SCHOOL) {
				$school = School::find($tutorSchoolId);
				if (!empty($school->coursesList[0])) {
					$course = $school->coursesList[0];
					$course_id = $course->id;

					$defaultArray['classes'] = Classes::where('status', 1)->where('course_id', $course_id)->orderBy('class_name', 'asc')->pluck("class_name", "id");
				}
				$schoolCategoryName = 'BASIC_SCHOOL';
			} else if ($tutorSchoolCategory == School::SENIOR_HIGH) {
				$defaultArray['courses'] = Course::where('status', 1)->where('school_id', $tutorSchoolId)->orderBy('name', 'asc')->pluck("name", "id");
				$schoolCategoryName = 'SENIOR_HIGH';
			} else if ($tutorSchoolCategory == School::UNIVERSITY) {

				$defaultArray['deparments'] = Department::where('status', 1)
						->where('school_id', $tutorSchoolId)
						->pluck("name", "id");

				$schoolCategoryName = 'UNIVERSITY';
			}
			$starShow = $this->tutorStar($userData->id);
			*/
			unset($userData->id, $userData->file_url, $userData->cat_id, $userData->sch_id );
			$userData->id = $userData->uuid;
			unset($userData->uuid);
        }

		return $this->respondCreated([
				'statusCode' => $this->successStatus,
				'message' => '',
				'data' => $userData,
			]);
    }

	public function tutorStar($tutor_id)
	{
		$silverDec = 'silver';
		$bronzeDec = 'bronze';
		$blueDec   = 'blue';
		$yellowDec = 'yellow';

		$count = Video::where([
                    'tutor_id' => $tutor_id,
                    'status' => 1
                ])->count();


		return (object) array(
				'silverCount'   => 1+$this->generateStarCount($count,500),
				'silverDec'     => $silverDec,
				'bronzeCount'   => $this->generateStarCount($count,100),
				'bronzeDec'     => $bronzeDec,
				'blueCount'     => $this->generateStarCount($count,1000),
				'blueDec'       => $blueDec,
				'yellowCount'   => $this->generateStarCount($count,5000),
				'yellowDec'     => $yellowDec
		);
	}

	public function generateStarCount($count,$mnt){
		if(!empty($count) && !empty($mnt) && ($count >= $mnt)){
		    return round($count/$mnt,0);
		}else{
			return 0;
		}
	}

	/**
     * update_profile api
     *
     * @return \Illuminate\Http\Response
     */
    public function update_profile(Request $request) {
		$data = $request->all();
		$user = Auth::user();
		$user_id = Auth::user()->id;
		$user_role = Auth::user()->userRole->role->slug;

		if($user_role == 'student') {
			$data['email'] = (isset($data['email']) && $data['email'] != '') ? $data['email'] : null;
			if($user->userData->school_category == School::BASIC_SCHOOL) {
				$schoolcourses = Course::where('school_id', $user->userData->school_id)->first();
				if (!empty($schoolcourses->id)) {
					$data['course_id'] = $schoolcourses->uuid;
				}
			}
			$validation = $this->validateUser($data, 'edit', $user_id);

			if ($validation->fails()) {
				return $this->throwValidation($validation->messages()->first());
			}

			//** Below code for set user obj value set**/
            $course = Course::where('uuid', $data['course_id'])->select('id')->first();
            $class = Classes::where('uuid', $request->class_id)->select('id')->first();

			$update = Student::where('user_id', $user_id)->first();

			if ($request->has('password')) {
                $update->password = Hash::make( $request->password );
            }
			$update->first_name = $request->first_name;
			$update->last_name = $request->last_name;
			$update->email = $request->email;
			$update->username = $request->username;
			$update->class_id = $class->id;
			$update->course_id = $course->id;
			$update->save();

			$user = User::where('id', $user_id)->first();
			$user->email = $request->email;
			$user->username = $request->username;
			$user->save();

            return $this->respondCreated([
				'statusCode' => $this->successStatus,
				'message' => '',
				'data' => new \stdClass(),
			]);
		}
		return $this->respondCreated([
				'statusCode' => $this->unauthorizedStatus,
				'message' => '',
				'data' => new \stdClass(),
			]);
    }

	/**
     * update fan details api
     *
     * @return \Illuminate\Http\Response
     */
    public function update_avatar(Request $request) {
		$userid = Auth::user()->id;

		$validation = $this->validateAvatar($request);

		if ($validation->fails()) {
			return $this->throwValidation($validation->messages()->first());
        }

		$data = $request->all();
		$user = User::find($userid);
		if(!empty($user)) {
			$role_id = $user->role_id;
			$userRole = $user->userRole->role->slug;

			$success_msg = __('messages.user_updated_successfully');
			$error_msg = __('messages.user_update_failed');

			/** Below code for save image **/
			$uploadPath = public_path('/uploads/student/');
			$newName = '';
			if ($request->hasFile('file')) {
				$logo = $request->file('file');

				if ($userRole == 'tutor') {
					$uploadPath = public_path('/uploads/tutor/');
				}
				$logoName = time() . mt_rand(10, 100) . '.' . $logo->getClientOriginalExtension();

				if (!file_exists($uploadPath)) {
					mkdir($uploadPath);
				}
				$isMoved = $logo->move($uploadPath, $logoName);
				$img = Image::make($uploadPath . $logoName);

				$oldImageName = '';
				if ($userRole == 'tutor') {
					$update = Tutor::where('user_id', $user->id)->first();
					$oldImageName = $update->profile_image;
					$imagePath = 'uploads/tutor/'.$logoName;
					$update->profile_image = $imagePath;
					$update->save();

					$oldImage = public_path('/uploads/tutor/'.$oldImageName);
				} else {
					$update = Student::where('user_id', $user->id)->first();
					$oldImageName = $update->profile_image;
					$imagePath = 'uploads/student/'.$logoName;
					$update->profile_image = $imagePath;
					$update->save();

					$oldImage = public_path('/uploads/student/'.$oldImageName);
				}

				if($oldImageName != '' && @getimagesize($oldImage) && file_exists($oldImage)){
					unlink($oldImage);
				}

				$src = url($uploadPath . '/' . $logoName);
				$status = 1;
			}
			return $this->respondCreatedWithData([
					'statusCode' => $this->successStatus,
					'message' => '',
					'data' => new \stdClass(),
				]);
		} else{
			return $this->respondCreated([
				'statusCode' => $this->unauthorizedStatus,
				'message' => '',
				'data' => new \stdClass(),
			]);
		}
    }

	/**
     * change password
     * @param Request $request
     * @return Validator object
     */
    public function change_password(Request $request) {
        $userid = Auth::user()->id;

		$validation = $this->validatePassword($request);

		if ($validation->fails()) {
			return $this->throwValidation($validation->messages()->first());
        }

		$data = $request->all();
		$user = User::find($userid);
		if(!empty($user) && isset($user->id) && !empty($user->id)) {
			$user->password = bcrypt($data['new_password']);
			$user->save();

			return $this->respondCreated([
				'statusCode' => $this->successStatus,
				'message' => '',
				'data' => new \stdClass(),
            ]);
        } else {
			return $this->respondCreated([
				'statusCode' => $this->unauthorizedStatus,
				'message' => '',
				'data' => new \stdClass(),
			]);
        }
    }

	/**
     * artist details api
     *
     * @return \Illuminate\Http\Response
     */
    public function artist_details(Request $request) {
		$lang = request('lang');
		if(!$lang) {
			$lang = 1;
		}
		$artist_id = request('artist_id');
		$user_id = request('logged_user_id');
		$isArtist = User::checkIsArtist($artist_id);

		if($isArtist) {
			$is_follower = 0;
			if($user_id > 0) {
				$is_follower = DB::table('user_follows')->where('following_id', $artist_id)->where('user_id', $user_id)->count();
			}
			$db = User::where('users.id', $artist_id);

			$userData = $db
				->with(['shoutouts'  => function($query){
								$query->select('shoutouts.id', 'shoutouts.artist_id', 'shoutouts.shoutout_video', 'shoutouts.shoutout_video_thumb', 'shoutouts.video_caption')->orderBy('created_at', 'DESC')->limit(5);
							},
							'shoutouts.like' => function($query){
								$query->select(DB::raw('COUNT(id) AS like_count'), 'shoutout_id')->where('is_like', '1')->groupBy('shoutout_id');
							},
							'shoutouts.comment' => function($query){
								$query->select(DB::raw('COUNT(id) AS comment_count'), 'shoutout_id')->where('comment', '<>', '')->groupBy('shoutout_id');
							},
							/*'shoutouts.booking',*/ 'reviews' => function($query){
								$query->where('status', 1)->select('reviews.artist_id', DB::raw('avg(rating) average'), DB::raw('count(id) cnt'));
							}/*, 'user_follows' => function($query){
								$query->select(DB::raw('COUNT(following_id) AS follower_cnt'), 'user_follows.following_id');
							}, 'user_followings' => function($query){
								$query->select(DB::raw('COUNT(user_id) AS following_cnt'), 'user_follows.user_id');
							}*/])
				->join('profiles', 'users.id', '=', 'profiles.user_id')
				->join('category_user', 'users.id', '=', 'category_user.user_id', 'left outer')
				//->join('category_translations', 'category_user.category_id', '=', 'category_translations.category_id', 'left outer')
				->join('category_translations', function($join) use ($lang) {
					$join->on('category_user.category_id', '=', 'category_translations.category_id');
					$join->where('category_translations.language_id', '=', $lang);
				}, null, null, 'left outer')
				//->where('category_translations.language_id', $lang)
				->select(['users.id', DB::raw('CONCAT(users.name, " ", users.lastname) as name'), 'profiles.user_id', 'profiles.profile_title', 'profiles.short_description', 'profiles.booking_rate', 'profiles.avatar', 'profiles.self_intro_video', 'profiles.self_intro_video_thumb', 'profiles.is_featured', 'profiles.is_available', 'profiles.unavailable_from', 'profiles.unavailable_to', 'profiles.unavailable_options', 'category_user.category_id', 'category_user.user_id', 'category_translations.category_id', DB::raw('GROUP_CONCAT(category_user.category_id) as cat_ids'), DB::raw('GROUP_CONCAT(category_translations.category_name) as cat_names')])
				->first()->toArray();

			$userData['is_follower'] = $is_follower;
			$userData['response_time'] = User::getAvgResponseTime($artist_id);
			$userData['avg_rating'] = 0;
			if(!empty($userData['reviews']) && isset($userData['reviews'][0]) && !empty($userData['reviews'][0])) {
				$avg_rating = $userData['reviews'][0]['average'];
				$avg_rating = floor($avg_rating * 2) / 2;

				$userData['avg_rating'] = $avg_rating;
			}
			$userData['cat_names'] = (is_null($userData['cat_names'])) ? '' : $userData['cat_names'];
			$userData['profile_title'] = (is_null($userData['profile_title'])) ? '' : $userData['profile_title'];
			if($userData['avatar'] != "" && file_exists(public_path('uploads/users/thumb/') . $userData['avatar'])) {
				$userData['avatar'] = url('/uploads/users/thumb/'.$userData['avatar']);
			} else {
				$userData['avatar'] = url('/img/no-avatar.jpg');
			}
			if($userData['self_intro_video'] != "" && file_exists(public_path('uploads/artists/videos/') . $userData['self_intro_video'])) {
				$userData['self_intro_video'] = url('/uploads/artists/videos/'.$userData['self_intro_video']);
			} else {
				$userData['self_intro_video'] = "";
			}
			if($userData['self_intro_video_thumb'] != "" && file_exists(public_path('uploads/artists/videos/') . $userData['self_intro_video_thumb'])) {
				$userData['self_intro_video_thumb'] = url('/uploads/artists/videos/'.$userData['self_intro_video_thumb']);
			} else {
				$userData['self_intro_video_thumb'] = "";
			}

			if($userData['is_available'] == 1) {
				$userData['unavailable_from'] = "";
				$userData['unavailable_to'] = "";
				$userData['unavailable_options'] = "";
			} else {
				$today = date('Y-m-d');
				$unavailable_from = date('Y-m-d', strtotime($userData['unavailable_from']));
				$unavailable_to = date('Y-m-d', strtotime($userData['unavailable_to']));

				if($today >= $unavailable_from && $today <= $unavailable_to) {
					$userData['is_available'] = 0;
				} else {
					$userData['is_available'] = 1;
				}
				$userData['unavailable_from'] = $unavailable_from;
				$userData['unavailable_to'] = $unavailable_to;
				$userData['unavailable_options'] = $userData['unavailable_options'];
			}

			if(!empty($userData['shoutouts'])) {
				foreach($userData['shoutouts'] as $k => $shoutout) {
					$userData['shoutouts'][$k]['shoutout_video'] = url('/uploads/shoutouts/'.$shoutout['shoutout_video']);

					if($shoutout['shoutout_video_thumb'] != "" && file_exists(public_path('uploads/shoutouts/') . $shoutout['shoutout_video_thumb'])) {
						$userData['shoutouts'][$k]['shoutout_video_thumb'] = url('/uploads/shoutouts/'.$shoutout['shoutout_video_thumb']);
					} else {
						$userData['shoutouts'][$k]['shoutout_video_thumb'] = "";
					}

					$userData['shoutouts'][$k]['video_caption'] = (is_null($userData['shoutouts'][$k]['video_caption'])) ? '' : $userData['shoutouts'][$k]['video_caption'];

					if(!empty($shoutout['like']) && !empty($shoutout['like'][0])) {
						$userData['shoutouts'][$k]['like_cnt'] = $shoutout['like'][0]['like_count'];
					} else {
						$userData['shoutouts'][$k]['like_cnt'] = 0;
					}

					if(!empty($shoutout['comment']) && !empty($shoutout['comment'][0])) {
						$userData['shoutouts'][$k]['comment_count'] = $shoutout['comment'][0]['comment_count'];
					} else {
						$userData['shoutouts'][$k]['comment_count'] = 0;
					}

					unset($userData['shoutouts'][$k]['like'], $userData['shoutouts'][$k]['comment']);
				}
			}
			unset($userData['cat_ids']);
			unset($userData['category_id']);
			unset($userData['reviews']);

			//details of User who has signed up as artist + fans who are also artists
			/*$userData = User::where('id', $user_id)->with(['profile' => function($query){
                            $query->select(['user_id', 'short_description', 'dob', 'avatar', 'booking_rate']);
						}, 'categories' => function($query) use ($lang){
							$query->select(['categories.id', 'category_translations.category_id', 'category_translations.category_name'])
							->where('category_translations.language_id', $lang)
							->join('category_translations', 'categories.id', '=', 'category_translations.category_id');
						}, 'shoutouts', 'shoutouts.booking', 'reviews' => function($query){
                            $query->where('status', 1)->select('reviews.artist_id', DB::raw('avg(rating) average'), DB::raw('count(id) cnt'));
						}])
						//->select(['users.id', 'role_id', 'name', 'credit_balance'])->firstOrFail();
						->select(['users.id', 'role_id', 'name', 'credit_balance'])->get()->toArray();*/
		}

		return $this->respondCreated([
				'statusCode' => $this->successStatus,
				'message' => '',
				'data' => $userData,
			]);
        //return response()->json(['data'=>$user, 'message' => ''], $this->successStatus);
    }

	/**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
		return response()->json([
            'message' => __('messages.logged_out_successfully')
        ]);
    }

	/**
     * Get all Avatars
     *
     * @return [object]
     */
    public function list_avatars(Request $request)
    {
		$lang = request('lang');
		if(!$lang) {
			$lang = 1;
		}
		$avatarPath = url('/') . '/';
		$avatars = DB::table('avatars')->where(['status' => 1])->select('uuid as id', DB::raw('CONCAT("'.$avatarPath.'", "", file_url) as image_url'))->orderBy('avatar_name', 'ASC')->get()->toArray();

		return $this->respondCreated([
				'statusCode' => $this->successStatus,
				'message' => '',
				'data' => $avatars,
			]);
    }

	/**
     * Get all Countries
     *
     * @return [object]
     */
    public function list_countries(Request $request)
    {
		$lang = request('lang');
		if(!$lang) {
			$lang = 1;
		}

		$countries = DB::table('countries')->where(['status' => 1])->select('id', 'uuid', 'phonecode', 'name')->orderBy('name', 'ASC')->get()->toArray();

		return $this->respondCreated([
				'statusCode' => $this->successStatus,
				'message' => '',
				'data' => $countries,
			]);
    }

	/**
     * student class history api
     *
     * @return \Illuminate\Http\Response
     */
    public function class_history() {
		$user_id = Auth::user()->id;
		$page_no = request('page_no');

		$setting = Setting::where('key_name','records_per_page')->first();

		$limit = $setting->val;
		$page = 1;
		if(isset($page_no) && $page_no != '') {
			$page = $page_no;
		}
		$offset = ($page-1) * $limit;

		if (User::where('id', '=', $user_id)->exists()) {
			$get_class_history = User::where('users.id', $user_id)
				->leftJoin('student_history', 'student_history.student_id','=','users.id')
				->leftJoin('videos',function($join){
					$join->on('student_history.video_id','=','videos.id')
						->where('videos.status','=','1');
				})
				->leftJoin('classes', 'videos.class_id','=','classes.id')
				->leftJoin('schools', 'classes.school_id','=','schools.id')
				->leftJoin('periods', 'videos.period_id','=','periods.id')
				->leftJoin('subjects', 'videos.subject_id','=','subjects.id')
				->leftJoin('tutors',function($join){
					$join->on('videos.tutor_id','=','tutors.user_id');
				})
				->leftJoin('users as u', 'tutors.user_id','=','u.id')
				//->leftJoin('tutors', 'videos.tutor_id','=','tutors.user_id')
				->leftJoin('notes', 'videos.note_id','=','notes.id')
				->select('student_history.id as id', 'videos.uuid as lesson_id', 'classes.uuid as class_id', 'periods.uuid as period_id', 'subjects.subject_name as subject', 'videos.description', 'videos.video_id as vimeo_id', 'videos.note_id', 'notes.file_url', 'notes.storage', 'u.uuid as teacher_id', 'videos.play_on', 'periods.start_time as starts_at', 'schools.title as school_name')
				->limit($limit)
				->offset($offset)
				->orderBy('student_history.id', 'DESC')
                ->groupBy('id')
				->get()
				->toArray();

			$favResponse = array();
			$notesUrl = url('/') . '/';
			$notesPath = public_path('/');

			if(!empty($get_class_history) && count($get_class_history) > 0) {
				foreach($get_class_history as $k => $v) {
					$get_class_history[$k]['id'] = $v['lesson_id'];
					$get_class_history[$k]['notes_url'] = '';
					if($v['note_id'] > 0 && $v['file_url'] != '') {
						if($v['storage'] == 'local') {
							if(file_exists($notesPath . $v['file_url']) && is_file($notesPath . $v['file_url'])) {
								$get_class_history[$k]['notes_url'] = $notesUrl . '' . $v['file_url'];
							}
						} else if($v['storage'] == 's3') {
							if(Storage::disk($v['storage'])->exists($v['file_url'])){
								$get_class_history[$k]['notes_url'] = Storage::disk($v['storage'])->url($v['file_url']);
							}
						}
					}
					unset($get_class_history[$k]['lesson_id'], $get_class_history[$k]['note_id'], $get_class_history[$k]['storage'], $get_class_history[$k]['file_url']);
				}
			}
			return $this->respondCreated([
				'statusCode' => $this->successStatus,
				'message' => '',
				'data' => $get_class_history,
			]);
		} else {
			return $this->respondCreated([
				'statusCode' => $this->unauthorizedStatus,
				'message' => '',
				'data' => new \stdClass(),
            ]);
		}
	}

	/**
     * list fav api
     *
     * @return \Illuminate\Http\Response
     */
    public function fav_video_list() {
		$user_id = Auth::user()->id;
		$page_no = request('page_no');

		$setting = Setting::where('key_name','records_per_page')->first();

		$limit = $setting->val;
		$page = 1;
		if(isset($page_no) && $page_no != '') {
			$page = $page_no;
		}
		$offset = ($page-1) * $limit;

		if (User::where('id', '=', $user_id)->exists()) {
			$get_fav = User::where('users.id', $user_id)
				->leftJoin('student_favourites', 'student_favourites.student_id','=','users.id')
				->leftJoin('videos',function($join){
					$join->on('student_favourites.video_id','=','videos.id')
						->where('videos.status','=','1');
				})
				->leftJoin('classes', 'videos.class_id','=','classes.id')
				->leftJoin('periods', 'videos.period_id','=','periods.id')
				->leftJoin('subjects', 'videos.subject_id','=','subjects.id')
				->leftJoin('tutors',function($join){
					$join->on('videos.tutor_id','=','tutors.user_id');
				})
				->leftJoin('users as u', 'tutors.user_id','=','u.id')
				//->leftJoin('tutors', 'videos.tutor_id','=','tutors.user_id')
				->leftJoin('notes', 'videos.note_id','=','notes.id')
				->select('videos.uuid as lesson_id', 'classes.uuid as class_id', 'periods.uuid as period_id', 'subjects.subject_name as subject', 'videos.description', 'videos.video_id as vimeo_id', 'videos.note_id', 'notes.file_url', 'notes.storage', 'u.uuid as teacher_id', 'videos.play_on', 'periods.start_time as starts_at')
				->limit($limit)
				->offset($offset)
				->orderBy('student_favourites.id', 'DESC')
				->get()
				->toArray();

			$favResponse = array();
			$notesUrl = url('/') . '/';
			$notesPath = public_path('/');

			if(!empty($get_fav) && count($get_fav) > 0) {
				foreach($get_fav as $k => $v) {
					$get_fav[$k]['id'] = $v['lesson_id'];
					$get_fav[$k]['notes_url'] = '';
					if($v['note_id'] > 0 && $v['file_url'] != '') {
						if($v['storage'] == 'local') {
							if(file_exists($notesPath . $v['file_url']) && is_file($notesPath . $v['file_url'])) {
								$get_fav[$k]['notes_url'] = $notesUrl . '' . $v['file_url'];
							}
						} else if($v['storage'] == 's3') {
							if(Storage::disk($v['storage'])->exists($v['file_url'])){
								$get_fav[$k]['notes_url'] = Storage::disk($v['storage'])->url($v['file_url']);
							}
						}
					}
					unset($get_fav[$k]['lesson_id'], $get_fav[$k]['note_id'], $get_fav[$k]['storage'], $get_fav[$k]['file_url']);
				}
			}

			/*$get_fav = User::where('id', 2)
			->with(['videos' => function($query){
				$query->with('topic');
			}])
			->select('id', 'uuid')
			->limit($limit)
			->offset($offset)
			->get()
			->toArray();
			dump($get_fav);die;*/
			return $this->respondCreated([
				'statusCode' => $this->successStatus,
				'message' => '',
				'data' => $get_fav,
			]);
		} else {
			return $this->respondCreated([
				'statusCode' => $this->unauthorizedStatus,
				'message' =>'',
				'data' => new \stdClass(),
            ]);
		}
	}

	 /**
     * make fav api
     *
     * @return \Illuminate\Http\Response
     */
    public function make_fav_video(Request $request) {
		$data = $request->all();
		$user_id = Auth::user()->id;
		$student_id = Auth::user()->student->id;
		$video_uuid = (isset($data['lessonId']) && !empty($data['lessonId'])) ? $data['lessonId'] : '';

		if (Video::where('uuid', '=', $video_uuid)->exists() && User::where('id', '=', $user_id)->exists() && Student::where('id', '=', $student_id)->exists()) {
            $video = Video::where('uuid', '=', $video_uuid)->first();
			if ($request->isMethod('put')) {
				if(StudentFavourites::where('student_id', '=', $user_id)->where('video_id', '=', $video->id)->exists()) {
                    return $this->respondCreated([
							'statusCode' => $this->existsStatus,
							'message' =>  '',
							'data' => new \stdClass(),
						]);
                } else {
                    $fav = new StudentFavourites();
                    $fav->student_id = $student_id;
                    $fav->video_id = $video->id;
                    if($fav->save()){
                        return $this->respondCreated([
							'statusCode' => $this->createdStatus,
							'message' =>  '',
							'data' => new \stdClass(),
						]);
                    } else {
                        return $this->respondCreated([
							'statusCode' => $this->errorStatus,
							'message' =>  '',
							'data' => new \stdClass(),
						]);
                    }
                }
            } else if ($request->isMethod('delete')) {
                StudentFavourites::where('student_id', '=', $user_id)->where('video_id', '=', $video->id)->delete();
                return $this->respondCreated([
					'statusCode' => $this->createdStatus,
					'message' =>  '',
					'data' => new \stdClass(),
				]);
            }
		}
		return $this->respondCreated([
			'statusCode' => $this->invalidInputStatus,
			'message' =>  '',
			'data' => [],
		]);
	}

	public function teacher_details($id) {
		if($id == '') {
			return $this->respondCreated([
				'statusCode' => $this->invalidInputStatus,
				'message' => '',
				'data' => [],
			]);
		}
		$lang = request('lang');
		if(!$lang) {
			$lang = 1;
		}

		$idObj = $this->getId($id, User::class);
		if(!empty($idObj)) {
			if($idObj->role_id != 3) {
				return $this->respondCreated([
					'statusCode' => $this->invalidInputStatus,
					'message' => '',
					'data' => [],
				]);
			}
			$teacher = array();
			$teacher = Tutor::where(['tutors.status' => 1, 'tutors.user_id' => $idObj->id])
					->with([
					'user_details'  => function($query) {
						$query->select('id', 'uuid');
					}, 'school' => function($query) {
						$query->select('schools.id', 'schools.uuid');
					}, 'tutorVideos' => function($query){
						$query->select('id', 'tutor_id', 'uuid')->where('status',1)->where('vimeo_status','=','complete');
					}])
					->select('tutors.id', 'tutors.school_id', 'tutors.user_id')
					->first()->toArray();

			if(!empty($teacher)) {
				$videos = [];
				if(!empty($teacher['tutor_videos'])) {
					foreach($teacher['tutor_videos'] as $k => $v) {
						$videos[] = $v['uuid'];
						$videosIds[] = $v['id'];
					}
				}
				$teacher['video_ids'] = $videos;
				$tutor_videos = StudentVideo::where('student_id', $idObj->id)->pluck('video_id', 'video_id');
				$classesHosted = Video::whereIn('id', $tutor_videos)->groupBy('class_id')->count();
				$teacher['stat_classes_hosted'] = $classesHosted;
				$teacher['school_id'] = $teacher['school']['uuid'];
				$teacher['role'] = "teacher";
				$teacher['profile_id'] = $teacher['user_details']['uuid'];
				unset($teacher['user_details'], $teacher['school'], $teacher['tutor_videos'], $teacher['id'], $teacher['user_id'] );
			}

			return $this->respondCreated([
					'statusCode' => $this->successStatus,
					'message' => '',
					'data' => $teacher,
				]);
		}
		return $this->respondCreated([
				'statusCode' => $this->invalidInputStatus,
				'message' => '',
				'data' => [],
			]);
	}

	public function list_teacher_videos($id = '') {
		if($id == '') {
			return $this->respondCreated([
				'statusCode' => $this->invalidInputStatus,
				'message' => __('messages.invalid_input'),
				'data' => [],
			]);
		}
		$lang = request('lang');
		if(!$lang) {
			$lang = 1;
		}

		$user_id = $id;
		$page_no = request('page_no');

		$setting = Setting::where('key_name','records_per_page')->first();

		$limit = $setting->val;
		$page = 1;
		if(isset($page_no) && $page_no != '') {
			$page = $page_no;
		}
		$offset = ($page-1) * $limit;

		if (User::where('uuid', '=', $user_id)->exists()) {
			$idObj = $this->getId($id, User::class);
			if(!empty($idObj)) {
				if($idObj->role_id != 3) {
					return $this->respondCreated([
						'statusCode' => $this->invalidInputStatus,
						'message' => '',
						'data' => [],
					]);
				}
				$teacher_videos = [];
				$teacher_videos = Video::where('videos.tutor_id', $idObj->id)->where('videos.status','=','1')
					->leftJoin('classes', 'videos.class_id','=','classes.id')
					->leftJoin('periods', 'videos.period_id','=','periods.id')
					->leftJoin('subjects', 'videos.subject_id','=','subjects.id')
					->leftJoin('topics', 'videos.topic_id','=','topics.id')
					->leftJoin('tutors',function($join){
						$join->on('videos.tutor_id','=','tutors.user_id');
					})
					->leftJoin('users as u', 'tutors.user_id','=','u.id')
					->leftJoin('notes', 'videos.note_id','=','notes.id')
					->select('videos.uuid as lesson_id', 'classes.uuid as class_id', 'periods.uuid as period_id', 'subjects.subject_name as subject', 'videos.description', 'videos.video_id as vimeo_id', 'videos.note_id', 'notes.file_url', 'notes.storage', 'u.uuid as teacher_id', 'topics.topic_name', 'videos.created_at as created', 'videos.updated_at as updated')
					->limit($limit)
					->offset($offset)
					//->orderBy('student_favourites.id', 'DESC')
					->get()
					->toArray();

				$favResponse = array();
				$notesUrl = url('/') . '/';
				$notesPath = public_path('/');

				if(!empty($teacher_videos) && count($teacher_videos) > 0) {
					foreach($teacher_videos as $k => $v) {
						$teacher_videos[$k]['id'] = $v['lesson_id'];
						$teacher_videos[$k]['topic'] = $v['topic_name'];
						$teacher_videos[$k]['title'] = $v['subject'];
						$teacher_videos[$k]['attachment_url'] = '';
						if($v['note_id'] > 0 && $v['file_url'] != '') {
							if($v['storage'] == 'local') {
								if(file_exists($notesPath . $v['file_url']) && is_file($notesPath . $v['file_url'])) {
									$teacher_videos[$k]['attachment_url'] = $notesUrl . '' . $v['file_url'];
								}
							} else if($v['storage'] == 's3') {
								if(Storage::disk($v['storage'])->exists($v['file_url'])){
									$teacher_videos[$k]['attachment_url'] = Storage::disk($v['storage'])->url($v['file_url']);
								}
							}
						}
						unset($teacher_videos[$k]['lesson_id'], $teacher_videos[$k]['note_id'], $teacher_videos[$k]['storage'], $teacher_videos[$k]['file_url'], $teacher_videos[$k]['topic_name'], $teacher_videos[$k]['subject']);
					}
				}
                return $this->respondCreated([
                    'statusCode' => $this->successStatus,
                    'message' => '',
                    'data' => $teacher_videos,
                ]);
			} else {
                return $this->respondCreated([
                    'statusCode' => $this->invalidInputStatus,
                    'message' => '',
                    'data' => [],
                ]);
            }
		} else {
			return $this->respondCreated([
				'statusCode' => $this->invalidInputStatus,
				'message' => '',
				'data' => [],
            ]);
		}
	}

	public function send_mail($teacher_id = '', Request $request)
    {
		$data = $request->all();
		$user_id = Auth::user()->id;

		if(trim($teacher_id) == '') {
			return $this->respondCreated([
				'statusCode' => $this->invalidInputStatus,
				'message' => '',
				'data' => [],
			]);
		} else {
			$teacherData = User::where('uuid', $teacher_id)->first();
			if(!(!empty($teacherData) && $teacherData->userRole->role->slug == 'tutor')) {
				return $this->respondCreated([
					'statusCode' => $this->notFoundStatus,
					'message' => '',
					'data' => new \stdClass(),
				]);
			}
		}
		if(Auth::user()->userRole->role->slug != 'student') {
			return $this->respondCreated([
				'statusCode' => $this->unauthorizedStatus,
				'message' => '',
				'data' => new \stdClass(),
            ]);
		}
		$data['teacher_id'] = $teacher_id;
		$validator = Validator::make($data, [
						'class_id' => 'required|string|exists:classes,uuid',
						'teacher_id' => 'required|string|exists:users,uuid',
						'message' => 'required|string|sanitizeScripts'
					], [
						"class_id.required" => "Class not found.",
						'message.sanitize_scripts' => 'Invalid value entered for Message field.',
					]);
        if ($validator->fails()) {
			return $this->throwValidation($validator->messages()->first());
        } else {
			if(isset($data['class_id']) && trim($data['class_id']) != '') {
				$idObj = $this->getId($data['class_id'], Classes::class);
			}
			$mail_from_email = 'xtraclass@xtraclass.projectstatus.in';
			$mail_from_name = 'XtraClass';
			$sitename = 'XtraClass';
			$to = Auth::user()->email;
			$to_name = Auth::user()->userData->first_name . ' ' . Auth::user()->userData->last_name;
			$subject = 'Send mail to student';

			$mailContent = $data['message'];
			$mailContent = str_replace("##FULLNAME##", $to_name, $mailContent);
			$mailContent = str_replace("##SITEURL##", url('/'), $mailContent);
			$mailContent = str_replace("##SITENAME##", $sitename, $mailContent);

			$data = (object) array(
                'message'      => $mailContent,
                'from_email'   => $mail_from_email,
                'from_name'    => $mail_from_name,
                'subject'      => $subject
            );
			Mail::to($to, "New contact inquiry")->send(new sendMailToStudent($data));

			return $this->respondCreated([
					'statusCode' => $this->successStatus,
					'message' => '',
					'data' => new \stdClass()
				]);
        }
    }

	public function upload_note(Request $request)
    {
		$data = $request->all();
		$user_id = Auth::user()->id;

		if(Auth::user()->userRole->role->slug != 'tutor') {
			return $this->respondCreated([
				'statusCode' => $this->unauthorizedStatus,
				'message' => '',
				'data' => new \stdClass(),
            ]);
		}
		if(isset($data['lesson_id']) && trim($data['lesson_id']) != '') {
			$idObj = $this->getId($data['lesson_id'], Video::class);
			//$lesson_id = $idObj->id;
		}/* else {
			return $this->respondCreated([
				'statusCode' => $this->invalidInputStatus,
				'message' => '',
				'data' => [],
            ]);
		}*/

        $validator = Validator::make($request->all(), [
						'lesson_id' => 'required|string|exists:videos,uuid',
						'notes' => 'required'
					], [
						"lesson_id.required" => "Video not found."
					]);
        if ($validator->fails()) {
			return $this->throwValidation($validator->messages()->first());
        } else {
            if ($request->hasFile('notes')) {
                $notes = $request->file('notes');
                $path = Storage::disk('s3')->put('notes', $notes, 'public');

                $insertNote = new Note();
                $insertNote->tutor_id = $user_id;
                $insertNote->file_url = $path;
                $insertNote->storage = 's3';
                $insertNote->save();

                if (!empty($request->lesson_id)) {
                    $updateVideo = Video::find($idObj->id);
                    $updateVideo->note_id = $insertNote->id;
                    $updateVideo->save();
                }
				return $this->respondCreated([
					'statusCode' => $this->successStatus,
					'message' => '',
					'data' => new \stdClass()
				]);
            }
        }
    }

	public function upload_video(Request $request)
    {
		$data = $request->all();
		$user_id = Auth::user()->id;

		if(Auth::user()->userRole->role->slug != 'tutor') {
			return $this->respondCreated([
				'statusCode' => $this->unauthorizedStatus,
				'message' => '',
				'data' => new \stdClass(),
            ]);
		}
		$school_id = Auth::user()->userData->school_id;

		$validator = Validator::make($request->all(), [
            'course_id' => 'required|string|exists:courses,uuid',
            'class_id' => 'required|string|exists:classes,uuid',
            'period_id' => 'required|string|exists:periods,uuid',
            'subject_id' => 'required|string|exists:subjects,uuid',
            'topic_id' => 'required|string|exists:topics,uuid',
            'lesson_date' => 'required|date_format:Y-m-d',
            'video_type' => 'required',
            'video_url' => 'required_if:video_type,url',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
			return $this->throwValidation($validator->messages()->first());
        } else {
            $video_id = '';
			$status = 0;
            if($request->video_type == 'url') {
                $video_url = $request->video_url;
                $video_data = SiteHelpers::getVimeoVideoData($video_url);
                if(!isset($video_data->video_id) || empty($video_data->video_id)){
					return $this->respondCreated([
						'statusCode' => $this->invalidInputStatus,
						'message' => 'Invalid Video URL',
						'data' => [],
					]);
                } else {
                    $video_id = $video_data->video_id;
                }
				$status = 1;
            }

            //form data is available in the request object
			$course = Course::where('uuid', $data['course_id'])->select('id')->first();
			$class = Classes::where('uuid', $data['class_id'])->select('id')->first();
			$period = Period::where('uuid', $data['period_id'])->select('id')->first();
			$subject = Subject::where('uuid', $data['subject_id'])->select('id')->first();
			$topic = Topic::where('uuid', $data['topic_id'])->select('id')->first();

            $video = new Video();

            $video->school_id = $school_id;
            $video->course_id = $course->id;
            $video->class_id = $class->id;
			$video->period_id = $period->id;
			$video->subject_id = $subject->id;
			$video->topic_id = $topic->id;
			$video->tutor_id = $user_id;
			$video->user_id = $user_id;
			$video->note_id = 0;
            $video->play_on = $request->lesson_date;
            $video->video_id = $video_id;
            $video->video_url = (isset($request->video_url) && $request->video_url != '') ? $request->video_url : '';
            $video->video_type = $request->video_type;
            $video->description = $request->description;
            $video->keywords = (isset($request->keywords) && $request->keywords != '') ? $request->keywords : '';
            $video->status = $status;

            if($video->save()) {
				$videoInsert = Video::where('id', $video->id)->select('uuid')->first();

				$resp['video_id'] = $videoInsert->uuid;
				$resp['video_type'] = $request->video_type;
				return $this->respondCreated([
					'statusCode' => $this->successStatus,
					'message' => '',
					'data' => $resp
				]);
			}
			return $this->respondCreated([
					'statusCode' => $this->errorStatus,
					'message' => '',
					'data' => new \stdClass()
				]);
        }
    }

	public function upload_video_attachment(Request $request)
    {
		$data = $request->all();
		$user_id = Auth::user()->id;
		if(Auth::user()->userRole->role->slug != 'tutor') {
			return $this->respondCreated([
				'statusCode' => $this->unauthorizedStatus,
				'message' => '',
				'data' => new \stdClass(),
            ]);
		}
		$validator = Validator::make($request->all(), [
            'video_id' => 'required|string|exists:videos,uuid',
            'video_file' => 'required|mimes:mp4,mov,avi,mkv',
        ]);

        if ($validator->fails()) {
			return $this->throwValidation($validator->messages()->first());
        } else {
            $video = Video::uuid($data['video_id']);
			//form data is available in the request object

            $file = $request->file('video_file');

			$vimeo = Vimeo::Connection();
            $uri = $vimeo->upload($file, array(
                'name' => $video->title,
                'description' => $video->description
            ));

			unlink($file);

            $video_data = $vimeo->request($uri . '?fields=transcode.status');
            $thumbnail = '';

			if(isset($video_data['status']) && $video_data['status'] == 200){
                if(isset($video_data['body']['transcode']['status']) && $video_data['body']['transcode']['status'] != 'error') {
					//Get video id and update into database.
                    $uri_parts = explode('/', $uri);
                    $video_id = $uri_parts[count($uri_parts) - 1];

                    if($video_id){
                        $video->video_id = $video_id;
                        $video->vimeo_status = isset($video_data['body']['transcode']['status']) ? $video_data['body']['transcode']['status']: '';

                        if($video->vimeo_status == 'complete') {
                            $video->status = 1;
                        }

                        $video->save();
                    }

                    return $this->respondCreated([
						'statusCode' => $this->successStatus,
						'message' => '',
						'data' => new \stdClass()
					]);
                }
            }
			return $this->respondCreated([
					'statusCode' => $this->errorStatus,
					'message' => '',
					'data' => new \stdClass()
				]);
        }
    }

	public function list_profiles(Request $request) {
		$data = $request->all();
		$userIdArray = ['b4ea7eeb-4f71-4c18-af8e-9edf56392aca','ff7460b1-ceee-4ea4-94b3-b2d8fbe6423e'];

		$userProfiles = DB::table('users')->whereIn('users.uuid', $userIdArray)
					->where('users.status', 1)
					->leftJoin('role_user', 'role_user.user_id','=','users.id')
					->leftJoin('tutors',function($join){
						$join->on('tutors.user_id','=','users.id')
							->where('role_user.role_id','=',3)
							->select('students.user_id','first_name', 'last_name', 'profile_image');
					})
					->leftJoin('students',function($join){
						$join->on('students.user_id','=','users.id')
							->where('role_user.role_id','=',5)
							->select('tutors.user_id','first_name', 'last_name', 'profile_image');
					})
					->select('users.id', 'users.uuid', 'users.username', 'role_user.role_id', 'students.first_name as s_fname', 'students.last_name as s_lname', 'students.profile_image as s_p_image', 'students.avatar_id as s_avatar_id', 'tutors.first_name as t_fname', 'tutors.last_name as t_lname', 'tutors.profile_image as t_p_image', 'tutors.avatar_id as t_avatar_id')
					->get()->toArray();
		$responseData = [];
		if(!empty($userProfiles)) {
			foreach($userProfiles as $k => $v) {
				$responseData[$k]['id'] = $v->uuid;
				$responseData[$k]['username'] = $v->username;
				if($v->role_id == 3) {
					$responseData[$k]['first_name'] = $v->t_fname;
					$responseData[$k]['last_name'] = $v->t_lname;
					$responseData[$k]['avatar_url'] = '';
					if($v->t_p_image != "" && file_exists(public_path('/'.$v->t_p_image)) && is_file(public_path('/'.$v->t_p_image))) {
						$responseData[$k]['avatar_url'] = url('/') . '/' . $v->t_p_image;
					} else {
						$responseData[$k]['avatar_url'] = url('/') . '/' . $v->t_avatar_id;
					}
				} else if($v->role_id == 5) {
					$responseData[$k]['first_name'] = $v->s_fname;
					$responseData[$k]['last_name'] = $v->s_lname;
					$responseData[$k]['avatar_url'] = '';
					if($v->s_p_image != "" && file_exists(public_path('/'.$v->s_p_image)) && is_file(public_path('/'.$v->s_p_image))) {
						$responseData[$k]['avatar_url'] = url('/') . '/' . $v->s_p_image;
					} else {
						$responseData[$k]['avatar_url'] = url('/') . '/' . $v->s_avatar_id;
					}
				}
			}
		}
		return $this->respondCreated([
						'statusCode' => $this->successStatus,
						'message' => '',
						'data' => $responseData
					]);
	}

	public function getId($uuid, $model) {
		return $model::where('uuid', $uuid)->select('id')->first();
	}

	/**
     * validateUser User.
     *
     * @param $request
     * @param $action
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateUser($data, $action = '', $id = 0) {
		if(is_null($data['email']) || $data['email'] == '') {
			$emailValidate = '';
		} else {
			$emailValidate = 'email|max:100|unique:users';
		}
		$username = 'required|string|min:4|max:255|regex:/^(?=.*[a-z]).+$/|unique:users';
		$password = 'required|string|min:8|regex:/^(?=.*[\w])(?=.*[\W])[\w\W]{6,}$/';
		$phone = 'required|numeric|unique:students,mobile';
		$country_code = 'required';
		$first_name = $last_name = 'nullable|string|sanitizeScripts';
		$course_id = $class_id = '';
		if($action == 'edit') {
			$first_name = 'required|string|sanitizeScripts';
			$last_name = 'required|string|sanitizeScripts';
			$course_id = 'required|string|exists:courses,uuid';
			$class_id = 'required|string|exists:classes,uuid';
			$emailValidate = 'email|max:100|unique:users,email,'.$id;
            if(is_null($data['email']) || $data['email'] == '') {
                $emailValidate = '';
            }
			$username = 'required|string|min:4|max:255|regex:/^(?=.*[a-z]).+$/|unique:users,username,'.$id;
			$password = 'string|min:8|regex:/^(?=.*[\w])(?=.*[\W])[\w\W]{6,}$/';
			$phone = '';
			$country_code = '';
		}
        return Validator::make($data, [
			'first_name' => $first_name,
			'last_name' => $last_name,
			'course_id' => $course_id,
			'class_id' => $class_id,
			'username' => $username,
			'password' => $password,
			'email' => $emailValidate,
			'phone' => $phone,
			'country_code' => $country_code
		],[
			'username.regex' => "Username contains at least one lowercase",
			'password.regex' => "Password contains at least one lowercase, one uppercase, one digit, one special character and 8 characters in total",
			'username.sanitize_scripts' => 'Invalid value entered for Username field.',
			'first_name.sanitize_scripts' => 'Invalid value entered for First Name field.',
			'last_name.sanitize_scripts' => 'Invalid value entered for Last Name field.',
		]);
    }

	public function validateAvatar(Request $request) {
        $validation = Validator::make($request->all(), [
			'file' => 'mimes:jpeg,jpg,png'
        ]);

        return $validation;
    }

	/**
     * validatePassword User.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validatePassword(Request $request) {
		$data = $request->all();

		$validate['old_password'] =  [
				'required',
				'string',
				'min:8',
				'regex:/^(?=.*[\w])(?=.*[\W])[\w\W]{6,}$/',
				function ($attribute, $value, $fail) use ($data) {
					if (!Hash::check($value, Auth::user()->password)) {
						return $fail(__('The old password is incorrect.'));
					}
				}
			];

			$validate['new_password'] = [
				'required',
				'string',
				'min:8',
				'regex:/^(?=.*[\w])(?=.*[\W])[\w\W]{6,}$/',
			];

        $validation = Validator::make($data, $validate, [
			//'OldPassword.regex' => 'Password should contain one capital letter, one special letter and one number.',
			//'password.regex' => 'Password should contain one capital letter, one special letter and one number.',
		]);

        return $validation;
    }

    public function add_to_history(Request $request) {
        $student_id = Auth::user()->student->id;
        $video_id = $request->lesson_id;

        $idObj = static::getId($video_id, Video::class);
        if (!empty($idObj)) {
            $video = Video::where('id', $idObj->id)->first();
            $video->total_views = $video->total_views + 1;
            $video->save();

            $StudentVideo = StudentVideo::where([
                'video_id' => $video_id,
                'student_id' => $student_id
            ])->first();

            if (!empty($StudentVideo->id)) {
                $StudentVideo->video_watch_count++;
            } else {
                $StudentVideo = new StudentVideo;
                $StudentVideo->video_id = $video_id;
                $StudentVideo->student_id = $student_id;
                $StudentVideo->video_watch_count = 1;
            }
            $StudentVideo->save();

            $studentHistory = new StudentHistory;
            $studentHistory->student_id = $student_id;
            $studentHistory->video_id = $video_id;
            $studentHistory->save();

            return $this->respondCreated([
                'statusCode' => $this->successStatus,
                'message' => '',
                'data' => []
            ]);
        } else {
            return $this->respondCreated([
                'statusCode' => $this->invalidInputStatus,
                'message' => '',
                'data' => []
            ]);
        }
    }
}
