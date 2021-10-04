<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentHistory extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	public $table = "student_history";
   // protected $fillable = ['student_id', 'source', 'source_id', 'source_id'];
    
	public function video()
    {
        return $this->hasOne(Video::Class, 'id', 'video_id')->withDefault();
    }
}
