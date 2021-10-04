<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\Course;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Video;
use App\Models\Period;
use App\Models\Department;
use App\Models\DepartmentClass;
use App\Models\KnowledgeArticle;
use App\Models\SchoolCategory;
use App\Models\Student;
use App\Models\Tutor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Validator;
use Auth;
use Image;
use SiteHelpers;

class ApiController extends Controller
{
    /**
     * Get school category or institution options ajax data.
     *
     */
    public function getInstitutionOptinns(Request $request)
    {

        $data = $request->input('searchVal');
        $institution_id = $data['institution_id'];
        $school_id = $data['school_id'];
        $department_id = $data['department_id'];
        $course_id = $data['course_id'];
        $class_id = $data['class_id'];
        $boxName = "Institution";
        $errorStatus = 0;
        $errorMessage = "";

        $category = SchoolCategory::where('status', 1)
                ->pluck("name", "id");

        $optionData = $this->checkHideShow($request, $boxName);

        if ($this->checkEmpty($category)) {
            $errorStatus = 1;
            $errorMessage = "Related data not found, please choose other option.";

            //,'checkError' => $checkError
        }
        $checkError = (object) array('errorStatus' => $errorStatus, 'errorMessage' => $errorMessage);

        $array = array('category' => $category, 'optionData' => $optionData, 'checkError' => $checkError);

        return response()->json($array);
    }

    /**
     * Get school options ajax data.
     *
     */
    public function getSchoolOptinns(Request $request)
    {
        $data = $request->input('searchVal');
        $institution_id = $data['institution_id'];
        $school_id = $data['school_id'];
        $department_id = $data['department_id'];
        $course_id = $data['course_id'];
        $class_id = $data['class_id'];
        $boxName = "Institute Name";
        $errorStatus = 0;
        $errorMessage = "";

        $schools = School::where('status', 1)
                ->where('school_category', $institution_id)
                //->whereHas('latestVideo')
                ->pluck("school_name", "id");

        if ($data['institution_id'] == School::BASIC_SCHOOL) {
            $boxName = "School Name";
        } else if ($data['institution_id'] == School::SENIOR_HIGH) {
            $boxName = "School Name";
        } else if ($data['institution_id'] == School::UNIVERSITY) {
            $boxName = "University Name";
        }



        if (!empty($institution_id) && $this->checkEmpty($schools)) {
            $errorStatus = 1;
            $errorMessage = "Related data not found, please choose other option.";

            //,'checkError' => $checkError
        }

        $checkError = (object) array('errorStatus' => $errorStatus, 'errorMessage' => $errorMessage);

        $optionData = $this->checkHideShow($request, $boxName);
        $array = array('schools' => $schools, 'optionData' => $optionData, 'checkError' => $checkError);

        return response()->json($array);
    }

    /**
     * Get course options ajax data.
     * old getCourseOptions
     */
    public function getDepartmentOrCourseOptions(Request $request)
    {
        $data = $request->input('searchVal');
        $institution_id = $data['institution_id'];
        $school_id = $data['school_id'];
        $department_id = $data['department_id'];
        $course_id = $data['course_id'];
        $class_id = $data['class_id'];
        $fromCall = $request->input('fromCall');
        $boxName = "Course";
        $fillIn = "course";
        $returnArr = array();
        $errorStatus = 0;
        $errorMessage = "";

        if ($fromCall == 'school' && $data['institution_id'] == School::UNIVERSITY) {

            $department = Department::where('status', 1)
                    ->where('school_id', $school_id)
                    ->pluck("name", "id");
            $returnArr = $department;

            $boxName = "Department";
            $fillIn = "department";

            if (!empty($school_id) && $this->checkEmpty($department)) {
                $errorStatus = 1;
                $errorMessage = "Related data not found, please choose other option.";
            }
        } else {

            if ($data['institution_id'] == School::BASIC_SCHOOL) {
                $boxName = "Course";
            } else if ($data['institution_id'] == School::SENIOR_HIGH) {
                $boxName = "Course";
            } else if ($data['institution_id'] == School::UNIVERSITY) {
                $boxName = "Program";
            }



            $courses = Course::where('status', 1);
            $courses = $courses->where('school_id', $school_id);
            if ($data['institution_id'] == School::UNIVERSITY) {
                $courses = $courses->where('type', 'program');
                $courses = $courses->where('department_id', $department_id);
            }
            $courses = $courses->pluck("name", "id");
            $returnArr = $courses;

            if (!empty($school_id) && $this->checkEmpty($courses)) {
                $errorStatus = 1;
                $errorMessage = "Related data not found, please choose other option.";
            }
        }



        $checkError = (object) array('errorStatus' => $errorStatus, 'errorMessage' => $errorMessage);

        $optionData = $this->checkHideShow($request, $boxName);
        $array = array('courses' => $returnArr, 'optionData' => $optionData, 'fillIn' => $fillIn, 'checkError' => $checkError);



        return response()->json($array);
    }

