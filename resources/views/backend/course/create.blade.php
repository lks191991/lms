@extends('backend.layouts.layout-2')

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-light">Courses /</span> Create Course
    </h4>
	<div class="card mb-4">
        <h6 class="card-header">
            Create Course
        </h6>
        <div class="card-body">
			@includeif('backend.message')
            <form action="{{route('backend.course.store')}}" method = "post">
			@csrf
			
			<div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Institute Type</label>
                        <div class="col-sm-10">
                            <select name="institute_type" id="institute_type" class="custom-select" required>
                                <option value="" selected="" disabled="" class="d-none">Select Institute Type</option>
                                @foreach($institutes as $id => $type)
									@if($id != config("constants.BASIC_SCHOOL"))
										<option value="{{$id}}" >{{$type}}</option>
									@endif
                                @endforeach
                            </select>
                        </div>

                    </div>
					
			<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">School</label>
                    <div class="col-sm-10">
					<select name="school_name" id="school" class="custom-select" required>
						<option value="">Select School</option>
					</select>
					</div>
                </div>
				
			<div class="form-group row" id="department-field"  style="display:none;">
                    <label class="col-form-label col-sm-2 text-sm-right">Department</label>
                    <div class="col-sm-10">
						
                        <select name="department" id="department" class="custom-select">
							<option value="">Select Department</option>
						</select>
                    </div>
             </div>
				
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Course Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" placeholder="Course Name" value="{{ old('name') }}" class="form-control" required>
                    </div>
                </div>
				
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Course Description</label>
                    <div class="col-sm-10">
                        <textarea name="description" class="form-control" placeholder="Course Description">{{ old('description') }}</textarea>
                    </div>
                </div>
				
				<div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-right"></label>
                <div class="col-sm-10">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" name="status" value="1" @if(old('status')) checked @endif class="custom-control-input">
                        <span class="custom-control-label">Active</span>
                    </label>
                </div>
            </div>
                
                
                <div class="form-group row">
                    <div class="col-sm-10 ml-sm-auto">
						<a href = "{{route('backend.courses')}}" class="btn btn-danger mr-2">Cancel</a> 
						<button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
<!--<script src="{{ mix('/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>-->

<script>
    $(document).ready(function () {
        $("#institute_type").on("change", function () {
            var category_id = $(this).val();
			
			if(category_id && category_id == '{{config("constants.UNIVERSITY")}}') {
				$("#department-field").show();
				$("select#department").attr("required", "required");
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