<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */


Auth::routes();
Route::get('/', 'HomeController@index')->name('front');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/course-list/{CourseId}', 'HomeController@courseList')->name('course-list');
Route::get('/course-details/{subjectId}', 'HomeController@courseDetails')->name('course-details');
Route::get('/course-search', 'HomeController@courseSearch')->name('course-search');
Route::get('/auto-search', 'HomeController@autoSearch')->name('auto-search');

/* ----------------------------------------------------------------------- */

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
Route::get('/contact-us', 'PageController@getContact')->name('contactUs');
Route::post('/contact-us', 'PageController@sendContact')->name('contactUsPost');

//Route::namespace('Auth')->group(function () {
	 /* Payment Route */
	Route::get('/payment', 'PaymentController@index')->name('payment');
	Route::post('/payment', 'PaymentController@stripePost')->name('paymentpost');
	Route::get('/success', 'PaymentController@paymentSuccess')->name('paymentSuccess');
	Route::get('/faild', 'PaymentController@paymentFaild')->name('paymentFaild');
    /* Student Profiule Route */
    Route::get('/profile', 'StudentController@profile')->name('profile');
	Route::post('/profile', 'StudentController@updateProfileTutor')->name('updateProfileTutor');
	Route::post('/profile-student', 'StudentController@updateProfileStudent')->name('updateProfileStudent');
	Route::get('/my-mylearning-list', 'StudentController@mylearningList')->name('mylearningList');
	Route::get('/my-mylearning-details/{id}/{subjectId}/{videoUid?}', 'StudentController@mylearningStart')->name('mylearningStart');
	
	Route::get('/my-payment', 'PaymentController@myPayment')->name('myPayment');
    Route::post('/upload-urofile', 'StudentController@uploadProfile')->name('uploadProfile');
    Route::post('/change-avatar', 'StudentController@changeAvatar')->name('changeAvatar');
	Route::get('/change-password', 'StudentController@changePassword')->name('changePassword');
	Route::post('/change-password', 'StudentController@changePasswordSave')->name('changePasswordSave');
//});
	//Topic routes
	Route::get('/topics', 'TutorController@index')->name('topics');
    Route::get('/topic/create', 'TutorController@create')->name('topic.create');
    Route::post('/topic/store', 'TutorController@store')->name('topic.store');
    Route::get('topic/edit/{id}', 'TutorController@edit')->name('topic.edit');
    Route::post('topic/update/{id}', 'TutorController@update')->name('topic.update');
    Route::delete('topic/delete/{id}', 'TutorController@destroy')->name('topic.destroy');
	
	//Topic routes
	Route::get('/videos', 'TutorController@indexVideo')->name('videos');
    Route::get('/video/create', 'TutorController@createVideo')->name('video.create');
    Route::post('/video/store', 'TutorController@storeVideo')->name('video.store');
    Route::get('video/edit/{id}', 'TutorController@editVideo')->name('video.edit');
    Route::post('video/update/{id}', 'TutorController@updateVideo')->name('video.update');
    Route::delete('video/delete/{id}', 'TutorController@destroyVideo')->name('video.destroy');
   

    


});

Route::group(['prefix' => 'admin', 'as' => 'admin'], function () {
Route::namespace('Auth')->group(function () {
    /* Below route for all register get routes land on that route */
	Route::get('/', 'LoginController@loginView')->name('loginView');
});
});



