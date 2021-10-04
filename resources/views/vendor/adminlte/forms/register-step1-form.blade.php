<form action="{{ route('register') }}" method="post" id="registerForm">
	{{ csrf_field() }}
	
	<div class="form-group mb-3">
		<input type="text" name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" value="{{ old('username') }}" placeholder="{{ __('Username') }}" data-validation="required length custom" data-validation-length="4-255" data-validation-regexp="^(?=.*[a-z])[a-zA-Z0-9]{4,}$" data-validation-error-msg-custom="Username contains <li>At least one lowercase</li>" autofocus />
		
		@if ($errors->has('username'))
			<div class="invalid-feedback" style="display:block">
				<strong>{!! $errors->first('username') !!}</strong>
			</div>
		@else
			<span class="small text-primary">{{ "Your unique nickname" }}</span>
		@endif
	</div>
	
	<div class="form-group mb-3">
		<input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('Password') }}" data-validation="required length custom" data-validation-length="min8" data-validation-regexp="^(?=.*[\w])(?=.*[\W])[\w\W]{8,}$" data-validation-error-msg-custom="Password contains <li>At least one lowercase</li><li>At least one digit</li><li>At least one special character</li><li>At least it should have 8 characters long</li>.">
		
		@if ($errors->has('password'))
			<div class="invalid-feedback" style="display:block">
				<strong>{!! $errors->first('password') !!}</strong>
			</div>
		@else
			<span class="small text-primary">{{ "Use a password you can easily remember" }}</span>
		@endif
	</div>
	
	<div class="form-group mb-3">
		<input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ __('Email') }}" data-validation="email length" data-validation-length="max255" data-validation-optional="true">
		
		@if ($errors->has('email'))
			<div class="invalid-feedback" style="display:block">
				<strong>{{ $errors->first('email') }}</strong>
			</div>
		@else
			<span class="small text-primary">{{ "Where you want excercies file sent to" }}</span>
		@endif
	</div>
	
	@php
		$countries = App\Models\Countries::select('name','phonecode')->get();
	@endphp
	
	<div class="form-group mb-3">
		<input type="hidden" id="mobileVerify" name="mobileVerify" value="0"/>
		<div class="input-group">
			<div class="input-group-prepend w-25">
				<select class="input-group-text" id="phone_code" name="phone_code" style="width:100%">
					@if($countries->count() > 0)	
						@foreach($countries as $country)	
							<option value="{{$country->phonecode}}" {{ ($country->phone_code == old('phone_code')) ? 'selected = "selected"' : '' }}>{{ $country->name}}</option>
						@endforeach
					@endif
				</select>
			</div>
			
			<input type="number" id="mobile" name="mobile" class="form-control w-75 {{ $errors->has('mobile') ? 'is-invalid' : '' }}" value="{{ old('mobile') }}" placeholder="{{ __('Mobile') }}" data-validation="required length number" data-validation-length="10-15">
		</div>
		
		@if ($errors->has('mobile'))
			<div class="invalid-feedback" style="display:block">
				<strong>{{ $errors->first('mobile') }}</strong>
			</div>
		@else
			<span class="small text-primary">{{ "Please make sure its active, a code will be sent for activation" }}</span>
		@endif
	</div>
	
	<button type="submit" class="btn btn-primary btn-block">
		{{ __('adminlte::adminlte.register') }}
	</button>
</form>
<p class="mt-2 mb-1 text-center">
    or <a href="{{ route('login') }}">Login</a> if you dont have an account
</p>