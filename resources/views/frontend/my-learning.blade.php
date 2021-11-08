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
							<span class="mx-2">></span>My Learning
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- Breadcrumbs Ends-->

	<!-- Product Listing -->

	<section class="user-dashboard section-padding">
		<div class="container">
			<div class="row gx-lg-5">
				@include('frontend.includes.side')
				<div class="col-lg-8">
					<div class="dashboard-main-content mt-lg-0 mt-5">
						<div class="section-title">
							<h1 class="section-heading with-bottom-line text-center">My Learning List</h1>
						</div>
						<div class="dashboard-detail-outer my-courses">
							<div class="row mt-0">
							@foreach($data as $dt)
								<div class="col-lg-6 col-md-6">
									<div class="product-block">
										<div class="product-thumbnail">
											<img src="{{ asset($dt->subject->banner_image)}}" alt="product" />
										</div>
										<div class="product-content">
											<h3>{{$dt->subject->subject_name}}</h3>
											
											<div class="view-product-detail mt-3 mb-2">
												<a href="{{route('frontend.mylearningStart',['id'=> $dt->id,'subjectId'=>$dt->subject_id])}}" class="btn btn-primary w-100">Start</a>
											</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="pagination-block mt-md-5 mt-4">
					<nav aria-label="...">
						{{ $data->links() }}
					</nav>
				</div> 
				
			</div>
		</div>
	</section>


	<!-- Product Listing Ends-->


@endsection