<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Course;
use App\Models\Classroom;
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
        $this->middleware('auth', ['except' => array('index')]);
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
		
		 $schools = School::where('status', '=', 1)->where('featured',1)
                           ->whereHas('latestVideo');
        $schools = $schools->orderBy('school_name', 'asc');
        $schools = $schools->paginate(10);
		
        return view('frontend.home',compact('schools'));
    }
}
