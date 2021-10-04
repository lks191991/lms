@extends('backend.layouts.layout-3')

@section('content')

<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
	<!-- Header -->
    <div class="container-m-nx container-m-ny bg-white mb-4">
		<div class="row">
			<div class="col-md-12">
				<div class="media col-md-10 py-5 mx-auto">
					@if(isset($school->logo) && $school->logo != 'noimage.jpg')
					<img class="school_logo mb-2 d-block rounded-circle" style="max-width:150px;" src='{{url("uploads/schools/$school->logo")}}'  /><br />
					@endif
					
					<div class="media-body ml-5">
						<h4 class="font-weight-bold mb-4">{{$school->school_name}}</h4>
						<div class="text-muted mb-2">
							<strong>School Short Name:</strong> {{$school->short_name}}
						</div>
						<div class="text-muted mb-2">
							<strong>School Category:</strong> {{$school->category->name}}
						</div>
						<div class="text-muted mb-4">
							{{$school->description}}
						</div>
					</div>
				</div>
			</div>
			
		</div>
        <hr class="m-0">
    </div>
    <!-- Header -->
    @includeif('backend.message')
    <div class="row">
        <div class="col">

            <!-- Info -->
            <div class="card mb-4">
                <div class="card-header row ml-0 mr-0">
                    <div class="col-md-12"><strong>Semesters/Term</strong></div>
                </div>

                <div class="card-body">

                    @if(!empty($semesters))
                    <form method="POST" action="{{route('backend.school.savesemester')}}">
                        <input type="hidden" name="school" value="{{$school->id}}">
                         @csrf
                        @foreach($semesters as $key => $semester)
                        <div class="row mb-2">
                            <div class="col-md-1">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="check{{$key}}" value="{{$key}}" @if($semester['status'] || old('check'.$key)) checked @endif class="">
                                </label>
                            </div>
                            <div class="col-md-3 text-muted">{{$semester['name']}}</div>
                            <div class="col-md-4"><input class="flatpickr flatpickr-input start_date form-control" value="{{$semester['date_begin']}}" type="text" name="start_date{{$key}}" id="start_date" placeholder="Start Date" /></div>
                            <div class="col-md-4"><input class="flatpickr flatpickr-input end_date form-control" value="{{$semester['date_end']}}" type="text" name="end_date{{$key}}" id="end_date" placeholder="End Date" /></div>
                        </div>
                        @endforeach
                        <div class="row mb-5">
                            <div class="col-md-12" style="text-align:center"><button type="submit" class="btn btn-primary">Submit</button></div>
                        </div>
                    </form>
                    @endif

                </div>

            </div>

            <!-- / Info -->

            <!-- Posts -->



            <!-- / Posts -->

        </div>

    </div>

    <!-- enable department for university only -->
    @if($school->school_category == config("constants.UNIVERSITY"))	  
    <div class="row">
        <div class="col">
            <div class="card mb-8">
                <div class="card-header row ml-0 mr-0">

                    <div class="col-md-9"><strong>Departments</strong></div>
                    <div class="col-md-3"><a href="#" class="btn btn-primary rounded-pill d-block" data-toggle="modal" data-target="#createDepartment"><span class="ion ion-md-add"></span>&nbsp;Create Department</a></div>

                </div>

                <div class="card-body">
                    <div class="card-datatable table-responsive">
                        <table id="department-list" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th style="min-width: 18rem">Department Name</th>
                                    <th style="min-width: 18rem">School Name</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            <tbody>
                                @php $i=0; @endphp
                                @if(!$departments->isEmpty())
                                @foreach($departments as $department)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{$department->name}}</td>
                                    <td>{{$department->school->school_name}}</td>
                                    <td>{{$department->status ? 'Active':'Disabled'}}</td>
                                    <td>

                                        <a href ="#" data-attr-id="{{$department->id}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip edit-department-link" title="Edit"><i class="ion ion-md-create"></i></a>
										@role('admin')
                                        <form method="POST" action="{{route('backend.departments.destroy', $department->id)}}" style="display: inline-block;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" name="department" value="{{$department->id}}">
                                            <input type="hidden" name="ajax_request" value="1">
                                            <button type="submit" onclick="return confirm('You are about to delete this record?')" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Remove"><i class="ion ion-md-close"></i></button>

                                        </form>
										@endrole
                                        <a href ="{{route('backend.departments.show', $department->id)}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="View school details"><i class="ion ion-md-eye"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5"><p class="text-center">No Record Found!</p></td>
                                </tr>
                                @endif
                            </tbody>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
	</div>
	@else
   <div class="row mt-4">
        <div class="col">
            <div class="card mb-8">
                <div class="card-header row ml-0 mr-0">

                    <div class="col-md-9"><strong>Courses</strong></div>
					@if($school->school_category != config("constants.BASIC_SCHOOL"))
						<div class="col-md-3"><a href="javascript:void(0)" class="btn btn-primary rounded-pill d-block" data-toggle="modal" data-target="#createCourse"><span class="ion ion-md-add"></span>&nbsp;Create Course</a></div>
					@endif

                </div>

                <div class="card-body">
                    <div class="card-datatable table-responsive">
                        <table id="courses-list" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th style="min-width: 18rem">Course Name</th>
                                    <th style="min-width: 18rem">School Name</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            <tbody>
                                @php $i=0; @endphp
                                @if(!$courses->isEmpty())
                                @foreach($courses as $course)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{$course->name}}</td>
                                    <td>{{$course->school->school_name}}</td>
                                    <td>{{$course->status ? 'Active':'Disabled'}}</td>
                                    <td>
                                        <a href ="{{route('backend.course.show', $course->id)}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="View course details"><i class="ion ion-md-eye"></i></a>
                                        
                                        @if($course->school->school_category != config("constants.BASIC_SCHOOL"))
                                        <a href ="#" data-attr-id="{{$course->id}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip edit-course-link" title="Edit"><i class="ion ion-md-create"></i></a>
										@role('admin')
                                        <form method="POST" action="{{route('backend.course.destroy', ['id'=>$course->id,'school_id'=>$school->id])}}" style="display: inline-block;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" name="course" value="{{$course->id}}">
                                            <input type="hidden" name="ajax_request" value="1">
                                            <button type="submit" onclick="return confirm('You are about to delete this record?')" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Remove"><i class="ion ion-md-close"></i></button>
										</form>
										@endrole
                                        @endif

                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5"><p class="text-center">No Record Found!</p></td>
                                </tr>
                                @endif
                            </tbody>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
		</div>
	@endif


