class TutorPost{

    constructor(external){
        this.ext = external;
        this.tutorLectureAndPosts();
    }
    tutorLectureAndPosts(tab = '', loadMore = 0, ex = 0){

        var ids = this.ext.jsId;
        var jsClass = this.ext.jsClass;
        var jsData = this.ext.jsData;
        var jsValue = this.ext.jsValue;
        var extra = this.ext.extra;
        var url = this.ext.extra.url;
        if (tab == ''){
            tab = $(ids.activeTabInput).val();
        } else {
            $(ids.activeTabInput).val(tab);
        }

        var setLoder = "";
        var MoreId = "";
        var postUrl = url.lecture;
        var pageNo = 1;
        if (tab == 'lecture') {
            setLoder = ids.lectureHtml;
            postUrl = url.lecture;
            MoreId = ids.lectureMore;
            pageNo = $(ids.lecturePage).val();
            if ($(ids.activetedTab).data(jsData.lecture) && loadMore == 0 && ex == 0){
                return false;
            } else{
                $(ids.activetedTab).data(jsData.lecture, 1)
            }
        } else if (tab == 'posts') {
            setLoder = ids.postsHtml;
            postUrl = url.posts;
            MoreId = ids.postsMore;
            pageNo = $(ids.postsPage).val();
            if ($(ids.activetedTab).data(jsData.posts) && loadMore == 0 && ex == 0){
                return false;
            } else{
                $(ids.activetedTab).data(jsData.posts, 1)
            }
        }

        $(MoreId).hide();
        if (loadMore == 1){
            $(setLoder).append(commonObj.bootLoder());
            pageNo = pageNo;
        } else {
            $(setLoder).html(commonObj.bootLoder());
            pageNo = 1;
        }
        var orderBy = $(ids.orderBy).val();
        var postData = {
            'tab':tab,
            'page':pageNo,
            'orderBy':orderBy,
            'loadMore':loadMore
         };
        var responseData = axios.get(postUrl, { params: postData })
            .then(function (response) {
                    var getData = response.data;
                    setTimeout(function(){
                        $("#loderId").remove();
                        var htmlId = "";
                        if (getData.tab == 'lecture'){
                            htmlId = ids.lectureHtml;
                            $(ids.lecturePage).val(getData.page);
                            if (getData.show_morerecords == 1){
                                $(ids.lectureMore).show('slow');
                            } else {
                                $(ids.lectureMore).hide('slow');
                            }
                        } else if (getData.tab == 'posts'){
                            htmlId = ids.postsHtml;
                            $(ids.postsPage).val(getData.page);
                            if (getData.show_morerecords == 1){
                                $(ids.postsMore).show('slow');
                            } else {
                                $(ids.postsMore).hide('slow');
                            }
                        }

                        if (getData.loadMore == 1){
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
    addNotes(videoId){

    $(this.ext.jsId.videoId).val(videoId);
            $("#myModalAddNotes").modal("show");
    }
    showHideArticlePost(btnStatus = 'show'){

    var ids = this.ext.jsId;
            var jsClass = this.ext.jsClass;
            var jsData = this.ext.jsData;
            var jsValue = this.ext.jsValue;
            var extra = this.ext.extra;
            var url = this.ext.extra.url;
            if (btnStatus == 'show'){
    $(ids.AddArticleBtnDiv).hide('slow');
            $(ids.postArticleTab).show('slow');
            $(ids.postsHtml).hide('slow');
    } else if (btnStatus == 'hide'){
    $(ids.AddArticleBtnDiv).show('slow');
            $(ids.postArticleTab).hide('slow');
            $(ids.postsHtml).show('slow');
    }
    }
    showHideVideoPost(btnStatus = 'show'){

    var ids = this.ext.jsId;
            var jsClass = this.ext.jsClass;
            var jsData = this.ext.jsData;
            var jsValue = this.ext.jsValue;
            var extra = this.ext.extra;
            var url = this.ext.extra.url;
            if (btnStatus == 'show'){
    $(ids.AddVideoBtnDiv).hide('slow');
            $(ids.postVideoTab).show('slow');
            $(ids.lectureHtml).hide('slow');
            $(ids.moreLectureBtnContainer).hide('slow');
            $(jsClass.videoType + ":radio[value='url']").prop('checked', true);
    } else if (btnStatus == 'hide'){
    $(ids.AddVideoBtnDiv).show('slow');
            $(ids.postVideoTab).hide('slow');
            $(ids.lectureHtml).show('slow');
            $(ids.moreLectureBtnContainer).show('slow');
    }
    }
    showHideVideoSource(){

    var ids = this.ext.jsId;
            var jsClass = this.ext.jsClass;
            var jsData = this.ext.jsData;
            var jsValue = this.ext.jsValue;
            var extra = this.ext.extra;
            var url = this.ext.extra.url;
            var videoType = $(jsClass.videoType + ':checked').val();
            if (videoType == 'url'){
    $(ids.video_url_wrapper).show('slow');
            $(ids.videoPostBtn).html('POST VIDEO');
    } else if (videoType == 'file'){
    $(ids.video_url_wrapper).hide('slow');
            $(ids.videoPostBtn).html('POST AND UPLOAD VIDEO FILE');
    }
    }

    fullProgramList(){

    var self = this;
            commonObj.paceRestart('topicList');
            var ids = this.ext.jsId;
            var jsClass = this.ext.jsClass;
            var jsValue = this.ext.jsValue;
            var extra = this.ext.extra;
            var url = this.ext.extra.url;
            var selectedVal = '';
            var departmentId = $(ids.videoDepartmentId).val();
            var sendOption = {
            'departmentId' : departmentId,
                    'fromCall'   : '',
                    'onchange'   : ''
            };
            $(ids.videoCourseId).html(commonObj.createOptions({}, selectedVal, 'Program'));
            var responseData = axios.get(url.programList, { params: sendOption })
            .then(function (response) {

            var getData = response.data;
                    $.when($(ids.videoCourseId).html(commonObj.createOptions(getData.programs, selectedVal, 'Program'))).done();
            })
            .catch(function (error) {
            commonObj.catchErr(error);
            });
    }
    fullClassesList(){

    commonObj.paceRestart('fullClassesList');
            var ids = this.ext.jsId;
            var jsClass = this.ext.jsClass;
            var jsValue = this.ext.jsValue;
            var extra = this.ext.extra;
            var url = this.ext.extra.url;
            var selectedVal = '';
            var videoCourseId = $(ids.videoCourseId).val();
            var self = this;
            var sendOption = {
            'course_id' : videoCourseId,
                    'fromCall'   : '',
                    'onchange'   : ''
            };
            $(ids.videoClassId).html(commonObj.createOptions({}, selectedVal, 'Class'));
            var responseData = axios.get(url.classesList, { params: sendOption })
            .then(function (response) {
            var getData = response.data;
                    $.when($(ids.videoClassId).html(commonObj.createOptions(getData.classes, selectedVal, 'Class'))).done();
            })
            .catch(function (error) {
            commonObj.catchErr(error);
            });
    }
    fullSubjectList(){

    commonObj.paceRestart('fullSubjectList');
            var ids = this.ext.jsId;
            var jsClass = this.ext.jsClass;
            var jsValue = this.ext.jsValue;
            var extra = this.ext.extra;
            var url = this.ext.extra.url;
            var selectedVal = '';
            var videoClassId = $(ids.videoClassId).val();
            var self = this;
            var sendOption = {
            'class_id' : videoClassId,
                    'fromCall'   : '',
                    'onchange'   : ''
            };
            $(ids.subjectId).html(commonObj.createOptions({}, selectedVal, 'Subject'));
            var responseData = axios.get(url.subjectsList, { params: sendOption })
            .then(function (response) {
            var getData = response.data;
                    $.when($(ids.subjectId).html(commonObj.createOptions(getData.subjects, selectedVal, 'Subject'))).done();
            })
            .catch(function (error) {
            commonObj.catchErr(error);
            });
    }
    topicList(){

    commonObj.paceRestart('topicList');
            var ids = this.ext.jsId;
            var jsClass = this.ext.jsClass;
            var jsValue = this.ext.jsValue;
            var extra = this.ext.extra;
            var url = this.ext.extra.url;
            var selectedVal = '';
            var subjectVal = $(ids.subjectId).val();
            var self = this;
            var sendOption = {
            'subject_id' : subjectVal,
                    'fromCall'   : '',
                    'onchange'   : '',
                    'selectedVal': selectedVal
            };
            $(ids.topicId).html(commonObj.createOptions({}, selectedVal, 'Topic'));
            var responseData = axios.get(url.topicList, { params: sendOption })
            .then(function (response) {
            var getData = response.data;
                    //$.when($(ids.topicId).html(this.createOptions(getData.topics,selectedVal,'Topic'))).done();
                    $.when($(ids.topicId).html(getData.topics)).done();
            })
            .catch(function (error) {
            commonObj.catchErr(error);
            });
    }
    periodList(){

    commonObj.paceRestart('periodList');
            var self = this;
            var ids = this.ext.jsId;
            var jsClass = this.ext.jsClass;
            var jsValue = this.ext.jsValue;
            var extra = this.ext.extra;
            var url = this.ext.extra.url;
            var selectedVal = '';
            var subjectVal = $(ids.subjectId).val();
            var topicVal = $(ids.topicId).val();
            var videoClassId = $(ids.videoClassId).val();
            var sendOption = {
            'subject_id' : subjectVal,
                    'topic_id'   : topicVal,
                    'class_id'   : videoClassId,
                    'fromCall'   : '',
                    'onchange'   : ''
            };
            $(ids.periodId).html(commonObj.createOptions({}, selectedVal, 'Period No.'));
            var responseData = axios.get(url.periodList, { params: sendOption })
            .then(function (response) {
            var getData = response.data;
                    $.when($(ids.periodId).html(commonObj.createOptions(getData.periods, selectedVal, 'Period No.'))).done();
            })
            .catch(function (error) {
            commonObj.catchErr(error);
            });
    }
    createArticle(){

    /* var validator = $( "#videoPostForm" ).validate();
     validator.element( "#articlePostBtn" ); */
    var self = this;
            commonObj.paceRestart('createArticle');
            var ids = this.ext.jsId;
            var jsClass = this.ext.jsClass;
            var jsValue = this.ext.jsValue;
            var extra = this.ext.extra;
            var url = this.ext.extra.url;
            var articlePostBtn = ids.articlePostBtn;
            var selectedVal = '';
            var articleTitle = $(ids.articleTitle).val();
            var articleSubject = $(ids.articleSubject).val();
            var articleImage = $(ids.articleImage).val();
            var articleContent = tinymce.get('article_content').getContent();
            var articleKeywords = $(ids.articleKeywords).val();
            var article_target = $('.article_target').serializeJSON();
            //var fd = new FormData();
            var files = $('#article_image')[0].files[0];
            commonObj.btnDesEnb(articlePostBtn, "POST ARTICLE", 'des');
            var formData = new FormData();
            formData.append('articleTitle', articleTitle);
            formData.append('articleSubject', articleSubject);
            formData.append('articleImage', files);
            formData.append('articleContent', articleContent);
            formData.append('articleKeywords', articleKeywords);
            formData.append('article_target', JSON.stringify(article_target));
            /* var sendOption  = {

             'articleTitle'      : articleTitle,
             'articleSubject'    : articleSubject,
             'articleImage'      : files,
             'articleContent'    : articleContent,
             'articleKeywords'   : articleKeywords,
             'article_target'    : article_target.article_target
             }; */

            //console.log(sendOption);

            var config = {
            headers: {
            'content-type': 'multipart/form-data',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            }
            };
            var responseData = axios.post(url.createArticle, formData, config)
            .then(function (response) {

            if (getData.isLogin != 1)
            {
            commonObj.openLoginModel();
            }
            else if (!getData.errStatus)
            {
            commonObj.messages(getData.messageType, getData.message);
            } else {
            $(".tag").each(function(){
            $(this).remove();
            });
                    $(ids.articleKeywords).val('');
                    $(ids.articlePostForm).trigger("reset");
                    self.showHideArticlePost('hide')
                    commonObj.messages(getData.messageType, getData.message);
                    self.tutorLectureAndPosts('posts', 0, 1);
            }

            })
            .catch(function (error) {
            commonObj.btnDesEnb(articlePostBtn, "POST ARTICLE", 'enb');
                    commonObj.catchErr(error);
            });
    }
    createVideo(){

        /* var validator = $( "#videoPostForm" ).validate();
         validator.element( "#videoPostBtn" ); */
        var self = this;
        commonObj.paceRestart('createVideo');
        var ids = this.ext.jsId;
        var jsClass = this.ext.jsClass;
        var jsValue = this.ext.jsValue;
        var extra = this.ext.extra;
        var url = this.ext.extra.url;
        var videoPostBtn = ids.videoPostBtn;
        var selectedVal = '';
        var departmentId = $(ids.videoDepartmentId).val();
        var courseId = $(ids.videoCourseId).val();
        var classId = $(ids.videoClassId).val();
        var subjectId = $(ids.subjectId).val();
        var topicId = $(ids.topicId).val();
        var periodId = $(ids.periodId).val();
        var caption = $(ids.caption).val();
        var play_on = $(ids.play_on).val();
        var videoType = $(jsClass.videoType + ':checked').val();
        var video_url = $(ids.video_url).val();
        var message = $(ids.message).val();
        var keywords = $(ids.keywords).val();
        commonObj.btnDesEnb(videoPostBtn, "POST VIDEO", 'des');
        var sendOption = {
            'departmentId' : departmentId,
            'courseId'  : courseId,
            'classId'   : classId,
            'subjectId' : subjectId,
            'topicId'   : topicId,
            'periodId'  : periodId,
            'caption'   : caption,
            'play_on'   : play_on,
            'video_type' : videoType,
            'video_url' : video_url,
            'message'   : message,
            'keywords'  : keywords
        };
        var responseData = axios.post(url.createVideo, sendOption)
        .then(function (response) {
            commonObj.btnDesEnb(videoPostBtn, "POST VIDEO", 'enb');
            var getData = response.data;
            if (getData.isLogin != 1)
            {
                commonObj.openLoginModel();
            }
            else if (!getData.errStatus)
            {
                commonObj.messages(getData.messageType, getData.message);
            } else {
                $(".tag").each(function(){
                    $(this).remove();
                });
                $(ids.keywords).val('');
                $(ids.videoPostForm).trigger("reset");
                self.showHideVideoPost('hide')
                self.showHideVideoSource();
                commonObj.messages(getData.messageType, getData.message);
                
                if(getData.type == 'file' && getData.nextStepUrl != ''){
                    commonObj.redirect(getData.nextStepUrl);
                } else {
                    self.tutorLectureAndPosts('lecture', 0, 1);
                }                
            }

        })
         .catch(function (error) {
            commonObj.btnDesEnb(videoPostBtn, "POST VIDEO", 'enb');
            commonObj.catchErr(error);
        });
    }
    get(url, postData){
        var responseData = axios.get(url, { params: postData })
            .then(function (response) {
                return response;
            })
            .catch(function (error) {

                if (error.response) {
                    return  {"status" : error.response.status, "message" : `Error Code ${error.response.status} : ${error.response.statusText}`};
                } else{
                    return  {"status" : 500, "message" : "Error Code 500 : Something went wrong"};
                }
            });
            this.getPostData = responseData;
    }
    
    post(url, postData){
        /* const config = { headers: { 'Content-Type': 'multipart/form-data' } }; */

        var responseData = axios.post(url, postData)
            .then(function (response) {
                return response;
            })
            .catch(function (error) {
                var re = {"status" : error.response.status, "message" : `Error Code ${error.response.status} : ${error.response.statusText}`};
                return re;
            });
            this.getPostData = responseData;
    }
    
    postWithFile(url, postData){

        const config = {
            headers: {
            'content-type': 'multipart/form-data',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            }
        };
        var responseData = axios.post(url, postData, config)
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

var tutorPost = new TutorPost(tutorCon);
