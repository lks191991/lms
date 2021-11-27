<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use SiteHelpers;

class Video extends Model
{

    use Uuids;

    use SoftDeletes;
    
    /*
     * Get referenced record of class.
     */
    public function classDetail()
    {
        return $this->belongsTo(Classes::Class, 'class_id')->withDefault();
    }

    /*
     * Get referenced record of school.
     */
    public function school()
    {
        return $this->belongsTo(School::Class, 'school_id')->withDefault();
    }
    
    /*
     * Get referenced record of course.
     */
    public function course()
    {
        return $this->belongsTo(Course::Class, 'course_id')->withDefault();
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::Class, 'classroom_id')->withDefault();
    }
    
    /*
     * Get referenced record of subject.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::Class, 'subject_id')->withDefault();
    }
    
    /*
     * Get referenced record of topic.
     */
    public function topic()
    {
        return $this->belongsTo(Topic::Class, 'topic_id')->withDefault();
    }
    
   
    /*
     * Get referenced record of tutor.
     */
    public function tutor()
    {
        return $this->belongsTo(Tutor::Class, 'tutor_id','user_id')->withDefault();
    }

    /*
     * Get referenced record from student favourite.
     */
    public function studentFavourite()
    {
        return $this->belongsTo(StudentFavourites::Class, 'video_id', 'id');
    }

    /*
     * Get referenced record of note.
     */
    public function note()
    {
        return $this->belongsTo(Note::Class, 'note_id');
    }

    /*
     * Get Title for a video from it's subject and topic name.
     */
    public function getTitleAttribute()
    {

        return "{$this->subject->subject_name} - {$this->topic->topic_name}";
    }

    /*
     * Get Sub-Title for a video from it's subject and topic name.
     */
    public function getSubTitleAttribute()
    {

        return "{$this->school->school_name} - {$this->course->name}";
    }
    
    /*
     * Get formated date from Play-On field.
     */
    public function playOn($format = 'd-m-Y')
    {
        return date($format, strtotime($this->play_on));
    }
    
    /*
     * Get formated video URL.
     */
    public function videoURL()
    {
        return 'https://player.vimeo.com/video/' . $this->video_id;
    }
    
    
    /*
     * Get formated note URL.
     */
    public function noteURL()
    {
        if(isset($this->note->file_url) && !empty($this->note->file_url)){
            $file_url = $this->note->file_url;
            if($this->note->storage == 's3') {
                $storage = 's3';
            } else {
                $storage = 'public';
            }  
            
            if(Storage::disk($storage)->exists($file_url)){
                $url = Storage::disk($storage)->url($file_url);
                
                return $url;
            }
        }
        
        return '';      
    }
    
    /*
     * Get size of note file.
     */
    public function noteFileSize()
    {
        if(isset($this->note->file_url) && !empty($this->note->file_url)){
            $file_url = $this->note->file_url;
            
            if($this->note->storage == 's3') {
                $storage = 's3';
            } else {
                $storage = 'public';
            }
            
            if(Storage::disk($storage)->exists($file_url)){
                $size = Storage::disk($storage)->size($file_url);
                
                return $size;
            } 
        }
        
        return 0;      
    }
    
    /*
     * Get size of note file.
     */
    public function noteFileName()
    {
        if(isset($this->note->file_url) && !empty($this->note->file_url)){           
            
            return basename($this->note->file_url);
        }
        
        return '';      
    }
    
    /**
     * Gets a vimeo thumbnail url
     * @param mixed $id A vimeo id (ie. 1185346)
     * @return thumbnail's url
     */
    function getVimeoThumb() {
        $id = $this->video_id;
        if($id){            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://vimeo.com/api/v2/video/$id.php");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $response = curl_exec($ch);
            
            if(curl_errno($ch)){
                curl_close($ch);
                return '';
            } else {
                $output = @unserialize($response);
                $data = $output[0];                
                if(isset($data['thumbnail_medium'])){
                    return $data['thumbnail_medium'];
                }
                curl_close($ch);
            }
        }
       
        return '';
    }
	
}
