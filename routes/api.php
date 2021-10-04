<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('auth/user/login', 'API\UserController@login');
Route::post('auth/user/register', 'API\UserController@register');
Route::post('auth/phone/verification', 'API\UserController@confirm_phone');
Route::post('auth/user/save_academic_info', 'API\UserController@save_academic_info');
Route::post('auth/user/save_avatar', 'API\UserController@save_avatar');

Route::get('countries', 'API\UserController@list_countries');
Route::get('avatars', 'API\UserController@list_avatars');

Route::get('institution', 'API\SchoolController@list_institutions');//
Route::get('institution/{id}/school', 'API\SchoolController@list_schools');//
//Route::get('institution/{id}', 'API\SchoolController@institution_details');

Route::get('school', 'API\SchoolController@list_schools');//
Route::get('school/{id}', 'API\SchoolController@school_details');//

Route::get('school/{schoolId}/department', 'API\SchoolController@list_departments');//
Route::get('school/{schoolId}/course', 'API\SchoolController@list_school_courses');//
Route::get('school/{schoolId}/class', 'API\SchoolController@list_school_classes');//

Route::get('school/{schoolId}/{departmentId}/course', 'API\SchoolController@list_courses');
Route::get('school/{schoolId}/{courseId}/class', 'API\SchoolController@list_classes');

Route::get('department/{id}', 'API\SchoolController@department_details');//
Route::get('department/{id}/course', 'API\SchoolController@list_department_course');//

//Route::get('courses/{id?}', 'API\SchoolController@list_courses');
Route::get('course/{id}', 'API\SchoolController@course_details');//
Route::get('course/{id}/class', 'API\SchoolController@list_course_classes');//

Route::get('classes/{id?}', 'API\SchoolController@list_classes');
Route::get('class/{id}', 'API\SchoolController@class_details');
Route::get('class/{id}/lesson', 'API\SchoolController@list_lessons');
Route::get('class/{id}/period', 'API\SchoolController@list_periods');
Route::get('class/{id}/years', 'API\SchoolController@list_years');
Route::get('class/{id}/semesters', 'API\SchoolController@list_semesters');
Route::get('class/{id}/semester-video-dates', 'API\SchoolController@get_semester_video_dates');
Route::get('class/{id}/archive-search', 'API\SchoolController@archive_search');

Route::get('questions/{id}', 'API\SchoolController@list_questions');

Route::post('list_classrooms', 'API\SchoolController@list_classrooms');
Route::get('classroom_detail/{id}', 'API\SchoolController@classroom_detail');

Route::get('teacher/{teacherId}', 'API\UserController@teacher_details');
Route::get('teacher/{teacherId}/video', 'API\UserController@list_teacher_videos');

Route::middleware(['auth:api'])->group(function () {
	$reqLang = request('lang');
	if(is_null($reqLang)) {
		$lang_id = 1;
		App::setLocale('en');
	} else {
		$lang_id = 1;
		App::setLocale('en');
	}

	Route::post('auth/token/refresh', 'API\UserController@refresh_token');
	Route::post('auth/device', 'API\UserController@save_device');

	Route::get('profile', 'API\UserController@get_user_profile');//
	Route::post('avatar', 'API\UserController@update_avatar');//
	Route::patch('profile', 'API\UserController@update_profile');//
	Route::post('password', 'API\UserController@change_password');//

	//Tutor APIs
	Route::post('teacher/{teacherId}/send_mail', 'API\UserController@send_mail');//
	Route::post('note', 'API\UserController@upload_note');//
	Route::post('video', 'API\UserController@upload_video');//
	Route::post('attachment', 'API\UserController@upload_video_attachment');//

	//Route::post('verifysignupotp', 'API\UserController@verifysignupotp');
	//Route::post('save_academic_info', 'API\UserController@save_academic_info');
	//Route::post('save_avatar', 'API\UserController@save_avatar');
	//Route::post('profile/make_favorite', 'API\UserController@make_fav_video');
	Route::get('profile/history', 'API\UserController@class_history');
	Route::post('profile/history', 'API\UserController@add_to_history');
	Route::get('profiles', 'API\UserController@list_profiles');

	Route::get('profile/favorite', 'API\UserController@fav_video_list');
	Route::put('profile/favorite', 'API\UserController@make_fav_video');
	Route::delete('profile/favorite', 'API\UserController@make_fav_video');

	Route::post('question/save', 'API\SchoolController@save_question');
});
Route::fallback(function(){
    return response()->json(['data'=>new \stdClass(), 'message' => 'Page Not Found. If error persists, contact info@website.com', 'statusCode' => 404], 404);
});
