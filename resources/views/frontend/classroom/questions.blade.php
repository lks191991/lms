@php ob_start() @endphp
 
    @if(!empty($questions[0]))
		
	
	
		@php GLB::printQusData($questions); @endphp
	
		
	
	@else
		 <div class="list-view-sec" style="padding:10px; text-align:center">
                     <p class="text-info"><i class="fas fa-comment-slash"></i> Be the first person to ask question</p> 
		 </div>
	@endif
         
      
 
 @php 
 $content = ob_get_contents();
 $result['resultHtml']  = $content;
 $result['tab']         = $tab;
 $result['questions']    = $questions;
 $result['loadMore']    = $loadMore;
 $result['page']        = $page+1;
 $result['totalRecord'] = $questions->total();
 $result['lastPage']    = $questions->lastPage();
 $result['to']          = $questions->lastItem();
 if($page >= $result['lastPage']){
     $result['show_morerecords'] = 0;
 }
 else {
    $result['show_morerecords'] = 1;
 }  
 
 ob_end_clean();
 echo json_encode($result);
 @endphp 