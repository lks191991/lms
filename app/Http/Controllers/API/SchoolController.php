<?php

namespace App\Http\Controllers\API;

use App\Models\SchoolSemester;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Department;
use App\Models\Period;
use App\Models\Question;
use App\Models\School;
use App\Models\SchoolCategory;
use App\Models\Setting;
use App\Models\Student;
use App\Models\StudentFavourites;
use App\User;
use App\Models\Video;
use App\Helpers\SiteHelpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Validator;
use DB;
//use Image;
//use Str;

//use App;

class SchoolController extends APIController
{
	public $successStatus = 200;
	public $createdStatus = 201;
    public $invalidInputStatus = 400;
	public $unauthorizedStatus = 401;
    public $forbiddenStatus = 403;
    public $notFoundStatus = 404;
    public $alreadyExistsStatus = 409;
    public $errorStatus = 999;

	/**
     * Get all Categories
     *
     * @return [object]
     */
    public function list_institutions(Request $request)
    {
		$lang = request('lang');
		if(!$lang) {
			$lang = 1;
		}
		$categories = DB::table('school_categories')->where(['status' => 1])->whereNull('deleted_at')->select('uuid as id', 'name')->orderBy('name', 'ASC')->get()->toArray();

		return $this->respondCreated([
				'statusCode' => $this->successStatus,
				'message' => '',
				'data' => $categories,
			]);
    }

	/**
     * Get details of an institute
     *
     * @return [object]
     */
    public function institution_details($id = '')
    {
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
		$category = SchoolCategory::where(['status' => 1, 'uuid' => $id])->select('uuid', 'name')->firstOrFail();

		return $this->respondCreated([
				'statusCode' => $this->successStatus,
				'message' => '',
				'data' => $category,
			]);
    }

	/**
     * Get all Schools
     *
     * @return [object]
     */
    public function list_schools($uuid = '')
    {
		$lang = request('lang');
		if(!$lang) {
			$lang = 1;
		}
		$school_category_id = $uuid;

		$schoolLogoPath = url('/') . '/uploads/schools/';

		$db = DB::table('schools')->where('schools.status', 1)->whereNull('schools.deleted_at');
		if(!is_null($school_category_id) && $school_category_id != '') {
			$db->where('school_categories.uuid', $uuid);
			/*$idObj = $this->getId($school_category_id, SchoolCategory::class);
			if(!empty($idObj)) {
				$db->where('school_category', $idObj->id);
			} else {
				return $this->respondCreated([
					'statusCode' => $this->invalidInputStatus,
					'message' => __('messages.invalid_input'),
					'data' => [],
				]);
			}*/
		}
		$schools = $db->leftJoin('school_categories', 'school_categories.id', '=', 'schools.school_category')
					->select('schools.uuid as id', 'school_name as name', DB::raw('CONCAT("'.$schoolLogoPath.'", "", logo) as logo_url'), 'school_categories.uuid as institution_id')->orderBy('school_name', 'ASC')->get()->toArray();
		/*$schoolsdd = $db->select('school_category', 'uuid', 'school_name', DB::raw('CONCAT("'.$schoolLogoPath.'", "", logo) as logo_url'))->with([
			'category' => function($query) {
				$query->select('id', 'uuid');
			}
		])->orderBy('school_name', 'ASC')->get()->toArray();*/

		return $this->respondCreated([
				'statusCode' => $this->successStatus,
				'message' => '',
				'data' => $schools,
			]);
    }

	/**
     * Get details of an school
     *
     * @return [object]
     */
    public function school_details($id)
    {
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
		$schoolLogoPath = url('/') . '/uploads/schools/';
		$school = DB::table('schools')->where(['schools.status' => 1, 'schools.uuid' => $id])->whereNull('schools.deleted_at')
					->leftJoin('school_categories', 'school_categories.id', '=', 'schools.school_category')
					->select('schools.uuid as id', 'school_name as name', DB::raw('CONCAT("'.$schoolLogoPath.'", "", logo) as logo_url'), 'school_categories.uuid as institution_id' )->first();
		if(!empty($school)) {
			return $this->respondCreated([
					'statusCode' => $this->successStatus,
					'message' => '',
					'data' => $school,
				]);
		}
		return $this->respondCreated([
					'statusCode' => $this->invalidInputStatus,
					'message' => '',
					'data' => [],
				]);
    }

