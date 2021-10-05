@extends('backend.layouts.layout-2')

@section('scripts')

<script type="text/javascript">
    $(function () {

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

        $("#class").on("change", function () {
            var class_id = $('#class option:selected').attr('data-id');

            if (class_id) {
                $.ajax({
                    type: "POST",
                    url: '{{ route("ajax.school.filterclasssubjects") }}',
                    data: {'class_id': class_id, '_token': '{{ csrf_token() }}'},
                    success: function (data) {
                        $("#subject").html(data);
                    }
                });
            }
        });

        var table = $('#video-list').DataTable({
            "order": [[0, "asc"]],
            "columns": [
                null,
                null,
                {"orderable": false},
                {"orderable": false},
                {"orderable": false},
                {"orderable": false},
                {"orderable": false},
                null,
                {"orderable": false}
            ],
            dom: 'lrtip'
        });
        $('#video_title').on('keyup', function () {
            //alert('gdfgfd');
            regExSearch = this.value;
            table.column(7).search(regExSearch, true, false).draw();
            // table.search(this.value, true, false).draw();   
        });
        $('#school').on('change', function () {
            //alert('gdfgfd');
            regExSearch = this.value + '\\s*$';
            table.column(3).search(regExSearch, true, false).draw();
            //table.search(this.value, true, false).draw();   
        });

        $('#school_course').on('change', function () {
            //alert('gdfgfd');
            regExSearch = this.value + '\\s*$';
            table.column(4).search(regExSearch, true, false).draw();
            //table.search(this.value, true, false).draw();   
        });

        $('#class').on('change', function () {
            //alert('gdfgfd');
            regExSearch = this.value + '\\s*$';
            table.column(5).search(regExSearch, true, false).draw();
            table.search(this.value, true, false).draw();
        });

        $('#subject').on('change', function () {
            //alert('gdfgfd');
            regExSearch = this.value + '\\s*$';
            table.column(6).search(regExSearch, true, false).draw();
            table.search(this.value, true, false).draw();
        });

    });
</script>
@endsection

@section('content')
@includeif('backend.message')
<h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
    <div>Videos</div>
    <a href="{{route('backend.videos.create')}}" class="btn btn-primary rounded-pill d-block"><span class="ion ion-md-add"></span>&nbsp;Create Video</a>
</h4>

<div class="card">

    <div class="card-datatable table-responsive">
        <table id="video-list" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="align-top">S.No</th>
                    <th class="align-top">Date</th>
                    <th class="align-top">
                        School
                        @role('admin|subadmin')
                        <select name="school" id="school" class="custom-select">
                            <option value="" selected="">All</option>
                            @foreach($schools as $id => $type)
                            <option value="{{$type}}" data-id="{{$id}}">{{$type}}</option>
                            @endforeach
                        </select>
                        @endrole
                    </th>
                    <th class="align-top">
                        Course
                        @role('admin|subadmin')
                        <select name="course" id="school_course" class="custom-select">
                            <option value="" selected="">All</option>
                        </select>
                        @endrole
                    </th>
                    <th class="align-top">
                        Class
                        <select name="class" id="class" class="custom-select">
                            <option value="" selected="">All</option>
                            @foreach($classes as $id => $type)
                            <option value="{{$type}}" data-id="{{$id}}">{{$type}}</option>
                            @endforeach
                        </select>
                    </th>
                    <th class="align-top">
                        Subject
                        <select name="subject" id="subject" class="custom-select">
                            <option value="" selected="">All</option>                        
                        </select>
                    </th>
                    <th style="min-width: 4rem" class="align-top">Title
                    <input type="text" name="video_title" id="video_title" class="form-control">
                    </th>
                    <th class="align-top">Status</th>
                    <th class="align-top">Action</th>
                </tr>
            <tbody>
                @php $i=0; @endphp
                @foreach($videos as $video)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{$video->playOn()}}</td>
                    <td>{{$video->school->school_name}}</td>
                    <td>{{$video->course->name}}</td>
                    <td>{{$video->classDetail->class_name}}</td>
                    <td>{{$video->subject->subject_name}}</td>
                    <td>
                        <p><strong>{{$video->getTitleAttribute()}}</strong></p>
                        <p>{{$video->getSubTitleAttribute()}}</p>
                    </td>
                    <td>{{$video->status ? 'Active':'Disabled'}}</td>
                    <td>
                        <a href ="{{route('backend.videos.show', $video->uuid)}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="View video details"><i class="ion ion-md-eye"></i></a>
                        <a href ="{{route('backend.videos.edit', $video->uuid)}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Edit"><i class="ion ion-md-create"></i></a>
                        
                                         
                        <form method="POST" action="{{route('backend.videos.destroy', $video->id)}}" style="display: inline-block;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" onclick="return confirm('You are about to delete this record?')" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Remove"><i class="ion ion-md-close"></i></button>
                        </form>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
            </thead>
        </table>
    </div>
</div>
@endsection