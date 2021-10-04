@extends('backend.layouts.layout-3')

@section('content')

<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- Header -->
    <div class="container-m-nx container-m-ny bg-white mb-4">
	<div class="row">
			<div class="col-md-10">
        <div class="media col-md-10 col-lg-8 col-xl-7 py-5 mx-auto">
		@if(!empty($tutor->getProfileOrAvatarImageAttribute()))
			<img class="school_logo mb-2 d-block" style="max-width:150px;min-width: 135px;" src="{{url($tutor->getProfileOrAvatarImageAttribute())}}"  />
		@else
		<img class="school_logo mb-2 d-block" style="max-width:150px;min-width: 135px;" src="{{url('images/default_tutor_manager.png')}}"  />
		@endif
           <div class="media-body ml-5">
                <h4 class="font-weight-bold mb-2">{{$tutor->getFullNameAttribute()}}</h4>
                <div class="text-muted mb-2">
					@if(isset($tutor->school->school_name) && !empty($tutor->school->school_name))
						<strong>School Name:</strong> <a href="{{route('backend.school.show',$tutor->school_id)}}" class="text-body">{{$tutor->school->school_name}}</a>
					@endif
				</div>
				<div class="text-muted mb-2">
					<ul class="profile-achievement list-unstyled">
                                <li>
                                    <span class="icon"><img src="{{asset('images/icon-eye.png')}}" alt=""></span>
                                    <span class="text">{{$classesHosted}}	Classes hosted</span>
                                </li>
                                <li>
                                    <span class="icon"><img src="{{asset('images/icon-notes.png')}}" alt=""></span>
                                    <span class="text">{{$noteAdded}} Lecture notes added</span>
                                </li>
                                <li>
                                    <span class="icon"><img src="{{asset('images/icon-question.png')}}" alt=""></span>
                                    <span class="text">{{$questionsAsked}} Questions asked</span>
                                </li>
                                <li>
                                    <span class="icon"><img src="{{asset('images/icon-tick.png')}}" alt=""></span>
                                    <span class="text">{{$replyCount}} Answers contributed</span>
                                </li>
                    </ul>
				</div>
            </div>
        </div>
		</div>
			 <div class="col-md-2 ml-10 mt-5"><a href="javascript:void(0)" onclick="window.history.go(-1); return false;" class="btn btn-primary rounded-pill d-block detail-back-btn">Back</a></div>
			 </div>
        <hr class="m-0">
    </div>
    <!-- Header -->
  
   <div class="row">
              <div class="col">

                <!-- Info -->
                <div class="card mb-4">
                  <div class="card-body">

                    <div class="row mb-2">
                      <div class="col-md-3 text-muted">Email:</div>
                      <div class="col-md-9">
                       {{$tutor->email}}
                      </div>
                    </div>

                    <div class="row mb-2">
                      <div class="col-md-3 text-muted">Mobile:</div>
                      <div class="col-md-9">
                        {{$tutor->mobile}}
                      </div>
                    </div>
					
					<div class="row mb-2">
                      <div class="col-md-3 text-muted">Subject:</div>
                      <div class="col-md-9">
                        {{isset($tutor->tutor_subject)?$tutor->tutor_subject:'N/A'}}
                      </div>
                    </div>

                   <div class="row mb-2">
                      <div class="col-md-3 text-muted">Country:</div>
                      <div class="col-md-9">
                        @if(isset($tutor->country_name->name) && !empty($tutor->country_name->name))
							{{$tutor->country_name->name}}
						@else
						N/A
					   @endif
                      </div>
                    </div>

                  
                  </div></div>
                <!-- / Info -->

                <!-- Posts -->

               

                <!-- / Posts -->

              </div>
              
            </div>
    
</div>
<!-- / Content -->
@endsection