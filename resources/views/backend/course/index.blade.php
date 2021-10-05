@extends('backend.layouts.layout-2')

@section('scripts')

<script type="text/javascript">
    $(function () {
        $('#course-list').dataTable(
			{
            "order": [[ 0, "asc" ]],
            "columns": [
              null,
              null,
             { "orderable": false },
			  null,
              { "orderable": false }
            ],
			initComplete: function () {
            this.api().columns([2]).every( function () {
                var column = this;
                var select = $('<select class="custom-select"><option value="">All</option></select>')
                    .appendTo( $(column.header()) )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
          }
		);
    });
</script>
@endsection

@section('content')

@includeif('backend.message')

<h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
    <div>Courses</div>
    <a href="{{route('backend.course.create')}}" class="btn btn-primary rounded-pill d-block"><span class="ion ion-md-add"></span>&nbsp;Create course</a>
</h4>

<div class="card">
    <div class="card-datatable table-responsive">
        <table id="course-list" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="align-top">S.No</th>
                    <th style="min-width: 18rem" class="align-top">Course Name</th>
                    <th style="min-width: 18rem" class="align-top">School Name</th>
					<th class="align-top">Status</th>
                    <th class="align-top">Action</th>
                </tr>
            <tbody>
                @php $i=0; @endphp
                @foreach($courses as $course)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{$course->name}}</td>
                    <td>{{$course->school->school_name}}</td>
					<td>{{$course->status ? 'Active':'Disabled'}}</td>
                    <td>
							<a href ="{{route('backend.course.edit', $course->id)}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Edit"><i class="ion ion-md-create"></i></a>
							@role('admin')
							<form method="POST" action="{{route('backend.course.destroy', $course->id)}}" style="display: inline-block;">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}

								<button type="submit" onclick="return confirm('You are about to delete this record?')" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Remove"><i class="ion ion-md-close"></i></button>

							</form>
							@endrole
						<a href ="{{route('backend.course.show', $course->id)}}" style="display:none" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="View course details"><i class="ion ion-md-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </thead>
        </table>
    </div>
</div>
@endsection