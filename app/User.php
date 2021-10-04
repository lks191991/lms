<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Carbon\Carbon;
use \App\Models\Student;
use \App\Models\RoleUser;
use \App\Models\Tutor;
use Illuminate\Database\Eloquent\SoftDeletes;
use Emadadly\LaravelUuid\Uuids;

class User extends Authenticatable
{

    use Notifiable;

use HasApiTokens;

use Uuids;

use HasRoleAndPermission;

    const DEFAULT_USER_PROFILE = 'images/comment-author-3.png';

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'password', 'email'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
    ];
	
	public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    public static function adminlte_image()
    {
        return 'images/user.png';
    }

    public static function adminlte_desc()
    {
        return 'That\'s a nice guy';
    }

    public function student()
    {
        return $this->hasOne(Models\Student::class, 'user_id');
    }

    public function attachRole($role, $userId)
    {
        $obj = new RoleUser();

        $obj->role_id = $role->id;
        $obj->user_id = $userId;
        $obj->save();
    }

    public function userRole()
    {
        return $this->hasOne(Models\RoleUser::class, 'user_id', 'id');
    }

    public function insertStudent($user, $data)
    {
        $obj = new Student();
        $obj->user_id = $user->id;
        $obj->username = $data['username'];
        $obj->first_name = $data['first_name'];
        $obj->last_name = $data['last_name'];
        $obj->email = $data['email'];
        $obj->mobile = $data['mobile'];
        $obj->country = $data['phone_code'];
        $obj->save();
    }

    public function insertTutor($user, $data)
    {
        $obj = new Tutor();
        $obj->user_id = $user->id;
        $obj->first_name = $data['first_name'];
        $obj->last_name = $data['last_name'];
        $obj->email = $data['email'];
        $obj->mobile = $data['mobile'];
        $obj->avatar_id = 1;
        $obj->country = $data['phone_code'];
        $obj->save();
    }

    public function userData()
    {
        $slug = $this->userRole->role->slug;
        if ($slug == 'admin') {
            return $this->hasOne(User::class, 'id');
        } else if ($slug == 'subadmin') {
            return $this->hasOne(User::class, 'id');
        }
		else if ($slug == 'school') {
            return $this->hasOne(Models\SchoolManager::class, 'user_id');
        } else if ($slug == 'tutor') {
            return $this->hasOne(Models\Tutor::class, 'user_id');
        } else if ($slug == 'student') {
            return $this->hasOne(Models\Student::class, 'user_id');
        }
    }

    public function studentVideos()
    {

        return $this->hasMany(Models\StudentVideo::class, 'student_id');
    }

    public function getFullNameAttribute()
    {
        return "{$this->name}";
    }

    public function getRoleIdAttribute()
    {
        return $this->userRole->role_id;
    }

    /*
     * Get the backend theme style for the logged in user
     */
    public function getSchoolTheme()
    {
        $theme = config('constants.default_theme');
        $slug = $this->userRole->role->slug;

        if ($slug == 'school') {
            $schoolManager = $this->userData()->first();
            $school_theme = $schoolManager->school->theme;

            if (!empty($school_theme)) {
                $theme = $school_theme;
            }
        }

        return 'theme-' . $theme;
    }

    public function profile()
    {
        $slug = $this->userRole->role->slug;
        if ($slug == 'admin') {
            return $this->hasOne(User::class, 'id');
        } else if ($slug == 'school') {
            return $this->hasOne(Models\SchoolManager::class, 'user_id');
        } else if ($slug == 'tutor') {
            return $this->hasOne(Models\Tutor::class, 'user_id');
        } else if ($slug == 'student') {
            return $this->hasOne(Models\Student::class, 'user_id');
        }
    }

    public function hasAccessToSchool($school_id)
    {
        $slug = $this->userRole->role->slug;
        if ( in_array($slug, ['admin','subadmin']) ) {
            return true;
        } elseif ($slug == 'school') {
            $profile = $this->profile;
            if ($profile->school_id == $school_id) {
                return true;
            }
        }

        return false;
    }

    public function getCreatedProfileImageAttribute()
    {
        /* userData->created_profile_image */
        if (!empty($this->profile_image) && file_exists(public_path($this->profile_image))) {
            return $this->profile_image;
        } else {
            return User::DEFAULT_USER_PROFILE;
        }
    }

    public function getAvatarImageAttribute()
    {
        /* userData->avatar_image */
        $avatar = $this->avatar;

        if (!empty($avatar->file_url) && file_exists(public_path($avatar->file_url))) {
            return $avatar->file_url;
        } else {
            return User::DEFAULT_USER_PROFILE;
        }
    }

    public function getProfileOrAvatarImageAttribute()
    {
        /* userData->profile_or_avatar_image */
        if (!empty($this->profile_image) && file_exists(public_path($this->profile_image))) {
            return $this->profile_image;
        } else {
            return $this->getAvatarImageAttribute();
        }
    }

}
