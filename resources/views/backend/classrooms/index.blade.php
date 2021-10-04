@extends('backend.layouts.layout-2')

@section('scripts')

<script type="text/javascript">
    $(function () {
        $('#classroom-list').dataTable( {
            "order": [[ 0, "asc" ]],
            "columns": [
              null,
              null,
              null,
			  null,
			  null,
			  null,
			  null,
              { "orderable": false }
            ]
          } );
    });
</script>
@endsection

@section('content')
@includeif('backend.message')
<h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
    <div>Classrooms</div>
    <a href="{{route('backend.classrooms.create')}}" class="btn btn-primary rounded-pill d-block"><span class="ion ion-md-add"></span>&nbsp;Create Classroom</a>
</h4>

<div class="card">
    
    <div class="card-datatable table-responsive">
        <table id="classroom-list" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Classroom Name</th>
					<th>School Name</th>
					<th>Course Name</th>
					<th>Class Name</th>
					<th>Date</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            <tbody>
                @php $i=0; @endphp
                @foreach($classrooms as $classroom)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{$classroom->classroom_name}}</td>
					<td>{{$classroom->school->school_name}}</td>
					<td>{{$classroom->course->name}}</td>
					<td>{{$classroom->className->class_name}}</td>
					<td>{{$classroom->date}}</td>
                    <td>{{$classroom->status ? 'Active':'Disabled'}}</td>
                    <td>
                        <a href ="{{route('backend.classrooms.edit', $classroom->id)}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Edit"><i class="ion ion-md-create"></i></a>
                        @role('admin')
						<form method="POST" action="{{route('backend.classrooms.destroy', $classroom->id)}}" style="display: inline-block;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" onclick="return confirm('You are about to delete this record?')" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Remove"><i class="ion ion-md-close"></i></button>

                        </form>
						@endrole
                    </td>
                </tr>
                @endforeach
            </tbody>
            </thead>
        </table>
    </div>
</div>
@endsection