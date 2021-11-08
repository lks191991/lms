<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Emadadly\LaravelUuid\Uuids;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Payment;
use App\User;

class UserSubscription extends Model
{

    public function course()
    {
        return $this->hasOne(Course::Class, 'id', 'course_id')->withDefault();
    }
	
	public function subject()
    {
        return $this->hasOne(Subject::Class, 'id', 'subject_id')->withDefault();
    }
	
	public function user()
    {
        return $this->hasOne(User::Class, 'id', 'user_id')->withDefault();
    }
	public function payment()
    {
        return $this->hasOne(Payment::Class, 'id', 'payment_id')->withDefault();
    }

}
