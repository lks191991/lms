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

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::post('auth/phone/verification', 'API\UserController@confirm_phone');
Route::post('auth/user/save_avatar', 'API\UserController@save_avatar');

Route::get('countries', 'API\UserController@list_countries');
Route::get('avatars', 'API\UserController@list_avatars');

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



	Route::post('question/save', 'API\SchoolController@save_question');
});
Route::fallback(function(){
    return response()->json(['data'=>new \stdClass(), 'message' => 'Page Not Found. If error persists, contact info@website.com', 'statusCode' => 404], 404);
});
