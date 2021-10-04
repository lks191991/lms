<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\Course;
use App\Models\Classroom;
use App\Models\Question;
use App\Models\Video;
use App\Models\StudentVideo;
use App\Models\StudentFavourites;
use App\Models\StudentHistory;
use App\Models\SchoolCategory;
use App\Models\StudentDownload;
use App\Models\SchoolSemester;
use App\Models\ReportVideo;
use App\Models\Classes;
use App\Models\Note;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Auth;
use GLB;
use URL;
use Twilio\Rest\Client;
use Session;

class ClassroomController extends Controller
{
    /**
     * Show classroom index file.
     *
     */
    public function index($id, Request $request)
    {
        
        
        $play_on = date("Y-m-d");
        if (!empty($request->input('video'))) {
            $defaultVideo = Video::where('uuid', $request->input('video'))->where('status', 1)->firstOrFail();
            $classroom = Classes::where('id', $defaultVideo->class_id)->where([
                        'status' => 1
                    ])->firstOrFail();
        } else {

            $classroom = Classes::where('uuid', $id)->where([
                        'status' => 1
                    ])->firstOrFail();
            
            $defaultVideo = Video::where('videos.status', 1)
                                ->leftJoin('periods','periods.id','=','videos.period_id')
                                ->where('videos.class_id', $classroom->id)
                                ->where('videos.play_on', '<=', $play_on)
                                ->select('videos.*')
                                ->orderBy('videos.play_on', 'desc')
                                ->orderBy('periods.weight','ASC')
                                ->orderBy('periods.id','ASC')
                                ->first();            
        }
        
        //check for loggedin user have permission to access a class of a locked school
        if($classroom->course->school->is_locked){            
            $has_access = false;
            if (Auth::check() && Auth::user()->id) { 
                //check if user id amdin or school manager
                if(Auth::user()->hasRole('admin')){
                    $has_access = true;
                } 
                else if(Auth::user()->hasRole('school') && isset(Auth::user()->profile->school_id))
                {
                    if($classroom->course->school->id == Auth::user()->profile->school_id){ 
                        $has_access = true;
                    }
                }
                
                //check user have this class access
                $has_class = \DB::table('student_classes')
                                    ->where('user_id','=',Auth::user()->id)
                                    ->where('class_id','=',$classroom->id)
                                    ->count();
                if($has_class > 0){
                    $has_access = true;
                }
            }   
            
            if(!$has_access){
                return redirect()->back()->with('jsError', 'Sorry, You are not allowed to access this classroom');
            }
        }
        
        $classroom_id = $classroom->id;
        $totalViews = Video::where('status', 1)->where('class_id', $classroom_id)->count();


        if (empty($defaultVideo->id)) {
            return redirect('/')->with('jsError', 'Videos not available in your selection criteria.');
        }
        $years = Video::where('status', 1)->where('class_id', $classroom_id)->selectRaw('YEAR(play_on) AS year')->groupBy('year')->get();
        $student_id = 0;
        $page = $request->input('page', 1);
        if (Auth::check()) {
            $student_id = Auth::user()->id;
            $video = Video::where('id', $defaultVideo->id)->first();
            $stFav = StudentFavourites::where(['video_id' => $defaultVideo->id, 'student_id' => $student_id])->first();
            $reportVideo = ReportVideo::where(['video_id' => $defaultVideo->id, 'user_id' => $student_id])->first();
           
        }

         $note = Note::where(['id' => $defaultVideo->note_id, 'status' => 1])->first();

        $fav_status = 0;
        $fleg_status = 0;
        $note_url = '';
        $notes_id = 0;
        $lern_more = 0;

        if (!empty($stFav->id) && $student_id) {
            $fav_status = 1;
        }

        if (!empty($reportVideo->id) && $student_id) {
            $fleg_status = 1;
        }

        if (!empty($defaultVideo->noteURL())) {
            $note_url = $defaultVideo->noteURL();
            $notes_id = $note->id;
        }

        if (!empty($video->article_id)) {
            $lern_more = URL::to('article/' . $video->article_id);
        }

        $this->studentVideo($defaultVideo->id,$student_id);
        if(empty($defaultVideo->total_views)){
            $total_views = 1;
        }else{
            $total_views = $defaultVideo->total_views+1;
        }
        $defaultVideo->total_views = $total_views;
        $defaultVideo->save();
		$dateRangeArray = $this->dateRange($defaultVideo);
        return view('frontend.classroom.index', compact('years', 'fav_status', 'note_url', 'notes_id', 'lern_more', 'classroom_id', 'defaultVideo', 'classroom', 'totalViews','fleg_status','dateRangeArray'));
    }
	public function dateRange($defaultVideo){
		
		
	
	
	$dateRange = Video::whereBetween('play_on',[date("Y-m-01",strtotime($defaultVideo->play_on)),date("Y-m-t",strtotime($defaultVideo->play_on))])
                                    ->where('play_on','<=',date('Y-m-d'))
                                    ->where('status',1)
                                    ->where('school_id',$defaultVideo->school_id)
                                    ->where('class_id',$defaultVideo->class_id)
                                    ->orderBy('play_on','asc')
                                    ->pluck('play_on','play_on');
									
									
        $firstDate = '';
        if(!empty($defaultVideo->play_on) && !empty($dateRange[$defaultVideo->play_on])){
			$firstDate = $defaultVideo->play_on;
		} else if(!empty($dateRange)){
            $firstDate = collect($dateRange)->keys()->first();
        }
		if(!empty($dateRange))
		{
			$dateRange = collect($dateRange)->toArray();
		}else{
			$dateRange = array();
		}
		
		$semesters = $this->getSemesterOptionsArray($defaultVideo->school_id,$defaultVideo->play_on);
		//echo "<pre>"; print_r($dateRange); exit;
        return $returnArray = (object) array('dateRange' => $dateRange,'firstDate' => $firstDate,'semesters' => $semesters->returnArray,'defaultSemesterId' => $semesters->defaultSemesterId);
	}
	
