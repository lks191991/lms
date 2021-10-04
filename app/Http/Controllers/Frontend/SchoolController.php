<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\Course;
use App\Models\Classes;
use App\Models\Video;
use Illuminate\Http\Request;
use GLB;

class SchoolController extends Controller
{
    /**
     * Show school list.
     *
     */
    public function search(Request $request)
    {
        $errMessage = "Videos not available in your selection";
        $errType = 'error';
        $errStatus = 0;

        $institution_id = $request->input('institution_id');
        $school_id = $request->input('school_id');
        $course_id = $request->input('course_id');
        $class_id = $request->input('class_id');
        
        if($institution_id == School::BASIC_SCHOOL){
             if(empty($course_id)) {                 
                $school = School::find($school_id);
                if(!empty($school->coursesList[0])) {
                    $course = $school->coursesList[0];
                   $course_id = $course->id;
                }
             }
         }

         if(!empty($class_id)){
             $avilable_class = Classes::where('id', $class_id)
                               ->where('status', '=', 1)
                               ->whereHas('latestVideo')
                               ->first();
             
            if($avilable_class) {
                return redirect()->route('frontend.classroom', $avilable_class->uuid);
            }             
         }

        return redirect('/');
    }
    
    /**
     * Show search Result
     *
     */
    public function searchResult(Request $request)
    {
        $errMessage = "Videos not available in your selection";
        $errType = 'error';
        $errStatus = 0;
        
        $schools = School::where('status', '=', 1)
                           ->whereHas('latestVideoWithKey')->get();
        
        $course = Course::where('status', '=', 1)
                           ->whereHas('latestVideoWithKey')->get();
        
        $classes = Classes::where('status', '=', 1)
                           ->withCount('latestVideoWithKey')->get();
        
        $total_items = array(
            'schools' => $schools->count(),
            'courses' => $course->count(),
            'classes' => $classes->sum('latest_video_with_key_count')
        );
                
        return view('frontend.schools.index', compact('errMessage', 'errType', 'errStatus','total_items'));
    }

    /**
     * Show school ajax data.
     *
     */
    public function schoolData(Request $request)
    {
        $tab = $request->tab;
        $loadMore = $request->loadMore;
        $page = $request->input('page', 1);
        
        $schools = School::where('status', '=', 1)
                           ->whereHas('latestVideoWithKey');

                
//        if (!empty($request->search_input)) {
//            $search_input = "'%" . trim($request->search_input) . "%'";
//            $schools = $schools->whereRaw(" (
//			school_name LIKE  $search_input or description LIKE  $search_input)");
//        }
//        if (!empty($request->school_id)) {
//            $schools = $schools->where("id", $request->school_id);
//        }
//        if (!empty($request->institution_id)) {
//            $schools = $schools->where("school_category", $request->input('institution_id'));
//        }

        $schools = $schools->orderBy('school_name', 'asc');
        $schools = $schools->paginate(GLB::paginate());


        return view('frontend.schools.school_search', compact('schools', 'tab', 'loadMore', 'page'));
    }

    /**
     * Show course ajax data.
     *
     */
    public function courseData(Request $request)
    {
        $tab = $request->tab;
        $loadMore = $request->loadMore;
        $page = $request->input('page', 1);
                      

        $courses = Course::where('status', '=', 1)
                           ->whereHas('latestVideoWithKey');

        
        $courses = $courses->whereHas('school', function ($query1) {
                             $query1->where('status', '=', 1);                             
                        });
        $courses = $courses->paginate(GLB::paginate());

        return view('frontend.schools.course_search', compact('courses', 'tab', 'loadMore', 'page'));
    }

    /**
     * Show classes ajax data.
     *
     */
    public function classesData(Request $request)
    {
        $tab = $request->tab;
        $loadMore = $request->loadMore;
        $page = $request->input('page', 1);

        $query = Video::where('status', '=', 1)
                          ->where('play_on', '<=', date('Y-m-d'));
        
        $keyword = $request->search_input;  
        
        
        if (!empty($keyword)) {
            $query = $query->where(function($qry) use ($keyword){
                                    $qry->whereHas('subject', function ($query1) use ($keyword)
                                            {
                                                 $query1->where('subject_name', 'LIKE', '%'.$keyword.'%');
                                            });
                                    $qry->orWhereHas('topic', function ($query2) use ($keyword)
                                            {
                                                 $query2->where('topic_name', 'LIKE', '%'.$keyword.'%');
                                            });
                                    $qry->orWhereHas('school', function ($query3) use ($keyword)
                                            {
                                                 $query3->where('school_name', 'LIKE', '%'.$keyword.'%');
                                            });
                                    $qry->orWhereHas('course', function ($query4) use ($keyword)
                                            {
                                                 $query4->where('name', 'LIKE', '%'.$keyword.'%');
                                            });
                                });
        }
        
        $query = $query->whereHas('school', function ($query1) {
                             $query1->where('status', '=', 1);                             
                        })->whereHas('course', function ($query2) {
                             $query2->where('status', '=', 1);                             
                        })->whereHas('classDetail', function ($query3) {
                             $query3->where('status', '=', 1);                             
                        })->whereHas('subject', function ($query4) {
                             $query4->where('status', '=', 1);                             
                        })->whereHas('topic', function ($query5) {
                             $query5->where('status', '=', 1);                             
                        });
        
        $query = $query->orderBy('play_on', 'Desc');
        $videos = $query->paginate(GLB::paginate());        

        return view('frontend.schools.classes_search', compact('videos', 'tab', 'loadMore', 'page'));
    }

}
