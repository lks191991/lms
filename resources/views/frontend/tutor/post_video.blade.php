@if($tutor->userData->upload_access > 0)

<section class="pt-3 ">   		
    <div class="row pb-3" id="AddVideoBtnDiv">
        <div class="col">
            <button type="button" id="AddVideoBtn" onclick="tutorPost.showHideVideoPost('show')" class="btn btn-primary px-5 ">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                ADD VIDEO
            </button>
        </div>
    </div>

    <div class="contact-card hide" id="postVideoTab">
        <form action="" method="POST" id="videoPostForm" class="has-validation-callback">
            @csrf

            <div>
                <!--<label for="exampleInputEmail166">Video info</label>-->

                <h3 class="sub-heading">Video info</h3>

            </div>
            <div class="row">
                <div class="col-md-12 {{($schoolCategoryName == 'UNIVERSITY' ? '' : 'd-none' )}}">
                    <div class="form-group">
                        <div class="custom-select-outer"> 
                            <select class="custom-select" onchange="tutorPost.fullProgramList()" id="video_departmentId">
                                <option class="d-none" value=""> Department </option>
                                @foreach($defaultArray['deparments'] as $deparmentId => $deparment)
                                <option value="{{$deparmentId}}">{{$deparment}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>  	
                </div>

                <div class="col-md-6 {{($schoolCategoryName == 'BASIC_SCHOOL' ? 'd-none' : '' )}}">
                    <div class="form-group">
                        <div class="custom-select-outer"> 
                            <select class="custom-select" onchange="tutorPost.fullClassesList()" id="video_courseId">
                                @if($schoolCategoryName == 'UNIVERSITY')
                                <option class="d-none" value=""> Program </option>
                                @else
                                <option class="d-none" value=""> Cource </option> 
                                @endif

                                @foreach($defaultArray['courses'] as $coursesId => $course)
                                <option value="{{$coursesId}}">{{$course}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>  	
                </div>

                <div class="col-md-{{($schoolCategoryName == 'BASIC_SCHOOL' ? '12' : '6' )}}">
                    <div class="form-group">
                        <div class="custom-select-outer" > 
                            <select class="custom-select" onchange="tutorPost.fullSubjectList()" id="video_classId">
                                <option class="d-none" value="">Class </option>
                                @foreach($defaultArray['classes'] as $classeId => $classe)
                                <option value="{{$classeId}}">{{$classe}}</option>
                                @endforeach
                            </select>
                        </div>					
                    </div>
                </div>	
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">						
                        <div class="custom-select-outer"> 
                            <select class="custom-select" onchange="tutorPost.topicList()" data-validation="" name="subjectId" id="subjectId">
                                <option value="" class="d-none"> Subject </option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="custom-select-outer"> 
                            <select class="custom-select" onchange="tutorPost.periodList()" data-validation="" name="topicId" id="topicId">
                                <option value="" class="d-none"> Topic </option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">						
                        <input class="flatpickr flatpickr-input date form-control active" value="{{ date('Y-m-d',date(strtotime('+1 day', strtotime(date('Y-m-d H:i:s'))))) }}" type="text" name="play_on" id="play_on"  readonly="readonly">

                    </div>

                </div>	
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="custom-select-outer"> 
                            <select class="custom-select" data-validation="" name="periodId" id="periodId">
                                <option value="" class="d-none"> Period No.</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-none">
                <div class="col">
                    <div class="form-group">

                        <input type="text" class="form-control " placeholder="Caption" name="caption" value="" data-validation="" data-validation-length="2-255" >

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-inline mb-4">
                        <label class="custom-control custom-radio justify-content-start mr-2">
                            <input name="video_type" type="radio" value="url" onchange="tutorPost.showHideVideoSource()" class="custom-control-input video_type" checked="" required="">
                            <span class="custom-control-label">Video by URL</span>
                        </label>
                        <label class="custom-control custom-radio justify-content-start mr-2">
                            <input name="video_type" type="radio" value="file" onchange="tutorPost.showHideVideoSource()" class="custom-control-input video_type"  >
                            <span class="custom-control-label">Video by File</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="row" id="video_url_wrapper">
                <div class="col">
                    <div class="form-group">
                        <input type="text" class="form-control " name="video_url" id="video_url" value="" data-validation="url" placeholder="Video URL" data-validation-length="2-255">
                        <small class="form-text"> &nbsp;Example - https://vimeo.com/{video_id}</small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">

                        <textarea class="form-control " data-validation="" id="message" name="message" placeholder="Type a short description here"></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <h3 class="sub-heading"> Keywords</h3>

                        <input type="text" class="form-control " data-role="tagsinput" name="keywords" id="keywords" value="" data-validation="" data-validation-length="2-255" >

                    </div>
                </div>
            </div>


            <div class="row mt-2">
                <div class="col">
                    <button type="button" class="btn btn-primary px-5" onclick="tutorPost.createVideo()" id="videoPostBtn">POST VIDEO</button>
                    <button type="button" class="btn btn-secondary px-5" onclick="tutorPost.showHideVideoPost('hide')" id="videoCancelBtn">CANCEL</button>
                </div>
            </div>




        </form>

    </div>


</section>
@endif