	public function getSemesterOptionsArray($school_id,$playOn)
    {

		$year              = date('Y',strtotime($playOn));
        $school            = School::find($school_id);
        $defaultSemesterId = 0;
		
        $schoolSemesters = SchoolSemester::where([
                    'school_id' => $school_id,
                    'category_id' => $school->school_category
                ])->get();

        $returnArray = array();
        $getSemesterNameArray = $school->semesterNameArray();

        if (!empty($schoolSemesters)) {
            foreach ($schoolSemesters as $schoolSemester) {
                if (!empty($getSemesterNameArray[$schoolSemester->semester])) {

                    $date_begin = date("m-d", strtotime($schoolSemester->date_begin));
                    $date_end = date("m-d", strtotime($schoolSemester->date_end));
					
					$returnDateBegin = $year . '-' . $date_begin;
                    $returnDateEnd   = $year . '-' . $date_end;
					
					if(strtotime($returnDateBegin) <= strtotime($playOn) && strtotime($returnDateEnd) >= strtotime($playOn))
					{
					  $defaultSemesterId = $schoolSemester->id;	
					}

                    $returnArray[$schoolSemester->id] = (object) array(
                                'id' => $schoolSemester->id,
                                'school_id' => $schoolSemester->school_id,
                                'category_id' => $schoolSemester->category_id,
                                'semester' => $getSemesterNameArray[$schoolSemester->semester],
                                'date_begin' => $returnDateBegin,
                                'date_end' => $returnDateEnd,
                                'days_count' => $schoolSemester->days_count
                    );
                }
            }
        }

        return (object) array('returnArray' => $returnArray,'defaultSemesterId' => $defaultSemesterId);
    }

    function studentVideo($video_id,$student_id){
        
		if(!empty($video_id)){
			Session::put('continue_video_id',$video_id);
		}
    if ($student_id > 0) {
            $StudentVideo = StudentVideo::where([
                        'video_id' => $video_id,
                        'student_id' => $student_id
                    ])
                    ->first();

            if (!empty($StudentVideo->id)) {
                $insertUpdate = $StudentVideo;
                $watchCount = $StudentVideo->video_watch_count + 1;
            } else {
                $insertUpdate = new StudentVideo;
                $watchCount = 1;
            }
            
            $insertUpdate->video_id = $video_id;
            $insertUpdate->student_id = $student_id;
            $insertUpdate->video_watch_count = $watchCount;
            $insertUpdate->save();

            $studentHistory = new StudentHistory;
            $studentHistory->student_id = $student_id;
            $studentHistory->video_id = $video_id;
            $studentHistory->save();

            $status = 1;
            $messageType = 'Success';
            $message = 'Successfully played video.';
        }
    }

