<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tutor;
use App\Models\School;
use App\Models\SchoolCategory;
use App\User;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Mail\sendEmailtoSchooltutor;
use Illuminate\Support\Facades\Mail;
use Auth;
use App\Models\Video;
use App\Models\StudentVideo;
use App\Models\Question;
use App\Models\StudentDownload;

class TutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Tutor::where('id','<>',0);
        
        if(Auth::user()->hasRole('school')){
            $profile = Auth::user()->profile;
            if(isset($profile->school_id)){
                $query = $query->where('school_id','=',$profile->school_id);
            }
        } 
        
        $tutors = $query->orderBy('id', 'desc')->get();
		
		$query = SchoolCategory::where('status','=',1);
		
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
						
        return view('backend.tutors.index', compact('tutors', 'institutes'));
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
        
        if(Auth::user()->hasRole('school')){
			$profile = Auth::user()->profile;
            $school_id = $profile->school_id;
            $category_id = $profile->school->school_category;
            $query = $query->where('id','=',$profile->school->school_category);           
        }
        
        $institutes = $query->orderBy('name')
                        ->pluck('name','id');
        
        return view('backend.tutors.create', compact('institutes','school_id','category_id'));
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
                  //  'institute_type' => 'required',
                    'school_name' => 'required',
                    'first_name' => 'required|min:2',
                    'username' => 'required|string|min:4|max:255|regex:/^(?=.*[a-z]).+$/|unique:users',
                    'password' => 'required|confirmed|string|min:6',
                    'email' => 'email|max:255|unique:users',
                    'mobile' => 'required|numeric|unique:school_managers',
                        ], [
                    'username.regex' => "Username must be contains At least one lowercase",
                    //'password.regex' => "Password must be contains minimum 8 character with at least one lowercase, one uppercase, one digit, one special character",
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                            ->withErrors($validator) // send back all errors to the form
                            ->withInput();
        }

        //Persist the school manager in the database
        //form data is available in the request object
        $tutor = new Tutor();

        /** Below code for save photo * */
        if ($request->hasFile('photo')) {

            $validator = Validator::make($request->all(), [
                        'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                            ], [
                        'photo.max' => 'The profile photo may not be greater than 2 mb.',
            ]);

            if ($validator->fails()) {
                return redirect()->route('backend.tutors.create')->withErrors($validator)->withInput();
            }

            $destinationPath = public_path('/uploads/tutor/');
            $newName = '';
            $fileName = $request->all()['photo']->getClientOriginalName();
            $file = request()->file('photo');
            $fileNameArr = explode('.', $fileName);
            $fileNameExt = end($fileNameArr);
            $newName = date('His') . rand() . time() . '__' . $fileNameArr[0] . '.' . $fileNameExt;

            $file->move($destinationPath, $newName);

            $imagePath = 'uploads/tutor/' . $newName;
            $tutor->profile_image = $imagePath;
        }

        $user = User::create([
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password'])
        ]);

        $role = \DB::table('roles')->where('slug', '=', 'tutor')->first();
        $user->attachRole($role, $user->id);

        $tutor->user_id = $user->id;
        $tutor->first_name = $data['first_name'];
        $tutor->last_name = $data['last_name'];
        $tutor->email = $data['email'];
        $tutor->mobile = $data['mobile'];
        $tutor->school_id = $data['school_name'];
        $tutor->status = ($data['status'] !== null) ? $data['status'] : 0;
		$tutor->upload_access = isset($data['upload_access']) ? $data['upload_access'] : 0;
        $tutor->country = $data['phone_code'];
        $tutor->tutor_subject = $data['tutor_subject'];

        $tutor->save(); //persist the data 

        $tutordata = Tutor::findOrFail($tutor->id);
        $tutordata->school_name = $tutordata->school->school_name;

        //save user other information
        $user_more_info = User::find($user->id);
        $user_more_info->name = $data['first_name'];
        $user_more_info->mobile_verified_at = date('Y-m-d H:i:s');
        $user_more_info->save(); //persist the data

        if (!empty($user->email))
            Mail::to($user->email, "New tutor on " . env('APP_NAME', 'Xtra Class'))->send(new sendEmailtoSchooltutor($tutordata));


        return redirect()->route('backend.tutors.index')->with('success', 'Tutor Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tutor = Tutor::findOrFail($id);
        
        if(!Auth::user()->hasAccessToSchool($tutor->school_id)){
            return redirect()->route('backend.dashboard');           
        }
		
		$tutor_videos = StudentVideo::where('student_id', $tutor->user_id)->pluck('video_id', 'video_id');
        $classesHosted = Video::whereIn('id', $tutor_videos)->groupBy('class_id')->count();
        $questionsAsked = Question::where('sender_id', $tutor->user_id)->where('type', 'question')->count();
        $replyCount = Question::where('sender_id', $tutor->user_id)->where('type', 'reply')->count();
        $noteAdded = Video::where([
                    'tutor_id' => $tutor->user_id,
                    'status' => 1
                ])->groupBy('topic_id')->count();
        
        return view('backend.tutors.show', compact('tutor', 'classesHosted', 'replyCount', 'questionsAsked', 'noteAdded'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Find the tutor
        $tutor = Tutor::find($id);
        
        if(!Auth::user()->hasAccessToSchool($tutor->school_id)){
            return redirect()->route('backend.dashboard');           
        }
        
        $query = SchoolCategory::where('status','=',1);
        $schools = School::where('status', '=', 1);
        
        if(Auth::user()->hasRole('school')){
            $profile = Auth::user()->profile;
            $query = $query->where('id','=',$profile->school->school_category);
            $schools = $schools->where('id','=',$profile->school_id);
        }
        
        $institutes = $query->orderBy('name')
                        ->pluck('name','id');
        
        $schools = $schools->orderBy('school_name')
                        ->where('school_category', $tutor->school->school_category)
                        ->pluck('school_name', 'id');

        return view('backend.tutors.edit', compact('tutor', 'institutes', 'schools'));
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
        //Retrieve the tutor and update
        $tutor = Tutor::find($id);
        $data = $request->all();
        $user_id = $tutor->user_id;
        $validator = Validator::make($data, [
                   // 'institute_type' => 'required',
                  //  'school_name' => 'required',
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
                        Rule::unique('tutors')->where(function ($query) use($user_id) {
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
                return redirect()->route('backend.tutors.edit', $id)->withErrors($validator)->withInput();
            }

            $destinationPath = public_path('/uploads/tutor/');
            $newName = '';
            $fileName = $request->all()['photo']->getClientOriginalName();
            $file = request()->file('photo');
            $fileNameArr = explode('.', $fileName);
            $fileNameExt = end($fileNameArr);
            $newName = date('His') . rand() . time() . '__' . $fileNameArr[0] . '.' . $fileNameExt;

            $file->move($destinationPath, $newName);

            $oldImage = public_path($tutor->profile_image);
            //echo $oldImage; exit;
            if (!empty($tutor->profile_image) && file_exists($oldImage)) {
                unlink($oldImage);
            }

            $imagePath = 'uploads/tutor/' . $newName;
            $tutor->profile_image = $imagePath;
        }

        $tutor->first_name = $data['first_name'];
        $tutor->last_name = $data['last_name'];
        $tutor->email = $data['email'];
        $tutor->mobile = $data['mobile'];
        //$tutor->school_id = $data['school_name'];
        $tutor->status = ($data['status'] !== null) ? $data['status'] : 0;
        $tutor->upload_access = isset($data['upload_access']) ? $data['upload_access'] : 0;
        $tutor->country = $data['phone_code'];
        $tutor->tutor_subject = $data['tutor_subject'];

        $tutor->save(); //persist the data
        //save user other information
        $user_more_info = User::find($tutor->user_id);
        if (isset($data['password']) && !empty($data['password'])) {
            $user_more_info->password = Hash::make($data['password']);
        }
        $user_more_info->email = $data['email'];
        $user_more_info->save(); //persist the data

        return redirect()->route('backend.tutors.index')->with('success', 'Tutor Information Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tutor = Tutor::find($id);

        $user = User::find($tutor->user_id);
        $user->delete();

        $tutor->delete();


        return redirect()->route('backend.tutors.index')->with('success', 'Tutor Deleted Successfully');
    }

}
