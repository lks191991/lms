<div class="card login-form">
    <div class="card-body">
        <h3 class="card-title text-center">Reset Password</h3>
        <div class="card-text">
<form action="{{ route('password.update') }}" method="post">
	{{ csrf_field() }}
	<input type="hidden" name="token" value="{{ $token }}">
	
	<div class="register-card-body">
	@includeif('frontend.message')
		<div class="form-group mb-4">
								<label class="form-label">Email</label>
									<input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email', $email) }}" placeholder="{{ __('E-Mail Address') }}"  data-validation="required email length" data-validation-length="1-255" readonly />
									@if ($errors->has('email'))
									<span class="d-block link-danger errorMsg"><small>{{ $errors->first('email') }}</small></span>
									@endif

							</div>
	
		<div class="form-group mb-4">
								<label class="form-label">Password</label>
								 <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('Password') }}" data-validation="required length custom" data-validation-length="min8" data-validation-regexp="^(?=.*[\w])(?=.*[\W])[\w\W]{8,}$" data-validation-error-msg-custom="Password contains <ul><li>At least one lowercase</li><li>At least one digit</li><li>At least one special character</li><li>At least it should have 8 characters long</li></ul>">
								   @if ($errors->has('password'))
									<span class="d-block link-danger errorMsg"><small>{{ $errors->first('password') }}</small></span>
									@endif
							</div>
							<div class="form-group mb-4">
								<label class="form-label">Confirm password</label>
									<input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
					   placeholder="{{ __('Confirm Password') }}" data-validation="required length confirmation" data-validation-length="min8"  data-validation-confirm="password" data-validation-error-msg-confirmation="The Confirmation Password must match your Password">
									  @if ($errors->has('password_confirmation'))
									<span class="d-block link-danger errorMsg"><small>{{ $errors->first('password_confirmation') }}</small></span>
									@endif
							</div>
							
		
	</div>
	<div class="register-card-footer">
		<button type="submit" class="btn btn-primary btn-block btn-flat mb-3">
			{{ __('Reset Password') }}
		</button>
	</div>
</form>


 </div>
    </div>
</div>