	/**
     * Get all Departments
     *
     * @return [object]
     */
    public function list_departments($id = '')
    {
		$lang = request('lang');
		if(!$lang) {
			$lang = 1;
		}
		$school_id = $id;
		if($school_id != '') {
			$getSchool = School::where('uuid', '=', $school_id)->where('status', 1)->select('id', 'school_category')->first();
			if(!empty($getSchool)) {
				if($getSchool->school_category == School::UNIVERSITY){
					$departments = DB::table('departments')->where('departments.status', 1)->whereNull('departments.deleted_at')
						->where('school_id', $getSchool->id)
						->leftJoin('schools', 'schools.id', '=', 'departments.school_id')
						->select("departments.uuid as id", "departments.name", 'schools.uuid as school_id')
						->get()->toArray();

					return $this->respondCreated([
						'statusCode' => $this->successStatus,
						'message' => '',
						'data' => $departments,
					]);
				}
			}
		}
		return $this->respondCreated([
			'statusCode' => $this->invalidInputStatus,
			'message' => '',
			'data' => [],
		]);
    }

	/**
     * Get details of an department
     *
     * @return [object]
     */
    public function department_details($id = '')
    {
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
		$department = DB::table('departments')->where(['departments.status' => 1, 'departments.uuid' => $id])->whereNull('departments.deleted_at')
					->leftJoin('schools', 'schools.id', '=', 'departments.school_id')
					->select("departments.uuid as id", "departments.name", 'schools.uuid as school_id')
					->first();
		if(!empty($department)) {
			return $this->respondCreated([
					'statusCode' => $this->successStatus,
					'message' => '',
					'data' => $department,
				]);
		}
		return $this->respondCreated([
					'statusCode' => $this->invalidInputStatus,
					'message' => '',
					'data' => [],
				]);
    }

	/**
     * Get all Courses
     *
     * @return [object]
     */
    public function list_courses($schoolId = '', $departmentId = '')
    {
		$lang = request('lang');
		if(!$lang) {
			$lang = 1;
		}
		if($schoolId != '') {
			$getSchool = School::where('uuid', '=', $schoolId)->where('status', 1)->first();
			if(!empty($getSchool)) {
				if($getSchool->school_category == School::UNIVERSITY){
					$getDepartment = Department::where('uuid', '=', $departmentId)->where('status', 1)->first();
					if(!empty($getDepartment)) {
						//return courses based on schoolId and departmentId
						$courses = Course::where('courses.status', 1)->where('courses.school_id', $getSchool->id)->where('department_id', $getDepartment->id)
							->leftJoin('schools', 'schools.id', '=', 'courses.school_id')
							->leftJoin('departments', 'departments.id', '=', 'courses.department_id')
							->select("courses.name", "courses.uuid", "courses.department_id", 'schools.uuid as school_id', 'departments.uuid as department_id')
							->orderBy('courses.name', 'ASC')->get()->toArray();

						return $this->respondCreated([
							'statusCode' => $this->successStatus,
							'message' => '',
							'data' => $courses,
						]);
					} else {
						//invalid id
						return $this->respondCreated([
							'statusCode' => $this->invalidInputStatus,
							'message' => '',
							'data' => [],
						]);
					}
				} else if($getSchool->school_category == School::SENIOR_HIGH){
					//return coursed based on school
					$courses = Course::where('courses.status', 1)->where('school_id', $getSchool->id)
							->leftJoin('schools', 'schools.id', '=', 'courses.school_id')
							->select("courses.name", "courses.uuid", "courses.department_id", 'schools.uuid as school_id')
							->orderBy('courses.name', 'ASC')->get()->toArray();

					return $this->respondCreated([
						'statusCode' => $this->successStatus,
						'message' => '',
						'data' => $courses,
					]);
				}
			}
		}
		return $this->respondCreated([
			'statusCode' => $this->invalidInputStatus,
			'message' => '',
			'data' => [],
		]);
    }

	/**
     * Get all Courses
     *
     * @return [object]
     */
    public function list_school_courses($id = '')
    {
		$lang = request('lang');
		if(!$lang) {
			$lang = 1;
		}
		$school_id = $id;
		if($school_id != '') {
			$getSchool = School::where('uuid', '=', $school_id)->where('status', 1)->select('id', 'school_category')->first();
			if(!empty($getSchool)) {
				if($getSchool->school_category == School::SENIOR_HIGH){
					$courses = DB::table('courses')->where('courses.status', 1)->whereNull('courses.deleted_at')->where('school_id', $getSchool->id)
							->leftJoin('schools', 'schools.id', '=', 'courses.school_id')
							->select("courses.uuid as id", "courses.name", DB::Raw("if(courses.department_id = 0 ,'','' ) as department_id"), 'schools.uuid as school_id')
							->orderBy('courses.name', 'ASC')->get()->toArray();

					return $this->respondCreated([
						'statusCode' => $this->successStatus,
						'message' => '',
						'data' => $courses,
					]);
				}
			}
		}
		return $this->respondCreated([
			'statusCode' => $this->invalidInputStatus,
			'message' => '',
			'data' => [],
		]);
    }

