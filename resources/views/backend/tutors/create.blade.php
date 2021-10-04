@extends('backend.layouts.layout-2')

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-light">School Tutors /</span> Create School Tutor
    </h4>
	<div class="card mb-4">
        <h6 class="card-header">
            Create School Tutor
        </h6>
        <div class="card-body">
			@includeif('backend.message')
            <form action="{{route('backend.tutors.store')}}" method = "post" enctype="multipart/form-data">
			@csrf
				<div class="form-group row @role('school') d-none @endrole">
                        <label class="col-form-label col-sm-2 text-sm-right">Institute Type</label>
                        <div class="col-sm-10">
                            <select name="institute_type" id="institute_type" class="custom-select" required>
                                <option value="" selected="" disabled="" class="d-none">Select Institute Type</option>
                                @foreach($institutes as $id => $type)
									<option value="{{$id}}" >{{$type}}</option>
								@endforeach
                            </select>
						</div>
				 </div>
					
				<div class="form-group row @role('school') d-none @endrole">
                    <label class="col-form-label col-sm-2 text-sm-right">School</label>
                    <div class="col-sm-10">
					<select name="school_name" id="school" class="custom-select" required>
						<option value="">Select School</option>
					</select>
					</div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" class="form-control" pattern="[A-Za-z ]{1,32}" required>
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}"  class="form-control" pattern="[A-Za-z ]{1,32}">
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" class="form-control" required>
						<small class="form-text">{{ "Unique username" }}</small>
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password"  id="password" placeholder="Password" class="form-control" required>
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Password Confirm</label>
                    <div class="col-sm-10">
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Password Confirm" class="form-control" required>
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}" class="form-control" required>
                    </div>
                </div>
				
				@php $countries = App\Models\Countries::select('name','phonecode')->get(); @endphp
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Country</label>
                    <div class="col-sm-10">
                        <select class="custom-select" id="phone_code" name="phone_code">
							@if($countries->count() > 0)	
								@foreach($countries as $country)	
								<option value="{{$country->phonecode}}" @if($country->phonecode == 233) selected @endif>{{ $country->name}}</option>
								@endforeach
							@endif
					</select>
                    </div>
                </div>
				
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Mobile</label>
                    <div class="col-sm-10">
                        <input type="text" name="mobile" id="mobile" placeholder="Mobile" value="{{ old('mobile') }}" class="form-control" required>
                    </div>
                </div>
				
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Subject</label>
                    <div class="col-sm-10">
                        <input type="text" name="tutor_subject" id="tutor_subject" placeholder="Tutor Subject" value="{{ old('tutor_subject') }}" class="form-control" required>
                    </div>
                </div>
				
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Profile Photo</label>
                    <div class="col-sm-10">
                       <input type="file" id="photo" name="photo">
						<small class="form-text mb-4">
							.jpg .png .bmp  |  Size max >= 2mb<br>
						</small>
					</div>
                </div>
				
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Upload Access</label>
                    <div class="col-sm-10">
                        <label class="switcher switcher-lg switcher-success">
                                <input type="checkbox" name="upload_access" value="1" class="switcher-input">
                                <span class="switcher-indicator">
                                    <span class="switcher-yes"><span class="ion ion-md-checkmark"></span></span>
                                    <span class="switcher-no"><span class="ion ion-md-close"></span></span>
                                </span>
                        </label>
                    </div>
                </div>
				
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Status</label>
                    <div class="col-sm-10">
                        <label class="switcher switcher-lg switcher-success">
                                <input type="checkbox" name="status" value="1" class="switcher-input" checked="">
                                <span class="switcher-indicator">
                                    <span class="switcher-yes"><span class="ion ion-md-checkmark"></span></span>
                                    <span class="switcher-no"><span class="ion ion-md-close"></span></span>
                                </span>
                        </label>
                    </div>
                </div>
				
				<div class="form-group row">
                    <div class="col-sm-10 ml-sm-auto">
						<a href = "{{route('backend.tutors.index')}}" class="btn btn-danger mr-2">Cancel</a> 
						<button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
@role('admin|subadmin')
<script>
    var category_id = "{{old('institute_type')}}";
    var school_id = "{{old('school_name')}}";
</script>
@endrole
@role('school')
<script>
    var category_id = "{{$category_id}}";
    var school_id = "{{$school_id}}";
</script>
@endrole
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
					if(school_id){
                        $("#school").val(school_id).trigger('change');
                    }
                }
            });
        });
		
		if(category_id){
            $("#institute_type").val(category_id).trigger('change');
        }

});
</script>
@stop