@extends('frontend.layouts.app')

@section('content')

<!-- Breadcrumbs -->

	<section class="breadcrumbs bg-light py-3">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="m-0 p-0 list-unstyled d-flex flex-wrap">
						<li>
							<a href="/">Home</a>
						</li>
						<li>
							<span class="mx-2">></span>Thank You
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- Breadcrumbs Ends-->
  <!-- Thank You Section -->

    <section class="thankyou-section section-padding border-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="thankyou-block p-4 border border-success text-center rounded-2">
                        <h1 class="section-heading text-success">Thank You !!</h1>
                        <!--<p class="decription my-4">Your payment has been successfully processed.</p>-->
						<p class="decription my-4">Your has been successfully addedd in your Learning List.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Thank You Section Ends-->
      
	@endsection
