<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Emadadly\LaravelUuid\Uuids;
use App\User;

class Tutor extends Model
{
	use Uuids;
	
	use SoftDeletes;

    protected $dates = ['deleted_at'];

     /* Bellow array set for required profile fields */

    protected $profileField = [
        'first_name',
        'last_name',
        'mobile',
        'profile_image',
        'tutor_subject',
        'school_id'
       
    ];

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
	
	public function category_details($category_id)
    {
       $cat_details = SchoolCategory::find($category_id);
	   if(isset($cat_details->name) && !empty($cat_details->name)) {
			return $cat_details->name;
	   } else {
			return '';
	   }
    }

    public function school()
    {
        return $this->hasOne(School::Class, 'id', 'school_id')->withDefault();
    }
	
	public function user_details()
    {
        return $this->hasOne(User::Class, 'id', 'user_id')->withDefault();
    }
	
	public function tutorVideos()
    {
		return $this->hasMany(Video::class, 'tutor_id', 'user_id');
    }
	
	public function country_name()
    {
        return $this->hasOne(Countries::Class, 'phonecode', 'country')->withDefault();
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
		}
		else{
			return $this->getAvatarImageAttribute();
		}
	}

}
