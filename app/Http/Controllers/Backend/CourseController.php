<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Course;
use App\Models\SchoolCategory;
use App\Models\Department;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Period;
use App\Models\Topic;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	

		if(Auth::user()->hasRole('school')){
            return redirect()->route('backend.dashboard');          
        }

		//Show all courses from the database and return to view
		if(Auth::user()->hasRole('school')){
            $profile = Auth::user()->profile;
            if(isset($profile->school_id)){
			   $courses = Course::where('school_id', $profile->school_id)->orderBy('id', 'desc')->get();
             }            
        } else {
			$courses = Course::orderBy('id', 'desc')->get();
		} 
        
		
		//pr($schools); 
		//echo json_encode($schools);
		//exit;
        return view('backend.course.index',compact('courses'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($school_id = '')
    {
		if(Auth::user()->hasRole('school')){
            return redirect()->route('backend.dashboard');          
        }
	
		$query = SchoolCategory::where('status','=',1);
       
        //Check for the user profile      
        if(Auth::user()->hasRole('school')){
            $profile = Auth::user()->profile;
            if(isset($profile->school_id)){
                $school_id = $profile->school_id;
                $category_id = $profile->school->school_category;
                $query = $query->where('id','=',$profile->school->school_category);
            }            
        } 
        
        $institutes = $query->orderBy('name')
                        ->pluck('name','id');
		
		
		$schools = School::where('status', 1)->get();
			
		return view('backend.course.create', compact('schools', 'institutes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		 //Persist the course in the database
        //form data is available in the request object
        $course = new Course();
		$school_id = $request->input('school_name');
		
		if(Auth::user()->hasRole('school')){
            $profile = Auth::user()->profile;
            if($profile->school_id != $school_id){
				return redirect()->route('backend.dashboard');
			}
		}
		
		$institute_type = $request->input('institute_type');
		$ajax_request = $request->input('ajax_request');
		
		
		if(isset($institute_type) && $institute_type == config("constants.UNIVERSITY")) {
			$department_id = $request->input('department');
			$validator = Validator::make($request->all(), [
				'institute_type' => 'required',
				'school_name' => 'required',
				'department' => 'required',
				'name' => [
					'required',
					'max:180',
					Rule::unique('courses')->where(function ($query) use($school_id, $department_id) {  
						return $query->where('school_id', $school_id)->where('department_id', $department_id);
					})
				],
				
			]);
			
			$course->department_id = $request->input('department');
			$course->type = "program";
			
		} else {
			
			$validator = Validator::make($request->all(), [
				'institute_type' => 'required',
				'school_name' => 'required',
				'name' => [
					'required',
					'max:180',
					Rule::unique('courses')->where(function ($query) use($school_id) {  
						return $query->where('school_id', $school_id);
					})
				],
				
			]);
		}
		
		if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the form
                ->withInput();
        }
		
       //input method is used to get the value of input with its
        //name specified
		$course->name = $request->input('name');
		$course->school_id = $request->input('school_name');
		$course->description = $request->input('description');
		$course->status = ($request->input('status') !== null)? $request->input('status'):0;
		$course->save(); //persist the data
		
		if(!empty($request->input('ajax_request'))) {
			return redirect()->route('backend.school.show', $course->school_id)->with('success','Course Created Successfully');
		} else if(!empty($request->input('department_ajax_request'))) {
			return redirect()->route('backend.departments.show', $course->department_id)->with('success','Course Created Successfully');
		} else {
			return redirect()->route('backend.courses')->with('success','Course Created Successfully');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$course = Course::findOrFail($id);
		
		if(!Auth::user()->hasAccessToSchool($course->school_id)){
            return redirect()->route('backend.dashboard');           
        }
		
		return view('backend.course.show', compact('course'));
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
		
       //Find the course
        $course = Course::find($id);
		
		if(!Auth::user()->hasAccessToSchool($course->school_id)){
            return redirect()->route('backend.dashboard');           
        }
		
		$institutes = SchoolCategory::orderBy('name')->where('status','=',1)->pluck('name','id');
		$school_details = School::where('id',$course->school_id)->select('school_category')->first();
		$schools = School::where('status',1)->where('school_category',$school_details->school_category)->get();
		$departments = Department::where('school_id',$course->school_id)->where('status','=',1)->pluck('name','id');
		
		return view('backend.course.edit',compact('course', 'schools', 'institutes', 'school_details', 'departments'));

    }
	
	/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_ajax(Request $request)
    {
		$id = $request->input('course_id');
		$course = Course::find($id);
		
		$department_ajax_request = $request->input('department_ajax_request');
		
		return view('backend.course.edit-ajax', compact('course', 'department_ajax_request'));
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
        //Retrieve the employee and update
        $course = Course::find($id);
		//echo "<pre>"; print_r($school); exit;
      //  $course->school_id = $request->input('school_name');
		$ajax_request = $request->input('ajax_request');
		$school_id = $course->school_id;
		
		if(!Auth::user()->hasAccessToSchool($school_id)){
            return redirect()->route('backend.dashboard');           
        }
		
		$institute_type = $request->input('institute_type');
		$department_id = $request->input('department');
		
		if(isset($department_id) && !empty($department_id)) { 
			
			$validator = Validator::make($request->all(), [
				'name' => [
					'required',
					'max:180',
					Rule::unique('courses')->where(function ($query) use($school_id, $department_id, $id) {  
						return $query->where('school_id', $school_id)->where('department_id', $department_id)->where('id','<>', $id);
					})
				],
				
			]);
			
			$course->department_id = $request->input('department');
			$course->type = "program";
			
		} else {
			
			$validator = Validator::make($request->all(), [
				//'institute_type' => 'required',
				//'school_name' => 'required',
				'name' => [
					'required',
					'max:180',
					Rule::unique('courses')->where(function ($query) use($school_id, $id) {  
						return $query->where('school_id', $school_id)->where('id','<>', $id);
					})
				],
				
			]);
		}
		
		if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the form
                ->withInput();
        }
		
		
		$course->name = $request->input('name');
		$course->description = $request->input('description');
		$course->status = ($request->input('status') !== null)? $request->input('status'):0;
        $course->save(); //persist the data
		
		if(!empty($request->input('ajax_request'))) {
			
			return redirect()->route('backend.school.show', $school_id)->with('success','Course Information Updated Successfully');
		} else if(!empty($request->input('department_ajax_request'))) {
			return redirect()->route('backend.departments.show', $course->department_id)->with('success','Course Information Updated Successfully');
		} else {
			return redirect()->route('backend.courses')->with('success','Course Information Updated Successfully');
		}
		
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
		$course = Course::find($id);
		
		if(!Auth::user()->hasAccessToSchool($course->school_id)){
            return redirect()->route('backend.dashboard');           
        }
		
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
						$periods = Period::where('class_id', $class->id)->select('id')->get();
						foreach($periods as $period) {
							if(isset($period->id) && !empty($period->id))
							$period->delete();
						}
			
						$class->delete();
					}
				}
			}
		
        $course->delete();
		
		$ajax_request = $request->input('ajax_request');
		
		if(!empty($ajax_request)) {
			
			return redirect()->route('backend.school.show', $course->school_id)->with('success','Course Deleted Successfully');
		} else if(!empty($request->input('department_ajax_request'))) {
			return redirect()->route('backend.departments.show', $course->department_id)->with('success','Course Deleted Successfully');
		} else {
			return redirect()->route('backend.courses')->with('success','Course Deleted Successfully');
		}
	}
}
