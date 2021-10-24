<form action="{{ route('login') }}" method="post">
		{{ csrf_field() }}
		<div class="form-group mb-4">
								@includeif('frontend.message')
							</div>
							<div class="form-group mb-4">
								<label class="form-label">Email</label>
									<input name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ __('Email') }}">
									@if ($errors->has('email'))
									<span class="d-block link-danger errorMsg"><small>{{ $errors->first('email') }}</small></span>
									@endif

							</div>
							<div class="from-group mb-4">
								<label class="form-label">Password</label>
								<input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('Password') }}">
								@if ($errors->has('password'))
									<span class="d-block link-danger errorMsg"><small>{{ $errors->first('password') }}</small></span>
									@endif
								<div class="forgot-password"><a href="{{route('password.request')}}" class="link text-decoration-underline">Forgot
										Password?</a></div>
							</div>
							<div class="from-group mb-4">
								<button type="submit" class="btn btn-primary">Login</button>
							</div>
							<div class="from-group mb-4">
								<div class="didnt-have-account">
									Didn't have an account? <a href="{{route('register')}}" class="link text-decoration-underline">Click
										here to
										create</a>
								</div>
							</div>
						</form>