    /**
     * Get class options ajax data.
     *
     */
    public function getClassOptions(Request $request)
    {

        $data = $request->input('searchVal');
        $institution_id = $data['institution_id'];
        $school_id = $data['school_id'];
        $department_id = $data['department_id'];
        $course_id = $data['course_id'];
        $class_id = $data['class_id'];
        $boxName = "Class";
        $errorStatus = 0;
        $errorMessage = "";

        $classes = Classes::where('status', 1);
        $classes = $classes->whereHas('latestVideo');

        if ($data['institution_id'] == School::UNIVERSITY) {
            $classes = $classes->where(function($where) use ($department_id) {
                $where->whereIn('id', DepartmentClass::where('department_id', $department_id)->pluck('class_id', 'class_id'));
            });
        }

        if ($data['institution_id'] == School::BASIC_SCHOOL) {
            if (empty($course_id)) {
                $school = School::find($school_id);
                if (!empty($school->coursesList[0])) {
                    $course = $school->coursesList[0];
                    $course_id = $course->id;
                }
            }
        }

        $classes = $classes->where('course_id', $course_id);
        $classes = $classes->pluck("class_name", "id");

        if (!empty($course_id) && $this->checkEmpty($classes)) {
            $errorStatus = 1;
            $errorMessage = "Related data not found, please choose other option.";
        }

        $checkError = (object) array('errorStatus' => $errorStatus, 'errorMessage' => $errorMessage);

        $optionData = $this->checkHideShow($request, $boxName);
        $array = array('classes' => $classes, 'optionData' => $optionData, 'checkError' => $checkError);

        return response()->json($array);
    }

    function checkEmpty($data)
    {

        if (!empty($data)) {
            $test = collect($data)->toArray();
            $cnt = count($test);
            if ($cnt > 0) {
                return 0;
            } else {
                return 1;
            }
        } else {
            return 1;
        }
    }

    public function checkHideShow($request, $boxName)
    {

        $institutionDesable = 0;
        $institutionHide = 0;
        $schoolDesable = 1;
        $schoolHide = 1;
        $departmentDesable = 1;
        $departmentHide = 1;
        $courseDesable = 1;
        $courseHide = 1;
        $classesDesable = 1;
        $classesHide = 1;

        $data = $request->input('searchVal');
        /*
          $institution_id = $data['institution_id'];
          $school_id      = $data['school_id'];
          $department_id  = $data['department_id'];
          $course_id      = $data['course_id'];
          $class_id       = $data['class_id'];
         */

        if (!empty($data['institution_id'])) {
            $schoolDesable = 0;
            $schoolHide = 0;
        }

        if (!empty($data['school_id'])) {
            if ($data['institution_id'] == School::UNIVERSITY) {
                $departmentDesable = 0;
                $departmentHide = 0;
            } else if ($data['institution_id'] == School::SENIOR_HIGH) {
                $courseDesable = 0;
                $courseHide = 0;
            } else {
                $classesDesable = 0;
                $classesHide = 0;
            }
        }

        if (!empty($data['department_id']) && $data['institution_id'] == School::UNIVERSITY) {
            $courseDesable = 0;
            $courseHide = 0;
        }

        if (!empty($data['course_id'])) {
            $classesDesable = 0;
            $classesHide = 0;
        }



        return $optionData = array(
            'boxName' => $boxName,
            'onchange' => $request->input('onchange'),
            'fromCall' => $request->input('fromCall'),
            'selectedId' => $request->input('selectedId'),
            'institutionDesable' => $institutionDesable,
            'institutionHide' => $institutionHide,
            'schoolDesable' => $schoolDesable,
            'schoolHide' => $schoolHide,
            'departmentDesable' => $departmentDesable,
            'departmentHide' => $departmentHide,
            'courseDesable' => $courseDesable,
            'courseHide' => $courseHide,
            'classesDesable' => $classesDesable,
            'classesHide' => $classesHide
        );
    }

