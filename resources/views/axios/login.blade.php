@php 
$prmsArr = json_encode(array(	
            "auth/user/login"=>array("username"=>"", "password"=>"", "platform" => "iphone/android", "device_token"=>""),
			"auth/user/register"=>array("first_name"=>"", "last_name"=>"", "email"=>"", "password"=>"",  'username' => '', 'mobile' => '', 'phone_code' =>'', "platform" => "iphone/android", "device_token"=>""),
			"verifysignupotp" => array("mobile"=>"", "otp"=>""),
			"save_academic_info" => array("institution_id"=>"", "school_id"=>"", "course_id"=>"", "class_id"=>""),
			"save_avatar" => array("avatar_id"=>"", "avatar_image"=>""),
			
			"forgot_password" => array("email"=>"XXX@XXX.com"),
			"verifyforgotpasscode" => array("email"=>"XXX@XXX.com", "passcode"=>"abc123"),
			"resetuserpassword" => array("email"=>"XXX@XXX.com", "new_password"=>"abc123"),
			"profile"=>array(),
			'logout' => 'Please send token in header with "Bearer " + token',
			
			'make_fav_video' => array("video_id"=>"", "fav"=>"0/1"),
			'profile/favorite' => array(),
			
			'institutions' => array(),
			'institution' => array("id" => ""),
			'countries' => array(),
			'avatars' => array(),
			'schools' => array("school_category"=>""),
			'school' => array("id" => ""),
			'courses' => array("school_id"=>""),
			'course' => array("id" => ""),
			'classes' => array("school_category"=>""),
			'list_classrooms' => array("school_id"=>"", "course_id"=>"", "class_id"=>""),
			'classroom_detail' => array("classroom_id"=>""),
			'questions' => array("video_id"=>""),
			'question/save' => array("video_id"=>"", 'content' => "", "parent_id"=>"", 'type' => ""),
			
            "getStaticPages"=>array("type"=>"terms/privacy"),
            "getSiteStaticData"=>array(),
            "getPageContentUsingURL"=>array("url" => "terms-and-conditions"),
	), 2);
