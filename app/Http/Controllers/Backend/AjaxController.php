<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Course;
use App\Models\Classes;
use App\Models\Period;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Tutor;
use App\Models\Video;
use App\Models\Department;
use Auth;
use Illuminate\Support\Facades\Storage;
use Vimeo\Laravel\Facades\Vimeo;

class AjaxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * get School and Class options for a category.
     * return Array $options
     */
    public function getSchools(Request $request, $for_student_filter = '')
    {
		if(!empty($for_student_filter))
		$sch_opts = '<option value="" selected>All</option>';
		else
        $sch_opts = '<option value="" disabled selected>Select School</option>';


        $category = $request->category;

        if ($category) {
            $query = School::where('status', 1);
            //Check for the user profile      
            if(Auth::user()->hasRole('school')){
                $profile = Auth::user()->profile;
                if(isset($profile->school_id)){
                    $query = $query->where('id','=',$profile->school_id);
                }            
            } 
            
            $schools = $query->where('school_category', '=', $category)
                            ->orderBy('school_name')
                            ->select('id', 'school_name')->get();

            if (!$schools->isEmpty()) {
                foreach ($schools as $school) {
					if(!empty($for_student_filter))
					$sch_opts .= '<option value="' . $school->school_name . '" data-id="' . $school->id . '">' . $school->school_name . '</option>';
					else
					$sch_opts .= '<option value="' . $school->id . '">' . $school->school_name . '</option>';
                }
            }
        }

        $data = ['schools' => $sch_opts];

        return $data;
    }

    /**
     * get courses options for a School. 
     * return string $options
     */
    public function getSchoolCourses(Request $request, $default = 0)
    {
        $options = '<option value="" disabled selected>Select Course</option>';

        $school_id = $request->school_id;

        if ($school_id) {
            $courses = Course::where('status', 1)
                            ->where('school_id', '=', $school_id)
                            ->orderBy('name')
                            ->select('id', 'name')->get();

            if (!$courses->isEmpty()) {
                foreach ($courses as $course) {
                    $selected = '';
                    if ($default > 0 && $default == $course->id) {
                        $selected = 'selected';
                    }

                    $options .= '<option value="' . $course->id . '" ' . $selected . '>' . $course->name . '</option>';
                }
            }
        }

        return $options;
    }
	
	/**
     * get courses options for a School in student filter. 
     * return string $options
     */
    public function getStudentfilterCourses(Request $request)
    {
        $options = '<option value=""  selected>All</option>';

        $school_id = $request->school_id;

        if ($school_id) {
            $courses = Course::where('status', 1)
                            ->where('school_id', '=', $school_id)
                            ->orderBy('name')
                            ->select('id', 'name')->get();

            if (!$courses->isEmpty()) {
                foreach ($courses as $course) {
                    
					$options .= '<option value="' . $course->name . '" data-id="' . $course->id . '">' . $course->name . '</option>';
                }
            }
        }

        return $options;
    }

    /**
     * get courses options for a department. 
     * return string $options
     */
    public function getDepartmentCourses(Request $request, $default = 0)
    {
        $options = '<option value="" disabled selected>Select Course</option>';
        
        $department_id = $request->department_id;
        
        if($department_id) {
            $courses = Course::where('status', 1)
                               ->where('department_id', '=', $department_id)
                               ->orderBy('name')
                               ->select('id', 'name')->get();
            
            if (!$courses->isEmpty()) {                
                foreach($courses as $course){
                    $selected = '';
                    if($default > 0 && $default == $course->id){
                        $selected = 'selected';
                    }
                    
                    $options .= '<option value="'.$course->id.'" '.$selected.'>'.$course->name.'</option>';
                }
            }
        }

        return $options;
    }
	
    /**
     * get department options for a School. 
     * return string $options
     */
    public function getSchoolDepartments(Request $request, $default = 0)
    {
        $options = '<option value="" disabled selected>Select Department</option>';

        $school_id = $request->school_id;

        if ($school_id) {
            $departments = Department::where('status', 1)
                            ->where('school_id', '=', $school_id)
                            ->orderBy('name')
                            ->select('id', 'name')->get();

            if (!$departments->isEmpty()) {
                foreach ($departments as $department) {
                    $selected = '';
                    if ($default > 0 && $default == $department->id) {
                        $selected = 'selected';
                    }

                    $options .= '<option value="' . $department->id . '" ' . $selected . '>' . $department->name . '</option>';
                }
            }
        }

        return $options;
    }

    /**
     * get classroom options for a School. 
     * return string $options
     */
    public function getSchoolCourseclasses(Request $request, $default = 0)
    {
        $options = '<option value="" disabled selected>Choose Class</option>';

        $course_id = $request->course_id;


        if ($course_id > 0) {

            $classes = Classes::where('status', 1)
                            ->where('course_id', '=', $course_id)
                            //->orderBy('class_name')
                            ->select('id', 'class_name')->get();

            if (!$classes->isEmpty()) {
                foreach ($classes as $cls) {
                    $options .= '<option value="' . $cls->id . '">' . $cls->class_name . '</option>';
                }
            }
        }

        return $options;
    }
	
	/**
     * get class in student filter. 
     * return string $options
     */
    public function getStudentfilterCourseclasses(Request $request)
    {
        $options = '<option value="" selected>All</option>';

        $course_id = $request->course_id;


        if ($course_id > 0) {

            $classes = Classes::where('status', 1)
                            ->where('course_id', '=', $course_id)
                            //->orderBy('class_name')
                            ->select('id', 'class_name')->get();

            if (!$classes->isEmpty()) {
                foreach ($classes as $cls) {
                    $options .= '<option value="' . $cls->class_name . '" data-id="' . $cls->id . '">' . $cls->class_name . '</option>';
                }
            }
        }

        return $options;
    }

    /**
     * get school subjects. 
     * return status true / false with error message
     */
    public function getSchoolClassSubjects(Request $request, $default = 0)
    {
        $options = '<option value="" disabled selected>Choose Subject</option>';

        $class_id = $request->class_id;


        if ($class_id > 0) {

            $subjects = Subject::where('status', 1)
                            ->where('class_id', '=', $class_id)
                            //->orderBy('class_name')
                            ->select('id', 'subject_name')->get();

            if (!$subjects->isEmpty()) {
                foreach ($subjects as $sub) {
                    $options .= '<option value="' . $sub->id . '">' . $sub->subject_name . '</option>';
                }
            }
        }

        return $options;
    }
	
	/**
     * get filter school subjects. 
     * return status true / false with error message
     */
    public function getSchoolfilterClassSubjects(Request $request, $default = 0)
    {
        $options = '<option value="" selected>All</option>';

        $class_id = $request->class_id;


        if ($class_id > 0) {

            $subjects = Subject::where('status', 1)
                            ->where('class_id', '=', $class_id)
                            //->orderBy('class_name')
                            ->select('id', 'subject_name')->get();

            if (!$subjects->isEmpty()) {
                foreach ($subjects as $sub) {
                    $options .= '<option value="' . $sub->subject_name . '" data-id="' . $sub->id . '">' . $sub->subject_name . '</option>';
                }
            }
        }

        return $options;
    }

    /**
     * get periods for a Class. 
     * return String $options
     */
    public function getClassPeriods(Request $request)
    {
        $options = '';

        $class_id = $request->class_id;
        $date = $request->date;
        $default = $request->period;

        if ($class_id > 0) {

            $periods = Period::withCount(['videos' => function ($query) use ($date) {
                            $query->where('play_on', '=', $date);
                        }])
                    ->where('status', 1)
                    ->where('class_id', '=', $class_id)
                    ->orderBy('weight')
                    ->get();

            if (!$periods->isEmpty()) {
                foreach ($periods as $period) {
                    $disabled = '';
                    if ($period->videos_count > 0) {
                        $disabled = 'disabled';
                    }
                    $checked = '';
                    if($default == $period->id){
                        $checked = 'checked';
                        $disabled = '';
                    }
                    $options .= '<div class="col-5"><label class="custom-control custom-radio">
                        <input name="period" type="radio" class="custom-control-input" value="' . $period->id . '" ' . $disabled . ' '. $checked . ' required>
                        <span class="custom-control-label">' . $period->title . '</span>
                    </label></div>';
                }
            } else {
                $options = '<p class="text-light">No periods available</p>';
            }
        }

        return $options;
    }

    /**
     * get periods for a Class. 
     * return String $options
     */
    public function getClassSubjects(Request $request, $default = 0)
    {
        $subj_options = '<option value="" disabled selected>Choose Subject</option>';

        $class_id = $request->class_id;

        if ($class_id > 0) {

            $subjects = Subject::where('status', 1)
                    ->where('class_id', '=', $class_id)
                    ->get();

            if (!$subjects->isEmpty()) {
                foreach ($subjects as $subject) {
                    $subj_options .= '<option value="' . $subject->id . '">' . $subject->subject_name . '</option>';
                }
            }
        }

        return $subj_options;
    }

    /**
     * get topic options for a subject. 
     * return string $options
     */
    public function getSubjectTopics(Request $request, $default = 0)
    {
        $options = '<option value="" disabled selected>Select Topic</option>';

        $subject_id = $request->subject_id;

        if ($subject_id) {
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
        }

        return $options;
    }
	
	public function getSubjectTopicsTutor(Request $request, $default = 0)
    {
        $options = '<option value="" disabled selected>Select Topic</option>';

        $subject_id = $request->subject_id;
		$user_id = $request->user_id;

        if ($subject_id) {
            $topics = Topic::where('status', 1)
                            ->where('subject_id', '=', $subject_id)
							->where('user_id', $user_id)
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
        }

        return $options;
    }

    /**
     * Image Upload Code
     *
     * @return void
     */
    public function dropzoneStore(Request $request)
    {
        $file = $request->file('file');
        
        $uuid = $request->get('video_id');
        
        $video = Video::uuid($uuid);
        
        if($video) {
            
            $vimeo = Vimeo::Connection();


            $uri = $vimeo->upload($file, array(
                'name' => $video->title,
                'description' => $video->description
            ));

            unlink($file);            
            
            $video_data = $vimeo->request($uri . '?fields=transcode.status');
            $thumbnail = '';
            if(isset($video_data['status']) && $video_data['status'] == 200){
                
                if(isset($video_data['body']['transcode']['status']) 
                        && $video_data['body']['transcode']['status'] != 'error') {

                    //Get video id and update into database.
                    $uri_parts = explode('/',$uri);
                    $video_id = $uri_parts[count($uri_parts) - 1];

                    if($video_id){
                        $video->video_id = $video_id;
                        $video->vimeo_status = isset($video_data['body']['transcode']['status']) ? $video_data['body']['transcode']['status']: '';
                        
                        if($video->vimeo_status == 'complete') {
                            $video->status = 1;
                        }
                            
                        $video->save();
                        $thumbnail = $video->getVimeoThumb();
                    }                

                    return response()->json(['status' => 'success','thumbnail' => $thumbnail,'message' => 'Upladed Successfuly. your video will be active within 12 hours.']);
                }
            }  
            
        }      
        
        return response()->json(['status' => 'error','message' => 'Sorry, Something went wrong. Try the upload again.']);
    }
    
    /**
     * get tutors options for a School. 
     * return string $options
     */
    public function getSchoolTutors(Request $request, $default = 0)
    {
        $options = '<option value="" disabled selected>Select Tutor</option>';

        $school_id = $request->school_id;

        if ($school_id) {
            $tutors = Tutor::where('status', 1)
                            ->where('school_id', '=', $school_id)
                            ->orderBy('first_name','asc')
                            ->orderBy('last_name','asc')
                            ->get();

            if (!$tutors->isEmpty()) {
                foreach ($tutors as $tutor) {
                    $selected = '';
                    if ($default > 0 && $default == $tutor->id) {
                        $selected = 'selected';
                    }

                    $options .= '<option value="' . $tutor->user_id . '" ' . $selected . '>' . $tutor->fullname . '</option>';
                }
            }
        }

        return $options;
    }
    
    /**
     * Note Upload on S3
     *
     * @return void
     */
    public function dropzoneNoteStore(Request $request)
    {
        // Get file extension
        $extension = $request->file('notefile')->getClientOriginalExtension();

        // Valid extensions
        $validextensions = array("pdf","zip","jpeg","jpg","png","doc", "docx", "ppt", "pptx");

        // Check extension
        if (in_array(strtolower($extension), $validextensions)) {
            
            // Rename file 
            //$fileName = str_slug(time()) . rand(11111, 99999) . '.' . $extension;
            
            //$path = 'notes/' . $fileName ;
            $path = Storage::disk('s3')->put('notes', $request->file('notefile'), 'public');
        }

        return response()->json(['success' => 'success', 'savefilename' => $path]);
    }
    
   

}
