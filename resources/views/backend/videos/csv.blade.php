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
    <span class="text-muted font-weight-light">Videos /</span> Upload CSV
</h4>

@includeif('backend.message')
<form action="{{route('backend.video.upload.csv.save')}}" method = "post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header">Video General Details</div>
                <hr class="border-light m-0">
                <div class="card-body">                   
                    
                    <div class="form-group @role('school') d-none @endrole">
                        <label>Institution</label>
                        <select name="institute_type" id="institute_type" class="custom-select" required>
                            <option value="" selected="" disabled="">Choose Institute Type</option>
                            @foreach($institutes as $id => $type)
                            <option value="{{$id}}">{{$type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group @role('school') d-none @endrole">
                        <label>School</label>
                        <select name="school" id="school" class="custom-select" required>
                            <option value="" disabled selected="">Select School</option>                        
                        </select>
                    </div>  
                  
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
                        <input class="flatpickr flatpickr-input date form-control" value="{{old('date')}}" type="text" name="date" id="date" required />
                    </div>
                 
                    
                    <div class="form-group">
                        <label>Subject</label>
                        <select name="subject" id="subject" class="custom-select" required>
                            <option value="" selected="" disabled="">Choose Subject</option>                                
                        </select>               
                    </div>
                    
                    <div class="form-group course_wrapper">
                        <label>Tutor</label>
                        <select name="tutor" id="tutor" class="custom-select" required>
                            <option value="" disabled selected="">Select Tutor</option>
							 @foreach($tutors as $id => $type)
                            <option value="{{$type->id}}">{{$type->first_name}} {{$type->last_name}}</option>
                            @endforeach
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
                            <input name="video_upload_type"checked type="radio" class="custom-control-input " value="main" >
                            <span class="custom-control-label">Main Video</span>
                        </label> 
                        <label class="custom-control custom-radio justify-content-start mr-2">
                            <input name="video_upload_type" type="radio" class="custom-control-input" value="demo" required="">
                            <span class="custom-control-label">Demo Video</span>
                        </label>
                    
                    </div>
					
                     <input name="video_type" type="hidden" class="custom-control-input video_type" value="url">
                    <div class="form-group video_url_section">
                        <label>CSV File</label><br>
                         <input type="file" id="uploaded_file_csv" name="uploaded_file_csv">
                        <small class="form-text text-muted">.csv</small>
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

@endsection

@section('scripts')

<script src="{{asset('assets/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<script src="{{asset('assets/vendor/libs/dropzone/dropzone.js')}}"></script>
 <!-- To include time picker on period page. -->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
<script>
var category_id = "{{old('institute_type')}}";
var school_id = "{{old('school')}}";
var class_id = "{{old('class')}}";
var course_id = "{{old('course')}}";
var subject_id = "{{old('subject')}}";
var topic_id = "{{old('topic')}}";
var tutor_id = "{{old('tutor')}}";
</script>

<script>
    $(document).ready(function () {
        
        $('#keywords').tagsinput({ tagClass: 'badge badge-secondary' });
        
       
        var play_on = "{{old('date')}}";
      
        
        $("#institute_type").on("change", function () {
            var category_id = $(this).val();
          
            $.ajax({
                type: "POST",
                url: '{{ route("ajax.category.schools") }}',
                data: {'category': category_id, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    $("#school").html(data.schools);
                    if(school_id){
                        $("#school").val(school_id).trigger('change');
                    }
                }
            });
        });
        
        if(category_id){
            $("#institute_type").val(category_id).trigger('change');
        }
        
       $("#school").on("change", function () {
            var school_id = $(this).val();
            var institute_type = $("#institute_type").val();
			
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
        });
        
       
        
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
        
        $(".video_type[value=url]").prop( "checked", true );
        $(".video_url_section").show();
        $('.status').prop( "checked", true );
        
      
  
   
 });
</script>

@stop	