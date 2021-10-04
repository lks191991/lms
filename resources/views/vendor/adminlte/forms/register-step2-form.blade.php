<form action="{{ route('registerStep2') }}" method="post" id="registerForm">
	{{ csrf_field() }}
	
	<div class="form-group mb-3">
		<input type="hidden" id="mobileVerify" name="mobileVerify" value="0"/>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"> {{ auth()->user()->student->phone_code }} </span>
			</div>
			
			<input type="number" id="mobile" name="mobile" class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" value="{{ old('mobile', auth()->user()->student->mobile) }}" placeholder="{{ __('Mobile') }}" data-validation="required length number" data-validation-length="10-15">
		</div>
		
		@if($errors->has('mobile'))
			<div class="invalid-feedback" style="display:block">
				<strong>{{ $errors->first('mobile') }}</strong>
			</div>
		@else
			<span class="small text-primary">{{ "Your Mobile number on record chaneg" }}</span>
		@endif
	</div>
	
	<div class="form-group mb-3">
		<input type="password" name="otp" class="form-control {{ $errors->has('otp') ? 'is-invalid' : '' }}" placeholder="{{ __('x x x x x') }}" data-validation="required length" data-validation-length="5">
		
		@if ($errors->has('otp'))
			<div class="invalid-feedback" style="display:block">
				<strong>{!! $errors->first('otp') !!}</strong>
			</div>
		@else
			<span class="small text-primary">{{ "Enter verification code" }}</span>
		@endif
	</div>
	
	<button type="submit" class="btn btn-primary btn-block">{{ __('Activate') }}</button>
</form>
<p class="mt-2 mb-1 text-center">
	or <a href="{{ route('registerStep', 3) }}">Request code again</a><br/>
	if you don't receive it after 5 mint
</p>