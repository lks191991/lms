<form action="{{ $login_url }}" method="post">
    {{ csrf_field() }}
	
	<div class="form-group mb-3">
		<input name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" value="{{ old('username') }}" placeholder="{{ __('Username') }}" autofocus>
		@if ($errors->has('username'))
			<div class="invalid-feedback">
				{!! $errors->first('username') !!}
			</div>
		@endif
	</div>
	
	<div class="form-group mb-3">
		<input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('adminlte::adminlte.password') }}">
		@if ($errors->has('password'))
			<div class="invalid-feedback">
				{!! $errors->first('password') !!}
			</div>
		@endif
	</div>
	<div class="row">
		<!--<div class="col-12">
			<div class="icheck-primary">
				<input type="checkbox" name="remember_me" id="remember_me">
				<label for="remember_me">{{ __('adminlte::adminlte.remember_me') }}</label>
			</div>
		</div>-->
		
		<div class="col-12">
			<button type="submit" class="btn btn-primary btn-block btn-flat">
				{{ __('Login') }}
			</button>
		</div>
	</div>
</form>
<p class="mt-2 mb-2 text-center">or register if you dont have an account</p>
@if ($register_url)
<p class="mb-0">
    <a href="{{ $register_url }}" class="btn btn-secondary btn-block btn-flat">Register</a>
</p>
@endif

<p class="mt-2 mb-1">
	<a href="{{ $password_reset_url }}" class="text-dark">
		{{ __('adminlte::adminlte.i_forgot_my_password') }}
	</a>
</p>