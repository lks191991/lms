
<script>
    let joinClassObj = { 

    separator:'/', 
    strDouble:'"', 
    strSingle:"'", 
    parentUrl:'{{URL::to("/")}}',
    jsId : {
    formId               		: "#joinSchool",
    institutionDiv       		: "#institution_id",
    schoolDiv       		    : "#school_div",
    departmentDiv       		: "#department_div",
    courseDiv       		    : "#course_div",
    classDiv       		        : "#class_div",
    institutionId       		: "#institution_id",
    schoolId        			: "#school_id",
    departmentId        		: "#department_id",
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
     institutionVal        		: "{{Request::input('institution_id')}}",
     schoolVal        			: "{{Request::input('school_id')}}",
     departmentVal        		: "{{Request::input('department_id')}}",
     courseVal        			: "{{Request::input('course_id')}}",
     classVal        			: "{{Request::input('class_id')}}",
     searchVal        			: "{{Request::input('search_input')}}"
    },
    extra : { 
    jsSeparator:'-',
    url : {
    getInstitutionOptinns : '{{route("frontend.api.getInstitutionOptinns")}}',
    getSchoolOptinns      : '{{route("frontend.api.getSchoolOptinns")}}',
    getCourseOptions      : '{{route("frontend.api.getDepartmentOrCourseOptions")}}',
    getClassOptions       : '{{route("frontend.api.getClassOptions")}}'
    }
    },
    createUrl : function(set){ 
    return ( this.parentUrl+this.separator+set);
    }
    } 
 
   /*  import {JoinAClassBox} from "/js/join_a_class.js";
    (function() { window.JoinAClass = new JoinAClassBox(joinClassObj); })();  */  
	
</script> 
 	

<form action="{{route('frontend.schools')}}" method="post" class="" id="joinSchool">
@csrf
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-lg mb-2 mb-lg-0" id="institution_div">
				@php 
					$institutionCat = GLB::category(); 
				@endphp
                    <div class="custom-select-outer">                        
                        <select class="custom-select"  onchange="JoinAClass.schoolList(true, 'institution')" name="institution_id" id="institution_id">
                            <option class="d-none">Institution</option>
							@if(!empty($institutionCat))
								@foreach($institutionCat as $insKey => $insVal)
									 <option value="{{$insKey}}">{{$insVal}}</option>
							
								@endforeach
							@endif
                        </select>
                    </div>
                </div>


                <div class="col-lg mb-2 mb-lg-0 hide" id="school_div">
                    <div class="custom-select-outer">
                        <select class="custom-select" disabled onchange="JoinAClass.courseList(true, 'school')" name="school_id" id="school_id">
                            <option class="d-none">Institute Name</option>											
                        </select>	

                    </div>
                </div>

                <div class="col-lg mb-2 mb-lg-0 hide"  id="department_div">
                    <div class="custom-select-outer">
                        <select class="custom-select" disabled onchange="JoinAClass.courseList(true, 'department')" name="department_id" id="department_id">
                            <option class="d-none">Department</option>
                        </select>						
                    </div>
                </div>

                <div class="col-lg mb-2 mb-lg-0 hide" style="display:none;" id="course_div">
                    <div class="custom-select-outer">
                        <select class="custom-select" disabled onchange="JoinAClass.classList(true, 'course')" name="course_id" id="course_id">
                            <option class="d-none">Course</option>
                        </select>						
                    </div>
                </div>
                <div class="col-lg mb-2 mb-lg-0 hide" id="class_div">
                    <div class="custom-select-outer">
                        <select class="custom-select" disabled name="class_id" id="class_id">
                            <option class="d-none">Class</option>											
                        </select>						
                    </div>
                </div>
				<div class="col-lg mb-2 mb-lg-0">
            		<button type="button" onclick="JoinAClass.onSubmitBtn(true)" class="btn btn-success w-100 join_button" disabled>JOIN</button>           
       		 </div>
				
            </div>
        </div>
        
    </div>
</form>
<script>
  $('#class_id').on('change', function(){
      if($(this).val() != '') {
          $('.join_button').removeAttr('disabled');
      }
  });
  
  $('#institution_id, #school_id, #department_id, #course_id').on('change', function(){
      if($(this).val() != '') {
          $('.join_button').attr('disabled',true);
      }
  });
</script>