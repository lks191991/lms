<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolCategory;
use App\Models\Video;
use App\Models\ReportVideo;
use App\Models\School;
use App\Models\Note;
use App\Models\Course;
use App\Models\Classes;
use App\Models\Tutor;
use App\Models\Topic;
use App\Models\Subject;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Auth;
use SiteHelpers;
use Illuminate\Support\Facades\Storage;
use DB;
use Illuminate\Support\Facades\Mail;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //SiteHelpers::updateUUID('periods');
		$filter = $request->all();
		
		$courses = array();
		$classes = array();
        
        $query = Video::where('id','<>',0);
		if(isset($filter['school']) && !empty($filter['school']))
		{
			$query->where('school_id','=',$filter['school']);
		}
		if(isset($filter['school_course']) && !empty($filter['school_course']))
		{
			$query->where('course_id','=',$filter['school_course']);
		}
		if(isset($filter['class']) && !empty($filter['class']))
		{
			$query->where('class_id','=',$filter['class']);
		}
		if(isset($filter['subject']) && !empty($filter['subject']))
		{
			$query->where('subject_id','=',$filter['subject']);
		}
        
        if(Auth::user()->hasRole('school')){
            $profile = Auth::user()->profile;
            if(isset($profile->school_id)){
                $query = $query->where('school_id','=',$profile->school_id);
				$courses = Course::where('school_id',$profile->school_id)->where('status',1)->orderBy('name')->select('id', 'name')
                        ->get();
				$school_details = School::where('id', $profile->school_id)->select('school_category')->first();
				if($school_details->school_category === config("constants.BASIC_SCHOOL")){
					
					if(isset($courses[0]->id)) {
						$classes = Classes::where('course_id',$courses[0]->id)->where('status',1)->orderBy('class_name')
								->pluck('class_name','id');
					}
				} 
            } 
			
		} 
        
        $videos = $query->orderBy('id', 'desc')->paginate(20);
		
		$repoted_count = array();
		
		foreach($videos as $video) {
			$report_video_count = ReportVideo::where('video_id', $video->id)->count();
			$repoted_count[$video->id] = $report_video_count;
		}
		
		$query = School::where('status','=',1);
		
		 if(Auth::user()->hasRole('school')){
            $profile = Auth::user()->profile;
            if(isset($profile->school_id)){
                $school_id = $profile->school_id;
               $query = $query->where('id','=',$school_id);
            }            
        }
        
        $schools = $query->orderBy('school_name')
                        ->pluck('school_name','id');
	$subjects = Subject::where('status','=',1)->select('subject_name','id')->get();
						
		
		return view('backend.videos.index', compact('videos', 'repoted_count', 'schools', 'courses', 'classes','subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $query = SchoolCategory::where('status','=',1);
        $school_id = 0;
        $category_id = 0;
        $tutors = Tutor::where('status','=',1)->select('first_name','last_name','id')->get();
   
        $institutes = $query->orderBy('name')
                        ->pluck('name','id');
        
        
        
        return view('backend.videos.create',  compact('institutes','school_id','category_id','tutors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'school' => 'required',
            'course' => 'required',
            'class' => 'required',
            'date' => 'required',
            'subject' => 'required',
            'topic' => 'required',
            'tutor' => 'required',
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
                //$video_data = SiteHelpers::getVimeoVideoData($video_url);
				/* print_r($video_data);
				exit;
                if(!isset($video_data->video_id) || empty($video_data->video_id)){

                    $validator->errors()->add('video_url', 'Invalid Video URL');

                    return Redirect::back()
                            ->withErrors($validator) // send back all errors to the form
                            ->withInput();
                } else {
                    $video_id = $video_data->video_id;
                } */
            }
            
            
            $note = null;
            
            if ($request->note_file != '') {               
                
                $path = $request->note_file;
                
                //Create Note
                $note = new Note();
                $note->tutor_id = $request->tutor;
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
					return redirect()->route('backend.videos.create')->withErrors($validator)->withInput();
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
            $video->tutor_id = $request->tutor;
			$video->video_upload_type = $request->video_upload_type;
            $video->note_id = isset($note->id)? $note->id : 0;
            $video->user_id = Auth::user()->id;
            $video->status = ($request->input('status') !== null)? $request->input('status'):0;            

            $video->save();         
            
            if($request->video_type == 'file') {
                return redirect()->route('backend.video.upload.files',$video->uuid)->with('success', 'Video created Successfully, please uplaod video file for it. ');
            }
            
            return redirect()->route('backend.videos.index')->with('success', 'Video created Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        
        $video = Video::uuid($uuid);
		//echo $video->id; exit;
		$reported_video_detail = ReportVideo::where('video_id', $video->id)->get();
		//pr($reported_video_detail); exit;
		if(!Auth::user()->hasAccessToSchool($video->school_id)){
            return redirect()->route('backend.dashboard');           
        }                
        
        return view('backend.videos.show', compact('video', 'reported_video_detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        
        $video = Video::uuid($uuid);
		
        $query = SchoolCategory::where('status','=',1);
       $tutors = Tutor::where('status','=',1)->select('first_name','last_name','id')->get();
        $institutes = $query->orderBy('name')
                        ->pluck('name','id');
        
        return view('backend.videos.edit', compact('video','institutes','tutors'));
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
            'tutor' => 'required'      
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
            /* if($request->video_type == 'url') {
                $video_url = $request->video_url;
                
                $video_data = SiteHelpers::getVimeoVideoData($video_url);

                if(!isset($video_data->video_id) || empty($video_data->video_id)){

                    $validator->errors()->add('video_url', 'Invalid Video URL');

                    return Redirect::back()
                            ->withErrors($validator) // send back all errors to the form
                            ->withInput();
                } else {
                    $video_id = $video_data->video_id;
                }
            } */
            
            
            
            
            $note = null;
            if ($request->note_file != '') {
                
                $path = $request->note_file;
                
                //Create Note
                $note = new Note();
                $note->tutor_id = $request->tutor;
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
            $video->tutor_id = $request->tutor;
            $video->status = ($request->input('status') !== null)? $request->input('status'):0;            

            $video->save();
            
           /*  if($request->video_type == 'file') {
                return redirect()->route('backend.videos.show',$video->uuid)->with('success', 'Video created Successfully, please uplaod video file for it. ');
            } */
            
            return redirect()->route('backend.videos.index')->with('success', 'Video Updated Successfully');
        }      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::find($id);
		
		//release date and period.
		$video->play_on = NULL;
		$video->status = 0;
		$video->save();

        $video->delete();
        
        return redirect()->route('backend.videos.index')->with('success', 'Video Deleted Successfully');
    }
    
    /**
     * Uplaod video files
     *
     * @param  string  $uuid
     * @return renderd view
     */
    public function uploadFiles($uuid)
    {
        $video = Video::uuid($uuid);	
        if(!Auth::user()->hasAccessToSchool($video->school_id)){
            return redirect()->route('backend.dashboard');           
        }                
        
        $video_thumb = $video->getVimeoThumb();
        return view('backend.videos.upload_files', compact('video','video_thumb'));
    }
	
	
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function csvUploadVideo()
    {
        $query = SchoolCategory::where('status','=',1);
        $school_id = 0;
        $category_id = 0;
        $tutors = Tutor::where('status','=',1)->select('first_name','last_name','id')->get();
   
        $institutes = $query->orderBy('name')
                        ->pluck('name','id');
        
        
        
        return view('backend.videos.csv',  compact('institutes','school_id','category_id','tutors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function csvUploadVideoPost(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'school' => 'required',
            'course' => 'required',
            'class' => 'required',
            'date' => 'required',
            'subject' => 'required',
            'tutor' => 'required',
            'video_type' => 'required',
            
        ]);
        

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {    
            
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the form
                ->withInput();
        } else {
            
						
						$file = $request->file('uploaded_file_csv');
						if ($file) {
							$filename = $file->getClientOriginalName();
							$extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
							$tempPath = $file->getRealPath();
							$fileSize = $file->getSize(); //Get size of uploaded file in bytes
							//Check for file extension and size
							$this->checkUploadedFileProperties($extension, $fileSize);
							//Where uploaded file will be stored on the server 
							$location = 'uploads'; //Created an "uploads" folder for that
							// Upload file
							$file->move($location, $filename);
							// In case the uploaded file path is to be stored in the database 
							$filepath = public_path($location . "/" . $filename);
							// Reading file
							$file = fopen($filepath, "r");
							$importData_arr = array(); // Read through the file and store the contents as an array
							$i = 0;
							//Read the contents of the uploaded file 
							while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
							$num = count($filedata);
							// Skip first row (Remove below comment if you want to skip the first row)
							if ($i == 0) {
							$i++;
							continue;
							}
							for ($c = 0; $c < $num; $c++) {
							if(!empty($filedata[$c][0]))
							{
							$importData_arr[$i][] = $filedata[$c];
							}
							}
							$i++;
							}
							fclose($file); //Close after reading
							$j = 0;
							
							foreach ($importData_arr as $importData) {
							$j++;
							$topicName = str_replace("'", "\'", $importData[0]);
							$topicName = str_replace('"', "'+String.fromCharCode(34)+'", $importData[0]);
							$videoDescription = str_replace("'", "\'", $importData[1]);
							$videoDescription = str_replace('"', "'+String.fromCharCode(34)+'", $importData[1]);
							
							$topicName = addslashes(trim(ucwords(strtolower($topicName))));
							$videoDescription = addslashes(trim(ucwords(strtolower($videoDescription))));
							$topicData = Topic::where("topic_name",$topicName)->where("subject_id",$request->subject)->first();
							if(isset($topicData))
							{
								$toipic_id= $topicData->id;
							}
							else
							{
							$topic = new Topic();
							$topic->subject_id = $request->subject;
							$topic->topic_name = $topicName;
							$topic->status = 0;
							$topic->save();
							$toipic_id= $topic->id;
							}
							$video = new Video();
							$video->school_id = $request->school;
							$video->course_id = $request->course;
							$video->class_id = $request->class;
							$video->play_on = $request->date;
							$video->video_id = 1;
							$video->video_url = trim($importData[2]);
							$video->video_type = $request->video_type;
							$video->description = $videoDescription;
							$video->subject_id = $request->subject;
							$video->topic_id = $toipic_id;
							$video->keywords = '';
							$video->tutor_id = $request->tutor;
							$video->video_upload_type = $request->video_upload_type;
							$video->note_id = 0;
							$video->user_id = Auth::user()->id;
							$video->status = 1;            
							$video->save();

							}
							return response()->json([
							'message' => "$j records successfully uploaded"
							]);
							} 
							         
            
            
            //return redirect()->route('backend.videos.index')->with('success', 'Video created Successfully');
        }
    }
	
	public function checkUploadedFileProperties($extension, $fileSize)
	{
		$valid_extension = array("csv", "xlsx"); //Only want csv and excel files
		$maxFileSize = 2097152; // Uploaded file size limit is 2mb
		if (in_array(strtolower($extension), $valid_extension)) {
		if ($fileSize <= $maxFileSize) {
		} else {
		throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
		}
		} else {
		throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
		}
		}
		
}
