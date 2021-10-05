@extends('backend.layouts.layout-2')

@section('scripts')

<script type="text/javascript">
    $(document).ready(function () {

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

        var table = $('#class-list').DataTable({
            "order": [[0, "asc"]],
            "columns": [
                null,
                {"orderable": false},
                {"orderable": false},
                {"orderable": false},
                null,
                {"orderable": false}
            ],
            dom: 'lrtip'
        });

        $('#class_name').on('keyup', function () {
            //alert('gdfgfd');
            regExSearch = this.value;
            table.column(1).search(regExSearch, true, false).draw();
            // table.search(this.value, true, false).draw();   
        });

        $('#school').on('change', function () {
            //alert('gdfgfd');
            regExSearch = this.value + '\\s*$';
            table.column(2).search(regExSearch, true, false).draw();
            //table.search(this.value, true, false).draw();   
        });

        $('#school_course').on('change', function () {
            //alert('gdfgfd');
            regExSearch = this.value + '\\s*$';
            table.column(3).search(regExSearch, true, false).draw();
            //table.search(this.value, true, false).draw();   
        });


    });
</script>
@endsection

@section('content')
@includeif('backend.message')

<h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
    <div>Classes</div>
    <a href="{{route('backend.classes.create')}}" class="btn btn-primary rounded-pill d-block"><span class="ion ion-md-add"></span>&nbsp;Create Class</a>
</h4>

<div class="card">

    <div class="card-datatable table-responsive">
        <table id="class-list" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="align-top">S.No</th>
                    <th style="min-width: 8rem" class="align-top">Class Name<input type="text" name="class_name" id="class_name" class="form-control"></th>
                    <th style="min-width: 8rem" class="align-top">
                        School Name
                        <select name="school" id="school" class="custom-select" required>
                            <option value="" selected="">All</option>
                            @foreach($schools as $id => $type)
                            <option value="{{$type}}" data-id="{{$id}}">{{$type}}</option>
                            @endforeach
                        </select>
                    </th>
                    <th style="min-width: 8rem" class="align-top">
                        Course Name
                        <select name="course" id="school_course" class="custom-select" required>
                            <option value="" selected="">All</option>
                        </select>
                    </th>
                    <th class="align-top">Status</th>
                    <th class="align-top">Action</th>
                </tr>
            <tbody>
                @php $i=0; @endphp
                @foreach($classes as $class)

                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{$class->class_name}}</td>
                    <td>
                        @if(isset($class->course->school_id) && !empty($class->course->school_id))
                        {{$class->school_details($class->course->school_id)}} 
                        @endif
                    </td>
                    <td>
                        @if(isset($class->course->name) && !empty($class->course->name))
                        {{$class->course->name}}
                        @endif
                    </td>
                    <td>{{$class->status ? 'Active':'Disabled'}}</td>
                    <td>
                        <a href ="{{route('backend.classes.edit', $class->id)}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Edit"><i class="ion ion-md-create"></i></a>
                        @role('admin')
                        <form method="POST" action="{{route('backend.classes.destroy', $class->id)}}" style="display: inline-block;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" onclick="return confirm('You are about to delete this record?')" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Remove"><i class="ion ion-md-close"></i></button>

                        </form>
                        @endrole
                        <a href ="{{route('backend.classes.show', $class->id)}}" style="display:none" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="View class details"><i class="ion ion-md-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </thead>
        </table>
    </div>
</div>
@endsection