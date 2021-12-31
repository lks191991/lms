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
							<span class="mx-2">></span>Contact Us
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- Breadcrumbs Ends-->
<!-- Contact Us -->

	<section class="contact-us-section bg-light py-4 border-top">
		<div class="container">
			<div class="white-cont-block">
				<div class="row align-items-center">
					<div class="col-md-4">
						<div class="left-side-icons">
							<ul class="m-0 p-0 list-unstyled">
								<li>
									<span><i class="fas fa-map-marker-alt"></i></span>
									<span><strong>Address</strong>
										Board of Intermediate Education,<br /> 
										Andhra Pradesh <br /> 
										D.No. 48-18-2/A, Nagarjuna Nagar Colony<br /> 
										Opp. NTR Health University,<br /> 
										Vijayawada - 520008
										Krishna District, <br /> Andhra Pradesh, India
										</span>
								</li>
								<li>
									<span>
										<i class="fas fa-phone-alt"></i>
									</span>
									<span>
										<strong>Phone</strong>
										<a href="tel:0866-2974130">0866-2974130</a>
									</span>
								</li>
								<li>
									<span>
										<i class="fas fa-envelope"></i>
									</span>
									<span>
										<strong>Email</strong>
										<a href="mailto:test@gmail.com">bieap1819@gmail.com</a>
									</span>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-md-8 border-start">
						<div class="contact-form">
							<h1 class="page_title mb-3 text-primary">Send us a message</h1>
							<p class="description mb-4"></p>
							 <form action="{{route('frontend.contactUsPost')}}" method="POST" id="registerForm" >@csrf
							
								<div class="form-group mb-3">
									<input type="text" class="w-100 form-control {{ $errors->has('your_name') ? 'is-invalid' : '' }}" name="your_name" value="{{ old('your_name') }}" data-validation="required length custom" placeholder="Enter your name"  data-validation-regexp="[a-zA-Z]">
						@if($errors->has('your_name'))
							<div class="invalid-feedback">{!! $errors->first('your_name') !!}</div>
						@endif
								</div>
								<div class="form-group mb-3">
									<input type="text" class="w-100 form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" data-validation="required length email" placeholder="Enter your email" data-validation-length="2-255" >
						@if($errors->has('email'))
							<div class="invalid-feedback">{!! $errors->first('email') !!}</div>
						@endif
								</div>
								<div class="form-group mb-3">
									<input type="text" class="w-100 form-control {{ $errors->has('mobile_number') ? 'is-invalid' : '' }}" name="mobile_number" value="{{ old('mobile_number') }}" data-validation="number required length" placeholder="Enter your contact" data-validation-length="10-15">
						@if($errors->has('mobile_number'))
							<div class="invalid-feedback">{!! $errors->first('mobile_number') !!}</div>
						@endif
								</div>
								<div class="form-group mb-3">
									<textarea class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" data-validation="required" name="message" placeholder="Type a short message here" >{{old('message')}}</textarea>
						@if($errors->has('message'))
							<div class="invalid-feedback">{!! $errors->first('message') !!}</div>
						@endif
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Contact Us Ends-->


@endsection