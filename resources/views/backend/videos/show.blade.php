@extends('backend.layouts.layout-2')

@section('styles')
<link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css" />
<style>
    #video_player_box{
        --plyr-video-controls-background: linear-gradient(rgba(255, 255, 255, 0.8),rgba(220, 220, 220, 0.8)) ;
        --plyr-video-control-color: #333333; 
        height: 250px;
    }
    .plyr--video .plyr__controls{
        padding-top: 15px !important;
    }
</style>
@endsection
@section('scripts')
<script type="text/javascript">
    $(function () {
        $('#reported-user-list').dataTable( {
            "order": [[ 1, "asc" ]],
            "columns": [
              null,
              null,
              { "orderable": false },
			  null
            ]} );
    });
</script>

<script src="https://cdn.plyr.io/3.6.2/plyr.js"></script>
<script>
    const player = new Plyr('#video_player_box',{
        settings: ['captions', 'quality', 'speed', 'loop'],        
      });
      
      player.on('ended', event => {
        player.restart();
      });
</script>
@endsection

@section('content')
<h4 class="font-weight-bold py-3 mb-4">
    <span class="text-muted font-weight-light">Videos /</span> Video Details
</h4>

<div class="card mb-4">   
    
    <h6 class="card-header">
        {{$video->getTitleAttribute()}}

		<a href="javascript:void(0)" onclick="window.history.go(-1); return false;" class="btn btn-primary rounded-pill d-block detail-back-btn">Back</a>

    </h6>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6 col-xl-7">
			<div class="row">
                    <div class="col-sm-6 col-xl-3 mb-2"><strong>Vedio Type</strong></div>
                    <div class="col-sm-6 col-xl-9">{{$video->video_upload_type}}</div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-xl-3 mb-2"><strong>Subject</strong></div>
                    <div class="col-sm-6 col-xl-9">{{$video->topic->subject->subject_name}}</div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-xl-3 mb-2"><strong>Topic</strong></div>
                    <div class="col-sm-6 col-xl-9">{{$video->topic->topic_name}}</div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-xl-3 mb-2"><strong>Date</strong></div>
                    <div class="col-sm-6 col-xl-9">{{$video->playOn()}} </div>
                </div>
                
               
                <div class="row">
                    <div class="col-sm-6 col-xl-3 mb-2"><strong>Class</strong></div>
                    <div class="col-sm-6 col-xl-9">{{$video->classDetail->class_name}}</div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6 col-xl-3 mb-2">
                        <strong>
                           @if($video->school->school_category == config('constants.UNIVERSITY')) Program @else Course @endif
                        </strong>
                    </div>
                    <div class="col-sm-6 col-xl-9">{{$video->course->name}}</div>
                </div>
                           
                
                <div class="row">
                    <div class="col-sm-6 col-xl-3 mb-2"><strong>School Name</strong></div>
                    <div class="col-sm-6 col-xl-9">
                      
                        {{$video->school->school_name}} <small>({{$video->school->category->name}})</small>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6 col-xl-3 mb-2"><strong>Tutor</strong></div>
                    <div class="col-sm-6 col-xl-9">{{$video->tutor->fullname}}</div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-xl-3 mb-2"><strong>Description</strong></div>
                    <div class="col-sm-6 col-xl-9">{{$video->description}}</div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6 col-xl-3 mb-2"><strong>Keywords</strong></div>
                    <div class="col-sm-6 col-xl-9">{{$video->keywords}}</div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6 col-xl-3 mb-2"><strong>Note</strong></div>
                    <div class="col-sm-6 col-xl-9">
                        @if(!empty($video->noteURL()))
                        <a target="_blank" href="{{$video->noteURL()}}">Download Note </a>
                        @endif
                    </div>
                </div>
                
                
            </div>
            
            <div class="col-sm-6 col-xl-5 text-center">
                <div class="lesson-video" id="video_player_box">
                    <iframe class="bg-dark" src="{{$video->video_url}}?byline=false" id="videoPlayer" width="100%" height="250" frameborder="0" allow="autoplay; fullscreen"  allowfullscreen></iframe>
                </div>
                @if($video->video_type == 'file')
                <a class="btn btn-primary my-4 align-center" href="{{route('backend.video.upload.files',$video->uuid)}}" ><i class="fas fa-upload"></i> <span>Upload New Video file</span></a>
                @endif
            </div>
        </div>		
    </div>
</div>

@endsection