    /**
     * Get program full options ajax data.
     *
     */
    public function getProgramFullOptions(Request $request)
    {

        $departmentId = $request->input('departmentId');
        $fromCall = $request->input('fromCall');
        $onchange = $request->input('onchange');

        $programs = Course::where('status', 1)->where('type', 'program')->where('department_id', $departmentId)->orderBy('name', 'asc')->pluck("name", "id");
        $array = array('programs' => $programs, 'optionData' => array());

        return response()->json($array);
    }

    /**
     * Get classes full options ajax data.
     *
     */
    public function getClassesFullOptions(Request $request)
    {

        $course_id = $request->input('course_id');
        $fromCall = $request->input('fromCall');
        $onchange = $request->input('onchange');

        $classes = Classes::where('status', 1)->where('course_id', $course_id)->orderBy('class_name', 'asc')->pluck("class_name", "id");
        $array = array('classes' => $classes, 'optionData' => array());

        return response()->json($array);
    }

    /**
     * Get subjects full options ajax data.
     *
     */
    public function getSubjectsFullOptions(Request $request)
    {

        $class_id = $request->input('class_id');
        $fromCall = $request->input('fromCall');
        $onchange = $request->input('onchange');

        $subjects = Subject::where('status', 1)->where('class_id', $class_id)->orderBy('subject_name', 'asc')
                ->pluck("subject_name", "id");
        $array = array('subjects' => $subjects, 'optionData' => array());

        return response()->json($array);
    }

    /**
     * Get  topic options ajax data.
     *
     */
    public function getTopicOptions(Request $request)
    {

        $subject_id = $request->input('subject_id');
        $fromCall = $request->input('fromCall');
        $onchange = $request->input('onchange');
        $default = $request->input('selectedVal');

        $options = '<option value="" class="d-none" selected>Topic</option>';
        //$topics = Topic::where('status', 1)->where('subject_id', $subject_id)->orderBy('weight', 'asc')->pluck("topic_name", "id");

        $topics = Topic::where('status', 1)
                        ->where('subject_id', '=', $subject_id)
                        ->orderBy('weight','ASC')
                        ->select('id', 'topic_name')->get();

        if (!$topics->isEmpty()) {
            foreach ($topics as $topic) {
                $selected = '';
                if ($default > 0 && $default == $topic->id) {
                    $selected = 'selected';
                }

                $options .= '<option value="' . $topic->id . '" ' . $selected . '>' . $topic->topic_name . '</option>';
            }
        }
        
        
        
        $data = array('topics' => $options);
        
        return response()->json($data);
    }

    /**
     * Get period options ajax data.
     *
     */
    public function getPeriodOptions(Request $request)
    {

        $subject_id = $request->input('subject_id');
        $topic_id = $request->input('topic_id');
        $class_id = $request->input('class_id');
        $fromCall = $request->input('fromCall');
        $onchange = $request->input('onchange');

        $periods = Period::where('status', 1)->where('class_id', $class_id)->orderBy('title', 'asc')->pluck("title", "id");
        $array = array('periods' => $periods, 'optionData' => array());

        return response()->json($array);
    }

