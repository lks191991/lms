@extends('backend.layouts.layout-2')

@section('scripts')
<script type="text/javascript">

    $(document).ready(function () {
      

      
     

        var table = $('#student-list').DataTable({
            "order": [[0, "asc"]],
            "columns": [
                null,
                {"orderable": false},
                null,
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
                    <td>{{$student->status ? 'Active':'Disabled'}}</td>
                    <td>{{$student->user_details->mobile_verified_at ? 'Verified':'Not Verified'}}</td>
                    <td data-sort="{{$student->created_at->format('YmdHis')}}">{{$student->created_at->format('d-m-Y H:i:s')}}</td>
                    <td>
                        <a href ="{{route('backend.students.edit', $student->id)}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Edit"><i class="ion ion-md-create"></i></a>
                       
                        <form method="POST" action="{{route('backend.students.destroy', $student->id)}}" style="display: inline-block;">
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