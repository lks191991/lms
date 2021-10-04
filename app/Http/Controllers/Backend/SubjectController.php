<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolCategory;
use App\Models\Subject;
use App\Models\Course;
use App\Models\Classes;
use App\Models\School;
use App\Models\Department;
use App\Models\Topic;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('school')) {
            return redirect()->route('backend.dashboard');
        }

        $query = School::where('status', '=', 1);

        if (Auth::user()->hasRole('school')) {
            $profile = Auth::user()->profile;
            if (isset($profile->school_id)) {
                $school_id = $profile->school_id;
                $query = $query->where('id', '=', $school_id);
            }
        }

        $schools = $query->orderBy('school_name')
                ->pluck('school_name', 'id');

        //get all subjects
        $subjects = Subject::orderBy('id', 'desc')->get();

        return view('backend.subjects.index', compact('subjects', 'schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasRole('school')) {
            return redirect()->route('backend.dashboard');
        }
        $institutes = SchoolCategory::orderBy('name')->where('status', '=', 1)->pluck('name', 'id');
        return view('backend.subjects.create', compact('institutes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $class_id = $request->input('class');

        $classes_details = Classes::where('id', $class_id)->first();

        if (!Auth::user()->hasAccessToSchool($classes_details->course->school_id)) {
            return redirect()->route('backend.dashboard');
        }

        $validator = Validator::make($request->all(), [
                    'subject_name' => [
                        'required',
                        'max:180',
                        Rule::unique('subjects')->where(function ($query) use($class_id) {
                                    return $query->where('class_id', $class_id);
                                })
                    ],
        ]);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::back()
                            ->withErrors($validator) // send back all errors to the form
                            ->withInput();
        }

        //form data is available in the request object
        $subject = new Subject();

        $subject->subject_name = $request->input('subject_name');
        $subject->class_id = $request->input('class');
        $subject->status = ($request->input('status') !== null) ? $request->input('status') : 0;

        $subject->save();

        if (!empty($request->input('ajax_request'))) {
            return redirect()->route('backend.classes.show', $subject->class_id)->with('success', 'Subject created Successfully');
        } else {
            return redirect()->route('backend.subjects.index')->with('success', 'Subject created Successfully');
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
        $subject = Subject::findOrFail($id);

        $classes_details = Classes::where('id', $subject->class_id)->first();

        if (!Auth::user()->hasAccessToSchool($classes_details->course->school_id)) {
            return redirect()->route('backend.dashboard');
        }


        $class = Classes::findOrFail($subject->class_id);
        $course = Course::findOrFail($class->course_id);

        return view('backend.subjects.show', compact('subject', 'class', 'course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->hasRole('school')) {
            return redirect()->route('backend.dashboard');
        }
        //Find the subject
        $subject = Subject::find($id);

        $institutes = SchoolCategory::orderBy('name')->where('status', '=', 1)->pluck('name', 'id');
        $classes_details = Classes::where("id", $subject->class_id)->select('course_id')->where('status', '=', 1)->first();
        $subject->course_id = $classes_details->course_id;

        $course_details = Course::where("id", $subject->course_id)->select('school_id', 'department_id')->where('status', '=', 1)->first();
        $subject->school_id = $course_details->school_id;

        $subject->department_id = $course_details->department_id;

        $departments = Department::where('school_id', $subject->school_id)->where('status', '=', 1)->pluck('name', 'id');

        $school_details = School::where("id", $subject->school_id)->select('school_category')->where('status', '=', 1)->first();
        $subject->category_id = $school_details->school_category;

        $schools = School::where('school_category', $subject->category_id)->orderBy('school_name')->where('status', '=', 1)->pluck('school_name', 'id');
        $courses = Course::where('school_id', $subject->school_id)->orderBy('name')->where('status', '=', 1)->pluck('name', 'id');
        $classes = Classes::where('course_id', $subject->course_id)->orderBy('class_name')->where('status', '=', 1)->pluck('class_name', 'id');

        return view('backend.subjects.edit', compact('subject', 'institutes', 'schools', 'courses', 'classes', 'departments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_ajax(Request $request)
    {
        $id = $request->input('subject_id');
        $subject = Subject::find($id);

        return view('backend.subjects.edit-ajax', compact('subject'));
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
        $subject = Subject::find($id);
        $class_id = $subject->class_id;

        $classes_details = Classes::where('id', $class_id)->first();

        if (!Auth::user()->hasAccessToSchool($classes_details->course->school_id)) {
            return redirect()->route('backend.dashboard');
        }

        $validator = Validator::make($request->all(), [
                    'subject_name' => [
                        'required',
                        'max:180',
                        Rule::unique('subjects')->where(function ($query) use($class_id, $id) {
                                    return $query->where('class_id', $class_id)->where('id', '<>', $id);
                                })
                    ],
        ]);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::back()
                            ->withErrors($validator) // send back all errors to the form
                            ->withInput();
        }

        $subject->subject_name = $request->input('subject_name');
        $subject->status = ($request->input('status') !== null) ? $request->input('status') : 0;
        $subject->save(); //persist the data

        if (!empty($request->input('ajax_request'))) {
            return redirect()->route('backend.classes.show', $subject->class_id)->with('success', 'Subject Information Updated Successfully');
        } else {
            return redirect()->route('backend.subjects.index')->with('success', 'Subject Information Updated Successfully');
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
        $subject = Subject::find($id);

        $classes_details = Classes::where('id', $subject->class_id)->first();

        if (!Auth::user()->hasAccessToSchool($classes_details->course->school_id)) {
            return redirect()->route('backend.dashboard');
        }

        if (isset($subject->id) && !empty($subject->id)) {
            $topics = Topic::where('subject_id', $subject->id)->select('id')->get();
            foreach ($topics as $topic) {
                if (isset($topic->id) && !empty($topic->id))
                    $topic->delete();
            }
        }

        $subject->delete();

        if (!empty($request->input('ajax_request'))) {
            return redirect()->route('backend.classes.show', $subject->class_id)->with('success', 'Subject Deleted Successfully');
        } else {
            return redirect()->route('backend.subjects.index')->with('success', 'Subject Deleted Successfully');
        }
    }

}
