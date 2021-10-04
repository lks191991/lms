<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Period;
use App\Models\SchoolCategory;
use App\Models\Classes;
use App\Models\Course;
use App\Models\School;
use App\Models\Department;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Auth;

class PeriodController extends Controller
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


        //get all periods
        $periods = Period::orderBy('id', 'desc')->get();

        return view('backend.periods.index', compact('periods', 'schools'));
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

        return view('backend.periods.create', compact('institutes'));
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

        $title = $data['title'];
        $class_id = $data['class'];

        $classes_details = Classes::where('id', $class_id)->first();

        if (!Auth::user()->hasAccessToSchool($classes_details->course->school_id)) {
            return redirect()->route('backend.dashboard');
        }

        $validator = Validator::make($request->all(), [
                    'class' => 'required',
                    'title' => [
                        'required',
                        'max:180',
                        Rule::unique('periods')->where(function ($query) use($class_id) {
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
        $period = new Period();

        $period->title = $request->input('title');
        $period->class_id = $request->input('class');
        $period->status = ($request->input('status') !== null) ? $request->input('status') : 0;

        $period->save();

        if (!empty($request->input('ajax_request'))) {
            return redirect()->route('backend.classes.show', $period->class_id)->with('success', 'Period created Successfully');
        } else {
            return redirect()->route('backend.periods.index')->with('success', 'Period created Successfully');
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
        $period = Period::find($id);
        $class = Classes::where('id', $period->class_id)->first();

        if (!Auth::user()->hasAccessToSchool($class->course->school_id)) {
            return redirect()->route('backend.dashboard');
        }

        return redirect()->route('backend.periods.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if (Auth::user()->hasRole('school')) {
            return redirect()->route('backend.dashboard');
        }
        $period = Period::find($id);


        $institutes = SchoolCategory::orderBy('name')->where('status', '=', 1)->pluck('name', 'id');
        $classes_details = Classes::where("id", $period->class_id)->select('course_id')->where('status', '=', 1)->first();
        $period->course_id = $classes_details->course_id;

        $course_details = Course::where("id", $period->course_id)->select('school_id', 'department_id')->where('status', '=', 1)->first();
        $period->school_id = $course_details->school_id;
        $period->department_id = $course_details->department_id;

        $departments = Department::where('school_id', $period->school_id)->where('status', '=', 1)->pluck('name', 'id');

        $school_details = School::where("id", $period->school_id)->select('school_category')->where('status', '=', 1)->first();
        $period->category_id = $school_details->school_category;

        $schools = School::where('school_category', $period->category_id)->orderBy('school_name')->where('status', '=', 1)->pluck('school_name', 'id');
        $courses = Course::where('school_id', $period->school_id)->orderBy('name')->where('status', '=', 1)->pluck('name', 'id');
        $classes = Classes::where('course_id', $period->course_id)->orderBy('class_name')->where('status', '=', 1)->pluck('class_name', 'id');

        return view('backend.periods.edit', compact('period', 'institutes', 'schools', 'courses', 'classes', 'departments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_ajax(Request $request)
    {
        $id = $request->input('period_id');
        $period = Period::find($id);

        return view('backend.periods.edit-ajax', compact('period'));
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

        $period = Period::find($id);
        $class_id = $period->class_id;

        $classes_details = Classes::where('id', $class_id)->first();

        if (!Auth::user()->hasAccessToSchool($classes_details->course->school_id)) {
            return redirect()->route('backend.dashboard');
        }

        $validator = Validator::make($request->all(), [
                    'title' => [
                        'required',
                        'max:180',
                        Rule::unique('periods')->where(function ($query) use($class_id, $id) {
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

        $period->title = $request->input('title');
        $period->status = ($request->input('status') !== null) ? $request->input('status') : 0;

        $period->save();

        if (!empty($request->input('ajax_request'))) {
            return redirect()->route('backend.classes.show', $period->class_id)->with('success', 'Period Information Updated Successfully');
        } else {
            return redirect()->route('backend.periods.index')->with('success', 'Period Information Updated Successfully');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveOrdering(Request $request)
    {
        $weights = $request->get('weight');
        foreach ($weights as $id => $weight) {
            Period::where('id', '=', $id)->update(['weight' => $weight]);
        }
        exit;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $period = Period::find($id);

        $classes_details = Classes::where('id', $period->class_id)->first();

        if (!Auth::user()->hasAccessToSchool($classes_details->course->school_id)) {
            return redirect()->route('backend.dashboard');
        }

        $period->delete();

        if (!empty($request->input('ajax_request'))) {
            return redirect()->route('backend.classes.show', $period->class_id)->with('success', 'Period Deleted Successfully');
        } else {
            return redirect()->route('backend.periods.index')->with('success', 'Period Deleted Successfully');
        }
    }

}
