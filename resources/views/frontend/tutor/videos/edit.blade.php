@extends('frontend.layouts.app')
@section('styles')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/dropzone/dropzone.css')}}">
<style>
    .dz-message {
        margin: 3rem 0;
    }
</style>
@endsection
@section('content')

    <!-- Breadcrumbs -->

	<section class="breadcrumbs bg-light py-3">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="m-0 p-0 list-unstyled d-flex flex-wrap">
						<li>
							<a href="/">Home</a>
						</li>
						<li>
							<span class="mx-2">></span> Edit Video
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- Breadcrumbs Ends-->
<section class="user-dashboard section-padding">
		<div class="container">
			<div class="row gx-lg-5">
				@include('frontend.includes.side')
				<div class="col-lg-8">
					<div class="dashboard-main-content mt-lg-0 mt-5">
						<div class="section-title">
							<h1 class="section-heading with-bottom-line text-center">Edit Video</h1>
						</div>
						<div class="dashboard-detail-outer pt-4">
						 <form action="{{route('frontend.video.update', $video->id)}}"  enctype="multipart/form-data" method = "post">
            @csrf

              <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header">Video General Details</div>
                <hr class="border-light m-0">
                <div class="card-body">                   
                    
                   
                    <div class="form-group course_wrapper">
                       <label class="form-label">Course</label>
                        <select name="course" id="school_course" class="form-control" required>
                            <option value="" disabled selected="">Select Course</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Class</label>
                        <select name="class" id="class" class="form-control" required>
                            <option value="" disabled selected="">Select Class</option>                        
                        </select>
                    </div>
                
                    <div class="form-group date_field_group">
                        <label class="form-label">Date</label>
                        <input class="flatpickr flatpickr-input date form-control" value="{{$video->play_on}}" type="text" name="date" id="date" required />
                    </div>
                 
                    
                    <div class="form-group">
                       <label class="form-label">Subject</label>
                        <select name="subject" id="subject" class="form-control" required>
                            <option value="" selected="" disabled="">Choose Subject</option>                                
                        </select>               
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Topic</label>
                        <select name="topic" id="topic" class="form-control" required>
                            <option value="" selected="" disabled="">Choose Topic</option>                                
                        </select>                
                    </div>

                   
                       
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">Video Details</div>
                <hr class="border-light m-0">
                <div class="card-body">
                   
					<div class="form-inline mb-4">
					 <label class="custom-control custom-radio justify-content-start mr-2">
                            <input name="video_upload_type"checked type="radio" class="custom-control-input " value="main" @if($video->video_upload_type=='main') checked @endif  >
                            <span class="custom-control-label">Main Video</span>
                        </label> 
                        <label class="custom-control custom-radio justify-content-start mr-2">
                            <input name="video_upload_type" @if($video->video_upload_type=='demo') checked @endif type="radio" class="custom-control-input" value="demo" required="">
                            <span class="custom-control-label">Demo Video</span>
                        </label>
                    
                    </div>
					
                     <input name="video_type" type="hidden" class="custom-control-input video_type" value="url">
                    <div class="form-group video_url_section" >
                        <label class="form-label">Video URL</label>
                        <input type="url" value="{{$video->video_url}}" placeholder="Video URL" class="form-control" name="video_url" />
                        <small class="form-text text-muted"></small>
                    </div>

                  <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Banner Image</label>
                    <div class="col-sm-10">
						@if(isset($video->banner_image) && !empty($video->banner_image))
							<img class="photo mb-2" style="max-width:100px;" src='{{url("$video->banner_image")}}' /><br />
						@endif
                       <input type="file" id="video_banner" name="banner_image">
						<small class="form-text mb-4">
							.jpg .png .bmp  |  Size max >= 2mb<br>
						</small>
					</div>
                </div>

                    <div class="form-group">
                        <label>Upload Note (If any)</label>
                        <input type="hidden" name="note_file" id="uplodedNoteFile" value=""/>
                        <div id="noteFileUpload" class="dropzone">
                          <div class="dz-message needsclick" >
                            <span class="note needsclick"><small class="form-text text-muted">Allowed file types: jpeg, png, pdf, doc, docx, ppt, pptx, zip and up to 50 MB</small></span>
                          </div>
                          <div class="fallback">
                              <input type="file" name="notefile">
                          </div>
                        </div>
                    </div> 
					<div class="form-group">
                        <label class="form-label">Video Description</label>
                       <textarea class="form-control" name="description" rows="3" required>{{$video->description}}</textarea>
                    </div> 
                    <div class="form-group">
                        <label class="form-label">Keywords</label>
                         <input type="text" value="{{$video->keywords}}" name="keywords" id="keywords" data-role="tagsinput" class="form-control" />
                    </div>
                    
                   
                </div>
                <hr class="border-light m-0">
                <div class="card-footer d-block text-center">
                    <button type="submit" class="btn btn-primary" id="smt">Submit</button> 
                </div>
            </div>
        </div>
    </div>


          
        </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@php
