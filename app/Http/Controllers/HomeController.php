<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Subject;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => array('index','courseList')]);
		session()->forget('newCustomer');
    }
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		session()->forget('newCustomer');
		$topCourses = Course::where('status', '=', 1)->limit(4)->get();
		$latestCourses = Course::where('status', '=', 1)->limit(8)->orderBy('created_at','DESC')->get();
		
        return view('frontend.home',compact('topCourses','latestCourses'));
    }
	
	public function courseList(Request $request,$CourseId)
    {
		
		$allCourses = Subject::where('course_id', '=', $CourseId)->where('status', '=', 1)->orderBy('created_at','DESC')->paginate(4);
		
        return view('frontend.list',compact('allCourses'));
    }
}