@endphp
<!doctype html>
<html>
	<head>
		<title>Xtra Class: WebService UI</title>
		<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
		<!--<meta name="csrf-token" content="{{ csrf_token() }}">-->
		<!--<script type="text/javascript" src="{{ asset('axios_folder/dist/axios.min.js') }}"></script>-->
	</head>
	<body class="container">
		<h3><span style="color:#060">Xtra Class version 1.X</span> <br/>Webservice Test - <?php print date("d-m-Y H:i:s");?> - <?php print strtotime(gmdate("Y-m-d H:i:s"));?></h3> 
		<div>
			<label>Choose Action: </label>
			<select id="myAction" name="myAction">
				<option value="" selected> ---- select --- </option>
				<option value="auth/user/login" rel="1" data-type="POST">Login</option>
				<option value="auth/user/register" rel="1" data-type="POST">Register</option>
				<option value="verifysignupotp" rel="1" data-type="POST">Verify Signup Otp</option>
				<option value="save_academic_info" rel="1" data-type="POST">Save Academic Info</option>
				<option value="save_avatar" rel="1" data-type="POST">Save Avatar</option>
				<option value="forgot_password" rel="1" data-type="POST">Forgot password</option>
				<option value="verifyforgotpasscode" rel="1" data-type="POST">Verify Passcode Token</option>
				<option value="resetuserpassword" rel="1" data-type="POST">Reset Password</option>
				<option value="profile" rel="1" data-type="GET">Get User Profile</option>
				<option value="make_fav_video" rel="1" data-type="POST">Make Fav/Unfav Video</option>
				<option value="profile/favorite" rel="1" data-type="GET">Fav Video List</option>
				<option value="avatars" rel="1" data-type="GET">List all Avatars</option>
				<option value="institutions" rel="1" data-type="GET">List Institutes</option>
				<option value="institution" rel="1" data-type="GET">Institute Detail </option>
				<option value="countries" rel="1" data-type="GET">List Countries</option>
				<option value="schools" rel="1" data-type="GET">List Schools</option>
				<option value="school" rel="1" data-type="GET">School Detail </option>
				<option value="courses" rel="1" data-type="GET">List Courses</option>
				<option value="course" rel="1" data-type="GET">Course Detail </option>
				<option value="classes" rel="1" data-type="GET">List Classes</option>
				<option value="list_classrooms" rel="1" data-type="POST">List Classrooms</option>
				<option value="classroom_detail" rel="1" data-type="GET">Classroom Detail</option>
				<option value="questions" rel="1" data-type="GET">List Questions</option>
				<option value="question/save" rel="1" data-type="POST">Save Question</option>
			</select>
		</div>
		<div style="display:none; float:left; margin-top:20px;" id="prms">
			<label style="vertical-align:top;">Header : </label><br/>
			<textarea name="header_token" id="header_token_request" cols="90" rows="2" style="word-wrap:break-word;"></textarea> &nbsp;<br/><br/>
			<label style="vertical-align:top;">Input Values : </label><br/>
			<textarea name="request" id="json_request" cols="90" rows="5" style="word-wrap:break-word;"></textarea> &nbsp;
			<input type="text" name="get_request" id="json_request_get"> &nbsp;
		</div>
		<div style="float:left; height:45px; margin-top:220px;" id="parseSubmit">
			<input type="button" name="submit" value="Submit" onClick="sendRequest()" style=" vertical-align:top;" />
			<span id="jsonResponseLoad"></span> 
		</div>
		<div style="clear:both;">
			<h3>Response : </h3>
			<div id="jsonResponse" style="height:400px;width:900px; padding:10px; margin:10px; border:1px solid #555; overflow:scroll;"></div>
		</div>
		<script type="text/javascript">
		var prmsArr = [];		
		prmsArr = <?php print $prmsArr;?>;
		function sendRequest(){
			var json_request = "";
			
			if($('#json_request').val().length > 0){
			 	json_request = $.trim($('#json_request').val());
				json_request = $.parseJSON(json_request);
			}
			var is_auth_required = 0;
			if($('#header_token_request').val().length > 0) {
				is_auth_required = 1;
			}
			
			var action_request = $( "#myAction option:selected" ).val();
			var method = $( "#myAction option:selected" ).data('type');
			
			if(method == 'GET') {
				var inputvar = $('#json_request_get').val();
				$.ajax({
					type: 'GET',
					url: '{{URL::to("/")}}/api/' + action_request + '/' + inputvar,
					//data : json_request,
					dataType:'json',
					beforeSend: function(jqXHR) { 
						$("#jsonResponseLoad").addClass('loader').html('<img src="{{config('constants.SITE_URL')}}img/loader.gif">');
						//jqXHR.setRequestHeader('Accept', 'application/json');
						if(is_auth_required == 1) {
							jqXHR.setRequestHeader('Authorization', 'Bearer ' + $('#header_token_request').val());
						}
						//jqXHR.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
						jqXHR.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
					},
					success: function(data) {
						$("#jsonResponseLoad").removeClass('loader').html('');
						$('#jsonResponse').html('<pre>' + JSON.stringify(data, '', 2) + '</pre>');
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus, errorThrown, jqXHR.responseText);
						$("#jsonResponseLoad").removeClass('loader').html('');
						$('#jsonResponse').html('<pre>' + JSON.stringify(jqXHR.responseJSON, '', 2) + '</pre>');
					}
				});
			} else if(method == 'POST') {
				$.ajax({
					type: 'POST',
					url: '{{URL::to("/")}}/api/' + action_request,
					data : json_request,
					dataType:'json',
					beforeSend: function(jqXHR) { 
						$("#jsonResponseLoad").addClass('loader').html('<img src="{{config('constants.SITE_URL')}}img/loader.gif">');
						//jqXHR.setRequestHeader('Accept', 'application/json');
						if(is_auth_required == 1) {
							jqXHR.setRequestHeader('Authorization', 'Bearer ' + $('#header_token_request').val());
						}
						//jqXHR.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
						jqXHR.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
					},
					success: function(data) {
						$("#jsonResponseLoad").removeClass('loader').html('');
						$('#jsonResponse').html('<pre>' + JSON.stringify(data, '', 2) + '</pre>');
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus, errorThrown, jqXHR.responseText);
						$("#jsonResponseLoad").removeClass('loader').html('');
						$('#jsonResponse').html('<pre>' + JSON.stringify(jqXHR.responseJSON, '', 2) + '</pre>');
					}
				});
			}
			console.log(json_request);return false;
			
		}
		
		$("#myAction").on('change', function(){ 
			var getOption = this.value;	
			if($('option:selected', this).attr('rel')==1){
				$("#prms").show();
				$("#parseSubmit").show();				
				$("#json_request").val(JSON.stringify(prmsArr[getOption]));
			} else {
				$("#json_request").val('');	
				$("#prms").hide();
				$("#parseSubmit").show();								
			}
			if($('option:selected', this).data('type')=='GET'){
				$("#json_request").hide();
				$("#json_request_get").show();
			} else if($('option:selected', this).data('type')=='POST'){
				$("#json_request").show();
				$("#json_request_get").hide();
			}
		});
	</script>
	<style>
	.loader{
		position: absolute;
  top: 0;
  bottom: 0%;
  left: 0;
  right: 0%;
  background-color: white;
  z-index: 99;
	}
	</style>
  </body>
</html>
