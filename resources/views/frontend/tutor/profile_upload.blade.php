
<script>
    var profileUploadObj = { 

    separator:'/', 
    strDouble:'"', 
    strSingle:"'", 
    parentUrl:'{{URL::to("/")}}',
    jsId : {
    profileUpload               		: "#profileUpload",
    changeAvatarBtn               		: "#changeAvatarBtn"
    },
    status : {
    success     : 200
    },
	changeEv : {
		imageUpload : "imageUpload"
	},
    jsClass : {
    navItem 				: ".nav-item"

    },
    jsNames : {
    noname 			: "",
    },
    jsValue : {
    institutionVal        		: ""
   
    },
    extra : { 
    jsSeparator:'-',
    url : {
		uploadProfile : '{{route("frontend.uploadProfile")}}',
		changeAvatar : '{{route("frontend.changeAvatar")}}'
    }
    },
    createUrl : function(set){ 
    return ( this.parentUrl+this.separator+set);
    }
    } 

    /* import {ProfileUpload} from "/js/profile_upload.js";
    (function() { window.profileUploadOb = new ProfileUpload(profileUploadObj); })();   
 */
</script> 
<script src="{{asset('js/profile_upload.js')}}"> </script> 
@section('footer-scripts')

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
						$("#profileImageRun").attr('src',getData.imgsrc);
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

@endsection

@php


		$profileImage = asset($tutor->userData->profile_or_avatar_image);
	
@endphp
<div class="col-md-5 col-lg-4 col-xl-3">
				<div class="profile-image text-center text-md-left mb-3 mb-md-0">				
               <figure>
				   <img class="img-fluid" src="{{ $profileImage }}" id="userProfile" alt="User profile picture">
				   <div class="profile-image-hover">
				   		<a href="#" class="btn-profile-image" data-toggle="modal" data-target="#myModalPhoto">Photo</a>
					   <hr>
					   <a href="#" class="btn-profile-image" data-toggle="modal" data-target="#myModalAvatar">Avatar</a>
				   </div>
				</figure> 
				
               				
				</div>
			</div>

			
<div class="modal fade custom-modal" id="myModalPhoto">
  <div class="modal-dialog">
    <div class="modal-content">      
      <div class="modal-header">       
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>     
      <div class="modal-body">
        <div class="register-card">
			<div class="register-card-header">
				<h1 class="heading">Update your profile photo</h1>				
			</div>
			<form id="uploadimageForm" action="" method="post" enctype="multipart/form-data">
				<div class="register-card-body">
					<div id="image_preview">
					<div class="profile-image ">
						<figure class="m-auto">
					<img class="img-fluid" src="{{ $profileImage }}" alt="User profile picture" id="previewing">
					</figure>
				</div>
				</div>
				</div>
				<hr class="mt-4">				
				<div class="register-card-footer">
						<div class="input-group ">
						  <div class="custom-file">

							<input type="file" class="custom-file-input ss" onchange="profileUploadOb.changeFile(this)" name="profile_image" id="imageUpload">
							<label class="custom-file-label" for="file-">Upload Photo...</label>
						  </div>
						</div>
						<small class="form-text mb-4">
							.jpg .png .bmp  |  Size max >= 2mb |  @ 212px by 150px<br>
							<a href="#">photo uploading terms & conditions</a>					
					</small>
					<button type="submit"  id="profileUpload" class="btn btn-primary w-100">UPLOAD</button>					
				</div>			
				 
			</form>	
		</div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade custom-modal" id="myModalAvatar">
  <div class="modal-dialog">
    <div class="modal-content">      
      <div class="modal-header">       
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>     
      <div class="modal-body">
        <div class="register-card">
			<div class="register-card-header">
				<h1 class="heading">Select your avatar</h1>				
			</div>
			<form>
				<div class="register-card-body">
					<div class="register-avatar">						
						<div class="profile-carousel owl-carousel owl-theme">

						@foreach ($avatars->chunk(16) as $chunk)
						 <div class="item">	
							<ul class="register-avatar-list">
						  @foreach ($chunk as $avatar)
							@if(!empty($avatar->file_url) && file_exists($avatar->file_url))
	
							<li>
								<a href="javascript:void(0)" class="profile_img avt-js {{($tutor->userData->avatar_id == $avatar->id ? 'active' : '')}}" id="avt-{{$avatar->id}}" onclick="profileUploadOb.setAvatar({{$avatar->id}})" title="">
                                                                    <img src="{{asset($avatar->file_url)}}" alt="" width="90">
								</a>
							</li>
							@endif
						  @endforeach
							</ul>	
						</div>
					@endforeach


						</div>						
						
						
					</div>
				</div>
				<hr class="mt-4">				
				<div class="register-card-footer">						
					<button type="button" onclick="profileUploadOb.changeAvatar({{$avatar->id}})" class="btn btn-primary w-100" id="changeAvatarBtn">UPDATE</button>					
				</div>			
				
			</form>	
		</div>
      </div>
    </div>
  </div>
</div>	