@extends('frontend.layouts.app')

@section('metaData')
    <meta name="title" content="{{substr(strip_tags($defaultVideo->title),0,60)}}">
    <meta name="description" content="{{substr(strip_tags($defaultVideo->description),0,150)}}">
    <meta name="keywords" content="{{substr(strip_tags($defaultVideo->keywords),0,150)}}">
@endsection

@section('after-styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
<style>
    .lesson-card{min-height: 385px;}
    #video_player_box{
        --plyr-video-controls-background: linear-gradient(rgba(255, 255, 255, 0.8),rgba(220, 220, 220, 0.8)) ;
        --plyr-video-control-color: #333333;        
    }
    .plyr--video .plyr__controls{
        padding-top: 15px !important;
    }
</style>
@endsection

@section('content')

@php
$playingActiveFad    = 'fade';
$playingActive       = '';
$questionsActiveFad  = 'fade';
$questionsActive     = '';
$archiveActiveFad    = 'fade';
$archiveActive       = '';
$favouritesActiveFad = 'fade';
$favouritesActive    = '';

if(Request::input('active') == 'playing'){
$playingActive         = 'active';
$playingActiveFad      = 'active';
}else if(Request::input('active') == 'questions'){
$questionsActive       = 'active';
$questionsActiveFad    = 'active';
}else if(Request::input('active') == 'archive'){
$archiveActive         = 'active';
$archiveActiveFad      = 'active';
}else if(Request::input('active') == 'favourites'){
$favouritesActive      = 'active';
$favouritesActiveFad   = 'active';
}else{
$playingActive       = 'active';
$playingActiveFad    = 'active';
}
@endphp

@include('frontend.classroom.fleg_video')
@include('frontend.classroom.videos_section')
<section class="tab-card">
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{$playingActive}}"  data-toggle="tab" onclick="classroomObj.listClassroom('playing')" href="#Playing">Playing</a>
            </li> 
            <li class="nav-item">
                <a class="nav-link {{$questionsActive}}" data-toggle="tab" onclick="classroomObj.listClassroom('questions')" href="#Questions">Questions</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link {{$archiveActive}}" data-toggle="tab" onclick="classroomObj.listClassroom('archive')" href="#Archive">Previous</a>
            </li>
        </ul> 
    </div>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane pad-inherit container {{$playingActiveFad}}  " id="Playing">
            <div class="row" id="playinglList">
                
            </div>
            <div class="mt-2 hide" id="playingMore"> 
                <button type="button" onclick="classroomObj.listClassroom('playing', 1)" class="btn btn-secondary w-100">SHOW MORE</button>
            </div>
        </div>
        <div class="tab-pane card-comment-padding container {{$questionsActiveFad}}" id="Questions">
            <div class="" id="reply-box-id-0">
                <div class="post-question">
                    <form>
                        <div class="form-group">
                            <label><strong>Post a question</strong></label>
						
                            <textarea class="form-control" id="ask_question-0" placeholder="ask for assistance...dont be shy"></textarea>
                        </div>
                        <div class="form-group m-0">
                            <div class="row">
                                @if(!Auth::check())
                                <div class="col-12">
                                    
                                    <button type="button" onclick="loginObj.openPopup()" id="loginBtn" class="btn btn-primary w-100">POST</button>
                                </div>
                                @else
                                <div class="col-12">
                                    <button type="button" id="postQuestionsBtn-0" onclick="classroomObj.postQuestions()" class="btn btn-primary w-100">POST</button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div> 
            </div> 
			<div class="refresh-wrapper text-right my-2"><button class="btn btn-dark" onclick="classroomObj.listClassroom('questions')" title="Reload"><i class="fas fa-sync"></i></button></div>
            <div class="list-group" id="questionsList">

            </div>
            <div class="mt-2 hide" id="questionsMore"> 
                <button type="button" onclick="classroomObj.listClassroom('questions', 1)" class="btn btn-secondary w-100">SHOW MORE</button>
            </div>
        </div>
        <div class="tab-pane container {{$archiveActiveFad}}" id="Archive">
            @include('frontend.classroom.archive_serch_box')
<!--            <div class="list-group" id="archiveList">
                Previous
            </div>
            <div class="mt-2 hide" id="archiveMore"> 
                <button type="button" onclick="classroomObj.listClassroom('archive', 1)" class="btn btn-secondary w-100">SHOW MORE</button>
            </div>-->
        </div>
        
    </div>
</section>
<input type="hidden" id="activeTabInput" value="{{Request::input('active') ? Request::input('active') : 'playing'}}">

<input type="hidden" id="activetedTab" data-playing="0" data-questions="0" data-archive="0" data-favourites="0">
<input type="hidden" id="playingPage" value="1">
<input type="hidden" id="questionsPage" value="1">
<input type="hidden" id="archivePage" value="1">
<input type="hidden" id="favouritesPage" value="1">
<input type="hidden" id="currentVideo" value="{{$defaultVideo->id}}">
<input type="hidden" id="nextVideo" value="0">
<input type="hidden" id="defaultClassroomDate" value="{{$defaultVideo->play_on}}">
@include('frontend.includes.contact_banner')

@include('frontend.classroom.scripts')
@endsection

