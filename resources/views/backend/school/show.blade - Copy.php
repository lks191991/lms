@extends('backend.layouts.layout-3')

@section('scripts')

<script type="text/javascript">
    $(function () {
        $('#course-list').dataTable(
			{
            "order": [[ 1, "asc" ]],
            "columns": [
              null,
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
	
   <!-- Content -->
          <div class="container-fluid flex-grow-1 container-p-y">

            <!-- Header -->
            <div class="container-m-nx container-m-ny bg-white mb-4">
              <div class="media col-md-10 col-lg-8 col-xl-7 py-5 mx-auto">
			   @if(isset($school->logo) && $school->logo != 'noimage.jpg')
						<img class="school_logo mb-2 d-block rounded-circle" src='{{url("uploads/schools/$school->logo")}}'  /><br />
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
              <hr class="m-0">
            </div>
            <!-- Header -->

            <div class="row">
              <div class="col">

                <!-- Info -->
                <div class="card mb-4">
                  <div class="card-body">

                    <div class="row mb-2">
                      <div class="col-md-3 text-muted">School Short Name:</div>
                      <div class="col-md-9">
                       {{$school->short_name}}
                      </div>
                    </div>

                    <div class="row mb-2">
                      <div class="col-md-3 text-muted">School Category:</div>
                      <div class="col-md-9">
                        <a href="javascript:void(0)" class="text-body">{{$school->category->name}}</a>
                      </div>
                    </div>

                   

                  
                  </div></div>
                <!-- / Info -->

                <!-- Posts -->

               

                <!-- / Posts -->

              </div>
              <div class="col-xl-4">

                <!-- Side info -->
                <div class="card mb-4">
                  <div class="card-body">
                    <a href="{{route('backend.course.create', $school->id)}}" class="btn btn-primary rounded-pill d-block"><span class="ion ion-md-add"></span>&nbsp;Create course</a>
                     
                  </div>
                  
                </div>
                <!-- / Side info -->

                

                

              

              </div>
            </div>
			
			<div class="row">
              <div class="col">
			 <div class="card mb-8">
			 <div class="card-header ">
		<div class="col-sm-6 col-xl-4"><strong>Courses</strong></div>
		
		
       </div>
		<div class="ml-2 mr-2 mt-2">	
        @includeif('backend.message') 
		</div>
                  <div class="card-body">
                   <div class="card-datatable table-responsive">
        <table id="course-list" class="table table-striped table-bordered">
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
                @foreach($courses as $course)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{$course->name}}</td>
                    <td>{{$course->school->school_name}}</td>
					<td>{{$course->status ? 'Active':'Disabled'}}</td>
                    <td>
                       <a href ="{{route('backend.course.show', $course->id)}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="View course details"><i class="ion ion-md-eye"></i></a>
                       <a href ="{{route('backend.course.edit', ['id'=>$course->id,'school_id'=>$school->id])}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Edit"><i class="ion ion-md-create"></i></a>
						@role('admin')
                        <form method="POST" action="{{route('backend.course.destroy', ['id'=>$course->id,'school_id'=>$school->id])}}" style="display: inline-block;">
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
                  
                </div>
			</div>
			

          </div>
		   </div>
          <!-- / Content -->
@endsection