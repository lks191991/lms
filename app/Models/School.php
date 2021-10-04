<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Emadadly\LaravelUuid\Uuids;

class School extends Model
{
    use Uuids;


    use SoftDeletes;

    protected $dates = ['deleted_at'];    

    /**
     * Change school name title to name.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return "{$this->title}";
    }

    public function coursesList()
    {
        return $this->hasMany(Course::class, 'school_id');
    }

    /*
     * Get only those related courses which have video to play.
     */
    public function coursesHasVideo()
    {
        return $this->hasMany(Course::class, 'school_id')
                        ->whereHas('latestVideo');
    }

    
    /*
     * Get only those related courses which have video to play with a key.
     */
    public function coursesHasVideoWithKey()
    {
        return $this->hasMany(Course::class, 'school_id')
                        ->whereHas('latestVideoWithKey');
    }
    
    /*
     * Get referenced record of category.
     */
    public function category()
    {
        return $this->belongsTo('App\Models\SchoolCategory', 'school_category', 'id');
    }

   
    /*
     * Get all related videos.
     */
    public function videos()
    {
        $query = $this->hasMany(Video::class, 'school_id');

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
