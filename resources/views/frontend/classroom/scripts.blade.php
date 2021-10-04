
@section('scripts')
<link rel="stylesheet" href="https://cdn.plyr.io/3.6.1/plyr.css" />
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.plyr.io/3.6.1/plyr.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script>
const player = new Plyr('#video_player_box',{
  settings: ['captions', 'quality', 'speed', 'loop'],
});

player.on('ended', event => {
	var nextVideo = $("#nextVideo").val();
	if(nextVideo != '' && nextVideo > 0 ){
		classroomObj.playVideo(nextVideo);
	}
  //player.restart();
});
</script>
<script>

var dataObj = { 
    
    separator:'/', 
    strDouble:'"', 
    strSingle:"'", 
    parentUrl:'{{URL::to("/")}}',
   jsId : {
        defaultClassroomDate        : "#defaultClassroomDate",
        nextVideo                   : "#nextVideo",
        forNextPlay                 : "#forNextPlay-",
        myModalFlagVideo            : "#myModalFlagVideo",
        flegStatus                  : "#flegStatus",
        setFlegBtnId                : "#setFlegBtnId",
        spamBtnHtm                  : "#spamBtnHtm",
        spamBtnId                   : "#spamBtnId",
        flegVideoInputId            : "#flegVideoInputId",
        videoPlayer    	            : "#videoPlayer",
        totalView    	            : "#totalView",
        totalViewsInput    	        : "#total-views-",
        notesBtnId    	            : "#notesBtnId",
        archibeSearch    	        : "#archibeSearch",
        semesterBtnSearchBox    	: "#semesterBtnSearchBox",
        semesterYear        		: "#semesterYear",
        semesterSelect        		: "#semesterSelect",
        semesterDate        		: "#semesterDate",
        videoAction        			: "#videoAction",
        favBtnHtm        			: "#favBtnHtm",
        videoTopicInput    			: "#video-topic-",
        videoTopic       			: "#videoTopic",
        favBtnId        			: "#favBtnId",
        donloadNoteInput        	: "#donloadNoteInput",
        defaultPlay        			: "#defaultPlay",
        myTabJust        			: "#myTabJust",
        videoTeacher       			: "#videoTeacher",
        currentVideo       			: "#currentVideo",
        videoPlayerBox        	    : "#video_player_box",
        videoUrl        			: "#video_url-",
        schoolsTabJust        		: "#schools-tab-just",
        coursesTabJust        		: "#courses-tab-just",
        activeTabInput        		: "#activeTabInput",
        playinglList        		: "#playinglList",
        questionsList           	: "#questionsList",
        archiveList           		: "#archiveList",
        angleSpanId               	: "#angle-span-",
        playBtnId               	: "#play-btn-",
        playingMore               	: "#playingMore",
        questionsMore              	: "#questionsMore",
        archiveMore               	: "#archiveMore",
        favouritesMore             	: "#favouritesMore",
        playingPage               	: "#playingPage",
        questionsPage              	: "#questionsPage",
        archivePage               	: "#archivePage",
        favouritesPage            	: "#favouritesPage",
        videoShowing            	: "#videoShowing",
        videoSubject            	: "#videoSubject",
        videoTitleInput          	: "#video-title-",
        videoSubjectInput          	: "#video-subject-",
        videoTeacherInput          	: "#video-teacher-",
        favouritesList           	: "#favouritesList",
        postQuestionsBtn           	: "#postQuestionsBtn-",
        activetedTab            	: "#activetedTab",
        cartPlaying             	: "#cart-playing-",
        replyBoxId              	: "#reply-box-id-",
        collapseId              	: "#collapse-",
        askQuestion             	: "#ask_question-"
    },
	status : {
        success     : 200
    },
    jsClass : {
        forNextPlay 	        : ".forNextPlay",
        navItem 				: ".nav-item",
        navLink 				: ".nav-link",
        accordionToggle 		: ".accordion-toggle",
        acHeader 				: ".ac-header",
        collapseJs 				: ".collapse-js",
        angleSpan 				: ".angle-span",
        playBtn 				: ".play-btn",
        playing 				: ".playing",
        contentOpen 			: ".content-open",
        replyBoxClass 			: ".replyBoxClass",
        active 					: ".active",
        dnone 					: ".d-none"
    },
	jsData : {
        playing 				: "playing",
        questions 				: "questions",
        archive 				: "archive",
        favourites 				: "favourites"
    },
	jsNames : {
        noname 			: "",
    },
	jsValue : {
        categoryName		: "{{$defaultVideo->school->category_name}}",
        classroom_id		: "{{$classroom_id}}",
        school_id		    : "{{$defaultVideo->school_id}}",
        course_id		    : "{{$defaultVideo->course_id}}",
        class_id		    : "{{$defaultVideo->class_id}}",
        video    			: "{{$defaultVideo->id}}",
        playOn    			: "{{$defaultVideo->play_on}}"
    },
    extra : { 
        jsSeparator:'-',
		url : {
				playing     : '{{route("frontend.playingData")}}',
				questions   : '{{route("frontend.questionsData")}}',
				archive     : '{{route("frontend.archiveData")}}',
				favourites  : '{{route("frontend.favouritesData")}}',
				playVideo   : '{{route("frontend.playVideo")}}',
				postQuestions        : '{{route("frontend.postQuestions")}}',
				setFavourites        : '{{route("frontend.setFavourites")}}',
				flegVideo            : '{{route("frontend.flegVideo")}}',
				archiveSearch        : '{{route("frontend.archiveSearch")}}',
				getSemesterOptions   : '{{route("frontend.getSemesterOptions")}}',
				getSemesterDaterange : '{{route("frontend.getSemesterDaterange")}}',
				studentDownloads     : '{{route("frontend.studentDownloads")}}'
		}
    },
	createUrl : function(set){ 
        return ( this.parentUrl+this.separator+set);
    },
	createId : function(arr){ 
        return ( arr.join(''));
    }
} 

/* import {Classroom} from "/js/classroom.js";
(function() {  window.classroomObj = new Classroom(dataObj);  })();   */
</script> 
<script src="{{ asset('js/classroom.js') }}"></script>

@stop

