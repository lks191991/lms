@extends('backend.layouts.layout-3')

@section('content')

<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- Header -->
    <div class="container-m-nx container-m-ny bg-white mb-4">
        <div class="row">
            <div class="col-md-10">
                <div class="media col-md-10 col-lg-8 col-xl-7 py-5 mx-auto">
                    @if(!empty($student->getProfileOrAvatarImageAttribute()))
                    <img class="school_logo mb-2 d-block" style="max-width:150px;min-width: 135px;" src="{{url($student->getProfileOrAvatarImageAttribute())}}"  />
                    @else
                    <img class="school_logo mb-2 d-block" style="max-width:150px;min-width: 135px;" src="{{url('images/default_tutor_manager.png')}}"  />
                    @endif
                    <div class="media-body ml-5">
                        <h4 class="font-weight-bold mb-2">{{ucwords($student->getFullNameAttribute())}}</h4>
                        <div class="text-muted mb-2">
                            <strong>School Name:</strong> <a href="{{route('backend.school.show',$student->school_id)}}" class="text-body">{{$student->school->school_name}}</a>
                        </div>
                        <div class="text-muted mb-2">
                            <ul class="profile-achievement list-unstyled">
                                <li>
                                    <span class="icon"><img src="{{asset('images/icon-eye.png')}}" alt=""></span>
                                    <span class="text">{{$classesWatched}}	Classes watched</span>
                                </li>
                                <li>
                                    <span class="icon"><img src="{{asset('images/icon-notes.png')}}" alt=""></span>
                                    <span class="text">{{$noteDownloads}} Lecture notes downloaded</span>
                                </li>
                                <li>
                                    <span class="icon"><img src="{{asset('images/icon-question.png')}}" alt=""></span>
                                    <span class="text">{{$questionsCount}} Questions asked</span>
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
            <div class="col-md-2 ml-10 mt-5"><a href="javascript:void(0)" onclick="window.history.go(-1);
                                 return false;" class="btn btn-primary rounded-pill d-block detail-back-btn">Back</a></div>
        </div>
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
                            {{$student->email}}
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">Mobile:</div>
                        <div class="col-md-9">
                            {{$student->mobile}}
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">Category:</div>
                        <div class="col-md-9">
                            {{$student->category->name}}
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">School:</div>
                        <div class="col-md-9">
                            {{$student->school->school_name}}
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">Course:</div>
                        <div class="col-md-9">
                            {{$student->course->name}}
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">Class:</div>
                        <div class="col-md-9">
                            {{$student->student_class->class_name}}
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">Country:</div>
                        <div class="col-md-9">
                            @if(isset($student->country_name->name) && !empty($student->country_name->name))
                            {{$student->country_name->name}}
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
    
    <div class="row">
        <div class="col">
            <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
                <div>History</div>
            </h4>
            <!-- Info -->
            <div class="card mb-4"> 
                <div class="card-body">	                
                @if(!empty($studentHistories[0]))
                  <ul class="list-group list-group-flush">
                    @foreach($studentHistories as $studentHistory)
                    <li class="list-group-item">
                        <div class="item-row history-row-count" id="history-row-{{$studentHistory->id}}">
                            <div class="row">
                                <div class="col flex-grow-0">
                                    <figure class="item-row-image mb-0"><img src="{{asset($studentHistory->video->school->school_logo)}}" alt="" width="48"></figure>
                                </div>

                                <div class="col flex-grow-1">
                                    <h4 class="heading mb-0">{!!$studentHistory->video->title!!}</h4>
                                    <p class="heading-sub-text mb-0">{{$studentHistory->video->sub_title}}</p>
                                </div>
                                <div class="col  flex-grow-0 mt-2 mt-md-0 ">				
                                    <div class="action-button d-flex align-items-center">
                                        <a href="{{route('backend.videos.show', $studentHistory->video->uuid)}}" title="View Video" class="btn-play"><i class="ion ion-md-eye"></i></a>
                                    </div>	
                                </div>
                            </div>
                        </div>
                    </li>                    
                    @endforeach
                  </ul>
                @else
                <div class="list-view-sec" style="text-align:center">
                    <h5 class="text-info">No Record Available</h5> 
                </div>
                @endif 

                    {{ $studentHistories->links() }}
                </div>
            </div>
        </div>
    </div> 
</div>
<!-- / Content -->
@endsection