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
							<span class="mx-2">></span>Profile
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- Breadcrumbs Ends-->
<section class="user-dashboard section-padding">
		<div class="container">
			<div class="row gx-lg-5">
				@include('frontend.includes.side')
				<div class="col-lg-8">
					<div class="dashboard-main-content mt-lg-0 mt-5">
						<div class="section-title">
							<h1 class="section-heading with-bottom-line text-center">My Profile</h1>
						</div>
						<div class="dashboard-detail-outer pt-4">
							<form  action="{{route('frontend.updateProfileStudent')}}" id="updateForm" class="" method="post" enctype="multipart/form-data">
                            @csrf
								<div class="form-group mb-4">
									<div class="row">
										<div class="col-md-6">
											<label class="form-label">First Name</label>
											<input type="text" class="form-control" name="first_name" id="first_name" value="{{ $student->userData->first_name }}"  placeholder="First name" data-validation-length="2-255" >
											@if ($errors->has('first_name'))
											<span class="d-block link-danger errorMsg"><small>{{ $errors->first('first_name') }}</small></span>
											@endif
										</div>
										<div class="col-md-6">
											<label class="form-label">Last Name</label>
											<input type="text" class="form-control" name="last_name" id="last_name" value="{{ $student->userData->last_name }}"  placeholder="First name" data-validation-length="2-255" >
											 @if ($errors->has('last_name'))
									<span class="d-block link-danger errorMsg"><small>{{ $errors->first('last_name') }}</small></span>
									@endif
										</div>
									</div>
								</div>
								<div class="from-group mb-4">
								<div class="row">
								<div class="col-md-6">
											<label class="form-label">Mobile</label>
											<input type="text" class="form-control" name="mobile" id="mobile" value="{{ $student->userData->mobile }}"  placeholder="First name" data-validation-length="2-255" >
											 @if ($errors->has('mobile'))
									<span class="d-block link-danger errorMsg"><small>{{ $errors->first('mobile') }}</small></span>
									@endif
										</div>
										<div class="col-md-6">
									<label class="form-label">Email</label>
									<input type="email" class="form-control" name="email" id="email" value="{{ $student->userData->email }}"  placeholder="Email" data-validation-length="2-255" >
									@if ($errors->has('email'))
									<span class="d-block link-danger errorMsg"><small>{{ $errors->first('email') }}</small></span>
									@endif
								</div>
								</div>
								</div>
								<div class="from-group mb-4">
									<div class="row">
										<div class="col-md-6">
											<label class="form-label">Country</label>
											 <select class="form-select" id="country" name="country">
							  <option class="text-white bg-warning">
								Select Country
							  </option>
							  @foreach($countries as $country)
							  <option value="{{$country->id}}" @if($student->userData->country==$country->id) selected @endif>
							   {{$country->name}}
							  </option>
							 @endforeach
							</select>
										</div>
									</div>
								</div>
								
								<div class="from-group mb-4">
									<div class="d-flex justify-content-between flex-wrap">
										<button type="submit" class="btn btn-primary">Save</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection