<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Video;
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
        //$this->middleware('auth', ['except' => array('index','courseList','contactUs','contactUsPost')]);
    }
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		//session()->forget('newCustomer');
		$topCourses = Course::where('status', '=', 1)->limit(4)->get();
		$allCoursesList = Course::where('status', '=', 1)->get();
		$latestCourses = Course::where('status', '=', 1)->limit(8)->orderBy('created_at','DESC')->get();
		
        return view('frontend.home',compact('topCourses','latestCourses','allCoursesList'));
    }
	
	public function courseList(Request $request,$CourseId)
    {
		
		$allCourses = Subject::where('course_id', '=', $CourseId)->where('status', '=', 1)->orderBy('created_at','DESC')->paginate(20);
		
        return view('frontend.list',compact('allCourses'));
    }
	
	public function courseSearch(Request $request)
    {
		$data = $request->all();
		
		$query = Subject::where('status', '=', 1);
		if(isset($data['search_courses']) and !empty($data['search_courses']))
		{
			$query->where('course_id', '=', $data['search_courses']);
		}
		if(isset($data['search_text']) and !empty($data['search_text']))
		{
			$query->where('subject_name', 'like', '%' . $data['search_text'] . '%');
		}
		$allCourses = $query->orderBy('created_at','DESC')->paginate(20);
		
        return view('frontend.course_search',compact('allCourses'));
    }
	
	public function courseDetails($subjectId)
    {
		
		$subject = Subject::with('topics','subject_class')->where('id', '=', $subjectId)->where('status', '=', 1)->orderBy('created_at','DESC')->first();
		
		$course = Course::where('status', '=', 1)->where('id', '=', $subject->course_id)->first();
		$video = Video::where('status', '=', 1)->where('subject_id', '=', $subject->id)->first();
		if(!$video)
		{
		return redirect()->route('course-list',[$subject->course_id])->with('error', 'Course not available currently');

		}
        return view('frontend.subject_details',compact('subject','course','video'));
    }
	
	
	
	public function autoSearch(Request $request)
    {
          $query = $request->get('query');
          $filterResult = Subject::where('subject_name', 'LIKE', '%'. $query. '%')->get();
          return response()->json($filterResult);
    } 
	
	
}
