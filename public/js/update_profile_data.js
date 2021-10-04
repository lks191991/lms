
class UpdateProfileData{
	
		constructor(external){
			this.ext            = external;
		} 
		
        updatePassword(){
            var self = this;
			commonObj.paceRestart('updatePassword');
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var jsValue			= this.ext.jsValue;
			var extra			= this.ext.extra;
			var url			    = this.ext.extra.url;
			var updatePasswordBtn	= ids.updatePasswordBtn;
			 

			var oldPassword           = $(ids.oldPassword).val();
			var newNassword           = $(ids.newNassword).val();
			var passwordConfirmation  = $(ids.passwordConfirmation).val();
			

            commonObj.btnDesEnb(updatePasswordBtn,"UPDATE PASSWORD",'des');
			var sendOption  = {
								'old_password'           : oldPassword,
								'password'               : newNassword,
								'password_confirmation'  : passwordConfirmation
							  };

			
			var responseData = axios.post(url.changePasswordApi,sendOption)
			.then(function (response) {
                commonObj.btnDesEnb(updatePasswordBtn,"UPDATE PASSWORD",'enb');
				var getData = response.data;
				
                if(getData.isLogin != 1)
				{
                  commonObj.openLoginModel();
                }
				else if(!getData.errStatus)
				{
				  commonObj.messages(getData.messageType,getData.message);
				}else {
                    
                    $(ids.changePasswordForm).trigger("reset");
                    $(ids.changePassword).modal("hide");
					commonObj.messages(getData.messageType,getData.message);
					
				}
			})	
			.catch(function (error) {
                commonObj.btnDesEnb(updatePasswordBtn,"UPDATE PASSWORD",'enb');
				commonObj.catchErr(error);
			});
			
		}
		updateStudent(){
            var self = this;
			commonObj.paceRestart('updateStudent');
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var jsValue			= this.ext.jsValue;
			var extra			= this.ext.extra;
			var url			    = this.ext.extra.url;
			var updateBtn	    = ids.updateBtn;
			var updateBtnName	= "UPDATE";
			 

			var firstName           = $(ids.firstName).val();
			var lastName            = $(ids.lastName).val();
			var email               = $(ids.email).val();
			var stuClassId          = $(ids.stuClassId).val();
			
			

            commonObj.btnDesEnb(updateBtn,updateBtnName,'des');
			var sendOption  = {
								'first_name'           : firstName,
								'last_name'            : lastName,
								'email'                : email,
								'student_class'        : stuClassId
							  };

			
			var responseData = axios.post(url.updateStudent,sendOption)
			.then(function (response) {
                commonObj.btnDesEnb(updateBtn,updateBtnName,'enb');
				var getData = response.data;
				
                if(getData.isLogin != 1)
				{
                  commonObj.openLoginModel();
                }
				else if(!getData.errStatus)
				{
				  commonObj.messages(getData.messageType,getData.message);
				}else {
                    
                    $(ids.updateForm).trigger("reset");
                    $(ids.editProfile).modal("hide");
					commonObj.messages(getData.messageType,getData.message);
					 window.location.href = getData.loadUrl;
					
				}
				
			})
			.catch(function (error) {
                commonObj.btnDesEnb(updateBtn,updateBtnName,'enb');
				commonObj.catchErr(error);
			});
			
		}
		updateTutor(){
            var self = this;
			commonObj.paceRestart('updateStudent');
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var jsValue			= this.ext.jsValue;
			var extra			= this.ext.extra;
			var url			    = this.ext.extra.url;
			var updateBtn	    = ids.updateBtn;
			var updateBtnName	= "UPDATE";
			 
			var firstName           = $(ids.firstName).val();
			var lastName            = $(ids.lastName).val();
			var subject             = $(ids.subject).val();
			var email               = $(ids.email).val();
			
            commonObj.btnDesEnb(updateBtn,updateBtnName,'des');
			var sendOption  = {
								'first_name'           : firstName,
								'last_name'            : lastName,
								'email'                : email,
								'subject'              : subject
							  };

			 
			var responseData = axios.post(url.updateTutor,sendOption)
			.then(function (response) {
                commonObj.btnDesEnb(updateBtn,updateBtnName,'enb');
				var getData = response.data;
				
                if(getData.isLogin != 1)
				{
                  commonObj.openLoginModel();
                }
				else if(!getData.errStatus)
				{
				  commonObj.messages(getData.messageType,getData.message);
				}else {
                    
				 $(ids.updateForm).trigger("reset");
				 $(ids.editProfile).modal("hide");
				 commonObj.messages(getData.messageType,getData.message);
				 window.location.href = getData.loadUrl;
					
				}
				
			})
			.catch(function (error) {
                commonObj.btnDesEnb(updateBtn,updateBtnName,'enb');
				commonObj.catchErr(error);
			});
			
		}
		
}

var updateProfileDataObj = new UpdateProfileData(UpdateProfileCon);