$url = $video->noteURL();
$size = $video->noteFileSize();

@endphp
@endsection
@section('scripts')

<script src="{{asset('assets/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<script src="{{asset('assets/vendor/libs/dropzone/dropzone.js')}}"></script>
<script>
    $(document).ready(function () {
        
        $('#keywords').tagsinput({ tagClass: 'badge badge-secondary' });
        
        $('.period_field_group').hide();
        
        var category_id = "{{$video->school->school_category}}";
        var school_id = "{{$video->school_id}}";
        var course_id = "{{$video->course_id}}";
        var class_id = "{{$video->class_id}}";      
        var play_on = "{{$video->play_on}}";        
        var subject_id = "{{$video->subject_id}}";
        var topic_id = "{{$video->topic_id}}";
        var tutor_id = "{{$video->tutor_id}}";  
        
       
        if(school_id) {         
             $.ajax({
					type: "POST",
					url: '{{ route("ajax.school.courses") }}',
					data: {'school_id': school_id, '_token': '{{ csrf_token() }}'},
					success: function (data) {
						$("#school_course").html(data);
						 if(course_id){
                            $("#school_course").val(course_id).trigger('change');
                        }
					}
				});
        }
    
        
        $("#school_course").on("change", function () {
            var school_course = $('#school_course').val();
          
            if(school_course) {                
                $.ajax({
                    type: "POST",
                    url: '{{ route("ajax.school.courseclasses") }}',
                    data: {'course_id' : school_course, '_token': '{{ csrf_token() }}'},
                    success: function (data) {
                        $("#class").html(data);
                        if(class_id){
                            $("#class").val(class_id).trigger('change');
                        }
                    }
                });
            }
        });
        
        $("#class").on("change", function () {
            var class_id = $('#class').val();
            if(play_on){
                $("#date").trigger('change');
            }
            if(class_id) {                
                $.ajax({
                    type: "POST",
                    url: '{{ route("ajax.class.subject") }}',
                    data: {'class_id' : class_id, '_token': '{{ csrf_token() }}'},
                    success: function (data) {
                        $("#subject").html(data);
                        if(subject_id){
                            $("#subject").val(subject_id).trigger('change');
                        }
                    }
                });
            }
        });
        $("#date").on("change", function () {
            var class_id = $('#class').val();
            var playon = $('#date').val();
        });
        
        
        $("#subject").on("change", function () {
            var subject_id = $('#subject').val();
          
            if(subject_id) {                
                $.ajax({
                    type: "POST",
                    url: '{{ route("ajax.subject.topics.tutor") }}',
                    data: {'subject_id' : subject_id,'user_id' : tutor_id, '_token': '{{ csrf_token() }}'},
                    success: function (data) {
                        $("#topic").html(data);
                        if(topic_id){
                            $("#topic").val(topic_id).trigger('change');
                        }
                    }
                });
            }
        });
        
        $(".date").flatpickr({ 
            //defaultDate: "{{date('Y-m-d')}}",
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
        
        
        
        /* $(".video_type").click(function() {
           
            var type = $(this).val();
            
            if(type == 'url') {
                $(".video_url_section").show();
            } else {
                $(".video_url_section").hide();
            }
            
        }); */
   
   /********* Upload Note file using dropzone *******************/
    // Dropzone class:
        var myDropzone = new Dropzone("div#noteFileUpload", { 
            url: "{{route('ajax.dropzone.upload.note')}}",
            acceptedFiles: ".jpg,.jpeg.png,.pdf,.doc,.docm,.docx,.docx,.dot,.xls,.xlsb,.ppt",
            maxFilesize: 50, /* you can upload only 50mb  */
            maxFiles: 1,
            paramName: "notefile",
            addRemoveLinks: true,
            accept: function (file, done) {
                $("#smt").attr("disabled", "disabled");
                if (this.files.length > 1) {
                    done("Sorry you can not upload any media.");
                }
                else {                    
                    done();
                }
            },
            init: function () {      
                var mydropzone = this;
                if("{{$url}}" != ''){
                    var mockFile = { name: "{{$video->noteFileName()}}",size: '{{$size}}' }; 
                    mydropzone.options.addedfile.call(mydropzone, mockFile);
                    mydropzone.options.thumbnail.call(mydropzone, mockFile, "{{$url}}");
                }
                this.on("maxfilesexceeded", function(file){ 
                    this.removeFile(file);
                });

                mydropzone.on("success", function (file, response) {
                    
                    $('#uplodedNoteFile').val(response.savefilename);
                    $("#smt").removeAttr("disabled");
                });

                this.on("removedfile", function (file) {
                  if (this.files.length == 0){
                     $("#uplodedNoteFile").val('');
                  }
                });       

            },
            sending: function (file, xhr, formData) {
                formData.append('_token', "{{ csrf_token() }}");
            }
        
    });
   
 });
</script>

@stop	