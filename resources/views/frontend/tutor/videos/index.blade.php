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
							<span class="mx-2">></span>Videos
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
							<h1 class="section-heading with-bottom-line text-center">Videos</h1>
						</div>
						<div class="dashboard-detail-outer pt-4 payment-history">
							<div class="row">
								<div class="col-md-12">
									<div class="add-payment-history text-end mb-3">
										<a class="btn btn-primary" href="{{route('frontend.video.create')}}">Add</a>
									</div>
								</div>
							</div>
							<div class="table-responsive">
								<table class="table custom-table mt-4">
									<thead>
										<tr>
											<th scope="col">Date</th>
											<th scope="col">Course</th>
											<th scope="col">Class</th>
											<th scope="col">Subject</th>
											<th scope="col">Title</th>
											<th class="col">Status</th>
											<th class="col">Action</th>
										</tr>
									</thead>
									<tbody>
									@foreach($videos as $video)
									
										<tr>
											<td >{{ \Carbon\Carbon::parse($video->created_at)->format('d-M-Y')}}</td>
											  <td>{{$video->course->name}}</td>
                    <td>{{$video->classDetail->class_name}}</td>
                    <td>{{$video->subject->subject_name}}</td>
                    <td>
                        <p><strong>{{$video->getTitleAttribute()}}</strong></p>
                    </td>
                    <td>{{$video->status ? 'Active':'Pending'}}</td>
					<td>
												<a href ="{{route('frontend.video.edit', $video->uuid)}}"  title="Edit"><button class="btn btn-sm edit-btn"><i class="fas fa-edit"></i></button>
												</a><form method="POST" action="{{route('frontend.video.destroy', $video->id)}}" style="display: inline-block;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
<button class="btn btn-sm delete-btn" type="submit" onclick="return confirm('You are about to delete this record?')"><i class="far fa-trash-alt" ></i></button>


                        </form>
											</td>
											
										</tr>
										
										@endforeach
									</tbody>
								</table>
								
							</div>
							<div class="row">
								<div class="pagination-block mt-md-5 mt-4">
									<nav aria-label="...">
										{{ $videos->links() }}
									</nav>
								</div> 
				
			</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection