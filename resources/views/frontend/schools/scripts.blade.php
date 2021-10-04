@section('before-styles')
 
@stop

@section('after-styles')
 <style>
 .img-course {
    width: 50px;
    height: 50px;
    border-radius: 4%;
}
</style>
@endsection

@section('footer-scripts')

@endsection

@section('scripts')

<script>
var dataObj = { 
    
    separator:'/', 
    strDouble:'"', 
    strSingle:"'", 
    parentUrl:'{{URL::to("/")}}',
   jsId : {
        myModal       		        : "#myModal",
        searchForMainDiv       		: "#searchForMainDiv",
        searchFor           		: "#searchFor",
        institutionId       		: "#institution_id2",
        schoolId        			: "#school_id2",
        courseId        			: "#course_id2",
        classId        				: "#class_id2",
        searchInput        			: "#search_input",
        myTabJust        			: "#myTabJust",
        schoolsTabJust        		: "#schools-tab-just",
        coursesTabJust        		: "#courses-tab-just",
        classesTabJust        		: "#classes-tab-just",
        activeTabInput        		: "#activeTabInput",
        schoolPage        		    : "#schoolPage",
        coursePage        		    : "#coursePage",
        classesPage        		    : "#classesPage",
        schoolMore        		    : "#schoolMore",
        courseMore        		    : "#courseMore",
        classesMore        		    : "#classesMore",
        courseList        		    : "#courseList",
        schoolList           		: "#schoolList",
        classesList           		: "#classesList",
        activetedTab           		: "#activetedTab"
    },
	status : {
        success     : 200
    },
    jsClass : {
        navItem 				: ".nav-item",
        navLink 				: ".nav-link",
        active 					: ".active"
    },
	jsData : {
        school 				: "school",
        course 				: "course",
        classes 			: "classes"
    },
	jsNames : {
        noname 			: "",
    },
	jsValue : {
		institutionVal        		: "{{Request::input('institution_id')}}",
        schoolVal        			: "{{Request::input('school_id')}}",
        schoolVal        			: "{{Request::input('school_id')}}",
        courseVal        			: "{{Request::input('course_id')}}",
        classVal        			: "{{Request::input('class_id')}}",
        searchVal        			: "{{Request::input('search_input')}}",
        errMessage        			: "{{$errMessage}}",
        errType        			    : "{{$errType}}",
        errStatus        			: "{{$errStatus}}"
    },
    extra : { 
        jsSeparator:'-',
		url : {
				school     : '{{route("frontend.schoolData")}}',
				course     : '{{route("frontend.courseData")}}',
				classes    : '{{route("frontend.classesData")}}'
		}
    },
	createUrl : function(set){ 
        return ( this.parentUrl+this.separator+set);
    },
    createId : function(id){ 
       // return ( id+this.category_id+this.extra.jsSeparator+this.garment_id);
    },
    createClass : function(id){ 
       // return ( id+this.category_id+this.extra.jsSeparator+this.garment_id);
    }
} 
/* 
import {Schools} from "/js/schools.js";
(function() {  window.schoolsObj = new Schools(dataObj);  })();   */
</script> 
<script src="{{ asset('js/schools.js') }}"></script>
@stop

