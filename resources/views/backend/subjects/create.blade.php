@extends('backend.layouts.layout-2')

@section('content')
<h4 class="font-weight-bold py-3 mb-4">
    <span class="text-muted font-weight-light">Subjects /</span> Create Subject
</h4>
<div class="card mb-4">
    <h6 class="card-header">
        Create Subject
    </h6>
    <div class="card-body">
        @includeif('backend.message')
        <form action="{{route('backend.subjects.store')}}" method = "post" enctype="multipart/form-data">
            @csrf
			
			<div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Institute Type</label>
                        <div class="col-sm-10">
                            <select name="institute_type" id="institute_type" class="custom-select" required>
                                <option value="" selected="" disabled="" class="d-none">Select Institute Type</option>
                                @foreach($institutes as $id => $type)
                                <option value="{{$id}}">{{$type}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">School</label>
                        <div class="col-sm-10">
                            <select name="school" id="school" class="custom-select" required>
                                <option value="" disabled selected="">Select School</option>                        
                            </select>
                        </div>
                    </div>
					
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Course</label>
                        <div class="col-sm-10">
                            <select name="course" id="school_course" class="custom-select" required>
                                <option value="" disabled selected="">Select Course</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Class</label>
                        <div class="col-sm-10">
                            <select name="class" id="class" class="custom-select" required>
                                <option value="" disabled selected="">Select Class</option>                        
                            </select>
                        </div>
                    </div>
					
            <div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-right">Subject Name</label>
                <div class="col-sm-10">
                    <input type="text" name="subject_name" placeholder="Subject Name" value="{{old('subject_name')}}" class="form-control" required>
                </div>
            </div>
			 <div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-right">Price</label>
                <div class="col-sm-10">
                    <input type="text" name="subject_price" placeholder="Subject Price" value="{{old('subject_price')}}" class="form-control" required>
                </div>
            </div>
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Banner Image</label>
                    <div class="col-sm-10">
                       <input type="file" id="banner_image" name="banner_image">
						<small class="form-text mb-4">
							.jpg .png .bmp  |  Size max >= 2mb<br>
						</small>
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
			
				$.ajax({
					type: "POST",
					url: '{{ route("ajax.school.courses") }}',
					data: {'school_id': school_id, '_token': '{{ csrf_token() }}'},
					success: function (data) {
						$("#school_course").html(data);
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
                    }
                });
            }
        });
        
        
 });
</script>
@stop