	/**
     * Get all Courses
     *
     * @return [object]
     */
    public function list_school_classes($id = '')
    {
		$lang = request('lang');
		if(!$lang) {
			$lang = 1;
		}
		$school_id = $id;
		if($school_id != '') {
			$getSchool = School::where('schools.uuid', '=', $school_id)->where('schools.status', 1)->leftJoin('courses', 'schools.id', '=', 'courses.school_id')->select('school_category', 'courses.id as course_id')->first();
			$courseId = '';
			if(!empty($getSchool) && $getSchool->school_category == School::BASIC_SCHOOL) {
				$courseId = $getSchool->course_id;
			}
			if(!empty($getSchool) && $courseId != '') {
				if($getSchool->school_category == School::BASIC_SCHOOL){
					$getCourse = Course::where('id', '=', $courseId)->where('status', 1)->first();
					if(!empty($getCourse)) {
						$classes = DB::table('classes')->where('classes.status', 1)->whereNull('classes.deleted_at')->where('classes.course_id', $getCourse->id)
							->leftJoin('courses', 'courses.id', '=', 'classes.course_id')
							->leftJoin('schools', 'schools.id', '=', 'courses.school_id')
							->select("classes.uuid as id", "class_name as name", DB::raw('CONCAT(schools.short_name, " ", classes.class_name) as full_name'), 'courses.uuid as course_id', 'schools.uuid as school_id')
							->orderBy('class_name', 'ASC')->get()->toArray();

						return $this->respondCreated([
							'statusCode' => $this->successStatus,
							'message' => '',
							'data' => $classes,
						]);
					}
				}
			}
		}
		return $this->respondCreated([
			'statusCode' => $this->invalidInputStatus,
			'message' => '',
			'data' => [],
		]);
    }

	/**
     * Get all Courses
     *
     * @return [object]
     */
    public function list_department_course($id = '')
    {
		$lang = request('lang');
		if(!$lang) {
			$lang = 1;
		}
		$department_id = $id;
		if($department_id != '') {
			$getDepartment = Department::where('uuid', '=', $department_id)->where('status', 1)->select('id')->first();
			if(!empty($getDepartment)) {
				$courses = DB::table('courses')->where('courses.status', 1)->whereNull('courses.deleted_at')->where('department_id', $getDepartment->id)
						->leftJoin('schools', 'schools.id', '=', 'courses.school_id')
						->leftJoin('departments', 'departments.id', '=', 'courses.department_id')
						->select("courses.uuid as id", "courses.name",  "departments.uuid as department_id", 'schools.uuid as school_id')
						->orderBy('courses.name', 'ASC')->get()->toArray();

				return $this->respondCreated([
					'statusCode' => $this->successStatus,
					'message' => '',
					'data' => $courses,
				]);
			}
		}
		return $this->respondCreated([
			'statusCode' => $this->invalidInputStatus,
			'message' => '',
			'data' => [],
		]);
    }

	/**
     * Get details of an course
     *
     * @return [object]
     */
    public function course_details($id)
    {
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
		$course = DB::table('courses')->where(['courses.status' => 1, 'courses.uuid' => $id])->whereNull('courses.deleted_at')
					->leftJoin('schools', 'schools.id', '=', 'courses.school_id')
					->leftJoin('departments', 'departments.id', '=', 'courses.department_id')
					->select("courses.uuid as id", "courses.name", "departments.uuid as department_id", 'schools.uuid as school_id')
					->first();
		if(!empty($course)) {
			$course->department_id = (is_null($course->department_id)) ? "" : $course->department_id;
			return $this->respondCreated([
					'statusCode' => $this->successStatus,
					'message' => '',
					'data' => $course,
				]);
		}
		return $this->respondCreated([
					'statusCode' => $this->invalidInputStatus,
					'message' => '',
					'data' => [],
				]);
    }

	/**
     * Get all Courses
     *
     * @return [object]
     */
    public function list_course_classes($id = '')
    {
		$lang = request('lang');
		if(!$lang) {
			$lang = 1;
		}
		$courseId = $id;
		if($courseId != '') {
			$getCourse = Course::where('uuid', '=', $courseId)->where('status', 1)->select('id')->first();
			if(!empty($getCourse)) {
				$classes = DB::table('classes')->where('classes.status', 1)->where('classes.course_id', $getCourse->id)->whereNull('classes.deleted_at')
					->leftJoin('courses', 'courses.id', '=', 'classes.course_id')
					->leftJoin('schools', 'schools.id', '=', 'courses.school_id')
					->select("classes.uuid as id", "class_name as name", DB::raw('CONCAT(schools.short_name, " ", classes.class_name) as full_name'), 'courses.uuid as course_id', 'schools.uuid as school_id')
					->orderBy('class_name', 'ASC')->get()->toArray();

				return $this->respondCreated([
					'statusCode' => $this->successStatus,
					'message' => '',
					'data' => $classes,
				]);
			}
		}
		return $this->respondCreated([
			'statusCode' => $this->invalidInputStatus,
			'message' => '',
			'data' => [],
		]);
    }

