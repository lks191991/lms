<?php
namespace App\Helpers;

use DateTime;
use App\User;
use App\Models\StudentHistory;
use App\Models\Video;
use App\Models\Classes;
use Auth;
use Session;

class GlobleHelper
{
    public static function schoolLogo($data)
    {
        if (!empty($data->course->school->logo) && file_exists(public_path('uploads/schools/' . $data->course->school->logo))) {
            $img = $data->course->school->logo;
            $alt = $data->course->school->title;
            $imgUrl = asset('uploads/schools/' . $img);
        } else {
            $img = "school-default.png";
            $alt = $data->course->school->title;
            $imgUrl = asset('images/' . $img);
        }
        $logo = '<img src="' . $imgUrl . '" alt="' . $alt . '">';


        return $logo;
    }

    public static function courseLogo($data)
    {
        if (!empty($data->course->school->logo) && file_exists(public_path('uploads/schools/' . $data->course->school->logo))) {
            $img = $data->course->school->logo;
            $alt = $data->course->school->title;
            $imgUrl = asset('uploads/schools/' . $img);
        } else {
            $img = "school-default.png";
            $alt = $data->course->school->title;
            $imgUrl = asset('images/' . $img);
        }
        $logo = '<img src="' . $imgUrl . '" alt="' . $alt . '">';


        return $logo;
    }

    public static function classlLogo($data)
    {
        if (!empty($data->course->school->logo) && file_exists(public_path('uploads/schools/' . $data->course->school->logo))) {
            $img = $data->course->school->logo;
            $alt = $data->course->school->title;
            $imgUrl = asset('uploads/schools/' . $img);
        } else {
            $img = "school-default.png";
            $alt = $data->course->school->title;
            $imgUrl = asset('images/' . $img);
        }
        $logo = '<img src="' . $imgUrl . '" alt="' . $alt . '">';


        return $logo;
    }

    public static function dayAgo($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full)
            $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    public static function paginate()
    {
        return 15;
    }

    public static function printQusData($questions)
    {

        foreach ($questions as $question) {

            if ($question->type == 'question') {
                ?>
                <div class="card card-comments ">
                    <div class="comments-author-image left-position"><img src="<?php echo asset($question->user->userData->profile_or_avatar_image); ?>" alt=""></div>
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="card-title"><i class="far fa-clock"></i><?php echo self::dayAgo($question->created_at); ?> by  <?php echo $question->user->userData->fullname; ?></h3>
                            </div>	
                            <div class="flex-grow-0 ml-2">
                                <a href="javascript:void(0)" class="btn-reply" onclick="classroomObj.replyBox(<?php echo $question->id; ?>, 'reply', 'question')"><img src="<?php echo asset('images/reply-icon.png'); ?>" alt=""> Reply</a>						
                            </div>
                        </div>	
                    </div>
                    <div class="card-body">
                <?php echo $question->content; ?>
                    </div>
                </div>
                <div class="replyBoxClass" id="reply-box-id-<?php echo $question->id; ?>"></div>
            <?php } else if ($question->type == 'reply') { ?>
                <div class="card card-comments  bg-secondary card-comment-margin">
                    <div class="comments-author-image left-position"><img src="<?php echo asset($question->user->userData->profile_or_avatar_image); ?>" alt=""></div>
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="card-title"><i class="far fa-clock"></i><?php echo self::dayAgo($question->created_at); ?> by <?php echo $question->user->userData->fullname; ?></h3>
                            </div>	
                            <div class="flex-grow-0 ml-2">
                                <a href="javascript:void(0)" class="btn-reply" onclick="classroomObj.replyBox(<?php echo $question->id; ?>, 'reply', 'reply')"><img src="<?php echo asset('images/reply-icon.png'); ?>" alt=""> Reply</a>					
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                <?php echo $question->content; ?>
                    </div>



                </div>

                <div class="replyBoxClass" id="reply-box-id-<?php echo $question->id; ?>"></div>

                <?php
            }


            if (!empty($question->childrenAccounts)) {
                self::printQusData($question->childrenAccounts);
            }
        }
    }
	public static function continueVideo(){
		
		$video_id = 0;
		if(!empty(session('continue_video_id'))){ 
			
			 $video_id = session('continue_video_id');
		}else if(Auth::check()){
			$studentHistory = StudentHistory::where('student_id',Auth::user()->id)->orderBy('id','desc')->first();
			if(!empty($studentHistory->video_id)){
				$video_id = $studentHistory->video_id;
			}
		}
		
		if(!empty($video_id)){
			$video = Video::where('id', $video_id)->where('status', 1)->first();
            $class    = Classes::where('id', $video->class_id)->where([
                        'status' => 1
                    ])->first();
			return route('frontend.classroom',$class->uuid).'?video='.$video->uuid;
		}else{
			return '';
		}
		
	}
	

}
