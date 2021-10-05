<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolCategory;
use App\Models\School;
use App\Models\Course;
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

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	
//pr(json_decode($json)); 
		if(Auth::user()->hasRole('school')){
			return redirect()->route('backend.dashboard');
		}
		//Show all categories from the database and return to view
        $categories = SchoolCategory::orderBy('id', 'desc')->get();
		
		//pr($schools); 
		//echo json_encode($schools);
		//exit;
        return view('backend.categories.index',compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		if(Auth::user()->hasRole('school')){
			return redirect()->route('backend.dashboard');
		}
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request, [
                'name' => 'required|unique:school_categories,name|max:180',            
            ]);
			
       //Persist the category in the database
        //form data is available in the request object
        $category = new SchoolCategory();
        //input method is used to get the value of input with its
        //name specified
		$category->name = $request->input('name');
		$category->status = ($request->input('status') !== null)? $request->input('status'):0;
		
		$category->save(); //persist the data
        return redirect()->route('backend.categories.index')->with('success','Institution Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->hasRole('school')){
			return redirect()->route('backend.dashboard');
		}
		$category = SchoolCategory::findOrFail($id);
		print_r($category);die;
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
       //Find the category
        $category = SchoolCategory::find($id);
		return view('backend.categories.edit',compact('category'));

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
		$validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'max:180',
                Rule::unique('school_categories')->where(function ($query) use($id) {  
                    return $query->where('id','<>', $id);
                })
            ],
            
        ]);
                                
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the form
                ->withInput();
        }
		
        //Retrieve the category and update
        $category = SchoolCategory::find($id);
		
		
		
		
		//echo "<pre>"; print_r($school); exit;
        $category->name = $request->input('name');
		$category->status = ($request->input('status') !== null)? $request->input('status'):0;
		$category->save(); //persist the data
        return redirect()->route('backend.categories.index')->with('success','Institution Information Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$category = SchoolCategory::find($id);
		
		$schools = School::where('school_category', $category->id)->get();
		//delete all child records.
		//delete school
		foreach($schools as $school) {
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
				
				$school->delete();
			}
		}
		
        $category->delete();
		return redirect()->route('backend.categories.index')->with('success','Institution Deleted Successfully');
    }
}
