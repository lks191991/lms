@php ob_start() @endphp
     
    @if(!empty($studentFavorites[0]))
		@foreach($studentFavorites as $studentFavorite)
	      <div class="item-row history-row-count" id="history-row-{{$studentFavorite->id}}">
	  	<div class="row">
		  	<div class="col flex-grow-0">
				<figure class="item-row-image"><img src="{{asset('images/class-logo.png')}}" alt=""></figure>
			</div>
			<div class="col flex-grow-1">
				<h3 class="heading">{{$studentFavorite->lession->classroom->course->school->title}}</h3>
				<p class="heading-sub-text">{{$studentFavorite->lession->title}}</p>
			</div>
			<div class="col  flex-grow-0 mt-2 mt-md-0 ">				
				<div class="action-button d-flex align-items-center">
					<a href="{{route('frontend.classroom',$studentFavorite->lession->class_id)}}?active=playing&video={{$studentFavorite->source_id}}" title="" class="btn-play">Watch</a>
					<a href="javascript:void(0)" id="btn-rm-history-{{$studentFavorite->id}}" onclick="studentObj.removeStudentHistory({{$studentFavorite->id}})" title=""  class="btn-remove ml-3">Remove</a>
				</div>	
			</div>
		  </div>
		  </div>
	@endforeach
	@else
		 <div class="list-view-sec" style="text-align:center">
			 <h1>No Record Available</h1> 
		 </div>
	@endif
       
 
 @php 
 $content = ob_get_contents();
 $result['resultHtml']  = $content;
 $result['tab']         = $tab;
 $result['loadMore']    = $loadMore;
 $result['page']        = $page+1;
 $result['totalRecord'] = $studentFavorites->total();
 $result['lastPage']    = $studentFavorites->lastPage();
 $result['to']          = $studentFavorites->lastItem();
 if($page >= $result['lastPage']){
     $result['show_morerecords'] = 0;
 }
 else {
    $result['show_morerecords'] = 1;
 }
 
 ob_end_clean();
 echo json_encode($result);
 @endphp 