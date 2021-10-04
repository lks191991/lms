<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class KnowledgeTarget extends Model
{

    use Uuids;

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public $table = 'knowledge_targets';

}
