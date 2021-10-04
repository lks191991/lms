/* import {Common} from "/js/common.js"; */
class JoinAClassBox{
	
		constructor(external){
            //super();
			this.ext            = external;
            this.getPostData    = "";
            this.institution_id = "";
            this.school_id      = "";
            this.department_id  = "";
            this.course_id      = "";
            this.class_id       = "";
			/* this.institutionList(false,'institution');
			this.schoolList(false,'school');
			this.courseList(false,'school');
			this.courseList(false,'course');
			this.classList(false,'class'); */

		
		}
        openModel(institutionVal = '',schoolVal = ''){

			//this.institution_id = institutionVal;
            //this.school_id      = schoolVal;
			$(this.ext.jsId.institutionId).val(institutionVal);
            this.ext.jsValue.institutionVal = institutionVal;
            this.ext.jsValue.schoolVal      = schoolVal;
            $(this.ext.jsId.myModal).modal();

            //this.institutionList(false,'institution');
			this.schoolList(false,'school');
			this.courseList(false,'school');
			this.courseList(false,'course');
            this.classList(false,'class');
            
        }
		onSubmitBtn(validate = true){
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var jsValue			= this.ext.jsValue;
			var extra			= this.ext.extra;
			var url			    = this.ext.extra.url;
			
			var institutionVal  = $(ids.institutionId).val();
			var schoolVal       = $(ids.schoolId).val();
			var departmentVal       = $(ids.departmentId).val();
			var courseVal       = $(ids.courseId).val();
			var classVal        = $(ids.classId).val();
			if(validate == true){
				
				 
				if(institutionVal == ''){
					this.messages('error',"Please select an institution");
					return false;
				}
			}
			$(ids.formId).submit();

			
		}
		disableUndisable(optionData){
		
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var jsValue			= this.ext.jsValue;
			var extra			= this.ext.extra;
			
			/* institutionDiv schoolDiv courseDiv classDiv */
			 
			
			if(optionData.institutionDesable == 1){
				$(ids.institutionId).prop('disabled', true);
			}else{
				$(ids.institutionId).prop('disabled', false);
			}
			if(optionData.institutionHide == 1){
				//$(ids.institutionDiv).hide();
			}else{
				//$(ids.institutionDiv).show();
			}

			if(optionData.schoolDesable == 1){
				$(ids.schoolId).prop('disabled', true);
			}else{
				$(ids.schoolId).prop('disabled', false);
			}
			if(optionData.schoolHide == 1){
				$(ids.schoolDiv).hide();
			}else{
				$(ids.schoolDiv).show();
			}

            if(optionData.departmentDesable == 1){
				$(ids.departmentId).prop('disabled', true);
			}else{
				$(ids.departmentId).prop('disabled', false);
			}
            if(optionData.departmentHide == 1){
				$(ids.departmentDiv).hide();
			}else{
				$(ids.departmentDiv).show();
			}

			if(optionData.courseDesable == 1){
				$(ids.courseId).prop('disabled', true);
			}else{
				$(ids.courseId).prop('disabled', false);
			}
			if(optionData.courseHide == 1){
				$(ids.courseDiv).hide();
			}else{
				$(ids.courseDiv).show();
			}

			if(optionData.classesDesable == 1){
				$(ids.classId).prop('disabled', true);
			}else{
				$(ids.classId).prop('disabled', false);
			}
			if(optionData.classesHide == 1){
				$(ids.classDiv).hide();
			}else{
				$(ids.classDiv).show();
			}
			
			

		}
		getSearchVal(onchange = false, fromCall = ''){
			
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var jsValue			= this.ext.jsValue;
			var extra			= this.ext.extra;
			var url			    = this.ext.extra.url;
			
			var institutionVal  = '';
			var schoolVal       = '';
			var departmentVal   = '';
			var courseVal       = '';
			var classVal        = '';
			
			if(onchange == true){
				
				 institutionVal  = $(ids.institutionId).val();
				 schoolVal       = $(ids.schoolId).val();
				 departmentVal   = $(ids.departmentId).val();
				 courseVal       = $(ids.courseId).val();
				 classVal        = $(ids.classId).val();
				
			} else {
				 institutionVal  = jsValue.institutionVal;
				 schoolVal    	 = jsValue.schoolVal;
				 departmentVal   = jsValue.departmentVal;
				 courseVal    	 = jsValue.courseVal;
				 classVal    	 = jsValue.classVal;
			}
			
			if(onchange = true && fromCall == 'institution'){
				 schoolVal       = '';
				 departmentVal   = '';
				 courseVal       = '';
				 classVal        = '';
				 $(ids.schoolId).html(commonObj.createOptions({},schoolVal,'School Name'));
				 $(ids.departmentId).html(commonObj.createOptions({},departmentVal,'Department'));
				 //$(ids.schoolId).prop('disabled', false);
				 $(ids.courseId).html(commonObj.createOptions({},courseVal,'Course'));
				 //$(ids.schoolId).prop('disabled', false);
				 $(ids.classId).html(commonObj.createOptions({},classVal,'Class'));
			
			} else if(onchange = true && fromCall == 'school'){
				 departmentVal   = '';
				 courseVal       = '';
				 classVal        = '';
                 $(ids.departmentId).html(commonObj.createOptions({},departmentVal,'Department'));
				 $(ids.courseId).html(commonObj.createOptions({},courseVal,'Course'));
				 $(ids.classId).html(commonObj.createOptions({},classVal,'Class'));
            } else if(onchange = true && fromCall == 'department'){
				 courseVal       = '';
				 classVal        = '';
				 $(ids.courseId).html(commonObj.createOptions({},courseVal,'Course'));
				 $(ids.classId).html(commonObj.createOptions({},classVal,'Class'));
			} else if(onchange = true && fromCall == 'course'){
				 classVal        = '';
				 $(ids.classId).html(commonObj.createOptions({},classVal,'Class'));
			}
			
			return {'institution_id' : institutionVal, 'school_id' : schoolVal, 'department_id' : departmentVal, 'course_id' : courseVal, 'class_id' : classVal};
			
			
			
		}
		institutionList(onchange = false, fromCall = '',selected = ''){
            
			commonObj.paceRestart('institutionList');
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var jsValue			= this.ext.jsValue;
			var extra			= this.ext.extra;
			var url			    = this.ext.extra.url;
			var selectedVal    	= jsValue.institutionVal;
			var searchVal       = this.getSearchVal(onchange,fromCall);
			if(selected != ''){
				selectedVal = selected;
			} 

			var postData    = {
								'selectedId':selectedVal,
								'searchVal' : searchVal,
								'fromCall'  : fromCall,
								'onchange'  : onchange
							  };
			$(ids.institutionId).html(commonObj.createOptions({},selectedVal,'Institution'));
			var self = this;
            //this.post(url.getInstitutionOptinns,postData);
			axios.post(url.getInstitutionOptinns,postData)
			.then(function (response) {
				
				var getData = response.data;
				
				
				$.when($(ids.institutionId).html(commonObj.createOptions(getData.category,selectedVal,getData.optionData.boxName))).done(function(){
                    if(getData.optionData.selectedId != ''){
                        $(ids.institutionId).val(getData.optionData.selectedId);
                    }
                    
                });
				self.disableUndisable(getData.optionData);
				/* if(searchVal.institution_id != ''){
				  this.classList(true,'','institution');
				} */ 
			})
			.catch(function (error) {
				//console.log(error);
                //var re = {"status" : error.response.status, "message" : `Error Code ${error.response.status} : ${error.response.statusText}`};
				//commonObj.catchErr(re);
			});
			 
			
		}
		schoolList(onchange = false, fromCall = '',selected = ''){
            
			commonObj.paceRestart('schoolList');
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var jsValue			= this.ext.jsValue;
			var extra			= this.ext.extra;
			var url			    = this.ext.extra.url;
			var selectedVal    	= jsValue.schoolVal;
			var searchVal       = this.getSearchVal(onchange,fromCall);
			var self = this;
			if(selected){
				selectedVal = parseInt(selected);
			} 
			var postData    = {
								'selectedId':selectedVal,
								'searchVal' : searchVal,
								'fromCall'  : fromCall,
								'onchange'  : onchange
							  };
                        
			$(ids.schoolId).html(commonObj.createOptions({},selectedVal,'Institute Name'));
			
            //this.post(url.getSchoolOptinns,postData);
			axios.post(url.getSchoolOptinns,postData)
			.then(function (response) {
				
				var getData = response.data;
			
				$.when($(ids.schoolId).html(commonObj.createOptions(getData.schools,selectedVal,getData.optionData.boxName))).done(function(){ 
                    if(getData.optionData.selectedId != ''){
                        $(ids.schoolId).val(getData.optionData.selectedId);
                    }
					
					if(onchange){ 
						$(ids.schoolId).val('');
					}
                    
                });
				self.disableUndisable(getData.optionData);
				
				/* $.when($(ids.schoolId).html(commonObj.createOptions(getData.schools,selectedVal,getData.optionData.boxName)).val(selectedVal).trigger('change')).done(); */
				/* if(searchVal.institution_id != '' && onchange == true){
				  self.classList(true,'','institution');
				}  */
			})
			.catch(function (error) {
				//console.log(error);
                //var re = {"status" : error.response.status, "message" : `Error Code ${error.response.status} : ${error.response.statusText}`};
				//commonObj.catchErr(re);
			});
			
			
			
		}
        
