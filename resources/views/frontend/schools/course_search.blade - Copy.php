@php ob_start() @endphp

@if($courses->total() > 0)
@foreach($courses as $course)

<div class="item-row">
    <div class="row">
        <div class="col flex-grow-0">
            <figure class="item-row-image"><img src="/uploads/schools/{{$course->school->logo}}" alt="{{$course->school->school_name}}"></figure>
        </div>
        <div class="col flex-grow-1 btn-group dropdown-toggle-custom">
            <div class="col dropdown-toggle" data-toggle="dropdown" role="button">
                <h3 class="heading">{{$course->name}}</h3>
                <p class="heading-sub-text">{{$course->school->school_name}}</p>
            </div> 
            
            @if(!empty($course->classesHasVideosWithKey))
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                @foreach($course->classesHasVideosWithKey as $class)
                @php
                $video = $class->latestVideoWithKey->first();
                @endphp
                <li><a class="dropdown-item" href="{{route('frontend.classroom',$class->uuid)}}?video={{$video->uuid}}">{{$class->class_name}}</a></li>                        
                @endforeach
            </ul>
            @endif
            
        </div>
        <div class="col  flex-grow-0 mt-2 mt-md-0 ">				
            <div class="action-button d-flex align-items-center">
                <a href="javascript:void(0);" title="" class="btn-play">Join</a>
            </div>	
        </div>
    </div>
</div>

@endforeach
@else
<div class="list-view-sec" style="text-align:center">
    <h5 class="text-info">No Record Available</h5> 
</div>
@endif

@php 
$content = ob_get_contents();
$result['resultHtml']  = $content;
$result['tab']         = $tab;
$result['loadMore']    = $loadMore;
$result['page']        = $page+1;
$result['totalRecord'] = $courses->total();
$result['lastPage']    = $courses->lastPage();
$result['to']          = $courses->lastItem();
if($page >= $result['lastPage']){
$result['show_morerecords'] = 0;
}
else {
$result['show_morerecords'] = 1;
}  

ob_end_clean();
echo json_encode($result);
@endphp 