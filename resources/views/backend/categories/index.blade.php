@extends('backend.layouts.layout-2')

@section('scripts')

<script type="text/javascript">
    $(function () {
        $('#category-list').dataTable(
			{
            "order": [[ 0, "asc" ]],
            "columns": [
              null,
              null,
			  null,
             { "orderable": false }
            ]
          }
		);
    });
</script>
@endsection

@section('content')

@includeif('backend.message')

<h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
    <div>Institutions</div>
    <a href="{{route('backend.categories.create')}}" class="btn btn-primary rounded-pill d-block"><span class="ion ion-md-add"></span>&nbsp;Create Institution</a>
</h4>

<div class="card">
    <div class="card-datatable table-responsive">
        <table id="category-list" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th style="min-width: 18rem">Institution Name</th>
					<th>Status</th>
                    <th class="align-top">Action</th>
                </tr>
            <tbody>
                @php $i=0; @endphp
                @foreach($categories as $category)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{$category->name}}</td>
					<td>{{$category->status ? 'Active':'Disabled'}}</td>
                    <td>
                        <a href ="{{route('backend.categories.edit', $category->id)}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Edit"><i class="ion ion-md-create"></i></a>
                        @role('admin')
						<form method="POST" action="{{route('backend.categories.destroy', $category->id)}}" style="display: inline-block;">
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