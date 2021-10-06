@extends('backend.layouts.layout-2')

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-light">Courses /</span> Edit Course
    </h4>
	<div class="card mb-4">
        <h6 class="card-header">
            Edit Course
        </h6>
        <div class="card-body">
			@includeif('backend.message')
            <form action="{{route('backend.course.update', $course->id)}}" method = "post" enctype="multipart/form-data">
			@csrf
			
			<div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Institute Type</label>
                        <div class="col-sm-10">
                            <select name="institute_type" id="institute_type" class="custom-select" disabled required>
                                <option value="" selected="" disabled="" class="d-none">Select Institute Type</option>
                                @foreach($institutes as $id => $type)
                                <option value="{{$id}}" @if($school_details->school_category == $id) selected @endif>{{$type}}</option>
                                @endforeach
                            </select>
                        </div>

            </div>
			
			
			
			<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">School</label>
                    <div class="col-sm-10">
                        <select name="school_name" id="school" class="custom-select" disabled required>
						<option value="">Select School</option>
						@foreach($schools as $school)
							<option value="{{$school->id}}" @if($course->school_id == $school->id) selected="selected" @endif>{{$school->school_name}}</option>
						@endforeach
						</select>
                    </div>
            </div>
			
			 
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Course Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" placeholder="Course Name" class="form-control" value="{{$course->name}}" required>
                    </div>
                </div>
				
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Banner Image</label>
                    <div class="col-sm-10">
						@if(isset($course->banner_image) && !empty($course->banner_image))
							<img class="photo mb-2" style="max-width:200px;" src='{{url("$course->banner_image")}}' /><br />
						@endif
                       <input type="file" id="banner_image" name="banner_image">
						<small class="form-text mb-4">
							.jpg .png .bmp  |  Size max >= 2mb<br>
						</small>
					</div>
                </div>
				
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Course Description</label>
                    <div class="col-sm-10">
                        <textarea name="description" class="form-control" placeholder="Course Description">{{$course->description}}</textarea>
                    </div>
                </div>
				
				<div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-right"></label>
                <div class="col-sm-10">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" name="status" value="1" class="custom-control-input" @if($course->status) checked @endif>
                        <span class="custom-control-label">Active</span>
                    </label>
                </div>
            </div>
                
                
                <div class="form-group row"><input type="hidden" name="course_frm_school" value="{{$course->school_id}}">
                    <div class="col-sm-10 ml-sm-auto">
                        <a href = "{{route('backend.courses')}}" class="btn btn-danger mr-2">Cancel</a> <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $("#institute_type").on("change", function () {
          
		  var category_id = $(this).val();
         
			
            $.ajax({
                type: "POST",
                url: '{{ route("ajax.category.schools") }}',
                data: {'category': category_id, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    $("#school").html(data.schools);
                }
            });
			
        });

        $("#school").on("change", function () {
            var school_id = $(this).val();
            var institute_type = $("#institute_type").val();
			
        });
        
 });
</script>
@stop