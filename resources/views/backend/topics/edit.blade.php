@extends('backend.layouts.layout-2')

@section('content')
<h4 class="font-weight-bold py-3 mb-4">
    <span class="text-muted font-weight-light">Topics /</span> Edit Topic
</h4>
<div class="card mb-4">
    <h6 class="card-header">
        Edit Topic
    </h6>
    <div class="card-body">
        @includeif('backend.message')
        <form action="{{route('backend.topics.update', $topic->id)}}" method = "POST">
            @csrf
            @method('PUT')
            
			<div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Institute Type</label>
                        <div class="col-sm-10">
                            <select name="institute_type" id="institute_type" class="custom-select" readonly required>
                                <option value="" selected="" disabled="" class="d-none">Select Institute Type</option>
                                @foreach($institutes as $id => $type)
                                <option value="{{$id}}" @if($id == $topic->category_id ) selected @endif>{{$type}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">School</label>
                        <div class="col-sm-10">
                            <select name="school" id="school" class="custom-select" readonly required>
                                <option value="" disabled selected="">Select School</option>
								@foreach($schools as $id => $val)
                                <option value="{{$id}}" @if($id == $topic->school_id ) selected @endif>{{$val}}</option>
                                @endforeach								
                            </select>
                        </div>
                    </div>
					
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Course</label>
                        <div class="col-sm-10">
                            <select name="course" id="school_course" class="custom-select" readonly required>
                                <option value="" disabled selected="">Select Course</option>
								@foreach($courses as $id => $val)
                                <option value="{{$id}}" @if($id == $topic->course_id ) selected @endif>{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Class</label>
                        <div class="col-sm-10">
                            <select name="class" id="class" class="custom-select" readonly required>
                                <option value="" disabled selected="">Select Class</option>
								@foreach($classes as $id => $val)
                                <option value="{{$id}}" @if($id == $topic->class_id ) selected @endif>{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
			
			<div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-right">Subject</label>
                <div class="col-sm-10">
                    <select name="subject" id="subject" class="custom-select" readonly required>
                        <option value="" selected="" disabled="">Choose Subject</option>
                    @foreach($subjects as $id => $name)
                        <option value="{{$id}}" @if($id == $topic->subject_id ) selected @endif>{{$name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
			
			<div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-right">Topic Name</label>
                <div class="col-sm-10">
                    <input type="text" name="topic_name" placeholder="Topic Name" class="form-control" value="{{$topic->topic_name}}" required>
                </div>
            </div>
			
            <div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-right"></label>
                <div class="col-sm-10">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" name="status" value="1" class="custom-control-input" @if($topic->status) checked @endif>
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