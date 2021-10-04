<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Emadadly\LaravelUuid\Uuids;

class Student extends Model
{

    use Uuids;
	
	use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['mobile', 'phone_code', 'otp'];

    /* Bellow array set for required profile fields */

    protected $profileField = [
        'first_name',
        'last_name',
        'contact_email',
        'telephone',
        'mobile',
        'image',
        'school',
        'course'
    ];
	
	public function category()
    {
        return $this->hasOne(SchoolCategory::Class, 'id', 'school_category')->withDefault();
    }

    public function school()
    {
        return $this->hasOne(School::Class, 'id', 'school_id')->withDefault();
    }
	
	public function user_details()
    {
        return $this->hasOne(User::Class, 'id', 'user_id')->withDefault();
    }
	
	public function country_name()
    {
        return $this->hasOne(Countries::Class, 'phonecode', 'country')->withDefault();
    }
	
	public function course()
    {
        return $this->hasOne(Course::Class, 'id', 'course_id')->withDefault();
    }
	
	public function student_class()
    {
        return $this->hasOne(Classes::Class, 'id', 'class_id')->withDefault();
    }

	public function profilePercentage($userId){
		$count = 0;
		
		$data = $this->where('user_id', $userId)->first()->toArray();
		
		foreach($this->profileField as $field){
			if(array_key_exists($field, $data) && !empty($data[$field]))
				$count++;
		}
		
		$percent = ($count / count($this->profileField)) * 100;
		return $percent;
	}
	
	public function favSchools(){
		return $this->belongsToMany(School::class, 'student_favourites', 'student_id', 'student_id');
	}
	
	public function favCourses(){
		return $this->belongsToMany(Course::class, 'student_favourites', 'student_id', 'student_id');
	}
	
	public function videos(){
		return $this->belongsToMany(Video::class, 'student_favourites');
	}

	public function avatar(){
		return $this->belongsTo(Avatar::class,'avatar_id','id')->where('status',1)->withDefault();
	}
	
	/**
	 * Get the user's full name.
	 *
	 * @return string
	 */
	public function getFullNameAttribute()
	{
		return "{$this->first_name} {$this->last_name}";
	}

	public function getCreatedProfileImageAttribute()
	{
		/* userData->created_profile_image */
		if(!empty($this->profile_image) && file_exists(public_path($this->profile_image))){
			return $this->profile_image;
		}else{
			return User::DEFAULT_USER_PROFILE;
		}
	}
	public function getAvatarImageAttribute()
	{	
		/* userData->avatar_image */
		$avatar =  $this->avatar;
		
		if(!empty($avatar->file_url) && file_exists(public_path($avatar->file_url))){
			return $avatar->file_url; 
		}else{
			return User::DEFAULT_USER_PROFILE;
		}
	}
	public function getProfileOrAvatarImageAttribute()
	{	
		/* userData->profile_or_avatar_image */
		if(!empty($this->profile_image) && file_exists(public_path($this->profile_image))){
			return $this->profile_image;
		}else{
			return $this->getAvatarImageAttribute();
		}
	}

}
