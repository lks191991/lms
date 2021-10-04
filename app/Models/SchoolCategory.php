<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Emadadly\LaravelUuid\Uuids;

class SchoolCategory extends Model
{

    use SoftDeletes;

    use Uuids;

    protected $dates = ['deleted_at'];

}
