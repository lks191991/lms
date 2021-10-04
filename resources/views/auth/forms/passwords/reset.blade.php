<form action="{{ route('password.update') }}" method="post">
	{{ csrf_field() }}
	<input type="hidden" name="token" value="{{ $token }}">
	
	<div class="register-card-body">
		<div class="form-group">
			<div class="input-group">
				<input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email', $email) }}" placeholder="{{ __('E-Mail Address') }}"  data-validation="required email length" data-validation-length="1-255" readonly />
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-envelope"></span>
					</div>
				</div>
			</div>
			@if ($errors->has('email'))
				<div class="invalid-feedback" style="display:block">{!! $errors->first('email') !!}</div>
			@endif
		</div>
		<div class="form-group">
			<div class="input-group">
				<input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('Password') }}" data-validation="required length custom" data-validation-length="min8" data-validation-regexp="^(?=.*[\w])(?=.*[\W])[\w\W]{8,}$" data-validation-error-msg-custom="Password contains <ul><li>At least one lowercase</li><li>At least one digit</li><li>At least one special character</li><li>At least it should have 8 characters long</li></ul>">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-lock"></span>
					</div>
				</div>
			</div>
			@if ($errors->has('password'))
				<div class="invalid-feedback" style="display:block">{!! $errors->first('password') !!}</div>
			@endif
		</div>
		<div class="form-group">
			<div class="input-group">
				<input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
					   placeholder="{{ __('Confirm Password') }}" data-validation="required length confirmation" data-validation-length="min8"  data-validation-confirm="password" data-validation-error-msg-confirmation="The Confirmation Password must match your Password">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-lock"></span>
					</div>
				</div>
			</div>
			@if ($errors->has('password_confirmation'))
				<div class="invalid-feedback" style="display:block">{!! $errors->first('password_confirmation') !!}</div>
			@endif
		</div>
	</div>
	<div class="register-card-footer">
		<button type="submit" class="btn btn-primary btn-block btn-flat mb-3">
			{{ __('Reset Password') }}
		</button>
	</div>
</form>