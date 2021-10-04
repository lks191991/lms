/* import {Common} from "/js/common.js"; */
class Classroom{
	
		constructor(external){
            /* super(); */
			this.ext            = external;
            this.activeQusBox   = 0;
            this.visibleAcor    = "";
            this.getPostData    = "";
            this.lastPlayId     = "";
            this.video          = external.jsValue.video;
            this.tabToUrl       = "playing";
			this.listClassroom();
			this.getSemesterDateRange('semester');
		
		} 
		listClassroom(tab = '',loadMore = 0, ex = 0){
            commonObj.paceRestart('listClassroom');
			var self = this;
			var ids				= self.ext.jsId;
			var jsClass			= self.ext.jsClass;
			var jsValue			= self.ext.jsValue;
			var extra			= self.ext.extra;
			var url			    = self.ext.extra.url;
			var jsData		    = self.ext.jsData;
			var classroom_id	= jsValue.classroom_id;
			
			
			
			if(tab == ''){
				tab = $(ids.activeTabInput).val();
			} else {
				$(ids.activeTabInput).val(tab);
			}
			
			var setLoder = "";
			var postUrl  = url.school;
			var pageNo   = 1;
			var htmlId   = "";
			var MoreId   = "";
			
			if(tab == 'playing') {
				setLoder      = ids.playinglList;
				postUrl       = url.playing;
				htmlId 		  = ids.playinglList;
				MoreId        = ids.playingMore;
				pageNo        = $(ids.playingPage).val();
				if($(ids.activetedTab).data(jsData.playing) && loadMore == 0 && ex == 0){
					return false;
				}else{
					$(ids.activetedTab).data(jsData.playing,1)
				}
			} else if(tab == 'questions') {
				setLoder      = ids.questionsList;
				postUrl       = url.questions;
				htmlId        = ids.questionsList;
				MoreId        = ids.questionsMore;
				pageNo        = $(ids.questionsPage).val();
				var parentBox = self.ext.createId([ids.replyBoxId,'0']);
				$(parentBox).show('slow');
				if($(ids.activetedTab).data(jsData.questions) && loadMore == 0 && ex == 0){
					//return false;
				}else{
					$(ids.activetedTab).data(jsData.questions,1)
				}
			}else if(tab == 'archive') {
				setLoder      = ids.archiveList;
				postUrl       = url.archive;
				htmlId        = ids.archiveList;
				MoreId        = ids.archiveMore;
				pageNo        = $(ids.archivePage).val();
				if($(ids.activetedTab).data(jsData.archive) && loadMore == 0 && ex == 0){
					return false;
				}else{
					$(ids.activetedTab).data(jsData.archive,1)
				}
			}else if(tab == 'favourites') {
				setLoder      = ids.favouritesList;
				postUrl       = url.favourites;
				htmlId        = ids.favouritesList;
				MoreId        = ids.favouritesMore;
				pageNo        = $(ids.favouritesPage).val();
				if($(ids.activetedTab).data(jsData.favourites) && loadMore == 0 && ex == 0){
					return false;
				}else{
					$(ids.activetedTab).data(jsData.favourites,1)
				}
			}
			
			
			if(loadMore == 1){
				$(setLoder).append(commonObj.bootLoder());
			} else {
				$(setLoder).html(commonObj.bootLoder());
				pageNo   = 1;
			}
			$(MoreId).hide();
			var video_id = $(ids.currentVideo).val();
			var postData    = {
								'classroom_id':classroom_id,
								'video_id':video_id,
								'play_on':jsValue.playOn,
								'page':pageNo,
								'tab':tab,
								'video':self.video,
								'loadMore':loadMore
								};
			
			
            //this.get(postUrl,postData);
			
			var responseData = axios.get(postUrl,{ params: postData })
			.then(function (response) {
				
				var getData = response.data;
				var pass = self;
				setTimeout(function(){ 
				
					$("#loderId").remove();
					if(getData.tab == 'playing'){
						$(ids.playingPage).val(getData.page);
					} else if(getData.tab == 'questions'){
						$(ids.questionsPage).val(getData.page);
					} else if(getData.tab == 'archive'){
						$(ids.archivePage).val(getData.page);
					} else if(getData.tab == 'favourites'){
						$(ids.favouritesPage).val(getData.page);
					}
					
					if(getData.loadMore == 1){
					   $.when($(htmlId).append(getData.resultHtml)).done();
					} else { 
                        
                        $.when($(htmlId).html(getData.resultHtml)).done();

					}
                    if(getData.tab == 'playing'){
						self.addDefaultVideo($(self.ext.jsId.currentVideo).val());
						self.nextVideoDefine();
					}
					self.video = "";
					if(getData.show_morerecords == 1){
						$(MoreId).show('slow');
					} else {
						$(MoreId).hide('slow');
					}
					
					/* if(self.video < 1 && getData.tab == 'playing' && loadMore < 1){
						self.playVideo($(self.ext.jsId.defaultPlay).val());
					}
					 */
				
				}, 500,self);
				
				
			})
			.catch(function (error) {
				commonObj.catchErr(error);
			});			
			
			
		}
		addDefaultVideo(lession_id){
           
            var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var extra			= this.ext.extra;
			var jsData			= this.ext.jsData;
            var iconPlay        = commonObj.iconPlay();
			var playBtnDivId	= this.ext.createId([ids.playBtnId,lession_id]);
              
                $(playBtnDivId).html(iconPlay);
				this.lastPlayId = playBtnDivId;
		}
		postQuestions(parent_id = 0, sender_type = 'question'){
			var self = this;
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var jsValue			= this.ext.jsValue;
			var extra			= this.ext.extra;
			var url			    = this.ext.extra.url;
			var classroom_id		= jsValue.classroom_id;
			var askQuestion		= this.ext.createId([ids.askQuestion,parent_id]);
			var askQuestionVal  = $(askQuestion).val();
			var currentVideoVal = $(ids.currentVideo).val();
			var postQuestionsBtn= this.ext.createId([ids.postQuestionsBtn,parent_id]);
			var tab = $(ids.activeTabInput).val();
			commonObj.btnDesEnb(postQuestionsBtn,"POST",'des');
			commonObj.paceRestart('postQuestions');
			var setLoder = "";
			var postUrl  = url.postQuestions;
			
			
			var postData    = {
								'classroom_id':classroom_id,
								'video_id':currentVideoVal,
								'content':askQuestionVal,
								'parent_id':parent_id,
								'sender_type':sender_type,
								'tab':tab
								};
			
			var responseData = axios.get(postUrl,{ params: postData })
			.then(function (response) {
				var getData = response.data;
				commonObj.btnDesEnb(postQuestionsBtn,"POST",'enb');
				if(!getData.errStatus)
				{
				  commonObj.messages(getData.messageType,getData.message);
				}else {
					$(askQuestion).val("");
					commonObj.messages(getData.messageType,getData.message);
					self.listClassroom('',0,1);
				}
				
			})
			.catch(function (error) {
				commonObj.btnDesEnb(postQuestionsBtn,"POST",'enb');
				commonObj.catchErr(error);
			});		
			
		}
		playVideo(lession_id){
			var self = this;
			var ids				= self.ext.jsId;
			var jsClass			= self.ext.jsClass;
			var extra			= self.ext.extra;
			var jsData			= self.ext.jsData;
			var url			    = self.ext.extra.url;
			var tab             = $(ids.activeTabInput).val();
			var urlInputId	    = self.ext.createId([ids.videoUrl,lession_id]);
			var titleInputId	= self.ext.createId([ids.videoTitleInput,lession_id]);
			var subjectInputId	= self.ext.createId([ids.videoSubjectInput,lession_id]);
			var videoTeacherInput = self.ext.createId([ids.videoTeacherInput,lession_id]);
			var playBtnDivId	= self.ext.createId([ids.playBtnId,lession_id]);
			var cartPlayingId	= self.ext.createId([ids.cartPlaying,lession_id]);
			var videoTopicId	= self.ext.createId([ids.videoTopicInput,lession_id]);
			var totalViewsId	= self.ext.createId([ids.totalViewsInput,lession_id]);
			
			var videoTitle 	    = $(titleInputId).val();
			var videoTopicVal 	= $(videoTopicId).val();
			var videoSubject 	= $(subjectInputId).val();
			var videoTeacher 	= $(videoTeacherInput).val();
			var videoUrl 	    = $(urlInputId).val();
			var totalViewsVal 	= $(totalViewsId).val();
			var getPlayer       = commonObj.playIframVideo(videoUrl);
			var iconLoder       = commonObj.iconLoder();
			var iconPlay        = commonObj.iconPlay();
			var iconView        = commonObj.iconView();
			$(ids.currentVideo).val(lession_id);
			$(ids.activetedTab).data(jsData.questions,0);
			$(jsClass.playing).each(function(){
				$(this).removeClass('playing');
			});
			commonObj.paceRestart('playVideo');
			
			$(playBtnDivId).html(iconLoder);
			
			var postData    = {
								'lession_id':lession_id,
								'tab':tab
								};
								
			var postUrl = url.playVideo;
			
			var responseData = axios.get(postUrl,{ params: postData })
			.then(function (response) {
				
				var getData = response.data;
				
				if(self.lastPlayId != ""){
					$(self.lastPlayId).html(iconView);
				}
				
				var actionBtn = '';
				var favClass  = '';
				var flegClass  = '';
				if(getData.lern_more != '')
				{
				   actionBtn += `<div class="pb-2 learn-more"> <a target="_blank" href="${getData.lern_more}" >Learn more</a>  </div>`;
				}
				if(getData.note_url != '')
				{
				   actionBtn += `<button class="btn-custom" title="Download note" id="notesBtnId" onclick="classroomObj.downloadNotes(${getData.notes_id})"><span class="icon"><i class="fas fa-book"></i></span>Get notes</button> <input type="hidden" value="${getData.note_url}" id="donloadNoteInput"/>`;
				}
				if(getData.fav_status > 0)
				{
				   favClass  = ' fav-active';
				}
                if(getData.fleg_status > 0)
				{
				   flegClass  = ' fav-active';
				}
				actionBtn += `<span id="favBtnHtm"><button class="btn-custom fav-btn" title="Add favourite" id="favBtnId" onclick="classroomObj.setFavourites(${getData.video_id},${getData.fav_status})"><span class="icon ${favClass}"><i class="fas fa-star"></i></span></button></span>`;

                actionBtn += `<span id="spamBtnHtm"><button class="report-btn-custom fav-btn" title="Report this video" id="spamBtnId" onclick="classroomObj.openFlegPopup(${getData.video_id},${getData.fleg_status})"><span class="icon ${favClass}"><i class="fas fa-flag"></i></span></button></span>`;
				
				$(ids.videoTopic).html(videoTopicVal);
				$(ids.videoAction).html(actionBtn);
				$(ids.videoShowing).html(videoTitle);
				$(ids.videoSubject).html(videoSubject);
				$(ids.videoTeacher).html(videoTeacher);
				$(ids.totalView).html(getData.totalViewsVal);
				$(cartPlayingId).addClass('playing');
				
				$.when($(playBtnDivId).html(iconPlay)).done();
				self.lastPlayId = playBtnDivId;	
				
				commonObj.setMeta(getData.title,getData.description,getData.keywords);
				self.nextVideoDefine();
				
			})
			.catch(function (error) {
				commonObj.catchErr(error);
			});	 
			
			$(ids.videoPlayerBox).html(commonObj.bootLoder());
			$(ids.videoPlayerBox).html(getPlayer);

            new Plyr(ids.videoPlayerBox);
          
			 
		}
		nextVideoDefine(){
			var self = this;
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var currentVideo    = $(ids.currentVideo).val();
			
			var i      = 0;
			var nextId = 0;
			
				$(jsClass.forNextPlay).each(function(){
					
					if(i == 1){
						nextId = $(this).val();
						i      = 2;
					}
					if($(this).val() == currentVideo){
					   i      = 1;
				    }
				  
			    });
				
			$(ids.nextVideo).val(nextId);
		}
		
