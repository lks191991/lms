@extends('backend.layouts.layout-2')

@section('content')
<h4 class="font-weight-bold py-3 mb-4">
    <span class="text-muted font-weight-light">Classrooms /</span> Edit Classroom
</h4>
<div class="card mb-4">
    <h6 class="card-header">
        Edit Classroom
    </h6>
    <div class="card-body">
        @includeif('backend.message')
        <form action="{{route('backend.classrooms.update', $classroom->id)}}" method = "POST">
            @csrf
            @method('PUT')
			<div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-right">Classroom Name</label>
                <div class="col-sm-10">
                    <input type="text" name="classroom_name" placeholder="Classroom Name" value="{{$classroom->classroom_name}}" class="form-control" required>
                </div>
            </div>
			
			<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">School</label>
                    <div class="col-sm-10">
                        <select name="school" id="search_school" class="form-control" required>
						<option value="">School</option>
						@foreach($schools as $school)
							<option value="{{$school->id}}" @if($classroom->school_id == $school->id) selected="selected" @endif>{{$school->school_name}}</option>
						@endforeach
					</select>
                    </div>
            </div>
			
			<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Course</label>
                    <div class="col-sm-10">
                       <select name="course" id="school_course" class="form-control" required>
							<option value="">Course</option>
						@foreach($courses as $course)
							<option value="{{$course->id}}" @if($classroom->course_id == $course->id) selected="selected" @endif>{{$course->name}}</option>
						@endforeach
						</select>
                    </div>
            </div>
			
			<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Class</label>
                    <div class="col-sm-10">
                         <select name="class" class="form-control" required>
						<option value="">Class</option>
						@foreach($classes as $class)
							<option value="{{$class->id}}" @if($classroom->class_id == $class->id) selected="selected" @endif>{{$class->class_name}}</option>
						@endforeach
					</select>
                    </div>
            </div>
			
			<div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-right">Date</label>
                <div class="col-sm-10">
                    <input type="date" name="date" placeholder="Date" value="{{$classroom->date}}" class="form-control" required>
                </div>
            </div>
			
			<div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-right"></label>
                <div class="col-sm-10">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" name="status" value="1" class="custom-control-input" @if($classroom->status) checked @endif>
                        <span class="custom-control-label">Active</span>
                    </label>
                </div>
            </div>
			<div class="form-group row">
                <div class="col-sm-10 ml-sm-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
$("#search_school").on("change", function(){
	var school_id = $(this).val();
	
		$.ajax({
				type: "POST",
				url: '{{ route("frontend.ajax.schoolcourses") }}',
				data: {'school_id': school_id,'_token': '{{ csrf_token() }}'},
				
				success: function(data){
					$("#school_course").html(data);
				}
			});
	});
	


});
</script>
@stop