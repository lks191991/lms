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
							<span class="mx-2">></span>Login
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- Breadcrumbs Ends-->
	
<!-- Login Main -->

	<section class="login-signup-main main-login section-padding">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 mx-auto">
					<div class="login-signup-form-block">
						<h1 class="text-uppercase text-center mb-5">Login</h1>
						@includeif('auth.forms.login-form')
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Login Main Ends-->

</section>



@endsection