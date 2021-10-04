<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class Question extends Model
{

    use Uuids;
    
    public function tutor()
    {
        return $this->hasOne(Tutor::Class, 'user_id', 'sender_id')->withDefault();
    }

    public function student()
    {
        return $this->hasOne(Student::Class, 'user_id', 'sender_id')->withDefault();
    }

	
	public function user()
    {
        return $this->hasOne('App\User', 'id', 'sender_id')->withDefault();
    }
	
	public function childrenAccounts()
	{
		return $this->hasMany(Question::class, 'parent_id', 'id');
	}

	public function allChildrenAccounts()
	{
		return $this->childrenAccounts()->with('allChildrenAccounts');
	}


}
