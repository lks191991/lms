<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Emadadly\LaravelUuid\Uuids;

class Classroom extends Model
{

    use Uuids;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function tutor()
    {
        return $this->hasOne(Tutor::Class, 'id', 'tutor_id')->withDefault();
    }

    public function course()
    {
        return $this->hasOne(Course::Class, 'id', 'course_id')->withDefault();
    }

    public function className()
    {
        return $this->hasOne(Classes::Class, 'id', 'class_id')->withDefault();
    }

    public function school()
    {
        return $this->hasOne(School::Class, 'id', 'school_id')->withDefault();
    }

    public function singleClass()
    {
        return $this->hasOne(Classes::Class, 'id', 'class_id')->where('status', 1)->withDefault();
    }

    public function videoToClassroom()
    {
        return $this->hasOne(Video::Class, 'classroom_id', 'id')->withDefault();
    }

    public function videos()
    {
        return $this->hasOne(Video::Class, 'classroom_id', 'id')->withDefault();
    }
    
    public function date()
    {
        return date('d-m-Y', strtotime($this->date));
    }    

}
