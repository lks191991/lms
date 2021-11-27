<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Emadadly\LaravelUuid\Uuids;

class Topic extends Model
{

    use Uuids;
	
	use SoftDeletes;
	
    public function subject()
    {
        return $this->hasOne(Subject::Class, 'id', 'subject_id')->withDefault();
    }
	
	public function videos()
    {

        return $this->hasMany(Video::class, 'topic_id');
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
	
	/*
     * Get referenced record.
     */
    public function class_details($class_id)
    {
       $class_details = Classes::find($class_id);
	   if(isset($class_details->class_name) && !empty($class_details->class_name)) {
			return $class_details;
	   } else {
			return '';
	   }
    }

}
