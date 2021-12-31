@extends('frontend.layouts.app')
@section('styles')
<link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css" />
<style>
    #video_player_box{
        --plyr-video-controls-background: linear-gradient(rgba(255, 255, 255, 0.8),rgba(220, 220, 220, 0.8)) ;
        --plyr-video-control-color: #333333; 
        height: 500px;
    }
    .plyr--video .plyr__controls{
        padding-top: 15px !important;
    }
</style>
@endsection

@section('scripts')


<script src="https://cdn.plyr.io/3.6.2/plyr.js"></script>
<script>
    const player = new Plyr('#video_player_box',{
        settings: ['captions', 'quality', 'speed', 'loop'],        
      });
      
      player.on('ended', event => {
        player.restart();
      });
</script>
@endsection
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
							<span class="mx-2">></span>{{$subject->subject_name}}
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- Breadcrumbs Ends-->

	<section class="product-detail-main py-5">
		<div class="container">
			<div class="row gx-lg-5">
				<div class="col-lg-8">
				<div class="course-product-block lesson-video" id="video_player_box">
					<iframe class="bg-dark" src="{{$video->video_url}}?byline=false"  id="videoPlayer" width="100%" height="500"  frameborder="0" allow="autoplay; fullscreen"  allowfullscreen></iframe>
					
						
					</div>

					<div class="product-detail-block mt-5">
						<div class="custom-tabbing">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item" role="presentation">
									<button class="nav-link active" id="home-tab" data-bs-toggle="tab"
										data-bs-target="#home" type="button" role="tab" aria-controls="home"
										aria-selected="true">Descriptions</button>
								</li>
								
							</ul>
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="home" role="tabpanel"
									aria-labelledby="home-tab">
									<div class="tabbing-block">
										<p class="description">{{$course->description}}</p>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="product-details-action-btn-block">
						<h2 class="section-heading">Course content</h2>
						<div class="accordion mt-4" id="accordionExample">
						@foreach($subject->topics as $key1 => $topic)
							
							<div class="accordion-item">
								<h2 class="accordion-header" id="heading{{$key1}}">
									<button class="accordion-button" type="button" data-bs-toggle="collapse"
										data-bs-target="#collapse{{$key1}}" aria-expanded="true" aria-controls="collapseOne">
										{{$topic->topic_name}}
									</button>
								</h2>
								<div id="collapse{{$key1}}" class="accordion-collapse collapse @if($key1==$tab)show @endif"
									aria-labelledby="headingOne" data-bs-parent="#accordionExample">
									<div class="accordion-body">
										<ul class="mb-0 my-courses-cont-link">
										@foreach($topic['videos'] as $key => $video)
										@if($video->video_upload_type=='main')
											<li>
												<a href="{{route('frontend.mylearningStart',['id'=> $data->id,'subjectId'=>$video->subject_id,'videoUid'=>$video->uuid,'tab'=>$key1])}}" class="link">{{$video->title}}</a>
											</li>
											@endif
											@endforeach
										</ul>
									</div>
								</div>
							</div>
						
						@endforeach	
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


@endsection
