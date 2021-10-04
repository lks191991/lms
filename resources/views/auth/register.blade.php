@extends('frontend.layouts.app')

@section('content')
<section class="register-banner"></section>
<section class="register-wrapper">
    <div class="container">
        <div class="register-card-wrapper">	
            <div class="register-card">
                @if(isset($num) && $num == 1)
                <div class="register-card-header">
                    <h1 class="heading">Register</h1>
                    <p class="">{{ __('to enable you ask questions, get notes and connect with your classmates') }}</p>
                </div>
                @includeif('auth.forms.register-step1-form')
                @elseif(isset($num) && $num == 2)
                <div class="register-card-header hide-activate-account">
                    <h1 class="heading">Activate account</h1>
                    <p class="">{{ __('Enter the 6 digit code send to your mobile number') }}</p>
                </div>					

                @includeif('auth.forms.register-step2-form')

                <div class="register-note hide-activate-account">
                    <strong>Notice Info:</strong>The activation code will be sent via SMS. Please use the number you are activating the account with to request acess from your school.
                </div>
                @elseif(isset($num) && $num == 3)
                <div class="register-card-header">
                    <h1 class="heading">More about you</h1>
                    <p class="">{{ __('Tell us more so we can help you learn better') }}</p>
                </div>					
                @includeif('auth.forms.register-step3-form')
                @elseif(isset($num) && $num == 4)
                <div class="register-card-header">
                    <h1 class="heading">Build your profile</h1>
                    <p class="">{{ __('Select an avatar that represents you or upload your photo') }}</p>
                </div>					
                @includeif('auth.forms.register-step4-form')
                @endif
            </div>
        </div>
    </div>	
</section>	
@endsection