		setFavourites(video_id,fav_status){
			var self = this;
			commonObj.paceRestart('setFavourites');
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var jsValue			= this.ext.jsValue;
			var extra			= this.ext.extra;
			var url			    = this.ext.extra.url;
			var favBtnId        = ids.favBtnId;
			var favClass        = '';
			
			if(fav_status != '')
			{
				favClass  = ' fav-active';
			}
			
			var name = `<span class="icon ${favClass}"><i class="fas fa-star"></i></span>`;
			commonObj.btnDesEnb(favBtnId,name,'des');
			
			var postUrl  = url.setFavourites;
			
			
			var postData    = {
								'video_id':video_id,
								'fav_status':fav_status
								};
			
			
			var responseData = axios.get(postUrl,{ params: postData })
			.then(function (response) {
				commonObj.btnDesEnb(favBtnId,name,'enb');
				var getData = response.data;
				
				if(!getData.errStatus)
				{
                  commonObj.openLoginModel();
				  commonObj.messages(getData.messageType,getData.message);
				}else {
				 
					commonObj.messages(getData.messageType,getData.message);
					 favClass  = '';
					if(getData.fav_status != '')
					{
						favClass  = ' fav-active';
					}
				     name = `<span class="icon ${favClass}"><i class="fas fa-star"></i></span>`;
					 
					var actionBtn = `<button class="btn-custom fav-btn" title="Add favourite" id="favBtnId" onclick="classroomObj.setFavourites(${getData.video_id},${getData.fav_status})"><span class="icon ${favClass}"><i class="fas fa-star"></i></span></button>`;
					
					$(ids.favBtnHtm).html(actionBtn);
					commonObj.btnDesEnb(favBtnId,name,'enb');
					 
				}
				
			})
			.catch(function (error) {
				commonObj.btnDesEnb(favBtnId,name,'enb');
				commonObj.catchErr(error);
			});
			
		}
        openFlegPopup(video_id,fleg_status){
			var self = this;
            if(fleg_status == 1)
			{
				commonObj.messages('warning',"You have already reported this video.");
                return false;
			} 
            $(this.ext.jsId.myModalFlagVideo).modal('show');
            $(this.ext.jsId.flegStatus).val(fleg_status);
        }
        setFleg(){
			commonObj.paceRestart('setFleg');
			var self = this;
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var jsValue			= this.ext.jsValue;
			var extra			= this.ext.extra;
			var url			    = this.ext.extra.url;
			var spamBtnId       = ids.spamBtnId;
			var setFlegBtnId    = ids.setFlegBtnId;
			var flegClass       = '';
            var fleg_status     = $(ids.flegStatus).val();
            var video_id        = $(ids.currentVideo).val();
			var flegMessage     = $(ids.flegVideoInputId).val();
			if(fleg_status == 1)
			{
				flegClass  = ' fav-active';
			}

            if(flegMessage == '')
			{
				commonObj.messages('error',"Please describe your reason");
                return false;
			}
			
			var name = `<span class="icon ${flegClass}"><i class="fas fa-flag"></i></span>`;
			commonObj.btnDesEnb(spamBtnId,name,'des');
			commonObj.btnDesEnb(setFlegBtnId,"POST",'des');
			
			var postUrl  = url.flegVideo;
			
			
			var postData    = {
								'message':flegMessage,
								'video_id':video_id,
								'fleg_status':fleg_status
								};
			
			
            var responseData = axios.get(postUrl,{ params: postData })
			.then(function (response) {
				commonObj.btnDesEnb(spamBtnId,name,'enb');
				commonObj.btnDesEnb(setFlegBtnId,"POST",'enb');
				
				var getData = response.data;
                if(getData.isLogin != 1)
				{
                  $(self.ext.jsId.myModalFlagVideo).modal('hide');  
                  commonObj.openLoginModel();
                }
				if(!getData.errStatus)
				{
				  commonObj.messages(getData.messageType,getData.message);
				}else {
				 
					commonObj.messages(getData.messageType,getData.message);
					 flegClass  = '';
					if(getData.fleg_status == 1)
					{
						flegClass  = ' fav-active';
					}
				     name = `<span class="icon ${flegClass}"><i class="fas fa-flag"></i></span>`;
					 
					var actionBtn = `<button class="report-btn-custom fav-btn" title="Report this video" id="favBtnId" onclick="classroomObj.openFlegPopup(${getData.video_id},${getData.fleg_status})"><span class="icon ${flegClass}"><i class="fas fa-flag"></i></span></button>`;
					$(self.ext.jsId.myModalFlagVideo).modal('hide');
                    $(ids.flegVideoInputId).val('');
                    $(ids.flegStatus).val(0);
					$(ids.spamBtnHtm).html(actionBtn);
                    commonObj.btnDesEnb(spamBtnId,name,'enb');
					commonObj.btnDesEnb(setFlegBtnId,"POST",'enb');
					 
				}
				
			})
			.catch(function (error) {
				commonObj.btnDesEnb(spamBtnId,name,'enb');
				commonObj.btnDesEnb(setFlegBtnId,"POST",'enb');
				commonObj.catchErr(error);
			});	
			
		}
		downloadNotes(notes_id){
			var self = this;
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var extra			= this.ext.extra;
			var url			    = this.ext.extra.url;
			var btnName         = '<span class="icon"><i class="fas fa-book"></i></span>Get notes';
			commonObj.paceRestart('downloadNotes');
			if(!notes_id){
				return false;
			}
			commonObj.btnDesEnb(ids.notesBtnId,btnName,'des');
			var postUrl  = url.studentDownloads;
			
			var postData    = {
								'notes_id'	:notes_id
								};
			
			
			var responseData = axios.get(postUrl,{ params: postData })
			.then(function (response) {
				
				commonObj.btnDesEnb(ids.notesBtnId,btnName,'enb');
				var getData = response.data;

                if(getData.isLogin == 0){
                    
                     commonObj.openLoginModel();
                     commonObj.messages(getData.messageType,getData.message);
                }
				if(!getData.errStatus)
				{   
					commonObj.message(getData.messageType,getData.message);
				}else {
					commonObj.messages(getData.messageType,getData.message);
					var downloadUrl = $(ids.donloadNoteInput).val();
					window.open(downloadUrl,'_blank');
				}
				
			})
			.catch(function (error) {
				commonObj.btnDesEnb(ids.notesBtnId,btnName,'enb');
				commonObj.catchErr(error);
			});	
			
			
			
		}
		playingAccordion(attrData){
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var extra			= this.ext.extra;
			var url			    = this.ext.extra.url;
			var acord_id		= $(attrData).data('hrid');
			var lession_id		= $(attrData).data('lession_id');
			
			$(jsClass.collapseJs).hide('slow');
			$(jsClass.collapseJs).removeClass('content-open');
			var down = this.angleDown(); 
			var up   = this.angleUp(); 
			
			$(jsClass.angleSpan).each(function(){
				$(this).html(down);
			});
			
			$(this.ext.createId([ids.collapseId,lession_id])).addClass('content-open');
			
			if(this.visibleAcor == acord_id){
				$(acord_id).hide('slow');
				this.visibleAcor = "";
			} else{
				$(acord_id).show('slow');
				this.visibleAcor = acord_id;
				$(this.ext.createId([ids.angleSpanId,lession_id])).html(up);
			}
		 
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
           
            this.getPostData = responseData;
        }
        post(url,postData){

            var responseData = axios.post(url,postData)
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
           
            this.getPostData = responseData;
        }
		replyBox(parent_id, sender_type = 'reply', sendFrom){
			
			var self = this;
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var extra			= this.ext.extra;
			var addClass        = '';
			
			if(sendFrom == 'reply'){
				addClass = ' bg-secondary card-comment-margin';
			}
			
			var htmlId    = this.ext.createId([ids.replyBoxId,parent_id]);
			var parentBox = this.ext.createId([ids.replyBoxId,'0']);
			
			$(jsClass.replyBoxClass).each(function(){
					$(this).empty();
			});
			
			if(this.activeQusBox == parent_id)
			{
				self.activeQusBox   = 0;
				$(parentBox).show('slow');
				return false;
			}else{
				$(parentBox).hide('slow');
			}
			
			self.activeQusBox   = parent_id;
			 
			
			var htmlBox = `<div class="post-question mt-1 ${addClass} "> <form class="has-validation-callback"> <div class="form-group">  <textarea class="form-control" id="ask_question-${parent_id}" placeholder="reply to this user..."></textarea> </div> <div class="form-group m-0"> <div class="row"> <div class="col-12"> <button type="button" id="postQuestionsBtn-${parent_id}" onclick="classroomObj.postQuestions(${parent_id},'${sender_type}')" class="btn btn-primary w-100">REPLY</button> </div> </div> </div> </form> </div>`;
			
			$(htmlId).html(htmlBox);
			$(htmlId).show('slow');
			
		}
		
