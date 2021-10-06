<form action="{{ route('password.email') }}" method="post">
	{{ csrf_field() }}
	
	<div class="register-card-body">
		@includeif('backend.message')
		<div class="form-group">
			<div class="input-group mb-3">
				<input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" data-validation="required email length" data-validation-length="max255">
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
	</div>
	<div class="register-card-footer">
		<button type="submit" class="btn btn-primary btn-block btn-flat mb-3">
			{{ __('Send Password Reset Link') }}
		</button>
		
		<p class="mb-0">
			<a href="{{ url('/admin') }}" class="btn btn-secondary btn-block btn-flat">{{ __('Back to login') }}</a>
		</p>
	</div>
</form>