@section('footer-scripts')
<script>
var timer2 = "{{$diffMinutes}}";
function getDepartment(callFrom = '',optionName = 'Department'){
            
            $("#rejCourseDiv").hide('slow'); 
            $("#school_course").val(''); 
            $("#rejClassDiv").hide('slow'); 
            $("#class_level").val('');

            var category_id     = $("#school_cat").val(); /* Institution */
            var school_id       = $("#set_school_id").val(); /* School id */
            var department_id   = $("#uni_department").val(); /* Department */
            var course_id       = $("#school_course").val(); /* Course */
            var class_id        = $("#class_level").val(); /* Course */

            

            var optionVal = {'optionName':optionName,'listData' : 'department','category_id': category_id,'school_id': school_id,'department_id': department_id,'course_id': course_id,'class_id': class_id};

							$.ajax({
								type: "POST",
								url: '{{ route("frontend.ajax.schoolcourses") }}',
								data: optionVal,
								
								success: function(data){
                                     $("#rejDepartmentDiv").show('slow');
									$("#uni_department").html(data);
								}
							});		
						
						return false;
        }

        function getCourses(callFrom = '',optionName = 'Course'){
            
            $("#rejClassDiv").hide('slow'); 
            $("#class_level").val('');

            var category_id     = $("#school_cat").val(); /* Institution */
            var school_id       = $("#set_school_id").val(); /* School id */
            var department_id   = $("#uni_department").val(); /* Department */
            var course_id       = $("#school_course").val(); /* Course */
            var class_id        = $("#class_level").val(); /* Course */

            var optionVal = {'optionName':optionName,'listData' : 'course','category_id': category_id,'school_id': school_id,'department_id': department_id,'course_id': course_id,'class_id': class_id};
						
							$.ajax({
								type: "POST",
								url: '{{ route("frontend.ajax.schoolcourses") }}',
								data: optionVal,
								success: function(data){
                                    $("#rejCourseDiv").show('slow');
									$("#school_course").html(data);
								}
							});		
						
						return false;
        }

        function getClasses(callFrom = '',optionName = 'Class'){

            var category_id     = $("#school_cat").val(); /* Institution */
            var school_id       = $("#set_school_id").val(); /* School id */
            var department_id   = $("#uni_department").val(); /* Department */
            var course_id       = $("#school_course").val(); /* Course */
            var class_id        = $("#class_level").val(); /* Course */

            var optionVal = {'optionName':optionName,'listData' : 'classes','category_id': category_id,'school_id': school_id,'department_id': department_id,'course_id': course_id,'class_id': class_id};
						
							$.ajax({
								type: "POST",
								url: '{{ route("frontend.ajax.schoolclasses") }}',
								data: optionVal,
								success: function(data){
                                    $("#rejClassDiv").show('slow');
									$("#class_level").html(data);
								}
							});		
						
						return false;
        }

        function hideBox(){

            /* 1 = Basic school
            2 = Senior high
            5 = Univeristy */

            var category_id     = $("#school_cat").val(); /* Institution */
            var school_id       = $("#school-id").val(); /* School id */
            var department_id   = $("#uni_department").val(); /* Department */
            var course_id       = $("#school_course").val(); /* Course */
            var class_id        = $("#class_level").val(); /* Course */
            
            if(school_cat != ''){

                $("#rejSchoolDiv").show('slow');
                if(school_cat == 1)
                {

                }else if(school_cat == 2){

                }else if(school_cat == 5){

                }
            } else {
                $("#rejSchoolDiv").hide('slow');
                $("#rejDepartmentDiv").hide('slow');
                $("#rejCourseDiv").hide('slow');
                $("#rejClassDiv").hide('slow');
            }
        }
    $(document).ready(function () {
        // Below code for send otp through ajax
        $('.reSendOtp').click(function (event) {
            if ($("#mobile").val() != '') {
                var i = 0;
                $.ajax({
                    url: '{{ route("frontend.ajax.sendOtp") }}',
                    type: 'post',
                    data: {'type': 'send-otp', 'phone_code': $('#phone_code').val(), 'mobile': $('#mobile').val(), 'mobile_number_type':$('#mobile_number_type').val(), 'old_mobile_number':$('#old_mobile_number').val(), 'user_id':$('#user_id').val()},
                    dataType: 'json',
                    beforeSend: function () {
                        $("#cover-spin").show(0);
                        i++;
                    },
                    success: function (data) {
						timer2 = "{{Config::get('constants.OTP_TIME_LEFT')}}";
                        $("#cover-spin").hide(0);
                        if (data.status) {
							$(".ajax-error").hide();
                            alert("Success : " + data.message);
							
                        } else {
							$(".ajax-error").html(data.message);
							$(".ajax-error").show();
							return false;
                           // alert(data.message);
						}
						if($('#mobile_number_type').val() == "new") {
								var url = '{{ route("registerStep", 2) }}';
								window.location = url;
							}
                    },
                    error: function (xhr) {
                        $("#cover-spin").hide(0);
                    },
                    complete: function () {
                        i--;
                        if (i <= 0) {
                            $("#cover-spin").hide(0);
                        }
                    }
                });
            }
        });
		
            //otp ajax submit
        $(".otp-ajax-submit").click(function() {
		//alert("ok"); return false;
		if ($("#mobile").val() != '' && $('#otp').val() != '') { 
			$.ajax({
                    url: '{{ route("frontend.ajax.verifyOtp") }}',
                    type: 'post',
                    data: {'type': 'verify-otp', 'mobile': $('#mobile').val(), 'otp': $('#otp').val(), 'user_id':$('#user_id').val()},
                    dataType: 'json',
                    beforeSend: function () {
                        $("#cover-spin").show(0);
                        
                    },
                    success: function (data) { 
                        $("#cover-spin").hide(0);
                        if (data.status) {
                            //$(".ajax-error").html(data.message);
                            $(".ajax-error").hide();
                            $(".hide-activate-account").hide();
                            $(".successfully-activated").show();
                            var delay = 5000; 
                            var url = '{{ route("registerStep", 3) }}';
                            setTimeout(function(){ window.location = url; }, delay);
                           // alert("Success : " + data.message);
                        } else {
                            $(".ajax-error").html(data.message);
							$(".ajax-error").show();
                        }
                    },
                    error: function (xhr) {
                        $("#cover-spin").hide(0);
                    },
                    complete: function () {
                        i--;
                        if (i <= 0) {
                            $("#cover-spin").hide(0);
                        }
                    }
                });
			} else {
				$(".ajax-error").html("Please fill all required field.");
				$(".ajax-error").show();
				return false;
			}
			
		});
		
		// Active class add on avatar select
        $(".change-mobile-number").on('click', function () {
			$("#mobile").removeAttr('readonly');
			
       });

		$("input.mobile-number-input").blur(function(){
		
		if ($(this).attr('readonly') != 'readonly') {
			
				$(".otp-ajax-submit").hide();
				$("#mobile_number_type").val("new");
				$(".reSendOtp").show();
			}
			
		});
		
		
		$("input#password").blur(function(){
			var pass_val = $(this).val();
			if(pass_val) {
				$("input#password_confirmation").removeAttr("readonly");
			} else {
				$("input#password_confirmation").attr("readonly","readonly");
			}
		});
		
		$("#search_school").keyup(function(){

            $("#rejDepartmentDiv").hide('slow'); 
            $("#uni_department").val('');
            $("#rejCourseDiv").hide('slow'); 
            $("#school_course").val(''); 
            $("#rejClassDiv").hide('slow'); 
            $("#class_level").val('');

			var keyword = $(this).val();
			var keyword_length = $(this).val().length;
			if(keyword_length >= 1) {
				$.ajax({
				type: "POST",
				url: '{{ route("frontend.ajax.searchschool") }}',
				data: {'keyword': keyword, 'category_id': $('#school_cat').val()},
				beforeSend: function(){
					$("#search_school").css("background","#FFF url('{{url("images/LoaderIcon.gif")}}') no-repeat 165px");
				},
				success: function(data){
					$("#suggesstion-box").show();
					$("#suggesstion-box").html(data);
					$("#search_school").css("background","#FFF");
					
					$(".select-school").click(function() {
                         var school_id       = $(this).attr("data-school-id"); /* School id */
                         var school_name = $(this).attr("data-school-name");
                            $("#search_school").val(school_name);
                            $("#school-id").val(school_id);
                            $("#set_school_id").val(school_id);
                            $("#suggesstion-box").hide();
                        var category_id     = $("#school_cat").val();
                        @if($userRole == 'student')
                            if(category_id == 1)
                            {
                                getClasses('school'); 
                            }else if(category_id == 2){
                                getCourses('school');
                            }else if(category_id == 5){
                                getDepartment('school');
                            }
						@endif
					});
					
					
				}
				});
			}
		});
		
		
		$("select#school_cat").change(function() {
             $("#rejSchoolDiv").show('slow');
             $("#rejDepartmentDiv").hide('slow');
             $("#uni_department").val();
             $("#rejCourseDiv").hide('slow');
             $("#school_course").val();
             $("#rejClassDiv").hide('slow');
             $("#class_level").val();   

			$("#search_school").val('');
			$("#set_school_id").val('');
		});

        
		
		// Active class add on avatar select
        $(".profile_img").on('click', function () {
            $('#registerForm4').get(0).reset();

            $(".profile_img").removeClass('active');
            $(this).addClass('active');

            $("#user_image").closest('div.input-group').nextAll('div.invalid-feedback').remove();
            $("#user_image").closest('div.input-group').nextAll('small').show();

            $('input[name="avatarImage"]').val($(this).find('img').data('id'));

            $('div.custom-file').find("label.custom-file-label").removeClass("selected").html('Upload Photo...');
        });

        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function () {
            $(".profile_img").removeClass('active');
            $('input[name="avatarImage"]').val('');

            var fileName = $(this).val().split("\\").pop();

            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        var _URL = window.URL || window.webkitURL;

        // validate input file image with avatar.
        $('#user_image').on('change', function () {
            $("#user_image").closest('div.input-group').nextAll('div.invalid-feedback').remove();
            $("#user_image").closest('div.input-group').nextAll('small').show();

            var file = this.files[0];
            var fileName = file.name;
            var data = fileName.split('.');
            var ext = data[data.length - 1];

            const size = (file.size / 1024 / 1024).toFixed(2);

            var noError = true;
            if ($.inArray(ext, ['jpg', 'jpeg', 'png', 'bmp']) == -1) {
                $("<div class='invalid-feedback'>Please upload only .jpg, .png, .bmb file.</div>").insertAfter($("#user_image").closest('div.input-group')).show();

                $("#user_image").closest('div.input-group').nextAll('small').hide();

                noError = false;
            }
            else if (size > 2) {
                $("<div class='invalid-feedback'>Uploaded file size is larger then 2mb</div>").insertAfter($("#user_image").closest('div.input-group')).show();

                $("#user_image").closest('div.input-group').nextAll('small').hide();
                noError = false;
            }
            else {
                img = new Image();
                var imgwidth = 0;
                var imgheight = 0;
                var minwidth = 212;
                var minheight = 150;

                img.src = _URL.createObjectURL(file);
                img.onload = function () {
                    imgwidth = this.width;
                    imgheight = this.height;

                    if (imgwidth < minwidth || imgheight <= minheight) {
                        $("<div class='invalid-feedback'>Image min size must be " + minwidth + "px by " + minheight + "px </div>").insertAfter($("#user_image").closest('div.input-group')).show();

                        $("#user_image").closest('div.input-group').nextAll('small').hide();

                        noError = false;
                    }
                }
            }

            if (!noError) {
                $(".profile_img").removeClass('active');
                $('input[name="avatarImage"]').val('');

                $('div.custom-file').find("label.custom-file-label").removeClass("selected").html('Upload Photo...');
                $('#registerForm4').get(0).reset();
            } else {
                $(".profile_img").removeClass('active');
                $('input[name="avatarImage"]').val('');

                //$("#output").html('<b>' + 'This file size is: ' + size + " MB" + '</b>'); 
            }
        });

        // validate form before submit that avatar or image is selected or not
        $('#registerForm4').submit(function (event) {
            if (document.getElementById("user_image").files.length == 0) {
                var avatarSelect = 0;
                $('.profile_img').each(function (e) {
                    if ($(this).hasClass('active'))
                        avatarSelect = 1;
                });

                if (avatarSelect == 0) {
                    event.preventDefault(); //this will prevent the default submit

                    $("#user_image").closest('div.input-group').nextAll('div.invalid-feedback').remove();
                    $("#user_image").closest('div.input-group').nextAll('small').hide();

                    $('<div class="invalid-feedback">this is required if you dont select any avatar.</div>').insertAfter($("#user_image").closest('div.input-group')).show();

                    return false;
                }
            }
        });
		
});


var interval = setInterval(function() {

if(timer2 == '00:00'){return false; }
  var timer = timer2.split(':');
  //by parsing integer, I avoid all extra string processing
  var minutes = parseInt(timer[0], 10);
  var seconds = parseInt(timer[1], 10);
  --seconds;
  minutes = (seconds < 0) ? --minutes : minutes;
  if (minutes < 0) clearInterval(interval);
  seconds = (seconds < 0) ? 59 : seconds;
  seconds = (seconds < 10) ? '0' + seconds : seconds;
  if(minutes == 0 && seconds < 1){
	  $('.countdown').html('Time expired');
	  return false;
  }
  else{
	  $('.countdown').html('Time Left - ' + minutes + ':' + seconds);
  }
  timer2 = minutes + ':' + seconds;
}, 1000);

</script>
@stop