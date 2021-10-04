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
		<div class="row">
			<!--<div class="col-12">
					<div class="icheck-primary">
							<input type="checkbox" name="remember_me" id="remember_me">
							<label for="remember_me">{ __('Remember Me') }}</label>
					</div>
			</div>-->
		</div>
	</div>

	<div class="register-card-footer">
		<button type="submit" class="btn btn-primary btn-block btn-flat">
			{{ __('Login') }}
		</button>
		<p class="mt-2 mb-2 text-center">or register if you dont have an account</p>

		<p class="mb-0">
			<a href="{{ route('register') }}" class="btn btn-secondary btn-block btn-flat">Register</a>
		</p>
		<p class="login-text text-left mt-1">
			<a href="{{ route('password.update') }}" class="text-dark">
				{{ __('Forgot Your Password?') }}
			</a>
		</p>
	</div>
</form>