    /**
     * Create video by ajax data.
     *
     */
    public function createVideo(Request $request)
    {

        $tutor_id = 0;
        $status = 0;
        $messageType = '';
        $message = '';
        $watchCount = 1;
        $nextStepUrl = '';

        if (Auth::check()) {
            $tutor_id = Auth::user()->id;
            $isLogin = 1;
        }

        $tutor = User::find(Auth::user()->id);
        $tutorSchoolCategory = $tutor->userData->school->school_category;
        $tutorSchoolId = $tutor->userData->school->id;
        $schoolCategoryName = '';

        $validateSchoolAndCat = Validator::make([
                        'school' => $tutorSchoolId, 
                        'category' => $tutorSchoolCategory
                    ], 
                    [
                        'school' => 'required',
                        'category' => 'required'
                    ], 
                    [
                        "school.required" => "School not found.",
                        "category.required" => "Valid School not found."
        ]);
        

        if ($validateSchoolAndCat->fails()) {

            $errors = $validateSchoolAndCat->errors()->all();
            $status = 0;
            $messageType = 'error';
            $message = collect($errors)->implode('<br>');
        } else {

            $validator = Validator::make($request->all(), [
                        'classId' => 'required',
                        'subjectId' => 'required',
                        'topicId' => 'required',
                        'periodId' => 'required',
                        'play_on' => 'required',
                        'video_type' => 'required',
                        'video_url' => 'required_if:video_type,url',
                        'message' => 'required',
                        'keywords' => 'required',
                            ], [
                        "classId.required" => "The class field is required.",
                        "subjectId.required" => "The subject field is required.",
                        "topicId.required" => "The topic field is required.",
                        "period.required" => "The period field is required.",
                        "play_on.required" => "The date field is required.",
                        "video_url.required" => "The video url field is required.",
                        "message.required" => "The description field is required.",
                        "keywords.required" => "The keywords field is required.",
            ]);
            
            

            $course_id = $request->input('courseId');
            if ($tutorSchoolCategory == School::BASIC_SCHOOL) {

                $school = School::find($tutorSchoolId);
                if (!empty($school->coursesList[0])) {
                    $course = $school->coursesList[0];
                    $course_id = $course->id;
                }
            } else if ($tutorSchoolCategory == School::SENIOR_HIGH) {
                
            } else if ($tutorSchoolCategory == School::UNIVERSITY) {

                $validator->after(function ($validator) use ($request) {
                    if (empty($request->input('departmentId'))) {
                        $validator->errors()->add('departmentId', 'The department field is required.');
                    }
                });
            }
            if (empty($course_id)) {
                $validator->after(function ($validator) {
                    $validator->errors()->add('courseId', 'The course field is required.');
                });
            }
            

            if ($validator->fails()) {

                $errors = $validator->errors()->all();
                $status = 0;
                $messageType = 'error';
                $message = collect($errors)->implode('<br>');
            } else {
                $video_vimeo_id = '';
                $video_type = $request->input('video_type');
                if($request->video_type == 'url') {
                    $video_url = $request->input('video_url');
                    $video_data = SiteHelpers::getVimeoVideoData($video_url);

                    if (!empty($video_data->video_id)) {
                        $video_vimeo_id = $video_data->video_id;
                    } else {
                        $validateSchoolAndCat->after(function ($validateSchoolAndCat) {
                            $validateSchoolAndCat->errors()->add('video_url', 'Invalid Video URL');
                        });
                    }
                }
                

                if ($tutor_id > 0) {

                    $insert = new Video;
                    $insert->school_id = $tutorSchoolId;
                    $insert->course_id = $course_id;
                    $insert->class_id = $request->input('classId');
                    $insert->play_on = $request->input('play_on');
                    $insert->period_id = $request->input('periodId');
                    $insert->video_id = $video_vimeo_id;
                    $insert->video_type = $request->input('video_type');
                    $insert->video_url = $request->input('video_url');
                    $insert->description = $request->input('message');
                    $insert->subject_id = $request->input('subjectId');
                    $insert->topic_id = $request->input('topicId');
                    $insert->tutor_id = Auth::user()->id;
                    $insert->keywords = $request->input('keywords');
                    $insert->status = ($request->video_type == 'file') ? 0 : 1;
                    $insert->save();
                    
                    $message = 'Video created successfully.';
                    if($request->video_type == 'file') {
                        $nextStepUrl = route('frontend.uploadVideoFile',$insert->uuid);
                        $message = 'Video posted and redirecting for next step...';
                    }
                    
                    $status = 1;
                    $messageType = 'success';
                    
                } else {

                    $status = 0;
                    $isLogin = 0;
                    $messageType = 'error';
                    $message = 'You are not loged in.';
                }
            }
        }
        
        $returnMsg = (object) array(
                    'status' => 200,
                    'errStatus' => $status,
                    'isLogin' => $isLogin,
                    'type' => $request->video_type,
                    'nextStepUrl' => $nextStepUrl,
                    'messageType' => $messageType,
                    'message' => $message
        );
        $returnData['data'] = $returnMsg;
        return response()->json($returnMsg, 200);
    }

