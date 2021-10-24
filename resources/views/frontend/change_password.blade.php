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
							<h1 class="section-heading with-bottom-line text-center">Change Password</h1>
						</div>
						<div class="dashboard-detail-outer pt-4">
							<form  action="{{route('frontend.changePasswordSave')}}" id="updateForm" class="" method="post" enctype="multipart/form-data">
                            @csrf
								<div class="form-group mb-4">
									
										<div class="col-md-12">
											<label class="form-label">Current Password</label>
											<input type="password" name="current_password" id="current_password" class="form-control " placeholder="current password" data-validation="required length custom" data-validation-length="min6">
											@if ($errors->has('current_password'))
											<span class="d-block link-danger errorMsg"><small>{{ $errors->first('current_password') }}</small></span>
											@endif
										</div>
										<div class="col-md-12">
											<label class="form-label">New Password</label>
											<input type="password" name="password" id="password" class="form-control " placeholder="Password" data-validation="required length custom" data-validation-length="min6">
											 @if ($errors->has('password'))
									<span class="d-block link-danger errorMsg"><small>{{ $errors->first('password') }}</small></span>
									@endif
										</div>
										<div class="col-md-12">
											<label class="form-label">Confirm Password</label>
											<input type="password" name="password_confirmation" id="password_confirmation" class="form-control " placeholder="Password confirm" data-validation="required length custom" data-validation-length="min6" >
											 @if ($errors->has('password_confirmation'))
									<span class="d-block link-danger errorMsg"><small>{{ $errors->first('password_confirmation') }}</small></span>
									@endif
										
									</div>
								</div>
							
								
								
								<div class="from-group mb-4">
									<div class="d-flex justify-content-between flex-wrap">
										<button type="submit" class="btn btn-primary">Change</button>
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