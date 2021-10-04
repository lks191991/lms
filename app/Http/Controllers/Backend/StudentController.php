<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\School;
use App\Models\SchoolCategory;
use App\Models\Course;
use App\Models\Department;
use App\Models\Classes;
use App\Models\StudentClasses;
use App\User;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Mail\sendEmailtoSchoolstudent;
use Illuminate\Support\Facades\Mail;
use Auth;
use GLB;
use App\Models\StudentHistory;
use App\Models\Video;
use App\Models\StudentVideo;
use App\Models\Question;
use App\Models\StudentDownload;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$courses = array();
		$classes = array();
		
        $query = Student::where('id','<>',0);
        
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
        
        $students = $query->orderBy('id', 'desc')->get();
		
		
		$institutes = SchoolCategory::orderBy('name')->where('status','=',1)->pluck('name','id');
        
        return view('backend.students.index', compact('students', 'institutes', 'classes', 'courses'));
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
        
        //Check for the user profile      
        if(Auth::user()->hasRole('school')){
            $profile = Auth::user()->profile;
            if(isset($profile->school_id)){
                $school_id = $profile->school_id;
                $category_id = $profile->school->school_category;
                $query = $query->where('id','=',$profile->school->school_category);
				
			}            
        }
        
        $institutes = $query->orderBy('name')
                        ->pluck('name','id');

        return view('backend.students.create', compact('institutes','school_id','category_id'));
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

        $validator = Validator::make($data, [
                    'institute_type' => 'required',
                    'school_name' => 'required',
					'course' => 'required',
					'class' => 'required',
                    'first_name' => 'required|min:2',
                    'username' => 'required|string|min:4|max:255|regex:/^(?=.*[a-z]).+$/|unique:users',
                    'password' => 'required|confirmed|string|min:6',
                    'email' => 'email|max:255|unique:users',
                    'mobile' => 'required|numeric|unique:school_managers',
                        ], [
                    'username.regex' => "Username must be contains At least one lowercase",
                   // 'password.regex' => "Password must be contains minimum 8 character with at least one lowercase, one uppercase, one digit, one special character",
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                            ->withErrors($validator) // send back all errors to the form
                            ->withInput();
        }

        //Persist the school manager in the database
        //form data is available in the request object
        $student = new Student();

        /** Below code for save photo * */
        if ($request->hasFile('photo')) {

            $validator = Validator::make($request->all(), [
                        'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                            ], [
                        'photo.max' => 'The profile photo may not be greater than 2 mb.',
            ]);

            if ($validator->fails()) {
                return redirect()->route('backend.students.create')->withErrors($validator)->withInput();
            }

            $destinationPath = public_path('/uploads/student/');
            $newName = '';
            $fileName = $request->all()['photo']->getClientOriginalName();
            $file = request()->file('photo');
            $fileNameArr = explode('.', $fileName);
            $fileNameExt = end($fileNameArr);
            $newName = date('His') . rand() . time() . '__' . $fileNameArr[0] . '.' . $fileNameExt;

            $file->move($destinationPath, $newName);

            $imagePath = 'uploads/student/' . $newName;
            $student->profile_image = $imagePath;
        }

        $user = User::create([
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password'])
        ]);

        $role = \DB::table('roles')->where('slug', '=', 'student')->first();
        $user->attachRole($role, $user->id);

        $student->user_id = $user->id;
		$student->username = $data['username'];
        $student->first_name = $data['first_name'];
        $student->last_name = $data['last_name'];
        $student->email = $data['email'];
        $student->mobile = $data['mobile'];
		$student->school_category = $data['institute_type'];
        $student->school_id = $data['school_name'];
		$student->course_id = $data['course'];
		$student->class_id = $data['class'];
        $student->status = ($data['status'] !== null) ? $data['status'] : 0;
        $student->country = $data['phone_code'];
        

        $student->save(); //persist the data 

        $studentdata = Student::findOrFail($student->id);
        $studentdata->school_name = $studentdata->school->school_name;

        //save user other information
        $user_more_info = User::find($user->id);
        $user_more_info->name = $data['first_name'];
        $user_more_info->mobile_verified_at = date('Y-m-d H:i:s');
        $user_more_info->save(); //persist the data

        if (!empty($user->email))
            Mail::to($user->email, "New student on " . env('APP_NAME', 'Xtra Class'))->send(new sendEmailtoSchoolstudent($studentdata));


        return redirect()->route('backend.students.index')->with('success', 'Student Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        
        if(!Auth::user()->hasAccessToSchool($student->school_id)){
            return redirect()->route('backend.dashboard');           
        }
		
		$student_videos = StudentVideo::where('student_id', $student->user_id)->pluck('video_id', 'video_id');
		//pr($student_videos); exit;
        $classesWatched = Video::whereIn('id', $student_videos)->count();
        $questionsCount = Question::where('sender_id', $student->user_id)->where('type', 'question')->count();
        $replyCount = Question::where('sender_id', $student->user_id)->where('type', 'reply')->count();
        $noteDownloads = StudentDownload::where([
                    'student_id' => $student->user_id,
                    'status' => 1
                ])->count();
		
		$page = $request->input('page', 1);
		
		$studentHistories = StudentHistory::where([
                    'student_id' => $student->user_id
                ])
               ->whereHas('video', function($q) use($request) {
                 /*    if (!empty($request->course_id)) {
                        $q->where('course_id', $request->course_id);
                    }
                    if (!empty($request->school_id)) {
                        $q->where('school_id', $request->school_id);
                    }
					*/
                }) 
                ->whereNotNull('video_id')
                ->orderBy('id', 'desc')
                ->paginate(GLB::paginate());
				
			//	pr($studentHistories); exit;
			
		return view('backend.students.show', compact('student', 'studentHistories', 'classesWatched', 'questionsCount', 'replyCount', 'noteDownloads'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $school_id = '')
    {
		//Find the student
        $student = Student::find($id);
        
        if(!Auth::user()->hasAccessToSchool($student->school_id)){
            return redirect()->route('backend.dashboard');           
        }
        
        $query = SchoolCategory::where('status','=',1);
        
        if(Auth::user()->hasRole('school')){
            $profile = Auth::user()->profile;
            $query = $query->where('id','=',$profile->school->school_category);
          //  $schools = $schools->where('id','=',$profile->school_id);
        }
        
        $institutes = $query->orderBy('name')
                        ->pluck('name','id');
        
        $schools = School::orderBy('school_name')
                        ->where('school_category', $student->school->school_category)->where('status', '=', 1)
                        ->pluck('school_name', 'id');
						
		$courses = Course::where('school_id', $student->school_id)->orderBy('name')->where('status','=',1)->pluck('name','id');
		$classes = Classes::where('course_id', $student->course_id)->orderBy('class_name')->where('status','=',1)->pluck('class_name','id');
	    $departments = Department::where('school_id',$student->school_id)->where('status','=',1)->pluck('name','id');	
		
		
        return view('backend.students.edit', compact('student', 'institutes', 'schools', 'courses', 'classes', 'departments'));
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
        //Retrieve the student and update
        $student = Student::find($id);
        $data = $request->all();
        $user_id = $student->user_id;
        $validator = Validator::make($data, [
                    'first_name' => 'required|min:2',
                    'password' => 'nullable|confirmed|string|min:6',
                    'email' => [
                        'email',
                        'required',
                        'max:180',
                        Rule::unique('users')->where(function ($query) use($user_id) {
                                    return $query->where('id', '<>', $user_id);
                                })
                    ],
                    'mobile' => [
                        'required',
                        'numeric',
                        Rule::unique('students')->where(function ($query) use($user_id) {
                                    return $query->where('user_id', '<>', $user_id);
                                })
                    ],
                        ], [
                  // 'password.regex' => "Password must be contains minimum 8 character with at least one lowercase, one uppercase, one digit, one special character",
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                            ->withErrors($validator) // send back all errors to the form
                            ->withInput();
        }

        if ($request->hasFile('photo')) {

            $validator = Validator::make($request->all(), [
                        'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                            ], [
                        'photo.max' => 'The profile photo may not be greater than 2 mb.',
            ]);

            if ($validator->fails()) {
                return redirect()->route('backend.students.edit', $id)->withErrors($validator)->withInput();
            }

            $destinationPath = public_path('/uploads/student/');
            $newName = '';
            $fileName = $request->all()['photo']->getClientOriginalName();
            $file = request()->file('photo');
            $fileNameArr = explode('.', $fileName);
            $fileNameExt = end($fileNameArr);
            $newName = date('His') . rand() . time() . '__' . $fileNameArr[0] . '.' . $fileNameExt;

            $file->move($destinationPath, $newName);

            $oldImage = public_path($student->profile_image);
            //echo $oldImage; exit;
            if (!empty($student->profile_image) && file_exists($oldImage)) {
                unlink($oldImage);
            }

            $imagePath = 'uploads/student/' . $newName;
            $student->profile_image = $imagePath;
        }

        $student->first_name = $data['first_name'];
        $student->last_name = $data['last_name'];
        $student->email = $data['email'];
        $student->mobile = $data['mobile'];
        $student->status = ($data['status'] !== null) ? $data['status'] : 0;
        $student->country = $data['phone_code'];
       

        $student->save(); //persist the data
        //save user other information
        $user_more_info = User::find($student->user_id);
        if (isset($data['password']) && !empty($data['password'])) {
            $user_more_info->password = Hash::make($data['password']);
        }
        $user_more_info->email = $data['email'];
        $user_more_info->save(); //persist the data

        return redirect()->route('backend.students.index')->with('success', 'Student Information Updated Successfully');
    }
	
	/**
     * form to assigned classes to student.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
	public function assignedclasses($uuid) {
	
		$student = Student::where('uuid',$uuid)->first();
        
		if(isset($student->school_id) && !empty($student->school_id)) {
			$courses = Course::orderBy('name')->where('status','=',1)->where('school_id','=',$student->school_id)->get();
		} else {
			$courses = array();
		}
		
		//pr($courses); exit;
		
		$studentclasses = StudentClasses::where('user_id', $student->user_id)->select('class_id')->pluck('class_id')->toArray();
		//pr($studentclasses); exit;
        return view('backend.students.assignedclasses', compact('student', 'courses', 'studentclasses'));
	
	}
	
	/**
     * form to assigned classes to student.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
	public function save_assignedclasses(Request $request) {
	
		$count_assigned_classes = StudentClasses::where('user_id', $request->input('user'))->count();
		
		//Check for the user profile      
        if(Auth::user()->hasRole('school')){
            $profile = Auth::user()->profile;
            if(isset($profile->school_id)){
                $school_id = $profile->school_id;
                $school = new School();
				$student_add_permission = $school->schoolHasLimit($profile->school_id);
				if(!$student_add_permission && $count_assigned_classes < 1) {
					return Redirect::back()->with('warning', 'Class Assign Limit Exceed');
				}
				
            }            
        }
		
		$data = $request->all();
		
		if(!Auth::user()->hasAccessToSchool($request->input('school'))){
            return redirect()->route('backend.dashboard');           
        }
		
		$count_assigned_classes = StudentClasses::where('user_id', $request->input('user'))->count();
		
		//pr($data); exit;
		if(!isset($data['class_id']) && empty($data['class_id']) && $count_assigned_classes < 1) {
			
			return Redirect::back()
                            ->withErrors(['error'=>'Please select at least one class']) // send back all errors to the form
                            ->withInput();
		} 
		
		$student = Student::where('user_id',$request->input('user'))->first();
		
		StudentClasses::where('user_id', $request->input('user'))->delete();
		
		if(!empty($data['class_id'])) {
			foreach($data['class_id'] as $key=>$val) {
				$student_class = new StudentClasses();
				$student_class->school_id = $request->input('school');
				$student_class->user_id = $request->input('user');
				$student_class->class_id = $val;
				$student_class->save();
			}
		}
		return redirect()->route('backend.students.assignedclasses', $student->uuid)->with('success', 'Classes Information Successfully Saved.');
	
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
		
		//delete user
        $user = User::find($student->user_id);
        $user->delete();

		//delete assign classes if any
		StudentClasses::where('user_id', $student->user_id)->delete();
		
        $student->delete();


        return redirect()->route('backend.students.index')->with('success', 'Student Deleted Successfully');
    }

}