	/**
     * Get all Classes
     *
     * @return [object]
     */
    public function list_classes($schoolId = '', $courseId = '')
    {
		$lang = request('lang');
		if(!$lang) {
			$lang = 1;
		}
		if($schoolId == '' && $courseId == '') {
			return $this->respondCreated([
				'statusCode' => $this->invalidInputStatus,
				'message' => '',
				'data' => [],
			]);
		}
		if($schoolId != '0') {
			$getSchool = School::where('schools.uuid', '=', $schoolId)->where('schools.status', 1)->leftJoin('courses', 'schools.id', '=', 'courses.school_id')->select('school_category', 'courses.id as course_id')->first();
			if(!empty($getSchool) && $getSchool->school_category == School::BASIC_SCHOOL) {
				$courseId = $getSchool->course_id;
			}
		}
		if($courseId != '0') {
			$getCourse = Course::where('uuid', '=', $courseId)->where('status', 1)->first();
			if(!empty($getCourse)) {
				//return classes based on courseId
				$classes = Classes::where('classes.status', 1)->where('classes.course_id', $getCourse->id)
					->leftJoin('courses', 'courses.id', '=', 'classes.course_id')
					->leftJoin('schools', 'schools.id', '=', 'courses.school_id')
					->select("class_name", "classes.uuid", "courses.uuid as course_id", 'schools.uuid as school_id')
					->orderBy('class_name', 'ASC')->get()->toArray();

				return $this->respondCreated([
					'statusCode' => $this->successStatus,
					'message' => '',
					'data' => $classes,
				]);
			} else {
				//invalid id
				return $this->respondCreated([
					'statusCode' => $this->invalidInputStatus,
					'message' => '',
					'data' => [],
				]);
			}
		}
		return $this->respondCreated([
			'statusCode' => $this->invalidInputStatus,
			'message' => '',
			'data' => [],
		]);
    }

