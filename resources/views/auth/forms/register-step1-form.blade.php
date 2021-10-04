<form action="{{ route('register') }}" method="post" id="registerForm">
	{{ csrf_field() }}
	<div class="register-card-body">                         
		@includeif('backend.message')
		<div class="form-group">
		<div class="custom-select-outer">

                <select class="custom-select" id="rejister_as" name="rejister_as" data-validation="required" >
                   	
                    <option class="d-none" value="">Register As </option>
                    <option {{ (old("rejister_as") == 'student' ? 'selected' : '') }} value="student">Student </option>
                    <option {{ (old("rejister_as") == 'tutor' ? 'selected' : '') }} value="tutor">Tutor </option>
                   
                </select>
           
        </div>
 @if ($errors->has('rejister_as'))
                <div class="invalid-feedback" style="display:block">{{ $errors->first('rejister_as') }}</div>
			@endif
        </div>

		<div class="form-group">                            
			<input type="text" name="first_name" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" value="{{ old('first_name') }}" placeholder="{{ __('First name') }}" data-validation="required length custom" data-validation-length="2-255" data-validation-regexp="[a-zA-Z]" />
        @if ($errors->has('first_name'))
			<div class="invalid-feedback">{!! $errors->first('first_name') !!}</div>
		@endif
		</div>
		
		<div class="form-group">                            
			<input type="text" name="last_name" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" value="{{ old('last_name') }}" placeholder="{{ __('Last & other names') }}" data-validation-length="2-255" data-validation-regexp="[a-zA-Z]" />
			@if ($errors->has('last_name'))
			<div class="invalid-feedback">{!! $errors->first('last_name') !!}</div>
			@else
			<small class="form-text">{{ "separate 2 or more names with spaces" }}</small>
			@endif
		</div>
		
		<div class="form-group">                            
			<input type="text" name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" value="{{ old('username') }}" placeholder="{{ __('Username') }}" data-validation="required length custom" data-validation-length="4-255"  data-validation-error-msg-custom="Username contains <li>Username can only contain characters</li>" />
			@if ($errors->has('username'))
			<div class="invalid-feedback">{!! $errors->first('username') !!}</div>
			@else
			<small class="form-text">{{ "Your unique nickname" }}</small>
			@endif
		</div>
		<div class="form-group">
			<input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('Password') }}" data-validation="required length custom" data-validation-length="min6">

			@if ($errors->has('password'))
			<div class="invalid-feedback">{!! $errors->first('password') !!}</div>
			@else
			<small class="form-text">{{ "Use a password you can easily remember" }}</small>
			@endif
		</div>
		<div class="form-group">
			<input type="password" name="password_confirmation" id="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" placeholder="{{ __('Confirm password') }}" data-validation="required length custom" data-validation-length="min6" readonly="readonly">

			@if ($errors->has('password_confirmation'))
			<div class="invalid-feedback">{!! $errors->first('password_confirmation') !!}</div>
			@else
			<small class="form-text">{{ "Enter password again to make you remember" }}</small>
			@endif
		</div>
		
		
		<div class="form-group">
			<input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ __('Email') }}" data-validation="email length" data-validation-length="max255" data-validation-optional="true">

			@if ($errors->has('email'))
			<div class="invalid-feedback">{{ $errors->first('email') }}</div>
			@else
			<small class="form-text">{{ "Where you want excercies file sent to" }}</small>
			@endif  
		</div>
		@php
		$countries = App\Models\Countries::select('name','phonecode')->get();
		@endphp
		<div class="form-group">
		<div class="custom-select-outer">	
				
					<select class="custom-select" id="phone_code" name="phone_code">
						@if($countries->count() > 0)	
						@foreach($countries as $country)	
						<option value="{{$country->phonecode}}" @if($country_details->phonecode == $country->phonecode){{"selected"}}@endif>{{ $country->name}}</option>
						@endforeach
						@endif
					</select>
				
</div>
</div>

<div class="form-group">
			<input type="hidden" id="mobileVerify" name="mobileVerify" value="0"/>
			
				<input type="text" id="mobile" name="mobile" class="form-control  {{ $errors->has('mobile') ? 'is-invalid' : '' }}" value="{{ old('mobile') }}" placeholder="{{ __('Mobile') }}" data-validation="required length number" data-validation-length="10-15">
			

			@if ($errors->has('mobile'))
			<div class="invalid-feedback" style="display:block">{{ $errors->first('mobile') }}</div>
			@else
			<small class="form-text">{{ "Please make sure its active, a code will be sent for activation" }}</small>
			@endif
		
		
            </div>

            

		
	</div>
	<div class="register-card-footer">
		<button type="submit" class="btn btn-primary w-100">REGISTER</button>
		<p class="login-text mt-4">or <a href="{{ route('login') }}" title="">Login</a> if you already have an account</p>
	</div>			
</form>