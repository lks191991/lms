
@section('after-styles')
   <link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.3/flatpickr.min.css" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
@endsection

@section('scripts')
<script src="{{ asset('js/jquery.serializejson.js') }}"></script>
<script src="{{ asset('js/dropzone.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<script>
var tutorCon = { 
    
    separator:'/', 
    strDouble:'"', 
    strSingle:"'", 
    parentUrl:'{{URL::to("/")}}',
   jsId : {
        articleTitle                : "#article_title",
        articleSubject              : "#article_subject",
        articleImage                : "#article_image",
        articleContent              : "#article_content",
        articleKeywords             : "#article_keywords",
        videoDepartmentId           : "#video_departmentId",
        videoCourseId               : "#video_courseId",
        videoClassId                : "#video_classId",
        subjectId                   : "#subjectId",
        topicId                     : "#topicId",
        periodId                    : "#periodId",
        caption                     : "#caption",
        play_on                     : "#play_on",
        video_url_wrapper           : "#video_url_wrapper",
        video_url                   : "#video_url",
        message                     : "#message",
        keywords                    : "#keywords",
        AddVideoBtnDiv              : "#AddVideoBtnDiv",
        AddArticleBtnDiv            : "#AddArticleBtnDiv",
        AddVideoBtn          		: "#AddVideoBtn",
        AddArticleBtn          		: "#AddArticleBtn",
        postVideoTab          		: "#postVideoTab",
        postArticleTab          	: "#postArticleTab",
        articlePostForm          	: "#articlePostForm",
        videoPostForm          		: "#videoPostForm",
        videoPostBtn          		: "#videoPostBtn",
        articlePostBtn              : "#articlePostBtn",
        videoCancelBtn          	: "#videoCancelBtn",
        articleCancelBtn          	: "#articleCancelBtn",
        videoId          		    : "#video_id",
        lectureRow          		: "#lecture-row-",
        postsRow          	    	: "#posts-row-",
        btnLectureId            	: "#btn-lecture-id-",
        btnRmposts                 	: "#btn-rm-posts-",
        activeTabInput        		: "#activeTabInput",
        lectureHtml        		    : "#lectureHtml",
        postsHtml        		    : "#postsHtml",
        moreLectureBtnContainer          : "#moreLectureBtnContainer",
        lectureMore        		    : "#lectureMore",
        postsMore        		    : "#postsMore",
        lecturePage          		: "#lecturePage",
        postsPage        		    : "#postsPage",
        activetedTab           		: "#activetedTab",
        orderBy           		    : "#order_by"
       
    },
	status : {
        success     : 200
    },
    jsClass : {
        navItem 				: ".nav-item",
        postsCount 		        : ".posts-row-count",
        lectureRowCount 		: ".lecture-row-count",
        videoType                       : ".video_type"
        
    },
	jsData : {
        lecture 			: "lecture",
        posts 				: "posts"
    },
	jsNames : {
        noname 			: "",
    },
	jsValue : {
        user_id 			: "",
    },
    extra : { 
        jsSeparator:'-',
		url : {
			   lecture       : '{{route("frontend.tutorLecture")}}',
			   posts         : '{{route("frontend.tutorPosts")}}',
			   topicList     : '{{route("frontend.api.getTopicOptions")}}',
			   periodList    : '{{route("frontend.api.getPeriodOptions")}}',
			   programList   : '{{route("frontend.api.getProgramFullOptions")}}',
			   classesList   : '{{route("frontend.api.getClassesFullOptions")}}',
			   subjectsList  : '{{route("frontend.api.getSubjectsFullOptions")}}',
			   createVideo   : '{{route("frontend.api.createVideo")}}',
			   createArticle : '{{route("frontend.api.createArticle")}}'
				
		}
    },
	createUrl : function(set){ 
        return ( this.parentUrl+this.separator+set);
    },
	createId : function(arr){ 
        return ( arr.join(''));
    }
} 

/* import {TutorPost} from "/js/tutor_post.js";
(function() {  window.tutorPost = new TutorPost(tutorCon);  })(); */  
</script> 
<script src="{{asset('js/tutor_post.js')}}"> </script> 
<script src="{{asset('js/update_profile_data.js')}}"> </script> 
<script>
     $(document).ready(function () {
        
        $('#keywords').tagsinput({ tagClass: 'badge badge-secondary' });
     });
	 $(document).ready(function () {
        
        $('#article_keywords').tagsinput({ tagClass: 'badge badge-secondary' });
     });
        Dropzone.options.dropzone =
         {
            maxFilesize: 50, /* you can upload only 50mb  */
            paramName: "notes",  /* The name that will be used to transfer the file */
            maxFiles: 1,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".jpg,.jpeg.png,.pdf,.doc,.docm,.docx,.docx,.dot,.xls,.xlsb,.ppt",
            addRemoveLinks: true,
            timeout: 5000000,
            removedfile: function(file) 
            {
                var name = file.upload.filename;
                /* $.ajax({
                    headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                    type: 'POST',
                    url: '{{ url("image/delete") }}',
                    data: {filename: name},
                    success: function (data){
                        console.log("File has been successfully removed!!");
                        commonObj.messages('success',"File has been successfully removed!!");
                    },
                    error: function(e) {
                        //console.log(e);
                        commonObj.messages('error',e);
                    }}); */
                    var fileRef;
                    return (fileRef = file.previewElement) != null ? 
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
       
            success: function(file, response) 
            {
                this.removeAllFiles(true);
               
                if(response.errStatus == 1){
                    $("#myModalAddNotes").modal("hide");
                    commonObj.messages(response.messageType,response.message);
                    tutorPost.tutorLectureAndPosts('',0,1);
                }else{
                     commonObj.messages(response.messageType,response.message);
                     
                }
                
            },
            error: function(file, response)
            { 
                this.removeAllFiles(true);
                console.log(response);
                commonObj.messages('error',response);
                return false;
            }
};
$(document).ready(function(){
        $(".date").flatpickr({ 
            //defaultDate: "2020-05-13",
            disable: [
                    function(date) {
                        // return true to disable
                        return (date.getDay() === 0 || date.getDay() === 6);
                    }
                ],
            locale: {
                    firstDayOfWeek: 1
            }
        });
}); 
</script>
@stop