	/**
     * Get details of a class
     *
     * @return [object]
     */
    public function class_details($id, Request $request)
    {
		$data = $request->all();
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
		$play_on = date("Y-m-d");
		$classroom = Classes::where('classes.uuid', $id)
							->where(['classes.status' => 1])
							->leftJoin('courses', 'courses.id', '=', 'classes.course_id')
							->leftJoin('schools', 'schools.id', '=', 'courses.school_id')
							->select("classes.id", "classes.uuid", "class_name as name", 'courses.name as course_name', 'courses.uuid as course_id', 'schools.uuid as school_uuid', 'schools.id as school_id', 'schools.is_locked', 'schools.school_category', 'schools.school_name')
							->first();
		if(!empty($classroom)) {
			if(isset($data['videoId']) && !empty($data['videoId'])) {
				$defaultVideo = Video::where('videos.uuid', $data['videoId'])
										->where(['videos.status' => 1])
										->leftJoin('periods','periods.id','=','videos.period_id')
										->select('videos.*')
										->first();
				if(!empty($defaultVideo)) {
					$classroom = Classes::where('classes.id', $defaultVideo->class_id)
							->where(['classes.status' => 1])
							->leftJoin('courses', 'courses.id', '=', 'classes.course_id')
							->leftJoin('schools', 'schools.id', '=', 'courses.school_id')
							->select("classes.id", "classes.uuid", "class_name as name", 'courses.name as course_name', 'courses.uuid as course_id', 'schools.uuid as school_uuid', 'schools.id as school_id', 'schools.is_locked', 'schools.school_category', 'schools.school_name')
							->first();
				} else {
					return $this->respondCreated([
						'statusCode' => $this->invalidInputStatus,
						'message' => '',
						'data' => [],
					]);
				}
			} else {
				$defaultVideo = Video::where('videos.status', 1)
                                ->leftJoin('periods','periods.id','=','videos.period_id')
								->where('videos.class_id', $classroom->id)
                                ->where('videos.play_on', '<=', $play_on)
                                ->select('videos.*')
                                ->orderBy('videos.play_on', 'desc')
                                ->orderBy('periods.weight','ASC')
                                ->orderBy('periods.id','ASC')
                                ->first();
			}
		}
		if(!empty($classroom) && !empty($defaultVideo)) {
			//check for loggedin user have permission to access a class of a locked school
			$has_access = false;
			if($classroom->is_locked){
				$has_access = false;
				if (Auth::check() && Auth::user()->id) {
					//check if user id amdin or school manager
					if(Auth::user()->hasRole('admin')){
						$has_access = false;
					}
					else if(Auth::user()->hasRole('school') && isset(Auth::user()->profile->school_id))
					{
						if($classroom->school_id == Auth::user()->profile->school_id){
							$has_access = true;
						}
					}

					//check user have this class access
					$has_class = DB::table('student_classes')
										->where('user_id','=',Auth::user()->id)
										->where('class_id','=',$classroom->id)
										->count();
					if($has_class > 0){
						$has_access = true;
					}
				}
			}
			$note_url = $lern_more = '';
			if (!empty($defaultVideo->noteURL())) {
				$note_url = $defaultVideo->noteURL();
			}
			if (!empty($video->article_id)) {
				$lern_more = URL::to('article/' . $video->article_id);
			}
			//pr($classroom);die;
			//pr($defaultVideo);die;
			$class['id'] = $classroom->uuid;
			$class['name'] = $classroom->name;
			$class['full_name'] = $classroom->name;
			if($classroom->school_category != School::BASIC_SCHOOL) {
				$class['full_name'] .= ' ' . $classroom->course_name;
			}
			$class['course_id'] = $classroom->course_id;
			$class['school_id'] = $classroom->school_uuid;
			$class['school_name'] = $classroom->school_name;
			$class['locked'] = $has_access;
			$class['vimeo_url'] = $defaultVideo->video_url;
			$class['vimeo_id'] = $defaultVideo->video_id;
			$class['view_count'] = ($defaultVideo->total_views != '') ? $defaultVideo->total_views : 0;
			$class['video'][0]['id'] = $defaultVideo->uuid;
			$class['video'][0]['class_id'] = $classroom->uuid;
			$class['video'][0]['title'] = $defaultVideo->title;
			$class['video'][0]['topic'] = $defaultVideo->topic->topic_name;
			$class['video'][0]['play_on'] = $defaultVideo->play_on;
			$class['video'][0]['content'] = $defaultVideo->description;
			$class['video'][0]['note_url'] = $note_url;
			$class['video'][0]['learn_more_url'] = $lern_more;
			$class['video'][0]['teacher']['profile_id'] = $defaultVideo->tutor->user_details->uuid;
			$class['video'][0]['teacher']['name'] = $defaultVideo->tutor->fullname;

			$student_id = 0;
			if (Auth::check()) {
				$student_id = Auth::user()->id;
			}
			$this->studentVideo($defaultVideo->id, $student_id);
			if(empty($defaultVideo->total_views)){
				$total_views = 1;
			}else{
				$total_views = $defaultVideo->total_views+1;
			}
			$defaultVideo->total_views = $total_views;
			$defaultVideo->save();

			return $this->respondCreated([
				'statusCode' => $this->successStatus,
				'message' => '',
				'data' => $class,
			]);
		}
		return $this->respondCreated([
				'statusCode' => $this->invalidInputStatus,
				'message' => '',
				'data' => [],
			]);
    }

    function studentVideo($video_id, $student_id){
		if ($student_id > 0) {
            $StudentVideo = StudentVideo::where([
                        'video_id' => $video_id,
                        'student_id' => $student_id
                    ])
                    ->first();

            if (!empty($StudentVideo->id)) {
                $insertUpdate = $StudentVideo;
                $watchCount = $StudentVideo->video_watch_count + 1;
            } else {
                $insertUpdate = new StudentVideo;
                $watchCount = 1;
            }

            $insertUpdate->video_id = $video_id;
            $insertUpdate->student_id = $student_id;
            $insertUpdate->video_watch_count = $watchCount;
            $insertUpdate->save();

            $studentHistory = new StudentHistory;
            $studentHistory->student_id = $student_id;
            $studentHistory->video_id = $video_id;
            $studentHistory->save();
        }
    }