    /**
     * Show playing ajax data.
     *
     */
    public function playingData(Request $request)
    {

        $slTable = (new StudentVideo)->getTable() . ' as sl';
        $student_id = 0;
        $page = $request->input('page', 1);
        if (Auth::check()) {
            $student_id = Auth::user()->id;
        }

        $play_on = $request->play_on;
        $tab = $request->tab;
        $loadMore = $request->loadMore;
        $classroom_id = $request->classroom_id;

        $videos = Video::leftJoin($slTable, function($join) use ($student_id) {
                    $join->on('videos.id', 'sl.video_id');
                    $join->where('sl.student_id', $student_id);
                })
                ->where(['videos.status' => 1, 'videos.class_id' => $classroom_id, 'videos.play_on' => $play_on])
                ->where(function($where) use ($request) {
                    if (!empty($request->video)) {
                        //$where->where('videos.id',$request->video);
                    }
                })
                ->leftJoin('periods','periods.id','=','videos.period_id')
                //->orderBy('videos.id','desc')
                ->orderBy('periods.weight','ASC')
                ->orderBy('periods.id','ASC')
                ->selectRaw('videos.*, sl.video_watch_count')
                ->paginate(GLB::paginate());


        return view('frontend.classroom.playing', compact('tab', 'loadMore', 'videos', 'page'));
    }

    /**
     * Show questions ajax data.
     *
     */
    public function questionsData(Request $request)
    {
        $slTable = (new StudentVideo)->getTable() . ' as sl';
        $student_id = 0;
        $page = $request->input('page', 1);
        if (Auth::check()) {
            $student_id = Auth::user()->id;
        }

        $tab = $request->tab;
        $loadMore = $request->loadMore;
        $classroom_id = $request->classroom_id;
        $video_id = $request->video_id;

        //$account = Question::where('parent_id',0)->with('childrenAccounts')->paginate(5);
        $questions = Question::where([
                    'class_id' => $classroom_id,
                    'video_id' => $video_id,
                    'parent_id' => 0
                ])
                //->with('childrenAccounts')
                ->orderBy('id', 'desc')
                ->paginate(GLB::paginate());

        return view('frontend.classroom.questions', compact('tab', 'loadMore', 'questions', 'page'));
    }

    /**
     * Show archive ajax data.
     *
     */
    public function archiveData(Request $request)
    {

        $student_id = 0;
        $page = $request->input('page', 1);
        if (Auth::check()) {
            $student_id = Auth::user()->id;
        }

        $tab = $request->tab;
        $loadMore = $request->loadMore;
        $classroom_id = $request->classroom_id;

        $videos = Video::where(['status' => 1, 'class_id' => $classroom_id])->paginate(GLB::paginate());


        return view('frontend.classroom.archive', compact('tab', 'loadMore', 'videos', 'page'));
    }

    /**
     * Show favourites ajax data.
     *
     */
    public function favouritesData(Request $request)
    {


        $student_id = 0;
        $page = $request->input('page', 1);
        if (Auth::check()) {
            $student_id = Auth::user()->id;
        }

        $tab = $request->tab;
        $loadMore = $request->loadMore;
        $classroom_id = $request->classroom_id;

        $studentFavorites = StudentFavourites::leftJoin('videos', function($join) use ($student_id) {
                    $join->on('videos.id', 'student_favourites.video_id');
                    $join->where('student_favourites.student_id', $student_id);
                })
                ->where(['videos.status' => 1, 'videos.class_id' => $classroom_id])
                ->orderBy('student_favourites.id', 'desc')
                ->selectRaw('videos.*')
                ->paginate(GLB::paginate());

        return view('frontend.classroom.favourites', compact('tab', 'loadMore', 'studentFavorites', 'page'));
    }

