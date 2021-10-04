<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentFavourites;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Classroom;
use App\Models\Video;
use App\Models\Note;
use App\Models\StudentVideo;
use App\Models\KnowledgeTarget;
use App\Models\Tutor;
use App\Models\Question;
use App\Models\StudentLession;
use App\Models\Subject;
use App\Models\Department;
use App\Models\StudentDownload;
use App\Models\Classes;
use App\Models\Avatar;
use App\User;
use App\Models\StudentHistory;
use Carbon\Carbon;
use GLB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Image;
use Validator;
use Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        session()->forget('newCustomer');
        session()->forget('userId');
        $this->middleware('auth');
    }

    /**
     * Show Student profile.
     *
     */
    public function profile()
    {

        session()->forget('newCustomer');
        session()->forget('userId');
        $student = User::find(Auth::user()->id);

        if (Auth::user()->userRole->role->slug == 'admin') {
            return redirect()->route('backend.dashboard');
        } else if (Auth::user()->userRole->role->slug == 'subadmin') {
            return redirect()->route('backend.dashboard');
        } else if (Auth::user()->userRole->role->slug == 'school') {
            return redirect()->route('backend.dashboard');
        } else if (Auth::user()->userRole->role->slug == 'student') {
            return $this->student();
        } else if (Auth::user()->userRole->role->slug == 'tutor') {
            return $this->tutor();
        }
    }

    public function tutor()
    {

        $tutor = User::find(Auth::user()->id);

        $student_videos = StudentVideo::where('student_id', $tutor->id)->pluck('video_id', 'video_id');
        $classesHosted = Video::whereIn('id', $student_videos)->groupBy('class_id')->count();
        $questionsAsked = Question::where('sender_id', $tutor->id)->where('type', 'question')->count();
        $replyCount = Question::where('sender_id', $tutor->id)->where('type', 'reply')->count();
        $noteAdded = Video::where([
                    'tutor_id' => $tutor->id,
                    'status' => 1
                ])->groupBy('topic_id')->count();
		



        //print_r($questionsAsked); exit;

        $schools = School::where('status', 1)->orderBy('school_name', 'asc')
                ->pluck("school_name", "id");
        $courses = Course::where('status', 1)->orderBy('name', 'asc')
                ->pluck("name", "id");
        $avatars = Avatar::where('status', 1)
                ->get();
		$knowledgeTargets = KnowledgeTarget::get();
        //pr($student->toArray());die;

        $tutorSchoolCategory = $tutor->userData->school->school_category;
        $tutorSchoolId = $tutor->userData->school->id;
        $schoolCategoryName = '';
        $defaultArray = array('deparments' => array(), 'courses' => array(), 'classes' => array());

        if ($tutorSchoolCategory == School::BASIC_SCHOOL) {
            $school = School::find($tutorSchoolId);
            if (!empty($school->coursesList[0])) {
                $course = $school->coursesList[0];
                $course_id = $course->id;

                $defaultArray['classes'] = Classes::where('status', 1)->where('course_id', $course_id)->orderBy('class_name', 'asc')->pluck("class_name", "id");
            }
            $schoolCategoryName = 'BASIC_SCHOOL';
        } else if ($tutorSchoolCategory == School::SENIOR_HIGH) {
            $defaultArray['courses'] = Course::where('status', 1)->where('school_id', $tutorSchoolId)->orderBy('name', 'asc')->pluck("name", "id");
            $schoolCategoryName = 'SENIOR_HIGH';
        } else if ($tutorSchoolCategory == School::UNIVERSITY) {

            $defaultArray['deparments'] = Department::where('status', 1)
                    ->where('school_id', $tutorSchoolId)
                    ->pluck("name", "id");

            $schoolCategoryName = 'UNIVERSITY';
        }

		$starShow = $this->tutorStar($tutor->id);

        return view('frontend.tutor.profile', compact('tutor', 'schools', 'courses', 'avatars', 'classesHosted', 'replyCount', 'questionsAsked', 'noteAdded', 'defaultArray', 'schoolCategoryName', 'tutorSchoolId','knowledgeTargets','starShow'));
    }
	
	public function tutorStar($tutor_id)
	{
		$silverDec = 'silver';
		$bronzeDec = 'bronze';
		$blueDec   = 'blue';
		$yellowDec = 'yellow';
		
		
		$count = Video::where([
                    'tutor_id' => $tutor_id,
                    'status' => 1
                ])->count(); 
				
			
		return (object) array(
				'silverCount'   => 1+$this->generateStarCount($count,500),
				'silverDec'     => $silverDec,
				'bronzeCount'   => $this->generateStarCount($count,100),
				'bronzeDec'     => $bronzeDec,
				'blueCount'     => $this->generateStarCount($count,1000),
				'blueDec'       => $blueDec,
				'yellowCount'   => $this->generateStarCount($count,5000),
				'yellowDec'     => $yellowDec
		);
	}
	
	public function generateStarCount($count,$mnt){
		
		//echo round(100/100,0); exit;
		if(!empty($count) && !empty($mnt) && ($count >= $mnt)){
		    return round($count/$mnt,0);
		}else{
			return 0;
		}
	}
	
	public function studentStar($student_id)
	{
		
				
		$silverDec = 'silver';
		$bronzeDec = 'bronze';
		$blueDec   = 'blue';
		$yellowDec = 'yellow';
		$count = 0;
		
		$pluck = StudentHistory::where([
                    'student_id' => $student_id
                ])->pluck('video_id','video_id'); 
				
		if(!empty($pluck)){
			 $count = collect($pluck)->count($pluck);
		}
				
		return (object) array(
				'silverCount'   => 1+$this->generateStarCount($count,500),
				'silverDec'     => $silverDec,
				'bronzeCount'   => $this->generateStarCount($count,100),
				'bronzeDec'     => $bronzeDec,
				'blueCount'     => $this->generateStarCount($count,1000),
				'blueDec'       => $blueDec,
				'yellowCount'   => $this->generateStarCount($count,5000),
				'yellowDec'     => $yellowDec
		);
		
	}

    public function student()
    {

        $student = User::find(Auth::user()->id);

        $student_videos = StudentVideo::where('student_id', $student->id)->pluck('video_id', 'video_id');
        $classesWatched = Video::whereIn('id', $student_videos)->count();
        $questionsCount = Question::where('sender_id', $student->id)->where('type', 'question')->count();
        $replyCount = Question::where('sender_id', $student->id)->where('type', 'reply')->count();
        $noteDownloads = StudentDownload::where([
                    'student_id' => $student->id,
                    'status' => 1
                ])->count();

		$classes = Classes::where('status', 1)->where('course_id', $student->userData->course_id)->orderBy('class_name', 'asc')->pluck("class_name", "id");

        //print_r($questionsCount); exit;

        $schools = School::where('status', 1)->orderBy('school_name', 'asc')
                ->pluck("school_name", "id");
        $courses = Course::where('status', 1)->orderBy('name', 'asc')
                ->pluck("name", "id");
        $avatars = Avatar::where('status', 1)
                ->get();
        //pr($student->toArray());die;
		$starShow = $this->studentStar($student->id);
        return view('frontend.student.profile', compact('student', 'schools', 'courses', 'avatars', 'classesWatched', 'replyCount', 'questionsCount', 'noteDownloads','starShow','classes'));
    }

    /**
     * Show Student profile.
     *
     */
    public function studentHistory(Request $request)
    {

        $student_id = 0;
        $page = $request->input('page', 1);
        if (\Auth::check()) {
            $student_id = \Auth::user()->id;
        }

        $tab = $request->tab;
        $loadMore = $request->loadMore;

				
        $studentHistories = StudentHistory::where([
                    'student_id' => $student_id
                ])
                 ->whereHas('video', function($q) use($request) {
                    if (!empty($request->course_id)) {
                        $q->where('course_id', $request->course_id);
                    }
                    if (!empty($request->school_id)) {
                        $q->where('school_id', $request->school_id);
                    }
                })  
                ->whereNotNull('video_id')
                ->orderBy('id', 'desc')
                ->groupBy('student_history.video_id')
                ->paginate(GLB::paginate());

        return view('frontend.student.student_history', compact('tab', 'loadMore', 'studentHistories', 'page'));
    }

    public function removeHtudentHistory(Request $request)
    {
        if ($request->rmFrom == 'history') {
            $studentHistories = StudentHistory::find($request->id);
            if (!empty($studentHistories->id)) {
                $studentHistories->delete();
            }
        } else {
            $studentFavourites = StudentFavourites::find($request->id);
            if (!empty($studentFavourites->id)) {
                $studentFavourites->delete();
            }
        }
        return 1;
    }

    public function studentFavourites(Request $request)
    {
        $student_id = 0;
        $page = $request->input('page', 1);
        if (\Auth::check()) {
            $student_id = \Auth::user()->id;
        }

        $tab = $request->tab;
        $loadMore = $request->loadMore;


        $studentFavourites = StudentFavourites::where([
                    'student_id' => $student_id
                ])
                ->whereHas('video', function($q) use($request) {
                    if (!empty($request->course_id)) {
                        $q->where('course_id', $request->course_id);
                    }
                    if (!empty($request->school_id)) {
                        $q->where('school_id', $request->school_id);
                    }
                })
                ->whereNotNull('video_id')
                ->orderBy('id', 'desc')
                ->paginate(GLB::paginate());

        return view('frontend.student.student_favourites', compact('tab', 'loadMore', 'studentFavourites', 'page'));
    }

    public function uploadProfile(Request $request)
    {
        $sender_id = 0;
        $status = 0;
        $messageType = '';
        $message = '';
        $watchCount = 1;
        $src = '';

        $validator = Validator::make($request->all(), [
                    //'profile_image'=>'required|image|dimensions:max_width=212,max_height=150|max:2048'
                    'profile_image' => 'required|image|max:2048'
                        ], [
                        //"required" => ""
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors()->all();
            $status = 0;
            $messageType = 'error';
            $message = collect($errors)->implode('<br>');
        } else {

            $userid = \Auth::user()->id;
            $user = User::find($userid);
            $role_id = $user->role_id;
            $userRole = $user->userRole->role->slug;

            if ($request->hasFile('profile_image')) {
                $logo = $request->file('profile_image');
                $uploadPath = "uploads/student";

                if ($userRole == 'tutor') {
                    /** Below code for save tutor image * */
                    $uploadPath = "uploads/tutor";
                } else {
                    /** Below code for save student image * */
                    $uploadPath = "uploads/student";
                }

                $logoName = time() . mt_rand(10, 100) . '.' . $logo->getClientOriginalExtension();
                $location = public_path($uploadPath);
                if (!file_exists($location)) {
                    mkdir($location);
                }
                $isMoved = $logo->move($location . '/', $logoName);
                $img = Image::make($location . '/' . $logoName);

                if ($role_id == 5) {
                    $update = Student::where('user_id', $user->id)->first();
                    $update->profile_image = $uploadPath . '/' . $logoName;
                    $update->save();
                }
                if ($userRole == 'tutor') {
                    /** Below code for save tutor image * */
                    $update = Tutor::where('user_id', $user->id)->first();
                    $update->profile_image = $uploadPath . '/' . $logoName;
                    $update->save();
                } else {
                    /** Below code for save student image * */
                    $update = Student::where('user_id', $user->id)->first();
                    $update->profile_image = $uploadPath . '/' . $logoName;
                    $update->save();
                }

                $src = url($uploadPath . '/' . $logoName);
                $status = 1;
                $messageType = 'success';
                $message = "Successfully updated your profile.";
            }
        }

        $returnMsg = (object) array(
                    'status' => 200,
                    'errStatus' => $status,
                    'messageType' => $messageType,
                    'message' => $message,
                    'imgsrc' => $src
        );
        $returnData['data'] = $returnMsg;
        return response()->json($returnMsg, 200);
    }

    public function changeAvatar(Request $request)
    {
        $sender_id = 0;
        $status = 0;
        $messageType = 'error';
        $message = 'Please select avatar.';
        $watchCount = 1;
        $src     = '';
        $fileurl = '';
		
		$avatar = Avatar::find($request->avatar_id);
		
		if(!empty($avatar->file_url) && file_exists(public_path($avatar->file_url))){
			$fileurl = $avatar->file_url; 
		}

        if (!empty($request->avatar_id)) {
            $userid = \Auth::user()->id;
            $user = User::find($userid);
            $role_id = $user->role_id;
            $userRole = $user->userRole->role->slug;


            if ($userRole == 'tutor') {
                /** Below code for save tutor  * */
                $update = Tutor::where('user_id', $user->id)->first();
                $update->avatar_id     = $request->avatar_id;
				$update->profile_image = $fileurl;
                $update->save();
            } else {
                /** Below code for save student  * */
                $update = Student::where('user_id', $user->id)->first();
                $update->avatar_id     = $request->avatar_id;
				$update->profile_image = $fileurl;
                $update->save();
            }
			
			$src = $user->userData->profile_or_avatar_image;
			//profile_or_avatar_image
            $status = 1;
            $messageType = 'success';
            $message = "Successfully updated your avatar.";
        }
		
		
		 


        $returnMsg = (object) array(
                    'status' => 200,
                    'errStatus' => $status,
                    'messageType' => $messageType,
                    'message' => $message,
					'imgsrc' => $src
        );
        $returnData['data'] = $returnMsg;
        return response()->json($returnMsg, 200);
    }

    public function tutorLecture(Request $request)
    {


        $page = $request->input('page', 1);
        $tutor_id = \Auth::user()->id;

        $tab = $request->tab;
        $loadMore = $request->loadMore;


        $tutorVideos = Video::where([
                    'tutor_id' => $tutor_id
        ]);
        if (!empty($request->orderBy)) {
            $exp = explode('-', $request->orderBy);
            $tutorVideos = $tutorVideos->orderBy($exp[0], $exp[1]);
        } else {
            $tutorVideos = $tutorVideos->orderBy('id', 'desc');
        }

        $tutorVideos = $tutorVideos->paginate(GLB::paginate());

        return view('frontend.tutor.tutor_lecture', compact('tab', 'loadMore', 'tutorVideos', 'page'));
    }

    public function tutorPosts(Request $request)
    {
        $student_id = 0;
        $page = $request->input('page', 1);
        if (\Auth::check()) {
            $student_id = \Auth::user()->id;
        }

        $tab = $request->tab;
        $loadMore = $request->loadMore;


        $tutorPosts = StudentHistory::where('id', 0)->paginate(1);

        return view('frontend.tutor.tutor_post', compact('tab', 'loadMore', 'tutorPosts', 'page'));
    }

    public function uploadNotes(Request $request)
    {

        $validator = Validator::make($request->all(), [

                    'video_id' => 'required',
                    'notes' => 'required'
                        ], [
                    "video_id.required" => "Video not found."
        ]);
        $status = 0;
        $message = "";
        $messageType = "";
        $src = "";

        if ($validator->fails()) {

            $errors = $validator->errors()->all();
            $status = 0;
            $messageType = 'error';
            $message = collect($errors)->implode('<br>');
        } else {

            $userid = \Auth::user()->id;
            $user = User::find($userid);
            $role_id = $user->role_id;
            $userRole = $user->userRole->role->slug;

            if ($request->hasFile('notes')) {
                $notes = $request->file('notes');
                //$uploadPath = "uploads/notes";


                //$fileName = time() . mt_rand(10, 100) . '.' . $notes->getClientOriginalExtension();
                //$location = public_path($uploadPath);
                //if (!file_exists($location)) {
                //    mkdir($location);
                //}
                //$isMoved = $notes->move($location . '/', $fileName);
                //$img = Image::make($location.'/'.$fileName);
                $path = Storage::disk('s3')->put('notes', $notes, 'public');

                $insertNote = new Note();
                $insertNote->tutor_id = Auth::user()->id;
                $insertNote->file_url = $path;  //$uploadPath . '/' . $fileName;
                $insertNote->storage = 's3';
                $insertNote->save();

                if (!empty($request->video_id)) {
                    $updateVideo = Video::find($request->video_id);
                    $updateVideo->note_id = $insertNote->id;
                    $updateVideo->save();
                }


                $src = $updateVideo->videoURL();
                $status = 1;
                $messageType = 'success';
                $message = "Successfully uploaded your file.";
            }
        }

        $returnMsg = (object) array(
                    'status' => 200,
                    'errStatus' => $status,
                    'messageType' => $messageType,
                    'message' => $message,
                    'imgsrc' => $src
        );
        $returnData['data'] = $returnMsg;
        return response()->json($returnMsg, 200);
    }

    /**
     * Uplaod video files
     *
     * @param  string  $uuid
     * @return renderd view
     */
    public function uploadVideoFile($uuid)
    {        
        $video = Video::uuid($uuid);	
        if($video->video_type != 'file' || Auth::user()->id != $video->tutor_id){
            return redirect()->route('front');
        }                
        
        $video_thumb = $video->getVimeoThumb();
        
        return view('frontend.tutor.upload_video_file', compact('video','video_thumb'));
    }
    
}
