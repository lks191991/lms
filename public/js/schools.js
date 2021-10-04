class Schools{
	
		constructor(external){
           
			this.ext            = external;
            var jsValue         = this.ext.jsValue;
			this.institutionVal = jsValue.institutionVal;
			this.schoolVal      = jsValue.schoolVal;
            this.courseVal      = jsValue.courseVal;
            this.classVal       = jsValue.classVal;
            this.searchVal      = jsValue.searchVal;
            this.getPostData    = "";
            this.tabToUrl       = "school";
			this.insertDefaultSelectBoxVal();
			this.listSchoolAndCourse();
			this.alertErr();
		
		} 
		listSchoolAndCourse(tab = '',loadMore = 0,ex = 0){
			
			var self = this;
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var jsData			= this.ext.jsData;
			var extra			= this.ext.extra;
			var url			    = this.ext.extra.url;
			var institutionId   = $(ids.institutionId).val();
			var schoolId    	= $(ids.schoolId).val();
			var courseId    	= $(ids.courseId).val();
			var classId    		= $(ids.classId).val();
			var searchInput     = $(ids.searchInput).val();
			
			var pageNo   = 1;
			var htmlId   = "";
			var MoreId   = "";
			var setLoder = "";
			
			if(this.institutionVal != "")
				 institutionId = this.institutionVal;
			if(this.schoolVal != "")
				 schoolId = this.schoolVal;
			if(this.courseVal != "")
				 courseId = this.courseVal;
			if(this.classVal != "")
				 classId  = this.classVal;
			if(this.searchVal != "")
				 searchInput  = this.searchVal;
			
			if(tab == ''){
				tab = $(ids.activeTabInput).val();
			} else {
				$(ids.activeTabInput).val(tab);
			}
			
			if(tab == 'course') {
				htmlId 		  = ids.courseList;
				MoreId        = ids.courseMore;
				pageNo        = $(ids.coursePage).val();
				setLoder      = ids.courseList;
				if($(ids.activetedTab).data(jsData.course) && loadMore == 0 && ex == 0){
					return false;
				}else{
					$(ids.activetedTab).data(jsData.course,1)
				}
			} else if(tab == 'school') {
				htmlId 		  = ids.schoolList;
				MoreId        = ids.schoolMore;
				pageNo        = $(ids.schoolPage).val();
				setLoder      = ids.schoolList;
				if($(ids.activetedTab).data(jsData.school) && loadMore == 0 && ex == 0){
					return false;
				}else{
					$(ids.activetedTab).data(jsData.school,1)
				}
			} else if(tab == 'classes') {
				htmlId 		  = ids.classesList;
				MoreId        = ids.classesMore;
				pageNo        = $(ids.classesPage).val();
				setLoder      = ids.classesList;
				if($(ids.activetedTab).data(jsData.classes) && loadMore == 0 && ex == 0){
					return false;
				}else{
					$(ids.activetedTab).data(jsData.classes,1)
				}
			}
			
			if(searchInput != ''){
				$(ids.searchForMainDiv).removeClass('d-none');
				$(ids.searchFor).html(searchInput);
			}else{
				$(ids.searchForMainDiv).addClass('d-none');
			}
			
			if(loadMore == 1){
				$(setLoder).append(commonObj.bootLoder());
			} else {
				$(setLoder).html(commonObj.bootLoder());
				pageNo   = 1;
			}
			$(MoreId).hide();
			
			var postData    = {
								'institution_id':institutionId,
								'school_id':schoolId,
								'course_id':courseId,
								'class_id':classId,
								'tab':tab,
								'loadMore':loadMore,
								'page':pageNo,
								'search_input':searchInput
								};
			
			
			var postUrl = url.school;
			if(tab == 'course')
				postUrl = url.course;
			if(tab == 'classes')
				postUrl = url.classes;
			
			var responseData = axios.post(postUrl,postData)
			.then(function (response) {
				var getData = response.data;
				
				setTimeout(function(){ 
				
					$("#loderId").remove();
					if(getData.tab == 'course'){
						$(ids.coursePage).val(getData.page);
					} else if(getData.tab == 'school'){
						$(ids.schoolPage).val(getData.page);
					}else if(getData.tab == 'classes'){
						$(ids.classesPage).val(getData.page);
					}
					
					if(getData.loadMore == 1){
					   $.when($(htmlId).append(getData.resultHtml)).done();
					} else { 
					   $.when($(htmlId).html(getData.resultHtml)).done();
					}
					
					if(getData.show_morerecords == 1){
						$(MoreId).show('slow');
					} else {
						$(MoreId).hide('slow');
					}
					
				}, 500);
					self.removeDefaultSelectBoxVal();
				
			})
			.catch(function (error) {
				
				commonObj.catchErr(error);
			});	
			
		}
		insertDefaultSelectBoxVal(){

			var jsValue         = this.ext.jsValue;
			this.institutionVal = jsValue.institutionVal;
			this.schoolVal      = jsValue.schoolVal;
            this.courseVal      = jsValue.courseVal;
            this.classVal       = jsValue.classVal;
            this.searchVal      = jsValue.searchVal;
		}
		removeDefaultSelectBoxVal(){
			var jsValue		 = this.ext.jsValue;
			this.institutionVal   = "";
			this.schoolVal        = "";
            this.courseVal        = "";
            this.classVal         = "";
            this.searchVal        = "";
		}
		alertErr(){

			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var jsData			= this.ext.jsData;
			var extra			= this.ext.extra;
			var jsValue			= this.ext.jsValue;
			
			if(jsValue.errStatus == 1){
			  commonObj.messages(jsValue.errType,jsValue.errMessage);
			}
			
		}
        
        
}

	var schoolsObj = new Schools(dataObj);
  

