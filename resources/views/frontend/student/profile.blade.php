@extends('frontend.layouts.app')
@section('header-styles')

@endsection
@section('content')


<section class="content-top-wrapper bg-white">
    <div class="container">
        <div class="row">




            @include('frontend.student.profile_upload')
			@include('frontend.student.edit_profile')
            @include('frontend.tutor.change_password')

            <div class="col-md-7 col-lg-8 col-xl-9">
                <div class="profile-detail">
                    <div class="d-flex align-items-center flex-wrap">
                        <h1 class="sub-heading">{{ $student->userData->fullname }}</h1>
						@if(SiteHelpers::emailVerified() == 1)
							<a href="avascript:void(0)" class="btn-activate m-2 firstSendOtp" data-toggle="modal" data-target="#activeModel">Activate Account </a>
						@endif
                        <!-- <a href="#" class="btn-activate m-2">Activate account</a>
                        <a href="#" class="btn-subscribe m-2">Subscribe</a> -->
						
						<div class="dropdown profile-menu flex-grow-1 text-right">
							<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></a>
							<ul class="dropdown-menu dropdown-menu-right">
						  <li><a href="javascript:void(0)" class="dropdown-item" data-toggle="modal" data-target="#editProfile">Edit profile</a></li>
						  <li><a href="javascript:void(0)" class="dropdown-item" data-toggle="modal" data-target="#changePassword">Change password</a></li>						  
						</ul>

						</div>
                    </div>	


                    <div class="row mt-2">
                        <div class="col flex-grow-0 pr-0">
                            <figure class="profile-item-logo"><img src="{{asset('/uploads/schools/'.$student->userData->school->logo)}}" alt=""></figure>
                        </div>
                        <div class="col flex-grow-1">
                            <h3 class="profile-item-name">{{ $student->userData->school->school_name }}</h3>
                            <h4 class="profile-item-location">{{ $student->userData->course->name }}</h4>
                        </div>
                    </div>
                    <hr class="mt-2 mb-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="profile-achievement">
                                <li>
                                    <span class="icon"><img src="images/icon-eye.png" alt=""></span>
                                    <span class="text">{{$classesWatched}}	Classes watched</span>
                                </li>
                                <li>
                                    <span class="icon"><img src="images/icon-notes.png" alt=""></span>
                                    <span class="text">{{$noteDownloads}} Lecture notes downloaded</span>
                                </li>
                                <li>
                                    <span class="icon"><img src="images/icon-question.png" alt=""></span>
                                    <span class="text">{{$questionsCount}} Questions asked</span>
                                </li>
                                <li>
                                    <span class="icon"><img src="images/icon-tick.png" alt=""></span>
                                    <span class="text">{{$replyCount}} Answers contributed</span>
                                </li>
                                <li>
                                    <span class="icon"><img src="images/icon-group.png" alt=""></span>
                                    <span class="text">0 groups joined</span>
                                </li>
                                <li>
                                    <span class="icon"><img src="images/icon-added.png" alt=""></span>
                                    <span class="text">0 friends added</span>
                                </li>

                            </ul>
                        </div>
                        <div class="col-lg-6 mt-3 mt-lg-0">
                            <div class="profile-progress">
                                <small class="d-block">Profile complete <strong>{{ round($student->userData->profilePercentage($student->userData->user_id) ,2)}}%</strong></small>
                                <div class="progress my-1">
                                    <div class="progress-bar progress-bar-striped" style="width:{{ $student->userData->profilePercentage($student->userData->user_id) }}%"></div>
                                </div>		
                                <small class="d-block">Achievement</small>								
                            </div>	
                            <div class="pt-1">
                                <ul class="profile-achievement-type">
								@if(!empty($starShow->silverCount))
									<li class="silver" data-toggle="tooltip" data-placement="top" title="{{$starShow->silverDec}}">
										<div class="icon" ><i class="fas fa-star"></i></div>
										<div class="text">{{$starShow->silverCount}}</div>
									</li>
								@endif
								@if(!empty($starShow->bronzeCount))
									<li class="bronze" data-toggle="tooltip" data-placement="top" title="{{$starShow->bronzeDec}}">
										<div class="icon"><i class="fas fa-star"></i></div>
										<div class="text">{{$starShow->bronzeCount}}</div>
									</li>
								@endif
								@if(!empty($starShow->blueCount))
									<li class="blue" data-toggle="tooltip" data-placement="top" title="{{$starShow->blueDec}}">
										<div class="icon"><i class="fas fa-star"></i></div>
										<div class="text">{{$starShow->blueCount}}</div>
									</li>
								@endif
								@if(!empty($starShow->yellowCount))
									<li class="yellow" data-toggle="tooltip" data-placement="top" title="{{$starShow->yellowDec}}">
										<div class="icon"><i class="fas fa-star"></i></div>
										<div class="text">{{$starShow->yellowCount}}</div>
									</li>
								@endif
								</ul>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>	
    </div>