</div>

<!-- create period modal -->
<div class="modal" id="createCourse">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create Course</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('backend.course.store')}}" method = "post">
                    @csrf

                    <input type="hidden" name="institute_type" value="{{$school->school_category}}">
                    <input type="hidden" name="school_name" value="{{$school->id}}">
                    <input type="hidden" name="ajax_request" value="1">

                    @if($school->school_category == config("constants.UNIVERSITY"))
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3 text-sm-right">Department</label>
                        <div class="col-sm-9">
                            <select name="department" id="department" class="custom-select" required>
                                <option value="" disabled>Select Department</option>
                                @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3 text-sm-right">Course Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" placeholder="Course Name" value="{{ old('name') }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-3 text-sm-right">Course Description</label>
                        <div class="col-sm-9">
                            <textarea name="description" class="form-control" placeholder="Course Description">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-3 text-sm-right"></label>
                        <div class="col-sm-9">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="status" value="1" @if(old('status')) checked @endif class="custom-control-input">
                                       <span class="custom-control-label">Active</span>
                            </label>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-10 ml-sm-auto">
                            <button data-dismiss="modal" class="btn btn-danger mr-2">Cancel</button> <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- edit period modal -->
<div class="modal" id="editCourse">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Course</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body edit_course">

            </div>

        </div>
    </div>
</div>


<!-- create subject modal -->
<div class="modal" id="createDepartment">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create Department</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('backend.departments.store')}}" method = "post">
                    @csrf

                    <input type="hidden" name="school" value="{{$school->id}}">
                    <input type="hidden" name="ajax_request" value="1">

                    <div class="form-group row">
                        <label class="col-form-label col-sm-3 text-sm-right">Department Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" placeholder="Department Name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-form-label col-sm-3 text-sm-right"></label>
                        <div class="col-sm-9">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="status" value="1" @if(old('status')) checked @endif class="custom-control-input">
                                       <span class="custom-control-label">Active</span>
                            </label>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-10 ml-sm-auto">
                            <button data-dismiss="modal" class="btn btn-danger mr-2">Cancel</button> <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- edit subject modal -->
<div class="modal" id="editDepartment">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Department</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body edit_department">

            </div>

        </div>
    </div>
</div>		 
<!-- / Content -->
@endsection
@section('scripts')

<script>
    $(document).ready(function () {



        $(".edit-course-link").on("click", function () {
            var course_id = $(this).attr("data-attr-id");
            $(".edit_course").html("Loading...");
            $("#editCourse").modal();
            if (course_id) {
                $.ajax({
                    type: "POST",
                    url: '{{ route("backend.course.edit_ajax") }}',
                    data: {'course_id': course_id, '_token': '{{ csrf_token() }}'},
                    success: function (data) {
                        $(".edit_course").html(data);
                        return true;
                    }
                });
            }
        });

        $(".edit-department-link").on("click", function () {
            var department_id = $(this).attr("data-attr-id");
            $(".edit_department").html("Loading...");
            $("#editDepartment").modal();
            if (department_id) {
                $.ajax({
                    type: "POST",
                    url: '{{ route("backend.departments.edit_ajax") }}',
                    data: {'department_id': department_id, '_token': '{{ csrf_token() }}'},
                    success: function (data) {
                        $(".edit_department").html(data);
                        return true;
                    }
                });
            }
        });

        $(".start_date").flatpickr({
            //defaultDate: "{{date('Y-m-d')}}",
        });

        $(".end_date").flatpickr({
            minDate: $("#start_date").val()

        });

    });

    $(function () {
        $('#courses-list').dataTable(
                {
                    "order": [[1, "asc"]],
                    "columns": [
                        null,
                        null,
                        null,
                        null,
                        {"orderable": false}
                    ]
                }
        );

        $('#department-list').dataTable(
                {
                    "order": [[1, "asc"]],
                    "columns": [
                        null,
                        null,
                        null,
                        null,
                        {"orderable": false}
                    ]
                }
        );

    });
</script>
@stop