	/**
     * Get all Classes
     *
     * @return [object]
     */
    public function list_lessons($id = '', Request $request)
    {
		$data = $request->all();
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

		/*$play_on = date("Y-m-d");
		$comp = '<=';
		if(isset($data['play_on']) && !empty($data['play_on'])) {
			$play_on = date("Y-m-d", strtotime($data['play_on']));
			$comp = '=';
		}*/
		$defaultDate = date("Y-m-d");
		$comp = '<=';
		if(isset($data['play_on']) && !empty($data['play_on'])) {
			$defaultDate = date("Y-m-d", strtotime($data['play_on']));
			$comp = '=';
		}

		$class_id = $id;
		$page_no = request('page_no');

		$setting = Setting::where('key_name','records_per_page')->first();

		$limit = $setting->val;
		$limit = 200;
		$page = 1;
		if(isset($page_no) && $page_no != '') {
			$page = $page_no;
		}
		$offset = ($page-1) * $limit;

		$idObj = $this->getId($class_id, Classes::class);
		if (!empty($idObj)) {
			$defaultVideo = array();
			/*$defaultVideo = Video::where('videos.status', 1)
                                ->leftJoin('periods','periods.id','=','videos.period_id')
								->where('videos.class_id', $idObj->id)
                                ->where('videos.play_on', $comp, $play_on)
                                ->select('videos.play_on')
                                ->orderBy('videos.play_on', 'desc')
                                ->orderBy('periods.weight','ASC')
                                ->orderBy('periods.id','ASC')
                                ->first(); */
			if(1 == 1 || !empty($defaultVideo)) {
				//$defaultDate = $defaultVideo->play_on;

				$class_videos = Video::where('videos.class_id', $idObj->id)
					->where('videos.status','=','1')
					->where('videos.play_on', $comp, $defaultDate)
					->leftJoin('classes', 'videos.class_id','=','classes.id')
					->leftJoin('periods', 'videos.period_id','=','periods.id')
					->leftJoin('subjects', 'videos.subject_id','=','subjects.id')
					->leftJoin('topics', 'videos.topic_id','=','topics.id')
					->leftJoin('tutors',function($join){
						$join->on('videos.tutor_id','=','tutors.user_id');
					})
					->leftJoin('users as u', 'tutors.user_id','=','u.id')
					->leftJoin('notes', 'videos.note_id','=','notes.id')
					->select('videos.uuid as lesson_id', 'classes.uuid as class_id', 'periods.uuid as period_id', 'periods.title as period_title', 'subjects.subject_name as subject', 'videos.video_id as vimeo_id', 'videos.note_id', 'notes.file_url', 'notes.storage', 'u.uuid as teacher_id', 'play_on as starts_at', 'topics.topic_name')
					->limit($limit)
					->offset($offset)
					->orderBy('videos.play_on', 'desc')
					->orderBy('periods.weight','ASC')
					->orderBy('periods.id','ASC')
					//->orderBy('student_favourites.id', 'DESC')
					->get()
					->toArray();

				$favResponse = array();
				$notesUrl = url('/') . '/';
				$notesPath = public_path('/');

				if(!empty($class_videos) && count($class_videos) > 0) {
					foreach($class_videos as $k => $v) {
						//$class_videos[$k]['id'] = $v['lesson_id'];
						//$class_videos[$k]['topic'] = $v['topic_name'];
						//$class_videos[$k]['title'] = $v['subject'];
						$class_videos[$k]['notes_url'] = '';
						if($v['note_id'] > 0 && $v['file_url'] != '') {
							if($v['storage'] == 'local') {
								if(file_exists($notesPath . $v['file_url']) && is_file($notesPath . $v['file_url'])) {
									$class_videos[$k]['notes_url'] = $notesUrl . '' . $v['file_url'];
								}
							} else if($v['storage'] == 's3') {
								if(Storage::disk($v['storage'])->exists($v['file_url'])){
									$class_videos[$k]['notes_url'] = Storage::disk($v['storage'])->url($v['file_url']);
								}
							}
						}
						unset($class_videos[$k]['note_id'], $class_videos[$k]['storage'], $class_videos[$k]['file_url']);
					}
				}
				return $this->respondCreated([
					'statusCode' => $this->successStatus,
					'message' => '',
					'data' => $class_videos,
				]);
			}
			return $this->respondCreated([
				'statusCode' => $this->invalidInputStatus,
				'message' => '',
				'data' => [],
			]);
		} else {
			return $this->respondCreated([
				'statusCode' => $this->invalidInputStatus,
				'message' => '',
				'data' => [],
			]);
		}
    }

	/**
     * Get all Classes
     *
     * @return [object]
     */
    public function list_periods($id = '')
    {
		$lang = request('lang');
		if(!$lang) {
			$lang = 1;
		}
		if($id == '') {
			return $this->respondCreated([
				'statusCode' => $this->invalidInputStatus,
				'message' => __('messages.invalid_input'),
				'data' => [],
			]);
		}
		$class_id = $id;
		$idObj = $this->getId($class_id, Classes::class);
		if(!empty($idObj)) {
			$db = DB::table('periods')->where('status', 1)->where('class_id', $idObj->id)->whereNull('deleted_at');
		} else {
			return $this->respondCreated([
				'statusCode' => $this->invalidInputStatus,
				'message' => __('messages.invalid_input'),
				'data' => [],
			]);
		}
		$periods = $db->select('uuid as id', 'weight as number', 'title')->orderBy('title', 'ASC')->get()->toArray();

		return $this->respondCreated([
				'statusCode' => $this->successStatus,
				'message' => '',
				'data' => $periods,
			]);
    }

