@extends('frontend.layouts.app')

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
							<span class="mx-2">></span> Edit Topic
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
							<h1 class="section-heading with-bottom-line text-center">Edit Topic</h1>
						</div>
						<div class="dashboard-detail-outer pt-4">
						 <form action="{{route('frontend.topic.update', $topic->id)}}" method = "post">
            @csrf

            <div class="form-group mb-4">
									<div class="row">
                        <label class="col-form-label col-sm-2 text-sm-right">Institute Type</label>
                        <div class="col-sm-10">
                            <select name="institute_type" id="institute_type" class="form-control" required>
                                <option value="" selected="" disabled="" class="d-none">Select Institute Type</option>
                               @foreach($institutes as $id => $type)
                                <option value="{{$id}}" @if($id == $topic->category_id ) selected @endif>{{$type}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div></div>
                    <div class="form-group mb-4">
									<div class="row">
                        <label class="col-form-label col-sm-2 text-sm-right">School</label>
                        <div class="col-sm-10">
                            <select name="school" id="school" class="form-control" required>
                                <option value="" disabled selected="">Select School</option> 
								@foreach($schools as $id => $val)
                                <option value="{{$id}}" @if($id == $topic->school_id ) selected @endif>{{$val}}</option>
                                @endforeach		                       
                            </select>
                        </div>
                    </div></div>
					
                    <div class="form-group mb-4">
									<div class="row">
                        <label class="col-form-label col-sm-2 text-sm-right">Course</label>
                        <div class="col-sm-10">
                            <select name="course" id="school_course" class="form-control" required>
                                <option value="" disabled selected="">Select Course</option>
								@foreach($courses as $id => $val)
                                <option value="{{$id}}" @if($id == $topic->course_id ) selected @endif>{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div></div>

                   <div class="form-group mb-4">
									<div class="row">
                        <label class="col-form-label col-sm-2 text-sm-right">Class</label>
                        <div class="col-sm-10">
                            <select name="class" id="class" class="form-control" required>
                                <option value="" disabled selected="">Select Class</option> 
@foreach($classes as $id => $val)
                                <option value="{{$id}}" @if($id == $topic->class_id ) selected @endif>{{$val}}</option>
                                @endforeach								
                            </select>
                        </div>
                    </div></div>
			
			
				<div class="form-group mb-4">
									<div class="row">
					<label class="col-form-label col-sm-2 text-sm-right">Subject</label>
					<div class="col-sm-10">
						<select name="subject" id="subject" class="form-control" required>
						<option value="" selected="" disabled="">Choose Subject</option>
                    @foreach($subjects as $id => $name)
                        <option value="{{$id}}" @if($id == $topic->subject_id ) selected @endif>{{$name}}</option>
                    @endforeach
                    </select>
					</div>
				</div></div>
				
				<div class="form-group mb-4">
									<div class="row">
					<label class="col-form-label col-sm-2 text-sm-right">Topic Name</label>
					<div class="col-sm-10">
						<input type="text" name="topic_name" value="{{$topic->topic_name}}" placeholder="Topic Name" value="{{old('topic_name')}}" class="form-control" required>
					</div>
				</div></div>
				
            <div class="from-group mb-4 pull-right">
									<div class="pull-right">
										<button type="submit" class="btn btn-primary" style="float:right">Save</button>
									</div>
								</div>

          
        </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

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
		
		$("#class").on("change", function () {
            var class_id = $('#class').val();
          
            if(class_id) {                
                $.ajax({
                    type: "POST",
                    url: '{{ route("ajax.school.classsubjects") }}',
                    data: {'class_id' : class_id, '_token': '{{ csrf_token() }}'},
                    success: function (data) {
                        $("#subject").html(data);
                    }
                });
            }
        });
        
        
 });
</script>
@stop