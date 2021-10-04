<section class="pt-3">
<div class="row pb-3 " id="AddArticleBtnDiv">
			<div class="col">
                <button type="button" id="AddArticleBtn" onclick="tutorPost.showHideArticlePost('show')" class="btn btn-primary px-5 ">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                ADD ARTICLE
               </button>
            </div>
		</div>
	<div class="contact-card hide" id="postArticleTab">
		
		<form action="" method="POST" id="articlePostForm" class="form has-validation-callback" enctype="multipart/form-data">
			<h3 class="sub-heading">Title</h3>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input type="text" class="form-control" id="article_title" name="article_title" placeholder="Main title">
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col">					
					<div class="form-group">
						<input type="text" class="form-control" id="article_subject" name="article_subject" placeholder="Subject">
					</div>
				</div>
			</div>		
			
			<div>
				<h3 class="sub-heading mt-4 mb-2">Content</h3>
			</div>
			<div class="row">
				<div class="col">					
					<div class="form-group">
					<div class="custom-file custom-file-browse">
					  <input type="file" class="custom-file-input" id="article_image" name="article_image">
					  <label class="custom-file-label" for="article_image"><em>... Article Image</em></label>
					</div>
				  </div>
				</div>
			</div>
			<div class="row">
				<div class="col">				
					<div class="form-group">
                      
						<textarea class="form-control textarea-editor	" data-validation="" id="article_content" name="article_content" placeholder="Type a short description here"></textarea>	
						
					</div>
				</div>
			</div>
			<h3 class="sub-heading mt-4 mb-2">Target</h3>
			<div class="form-group">
			
			@foreach($knowledgeTargets->chunk(2) as $chunk)
				<div class="row mb-0 mb-sm-3">
				@foreach($chunk as $knowledgeTarget)
					<div class="col-sm-6 col-md-3 col-lg-2 mb-1 mb-sm-0">
						<div class="custom-control custom-checkbox custom-control-inline">
						  <input type="checkbox" class="custom-control-input article_target" id="article_{{$knowledgeTarget->id}}" name="article_target[{{$knowledgeTarget->id}}]" value="{{$knowledgeTarget->id}}">
						  <label class="custom-control-label" for="article_{{$knowledgeTarget->id}}">{{$knowledgeTarget->name}}</label>
						</div>
					</div>	
				@endforeach					
				</div>
			@endforeach
				
				
			</div>
			<h3 class="sub-heading mt-4 mb-2">keyword</h3>
			<div class="form-group">
				<input type="text" class="form-control " data-role="tagsinput" name="article_keywords" id="article_keywords" value="" data-validation="" data-validation-length="2-255" >
			</div>
			
			<div class="form-group">
				<button type="button" class="btn btn-primary px-5" onclick="tutorPost.createArticle()" id="articlePostBtn">POST ARTICLE</button>
				<button type="button" class="btn btn-secondary px-5" onclick="tutorPost.showHideArticlePost('hide')" id="articleCancelBtn">CANCEL</button>
			</div>
			
			
		</form>
	</div>
	
</section>

<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

<script> 
$(document).ready(function (e) {
	$("#uploadimageForm").on('submit',(function(e) {
		e.preventDefault();
		commonObj.btnDesEnb("#profileUpload","UPLOAD",'des');
			$.ajax({
				url: "{{route('frontend.uploadProfile')}}", // Url to which the request is send
				type: "POST",             // Type of request to be send, called as method
				data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				contentType: false,       // The content type used when sending data to the server.
				cache: false,             // To unable request pages to be cached
				processData:false,        // To send DOMDocument or non processed data file it is set to false
				success: function(getData)   // A function to be called if request succeeds
				{
					commonObj.btnDesEnb("#profileUpload","UPLOAD",'enb');
					commonObj.messages(getData.messageType,getData.message);
					if(getData.errStatus == 1 && getData.imgsrc != ''){
						$("#userProfile").attr('src',getData.imgsrc);
						$("#myModalPhoto").modal("hide");
					}
				},
				error: function (error) {
					commonObj.btnDesEnb("#profileUpload","UPLOAD",'enb');
				}
			});
			
}));
});
</script> 
