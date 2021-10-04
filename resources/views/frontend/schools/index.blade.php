@extends('frontend.layouts.app')

@section('content')
@php
	$schoolActiveFad   = 'fade';
	$schoolActive      = '';
	$courseActiveFad   = 'fade';
	$courseActive      = '';
	$classesActiveFad  = 'fade';
	$classesActive     = '';
	
	if(Request::input('active') == 'school'){
		$schoolActive         = 'active';
		$schoolActiveFad     = 'active';
	}else if(Request::input('active') == 'course'){
		$courseActive       = 'active';
		$courseActiveFad    = 'active';
    }else if(Request::input('active') == 'classes'){
		$classesActive       = 'active';
		$classesActiveFad    = 'active';
	}else{
		$schoolActive        = 'active';
		$schoolActiveFad    = 'active';
	}
@endphp

       @include('frontend.includes.course_search_form')	
   
<section class="tab-card pad-inherit">
    <div class="container">
        <ul class="nav nav-tabs" id="myTabJust" role="tablist">
            <li class="nav-item" onclick="schoolsObj.listSchoolAndCourse('school')">
                <a class="nav-link {{$schoolActive}}" id="schools-tab-just"  data-toggle="tab" href="#schools-just" role="tab" aria-controls="schools-just"
                   aria-selected="true">  Schools/Universities </a>
            </li>
            <li class="nav-item" onclick="schoolsObj.listSchoolAndCourse('course')">
                <a class="nav-link {{$courseActive}}" id="courses-tab-just"  data-toggle="tab" href="#courses-just" role="tab" aria-controls="courses-just"
                   aria-selected="false"> Courses/Programs </a>
            </li>
             <li class="nav-item" onclick="schoolsObj.listSchoolAndCourse('classes')">
                <a class="nav-link {{$classesActive}}" id="classes-tab-just"  data-toggle="tab" href="#classes-just" role="tab" aria-controls="classes-just"
                   aria-selected="false"> Classes </a>
            </li>
        </ul>
    </div>
    <!-- Tab panes -->
    <div class="tab-content" id="myTabContentJust">
        <div class="tab-pane container {{$schoolActiveFad}} pad-inherit" id="schools-just" role="tabpanel" aria-labelledby="schools-tab-just">
            <div class="row" id="schoolList"></div>
		<div class="mt-2 hide" id="schoolMore"> 
			<button type="button" onclick="schoolsObj.listSchoolAndCourse('school',1)" class="btn btn-secondary w-100">SHOW MORE</button>
		</div>
        </div>

        <div class="tab-pane container {{$courseActiveFad}} pad-inherit" id="courses-just" role="tabpanel" aria-labelledby="courses-tab-just">
            <div id="courseList"></div>
		<div class="mt-2 hide" id="courseMore"> 
	    <button type="button" onclick="schoolsObj.listSchoolAndCourse('course',1)" class="btn btn-secondary w-100">SHOW MORE</button>
        </div>
        </div>

		<div class="tab-pane container {{$classesActiveFad}} pad-inherit" id="classes-just" role="tabpanel" aria-labelledby="classes-tab-just">
            <div id="classesList"></div>
		<div class="mt-2 hide" id="classesMore"> 
	    <button type="button" onclick="schoolsObj.listSchoolAndCourse('classes',1)" class="btn btn-secondary w-100">SHOW MORE</button>
        </div>
        </div>

    </div>
</section>
<input type="hidden" id="activetedTab" data-school="0" data-course="0" data-classes="0">
<input type="hidden" id="activeTabInput" value="{{Request::input('active') ? Request::input('active') : 'school'}}">
<input type="hidden" id="schoolPage" value="1">
<input type="hidden" id="coursePage" value="1">
<input type="hidden" id="classesPage" value="1">
@include('frontend.includes.contact_banner')
@include('frontend.schools.scripts')
@endsection
