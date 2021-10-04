<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\School;
use App\Models\Course;
use App\Models\Classes;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Support\Facades\Redirect;



class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all subjects
        $classrooms = Classroom::orderBy('classroom_name')->get();

        return view('backend.classrooms.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$schools = School::where('status',1)->get();
		$classes = Classes::where('status',1)->get();
		
        return view('backend.classrooms.create', compact('schools','classes'));
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
		
		$school_id = $data['school'];
		$course_id = $data['course'];
		$class_id = $data['class'];
		
		$validator = Validator::make($request->all(), [
            'school' => 'required',
			'course' => 'required',
			'class' => 'required',
			'classroom_name' => 'required|max:180',
            'date' => [
                'required',
				Rule::unique('classrooms')->where(function ($query) use($school_id, $course_id, $class_id) {  
                    return $query->where(['school_id'=>$school_id, 'course_id'=>$course_id, 'class_id'=>$class_id, 'deleted_at'=>NULL]);
                })
            ],
            
        ]);
                                
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the form
                ->withInput();
        } else {
			//form data is available in the request object
            $classroom = new Classroom();

            $classroom->classroom_name = $request->input('classroom_name');
            $classroom->school_id = $request->school;
			$classroom->course_id = $request->course;
			$classroom->class_id = $request->class;
			$classroom->date = $request->input('date');
            $classroom->status = ($request->input('status') !== null)? $request->input('status'):0;

            $classroom->save();

            return redirect()->route('backend.classrooms.index')->with('success', 'Classroom created Successfully');
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
        // $class = Classes::findOrFail($id);
        return redirect()->route('backend.classes.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$classroom = Classroom::find($id);
		$schools = School::where('status',1)->get();
		$classes = Classes::where('status',1)->get();
		$courses = Course::where('school_id', $classroom->school_id)->where('status',1)->get();
		
		return view('backend.classrooms.edit', compact('classroom', 'schools', 'classes', 'courses'));
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
		
		$school_id = $data['school'];
		$course_id = $data['course'];
		$class_id = $data['class'];
		
		$validator = Validator::make($request->all(), [
            'school' => 'required',
			'course' => 'required',
			'class' => 'required',
			'classroom_name' => 'required|max:180',
            'date' => [
                'required',
				Rule::unique('classrooms')->where(function ($query) use($school_id, $course_id, $class_id, $id) {  
                    return $query->where(['school_id'=>$school_id, 'course_id'=>$course_id, 'class_id'=>$class_id, 'deleted_at'=>NULL])
								 ->where('id','<>', $id);
                })
            ],
            
        ]);
                                
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the form
                ->withInput();
        } else {
			
			//form data is available in the request object
            $classroom = Classroom::find($id);

            $classroom->classroom_name = $request->input('classroom_name');
            $classroom->school_id = $request->school;
			$classroom->course_id = $request->course;
			$classroom->class_id = $request->class;
			$classroom->date = $request->input('date');
            $classroom->status = ($request->input('status') !== null)? $request->input('status'):0;

            $classroom->save();

            return redirect()->route('backend.classrooms.index')->with('success', 'Classroom Information Updated Successfully');
		}
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classroom = Classroom::find($id);
        $classroom->delete();
        
        return redirect()->route('backend.classrooms.index')->with('success', 'Classroom Deleted Successfully');
    }

}
