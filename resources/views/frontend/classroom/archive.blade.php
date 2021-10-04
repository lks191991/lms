@php ob_start() @endphp
 
      <div class="col-12">

        <!--Accordion wrapper-->
        

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