    public function createArticle(Request $request)
    {

        $tutor_id = 0;
        $status = 0;
        $messageType = '';
        $message = '';
        $watchCount = 1;

        if (Auth::check()) {
            $tutor_id = Auth::user()->id;
            $isLogin = 1;
        }
        //$formData = $request->formData;

        $validator = Validator::make($request->all(), [
                    'articleTitle' => 'required',
                    'articleSubject' => 'required',
                    'articleImage' => 'required|image|dimensions:min_width=298,min_height=202',
                    'articleContent' => 'required',
                    'articleKeywords' => 'required',
                        //'article_target' => 'required',
                        ], [
                    "articleTitle.required" => "The title field is required.",
                    "articleSubject.required" => "The subject field is required.",
                    "articleImage.dimensions" => "The image size must be 298*202",
                    "articleImage.required" => "The image field is required.",
                    "articleContent.required" => "The content field is required.",
                    "articleKeywords.required" => "The keywords field is required.",
                        //"article_target.required" => "The target  options is required.",
        ]);

        $articleTarget = json_decode($request->input('article_target'), true);

        if (empty($articleTarget['article_target'])) {
            $validator->after(function ($validator) {
                $validator->errors()->add('article_target', 'The target  options is required.');
            });
        }

        //echo "<pre>"; print_r($arr); exit;


        if ($validator->fails()) {

            $errors = $validator->errors()->all();
            $status = 0;
            $messageType = 'error';
            $message = collect($errors)->implode('<br><br>');
        } else {


            $formData = $request->all();
            if ($tutor_id > 0) {

                $imageUrl = '';
                if ($request->hasFile('articleImage')) {
                    $articleImage = $request->file('articleImage');
                    $uploadPath = "uploads/article";


                    $fileName = time() . mt_rand(10, 100) . '.' . $articleImage->getClientOriginalExtension();
                    $location = public_path($uploadPath);
                    if (!file_exists($location)) {
                        mkdir($location);
                    }
                    $isMoved = $articleImage->move($location . '/', $fileName);
                    $img = Image::make($location . '/' . $fileName);
                    $imageUrl = $uploadPath . '/' . $fileName;
                }

                $insert = new KnowledgeArticle;
                $insert->title = $formData['articleTitle'];
                $insert->subject = $formData['articleSubject'];
                $insert->image = $imageUrl;
                $insert->content = $formData['articleContent'];
                $insert->target = implode(',', $articleTarget['article_target']);
                $insert->author_id = Auth::user()->id;
                $insert->keywords = $request->input('articleKeywords');
                $insert->save();

                $status = 1;
                $messageType = 'success';
                $message = 'Article created successfully.';
            } else {

                $status = 0;
                $isLogin = 0;
                $messageType = 'error';
                $message = 'You are not loged in.';
            }
        }

        $returnMsg = (object) array(
                    'status' => 200,
                    'errStatus' => $status,
                    'isLogin' => $isLogin,
                    'messageType' => $messageType,
                    'message' => $message
        );
        $returnData['data'] = $returnMsg;
        return response()->json($returnMsg, 200);
    }

    public function updateUUID($table)
    {
        SiteHelpers::updateUUID($table);

        return "Updated UUID for '" . $table . "' table.";
    }

    public function changePasswordApi(Request $request)
    {
        $user_id = 0;
        $status = 0;
        $messageType = '';
        $message = '';
        $watchCount = 1;

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $isLogin = 1;
        }



        $validator = Validator::make($request->all(), [
                    'old_password' => 'required|min:6|max:30',
                    'password' => 'required_with:confirm_password|same:password_confirmation|min:6|max:30',
                    'password_confirmation' => 'required|max:30',
        ]);



        if ($validator->fails()) {

            $errors = $validator->errors()->all();
            $status = 0;
            $messageType = 'error';
            $message = collect($errors)->implode('<br>');
        } else {



            if ($user_id > 0) {
                $user = User::find(Auth::user()->id);
                if (Hash::check($request->old_password, $user->password)) {

                    $user->password = bcrypt($request->password);
                    $user->save();

                    $status = 1;
                    $messageType = 'success';
                    $message = 'Password has been updated successful!';
                } else {

                    $status = 0;
                    $isLogin = 1;
                    $messageType = 'error';
                    $message = 'Old password dose not match!';
                }
            } else {

                $status = 0;
                $isLogin = 0;
                $messageType = 'error';
                $message = 'You are not loged in.';
            }
        }

