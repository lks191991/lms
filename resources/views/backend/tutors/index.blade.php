@extends('backend.layouts.layout-2')

@section('scripts')

<script type="text/javascript">
   $(document).ready(function () {
	
	
        
		
		var table = $('#tutor-list').DataTable({
	   "order": [[ 0, "asc" ]],
            "columns": [
              null,
              { "orderable": false },
            { "orderable": false },
			 { "orderable": false },
              null,
			  null,
              { "orderable": false }
            ],
			dom: 'lrtip'
	});
		
	$('#tutor_name').on('keyup', function(){		
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
    <div>Tutors</div>
 <a href="{{route('backend.tutors.create')}}" class="btn btn-primary rounded-pill d-block"><span class="ion ion-md-add"></span>&nbsp;Create tutor</a>
</h4>

<div class="card">
    <div class="card-datatable table-responsive">
	<table id="tutor-list" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="align-top">S.No</th>
                    <th class="align-top">Name
					<input type="text" name="tutor_name" id="tutor_name" class="form-control">
					</th>
                    <th class="align-top">Username</th>
					<th class="align-top">Mobile</th>
					
					<th class="align-top">Status</th>
					<th class="align-top">Verify Status</th>
                    <th class="align-top">Action</th>
                </tr>
            <tbody>
                @php $i=0; @endphp
                @foreach($tutors as $tutor)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{$tutor->getFullNameAttribute()}}</td>
                    <td>{{$tutor->user_details->username}}</td>
					<td>{{$tutor->mobile}}</td>
					<td>{{$tutor->status ? 'Active':'Disabled'}}</td>
					<td>{{$tutor->user_details->mobile_verified_at ? 'Verified':'Not Verified'}}</td>
                    <td>
                    <a href ="{{route('backend.tutors.edit', $tutor->id)}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Edit"><i class="ion ion-md-create"></i></a>
						@role('admin')
                        <form method="POST" action="{{route('backend.tutors.destroy', $tutor->id)}}" style="display: inline-block;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" onclick="return confirm('You are about to delete this record?')" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Remove"><i class="ion ion-md-close"></i></button>

                        </form>
						@endrole
						<a href ="{{route('backend.tutors.show', $tutor->id)}}" style="display:none" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="View tutor details"><i class="ion ion-md-eye"></i></a>
						
                    </td>
                </tr>
                @endforeach
            </tbody>
			
            </thead>
        </table>
    </div>
</div>
@endsection