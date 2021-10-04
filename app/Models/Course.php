<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Emadadly\LaravelUuid\Uuids;

class Course extends Model
{

    use Uuids;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /*
     * Get referenced record of school.
     */
    public function school()
    {
        return $this->belongsTo(School::Class, 'school_id')->withDefault();
    }
    /*
     * Get referenced record of school.
     */
    public function department()
    {
        return $this->belongsTo(Department::Class, 'department_id')->withDefault();
    }
    
    
    public function classroomList()
    {
        $query = $this->hasMany(Classroom::class, 'course_id')
                ->where('date', '<=', date('Y-m-d'));

        if (request()->get('school_id')) {
            $query = $query->where('school_id', '=', request()->get('school_id'));
        }
        if (request()->get('course_id')) {
            $query = $query->where('course_id', '=', request()->get('course_id'));
        }
        if (request()->get('class_id')) {
            $query = $query->where('class_id', '=', request()->get('class_id'));
        }

        return $query->whereHas('videos', function($query2) {
                            $query2->where('status', '=', 1);
                        })
                        ->orderBy('date', 'Desc');    }


    public function classroomCheck()
    {
        return $this->hasOne(Classroom::Class, 'school_id', 'id')->withDefault();
    }
    
    /*
     * Get all related classes.
     */
    public function classes()
    {
        return $this->hasMany(Classes::class, 'course_id');
    }
    
    /*
     * Get all related classes those have videos.
     */
    public function classesHasVideos()
    {
        return $this->hasMany(Classes::class, 'course_id')
                    ->whereHas('latestVideo');
    }
    
    /*
     * Get all related classes those have videos with key.
     */
    public function classesHasVideosWithKey()
    {
        return $this->hasMany(Classes::class, 'course_id')
                    ->whereHas('latestVideoWithKey');
    }
    
    /*
     * Get all related videos.
     */
    public function videos()
    {
        $query = $this->hasMany(Video::class, 'course_id');

        return $query;
    }
    
    /*
     * Get latest video from the list.
     */
    public function latestVideo()
    {
        $query = $this->videos()
                ->where('play_on', '<=', date('Y-m-d'))
                ->where('status', '=', 1)
                ->orderBy('play_on', 'Desc');

        return $query;
    }

    /*
     * Get latest video having a keyword from the list.
     */
    public function latestVideoWithKey()
    {
        $keyword = '';
        if (request()->get('search_input')) {
            $keyword = request()->get('search_input');
        }
        
        $query = $this->videos()
                ->where('play_on', '<=', date('Y-m-d'))
                ->where('status', '=', 1)
                ->orderBy('play_on', 'Desc');

        if($keyword !=''){
            $query = $query->where(function($qry) use ($keyword){
                    $qry->whereHas('subject', function ($query1) use ($keyword)
                            {
                                 $query1->where('subject_name', 'LIKE', '%'.$keyword.'%');
                            });
                    $qry->orWhereHas('topic', function ($query2) use ($keyword)
                            {
                                 $query2->where('topic_name', 'LIKE', '%'.$keyword.'%');
                            });
                    $qry->orWhereHas('school', function ($query3) use ($keyword)
                            {
                                 $query3->where('school_name', 'LIKE', '%'.$keyword.'%');
                            });
                    $qry->orWhereHas('course', function ($query4) use ($keyword)
                            {
                                 $query4->where('name', 'LIKE', '%'.$keyword.'%');
                            });
                });
        }
        
        $query = $query->whereHas('school', function ($query1) {
                             $query1->where('status', '=', 1);                             
                        })->whereHas('course', function ($query2) {
                             $query2->where('status', '=', 1);                             
                        })->whereHas('classDetail', function ($query3) {
                             $query3->where('status', '=', 1);                             
                        })->whereHas('subject', function ($query4) {
                             $query4->where('status', '=', 1);                             
                        })->whereHas('topic', function ($query5) {
                             $query5->where('status', '=', 1);                             
                        });
        
        return $query;
    }
    
}
