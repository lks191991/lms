@extends('backend.layouts.layout-2')

@section('scripts')

<script type="text/javascript">
    $(function () {
        $('#school-list').dataTable(
			{
            "order": [[ 0, "asc" ]],
            "columns": [
              null,
              null,
			  null,
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
<style>
table.dataTable thead .sorting_asc::before, 
table.dataTable thead .sorting_asc::after,
table.dataTable thead .sorting_desc::before, 
table.dataTable thead .sorting_desc::after,
table.dataTable thead .sorting::before, 
table.dataTable thead .sorting::after {
    top: 0.625rem;
    margin-top: 0;
}
</style>
<h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
    <div>Schools</div>
	@role('admin|subadmin')
		<a href="{{route('backend.school.create')}}" class="btn btn-primary rounded-pill d-block"><span class="ion ion-md-add"></span>&nbsp;Create school</a>
	@endrole
	</h4>

<div class="card">
    <div class="card-datatable table-responsive">
        <table id="school-list" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="align-top">S.No</th>
                    <th style="min-width: 18rem" class="align-top">School Name</th>
                    <th style="min-width: 18rem" class="align-top">Institution</th>
					<th class="align-top">Status</th>
                    <th class="align-top">Action</th>
                </tr>
            <tbody>
                @php $i=0; @endphp
                @foreach($schools as $school)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{$school->school_name}}</td>
                    <td>{{$school->category->name}}</td>
					<td>{{$school->status ? 'Active':'Disabled'}}</td>
                    <td>
                        <a href ="{{route('backend.school.edit', $school->id)}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Edit"><i class="ion ion-md-create"></i></a>

                        @role('admin')
							<form method="POST" action="{{route('backend.school.destroy', $school->id)}}" style="display: inline-block;">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}

								<button type="submit" onclick="return confirm('You are about to delete this record?')" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Remove"><i class="ion ion-md-close"></i></button>

							</form>
						@endrole
						
						<a href ="{{route('backend.school.show', $school->id)}}" style="display:none" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="View school details"><i class="ion ion-md-eye"></i></a>
						
                    </td>
                </tr>
                @endforeach
            </tbody>
            </thead>
        </table>
    </div>
</div>
@endsection