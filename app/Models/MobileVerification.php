<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MobileVerification extends Model
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
    protected $fillable = [
        'phone_code', 'mobile', 'status'
    ];
}