	    archiveSearch(callFrom = '', redirect = false){
			commonObj.paceRestart('archiveSearch');
			var self = this;
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var jsValue			= this.ext.jsValue;
			var extra			= this.ext.extra;
			var url			    = this.ext.extra.url;
			var searchBtn		= ids.archibeSearch;
			
			var semesterYearVal      = $(ids.semesterYear).val();
			var semesterSelectVal    = $(ids.semesterSelect).val();
			var semesterDateVal      = $(ids.semesterDate).val();
			
			/* if(redirect == false){
			 if(semesterYearVal && semesterSelectVal && semesterDateVal){
				if(this.isHidden(ids.semesterBtnSearchBox)){
					$(ids.semesterBtnSearchBox).hide();
				}
				$(ids.semesterBtnSearchBox).removeClass(this.clearClass(jsClass.dnone));
				$(ids.semesterBtnSearchBox).show('slow');
			 } else {
				$(ids.semesterBtnSearchBox).hide('slow');
			 }
		    } */
			
			if(callFrom == 'year'){
				this.fillSemester();
			}

			
			
			if((callFrom == 'semester' || callFrom == 'year')){
				this.datepickerSet(semesterSelectVal,callFrom);
			}
			 
			//console.log('semesterYear',semesterYearVal);
			//console.log('semesterSelect',semesterSelectVal);
			//console.log('semesterDate',semesterDateVal); 
			
			if(redirect == false) {
				return false;
			}
			
			/* if(semesterYearVal == '' || semesterSelectVal == '' || semesterDateVal == ''){ */
			if(semesterDateVal == ''){
				//commonObj.messages('error',"Plaese select all fields.");
				commonObj.messages('error',"Plaese select date.");
				return false;
			}
			
			var btnName = 'JOIN';
			//commonObj.btnDesEnb(searchBtn,btnName,'des');
			var postUrl  = url.archiveSearch;
			
			var postData    = {
								'classroom_id'	:jsValue.classroom_id,
								'school_id'	    :jsValue.school_id,
								'course_id'	    :jsValue.course_id,
								'class_id'	    :jsValue.class_id,
								'semester_year'	:semesterYearVal,
								'semester'		:semesterSelectVal,
								'semester_date'	:semesterDateVal
								};
			
			
            
			var responseData = axios.get(postUrl,{ params: postData })
			.then(function (response) {
			
				var getData = response.data;
				if(!getData.errStatus)
				{
					commonObj.messages(getData.messageType,getData.message);
				}else {
					commonObj.messages(getData.messageType,getData.message);
					//commonObj.btnDesEnb(searchBtn,btnName,'enb');
					
					commonObj.redirect(getData.redirectUrl);
				}
				
				
			})
			.catch(function (error) {
				commonObj.catchErr(error);
			});
		}
		fillSemester(){
			//console.log(111);
			commonObj.paceRestart('fillSemester');
			var self = this;
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var extra			= this.ext.extra;
			var jsValue			= this.ext.jsValue;
			var url			    = this.ext.extra.url;
			var school_id    	= jsValue.school_id;
			var classroom_id	= jsValue.classroom_id;
			var selectedVal	    = '';
			
			var semesterYearVal      = $(ids.semesterYear).val();
			var semesterSelectVal    = $(ids.semesterSelect).val();
			var semesterDateVal      = $(ids.semesterDate).val();
			var defaultClassroomDate = $(ids.defaultClassroomDate).val();
			  //selectedVal	         = semesterSelectVal;
			var postUrl  = url.getSemesterOptions;
			
			var postData    = {
								'school_id'	            :school_id,
								'classroom_id'	        :classroom_id,
								'semester_year'	        :semesterYearVal,
								'semester'		        :semesterSelectVal,
								'semester_date'	        :semesterDateVal,
								'defaultClassroomDate'	:defaultClassroomDate
								};
			
			
			var responseData = axios.get(postUrl,{ params: postData })
			.then(function (response) {
				var getData = response.data;
				var options = self.createSemesterOptions(getData,selectedVal,jsValue.categoryName);
				$(ids.semesterSelect).html();
				$(ids.semesterSelect).html(options);
			
			})
			.catch(function (error) {
				commonObj.catchErr(error);
			});
			
		}
        getSemesterDateRange(){
            var self = this;
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var extra			= this.ext.extra;
			var jsValue			= this.ext.jsValue;
			var url			    = this.ext.extra.url;
			var school_id    	= jsValue.school_id;
			var classroom_id	= jsValue.classroom_id;
			 
			var semesterYearVal      = $(ids.semesterYear).val();
			var semesterSelectVal    = $(ids.semesterSelect).val();
			var semesterDateBegin    = $(ids.semesterSelect).children("option:selected").data('datebegin');
			var semesterDateEnd      = $(ids.semesterSelect).children("option:selected").data('dateend');
			var semesterDateVal      = $(ids.semesterDate).val();
			var defaultClassroomDate = $(ids.defaultClassroomDate).val();

            var postUrl  = url.getSemesterDaterange;
			
			var postData    = {
								'school_id'	           :school_id,
								'classroom_id'	       :classroom_id,
								'semesterDateBegin'	   :semesterDateBegin,
								'semesterDateEnd'	   :semesterDateEnd,
								'semester_year'	       :semesterYearVal,
								'semester'		       :semesterSelectVal,
								'semester_date'	       :semesterDateVal,
								'defaultClassroomDate' :defaultClassroomDate
								};
			
			
			var responseData = axios.get(postUrl,{ params: postData })
			.then(function (response) {
			
				var getData = response.data;
				
			self.datepickerSet(semesterSelectVal, 'semester',getData.dateRange, getData.firstDate)
			})
			.catch(function (error) {
				commonObj.catchErr(error);
			});

        }
		datepickerSet(getSemesterSelectVal = '', callFrom = '',dateRange = '',firstDate = ''){
			
			var ids				= this.ext.jsId;
			var jsClass			= this.ext.jsClass;
			var extra			= this.ext.extra;
			var jsValue			= this.ext.jsValue;
			var url			    = this.ext.extra.url;
			var school_id    	= jsValue.school_id;
			var classroom_id	= jsValue.classroom_id;
			var defaultSelect	= "";
			 
			var semesterYearVal      = $(ids.semesterYear).val();
			var semesterSelectVal    = $(ids.semesterSelect).val();
			var semesterDateBegin    = $(ids.semesterSelect).children("option:selected").data('datebegin');
			var semesterDateEnd      = $(ids.semesterSelect).children("option:selected").data('dateend');
			var semesterDateVal      = $(ids.semesterDate).val();

			if(callFrom == 'year'){
				getSemesterSelectVal = '';
			}
            
            

			if(semesterDateBegin && semesterDateEnd){
				if(getSemesterSelectVal == ''){
					semesterDateBegin = "";
					semesterDateEnd = "";
				}					
				var calendar = flatpickr(ids.semesterDate, {
						inline: true,
						dateFormat: 'Y-m-d',
						monthSelectorType: 'static',
						yearSelectorType: 'static',
						minDate:semesterDateBegin,
						maxDate:semesterDateEnd,
						locale: {
							firstDayOfWeek: 1
						},
						/* defaultDate: dateRange[Object.keys(dateRange)[1]], */
						defaultDate: firstDate,
                        //enable: [dateRange]
						enable: [
                                    //{ 'from' : semesterDateBegin, 'to' : semesterDateEnd }
                                    function (date) {
                                        // return true to enable
                                        var from = new Date(semesterDateBegin + ' 00:00:00');
                                        var to = new Date(semesterDateEnd + ' 23:59:59');

                                        if (date.getTime() >= from.getTime() && date.getTime() <= to.getTime()) {
                                            if (dateRange[moment(date).format('YYYY-MM-DD')]) {
                                                return true;
                                            }
                                            /* if ((date.getDay() !== 0 && date.getDay() !== 6) && (dateRange[moment(date).format('YYYY-MM-DD')])) {
                                                
                                                return true;
                                            } */
                                        }
                                    }
                                ] 						
					},semesterDateBegin,semesterDateEnd,dateRange,defaultSelect,firstDate); 
				 
			}	
			
			
			
			/* console.log('semesterSelectVal',semesterSelectVal);
			console.log('semesterDateBegin',semesterDateBegin);
			console.log('semesterDateEnd',semesterDateEnd); */
			
		}
		createSemesterOptions(objData,selectedVal,firstOptionName)
		{
			 
			var options = '';
			if(firstOptionName != "")
			 options = `<option class="d-none" data-datebegin="" data-dateend=""  value=""> ${firstOptionName} </option>`;
		 
			if(Object.keys(objData).length != 0){
				
				$.each(objData,function(key,data){
				  var selectedVar = '';
				  if (key === selectedVal) 
					  selectedVar = "selected";
				   options += `<option data-datebegin="${data.date_begin}" data-dateend="${data.date_end}" value="${data.id}" ${selectedVar} >${data.semester}</option>`; 
				});
			}
		
			
			return options;
		}
		
        
        
}

if (typeof dataObj != "undefined") {
	var classroomObj = new Classroom(dataObj);
  
}
