@extends('backend.layouts.layout-2')

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-light">Students /</span> Edit Student
    </h4>
	<div class="card mb-4">
        <h6 class="card-header">
            Edit Student
        </h6>
        <div class="card-body">
			@includeif('backend.message')
            <form action="{{route('backend.students.update', $student->id)}}" method = "post" enctype="multipart/form-data">
			 @csrf
				@method('PUT')
				<div class="form-group row @role('school') d-none @endrole">
                        <label class="col-form-label col-sm-2 text-sm-right">Institute Type</label>
                        <div class="col-sm-10">
                            <select name="institute_type" id="institute_type" class="custom-select" disabled>
                                <option value="" selected="" disabled="" class="d-none">Select Institute Type</option>
                                @foreach($institutes as $id => $type)
									<option value="{{$id}}" @if($student->school->school_category == $id) selected @endif>{{$type}}</option>
								@endforeach
                            </select>
						</div>
				 </div>
					
				<div class="form-group row @role('school') d-none @endrole">
                    <label class="col-form-label col-sm-2 text-sm-right">School</label>
                    <div class="col-sm-10">
					<select name="school_name" id="school" class="custom-select" disabled>
						<option value="">Select School</option>
						 @foreach($schools as $id => $type)
									<option value="{{$id}}" @if($student->school_id == $id) selected @endif>{{$type}}</option>
						@endforeach
					</select>
					</div>
                </div>
				
				<div class="form-group row" id="department-field" @if($student->category_id != config("constants.UNIVERSITY")) style="display:none;" @endif>
						<label class="col-form-label col-sm-2 text-sm-right">Department</label>
						<div class="col-sm-10">
							
							<select name="department" id="department" class="custom-select" disabled>
								<option value="">Select Department</option>
								@foreach($departments as $id => $type)
									<option value="{{$id}}" @if($student->department_id == $id) selected @endif>{{$type}}</option>
								@endforeach
							</select>
							<input type="hidden" name="department" value="{{$student->department_id}}">
						</div>
					</div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Course</label>
                        <div class="col-sm-10">
                            <select name="course" id="school_course" class="custom-select" disabled>
                                <option value="" disabled selected="">Select Course</option>
								@foreach($courses as $id => $val)
                                <option value="{{$id}}" @if($id == $student->course_id ) selected @endif>{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Class</label>
                        <div class="col-sm-10">
                            <select name="class" id="class" class="custom-select" disabled>
                                <option value="" disabled selected="">Select Class</option>
								@foreach($classes as $id => $val)
                                <option value="{{$id}}" @if($id == $student->class_id ) selected @endif>{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
				
				
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="first_name" placeholder="First Name" value="{{ $student->first_name }}" class="form-control" pattern="[A-Za-z ]{1,32}" required>
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="last_name" placeholder="Last Name" value="{{ $student->last_name }}" class="form-control" pattern="[A-Za-z ]{1,32}">
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" placeholder="Username" value="{{ $student->user_details->username }}" class="form-control" disabled>
					</div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password"  id="password" placeholder="Password" class="form-control">
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Password Confirm</label>
                    <div class="col-sm-10">
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Password Confirm" class="form-control">
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" id="email" placeholder="Email" value="{{ $student->email }}" class="form-control" required>
                    </div>
                </div>
				
				@php $countries = App\Models\Countries::select('name','phonecode')->get(); @endphp
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Country</label>
                    <div class="col-sm-10">
                        <select class="custom-select" id="phone_code" name="phone_code">
							@if($countries->count() > 0)	
								@foreach($countries as $country)	
								<option value="{{$country->phonecode}}" @if($country->phonecode == $student->country) selected @endif>{{ $country->name}}</option>
								@endforeach
							@endif
					</select>
                    </div>
                </div>
				
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Mobile</label>
                    <div class="col-sm-10">
                        <input type="text" name="mobile" id="mobile" placeholder="Mobile" value="{{ $student->mobile }}" class="form-control" required>
                    </div>
                </div>
				
			
				
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Profile Photo</label>
                    <div class="col-sm-10">
						@if(isset($student->profile_image) && !empty($student->profile_image))
							<img class="photo mb-2" style="max-width:200px;" src='{{url("$student->profile_image")}}' /><br />
						@endif
                       <input type="file" id="photo" name="photo">
						<small class="form-text mb-4">
							.jpg .png .bmp  |  Size max >= 2mb<br>
						</small>
					</div>
                </div>
				
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Status</label>
                    <div class="col-sm-10">
                        <label class="switcher switcher-lg switcher-success">
                                <input type="checkbox" name="status" value="1" class="switcher-input" @if($student->status) checked @endif>
                                <span class="switcher-indicator">
                                    <span class="switcher-yes"><span class="ion ion-md-checkmark"></span></span>
                                    <span class="switcher-no"><span class="ion ion-md-close"></span></span>
                                </span>
                        </label>
                    </div>
                </div>
				
				<div class="form-group row">
                    <div class="col-sm-10 ml-sm-auto">
						<a href = "{{route('backend.students.index')}}" class="btn btn-danger mr-2">Cancel</a> 
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
				
			} else {
				$.ajax({
					type: "POST",
					url: '{{ route("ajax.school.courses") }}',
					data: {'school_id': school_id, '_token': '{{ csrf_token() }}'},
					success: function (data) {
						$("#school_course").html(data);
					}
				});
			}
        });
		
		
		$("#department").on("change", function () {
            var department_id = $(this).val();
          
            if(department_id) {                
                $.ajax({
					type: "POST",
					url: '{{ route("ajax.department.courses") }}',
					data: {'department_id': department_id, '_token': '{{ csrf_token() }}'},
					success: function (data) {
						$("#school_course").html(data);
					}
				});
            }
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
                    }
                });
            }
        });

});
</script>
@stop