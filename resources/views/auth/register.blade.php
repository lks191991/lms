@extends('frontend.layouts.app')

@section('content')
<!-- Breadcrumbs -->

	<section class="breadcrumbs bg-light py-3">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="m-0 p-0 list-unstyled d-flex flex-wrap">
						<li>
							<a href="#">Home</a>
						</li>
						<li>
							<span class="mx-2">></span>Sign Up
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
<section class="login-signup-main main-login section-padding">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 mx-auto">
					<div class="login-signup-form-block">
						<h1 class="text-uppercase text-center mb-5">Sign Up</h1>
						<form action="{{ route('register') }}" id="registerForm" method="post">
			{{ csrf_field() }}
							<div class="form-group mb-4">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" @if(old('rejister_as')=='tutor') checked @endif value="tutor" name="rejister_as" id="signupTutor"
										value="option1" checked />
									<label class="form-check-label" for="signupTutor">Signup as Tutor</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" @if(old('rejister_as')=='student') checked @endif value="student" name="rejister_as" id="signupStudent"
										value="option2" />
									<label class="form-check-label" for="signupStudent">Signup as Student</label>
								</div>
								@if ($errors->has('rejister_as'))
									<span class="d-block link-danger errorMsg"><small>{{ $errors->first('rejister_as') }}</small></span>
									@endif
								
							</div>
							<div class="form-group mb-4">
								<label class="form-label">First name</label>
								<input type="text" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" value="{{old('first_name')}}" id="first_name" name="first_name" placeholder="First name">
								@if ($errors->has('first_name'))
									<span class="d-block link-danger errorMsg"><small>{{ $errors->first('first_name') }}</small></span>
									@endif
							</div>
							<div class="form-group mb-4">
								<label class="form-label">Last name</label>
								 <input type="text" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" value="{{old('last_name')}}" id="last_name" name="last_name" placeholder="Last name">
								 @if ($errors->has('last_name'))
									<span class="d-block link-danger errorMsg"><small>{{ $errors->first('last_name') }}</small></span>
									@endif
							</div>
							<div class="form-group mb-4">
								<label class="form-label">Email</label>
								<input type="email" class="form-control  {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" value="{{old('email')}}" name="email" aria-describedby="emailHelp" placeholder="Email">
								 @if ($errors->has('email'))
									<span class="d-block link-danger errorMsg"><small>{{ $errors->first('email') }}</small></span>
									@endif
							</div>
							<div class="form-group mb-4">
								<label class="form-label">Password</label>
								  <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" name="password" placeholder="Password">
								   @if ($errors->has('password'))
									<span class="d-block link-danger errorMsg"><small>{{ $errors->first('password') }}</small></span>
									@endif
							</div>
							<div class="form-group mb-4">
								<label class="form-label">Confirm password</label>
									<input type="password" name="password_confirmation" id="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" placeholder="{{ __('Confirm password') }}" data-validation="required length custom" data-validation-length="min6" >
									  @if ($errors->has('password_confirmation'))
									<span class="d-block link-danger errorMsg"><small>{{ $errors->first('password_confirmation') }}</small></span>
									@endif
							</div>
							<div class="form-group mb-4">
								<label class="form-label">Subjects</label>
								 <input type="text" class="form-control {{ $errors->has('tutor_subject') ? 'is-invalid' : '' }}" value="{{old('tutor_subject')}}" id="tutor_subject" name="tutor_subject" placeholder="Subject">
							</div>
							<div class="form-group mb-4">
								<label class="form-label">Country</label>
							  <select class="form-select" id="country" name="country">
							  <option class="text-white bg-warning">
								Select Country
							  </option>
							  @foreach($countries as $country)
							  <option value="{{$country->id}}">
							   {{$country->name}}
							  </option>
							 @endforeach
							</select>
							</div>
							<div class="form-group mb-4">
								<button type="submit" class="btn btn-primary">Sign Up</button>
							</div>
							<div class="from-group mb-4">
								<div class="didnt-have-account">
									Already have an account? <a href="{{route('login')}}" class="link text-decoration-underline">Login
										here</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Breadcrumbs Ends-->

@stop