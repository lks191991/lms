@extends('backend.layouts.layout-3')

@section('content')
	
   <!-- Content -->
          <div class="container-fluid flex-grow-1 container-p-y">

            <!-- Header -->
            <div class="container-m-nx container-m-ny bg-white mb-4">
			<div class="row">
			<div class="col-md-10">
              <div class="media col-md-10 col-lg-8 col-xl-7 py-5 ml-3">
			 <!--  @if(isset($course->school->logo) && $course->school->logo != 'noimage.jpg')
						<img class="school_logo mb-2 d-block rounded-circle" src='{{url("uploads/schools")}}/{{$course->school->logo}}'  /><br />
			   @endif -->
                
                <div class="media-body ml-1">
                  <h4 class="font-weight-bold mb-4">{{$course->name}}</h4>
				  <div class="row mb-2">
                      <div class="col-md-3 text-muted">School Name:</div>
                      <div class="col-md-9">
                       <a href="{{route('backend.school.show',$course->school_id)}}" class="text-body">{{$course->school->school_name}}</a>
                      </div>
                    </div>

                   
				</div>
				
              </div>
			  </div>
			 <div class="col-md-2 ml-10 mt-5">
			<a href="javascript:void(0)" onclick="window.history.go(-1); return false;" class="btn btn-primary rounded-pill d-block detail-back-btn">Back</a>
			</div>
			 </div>
              <hr class="m-0">
            </div>
            <!-- Header -->


       @includeif('backend.message') 	
			
		<div class="row">
            <div class="col">
			 <div class="card mb-8">
			 <div class="card-header row ml-0 mr-0">
		
		<div class="col-md-9"><strong>Classes</strong></div>
		 <div class="col-md-3"><a href="#" class="btn btn-primary rounded-pill d-block" data-toggle="modal" data-target="#createClass"><span class="ion ion-md-add"></span>&nbsp;Create Class</a></div>
		
		</div>
		
                  <div class="card-body">
                   <div class="card-datatable table-responsive">
        <table id="classes-list" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Class Name</th>
					<th>Course</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
           <tbody>
                   @php $i=0; @endphp
					@if(!$course->classes->isEmpty())
					@foreach($course->classes as $class)
					<tr>
                     <td>{{ ++$i }}</td>
                    <td>{{$class->class_name}}</td>
					<td>{{$course->name}}</td>
                    <td>{{$class->status ? 'Active':'Disabled'}}</td>
                    <td>
                        <a href ="#" data-attr-id="{{$class->id}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip edit-class-link" title="Edit"><i class="ion ion-md-create"></i></a>
                        @role('admin')
						<form method="POST" action="{{route('backend.classes.destroy', $class->id)}}" style="display: inline-block;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
							<input type="hidden" name="course" value="{{$course->id}}">
							<input type="hidden" name="ajax_request" value="1">
                            <button type="submit" onclick="return confirm('You are about to delete this record?')" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Remove"><i class="ion ion-md-close"></i></button>

                        </form>
						@endrole
						<a href ="{{route('backend.classes.show', $class->id)}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="View school details"><i class="ion ion-md-eye"></i></a>
                    </td>
                     </tr>
                    @endforeach
                  @else
                  <tr>
                      <td colspan="5"><p class="text-center">No Record Found!</p></td>
				  </tr>
                  @endif
                  </tbody>
			</tbody>
            </thead>
        </table>
    </div>
                  </div>
                  
                </div>
			</div>
			

          </div>
		  
	</div>
		
<!-- create period modal -->
<div class="modal" id="createClass">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Create Class</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{route('backend.classes.store')}}" method = "post">
            @csrf
			
			<input type="hidden" name="course" value="{{$course->id}}">
			<input type="hidden" name="ajax_request" value="1">
			
			 <div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right">Class Name</label>
                <div class="col-sm-9">
                    <input type="text" name="class_name" placeholder="Class Name" class="form-control" required>
                </div>
            </div>
			
			 
           <div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right"></label>
                <div class="col-sm-9">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" name="status" value="1" class="custom-control-input">
                        <span class="custom-control-label">Active</span>
                    </label>
                </div>
            </div>


            <div class="form-group row">
                <div class="col-sm-10 ml-sm-auto">
                    <button data-dismiss="modal" class="btn btn-danger mr-2">Cancel</button> <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- edit class modal -->
<div class="modal" id="editClass">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Class</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body edit_class">
        
      </div>

    </div>
  </div>
</div>

 <!-- / Content -->
@endsection

@section('scripts')
<!--<script src="{{ mix('/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>-->

<script>
    $(document).ready(function () {
	
     $(".edit-class-link").on("click", function () {
            var class_id = $(this).attr("data-attr-id");
			$(".edit_class").html("Loading...");
			$("#editClass").modal();
            if(class_id) {                
                $.ajax({
                    type: "POST",
                    url: '{{ route("backend.classes.edit_ajax") }}',
                    data: {'class_id' : class_id, '_token': '{{ csrf_token() }}'},
                    success: function (data) {
                        $(".edit_class").html(data);
						return true;
                    }
                });
            }
        });
		
});
 
 $(function () {
        $('#classes-list').dataTable(
			{
            "order": [[ 0, "desc" ]],
			"columns": [
              null,
              null,
              { "orderable": false },
			  null,
              { "orderable": false }
            ]
          }
		);
    });
</script>
@stop