		courseList(onchange = false, fromCall = '',selected = ''){
            
			commonObj.paceRestart('courseList');
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var jsValue			= this.ext.jsValue;
			var extra			= this.ext.extra;
			var url			    = this.ext.extra.url;
			var selectedVal    	= jsValue.courseVal;
			var departselected  = jsValue.departmentVal;
			var schoolId    	= $(ids.courseId).val();
			var searchVal       = this.getSearchVal(onchange,fromCall);
			var self = this;
            if(fromCall == 'department'){
                selectedVal    	= jsValue.departmentVal;
            }

			if(selected){
				selectedVal = selected;
			}
			var postData    = {
								'selectedId':selectedVal,
								'searchVal' : searchVal,
								'fromCall'  : fromCall,
								'onchange'  : onchange
							  };
		
			$(ids.courseId).html(commonObj.createOptions({},selectedVal,'Course'));
			
            //this.post(url.getCourseOptions,postData);
			axios.post(url.getCourseOptions,postData)
			.then(function (response) {
				
				var getData = response.data;
				
                self.disableUndisable(getData.optionData);
			   
                if(getData.fillIn == "department"){
                   $.when($(ids.departmentId).html(commonObj.createOptions(getData.courses,departselected,getData.optionData.boxName))).done(function(){
                    if(getData.optionData.selectedId != ''){
                        $(ids.departmentId).val(getData.optionData.selectedId);
                    }
                    
                });
                }else{
                    $.when($(ids.courseId).html(commonObj.createOptions(getData.courses,selectedVal,getData.optionData.boxName))).done(function(){
                    if(getData.optionData.selectedId != ''){
                        $(ids.courseId).val(getData.optionData.selectedId);
                    }
                    
                });
                }
				
				if(searchVal.institution_id != '' && onchange == true){
				  self.classList(true,'','institution');
				} 
				
			})
			.catch(function (error) {
				//console.log(error);
                //var re = {"status" : error.response.status, "message" : `Error Code ${error.response.status} : ${error.response.statusText}`};
				//commonObj.catchErr(re);
			});
			
		}
		classList(onchange = false, fromCall = '',selected = ''){
            
			commonObj.paceRestart('classList');
			
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var jsValue			= this.ext.jsValue;
			var extra			= this.ext.extra;
			var url			    = this.ext.extra.url;
			var selectedVal    	= jsValue.classVal;
			var searchVal       = this.getSearchVal(onchange,fromCall);
			var self = this;
			
			if(selected){
				selectedVal = selected;
			}
			
			var postData    = {
								'selectedId':selectedVal,
								'searchVal' : searchVal,
								'fromCall'  : fromCall,
								'onchange'  : onchange
							  };
			 
			$(ids.classId).html(commonObj.createOptions({},selectedVal,'Class'));
			
            /* this.getPostData = this.post(url.getClassOptions,postData); */

			axios.post(url.getClassOptions,postData)
			.then(function (response) {
				
				var getData = response.data;
                self.disableUndisable(getData.optionData);
				$.when($(ids.classId).html(commonObj.createOptions(getData.classes,selectedVal,"Class"))).done(function(){
                    if(getData.optionData.selectedId != '' && int(getData.optionData.selectedId)){
                        $(ids.classId).val(getData.optionData.selectedId);
                    }
                    
                });
				
			})
			.catch(function (error) {
				//console.log(error);
                //var re = {"status" : error.response.status, "message" : `Error Code ${error.response.status} : ${error.response.statusText}`};
				//commonObj.catchErr(re);
			});
			
		}
        get(url,postData){

            var responseData = axios.get(url,{ params: postData })
			.then(function (response) {
				return response; 
			})
			.catch(function (error) {
				
				if (error.response) {
                  return  {"status" : error.response.status, "message" : `Error Code ${error.response.status} : ${error.response.statusText}`};
				}else{
				  return  {"status" : 500 ,"message" : "Error Code 500 : Something went wrong"};
				}
			});
            return responseData;
            this.getPostData = responseData;
        }
        post(url,postData){

            var responseData = axios.post(url,postData)
			.then(function (response) {
				return response; 
			})
			.catch(function (error) {
                var re = {"status" : error.response.status, "message" : `Error Code ${error.response.status} : ${error.response.statusText}`};
				return re;
			});
            return responseData;
            this.getPostData = responseData;
        }
        
        
}
if (typeof joinClassObj != "undefined") {
   var JoinAClass = new JoinAClassBox(joinClassObj);
}
if (typeof joinClassObj2 != "undefined") { 
   var JoinAClass2 = new JoinAClassBox(joinClassObj2);
}

/* export {JoinAClassBox} */
