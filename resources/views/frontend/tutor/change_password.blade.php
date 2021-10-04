<script>
var UpdateProfileCon = { 
    
    separator:'/', 
    strDouble:'"', 
    strSingle:"'", 
    parentUrl:'{{URL::to("/")}}',
   jsId : {
        updatePasswordBtn     : "#updatePasswordBtn",
        oldPassword           : "#old_password",
        newNassword           : "#password",
        passwordConfirmation  : "#password_confirmation",
        changePassword        : "#changePassword",
        changePasswordForm    : "#changePasswordForm",
        updateBtn             : "#updateBtn",
        updateForm            : "#updateForm",
        editProfile           : "#editProfile",
        firstName             : "#first_name",
        lastName              : "#last_name",
        email                 : "#email",
        subject               : "#subject",
        stuClassId            : "#stu_class_id"
		
    },
	status : {
        success     : 200
    },
    extra : { 
        jsSeparator:'-',
		url : {
			   changePasswordApi   : '{{route("frontend.api.changePasswordApi")}}',
			   updateStudent       : '{{route("frontend.api.updateStudent")}}',
			   updateTutor         : '{{route("frontend.api.updateTutor")}}'
		}
    }
} 

/* import {UpdateProfileData} from "/js/update_profile_data.js";
(function() {  window.updateProfileDataObj = new UpdateProfileData(UpdateProfileCon);  })();  
 */
 </script> 


<div class="modal fade custom-modal" id="changePassword">
    <div class="modal-dialog">
        <div class="modal-content">      
            <div class="modal-header">       
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>     
            <div class="modal-body">
                <div class="register-card">
                    <div class="register-card-header">
                        <h1 class="heading">Change Password</h1>				
                    </div>
					
                    <div class="register-card-body">    
                        <form  action="" class="" id="changePasswordForm" method="post" enctype="multipart/form-data">
                            @csrf
					<div class="row">
						<div class="col">
							<div class="form-group ">
								<input type="password" name="old_password" id="old_password" class="form-control " placeholder="Old password" data-validation="required length custom" data-validation-length="min6">
								<small class="form-text">Please enter your old password</small>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col">
							<div class="form-group ">
								<input type="password" name="password" id="password" class="form-control " placeholder="Password" data-validation="required length custom" data-validation-length="min6">
								<small class="form-text">Use a password you can easily remember</small>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col">
							<div class="form-group ">
								<input type="password" name="password_confirmation" id="password_confirmation" class="form-control " placeholder="Password confirm" data-validation="required length custom" data-validation-length="min6" >
								<small class="form-text">Enter password again to make you remember</small>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col">
						<button type="button" class="btn btn-primary w-100 join_button2" onclick="updateProfileDataObj.updatePassword()" id="updatePasswordBtn">UPDATE PASSWORD</button>
                   
						</div>
				    </div>

                        </form>	
                    </div>	   		

                    <div class="register-card-footer">
                       

                    </div>	

                </div>
            </div>
        </div>
    </div>
</div>