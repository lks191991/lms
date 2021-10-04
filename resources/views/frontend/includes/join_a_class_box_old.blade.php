

@php
	$school_id 		= '';	
	$course_id 		= '';	
	$class_id  		= '';
	$search_input  	= '';
    
	if(!empty(Request::input('school_id')))
		$school_id = Request::input('school_id');
	if(!empty(Request::input('course_id')))
		$course_id = Request::input('course_id');
	if(!empty(Request::input('class_id')))
		$class_id = Request::input('class_id');
	if(!empty(Request::input('search_input')))
		$search_input = Request::input('search_input');
	if(empty($boxTitle))
		$boxTitle = "Join another class";
	if(empty($boxPera))
		$boxPera  = "Search for a school or select one below";
	if(empty($joinButton))
		$joinButton  = "ajax";
	


@endphp
<script type="module">
let joinClassObj = { 
    
    separator:'/', 
    strDouble:'"', 
    strSingle:"'", 
    parentUrl:'{{URL::to("/")}}',
    jsId : {
        schoolId        			: "#school_id",
        courseId        			: "#course_id",
        classId        				: "#class_id",
        searchInput        			: "#search_input"
    },
	status : {
        success     : 200
    },
    jsClass : {
        navItem 				: ".nav-item"
        
    },
	jsNames : {
        noname 			: "",
    },
	jsValue : {
        schoolVal        			: "{{$school_id}}",
        courseVal        			: "{{$course_id}}",
        classVal        			: "{{$class_id}}",
        searchVal        			: "{{$search_input}}"
    },
    extra : { 
        jsSeparator:'-',
		url : {
				getSchoolOptinns     : '{{route("frontend.api.getSchoolOptinns")}}',
				getCourseOptions     : '{{route("frontend.api.getCourseOptions")}}',
				getClassOptions      : '{{route("frontend.api.getClassOptions")}}'
		}
    },
	createUrl : function(set){ 
        return ( this.parentUrl+this.separator+set);
    }
} 

import {JoinAClassBox} from "/js/join_a_class.js";
(function() { window.JoinAClass = new JoinAClassBox(joinClassObj); })();   
</script> 


<div class="card text-white bg-primary">
    <div class="card-body">
        <h3 class=" mb-5"> {!!$boxTitle!!} </h3>
        <form action="{{route('frontend.schools')}}" class="form-inline">
            <div class="form-row my-3">
                <div class="col">
                    <label class="control-label" for="email">{!!$boxPera!!}</label>
                </div>
                <div class="col">
                    <input type="text" class="form-control" id="search_input" name="search_input" value="{{$search_input}}">
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3">
                    <select class="form-control col-sm-12" name="school_id" id="school_id">
                        <option value=""> Select School </option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control col-sm-12" name="course_id" id="course_id">
                        <option value=""> Select Course </option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control col-sm-12" name="class_id" id="class_id">
                        <option value=""> Select Class </option>
                    </select>
                </div>
                <div class="col-md-3">
                    @if($joinButton == 'ajax')
                    <button type="button" onclick="schoolsObj.listSchoolAndCourse('',0,1)" class="btn btn-success">JOIN</button>
                    @else
                    <button type="submit"  class="btn btn-success">JOIN</button>
                    @endif
                </div>
            </div>

        </form>

    </div>
</div>

 