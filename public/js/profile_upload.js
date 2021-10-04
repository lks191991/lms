class ProfileUpload{
	
		constructor(external){
			this.ext            = external;
			this.avatarSend     = '';
		} 
		changeFile(event){
			 
			var file = event.files[0];
			var imagefile = file.type;
			var match= ["image/jpeg","image/png","image/bmp"];
			if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
			{
				
				commonObj.messages('error','Please Select A valid Image File. Only jpeg, jpg and png Images type allowed.');
				return false;
			}
			else
			{
				var reader = new FileReader();
				reader.onload = this.imageIsLoaded;
				reader.readAsDataURL(event.files[0]); 
			}
		}
		imageIsLoaded(e) {
				$('#previewing').attr('src', e.target.result);
		}
		setAvatar(id){
			this.avatarSend = id;
			$(".avt-js").each(function(){
				 $(this).removeClass('active');
			});
			$("#avt-"+id).addClass('active');
			//console.log(this.avatarSend);
		}
		changeAvatar(){
            
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var extra			= this.ext.extra;
			var url			    = this.ext.extra.url;
			
			
			if(this.avatarSend == ''){
				commonObj.messages('error',"Please select avatar.");
				return false;
			}
			 
			var postUrl  = url.changeAvatar;
			commonObj.btnDesEnb(ids.changeAvatarBtn,"UPDATE",'des');
			
			

			var postData    = {'avatar_id' : this.avatarSend};
			
			
			var responseData = axios.post(postUrl,postData)
			.then(function (response) {
				commonObj.btnDesEnb(ids.changeAvatarBtn,"UPDATE",'enb');
				var getData = response.data;
				if(!getData.errStatus)
				{
				    commonObj.messages(getData.messageType,getData.message);
				}else {
					commonObj.messages(getData.messageType,getData.message);
					$("#userProfile").attr('src',getData.imgsrc);
					$("#previewing").attr('src',getData.imgsrc);
					$("#profileImageRun").attr('src',getData.imgsrc);
					$("#myModalAvatar").modal("hide");
				}
				
					
			})
			.catch(function (error) {
				commonObj.btnDesEnb(ids.changeAvatarBtn,"UPDATE",'enb');
				//alert(err);
			});
			
		}

		openPopup(returnUrl = "",reloadIt = ""){
			
			if(returnUrl == "" && $(this.ext.jsId.activeTabInput).val())
			{
			 var v = $(this.ext.jsId.activeTabInput).val();
			 //returnUrl = `?active=${v}`;
			}
			
			$(this.ext.jsId.loginPopUpDiv).toggle(300);
			$(this.ext.jsId.returnUrl).val(returnUrl);
			$(this.ext.jsId.reloadIt).val(reloadIt);
		}
        
        
}

var profileUploadOb = new ProfileUpload(profileUploadObj);
