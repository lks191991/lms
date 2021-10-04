<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
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
    protected $fillable = ['role_id', 'user_id'];
	
	protected $table = 'role_user';

	public function role(){
		return $this->hasOne(Role::class,'id','role_id')->withDefault();
	}
}
