<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
	
    protected $except = [
		'api/*',
        '/get-institution-optinns.json',
        '/get-school-optinns.json',
        '/get-course-optinns.json',
        '/get-class-optinns.json',
        '/playing-data.json',
        '/insert-play-video-status',
        '/archive-data.json',
        '/post-questions',
        '/get-semester-options.json',
        '/school-data.json',
        '/course-data.json',
        '/classes-data.json',
	'/tus',
        '/tus/*',
        '/admin/upload-video',
       
    ];
}
