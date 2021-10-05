<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Emadadly\LaravelUuid\Uuids;

class Classes extends Model
{

    use Uuids;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public $table = 'classes';
	
	 /*
     * Get referenced record.
     */
    public function school_details($school_id)
    {
       $school_details = School::find($school_id);
	   if(isset($school_details->school_name) && !empty($school_details->school_name)) {
			return $school_details->school_name;
	   } else {
			return '';
	   }
    }
	
	/*
     * Get referenced record.
     */
    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id', 'id');
    }
    
    
    
    /*
     * Get all related subjects.
     */
    public function subject()
    {
        return $this->hasMany(Subject::Class, 'class_id')->orderBy('id', 'desc');
    }
    
    /*
     * Get all related videos.
     */
    public function videos()
    {
        $query = $this->hasMany(Video::class, 'class_id');

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
                        ->orderBy('date', 'Desc');
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
