<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ReportVideo extends Model
{
    /**
	* Indicates if the model should be timestamped.
	*
	* @var bool
	*/
	
	public $table = 'report_videos';
	
	
	public function video()
    {
        return $this->hasOne(Video::Class, 'id', 'video_id')->withDefault();
    }

    public function user()
    {
        return $this->hasOne(User::Class, 'id', 'user_id')->withDefault();
    }
	
	
}
