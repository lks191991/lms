
@php ($loginUser = SiteHelpers::getUserForActive()) @endphp
<script type="module">
import {Common} from "/js/common.js";
(function() {  window.commonObj = new Common('');  })();  
</script> 

<script>
$(document).ready(function () {
        // Below code for send otp through ajax
		$('.firstSendOtp').click(function (event) {
			if($("#sendedOtp").val() != 1){
				$("#sendedOtp").val(1);
				$('.reSendOtp').trigger( "click" );
			}
		});	
		
        $('.reSendOtp').click(function (event) {
			
            if ($("#mobile").val() != '') {
                var i = 0;
                $.ajax({
                    url: '{{ route("frontend.ajax.sendOtp") }}',
                    type: 'post',
                    data: {'type': 'send-otp', 'phone_code': $('#phone_code').val(), 'mobile': $('#mobile').val(), 'mobile_number_type':$('#mobile_number_type').val(), 'old_mobile_number':$('#old_mobile_number').val(), 'user_id':$('#user_id').val()},
                    dataType: 'json',
                    beforeSend: function () {
                        /* $("#cover-spin").show(0); */
							commonObj.btnDesEnb("#reSendOtpLink","Request code again",'des');
                        i++;
                    },
                    success: function (data) {
						
                        $("#cover-spin").hide(0);
                        if (data.status) {
							$(".ajax-error").hide();
                           timer2 = "{{Config::get('constants.OTP_TIME_LEFT')}}";
							commonObj.messages('success',data.message);
                        } else {
							commonObj.messages('error',data.message);
							$(".ajax-error").html(data.message);
							$(".ajax-error").show();
							return false;
                           // alert(data.message);
						}
						
                    },
                    error: function (xhr) {
                        /* $("#cover-spin").hide(0); */
						commonObj.btnDesEnb("#reSendOtpLink","Request code again",'enb');
                    },
                    complete: function () {
						commonObj.btnDesEnb("#reSendOtpLink","Request code again",'enb');
                        i--;
                        if (i <= 0) {
                            /* $("#cover-spin").hide(0); */
                        }
                    }
                });
            }
        });
		
            //otp ajax submit
        $(".otp-ajax-submit").click(function() {
			var i = 0;
		//alert("ok"); return false;
		if ($("#mobile").val() != '' && $('#otp').val() != '') { 
			$.ajax({
                    url: '{{ route("frontend.ajax.verifyOtp") }}',
                    type: 'post',
                    data: {'type': 'verify-otp', 'mobile': $('#mobile').val(), 'otp': $('#otp').val(), 'user_id':$('#user_id').val()},
                    dataType: 'json',
                    beforeSend: function () {
                        /* $("#cover-spin").show(0); */
						commonObj.btnDesEnb("#activeBtn","ACTIVATE",'des');
                        i++;
                    },
                    success: function (data) { 
                        commonObj.btnDesEnb("#activeBtn","ACTIVATE",'enb');
                        if (data.status) {
                            //$(".ajax-error").html(data.message);
							//commonObj.messages('error',data.message);
                            $(".ajax-error").hide();
                            /* $(".hide-activate-account").hide();
                            $(".successfully-activated").show(); */
                            var delay = 500; 
                            var url = '{{ URL::current() }}';
							commonObj.messages('success',"successfully activated");
                            setTimeout(function(){ window.location = url; }, delay);
                           // alert("Success : " + data.message);
                        } else {
							commonObj.messages('error',data.message);
                            $(".ajax-error").html(data.message);
							$(".ajax-error").show();
                        }
                    },
                    error: function (xhr) {
                        commonObj.btnDesEnb("#activeBtn","ACTIVATE",'enb');
                    },
                    complete: function () {
                        i--;
						commonObj.btnDesEnb("#activeBtn","ACTIVATE",'enb');
                        if (i <= 0) {
                            $("#cover-spin").hide(0);
                        }
                    }
                });
			} else {
				commonObj.messages('error',"Please fill all required field.");
				$(".ajax-error").html("Please fill all required field.");
				$(".ajax-error").show();
				return false;
			}
			
		});
		
		});
   var timer2 = "{{$loginUser->diffMinutes}}";
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

<!-- The Modal -->
<div class="modal fade custom-modal " id="activeModel">
    <div class="modal-dialog">
        <div class="modal-content">      
            <!-- Modal Header -->
            <div class="modal-header">          
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <div class="register-card-wrapper">
		<div class="register-card">
			<div class="register-card-header">
				<h1 class="heading">Activate account</h1>
				<p>Enter the 6 digit code send to your mobile number </p>
			</div>
			<form>
				<div class="register-card-body">
				 <div class="ajax-error" style="display:none"></div>
				 <div class="form-group mb-3">
					 <div class="input-group">
						 <div class="input-group-prepend">
                        <span class="input-group-text"> +{{ $loginUser->sessionUser->userData->country }} </span>
                    </div>	
						<input type="text" id="mobile" name="mobile" class="mobile-number-input form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" value="{{ old('mobile', $loginUser->sessionUser->userData->mobile) }}" placeholder="{{ __('Mobile') }}" data-validation="required length number" data-validation-length="10-15" readonly="readonly">
						
						 <input type="hidden" id="phone_code" name="phone_code" value="{{ $loginUser->sessionUser->userData->country }}"/>
						  <input type="hidden" name="old_mobile_number" id="old_mobile_number" value="{{$loginUser->sessionUser->userData->mobile}}">
						  
						<input type="hidden" id="user_id" value="{{$loginUser->sessionUser->id}}">
					    <input type="hidden" name="mobile_number_type" id="mobile_number_type" value="old">
					    <input type="hidden" name="sendedOtp" id="sendedOtp" value="{{($loginUser->diffMinutes  != '00:00' ? 1 : 0)}}">
					</div>
					  
						<small class="form-text">Your Mobile number in our record</small>
					</div>
					<div class="form-group mb-3">
						 <input type="password" name="otp" id="otp" class="form-control {{ $errors->has('otp') ? 'is-invalid' : '' }}" placeholder="{{ __('x x x x x x') }}" data-validation="required length" data-validation-length="6">
					  <small class="form-text">Enter verification code </small>
					</div>
					
					<div class="form-group mb-3">
                
						<h4 class=" text-center text-info countdown">@if($loginUser->diffMinutes  != '00:00') Time Left - {{Config::get('constants.OTP_TIME_LEFT')}} @endif </h4>
				
					</div>
			
				</div>
				<div class="register-card-footer">
					<button type="button" class="btn btn-primary w-100 otp-ajax-submit" id="activeBtn">ACTIVATE</button>
					 <p class="login-text mt-4">or <a href="javascript:void(0)" id="reSendOtpLink" class="reSendOtp">Request code again</a><br> if you don't receive it after 5 mins</p>
				</div>
				
			</form>			
		</div>
		
		<div class="register-note d-none">
			<strong>Notice Info:</strong>The activation code will be sent via SMS. Please use the number you are activating the account with to request acess from your school.
		</div>
	</div>
			</div>
		</div>
    </div>
</div>
    