/* ----------------------------------------------------------------------- */
/*
 * Backend Ajax Routes
 * prefix indicate the url common profix
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'ajax.'], function () {
    Route::post('/category/schools/{std_filter?}', 'AjaxController@getSchools')->name('category.schools');
    Route::post('/school-departments', 'AjaxController@getSchoolDepartments')->name('school.departments');
    Route::post('/school-courses', 'AjaxController@getSchoolCourses')->name('school.courses');
    Route::post('/stdfilter-courses', 'AjaxController@getStudentfilterCourses')->name('school.stdfiltercourses');
    Route::post('/department-courses', 'AjaxController@getDepartmentCourses')->name('department.courses');
    Route::post('/school-courseclasses', 'AjaxController@getSchoolCourseclasses')->name('school.courseclasses');
    Route::post('/stdfilter-courseclasses', 'AjaxController@getStudentfilterCourseclasses')->name('school.stdfiltercourseclasses');
    Route::post('/class-subject', 'AjaxController@getClassSubjects')->name('class.subject');
    Route::post('/class-periods', 'AjaxController@getClassPeriods')->name('class.period');
    Route::post('/subject-topics', 'AjaxController@getSubjectTopics')->name('subject.topics');
	Route::post('/subject-topics-tutor', 'AjaxController@getSubjectTopicsTutor')->name('subject.topics.tutor');
    Route::post('/school-classsubjects', 'AjaxController@getSchoolClassSubjects')->name('school.classsubjects');
    Route::post('/school-filterclasssubjects', 'AjaxController@getSchoolfilterClassSubjects')->name('school.filterclasssubjects');
    Route::post('/school-tutors', 'AjaxController@getSchoolTutors')->name('school.tutors');
    Route::post('/upload-video', 'AjaxController@dropzoneStore')->name('dropzone.upload.video');
    Route::post('/upload-note', 'AjaxController@dropzoneNoteStore')->name('dropzone.upload.note');
});
/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['admin', 'preventBackHistory']], function () {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    //Route::resource('schools', 'SchoolController')->name('schools');
    //schools routes
    Route::get('/schools', 'SchoolController@index')->name('schools');
    Route::get('/school/create', 'SchoolController@create')->name('school.create');
    Route::post('/school/store', 'SchoolController@store')->name('school.store');
    Route::get('school/edit/{id}', 'SchoolController@edit')->name('school.edit');
    Route::post('school/update/{id}', 'SchoolController@update')->name('school.update');
    Route::delete('school/delete/{id}', 'SchoolController@destroy')->name('school.destroy');
    Route::get('/school/details/{id}', 'SchoolController@show')->name('school.show');
    Route::post('/savesemester', 'SchoolController@savesemester')->name('school.savesemester');

    //category routes
    Route::resource('categories', 'CategoryController');

    //course routes
    Route::get('/courses', 'CourseController@index')->name('courses');
    Route::get('/course/create/{id?}', 'CourseController@create')->name('course.create');
    Route::post('/course/store', 'CourseController@store')->name('course.store');
    Route::get('course/edit/{id}/{school_id?}', 'CourseController@edit')->name('course.edit');
    Route::post('course/update/{id}', 'CourseController@update')->name('course.update');
    Route::delete('course/delete/{id}/{school_id?}', 'CourseController@destroy')->name('course.destroy');
    Route::get('/course/{id}', 'CourseController@show')->name('course.show');
    Route::post('course/edit', 'CourseController@edit_ajax')->name('course.edit_ajax');
    //classroom routes
    Route::resource('classrooms', 'ClassroomController');

    //Subject routes
    Route::resource('subjects', 'SubjectController');
    Route::post('subject/edit', 'SubjectController@edit_ajax')->name('subjects.edit_ajax');

    //class routes
    Route::resource('classes', 'ClassesController');
    Route::post('class/edit', 'ClassesController@edit_ajax')->name('classes.edit_ajax');

    //Topic routes
    Route::resource('topics', 'TopicController');
    Route::post('topics/ordering/save', 'TopicController@saveOrdering')->name('topics.ordering.save');
    Route::post('topic/edit', 'TopicController@edit_ajax')->name('topics.edit_ajax');

    //Videos routes
    Route::resource('videos', 'VideoController');
	 Route::get('video/upload-csv', 'VideoController@csvUploadVideo')->name('video.upload.csv');
	 Route::post('video/upload-csv/save', 'VideoController@csvUploadVideoPost')->name('video.upload.csv.save');
    Route::get('video/upload-files/{uuid}', 'VideoController@uploadFiles')->name('video.upload.files');

    //Students routes
    Route::resource('students', 'StudentController');
    Route::get('/students/assignedclasses/{uuid}', 'StudentController@assignedclasses')->name('students.assignedclasses');
    Route::post('students/assignedclasses/store', 'StudentController@save_assignedclasses')->name('students.saveassignedclasses');

    //Tutors routes
    Route::resource('tutors', 'TutorController');


    //profile routes
    Route::resource('profile', 'ProfileController');

    //setting routes
    Route::resource('settings', 'SettingController');

    
    
});


/* Function for print array in formated form */
if (!function_exists('pr')) {
    function pr($array)
    {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

}

/* Function for print query log */
if (!function_exists('qLog')) {
    DB::enableQueryLog();
    function qLog()
    {
        pr(DB::getQueryLog());
    }

}

Route::any('/tus/{any?}', function () {
    $response = app('tus-server')->serve();

    return $response->send();
})->where('any', '.*');

