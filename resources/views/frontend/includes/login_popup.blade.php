<script>
    
let loginClassObj = { 
    parentUrl:'{{URL::current()}}',
    jsId : {
        activeTabInput: "#activeTabInput",
        LoginBtn      : "#LoginBtnTop",
        loginPopUpDiv : "#loginPopUpDiv",
        returnUrl     : "#returnUrl",
        userName      : "#userName",
        userPassword  : "#userPassword"
    },
	status : {
        success     : 200
    },
    jsClass : {
        navItem  : ".nav-item" 
        
    },
    extra : { 
		url : {
				loginUrl  : '{{route("frontend.ajaxLogin")}}'
		}
    }
} 

/* import {LoginClass} from "/js/login.js";
window.loginObj = new LoginClass(loginClassObj);  */  
</script> 
<script src="{{ asset('js/login.js') }}"></script>
<script>
$(document).ready(function(){
	$('#userName').keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		var userPassword = $("#userPassword").val();
		var userName     = $("#userName").val();
		
		if(keycode == '13'){
			if(userName){
				if(userPassword){
				 loginObj.loginUser(); 
				}else{
					$("#userPassword").focus();
				}
			}
		}
	});
	$('#userPassword').keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		var userPassword = $("#userPassword").val();
		var userName     = $("#userName").val();
		
		if(keycode == '13'){
		  if(userPassword && userName){
				loginObj.loginUser(); 
			} 
		}
	});
});
</script>

<div id="loginPopUpDiv" class="dropdown-menu login-dropdown" style="">
    <form>
    <input type="hidden" id="returnUrl" value="">
    <input type="hidden" id="reloadIt" value="">
                  <div class="form-group">
                          <input type="text" id="userName" class="form-control" placeholder="Username">
                  </div>
            <div class="form-group">
                          <input type="password" id="userPassword" class="form-control " placeholder="Password">

                  </div>
            <div class="form-group ">
           <button type="button" id="LoginBtnTop" onclick="loginObj.loginUser()" class="btn btn-primary w-100"> Login </button>
            </div>            
            <div class="form-text ">Forgot password? <a href="{{ route('password.update') }}">Request</a></div>
            <div class="form-text">New here? <a href="{{ route('register') }}">Register</a></div>
    </form>

  </div>