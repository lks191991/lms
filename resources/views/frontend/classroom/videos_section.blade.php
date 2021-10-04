<section class="content-top-wrapper bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="lesson-video" id="video_player_box">
                    <iframe class="bg-dark" src="{{$defaultVideo->videoURL()}}?&autoplay=1" id="videoPlayer" width="" height="" frameborder="0" allow="autoplay; fullscreen"  allowfullscreen></iframe>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="lesson-card">
                    <div class="lesson-logo">
                        <figure>
                            {!!GLB::classlLogo($classroom)!!}
                        </figure>
                    </div>
                    <h2 class="lesson-title">{{$classroom->class_name}} @if(config('constants.BASIC_SCHOOL') != $classroom->course->school->school_category) ({{$classroom->course->name}}) @endif</h2>
                    <ul class="lesson-info">
                        <li>
                            <span class="icon"> <i class="fas fa-map-marker-alt"></i></span>
                            <span class="text">{{$classroom->course->school->school_name}}</span>
                        </li>
                        <li>
                            <span class="icon"><i class="fas fa-user"></i></span>
                            <span class="text" id="totalView">{{($defaultVideo->total_views != '' ? $defaultVideo->total_views : 0)}} Views</span>
                        </li>
                    </ul>
                    <div class="lesson-topic d-none">
                        <span>Showing ></span>  <text id="videoShowing"> </text>
                    </div>
                    <ul class="lesson-detail">                        
                        <li>Subject: <text id="videoSubject">{!!$defaultVideo->topic->subject->subject_name!!}</text></li>
                        <li>Topic: <text id="videoTopic">{!!$defaultVideo->topic->topic_name!!}</text></li>
                        <li>Tutor: <text id="videoTeacher">{{$defaultVideo->tutor->fullname}}</text> </li>
                        <li>
                            <span class="font-italic"><i class="fas fa-calendar-alt text-info"></i> {{$defaultVideo->playOn('d M, Y')}}</span>
                        </li>
                        
                    </ul>

                    <div class="action-button video-action-button" id="videoAction" >


                        @if($lern_more)
                         <div class="pb-2 learn-more"> <a target="_blank" href="{{$lern_more}}" >Learn more</a>  </div>
                        @endif
                        @if($notes_id)
                         <button class="btn-custom" id="notesBtnId" title="Download note" onclick="classroomObj.downloadNotes({{$notes_id}})"><span class="icon"><i class="fas fa-book"></i></span>Get notes</button> <input type="hidden" value="{{$note_url}}" id="donloadNoteInput"/>
                         @endif

                        <span id="favBtnHtm"><button class="btn-custom fav-btn" title="Add favourite" id="favBtnId" onclick="classroomObj.setFavourites({{$defaultVideo->id}},{{$fav_status}})"><span class="icon {{ ( $fav_status ? 'fav-active' : '')}}"><i class="fas fa-star"></i></span></button></span>

                        <span id="spamBtnHtm"><button class="report-btn-custom fav-btn" title="Report this video" id="spamBtnId" onclick="classroomObj.openFlegPopup({{$defaultVideo->id}},{{$fleg_status}})"><span class="icon {{ ( $fleg_status ? 'fav-active' : '')}}"><i class="fas fa-flag"></i></span></button></span>

                    </div>

                </div>
            </div>
        </div>	
    </div>
</section>	