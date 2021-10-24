<div class="card login-form">
    <div class="card-body">
        <h3 class="card-title text-center">Reset Password</h3>
        <div class="card-text">
<form action="{{ route('password.email') }}" method="post">
	{{ csrf_field() }}
	
	<div class="register-card-body">
		@includeif('frontend.message')
			<div class="form-group mb-4">
								<label class="form-label">Email</label>
									<input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" data-validation="required email length" data-validation-length="max255">
									@if ($errors->has('email'))
									<span class="d-block link-danger errorMsg"><small>{{ $errors->first('email') }}</small></span>
									@endif

							</div>
		
	</div>
	<div class="register-card-footer">
		<button type="submit" class="btn btn-primary btn-block btn-flat mb-3">
			{{ __('Send Password Reset Link') }}
		</button>
		
		<p class="mb-0">
		<a href="{{ url('/login') }}" class="link text-decoration-underline">{{ __('Back to login') }}</a>
		</p>
	</div>
</form>

 </div>
    </div>
</div>
