<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Emadadly\LaravelUuid\Uuids;

class Subject extends Model
{
    use Uuids;
	
	use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "subjects";

    protected $fillable = ['subject_name','banner_image', 'status', 'price'];

    public function video()
    {
        return $this->hasOne(Video::Class, 'id', 'video_id')->withDefault();
    }
	
	public function subject_class()
	{
		return $this->belongsTo('App\Models\Classes', 'class_id', 'id');
	}
	
	/*
     * Get all related topics.
     */
    public function topics()
    {
        $query = $this->hasMany(Topic::class, 'subject_id')->orderBy('weight', 'asc');

        return $query;
    }
	
	 /*
     * Get referenced record.
     */
    public function school_details($school_id)
    {
       $school_details = School::find($school_id);
	   if(isset($school_details->school_name) && !empty($school_details->school_name)) {
			return $school_details->school_name;
	   } else {
			return '';
	   }
    }
	
	 /*
     * Get referenced record.
     */
    public function course_details($course_id)
    {
       $course_details = Course::find($course_id);
	   if(isset($course_details->name) && !empty($course_details->name)) {
			return $course_details;
	   } else {
			return '';
	   }
    }

}
