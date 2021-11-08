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
							<span class="mx-2">></span>All courses
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- Breadcrumbs Ends-->

	<!-- Product Listing -->

	<section class="product-listing section-padding less-padding">
		<div class="container">
			<div class="row">
			@foreach($allCourses as $subject)
				<div class="col-lg-3 col-md-6">
					<div class="product-block">
						<div class="product-thumbnail">
							<img src="{{ asset($subject->banner_image)}}" alt="product" />
						</div>
						<div class="product-content">
							<h3>{{$subject->subject_name}}</h3>
							<ul class="p-0 mt-0 list-unstyled d-flex rating-stars">
								<li>
									<i class="fas fa-star"></i>
								</li>
								<li>
									<i class="fas fa-star"></i>
								</li>
								<li>
									<i class="fas fa-star"></i>
								</li>
								<li>
									<i class="fas fa-star"></i>
								</li>
								<li>
									<i class="far fa-star"></i>
								</li>
							</ul>
							<div class="price">
								<span class="regular-price"><i class="fas fa-rupee-sign"></i>{{$subject->subject_price}}</span>
							</div>
							<div class="view-product-detail mt-3 mb-2">
								<a href="{{route('course-details',['subjectId'=>$subject->id])}}" class="btn btn-primary w-100">View</a>
							</div>
						</div>
					</div>
				</div>
				@endforeach
				
			</div>
			<div class="row">
				<div class="pagination-block mt-md-5 mt-4">
					<nav aria-label="...">
						{{ $allCourses->links() }}
					</nav>
				</div> 
				
			</div>
		</div>
	</section>

	<!-- Product Listing Ends-->


@endsection