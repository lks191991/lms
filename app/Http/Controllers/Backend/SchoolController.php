<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\SchoolCategory;
use App\Models\Course;
use App\Models\SchoolSemester;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Video;
use App\Models\Tutor;
use App\Models\Student;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Helpers\SiteHelpers;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = School::where('id','<>',0);
        //Check for the user profile      
        if(Auth::user()->hasRole('school')){
            $profile = Auth::user()->profile;
            if(isset($profile->school_id)){
                $query = $query->where('id','=',$profile->school_id);
            }            
        } 
        
        $schools = $query->orderBy('id', 'desc')->get();
        
        return view('backend.school.index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$query = SchoolCategory::where('status','=',1);
		
		if(Auth::user()->hasRole('school')){
            return redirect()->route('backend.dashboard');          
        } 
		
        $categories = $query->orderBy('name')->get();
        
        return view('backend.school.create', compact('categories'));
    }
	
	function total_featured_school() {
	
		$featured_school_limit = config("constants.FEATURED_SCHOOL_LIMIT");
		$total_featured_count = School::where('status','=',1)->where('featured', 1)->where('deleted_at', NULL)->count();
		
		if($total_featured_count<$featured_school_limit) {
			return false;
		} else {
			return true;
		}
		
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$data = $request->all();
		
		$school_category = $request->input('school_category');

        $validator = Validator::make($request->all(), [
                    'school_name' => [
                        'required',
                        'max:180',
                        Rule::unique('schools')->where(function ($query) use($school_category) {
                                    return $query->where('school_category', $school_category);
                                })
                    ],
        ]);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::back()
                            ->withErrors($validator) // send back all errors to the form
                            ->withInput();
        }

        //Persist the school in the database
        //form data is available in the request object
        $school = new School();
        //input method is used to get the value of input with its
        //name specified
        $school->school_name = $request->input('school_name');
        $school->school_category = $request->input('school_category');
		
		if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('subadmin')){
			$school->status = ($request->input('status') !== null) ? $request->input('status') : 0;
		}
		


        $school->save(); //persist the data
		
		
        return redirect()->route('backend.schools')->with('success', 'School Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::user()->hasAccessToSchool($id)){
            return redirect()->route('backend.dashboard');           
        }

        $school = School::findOrFail($id);
       
        $courses = Course::where('school_id', $id)->orderBy('id', 'desc')->get();
		
		$courses_count = SiteHelpers::dashboard_resource_count('courses', $id);
		$classes_count = SiteHelpers::dashboard_resource_count('classes', $id);
		$videos_count = SiteHelpers::dashboard_resource_count('videos', $id);
        $student_count = SiteHelpers::dashboard_resource_count('students', $id);
        $tutor_count = SiteHelpers::dashboard_resource_count('tutors', $id);
        
        return view('backend.school.show', compact('school', 'courses', 'courses_count', 'classes_count', 'videos_count', 'student_count', 'tutor_count'));        
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		if(Auth::user()->hasRole('school')){
            return redirect()->route('backend.dashboard');          
        }
		
        //Find the school
        $school = School::find($id);
        $categories = SchoolCategory::where('status', 1)->get();

        return view('backend.school.edit', compact('school', 'categories'));
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
		$data = $request->all();
		
		
		
        $school_category = $request->input('school_category');

        $validator = Validator::make($request->all(), [
                    'school_name' => [
                        'required',
                        'max:180',
                        Rule::unique('schools')->where(function ($query) use($school_category, $id) {
                                    return $query->where('school_category', $school_category)->where('id', '<>', $id);
                                })
                    ],
        ]);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::back()
                            ->withErrors($validator) // send back all errors to the form
                            ->withInput();
        }

        //Retrieve the school and update
        $school = School::find($id);
        //echo "<pre>"; print_r($school); exit;
        $school->school_name = $request->input('school_name');
		
		if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('subadmin')){
			$school->status = ($request->input('status') !== null) ? $request->input('status') : 0;
		}
		

        $school->save(); //persist the data
        return redirect()->route('backend.schools')->with('success', 'School Information Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		if(Auth::user()->hasRole('school')){
            return redirect()->route('backend.dashboard');          
        }
		
        $school = School::find($id);
		
		//delete all child records.
		//delete school
		if(isset($school->id) && !empty($school->id)) {
			
			
			
			$courses = Course::where('school_id', $school->id)->select('id')->get();
			//delete course
			foreach($courses as $course) {
				if(isset($course->id) && !empty($course->id)){
					
					$classes = Classes::where('course_id', $course->id)->select('id')->get();
					
					foreach($classes as $class) {
						if(isset($class->id) && !empty($class->id)) {
							$subjects = Subject::where('class_id', $class->id)->select('id')->get();
							
							foreach($subjects as $subject) {
								if(isset($subject->id) && !empty($subject->id)) {
									
									$topics = Topic::where('subject_id', $subject->id)->select('id')->get();
									
									foreach($topics as $topic) {
										if(isset($topic->id) && !empty($topic->id))
										$topic->delete();
									}
									
									$subject->delete();
								}
							}
							
							$class->delete();
						}
					}
					$course->delete();
				}
			}
			
			$videos = Video::where('school_id', $school->id)->select('id')->get();
			foreach($videos as $video) {
				if(isset($video->id) && !empty($video->id))
				$video->delete();
			}
			
			$tutors = Tutor::where('school_id', $school->id)->select('id')->get();
			foreach($tutors as $tutor) {
				if(isset($tutor->id) && !empty($tutor->id))
				$tutor->delete();
			}
			
			$students = Student::where('school_id', $school->id)->select('id')->get();
			foreach($students as $student) {
				if(isset($student->id) && !empty($student->id))
				$student->delete();
			}
			
			
		}
		
		$school->delete();
        return redirect()->route('backend.schools')->with('success', 'School Deleted Successfully');
    }

}
