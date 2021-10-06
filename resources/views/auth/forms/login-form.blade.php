<form action="{{ route('login') }}" method="post">
	{{ csrf_field() }}
	
	<div class="register-card-body"> 
		@includeif('backend.message')
		<div class="form-group mb-3">
			<input name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" value="{{ old('username') }}" placeholder="{{ __('Username') }}">
			@if ($errors->has('username'))
				<div class="invalid-feedback">
					{{ $errors->first('username') }}
				</div>
			@endif
		</div>

		<div class="form-group mb-3">
			<input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('Password') }}">
			@if ($errors->has('password'))
				<div class="invalid-feedback">
					{{ $errors->first('password') }}
				</div>
			@endif
		</div>
		
	</div>

	<div class="register-card-footer">
		<button type="submit" class="btn btn-primary btn-block btn-flat">
			{{ __('Login') }}
		</button>
		
		<p class="login-text text-left mt-1">
			<a href="{{ route('password.update') }}" class="text-dark">
				{{ __('Forgot Admin Password?') }}
			</a>
		</p>
	</div>
</form>