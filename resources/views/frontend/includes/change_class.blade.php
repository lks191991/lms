@php
$institution_id  = '';	
$school_id 		 = '';	
$course_id 		 = '';	
$class_id  		 = '';
$search_input  	 = '';
@endphp
<script>
    var joinClassObj2 = { 

    separator:'/', 
    strDouble:'"', 
    strSingle:"'", 
    parentUrl:'{{URL::to("/")}}',
    jsId : {
        myModal               		: "#myModal",
        formId               		: "#changeClass",
        institutionDiv       		: "#institution_id2",
        schoolDiv       		    : "#school_div2",
        departmentDiv       		: "#department_div2",
        courseDiv       		    : "#course_div2",
        classDiv       		        : "#class_div2",
        institutionId       		: "#institution_id2",
        schoolId        			: "#school_id2",
        departmentId        		: "#department_id2",
        courseId        			: "#course_id2",
        classId        				: "#class_id2",
        searchInput        			: "#search_input2"
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
     departmentVal        	    : "{{Request::input('department_id')}}",
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

    /* import {JoinAClassBox} from "/js/join_a_class.js";
    (function() { window.JoinAClass2 = new JoinAClassBox(joinClassObj2); })(); */  
	
</script>  
 <script src="{{ asset('js/join_a_class.js') }}"></script>
<!-- The Modal -->
<div class="modal fade custom-modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">      
            <!-- Modal Header -->
            <div class="modal-header">          
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="register-card-wrapper">	
                    <div class="register-card">
                        <div class="register-card-header">

                            <p><b>Join </b>another class by making selection below</p>
                        </div>


                        <form action="{{route('frontend.schools')}}" method="post" id="changeClass">
                            <div class="register-card-body">
                            @csrf
							@php $institutionCat = GLB::category(); @endphp
                                <div class="form-group" id="institution_div2">
                                    <div class="custom-select-outer"> 
                                    <select class="custom-select" onchange="JoinAClass2.schoolList(true, 'institution')" name="institution_id" id="institution_id2">
                                        <option class="d-none">Institution</option>	
								@if(!empty($institutionCat))
								@foreach($institutionCat as $insKey => $insVal)
									 <option value="{{$insKey}}">{{$insVal}}</option>
							
								@endforeach
							@endif										
                                    </select>
                                </div>
                                </div>

                                <div class="form-group hide" id="school_div2">
                                <div class="custom-select-outer"> 
                                    <select class="custom-select" disabled onchange="JoinAClass2.courseList(true, 'school')" name="school_id" id="school_id2">
                                       <option class="d-none">Institute Name</option>											
                                    </select>
                                </div>
                                </div>

                                 <div class="form-group hide" id="department_div2">
                                  <div class="custom-select-outer"> 
                                    <select class="custom-select" disabled onchange="JoinAClass2.courseList(true, 'department')" name="department_id" id="department_id2">
                                        <option class="d-none">Department</option>											
                                    </select>
                                </div>
                                </div>

                                <div class="form-group hide"  id="course_div2">
                                    <div class="custom-select-outer">         
                                    <select class="custom-select" disabled onchange="JoinAClass2.classList(true, 'course')" name="course_id" id="course_id2">
                                        <option class="d-none">Course</option>
                                    </select>
                                </div>	
                                </div>	

                                <div class="form-group hide" id="class_div2">
                                    <div class="custom-select-outer"> 
                                    <select class="custom-select" disabled name="class_id" id="class_id2">
                                        <option class="d-none">Class</option>											
                                    </select>
                                </div>						
                                </div>						
                            </div>
                            <div class="register-card-footer">
                                <button type="button" onclick="JoinAClass2.onSubmitBtn(true)" class="btn btn-primary w-100 join_button2" disabled>JOIN</button>

                            </div>			
                        </form>	
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>


<script>
  $('#class_id2').on('change', function(){
      if($(this).val() != '') {
          $('.join_button2').removeAttr('disabled');
      }
  });
  
  $('#institution_id2, #school_id2, #department_id2, #course_id2').on('change', function(){
      if($(this).val() != '') {
          $('.join_button2').attr('disabled',true);
      }
  });
</script>