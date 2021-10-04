@extends('frontend.layouts.app')
@section('header-styles')

@endsection
@section('content')


<section class="content-top-wrapper bg-white">
    <div class="container">
        <div class="row">

            @include('frontend.tutor.profile_upload')
            @include('frontend.tutor.change_password')
			@include('frontend.tutor.edit_profile')


            <div class="col-md-7 col-lg-8 col-xl-9">
                <div class="profile-detail">
                    <div class="d-flex align-items-center flex-wrap">
                        <h1 class="sub-heading">{{ $tutor->userData->fullname }}</h1>
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
                            <figure class="profile-item-logo">
                                <img src="{{asset('/uploads/schools/'.$tutor->userData->school->logo)}}" alt="" height="45">
                            </figure>
                        </div>
                        <div class="col flex-grow-1">
                            <h3 class="profile-item-name">{{ $tutor->userData->school->school_name }}</h3>
                            <h4 class="profile-item-location">{{ $tutor->userData->tutor_subject }}</h4>
                        </div>
                    </div>
                    <hr class="mt-2 mb-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="profile-achievement">
                                <li>
                                    <span class="icon"><img src="images/icon-eye.png" alt=""></span>
                                    <span class="text">{{$classesHosted}}	Classes hosted</span>
                                </li>
                                <li>
                                    <span class="icon"><img src="images/icon-notes.png" alt=""></span>
                                    <span class="text">{{$noteAdded}} Lecture notes added</span>
                                </li>
                                <li>
                                    <span class="icon"><img src="images/icon-question.png" alt=""></span>
                                    <span class="text">{{$questionsAsked}} Questions asked</span>
                                </li>
                                <li>
                                    <span class="icon"><img src="images/icon-tick.png" alt=""></span>
                                    <span class="text">{{$replyCount}} Answers contributed</span>
                                </li>


                            </ul>
                        </div>
                        <div class="col-lg-6 mt-3 mt-lg-0">
                            <div class="profile-progress">
                                <small class="d-block">Profile complete <strong>{{ round($tutor->userData->profilePercentage($tutor->userData->user_id),2) }}%</strong></small>
                                <div class="progress my-1">
                                    <div class="progress-bar progress-bar-striped" style="width:{{ $tutor->userData->profilePercentage($tutor->userData->user_id) }}%"></div>
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
<section class="tab-card ">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" title="" onclick="tutorPost.tutorLectureAndPosts('lecture')" data-toggle="tab" href="#Lecture">Lectures</a>
                    </li>
                    <!--                    <li class="nav-item">
                                            <a class="nav-link" title="" onclick="tutorPost.tutorLectureAndPosts('posts')" data-toggle="tab" href="#Posts">Posts</a>
                                        </li>						-->
                </ul>
            </div>		



            <div class="col-md-7 d-flex py-3 py-md-0 justify-content-end">
                <div class="row align-items-center" >
                    <div class="col flex-grow-0  text-right">Sort&nbsp;By:</div>
                    <div class="col flex-grow-1">
                        <div class="row filter-row">
                            <div class="col">
                                <div class="custom-select-outer"> 
                                    <select class="custom-select filterby-form-control" id="order_by" onchange="tutorPost.tutorLectureAndPosts('', 0, 1)" >
                                        <option value="id-asc">Recent </option>
                                        <option value="created_at-asc">Ascending</option>
                                        <option value="created_at-desc">Descending </option>
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
        <div class="tab-pane container active " id="Lecture">
            @include('frontend.tutor.post_video')
            <div id="lectureHtml">


            </div>
            <div id="moreLectureBtnContainer">
                <button type="button" style="display:none;" id="lectureMore" onclick="tutorPost.tutorLectureAndPosts('lecture', 1)" class="btn btn-secondary w-100">SHOW MORE</button>
            </div>            
        </div>
        <!--        <div class="tab-pane container " id="Posts">	 
        
                    {{-- @include('frontend.tutor.tutor_post_article') --}} 
        
                    <div id="postsHtml">	
        
        
                    </div>
        
                    <button type="button" style="display:none;" id="postsMore" onclick="tutorPost.tutorLectureAndPosts('posts', 1)" class="btn btn-secondary w-100">SHOW MORE</button>
        
        
                </div>-->

    </div>
</section>
@include('frontend.includes.contact_banner')
@include('frontend.tutor.add_notes')
<input type="hidden" id="activetedTab" data-lecture="0" data-posts="0">
<input type="hidden" id="activeTabInput" value="lecture">
<input type="hidden" id="lecturePage" value="1">
<input type="hidden" id="postsPage" value="1">
@include('frontend.tutor.scripts')
@endsection
