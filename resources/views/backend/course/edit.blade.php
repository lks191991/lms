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
            <form action="{{route('backend.course.update', $course->id)}}" method = "post">
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
			
			
			<div class="form-group row" id="department-field" @if($school_details->school_category != config("constants.UNIVERSITY")) style="display:none;" @endif>
                    <label class="col-form-label col-sm-2 text-sm-right">Department</label>
                    <div class="col-sm-10">
						
                        <select name="department" id="department" class="custom-select" disabled>
							<option value="">Select Department</option>
							@foreach($departments as $id => $type)
                                <option value="{{$id}}" @if($course->department_id == $id) selected @endif>{{$type}}</option>
                            @endforeach
						</select>
						<input type="hidden" name="department" value="{{$course->department_id}}">
                    </div>
             </div>
			 
			 
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Course Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" placeholder="Course Name" class="form-control" value="{{$course->name}}" required>
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
          if(category_id && category_id == '{{config("constants.UNIVERSITY")}}') {
				$("#department-field").show();
				$("select#department").attr("required");
			} else {
				$("#department-field").hide();
				$("select#department").removeAttr("required");
			}
			
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
			if(institute_type && institute_type == '{{config("constants.UNIVERSITY")}}') {
				$.ajax({
					type: "POST",
					url: '{{ route("ajax.school.departments") }}',
					data: {'school_id': school_id, '_token': '{{ csrf_token() }}'},
					success: function (data) {
						$("#department").html(data);
					}
				});
				
			} 
        });
        
 });
</script>
@stop