    /**
     * Show nsert play video status 
     * 		and count by ajax data.
     *
     */
    public function playVideo(Request $request)
    {
        $tab = $request->tab;
        $loadMore = $request->loadMore;
        $video_id = $request->lession_id;
        $student_id = 0;
        $status = 0;
        $messageType = '';
        $message = '';
        $watchCount = 1;
        $fav_status = 0;
        $fleg_status = 0;
        $note_url = '';
        $notes_id = 0;
        $lern_more = '';

        if (Auth::check()) {
            $student_id = Auth::user()->id;
        }
		
		if(!empty($video_id)){
			Session::put('continue_video_id',$video_id);
		}

        $video = Video::where('id', $video_id)->first();
        $stFav = StudentFavourites::where(['video_id' => $video_id, 'student_id' => $student_id])->first();
        $note = Note::where(['id' => $video->note_id, 'status' => 1])->first();
        $reportVideo = ReportVideo::where(['video_id' => $video_id, 'user_id' => $student_id])->first();
        $totalViewsVal = $video->total_views+1;
        if (!empty($stFav->id) && $student_id) {
            $fav_status = 1;
        }

        if (!empty($reportVideo->id) && $student_id) {
            $fleg_status = 1;
        }

        if (!empty($video->noteURL())) {
            $note_url = $video->noteURL();
            $notes_id = $note->id;
        }

        if (!empty($video->article_id)) {
            $lern_more = URL::to('article/' . $video->article_id);
        }

        $video->total_views = $video->total_views + 1;
        $video->save();


        if ($student_id > 0) {
            $StudentVideo = StudentVideo::where([
                        'video_id' => $video_id,
                        'student_id' => $student_id
                    ])
                    ->first();

            if (!empty($StudentVideo->id)) {
                $insertUpdate = $StudentVideo;
                $watchCount = $StudentVideo->video_watch_count + 1;
            } else {
                $insertUpdate = new StudentVideo;
                $watchCount = 1;
            }
            $insertUpdate->video_id = $video_id;
            $insertUpdate->student_id = $student_id;
            $insertUpdate->video_watch_count = $watchCount;
            $insertUpdate->save();

            $studentHistory = new StudentHistory;
            $studentHistory->student_id = $student_id;
            $studentHistory->video_id = $video_id;
            $studentHistory->save();

            $status = 1;
            $messageType = 'Success';
            $message = 'Successfully played video.';
        } else {

            $status = 0;
            $messageType = 'Error';
            $message = 'You are not loged in.';
        }
		
		
//$pos=strpos(strip_tags($video->title), ' ', 100);
 

        $returnMsg = (object) array(
                    'title' => substr(strip_tags($video->title),0,60),
                    'description' => substr(strip_tags($video->description),0,160),
                    'keywords' => substr(strip_tags($video->keywords),0,150),
                    'videoData' => $video,
                    'fav_status' => $fav_status,
                    'fleg_status' => $fleg_status,
                    'video_id' => $video_id,
                    'lern_more' => $lern_more,
                    'totalViewsVal' => $totalViewsVal." Views",
                    'note_url' => $note_url,
                    'notes_id' => $notes_id,
                    'status' => $status,
                    'messageType' => $messageType,
                    'message' => $message
        );
        return response()->json($returnMsg);
    }