	/**
     * Get all Classes
     *
     * @return [object]
     */
    public function list_years($id = '')
    {
		$lang = request('lang');
		if(!$lang) {
			$lang = 1;
		}
		if($id == '') {
			return $this->respondCreated([
				'statusCode' => $this->invalidInputStatus,
				'message' => __('messages.invalid_input'),
				'data' => [],
			]);
		}
		$class_id = $id;
		$idObj = $this->getId($class_id, Classes::class);
		if(!empty($idObj)) {
            $years = Video::where('status', 1)->where('class_id', $idObj->id)->selectRaw('YEAR(play_on) AS year')->groupBy('year')->get();
		} else {
			return $this->respondCreated([
				'statusCode' => $this->invalidInputStatus,
				'message' => __('messages.invalid_input'),
				'data' => [],
			]);
		}

		return $this->respondCreated([
				'statusCode' => $this->successStatus,
				'message' => '',
				'data' => $years,
			]);
    }

	/**
     * Get all Classes
     *
     * @return [object]
     */
    public function list_semesters($id = '', Request $request)
    {
		$lang = request('lang');
		if(!$lang) {
			$lang = 1;
		}
		if($id == '') {
			return $this->respondCreated([
				'statusCode' => $this->invalidInputStatus,
				'message' => __('messages.invalid_input'),
				'data' => [],
			]);
		}
		$class_id = $id;
		$year = $request->year;
		$idObj = $this->getId($class_id, Classes::class);
		if(!empty($idObj)) {
		    $class = Classes::where('id', $idObj->id)->with('course.school')->first();
            $semesterNameArray = $class->course->school->semesterNameArray();
            $semesters = SchoolSemester::where('school_id', $class->course->school_id)->where(function ($query) use ($year) {
                $query->where('date_begin', '<=', $year . '-12-31')
                      ->orWhere('date_end', '>=', $year . '-01-01');
            })->get()->pluck('semester', 'id')->map(function ($semester) use ($semesterNameArray) {
                return $semesterNameArray[(int)$semester];
            });
		} else {
			return $this->respondCreated([
				'statusCode' => $this->invalidInputStatus,
				'message' => __('messages.invalid_input'),
				'data' => [],
			]);
		}

		return $this->respondCreated([
				'statusCode' => $this->successStatus,
				'message' => '',
				'data' => $semesters,
			]);
    }

	/**
     * Get all Classes
     *
     * @return [object]
     */
    public function get_semester_video_dates($id = '', Request $request)
    {
		$lang = request('lang');
		if(!$lang) {
			$lang = 1;
		}
		if($id == '') {
			return $this->respondCreated([
				'statusCode' => $this->invalidInputStatus,
				'message' => __('messages.invalid_input'),
				'data' => [],
			]);
		}
		$class_id = $id;
		$idObj = $this->getId($class_id, Classes::class);
		if(!empty($idObj)) {
		    $semester = SchoolSemester::where('id', $request->semester)->first();
            $date_range = Video::where('class_id', $idObj->id)
                               ->whereBetween('play_on', [$semester->date_begin, $semester->date_end])
                               ->where('play_on','<=',date('Y-m-d'))
                               ->where('status',1)
                               ->orderBy('play_on','asc')
                               ->pluck('play_on');
		} else {
			return $this->respondCreated([
				'statusCode' => $this->invalidInputStatus,
				'message' => __('messages.invalid_input'),
				'data' => [],
			]);
		}

		return $this->respondCreated([
				'statusCode' => $this->successStatus,
				'message' => '',
				'data' => $date_range,
			]);
    }

    public function archive_search($id = '', Request $request) {
        $lang = request('lang');
        if(!$lang) {
            $lang = 1;
        }
        if($id == '') {
            return $this->respondCreated([
                'statusCode' => $this->invalidInputStatus,
                'message' => __('messages.invalid_input'),
                'data' => [],
            ]);
        }
        $class_id = $id;
        $idObj = $this->getId($class_id, Classes::class);
        if(!empty($idObj)) {
            $data = Video::where('videos.class_id', $idObj->id)
                         ->where('videos.play_on', $request->play_on)
                         ->leftJoin('classes', 'videos.class_id','=','classes.id')
                         ->leftJoin('periods', 'videos.period_id','=','periods.id')
                         ->leftJoin('subjects', 'videos.subject_id','=','subjects.id')
                         ->leftJoin('topics', 'videos.topic_id','=','topics.id')
                         ->leftJoin('tutors', 'videos.tutor_id','=','tutors.user_id')
                         ->leftJoin('users as u', 'tutors.user_id','=','u.id')
                         ->leftJoin('notes', 'videos.note_id','=','notes.id')
                         ->select('videos.uuid as lesson_id', 'classes.uuid as class_id', 'periods.uuid as period_id', 'periods.title as period_title', 'subjects.subject_name as subject', 'videos.video_id as vimeo_id', 'videos.note_id', 'notes.file_url', 'notes.storage', 'u.uuid as teacher_id', 'play_on as starts_at', 'topics.topic_name')
                         ->first()
                         ->toArray();
        } else {
            return $this->respondCreated([
                'statusCode' => $this->invalidInputStatus,
                'message' => __('messages.invalid_input'),
                'data' => [],
            ]);
        }

        return $this->respondCreated([
            'statusCode' => $this->successStatus,
            'message' => '',
            'data' => $data,
        ]);
    }

