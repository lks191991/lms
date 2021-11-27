<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentFavourites;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Video;
use App\Models\Note;
use App\Models\Tutor;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\SchoolCategory;
use App\User;
use App\Rules\MatchOldPassword;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\Classes;
use GLB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Image;
use Validator;
use Auth;
use Illuminate\Support\Facades\Storage;

class TutorController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if (!Auth::user()->hasRole('tutor')) {
            return redirect()->route('frontend.profile')->with('error', 'Unauthorized user');
        }

        $topics = Topic::where("user_id",Auth::user()->id)->orderBy('id', 'desc')->paginate(20);

        return view('frontend.tutor.topics.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		if (!Auth::user()->hasRole('tutor')) {
            return redirect()->route('frontend.profile')->with('error', 'Unauthorized user');
        }
        $institutes = SchoolCategory::orderBy('name')->where('status', '=', 1)->pluck('name', 'id');
        $subjects = Subject::orderBy('subject_name')->where('status', '=', 1)->pluck('subject_name', 'id');

        return view('frontend.tutor.topics.create', compact('subjects', 'institutes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		if (!Auth::user()->hasRole('tutor')) {
            return redirect()->route('frontend.profile')->with('error', 'Unauthorized user');
        }
		
        $subject_id = $request->subject;

        $subject_details = Subject::where('id', $subject_id)->first();
        $course_id = $subject_details->subject_class->course_id;

        $course_details = Course::where('id', $course_id)->select('school_id')->first();
      

            $validator = Validator::make($request->all(), [
                        'subject' => 'required',
                        'topic_name' => [
                            'required',
                            'max:180',
                            Rule::unique('topics')->where(function ($query) use($subject_id) {
                                        return $query->where('subject_id', $subject_id);
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
        $topic = new Topic();

        $topic->subject_id = $request->subject;
        $topic->topic_name = $request->input('topic_name');
		$topic->user_id = Auth::user()->id;
        $topic->status = 0;

        $topic->save();

       
            return redirect()->route('frontend.topics')->with('success', 'Topic created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		
        // $topic = Topic::findOrFail($id);
        return redirect()->route('frontend.topics.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasRole('tutor') ) {
            return redirect()->route('frontend.profile')->with('error', 'Unauthorized user');
        }
        //Find the employee
        $topic = Topic::find($id);
		
		if ($topic->user_id !=Auth::user()->id) {
            return redirect()->route('frontend.profile')->with('error', 'Unauthorized user');
        }
        $institutes = SchoolCategory::orderBy('name')->where('status', '=', 1)->pluck('name', 'id');
        $subject_details = Subject::where("id", $topic->subject_id)->select('class_id')->first();
        $topic->class_id = $subject_details->class_id;
        //echo $subject_details->class_id; exit;
        $classes_details = Classes::where("id", $subject_details->class_id)->select('course_id')->first();
        $topic->course_id = $classes_details->course_id;
        //echo $topic->course_id; exit;
        $course_details = Course::where("id", $topic->course_id)->select('school_id')->first();
        $topic->school_id = $course_details->school_id;



        $school_details = School::where("id", $topic->school_id)->select('school_category')->first();
        $topic->category_id = $school_details->school_category;

        $schools = School::where('school_category', $topic->category_id)->orderBy('school_name')->where('status', '=', 1)->pluck('school_name', 'id');
        $courses = Course::where('school_id', $topic->school_id)->orderBy('name')->where('status', '=', 1)->pluck('name', 'id');
        $classes = Classes::where('course_id', $topic->course_id)->orderBy('class_name')->where('status', '=', 1)->pluck('class_name', 'id');

        $subjects = Subject::orderBy('subject_name')->where('class_id', $subject_details->class_id)->where('status', '=', 1)->pluck('subject_name', 'id');

        return view('frontend.tutor.topics.edit', compact('topic', 'subjects', 'institutes', 'schools', 'courses', 'classes'));
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
		if (!Auth::user()->hasRole('tutor')) {
            return redirect()->route('frontend.profile')->with('error', 'Unauthorized user');
        }
		
        $subject_id = $request->subject;

        $subject_details = Subject::where('id', $subject_id)->first();
	
        $course_id = $subject_details->subject_class->course_id;

        $course_details = Course::where('id', $course_id)->select('school_id')->first();
       
        $topic = Topic::find($id);

            $validator = Validator::make($request->all(), [
                        //'subject' => 'required',
                        'topic_name' => [
                            'required',
                            'max:180',
                            Rule::unique('topics')->where(function ($query) use($subject_id, $id) {
                                        return $query->where('subject_id', $subject_id)->where('id', '<>', $id);
                                    })
                        ],
            ]);


        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::back()
                            ->withErrors($validator) // send back all errors to the form
                            ->withInput();
        }


        $topic->topic_name = $request->input('topic_name');
        $topic->save(); //persist the data

       
            return redirect()->route('frontend.topics')->with('success', 'Topic Information Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
		if (!Auth::user()->hasRole('tutor')) {
            return redirect()->route('frontend.profile')->with('error', 'Unauthorized user');
        }
		
        $topic = Topic::find($id);

        $subject_details = Subject::where('id', $topic->subject_id)->first();
        $course_id = $subject_details->subject_class->course_id;

        $course_details = Course::where('id', $course_id)->select('school_id')->first();
       
        $topic->delete();

            return redirect()->route('frontend.topics')->with('success', 'Topic Deleted Successfully');
    }
    
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexVideo()
    {
         if (!Auth::user()->hasRole('tutor')) {
            return redirect()->route('frontend.profile')->with('error', 'Unauthorized user');
        }
		
		$courses = array();
		$classes = array();
        
        $query = Video::where('id','<>',0);
        
	 $videos = $query->whereHas('topic', function($q){
    $q->where('user_id', Auth::user()->id);
})->orderBy('id', 'desc')->paginate(20);	
		$query = School::where('status','=',1);
		        
        $schools = $query->orderBy('school_name')
                        ->pluck('school_name','id');
		
		return view('frontend.tutor.videos.index', compact('videos', 'schools', 'courses', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createVideo()
    {
		 if (!Auth::user()->hasRole('tutor')) {
            return redirect()->route('frontend.profile')->with('error', 'Unauthorized user');
        }
		
        $query = SchoolCategory::where('status','=',1);
        $school_id = 0;
        $category_id = 0;
   
        $institutes = $query->orderBy('name')
                        ->pluck('name','id');
        
        
        
        return view('frontend.tutor.videos.create',  compact('institutes','school_id','category_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeVideo(Request $request)
    {        
	
	 if (!Auth::user()->hasRole('tutor')) {
            return redirect()->route('frontend.profile')->with('error', 'Unauthorized user');
        }
		$tutor_id = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'school' => 'required',
            'course' => 'required',
            'class' => 'required',
            'date' => 'required',
            'subject' => 'required',
            'topic' => 'required',
            'video_type' => 'required',
            'video_url' => 'required',
            //'video_url' => 'required_without:video_file',
            //'video_file' => 'required_without:video_url',
            'description' => 'required',  
            //'note_file' => 'sometimes|mimes:jpeg,jpg,png,pdf,doc,docx,ppt,pptx,zip|max:20480',
        ]);
        

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {    
            
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the form
                ->withInput();
        } else {
            
            $video_id = '';
            if($request->video_type == 'url') {
                $video_url = $request->video_url;
                $video_id = 1;
            }
            
            
            $note = null;
            
            if ($request->note_file != '') {               
                
                $path = $request->note_file;
                
                //Create Note
                $note = new Note();
                $note->tutor_id = $tutor_id;
                $note->file_url = $path;
                $note->storage = 'local';
                $note->status = 1;
                $note->save();
            } 
            
            //form data is available in the request object
            $video = new Video();
			 /** Below code for save banner_image * */
			if ($request->hasFile('banner_image')) {

				$validator = Validator::make($request->all(), [
							'banner_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
								], [
							'banner_image.max' => 'The banner image may not be greater than 2 mb.',
				]);

				if ($validator->fails()) {
					return redirect()->route('frontend.videos.create')->withErrors($validator)->withInput();
				}

				$destinationPath = public_path('/uploads/video_banner/');
				$newName = '';
				$fileName = $request->all()['banner_image']->getClientOriginalName();
				$file = request()->file('banner_image');
				$fileNameArr = explode('.', $fileName);
				$fileNameExt = end($fileNameArr);
				$newName = date('His') . rand() . time() . '__' . $fileNameArr[0] . '.' . $fileNameExt;

				$file->move($destinationPath, $newName);

				$imagePath = 'uploads/video_banner/' . $newName;
				$video->banner_image = $imagePath;
			}
		
            $video->school_id = $request->school;
            $video->course_id = $request->course;
            $video->class_id = $request->class;
            $video->play_on = $request->date;
            $video->video_id = $video_id;
            $video->video_url = $request->video_url;
            $video->video_type = $request->video_type;
            $video->description = $request->description;
            $video->subject_id = $request->subject;
            $video->topic_id = $request->topic;
            $video->keywords = $request->keywords;
            $video->tutor_id = $tutor_id;
			$video->video_upload_type = $request->video_upload_type;
            $video->note_id = isset($note->id)? $note->id : 0;
            $video->user_id = Auth::user()->id;
            $video->status = ($request->input('status') !== null)? $request->input('status'):0;            

            $video->save();         
            
            
            return redirect()->route('frontend.videos')->with('success', 'Video created Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showVideo($uuid)
    {
         if (!Auth::user()->hasRole('tutor')) {
            return redirect()->route('frontend.profile')->with('error', 'Unauthorized user');
        }
        $video = Video::uuid($uuid);
		//echo $video->id; exit;
		$reported_video_detail = ReportVideo::where('video_id', $video->id)->get();
		//pr($reported_video_detail); exit;
		if(!Auth::user()->hasAccessToSchool($video->school_id)){
            return redirect()->route('backend.dashboard');           
        }                
        
        return view('frontend.tutor.videos.show', compact('video', 'reported_video_detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editVideo($uuid)
    {
         if (!Auth::user()->hasRole('tutor')) {
            return redirect()->route('frontend.profile')->with('error', 'Unauthorized user');
        }
		
		
        $video = Video::with('topic')->uuid($uuid);
		
		
		
        $query = SchoolCategory::where('status','=',1);
        $institutes = $query->orderBy('name')
                        ->pluck('name','id');
        
        return view('frontend.tutor.videos.edit', compact('video','institutes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateVideo(Request $request, $id)
    {   
        $validator = Validator::make($request->all(), [
            //'school' => 'required',
            'course' => 'required',
            'class' => 'required',
            'date' => 'required',
            'subject' => 'required',
            'topic' => 'required',            
            'video_type' => 'required',
            'video_url' => 'required',
            //'video_url' => 'required_without:video_file',
            //'video_file' => 'required_without:video_url',
            'description' => 'required',  
            //'note_file' => 'sometimes|mimes:jpeg,png,pdf,doc,docx,ppt,pptx,zip|max:20480',
        ]);
                                
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the form
                ->withInput();
        } else {
            //form data is available in the request object
            $video = Video::find($id);
            
            $video_id = $video->video_id;
            
            $note = null;
            if ($request->note_file != '') {
                
                $path = $request->note_file;
                
                //Create Note
                $note = new Note();
                $note->tutor_id = Auth::user()->id;
                $note->file_url = $path;
                $note->storage = 'local';
                $note->status = 1;
                $note->save();                
                
                $video->note_id = isset($note->id)? $note->id : 0;
            }
            

			if ($request->hasFile('banner_image')) {

            $validator = Validator::make($request->all(), [
                        'banner_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                            ], [
                        'banner_image.max' => 'The banner image may not be greater than 2 mb.',
            ]);

            if ($validator->fails()) {
                return redirect()->route('backend.videos.edit', $id)->withErrors($validator)->withInput();
            }

            $destinationPath = public_path('/uploads/video_banner/');
            $newName = '';
            $fileName = $request->all()['banner_image']->getClientOriginalName();
            $file = request()->file('banner_image');
            $fileNameArr = explode('.', $fileName);
            $fileNameExt = end($fileNameArr);
            $newName = date('His') . rand() . time() . '__' . $fileNameArr[0] . '.' . $fileNameExt;

            $file->move($destinationPath, $newName);

            $oldImage = public_path($video->banner_image);
            //echo $oldImage; exit;
            if (!empty($video->banner_image) && file_exists($oldImage)) {
                unlink($oldImage);
            }

            $imagePath = 'uploads/video_banner/' . $newName;
            $video->banner_image = $imagePath;
			
        }	
            $video->course_id = $request->course;
            $video->class_id = $request->class;
            $video->play_on = $request->date;
            $video->video_id = $video_id;
            $video->video_url = $request->video_url;
            $video->video_type = $request->video_type;
            $video->description = $request->description;
            $video->subject_id = $request->subject;
            $video->topic_id = $request->topic;
			$video->video_upload_type = $request->video_upload_type;
            $video->keywords = $request->keywords;            
            $video->status = ($request->input('status') !== null)? $request->input('status'):0;            

            $video->save();
           
            return redirect()->route('frontend.videos')->with('success', 'Video Updated Successfully');
        }      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyVideo($id)
    {
        $video = Video::find($id);
		
		//release date and period.
		$video->play_on = NULL;
		$video->status = 0;
		$video->save();

        $video->delete();
        
        return redirect()->route('frontend.videos')->with('success', 'Video Deleted Successfully');
    }
   
}