    public function postQuestions(Request $request)
    {

        $sender_id = 0;
        $status = 0;
        $messageType = '';
        $message = '';
        $watchCount = 1;

        $validator = Validator::make($request->all(), [
                    'content' => 'required'
                        ], [
                    "content.required" => "The question field is required."
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors()->all();
            $status = 0;
            $messageType = 'error';
            $message = collect($errors)->implode('<br>');
        } else {

            if (Auth::check()) {
                $sender_id = Auth::user()->id;
            }

            if ($sender_id > 0) {

                $insertQuestion = new Question;
                $insertQuestion->content = $request->input('content');
                $insertQuestion->type = $request->input('sender_type');
                $insertQuestion->parent_id = $request->input('parent_id');
                $insertQuestion->sender_id = $sender_id;
                $insertQuestion->class_id = $request->input('classroom_id');
                $insertQuestion->video_id = $request->input('video_id');
                $insertQuestion->save();

                $status = 1;
                $messageType = 'success';
                $message = 'Question posted successfully.';
            } else {

                $status = 0;
                $messageType = 'error';
                $message = 'You are not loged in.';
            }
        }

        $returnMsg = (object) array(
                    'status' => 200,
                    'errStatus' => $status,
                    'messageType' => $messageType,
                    'message' => $message
        );
        $returnData['data'] = $returnMsg;
        return response()->json($returnMsg, 200);
    }

    public function setFavourites(Request $request)
    {


        $student_id = 0;
        $isLogin = 0;
        $fav_status = $request->input('fav_status');

        if (Auth::check()) {
            $student_id = Auth::user()->id;
            $isLogin = 1;
        }


        if ($student_id > 0) {

            $check = StudentFavourites::where(['video_id' => $request->input('video_id'), 'student_id' => $student_id])->first();

            if (!empty($check->id)) {

                $check->delete();
                $status = 1;
                $messageType = 'success';
                $message = 'Successfully removed in your favourite list.';
                $fav_status = 0;
            } else {

                $insert = new StudentFavourites;
                $insert->student_id = $student_id;
                $insert->video_id = $request->input('video_id');
                $insert->save();
                $fav_status = 1;

                $status = 1;
                $messageType = 'success';
                $message = 'Successfully added in your favourite list.';
            }
        } else {

            $status = 0;
            $isLogin = 0;
            $messageType = 'error';
            $message = 'You are not loged in.';
        }


        $returnMsg = (object) array(
                    'status' => 200,
                    'errStatus' => $status,
                    'isLogin' => $isLogin,
                    'messageType' => $messageType,
                    'fav_status' => $fav_status,
                    'video_id' => $request->input('video_id'),
                    'message' => $message
        );
        $returnData['data'] = $returnMsg;
        return response()->json($returnMsg, 200);
    }

    public function flegVideo(Request $request)
    {
        $user_id = 0;
        $isLogin = 0;
        $fleg_status = $request->input('fleg_status');

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $isLogin = 1;
        }

        $validator = Validator::make($request->all(), [
                    'message' => 'required'
                        ], [
                    "message.required" => "Please describe your reason."
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors()->all();
            $status = 0;
            $messageType = 'error';
            $message = collect($errors)->implode('<br>');
        } else {

            
            if ($user_id > 0) {

                $check = ReportVideo::where(['video_id' => $request->input('video_id'), 'user_id' => $user_id])->first();

                if (!empty($check->id)) {

                    $check->delete();
                    $status = 1;
                    $messageType = 'success';
                    $message = 'Successfully removed your reported video.';
                    $fleg_status = 0;
                } else {

                    $insert = new ReportVideo;
                    $insert->user_id  = $user_id;
                    $insert->video_id = $request->input('video_id');
                    $insert->message  = $request->input('message');
                    $insert->save();
                    $fleg_status = 1;

                    $status = 1;
                    $messageType = 'success';
                    $message = 'Successfully reported your video.';
                }
            } else {

                $status = 0;
                $isLogin = 0;
                $messageType = 'error';
                $message = 'You are not loged in.';
            }

        }

        $returnMsg = (object) array(
                    'status' => 200,
                    'errStatus' => $status,
                    'isLogin' => $isLogin,
                    'messageType' => $messageType,
                    'fleg_status' => $fleg_status,
                    'video_id' => $request->input('video_id'),
                    'message' => $message
        );
        $returnData['data'] = $returnMsg;
        return response()->json($returnMsg, 200);
    }

    public function archiveSearch(Request $request)
    {

        $student_id = 0;
        $isLogin = 0;
        $classroom_id = $request->input('classroom_id');
        $school_id = $request->input('school_id');
        $course_id = $request->input('course_id');
        $class_id = $request->input('class_id');
        $semester_year = $request->input('semester_year');
        $semester = $request->input('semester');
        $semester_date = $request->input('semester_date');

        if (Auth::check()) {
            $student_id = Auth::user()->id;
            $isLogin = 1;
        }

        $schoolSemester = SchoolSemester::find($semester);

        /* $date_begin = $schoolSemester->date_begin;
        $date_end   = $schoolSemester->date_end;
        $days_count = $schoolSemester->days_count; */

        $classroom = Video::where('status', 1)->where([
                    'school_id' => $school_id,
                    'course_id' => $course_id,
                    'class_id' => $class_id,
                    'play_on' => $semester_date
                ])->first();

        if (!empty($classroom->id)) {
            $status = 1;
            $redirectUrl = route('frontend.classroom', $classroom->classDetail->uuid."?video=".$classroom->uuid);
            $messageType = 'success';
            $message = 'Redirecting to classroom page....';
        } else {

            $status = 0;
            $redirectUrl = '';
            $messageType = 'error';
            $message = 'Classroom not available in your selection date.';
        }

        $returnMsg = (object) array(
                    'status' => 200,
                    'errStatus' => $status,
                    'isLogin' => $isLogin,
                    'messageType' => $messageType,
                    'message' => $message,
                    'redirectUrl' => $redirectUrl
        );
        $returnData['data'] = $returnMsg;
        return response()->json($returnMsg, 200);
    }

    /**
     * Get school category or institution options ajax data.
     *
     */
    public function getSemesterOptions(Request $request)
    {

        $classroom_id = $request->input('classroom_id');
        $year = $request->input('semester_year');
        $school_id = $request->input('school_id');

        $school = School::find($school_id);




        $schoolSemesters = SchoolSemester::where([
                    'school_id' => $school_id,
                    'category_id' => $school->school_category
                ])->get();

        $returnArray = array();
        $getSemesterNameArray = $school->semesterNameArray();

        if (!empty($schoolSemesters)) {
            foreach ($schoolSemesters as $schoolSemester) {
                if (!empty($getSemesterNameArray[$schoolSemester->semester])) {

                    $date_begin = date("m-d", strtotime($schoolSemester->date_begin));
                    $date_end = date("m-d", strtotime($schoolSemester->date_end));

                    $returnArray[$schoolSemester->id] = (object) array(
                                'id' => $schoolSemester->id,
                                'school_id' => $schoolSemester->school_id,
                                'category_id' => $schoolSemester->category_id,
                                'semester' => $getSemesterNameArray[$schoolSemester->semester],
                                'date_begin' => $year . '-' . $date_begin,
                                'date_end' => $year . '-' . $date_end,
                                'days_count' => $schoolSemester->days_count
                    );
                }
            }
        }

        return response()->json($returnArray);
    }

    public function studentDownloads(Request $request)
    {


        $student_id = 0;
        $isLogin = 0;
        $status = 1;
        $notes_id = $request->input('notes_id');

        if (Auth::check()) {
            $student_id = Auth::user()->id;
            $isLogin = 1;
        }


        if ($student_id > 0) {

            $check = StudentDownload::where(['notes_id' => $notes_id, 'student_id' => $student_id])->first();

            if (empty($check->id)) {

                $insert = new StudentDownload;
                $insert->student_id = $student_id;
                $insert->notes_id = $notes_id;
                $insert->save();
            }
            $status = 1;
            $messageType = 'success';
            $message = 'Redirecting to download page....';
        } else {

            $status = 0;
            $isLogin = 0;
            $messageType = 'error';
            $message = 'You are not loged in.';
        }


        $returnMsg = (object) array(
                    'status' => 200,
                    'errStatus' => $status,
                    'isLogin' => $isLogin,
                    'messageType' => $messageType,
                    'message' => $message
        );

        $returnData['data'] = $returnMsg;
        return response()->json($returnMsg, 200);
    }

    public function videotest(Request $request)
    {
        $recipients = "+919694754693";
        $message    = "Test message";

        $account_sid = "AC9269dfa5611d664a3fa2837c1c71c92e";//getenv("TWILIO_SID");
        $auth_token = "9faf43f97f29b5da3262db926aee3d36";//getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);

        /* $verification = $client->verify->v2->services("MGd98a817e699c693ae9e40d5544a97759")
                                   ->verifications
                                   ->create("+919694754693", "sms"); */

         
            $client->messages->create($recipients, 
            ['from' => '+233 27 779 1380', 'body' => $message] );  

        return view('frontend.videotest');
    }

    public function getSemesterDaterange(Request $request)
    {

            /*  
            array:7 [
              "school_id" => "3"
              "classroom_id" => "1"
              "semesterDateBegin" => "2020-05-05"
              "semesterDateEnd" => "2020-07-31"
              "semester_year" => "2020"
              "semester" => "7"
              "semester_date" => null
            ] */

       $dateRange = Video::whereBetween('play_on',[$request->input('semesterDateBegin'),$request->input('semesterDateEnd')])
                                    ->where('play_on','<=',date('Y-m-d'))
                                    ->where('status',1)
                                    ->where('school_id',$request->school_id)
                                    ->where('class_id',$request->classroom_id)
                                    ->orderBy('play_on','asc')
                                    ->pluck('play_on','play_on');
        $firstDate = '';
        if(!empty($request->defaultClassroomDate) && !empty($dateRange[$request->defaultClassroomDate])){
			$firstDate = $request->defaultClassroomDate;
		} else if(!empty($dateRange)){
            $firstDate = collect($dateRange)->keys()->first();
        }
        $returnArray = (object) array('dateRange' => $dateRange,'firstDate' => $firstDate);
        return response()->json($returnArray);

    }

}
