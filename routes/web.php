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


Route::get('/videotest', 'Frontend\ClassroomController@videotest')->name('videotest');
Route::get('/emailtest', function() {
    return view('emails.sendContactInquiry');
});
Route::get('/tab_page', function() {
    return view('frontend.pages.tab_page');
});

Auth::routes();
Route::namespace('Auth')->group(function () {
    /* Below route for all register get routes land on that route */
    Route::get('/register/step{num}', 'RegisterController@step')->name('registerStep');

    /* Below routes create user and save user extra inforamtion */
    Route::post('/register/step2', 'RegisterController@step2')->name('registerStep2');
    Route::post('/register/step3', 'RegisterController@step3')->name('registerStep3');
    Route::post('/register/step4', 'RegisterController@step4')->name('registerStep4');
    /* End routes create user and save user extra inforamtion */

    Route::get('/register-success/{id}', 'RegisterController@success')->name('registerSuccess');

    Route::get('/user/verify/{token}', 'RegisterController@verifyUser');
});

Route::get('/', 'HomeController@index')->name('front');
Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/user/verify/{token}', 'HomeController@verifyUser')->name('verifyUser');


/* ----------------------------------------------------------------------- */

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {

    /* Static pages route start  */
    Route::get('/about', 'PageController@getAbout')->name('pages.about');
    Route::get('/contact', 'PageController@getContact')->name('pages.contact');
    Route::post('/contact', 'PageController@sendContact')->name('pages.sendContact');
    Route::get('/terms-and-condition', 'PageController@getPrivacy')->name('pages.terms_condition');
    Route::get('/how-to-access', 'PageController@getHowToAccess')->name('pages.how_to_access');
    Route::get('/help', 'PageController@getHelp')->name('pages.help');

    /* Knowledge Article route start  */
    Route::get('/articles', 'KnowledgeArticleController@index')->name('knowledge.articles.index');

    /* Ajax Login Route */
    Route::post('/ajax-login', 'AjaxLoginController@login')->name('ajaxLogin');

    /* Student route start  */

    /* Student Profiule Route */
    Route::get('/profile', 'StudentController@profile')->name('profile');
    /* Student history Route */
    Route::post('/student-history', 'StudentController@studentHistory')->name('studentHistory');
    /* Student remove history Route */
    Route::post('/remove-student-history', 'StudentController@removeHtudentHistory')->name('removeHtudentHistory');

    /* Student favourites Route */
    Route::post('/student-favourites', 'StudentController@studentFavourites')->name('studentFavourites');
    Route::post('/upload-urofile', 'StudentController@uploadProfile')->name('uploadProfile');
    Route::post('/change-avatar', 'StudentController@changeAvatar')->name('changeAvatar');

    /* Student route end  */

    /* Tutor route start  */
    Route::get('/tutor-lecture', 'StudentController@tutorLecture')->name('tutorLecture');
    Route::get('/tutor-posts', 'StudentController@tutorPosts')->name('tutorPosts');
    Route::post('/upload-notes', 'StudentController@uploadNotes')->name('uploadNotes');
    Route::get('/video/upload-file/{uuid}', 'StudentController@uploadVideoFile')->name('uploadVideoFile');
    /* Tutor route end  */

    /* Schools route start  */
    Route::get('/search', 'SchoolController@searchResult')->name('search');

    Route::post('/search', 'SchoolController@search')->name('schools');
    Route::post('/school-data.json', 'SchoolController@schoolData')->name('schoolData');
    Route::post('/course-data.json', 'SchoolController@courseData')->name('courseData');
    Route::post('/classes-data.json', 'SchoolController@classesData')->name('classesData');
    /* Schools route end  */

    /* Classroom route start  */
    Route::get('/classroom/{id}', 'ClassroomController@index')->name('classroom');
    Route::get('/playing-data.json', 'ClassroomController@playingData')->name('playingData');
    Route::get('/questions-data.json', 'ClassroomController@questionsData')->name('questionsData');
    Route::get('/archive-data.json', 'ClassroomController@archiveData')->name('archiveData');
    Route::get('/favourites-data.json', 'ClassroomController@favouritesData')->name('favouritesData');
    Route::get('/insert-play-video-status', 'ClassroomController@playVideo')->name('playVideo');
    Route::get('/post-questions', 'ClassroomController@postQuestions')->name('postQuestions');
    Route::get('/set-favourites', 'ClassroomController@setFavourites')->name('setFavourites');
    Route::get('/fleg-video', 'ClassroomController@flegVideo')->name('flegVideo');
    Route::get('/student-downloads', 'ClassroomController@studentDownloads')->name('studentDownloads');
    Route::get('/archive-search', 'ClassroomController@archiveSearch')->name('archiveSearch');
    Route::get('/get-semester-options.json', 'ClassroomController@getSemesterOptions')->name('getSemesterOptions');
    Route::get('/get-semester-daterange.json', 'ClassroomController@getSemesterDaterange')->name('getSemesterDaterange');
    /* Classroom route end  */

    /*
     * Frontend Routes
     * Namespaces indicate folder structure
     */
    Route::group(['namespace' => 'Api', 'as' => 'api.'], function () {

        /* Api route start  */
        Route::post('/change-password-api', 'ApiController@changePasswordApi')->name('changePasswordApi');
        Route::post('/update-tutor', 'ApiController@updateTutor')->name('updateTutor');
        Route::post('/update-student', 'ApiController@updateStudent')->name('updateStudent');
        Route::post('/get-institution-optinns.json', 'ApiController@getInstitutionOptinns')->name('getInstitutionOptinns');

        Route::post('/get-school-optinns.json', 'ApiController@getSchoolOptinns')->name('getSchoolOptinns');

        Route::post('/get-course-or-department-optinns.json', 'ApiController@getDepartmentOrCourseOptions')->name('getDepartmentOrCourseOptions');
        Route::post('/get-class-optinns.json', 'ApiController@getClassOptions')->name('getClassOptions');
        Route::get('/get-topic-optinns.json', 'ApiController@getTopicOptions')->name('getTopicOptions');
        Route::get('/get-period-optinns.json', 'ApiController@getPeriodOptions')->name('getPeriodOptions');
        Route::get('/get-program-full-optinns.json', 'ApiController@getProgramFullOptions')->name('getProgramFullOptions');
        Route::get('/get-classes-full-optinns.json', 'ApiController@getClassesFullOptions')->name('getClassesFullOptions');
        Route::get('/get-subjects-full-optinns.json', 'ApiController@getSubjectsFullOptions')->name('getSubjectsFullOptions');
        Route::post('/create-video', 'ApiController@createVideo')->name('createVideo');
        Route::post('/create-article', 'ApiController@createArticle')->name('createArticle');
        /* Api route end  */

        Route::get('/update-uuid/{table}', 'ApiController@updateUUID')->name('updateUUID');
    });


    /*
     * Frontend Ajax Routes
     * prefix indicate the url common profix
     */
    Route::group(['prefix' => 'admin', 'as' => 'ajax.'], function () {
        Route::post('/send-otp', 'AjaxController@sendOtp')->name('sendOtp');
        Route::post('/verify-otp', 'AjaxController@verifyOtp')->name('verifyOtp');
        Route::post('/searchschool', 'AjaxController@searchschool')->name('searchschool');
        Route::post('/schoolcourses', 'AjaxController@schoolcourses')->name('schoolcourses');
        Route::post('/schoolclasses', 'AjaxController@schoolclasses')->name('schoolclasses');
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

    Route::get('/', 'DashboardController@index')->name('dashboard');
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

//------------------ Axios Routes Starts--------------------------
Route::group(['prefix' => 'axios', 'namespace' => 'axios'], function () {
    Route::any('index/{page}', 'AxiosController@index')->where('page', ".*");
});
//------------------ Axios Routes Ends----------------------------

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

