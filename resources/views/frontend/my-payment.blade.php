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
							<span class="mx-2">></span>Payment History
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
							<h1 class="section-heading with-bottom-line text-center">Payment History</h1>
						</div>
						<div class="dashboard-detail-outer pt-4 payment-history">
													
							
							<div class="table-responsive">
								<table class="table custom-table mt-4">
									<thead>
										<tr>
											<th scope="col">T. ID</th>
											<th scope="col">Couse Name</th>
											<th scope="col">Amount</th>
											<th scope="col">Purchase Date</th>
										</tr>
									</thead>
									<tbody>
									@foreach($data as $dt)
										<tr>
											<th scope="row">{{$dt->payment->transaction_id}}</th>
											<td>{{$dt->subject->subject_name}}</td>
											<td>{{$dt->price}}</td>
											<td>{{ \Carbon\Carbon::parse($dt->payment->created_at)->format('d-M-Y')}}</td>
										</tr>
										@endforeach
									</tbody>
								</table>
								
							</div>
							<div class="row">
								<div class="pagination-block mt-md-5 mt-4">
									<nav aria-label="...">
										{{ $data->links() }}
									</nav>
								</div> 
				
			</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</section>


	<!-- Product Listing Ends-->


@endsection