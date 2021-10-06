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

