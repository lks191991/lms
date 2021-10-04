class Student{
	
		constructor(external){
			this.ext            = external;
			this.studentHistory();
		
		} 
		studentHistory(tab = '',loadMore = 0,ex = 0){
            var self = this;
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var jsData			= this.ext.jsData;
			var jsValue			= this.ext.jsValue;
			var extra			= this.ext.extra;
			var url			    = this.ext.extra.url;
			
			if(tab == ''){
				tab = $(ids.activeTabInput).val();
			} else {
				$(ids.activeTabInput).val(tab);
			}
			
			var setLoder = "";
			var MoreId = "";
			var postUrl  = url.histories;
			var pageNo   = 1;
			
			if(tab == 'histories') {
				setLoder      = ids.historyHtml;
				postUrl       = url.histories;
				MoreId        = ids.historyMore;
				pageNo        = $(ids.historyPage).val();
				if($(ids.activetedTab).data(jsData.histories) && loadMore == 0 && ex == 0){
					return false;
				}else{
					$(ids.activetedTab).data(jsData.histories,1)
				}
			} else if(tab == 'favourites') {
				setLoder      = ids.favouritesHtml;
				postUrl       = url.favourites;
				MoreId        = ids.favouritesMore;
				pageNo        = $(ids.favouritesPage).val();
				if($(ids.activetedTab).data(jsData.favourites) && loadMore == 0 && ex == 0){
					return false;
				}else{
					$(ids.activetedTab).data(jsData.favourites,1)
				}
			}
			
			$(MoreId).hide();
			
			if(loadMore == 1){
				$(setLoder).append(commonObj.bootLoder());
				 pageNo   = pageNo;
			} else {
				$(setLoder).html(commonObj.bootLoder());
				pageNo   = 1;
			}
			
			var school_id = $(ids.school_id).val();
			var course_id = $(ids.course_id).val();
			
			var postData    = {
								'tab':tab,
								'page':pageNo,
								'school_id':school_id,
								'course_id':course_id,
								'loadMore':loadMore
								};
			
			
			var responseData = axios.post(postUrl,postData)
			.then(function (response) {
				var getData = response.data;
				
				setTimeout(function(){ 
					$("#loderId").remove();
					var htmlId = "";
					if(getData.tab == 'histories'){
						htmlId = ids.historyHtml;
						$(ids.historyPage).val(getData.page);
						if(getData.show_morerecords == 1){
							$(ids.historyMore).show('slow');
						} else {
							$(ids.historyMore).hide('slow');
						}
					} else if(getData.tab == 'favourites'){
						htmlId = ids.favouritesHtml;
						$(ids.favouritesPage).val(getData.page);
						if(getData.show_morerecords == 1){
							$(ids.favouritesMore).show('slow');
						} else {
							$(ids.favouritesMore).hide('slow');
						}
					}
					
					if(getData.loadMore == 1){
					   $.when($(htmlId).append(getData.resultHtml)).done();
					} else { 
					   $.when($(htmlId).html(getData.resultHtml)).done();
					}
					
				
				}, 500);
					
			})
			.catch(function (error) {
				commonObj.catchErr(error);
			});
			
		}
		removeStudentHistory(id,removeFrom = 'history'){
			var self = this;
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var jsValue			= this.ext.jsValue;
			var extra			= this.ext.extra;
			var url			    = this.ext.extra.url;
			
			if(!confirm("Are you sure want to remove this!"))
			{
				return false;
			}
			
			var postUrl  = url.rmHistories;
			var rowId = '';
			if(removeFrom == 'favourite'){
			 $(this.ext.createId([ids.btnRmFav,id])).html(commonObj.iconLoder());
			  rowId = this.ext.createId([ids.favRow,id]);
			}else{
			 $(this.ext.createId([ids.btnRmHistory,id])).html(commonObj.iconLoder());
			  rowId = this.ext.createId([ids.historyRow,id]);
			}
			
			
			var postData    = {
								'id':id,
								'rmFrom':removeFrom
								};
			
			
			var responseData = axios.post(postUrl,postData)
			.then(function (response) {
				var getData = response.data;
				 
				setTimeout(function(){ 
				 $.when($(rowId).hide('slow')).done($(rowId).remove());
				  
				}, 500);
					
			})
			.catch(function (error) {
				commonObj.catchErr(error);
			});
			if(removeFrom == 'favourite'){
				if(commonObj.rowCount(jsClass.favRowCount) <= 1)
				{
				  self.studentHistory('',0,1); 
				}
			}else{
				if(commonObj.rowCount(jsClass.historyRowCount) <= 1)
				{
				  self.studentHistory('',0,1); 
				}
			}
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
           
            this.getPostData = responseData;
        }
        
        
}

var studentObj = new Student(studentCon);
