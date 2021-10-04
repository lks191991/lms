@php ob_start() @endphp

@if(!empty($tutorVideos[0]))
@foreach($tutorVideos as $tutorVideo)
<div class="item-row item-row-lectures history-row-count" id="history-row-{{$tutorVideo->id}}">
    <div class="row align-items-center align-items-xl-start">
        <div class="col flex-grow-0">
            <figure class="item-row-image"><img src="{{asset('/uploads/schools/'.$tutorVideo->school->logo)}}" alt=""></figure>
        </div>

        <div class="col flex-grow-1">
            <a href="{{route('frontend.classroom',$tutorVideo->classDetail->uuid)}}?video={{$tutorVideo->uuid}}" class="lecture-title">
                <h3 class="heading">
                    {!!$tutorVideo->title!!}
                </h3>
                <p class="heading-sub-text">{{$tutorVideo->sub_title}}</p>
            </a>
        </div>
        <div class="col-12 col-md flex-grow-1 flex-md-grow-0 mt-2 mt-md-0 d-flex align-items-center justify-content-center">               
            <div class="action-button mr-3 mr-xl-0">						
                <a href="javascript:void(0)" title="" class="btn-knowledge-link d-none">Knowledge link</a>
                @if($tutorVideo->tutor->upload_access > 0)
                <a href="javascript:void(0)" id="btn-lecture-id-{{$tutorVideo->id}}" onclick="tutorPost.addNotes({{$tutorVideo->id}})" title=""  class="btn-notes ml-3">Add notes</a>	@endif					 
            </div>


            <div class="text-right upload-time">
                <div class="d-flex align-items-center justify-content-end w-100">
                    @if($tutorVideo->article_id)
                    <span class="mr-2"><img src="{{asset('images/link-icon.png')}}" alt=""></span>
                    @endif
                    @if($tutorVideo->note_id)
                    <span><img src="{{asset('images/book-icon.png')}}" alt=""></span>
                    @endif
                </div>
                <small class="d-flex align-items-center justify-content-end w-100">{!!GLB::dayAgo($tutorVideo->created_at)!!} 




                </small> 
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
$result['totalRecord'] = $tutorVideos->total();
$result['lastPage']    = $tutorVideos->lastPage();
$result['to']          = $tutorVideos->lastItem();
if($page >= $result['lastPage']){
$result['show_morerecords'] = 0;
}
else {
$result['show_morerecords'] = 1;
}

ob_end_clean();
echo json_encode($result);
@endphp 