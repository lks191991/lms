@extends('frontend.layouts.app')

@section('title', 'Contact')

@section('content')
<section class="inner-banner">	
    <div class="container">            
     	<div class="caption">
          <h1 class="heading">Get in touch</h1>
           <h3 class="heading-sub-text">Reach us to get your school onto our platform We want to grow our family so come join us</h3>
      </div>
    </div>
</section>

<section class="bg-white pt-3 pb-5">
    <div class="container">			
		<div class="contact-info">
			<div class="row">
				<div class="col-sm-6">
					<div class="d-flex contact-link">
						<div class="flex-grow-0 mr-2"><i class="fas fa-phone"></i></div>
						<div class="flex-grow-1">
							<a href="tel:+2330555212020">(+233) 0555212020</a>
							<a href="tel:+2330302222179">(+233) 0302222179</a>
						</div>						
					</div>
					
				</div>
				<div class="col-sm-6">
					<div class="d-flex contact-link">
						<div class="flex-grow-0 mr-2"><i class="fas fa-envelope"></i></div>
						<div class="flex-grow-1">
							<a href="mailto:hello@dextraclass.com">hello@dextraclass.com</a>
							<a href="mailto:join@dextraclass.com">join@dextraclass.com</a>
						</div>						
					</div>
				</div>
			</div>
		</div>
		
            <div class="contact-card">
            <form action="{{route('frontend.pages.sendContact')}}" method="POST" id="registerForm" >@csrf
				<div class="row">
					<div class="col">
					<div class="form-group">
						<label for="exampleInputEmail166">Your name</label>
						<input type="text" class="form-control {{ $errors->has('your_name') ? 'is-invalid' : '' }}" name="your_name" value="{{ old('your_name') }}" data-validation="required length custom" data-validation-length="2-255" data-validation-regexp="[a-zA-Z]">
						@if($errors->has('your_name'))
							<div class="invalid-feedback">{!! $errors->first('your_name') !!}</div>
						@endif
					  </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						<label for="exampleInputEmail166">Mobile number</label>
						<input type="text" class="form-control {{ $errors->has('mobile_number') ? 'is-invalid' : '' }}" name="mobile_number" value="{{ old('mobile_number') }}" data-validation="number required length" data-validation-length="10-15">
						@if($errors->has('mobile_number'))
							<div class="invalid-feedback">{!! $errors->first('mobile_number') !!}</div>
						@endif
					  </div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						<label for="exampleInputEmail14">Email</label>
						<input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" data-validation="required length email" data-validation-length="2-255" >
						@if($errors->has('email'))
							<div class="invalid-feedback">{!! $errors->first('email') !!}</div>
						@endif
					  </div>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<div class="form-group">
						<label for="exampleInputEmail17">Message</label>
						<textarea class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" data-validation="required" name="message" placeholder="Type a short message here" >{{old('message')}}</textarea>
						@if($errors->has('message'))
							<div class="invalid-feedback">{!! $errors->first('message') !!}</div>
						@endif
					  </div>
				</div>
				</div>

				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Sending as</label>
							
							<div class="d-flex flex-wrap custom-control-card">
							<div class="custom-control custom-radio custom-control-inline my-2">
							  <input type="radio" class="custom-control-input {{ $errors->has('sending_as') ? 'is-invalid' : '' }}" {{ (old('sending_as') == 'school' || old('sending_as') == '' ? 'checked' : '')}} id="one" name="sending_as" data-validation="required" value="school">
							  <label class="custom-control-label" for="one">School</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline my-2">
							  <input type="radio" class="custom-control-input {{ $errors->has('sending_as') ? 'is-invalid' : '' }}" {{ (old('sending_as') == 'Student/Tutor' ? 'checked' : '')}}  id="two" name="sending_as">
							  <label class="custom-control-label" value="Student/Tutor" for="two">Student/Tutor</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline my-2">
							  <input type="radio" class="custom-control-input {{ $errors->has('sending_as') ? 'is-invalid' : '' }}" {{ (old('sending_as') == 'Job Applicant' ? 'checked' : '')}} id="three"  name="sending_as">
							  <label class="custom-control-label" value="Job Applicant"  for="three">Job Applicant</label>
							</div>
                                @if($errors->has('sending_as'))
									<div class="invalid-feedback">{!! $errors->first('sending_as') !!}</div>
								@endif
							</div>
							
						
						</div>
						
					</div>
				</div>

  		<div class="row mt-2">
					<div class="col"><button type="submit" class="btn btn-primary px-5">SEND MESSAGE</button></div>
				</div>

 



  
</form>






            </div>
        	
    </div>
</section>
@endsection
@section('after-styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection

@section('footer-scripts')
<script>
    $(document).ready(function(){        
//        $(".date").flatpickr({
//            inline: true
//        });        
    });
</script>
@endsection
