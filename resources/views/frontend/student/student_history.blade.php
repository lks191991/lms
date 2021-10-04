@php ob_start() @endphp
     
    @if(!empty($studentHistories[0]))
		@foreach($studentHistories as $studentHistory)
	      <div class="item-row history-row-count" id="history-row-{{$studentHistory->id}}">
	  	<div class="row">
		  	<div class="col flex-grow-0">
				<figure class="item-row-image">
				
				<img src="{{asset($studentHistory->video->school->school_logo)}}" alt="">
				</figure>
			</div> 
			
			<div class="col flex-grow-1">
				<h3 class="heading">{!!$studentHistory->video->title!!}</h3>
				<p class="heading-sub-text">{{$studentHistory->video->sub_title}}</p>
			</div>
			<div class="col  flex-grow-0 mt-2 mt-md-0 ">				
				<div class="action-button d-flex align-items-center">
					<a href="{{route('frontend.classroom',$studentHistory->video->classDetail->uuid)}}?video={{$studentHistory->video->uuid}}" title="" class="btn-play">Watch</a>
					<a href="javascript:void(0)" id="btn-rm-history-{{$studentHistory->id}}" onclick="studentObj.removeStudentHistory({{$studentHistory->id}},'history')" title=""  class="btn-remove ml-3">Remove</a>
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
 $result['totalRecord'] = $studentHistories->total();
 $result['lastPage']    = $studentHistories->lastPage();
 $result['to']          = $studentHistories->lastItem();
 if($page >= $result['lastPage']){
     $result['show_morerecords'] = 0;
 }
 else {
    $result['show_morerecords'] = 1;
 }
 
 ob_end_clean();
 echo json_encode($result);
 @endphp 