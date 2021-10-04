@php ob_start() @endphp
     
    @if(empty($tutorPosts[0]))
	<!--- your code start--->	

<div>
<div class="row">
			<div class="col-sm-6 col-lg-4">
				<div class="Knowledge-card">
					<div class="Knowledge-card-image">
						<a href="#" title=""><img src="images/knowledge-image-1.jpg" alt="" class="img-fluid"></a>
					</div>
					<div class="Knowledge-card-body">
						<h3><a href="#" title="History: Slave trade in Ghana">History: Slave trade in Ghana</a></h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
					</div>
					<div class="Knowledge-card-footer">
						<p>by <a href="#">Kofi Omane</a></p>
						<p>12/12/2020</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-4">
				<div class="Knowledge-card">
					<div class="Knowledge-card-image">
						<a href="#" title=""><img src="images/knowledge-image-2.jpg" alt="" class="img-fluid"></a>
					</div>
					<div class="Knowledge-card-body">
						<h3><a href="#" title="Tradition: Values & Ethics in our tradions">Tradition: Values & Ethics in our tradions</a></h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
					</div>
					<div class="Knowledge-card-footer">
						<p>by <a href="#">Teacher Ama</a></p>
						<p>12/12/2020</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-4">
				<div class="Knowledge-card">
					<div class="Knowledge-card-image">
						<a href="#" title=""><img src="images/knowledge-image-3.jpg" alt="" class="img-fluid"></a>
					</div>
					<div class="Knowledge-card-body">
						<h3><a href="#" title="Animal Science: Predators & preys">Animal Science: Predators & preys</a></h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
					</div>
					<div class="Knowledge-card-footer">
						<p>by <a href="#">Kofi Baboni</a></p>
						<p>12/12/2020</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-4">
				<div class="Knowledge-card">
					<div class="Knowledge-card-image">
						<a href="#" title=""><img src="images/knowledge-image-4.jpg" alt="" class="img-fluid"></a>
					</div>
					<div class="Knowledge-card-body">
						<h3><a href="#" title="Geography: Discover Ghana">Geography: Discover Ghana</a></h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
					</div>
					<div class="Knowledge-card-footer">
						<p>by <a href="#">Nii Alonte</a></p>
						<p>12/12/2020</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-4">
				<div class="Knowledge-card">
					<div class="Knowledge-card-image">
						<a href="#" title=""><img src="images/knowledge-image-5.jpg" alt="" class="img-fluid"></a>
					</div>
					<div class="Knowledge-card-body">
						<h3><a href="#" title="Economics: Scarcity in society and why economics matters">Economics: Scarcity in society and why economics matters</a></h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
					</div>
					<div class="Knowledge-card-footer">
						<p>by <a href="#">Kwame Santo</a></p>
						<p>12/12/2020</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-4">
				<div class="Knowledge-card">
					<div class="Knowledge-card-image">
						<a href="#" title=""><img src="images/knowledge-image-6.jpg" alt="" class="img-fluid"></a>
					</div>
					<div class="Knowledge-card-body">
						<h3><a href="#" title="Agriculture: Commercial agric and Cocoa farming">Agriculture: Commercial agric and Cocoa farming</a></h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
					</div>
					<div class="Knowledge-card-footer">
						<p>by <a href="#">Sir Awudu kakari</a></p>
						<p>12/12/2020</p>
					</div>
				</div>
			</div>
		</div>
</div>

	<!--- your code end--->	
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
 $result['totalRecord'] = $tutorPosts->total();
 $result['lastPage']    = $tutorPosts->lastPage();
 $result['to']          = $tutorPosts->lastItem();
 if($page >= $result['lastPage']){
     $result['show_morerecords'] = 0;
 }
 else {
    $result['show_morerecords'] = 1;
 }
 
 ob_end_clean();
 echo json_encode($result);
 @endphp 