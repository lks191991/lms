<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\SiteHelpers;
use Auth;
use App\Models\School;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$school_id = '';
        //Check for the user profile      
        if(Auth::user()->hasRole('school') && isset(Auth::user()->profile->school_id)){
            $school = new SchoolController();
			$school_id = Auth::user()->profile->school_id;
            return $school->show(Auth::user()->profile->school_id);
        }
        
		$institute_count = SiteHelpers::dashboard_resource_count('school_categories');
		$school_count = SiteHelpers::dashboard_resource_count('schools', $school_id);
		$department_count = SiteHelpers::dashboard_resource_count('departments', $school_id);
		$courses_count = SiteHelpers::dashboard_resource_count('courses', $school_id);
		$classes_count = SiteHelpers::dashboard_resource_count('classes');
		$periods_count = SiteHelpers::dashboard_resource_count('periods');
		$subject_count = SiteHelpers::dashboard_resource_count('subjects');
		$topic_count = SiteHelpers::dashboard_resource_count('topics');
		$videos_count = SiteHelpers::dashboard_resource_count('videos', $school_id);
		$student_count = SiteHelpers::dashboard_resource_count('students', $school_id);
		$tutor_count = SiteHelpers::dashboard_resource_count('tutors', $school_id);
		$schoolmanager_count = SiteHelpers::dashboard_resource_count('school_managers');
		
		$title = "XtraClass Dashboard";
		
		if(Auth::user()->hasRole('school') && isset(Auth::user()->profile->school_id)){
			$school_details = School::where('id', $school_id)->first();
			return view('backend.schooldashboard', compact('title', 'school_count', 'department_count', 'courses_count', 
												 'videos_count', 'student_count', 'tutor_count', 'school_details'));
												 
		} else {
			
			return view('backend.dashboard', compact('title', 'institute_count', 'school_count', 'department_count', 'courses_count', 
												 'classes_count', 'periods_count', 'subject_count', 'topic_count', 'videos_count', 
												 'student_count', 'tutor_count', 'schoolmanager_count'));
		
        }
	}
}