	/**
     * Get all Courses
     *
     * @return [object]
     */
    public function list_classrooms(Request $request)
    {
		$lang = request('lang');
		if(!$lang) {
			$lang = 1;
		}
		$school_id = request('school_id');
		$course_id = request('course_id');
		$class_id = request('class_id');

		$db = Classroom::where('status', 1)->with('school', 'course', 'singleClass');
		if(!is_null($school_id) && $school_id != '') {
			$db->where('school_id', $school_id);
		}
		if(!is_null($course_id) && $course_id != '') {
			$db->where('course_id', $course_id);
		}
		if(!is_null($class_id) && $class_id != '') {
			$db->where('class_id', $class_id);
		}
		$classrooms = $db->orderBy('classroom_name', 'ASC')->get()->toArray();

		return $this->respondCreated([
				'statusCode' => $this->successStatus,
				'message' => '',
				'data' => $classrooms,
			]);
    }

	/**
     * Get Classroom details
     *
     * @return [object]
     */
	 public function classroom_detail($id) {
		if($id == '') {
			return $this->respondCreated([
				'statusCode' => $this->invalidInputStatus,
				'message' => __('messages.invalid_input'),
				'data' => [],
			]);
		}
		$classroom_id = $id;

		$classroom = Classroom::where('classrooms.uuid', $classroom_id)->with('school', 'course', 'singleClass')
		->firstorFail();
		if(!empty($classroom)) {
			$classroom = $classroom->toArray();
			$classroom['videos'] = Classroom::find($classroom['id'])->videos;
		}


		return $this->respondCreated([
			'statusCode' => $this->successStatus,
			'message' => '',
			'data' => $classroom,
		]);
	 }

	/**
     * Get all Questions of a video
     *
     * @return [object]
     */
    public function list_questions($id = '')
    {
		$lang = request('lang');
		if(!$lang) {
			$lang = 1;
		}
		if($id == '') {
			return $this->respondCreated([
				'statusCode' => $this->invalidInputStatus,
				'message' => __('messages.invalid_input'),
				'data' => [],
			]);
		}

		$video = Video::where('uuid', $id)->firstorFail();
		if(!empty($video)) {
			$video = $video->toArray();
			$video['questions'] = Question::where('video_id', $video['id'])->with('childrenAccounts')->get()->toArray();
		}

		return $this->respondCreated([
				'statusCode' => $this->successStatus,
				'message' => '',
				'data' => $video,
			]);
    }

	/**
     * step 2 of registration
     * @param Request $request
     * @return Validator object
     */
    public function save_question(Request $request) {
        $data = $request->all();
		$user_id = Auth::user()->id;

		$validator = Validator::make($data, [
            'content' => 'required|string|sanitizeScripts'
        ],[
			"content.required" => "The question field is required.",
			'content.sanitize_scripts' => 'Invalid value entered for Content field.',
		]);

        if ($validator->fails()) {
            return $this->throwValidation($validator->messages()->first());
        }

        if (User::where('id', $user_id)->exists()) {
			$video = Video::where('id', $data['video_id'])->select('id', 'class_id')->first();
			if(!empty($video)) {
				$parent_id = ($data['parent_id'] == "") ? 0 : $data['parent_id'];
				$type = ($data['type'] == "") ? 'question' : $data['type'];
				$insertQuestion = new Question();
				$insertQuestion->content = $data['content'];
				$insertQuestion->type = $type;
				$insertQuestion->parent_id = $parent_id;
				$insertQuestion->sender_id = $user_id;
				$insertQuestion->class_id = $video->class_id;
				$insertQuestion->video_id = $data['video_id'];
				$insertQuestion->save();

				return $this->respondCreated([
					'statusCode' => 200,
					'message' => __('messages.passcode_vefified_successfully'),
					'data' => [],
				]);
			} else {
				return $this->respondCreated([
					'statusCode' => 999,
					'message' => __('messages.invalid_record'),
					'data' => [],
				]);
			}
        } else {
            return $this->respondCreated([
				'statusCode' => 999,
				'message' => __('messages.invalid_record'),
				'data' => [],
            ]);
        }
    }

	public function getId($uuid, $model) {
		return $model::where('uuid', $uuid)->select('id')->first();
	}
}
