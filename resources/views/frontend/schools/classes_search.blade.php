@php ob_start() @endphp

@if($videos->total() > 0)
@foreach($videos as $video)

<div class="item-row"> 
    <div class="row">
            <div class="col flex-grow-0">
                <figure class="item-row-image"><img src="/uploads/schools/{{$video->school->logo}}" alt="{{$video->school->school_name}}"></figure>
            </div>
            <div class="col flex-grow-1 btn-group dropdown-toggle-custom">
                <div class="dropdown-toggle" data-toggle="dropdown" role="button">
		    <h3 class="heading">{{$video->getTitleAttribute()}}</h3>
                    <p class="heading-sub-text">{{$video->getSubTitleAttribute()}}</p>
				</div>    		
				
            </div>
            
            <div class="col-12 col-md flex-grow-1 flex-md-grow-0 mt-2 mt-md-0 ">				
                    <div class="action-button d-flex align-items-center justify-content-center justify-content-right">
                        <a href="{{route('frontend.classroom',$video->classDetail->uuid)}}?video={{$video->uuid}}" title="{{$video->subject->subject_name}}" class="btn-play">Join</a>
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
 $result['classes']     = $videos;
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