<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Video;
use Vimeo\Laravel\Facades\Vimeo;
use Illuminate\Support\Facades\Mail;

class VerifyVideoUpload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'video:verify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify uploaded videos are ready to play';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $videos = Video::where('vimeo_status','=','in_progress')->get();        
            
        if(!empty($videos)){
            
            $vimeo = Vimeo::Connection();
            
            foreach($videos as $video) {
                if($video->video_id) {
                    //get the transcode status of the video from Vimeo
                    $uri = '/videos/'.$video->video_id;
                    $video_data = $vimeo->request($uri . '?fields=transcode.status');
                    
                    if(isset($video_data['status']) && $video_data['status'] == 200){
                
                        if(isset($video_data['body']['transcode']['status']) ) {
                            //Set the transcode status of the video
                            $video->vimeo_status = $video_data['body']['transcode']['status'];
                            
                            if($video_data['body']['transcode']['status'] == 'complete') {
                                $video->status = 1;
                            }
                            
                            $video->save();                            

                            $data = array(
                                'name' => "XtraClass",
                                'status' => $video_data['body']['transcode']['status'],                                
                            );
                    
//                            Mail::send('emails.test', $data, function ($message) {
//                    
//                                $message->from('hemant.bansal@gmail.com');
//                    
//                                $message->to('hemant.bansal@dotsquares.com')->subject('Test Mail');
//                    
//                            });
                        }
                    }
                }
            }
        }        
        
    }
}
