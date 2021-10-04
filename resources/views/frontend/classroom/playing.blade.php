@php  ob_start() @endphp
 
<div class="col-12">

    <!--Accordion wrapper-->
    <div class="accordion accordion-playing" id="accordionEx5" role="tablist"  aria-multiselectable="true">
        @if(!empty($videos[0]))
        @foreach($videos as $key => $video)
        @if($loadMore != 1 && $key == 0)
        <input  type="hidden" id="defaultPlay" value="{{$video->id}}">
        @endif
		<input  type="hidden" id="forNextPlay-{{$video->id}}" class="forNextPlay" value="{{$video->id}}">
        <input  type="hidden" id="video_url-{{$video->id}}" value="{{$video->videoURL()}}">
        <input  type="hidden" id="video-title-{{$video->id}}" value="{{$video->title}}">
        <input  type="hidden" id="video-teacher-{{$video->id}}" value="{{$video->tutor->fullname}}">
        <input  type="hidden" id="total-views-{{$video->id}}" value="{{$video->total_views != '' ? $video->total_views : 0 }} Views">
        <input  type="hidden" id="video-subject-{{$video->id}}" value="{!!$video->topic->subject->subject_name!!}">
        <input  type="hidden" id="video-topic-{{$video->id}}" value="{!!$video->topic->topic_name!!}">
        <!-- Accordion card -->
        <div id="cart-playing-{{$video->id}}" class="card mb-2 ">

            <!-- Card header -->
            <div class="card-header d-flex align-items-center "  role="tab" id="heading-{{$video->id}}">
                <div class="play-btn col px-0 flex-grow-0" id="play-btn-{{$video->id}}">
                    @if($video->video_watch_count > 0)
                    <i class="fas fa-eye " aria-hidden="true"></i>
                    @else
                    <i class="fas" aria-hidden="true"></i>  
                    @endif
                </div>			 
                <div class="col flex-grow-1" >
                    <h4 class="m-0">
                        <a href="javascript:void(0)" onclick="classroomObj.playVideo({{$video->id}})">

                            <span class="time-slot">		 
                                {{$video->Period->title}} >
                            </span>  
                            {!!$video->title!!}
                        </a>
                    </h4>
                </div>

                <div class="col flex-grow-0 ">
                    <div class="arrow">
                        <a data-toggle="collapse-{{$video->id}}" data-parent="#accordionEx5" href="javascript:void(0)" data-hrid="#collapse-{{$video->id}}"  aria-expanded="true"
                           aria-controls="collapse-{{$video->id}}"  data-lession_id="{{$video->id}}" onclick="classroomObj.playingAccordion(this)" data-class_id="{{$video->class_id}}">               
                            <span class="angle-span" id="angle-span-{{$video->id}}">
                                <i class="fas fa-angle-down" aria-hidden="true"></i>
                                <span>				
                                    </a>
                                    </div>		

                                    </div>

                                    </div>

                                    <!-- Card body -->
                                    <div id="collapse-{{$video->id}}" class="collapse collapse-js" role="tabpanel" aria-labelledby="heading-{{$video->id}}"
                                         data-parent="#accordionEx5">
                                        <div class="card-body">
                                            <p>{!!$video->description!!} </p>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- Accordion card -->

                                    @endforeach

                                    @else
                                    <div class="list-view-sec" style="text-align:center">
                                        <h5 class="text-info">No Record Available</h5> 
                                    </div>
                                    @endif

                                    </div>
                                    <!--/.Accordion wrapper-->

                                    </div>
    
 
 @php 
 $content = ob_get_contents();
 $result['resultHtml']  = $content;
 $result['tab']         = $tab;
 $result['loadMore']    = $loadMore;
 $result['videos']    = $videos;
 $result['page']        = $page+1;
 $result['totalRecord'] = $videos->total();
 $result['lastPage']    = $videos->lastPage();
 $result['to']          = $videos->lastItem();
 if($page >= $result['lastPage']){
     $result['show_morerecords'] = 0;
 }
 else {
    $result['show_morerecords'] = 1;
 }
 
 ob_end_clean();
 echo json_encode($result);
 @endphp 