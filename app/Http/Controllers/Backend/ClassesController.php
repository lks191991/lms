<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Course;
use App\Models\SchoolCategory;
use App\Models\School;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Auth;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $query = School::where('status', '=', 1);

        $schools = $query->orderBy('school_name')
                ->pluck('school_name', 'id');

        //get all classes
        $classes = Classes::orderBy('id', 'desc')->get();

        return view('backend.classes.index', compact('classes', 'schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $query = SchoolCategory::where('status', '=', 1);

       

        $institutes = $query->orderBy('name')
                ->pluck('name', 'id');

        return view('backend.classes.create', compact('institutes'));
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

        $course_id = $data['course'];

        $course = Course::where('id', $course_id)->select('school_id')->first();

       

        if (!empty($request->input('ajax_request'))) {

            $validator = Validator::make($request->all(), [
                        'course' => 'required',
                        'class_name' => [
                            'required',
                            'max:180',
                            Rule::unique('classes')->where(function ($query) use($course_id) {
                                        return $query->where('course_id', $course_id);
                                    })
                        ],
            ]);
        } else {

            $validator = Validator::make($request->all(), [
                        'institute_type' => 'required',
                        'school' => 'required',
                        'course' => 'required',
                        'class_name' => [
                            'required',
                            'max:180',
                            Rule::unique('classes')->where(function ($query) use($course_id) {
                                        return $query->where('course_id', $course_id);
                                    })
                        ],
            ]);
        }

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::back()
                            ->withErrors($validator) // send back all errors to the form
                            ->withInput();
        }


        //form data is available in the request object
        $class = new Classes();

        $class->course_id = $request->input('course');
        $class->class_name = $request->input('class_name');
        $class->status = ($request->input('status') !== null) ? $request->input('status') : 0;

        $class->save();

        if (!empty($request->input('ajax_request'))) {
            return redirect()->route('backend.course.show', $class->course_id)->with('success', 'Class created Successfully');
        } else {
            return redirect()->route('backend.classes.index')->with('success', 'Class created Successfully');
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

        $class = Classes::findOrFail($id);
        $course = Course::where('id', $class->course_id)->select('school_id')->first();

        return view('backend.classes.show', compact('course', 'class'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
        $institutes = SchoolCategory::orderBy('name')->where('status', '=', 1)->pluck('name', 'id');

        $class = Classes::find($id);

        $course_details = Course::where("id", $class->course_id)->select('school_id')->first();
        $class->school_id = $course_details->school_id;

       

        $school_details = School::where("id", $class->school_id)->select('school_category')->where('status', '=', 1)->first();
        $class->category_id = $school_details->school_category;

        $schools = School::where('school_category', $class->category_id)->orderBy('school_name')->where('status', '=', 1)->pluck('school_name', 'id');

        $courses = Course::where('school_id', $class->school_id)->orderBy('name');

      

        $courses = $courses->where('status', '=', 1)->pluck('name', 'id');

        return view('backend.classes.edit', compact('class', 'institutes', 'schools', 'courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_ajax(Request $request)
    {
        $id = $request->input('class_id');
        $class = Classes::find($id);

        return view('backend.classes.edit-ajax', compact('class'));
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
        $class = Classes::find($id);
        $course_id = $class->course_id;

       
        if (!empty($request->input('ajax_request'))) {

            $validator = Validator::make($request->all(), [
                        'class_name' => [
                            'required',
                            'max:180',
                            Rule::unique('classes')->where(function ($query) use($course_id, $id) {
                                        return $query->where('course_id', $course_id)->where('id', '<>', $id);
                                    })
                        ],
            ]);
        } else {

            $validator = Validator::make($request->all(), [
                        'class_name' => [
                            'required',
                            'max:180',
                            Rule::unique('classes')->where(function ($query) use($course_id, $id) {
                                        return $query->where('course_id', $course_id)->where('id', '<>', $id);
                                    })
                        ],
            ]);

        }

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::back()
                            ->withErrors($validator) // send back all errors to the form
                            ->withInput();
        }


        $class->class_name = $request->input('class_name');
        $class->status = ($request->input('status') !== null) ? $request->input('status') : 0;

        $class->save();

        if (!empty($request->input('ajax_request'))) {
            return redirect()->route('backend.course.show', $class->course_id)->with('success', 'Class Information Updated Successfully');
        } else {
            return redirect()->route('backend.classes.index')->with('success', 'Class Information Updated Successfully');
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
        $class = Classes::find($id);
       
        if (isset($class->id) && !empty($class->id)) {
            $subjects = Subject::where('class_id', $class->id)->select('id')->get();
            foreach ($subjects as $subject) {
                if (isset($subject->id) && !empty($subject->id)) {
                    $topics = Topic::where('subject_id', $subject->id)->select('id')->get();
                    foreach ($topics as $topic) {
                        if (isset($topic->id) && !empty($topic->id))
                            $topic->delete();
                    }

                    $subject->delete();
                }
            }

        }

        $class->delete();

        if (!empty($request->input('ajax_request'))) {
            return redirect()->route('backend.course.show', $class->course_id)->with('success', 'Class Deleted Successfully');
        } else {
            return redirect()->route('backend.classes.index')->with('success', 'Class Deleted Successfully');
        }
    }

}
