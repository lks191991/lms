@extends('backend.layouts.layout-2')
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
<h4 class="font-weight-bold py-3 mb-4">
    <span class="text-muted font-weight-light">Videos /</span> Edit Video
</h4>

@includeif('backend.message')
<form action="{{route('backend.videos.update', $video->id)}}" method = "post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header">Video General Details</div>
                <hr class="border-light m-0">
                <div class="card-body">                   


                    <input type="hidden" name="institute_type" value="{{$video->school_id}}" id="institute_type" />
                    <input type="hidden" name="school" value="{{$video->school_id}}" id="school" />
                    
                 

                    <div class="form-group course_wrapper">
                        <label>Course</label>
                        <select name="course" id="school_course" class="custom-select" required>
                            <option value="" disabled selected="">Select Course</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Class</label>
                        <select name="class" id="class" class="custom-select" required>
                            <option value="" disabled selected="">Select Class</option>                        
                        </select>
                    </div>

                    <div class="form-group date_field_group">
                        <label>Date</label>
                        <input class="flatpickr flatpickr-input date form-control" value="{{$video->play_on}}" type="text" name="date" id="date" required />
                    </div>

                    <div class="form-group">
                        <label>Subject</label>
                        <select name="subject" id="subject" class="custom-select" required>
                            <option value="" selected="" disabled="">Choose Subject</option>                                
                        </select>               
                    </div>

                    <div class="form-group">
                        <label>Topic</label>
                        <select name="topic" id="topic" class="custom-select" required>
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
                   
					<input name="video_type" type="hidden" class="custom-control-input video_type" value="url">
                    <div class="form-group video_url_section" >
                        <label>Video URL</label>
                        <input type="url" value="{{$video->video_url}}" placeholder="Video URL" class="form-control" name="video_url" />
                        <small class="form-text text-muted">Example - https://vimeo.com/{video_id} </small>
                    </div>

                    
                    <div class="form-group">
                        <label>Upload Note (If any)</label>
                        <input type="hidden" name="note_file" id="uplodedNoteFile" value=""/>
                        <div id="noteFileUpload" class="dropzone">
                          <div class="dz-message needsclick" >
                            Drop files here or click to upload
                            <span class="note needsclick"><small class="form-text text-muted">Allowed file types: jpeg, png, pdf, doc, docx, ppt, pptx, zip and up to 50 MB</small></span>
                          </div>
                          <div class="fallback">
                              <input type="file" name="notefile">
                          </div>
                        </div>
                    </div> 
                    
                    <div class="form-group">
                        <label>Video Description</label>
                        <textarea class="form-control" name="description" rows="3" required>{{$video->description}}</textarea>
                    </div> 
                    
                    
                    <div class="form-group course_wrapper">
                        <label>Tutor</label>
                        <select name="tutor" id="tutor" class="custom-select" required>
                            <option value="" disabled selected="">Select Tutor</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Keywords</label>
                        <input type="text" value="{{$video->keywords}}" name="keywords" id="keywords" data-role="tagsinput" class="form-control" />
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3">Status</label>
                        <div class="col-sm-6">
                            <label class="switcher switcher-lg switcher-success">
                                <input type="checkbox" name="status" value="1" class="switcher-input" @if($video->status) checked @endif>
                                       <span class="switcher-indicator">
                                    <span class="switcher-yes"><span class="ion ion-md-checkmark"></span></span>
                                    <span class="switcher-no"><span class="ion ion-md-close"></span></span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <hr class="border-light m-0">
                <div class="card-footer d-block text-center">
                    <button type="submit" class="btn btn-primary" id="smt1">Update</button> 
                </div>
            </div>
        </div>
    </div>
</form>
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
        var department_id = "{{$video->course->department_id}}";
        var course_id = "{{$video->course_id}}";
        var class_id = "{{$video->class_id}}";      
        var play_on = "{{$video->play_on}}";        
        var subject_id = "{{$video->subject_id}}";
        var topic_id = "{{$video->topic_id}}";
        var tutor_id = "{{$video->tutor_id}}";  
        
       
        if(school_id) {         
        

            $.ajax({
                type: "POST",
                url: '{{ route("ajax.school.tutors") }}',
                data: {'school_id': school_id, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    $("#tutor").html(data);
                    if(tutor_id){
                        $("#tutor").val(tutor_id);
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
            $('.period_field_group').show();
            
            if(class_id) {
                var period = 0
                if(period_id) {
                    period = period_id;
                }
                
                $.ajax({
                    type: "POST",
                    url: '{{ route("ajax.class.period") }}',
                    data: {'class_id' : class_id,'date' : playon,'period': period, '_token': '{{ csrf_token() }}'},
                    success: function (data) {
                        $(".period_list").html(data);                        
                    }
                });
            }
        });
        
        
        $("#subject").on("change", function () {
            var subject_id = $('#subject').val();
          
            if(subject_id) {                
                $.ajax({
                    type: "POST",
                    url: '{{ route("ajax.subject.topics") }}',
                    data: {'subject_id' : subject_id, '_token': '{{ csrf_token() }}'},
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