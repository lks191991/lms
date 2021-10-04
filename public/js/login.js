/* import {Common} from "/js/common.js"; */
class LoginClass{
	
		constructor(external){
            /* super(); */
			this.ext            = external;
			
		} 
		loginUser(att){
            
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var extra			= this.ext.extra;
			var url			    = this.ext.extra.url;
			var returnUrl       = $(ids.returnUrl).val();
			var reloadIt        = $(ids.reloadIt).val();
			var userNameVal     = $(ids.userName).val();
			var userPasswordVal = $(ids.userPassword).val();
			var self = this;
			var postUrl  = url.loginUrl;
			commonObj.btnDesEnb(ids.LoginBtn,"Login",'des');
			
			var postData    = {
								'returnUrl':returnUrl,
								'reloadIt':reloadIt,
								'username':userNameVal,
								'password':userPasswordVal
								};
			
			
            //this.post(postUrl,postData);
			
			axios.post(postUrl,postData)
			.then(function (response) {
				commonObj.btnDesEnb(ids.LoginBtn,"Login",'enb');
				var getData = response.data;
				
				if(!getData.errStatus)
				{
				    commonObj.messages(getData.messageType,getData.message);
				}else {
					commonObj.messages(getData.messageType,getData.message);
					if(getData.isAdmin == 1){
                        window.location.href = getData.adminUrl;
                    }else{
                        var urlRe = self.ext.parentUrl+returnUrl
                        window.location.href = urlRe;
                    }  
				}
				
			})
			.catch(function (error) {
				commonObj.btnDesEnb(ids.LoginBtn,"Login",'enb');
			});		
			 
			
		}
        post(url,postData){

            var responseData = axios.post(url,postData)
			.then(function (response) {
				return response; 
			})
			.catch(function (error) {
                var re = {"status" : error.response.status, "message" : `Error Code ${error.response.status} : ${error.response.statusText}`};
				return re;
			});
           
            this.getPostData = responseData;
        }
		openPopup(returnUrl = "",reloadIt = ""){
			
			if(returnUrl == "" && $(this.ext.jsId.activeTabInput).val())
			{
			 var v = $(this.ext.jsId.activeTabInput).val();
			 //returnUrl = `?active=${v}`;
			}
			/* console.log(1,returnUrl); */
			$(this.ext.jsId.loginPopUpDiv).toggle(300);
			$(this.ext.jsId.returnUrl).val(returnUrl);
			$(this.ext.jsId.reloadIt).val(reloadIt);
		}
        
        
}
var loginObj = new LoginClass(loginClassObj); 
/* export {LoginClass} */