        $returnMsg = (object) array(
                    'status' => 200,
                    'errStatus' => $status,
                    'isLogin' => $isLogin,
                    'messageType' => $messageType,
                    'message' => $message
        );
        $returnData['data'] = $returnMsg;
        return response()->json($returnMsg, 200);
    }

    public function updateStudent(Request $request)
    {

        $user_id = 0;
        $status = 0;
        $messageType = '';
        $message = '';
        $watchCount = 1;

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $isLogin = 1;
        }



        $validator = Validator::make($request->all(), [
                    'first_name' => 'required|regex:/^[a-zA-Z_\-]*$/',
                    'last_name' => 'nullable|regex:/^[a-zA-Z_\-]*$/',
                    'email' => 'email|regex:/^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$/|unique:users,email,' . $user_id,
                    'student_class' => 'required',
                        ], [
                    'first_name.regex' => "First Name contains <li>The first name must contain alpha characters only</li>",
                    'last_name.regex' => "Last Name contains <li>The last name must contain alpha characters only</li>",
        ]);



        if ($validator->fails()) {

            $errors = $validator->errors()->all();
            $status = 0;
            $messageType = 'error';
            $message = collect($errors)->implode('<br>');
        } else {



            if ($user_id > 0) {

                $update = Student::where('user_id', Auth::user()->id)->first();
                $update->first_name = $request->first_name;
                $update->last_name = $request->last_name;
                $update->email = $request->email;
                $update->class_id = $request->student_class;
                $update->save();
				
				$updataUser        = User::find(Auth::user()->id);
				$updataUser->name  = $request->first_name;
                $updataUser->email = $request->email;
                $updataUser->save();

                $status = 1;
                $messageType = 'success';
                $message = 'Profile has been updated successful!';
            } else {

                $status = 0;
                $isLogin = 0;
                $messageType = 'error';
                $message = 'You are not loged in.';
            }
        }

        $returnMsg = (object) array(
                    'status' => 200,
                    'loadUrl' => url('profile'),
                    'errStatus' => $status,
                    'isLogin' => $isLogin,
                    'messageType' => $messageType,
                    'message' => $message
        );
        $returnData['data'] = $returnMsg;
        return response()->json($returnMsg, 200);
    }

    public function updateTutor(Request $request)
    {

        $user_id = 0;
        $status = 0;
        $messageType = '';
        $message = '';
        $watchCount = 1;

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $isLogin = 1;
        }



        $validator = Validator::make($request->all(), [
                    'first_name' => 'required|regex:/^[a-zA-Z_\-]*$/',
                    'last_name' => 'nullable|regex:/^[a-zA-Z_\-]*$/',
                    'subject' => 'required|regex:/^[a-zA-Z0-9_\-]*$/|max:150',
                    'email' => 'email|regex:/^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$/|unique:users,email,' . $user_id,
                        ], [
                    'subject.regex' => "Subject Name contains <li>The subject name must contain alphanumeric characters only</li>",
                    'first_name.regex' => "First Name contains <li>The first name must contain alpha characters only</li>",
                    'last_name.regex' => "Last Name contains <li>The last name must contain alpha characters only</li>",]);



        if ($validator->fails()) {

            $errors = $validator->errors()->all();
            $status = 0;
            $messageType = 'error';
            $message = collect($errors)->implode('<br>');
        } else {



            if ($user_id > 0) {

                $update = Tutor::where('user_id', Auth::user()->id)->first();
                $update->first_name = $request->first_name;
                $update->last_name = $request->last_name;
                $update->email = $request->email;
                $update->tutor_subject = $request->subject;
                $update->save();
				
				$updataUser        = User::find(Auth::user()->id);
				$updataUser->name  = $request->first_name;
                $updataUser->email = $request->email;
                $updataUser->save();

                $status = 1;
                $messageType = 'success';
                $message = 'Profile has been updated successful!';
            } else {

                $status = 0;
                $isLogin = 0;
                $messageType = 'error';
                $message = 'You are not loged in.';
            }
        }

        $returnMsg = (object) array(
                    'status' => 200,
                    'loadUrl' => url('profile'),
                    'errStatus' => $status,
                    'isLogin' => $isLogin,
                    'messageType' => $messageType,
                    'message' => $message
        );
        $returnData['data'] = $returnMsg;
        return response()->json($returnMsg, 200);
    }

}