</section>
<section class="tab-card">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" title="" onclick="studentObj.studentHistory('histories')" data-toggle="tab" href="#History">History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" title="" onclick="studentObj.studentHistory('favourites')" data-toggle="tab" href="#Favourites">Favourites</a>
                    </li>						
                </ul>
            </div>		

            <div class="col-md-7 d-flex py-3 py-md-0">
                <div class="row align-items-center justify-content-end">
                    <div class="col flex-grow-0  text-right">Filter&nbsp;By:</div>
                    <div class="col-8 flex-grow-1">
                        <div class="row filter-row">
                            <div class="col">
                                <div class="custom-select-outer"> 
                                <select class="custom-select filterby-form-control" id="school_id" onchange="studentObj.studentHistory('', 0, 1)" >
                                    <option value="">School </option>
                                    @if(!empty($schools))
                                    @foreach($schools as $skey => $school)
                                    <option value="{{$skey}}">{{$school}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            </div>
                            <div class="col">
                                <div class="custom-select-outer">     
                                <select class="custom-select filterby-form-control" id="course_id" onchange="studentObj.studentHistory('', 0, 1)" >
                                    <option value="">Course</option>
                                    @if(!empty($courses))
                                    @foreach($courses as $ckey => $course)
                                    <option value="{{$ckey}}">{{$course}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            </div>
                        </div> 



                    </div>
                </div>

            </div>

        </div>


    </div>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane container active pad-inherit " id="History">
            <div id="historyHtml">
                

            </div>

            <button type="button" style="display:none;" id="historyMore" onclick="studentObj.studentHistory('histories', 1)" class="btn btn-secondary w-100">SHOW MORE</button>
        </div>
        <div class="tab-pane container pad-inherit" id="Favourites">	 
            <div id="favouritesHtml">	
                <div class="item-row">
                    <div class="row">
                        <div class="col flex-grow-0">
                            <figure class="item-row-image"><img src="images/class-logo.png" alt=""></figure>
                        </div>
                        <div class="col flex-grow-1">
                            <h3 class="heading">Accra High School (Ahisco)</h3>
                            <p class="heading-sub-text">General Arts 1 (Economics - Scarcity)</p>
                        </div>
                        <div class="col  flex-grow-0 mt-2 mt-md-0 ">				
                            <div class="action-button d-flex align-items-center">
                                <a href="#" title="" class="btn-play">Watch</a>
                                <a href="#" title="" class="btn-remove ml-3">Remove</a>
                            </div>	
                        </div>
                    </div>
                </div>

            </div>

            <button type="button" style="display:none;" id="favouritesMore" onclick="studentObj.studentHistory('favourites', 1)" class="btn btn-secondary w-100">SHOW MORE</button>


        </div>

    </div>
</section>
@include('frontend.includes.contact_banner')
<input type="hidden" id="activetedTab" data-histories="0" data-favourites="0">
<input type="hidden" id="activeTabInput" value="histories">
<input type="hidden" id="historyPage" value="1">
<input type="hidden" id="favouritesPage" value="1">
@include('frontend.student.scripts')
@endsection








