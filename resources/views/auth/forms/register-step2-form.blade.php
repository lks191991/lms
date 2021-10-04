<div class="successfully-activated" style="display:none">
    <div class="register-card-header text-center successful">
        <h1 class="heading">Activated.!</h1>				
    </div>			
    <div class="register-card-body text-center successful">
        <i class="far fa-thumbs-up"></i>

    </div>
    <div class="register-card-footer">
        <p class="login-text mt-4">Your account was successfully activated.</p>
    </div>	
</div>

<div class="hide-activate-account">
    <form action="{{ route('registerStep2') }}" method="post" id="registerForm">
        {{ csrf_field() }}
        <div class="register-card-body">
            <div class="ajax-error" style="display:none"></div>
            <div class="form-group mb-3">
                <input type="hidden" id="phone_code" name="phone_code" value="{{ $sessionUser->userData->country }}"/>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> +{{ $sessionUser->userData->country }} </span>
                    </div>
                    <input type="hidden" name="old_mobile_number" id="old_mobile_number" value="{{$sessionUser->userData->mobile}}">
                    <input type="text" id="mobile" name="mobile" class="mobile-number-input form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" value="{{ old('mobile', $sessionUser->userData->mobile) }}" placeholder="{{ __('Mobile') }}" data-validation="required length number" data-validation-length="10-15" readonly="readonly">
                </div>

                @if($errors->has('mobile'))
                <div class="invalid-feedback" style="display:block">{{ $errors->first('mobile') }}</div>
                @else
                <small class="form-text">{{ "Your Mobile number on record" }} <a href='javascript:void(0)' class="change-mobile-number">change</a></small>
                @endif
            </div>

            <div class="form-group mb-3">
                <input type="password" name="otp" id="otp" class="form-control {{ $errors->has('otp') ? 'is-invalid' : '' }}" placeholder="{{ __('x x x x x x') }}" data-validation="required length" data-validation-length="6">

                @if ($errors->has('otp'))
                <div class="invalid-feedback" style="display:block">{!! $errors->first('otp') !!}</div>
                @else
                <small class="form-text">{{ "Enter verification code" }}</small>
                @endif
            </div>
			
			 <div class="form-group mb-3">
                
				<h4 class=" text-center text-info countdown">@if($diffMinutes  != '00:00') Time Left - {{Config::get('constants.OTP_TIME_LEFT')}} @endif </h4>
				
            </div>
        </div>
        <input type="hidden" id="user_id" value="{{$sessionUser->id}}">

        <div class="register-card-footer">
            <button type="button" class="btn btn-primary w-100 otp-ajax-submit">{{ __('ACTIVATE') }}</button>
            <button type="button" class="btn btn-primary w-100 reSendOtp" style="display:none;">{{ __('REQUEST CODE') }}</button>
            <input type="hidden" name="mobile_number_type" id="mobile_number_type" value="old">
            <p class="login-text mt-4">or <a href="javascript:void(0)" class="reSendOtp">Request code again</a><br> if you don't receive it after 5 mins</p>
        </div>
<!--        <div class="register-card-skip">
            <a href="{{ route('registerStep', 3) }}">or Skip to activate later</a>
        </div>-->
    </form>
</div>