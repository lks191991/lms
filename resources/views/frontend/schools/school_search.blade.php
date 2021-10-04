@php ob_start() @endphp

@if($schools->total() > 0)
@foreach($schools as $school)

<div class="col-sm-6 col-md-4 col-xl-3">
    <div class="school-card btn-group dropdown-toggle-custom">
        @php
        $coursesHasVideo = $school->coursesHasVideoWithKey;
        @endphp
        <a href="javascript:void(0)" title="" class="school-card-link dropdown-toggle" data-toggle="dropdown" role="button" >
            @if($school->is_locked)
            <div class="school-lock">
                <img src="/images/lock-icon.png" alt="lock">
            </div>
            @endif
            <figure class="school-logo">
                <img src="/uploads/schools/{{$school->logo}}" class="img-fluid" alt="{{ $school->school_name }}">
            </figure>
            <h3 class="school-name">{{ $school->school_name }}</h3>
           @if($school->school_category == config('constants.BASIC_SCHOOL'))
            @php
            $course = $coursesHasVideo[0];
            @endphp
            <p class="school-course-qty">{{$school->coursesLabel($course->classesHasVideosWithKey->count())}} </p>
           @else 
            <p class="school-course-qty">{{$school->coursesLabel($coursesHasVideo->count())}} </p> 
           @endif
        </a>
        @if(!empty($coursesHasVideo[0]))
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
            
            
                @if(!empty($coursesHasVideo)) 
                    @if($school->school_category == config('constants.BASIC_SCHOOL'))
                        @php
                        $course = $coursesHasVideo[0];
                        @endphp
                        @foreach($course->classesHasVideosWithKey as $class)
                        @php
                        $video = $class->latestVideoWithKey->first();
                        @endphp
                        <li><a class="dropdown-item" tabindex="-1" href="{{route('frontend.classroom',$class->uuid)}}?video={{$video->uuid}}">{{$class->class_name}}</a></li>                        
                        @endforeach
                    @else                    
                        @foreach($coursesHasVideo as $course)  
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" href="javascript:void(0)">
                                {{$course->name}}
                            </a>                
                            <ul class="dropdown-menu">
                                @foreach($course->classesHasVideosWithKey as $class)
                                @php
                                $video = $class->latestVideoWithKey->first();
                                @endphp
                                <li><a class="dropdown-item" tabindex="-1" href="{{route('frontend.classroom',$class->uuid)}}?video={{$video->uuid}}">{{$class->class_name}}</a></li>                        
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    @endif                
                @endif

        </ul>
        @endif
                        <!--<script>
                        $(".btn-group, .dropdown").hover(		
          function () {
              $('>.dropdown-menu', this).stop(true, true).fadeIn("fast");
              $(this).addClass('open');
          },
          function () {
              $('>.dropdown-menu', this).stop(true, true).fadeOut("fast");
              $(this).removeClass('open');
          });
                        </script>-->
    </div>
</div>
@endforeach
@else
<div class="list-view-sec" style="padding-left:35%; text-align:center">
    <h5 class="text-info">No Record Available</h5> 
</div>
@endif	


@php 
$content = ob_get_contents();
$result['resultHtml']  = $content;
$result['tab']         = $tab;
$result['loadMore']    = $loadMore;
$result['page']        = $page+1;
$result['totalRecord'] = $schools->total();
$result['lastPage']    = $schools->lastPage();
$result['to']          = $schools->lastItem();
if($page >= $result['lastPage']){
$result['show_morerecords'] = 0;
}
else {
$result['show_morerecords'] = 1;
}  

ob_end_clean();
echo json_encode($result);
@endphp 