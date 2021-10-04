@extends('backend.layouts.layout-2')

@section('scripts')
<script type="text/javascript">

    $(document).ready(function () {
        $("#institute_type").on("change", function () {
            //var category_id = $(this).attr("data-id");
            var category_id = $('#institute_type option:selected').attr('data-id');

            if (category_id && category_id == '{{config("constants.UNIVERSITY")}}') {
                $("#department-field").show();
                $("select#department").attr("required", "required");
            } else {
                $("#department-field").hide();
                $("select#department").removeAttr("required");
            }

            $.ajax({
                type: "POST",
                url: '{{ route("ajax.category.schools", 1) }}',
                data: {'category': category_id, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    $("#school").html(data.schools);
                }
            });
        });

        $("#school").on("change", function () {
            //var school_id = $(this).val();
            var school_id = $('#school option:selected').attr('data-id');

            $.ajax({
                type: "POST",
                url: '{{ route("ajax.school.stdfiltercourses") }}',
                data: {'school_id': school_id, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    $("#school_course").html(data);
                }
            });

        });

        $("#school_course").on("change", function () {
            // var school_course = $('#school_course').val();
            var school_course = $('#school_course option:selected').attr('data-id');
            if (school_course) {
                $.ajax({
                    type: "POST",
                    url: '{{ route("ajax.school.stdfiltercourseclasses") }}',
                    data: {'course_id': school_course, '_token': '{{ csrf_token() }}'},
                    success: function (data) {
                        $("#class").html(data);
                    }
                });
            }
        });

        var table = $('#student-list').DataTable({
            "order": [[0, "asc"]],
            "columns": [
                null,
                {"orderable": false},
                null,
                {"orderable": false},
                {"orderable": false},
                {"orderable": false},
                {"orderable": false},
                {"orderable": false},
                null,
                null,
                null,
                {"orderable": false}
            ],
            dom: 'lrtip'
        });

        $('#student_name').on('keyup', function () {
            //alert('gdfgfd');
            regExSearch = this.value;
            table.column(1).search(regExSearch, true, false).draw();
            // table.search(this.value, true, false).draw();   
        });

        $('#institute_type').on('change', function () {
            //alert('gdfgfd');
            regExSearch = this.value + '\\s*$';
            table.column(4).search(regExSearch, true, false).draw();
            // table.search(this.value, true, false).draw();   
        });

        $('#school').on('change', function () {
            //alert('gdfgfd');
            regExSearch = this.value + '\\s*$';
            table.column(5).search(regExSearch, true, false).draw();
            //table.search(this.value, true, false).draw();   
        });

        $('#school_course').on('change', function () {
            //alert('gdfgfd');
            regExSearch = this.value + '\\s*$';
            table.column(6).search(regExSearch, true, false).draw();
            //table.search(this.value, true, false).draw();   
        });

        $('#class').on('change', function () {
            //alert('gdfgfd');
            regExSearch = this.value + '\\s*$';
            table.column(7).search(regExSearch, true, false).draw();
            table.search(this.value, true, false).draw();
        });

    });

</script>
@endsection

@section('content')

@includeif('backend.message')

<h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
    <div>Students</div>
    <a href="{{route('backend.students.create')}}" class="btn btn-primary rounded-pill d-block"><span class="ion ion-md-add"></span>&nbsp;Create student</a>
</h4>

<div class="card">
    <div class="card-datatable table-responsive">
        <div id="global-student-filter" class=""></div>
        <table id="student-list" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="align-top">S.No</th>
                    <th style="min-width: 7rem" class="align-top">Name
                        <input type="text" name="student_name" id="student_name" class="form-control">
                    </th>
                    <th class="align-top">Username</th>
                    <th class="align-top">Mobile</th>
                    <th style="min-width: 7rem" class="align-top">
                        Institute
                        @role('admin')
                        <select name="institute_type" id="institute_type" class="custom-select" required>
                            <option value="" selected="">All</option>
                            @foreach($institutes as $id => $type)
                            <option value="{{$type}}" data-id="{{$id}}">{{$type}}</option>
                            @endforeach
                        </select>
                        @endrole
                    </th>
                    <th style="min-width: 7rem" class="align-top">
                        School
                        @role('admin|subadmin')
                        <select name="school" id="school" class="custom-select" required>
                            <option value="" selected="">All</option>                        
                        </select>
                        @endrole
                    </th>
                    <th style="min-width: 7rem" class="align-top">
                        Course
                        @role('admin|subadmin')
                        <select name="course" id="school_course" class="custom-select">
                            <option value="" selected="">All</option>
                        </select>
                        @endrole
                        @if(Auth::user()->hasRole('school') && empty($classes))
                        <select name="course" id="school_course" class="custom-select">
                            <option value="" selected="">All</option>
                            @foreach($courses as $course)
                            <option value="{{$course->id}}" data-id="{{$course->id}}">{{$course->name}}</option>
                            @endforeach
                        </select>
                        @endif
                    </th>
                    <th style="min-width: 7rem" class="align-top">
                        Class
                        <select name="class" id="class" class="custom-select" required>
                            <option value="" selected="">All</option>
                            @foreach($classes as $id => $type)
                            <option value="{{$type}}" data-id="{{$id}}">{{$type}}</option>
                            @endforeach
                        </select>
                    </th>
                    <th class="align-top">Status</th>
                    <th class="align-top">Verify Status</th>
                    <th class="align-top">Registerd On</th>
                    <th class="align-top">Action</th>
                </tr>
            <tbody>
                @php $i=0; @endphp
                @foreach($students as $student)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{$student->getFullNameAttribute()}}</td>
                    <td>{{$student->user_details->username}}</td>
                    <td>{{$student->mobile}}</td>
                    <td>{{$student->category->name}}</td>
                    <td>{{$student->school->school_name}}</td>
                    <td>{{$student->course->name}}</td>
                    <td>{{$student->student_class->class_name}}</td>
                    <td>{{$student->status ? 'Active':'Disabled'}}</td>
                    <td>{{$student->user_details->mobile_verified_at ? 'Verified':'Not Verified'}}</td>
                    <td data-sort="{{$student->created_at->format('YmdHis')}}">{{$student->created_at->format('d-m-Y H:i:s')}}</td>
                    <td>
                        <a href ="{{route('backend.students.edit', $student->id)}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Edit"><i class="ion ion-md-create"></i></a>
                        @role('admin')
                        <form method="POST" action="{{route('backend.students.destroy', $student->id)}}" style="display: inline-block;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" onclick="return confirm('You are about to delete this record?')" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Remove"><i class="ion ion-md-close"></i></button>

                        </form>
                        @endrole
                        <a href ="{{route('backend.students.show', $student->id)}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="View student details"><i class="ion ion-md-eye"></i></a>
                        <a href ="{{route('backend.students.assignedclasses', $student->uuid)}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Assigned Classes"><i class="ion ion-md-list"></i></a>

                    </td>
                </tr>
                @endforeach
            </tbody>

            </thead>
        </table>
    </div>
</div>
@endsection