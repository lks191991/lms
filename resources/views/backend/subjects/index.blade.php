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
            if(school_course) {                
                $.ajax({
                    type: "POST",
                    url: '{{ route("ajax.school.stdfiltercourseclasses") }}',
                    data: {'course_id' : school_course, '_token': '{{ csrf_token() }}'},
                    success: function (data) {
                        $("#class").html(data);
                    }
                });
            }
        });
		
		var table = $('#subject-list').DataTable({
		   "order": [[ 0, "asc" ]],
				"columns": [
				  null,
				  { "orderable": false },
				  { "orderable": false },
				  { "orderable": false },
				  { "orderable": false },
				  { "orderable": false },
				  null,
				  { "orderable": false }
				],
				dom: 'lrtip'
		});
		
		$('#subject_name').on('keyup', function(){
	    //alert('gdfgfd');
	    regExSearch = this.value;
		table.column(1).search(regExSearch, true, false).draw();
		  // table.search(this.value, true, false).draw();   
		});
	
		$('#school').on('change', function(){		
	   //alert('gdfgfd');
		regExSearch = this.value +'\\s*$';
		table.column(2).search(regExSearch, true, false).draw();
	   //table.search(this.value, true, false).draw();   
		});
	   
	   $('#school_course').on('change', function(){		
		   //alert('gdfgfd');
			regExSearch = this.value +'\\s*$';
			table.column(3).search(regExSearch, true, false).draw();
		   //table.search(this.value, true, false).draw();   
		});
		
		$('#class').on('change', function(){		
		   //alert('gdfgfd');
		   regExSearch = this.value +'\\s*$';
		   table.column(4).search(regExSearch, true, false).draw();
		   table.search(this.value, true, false).draw();   
		});
		
        
    });
</script>
@endsection

@section('content')
@includeif('backend.message')
<h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
    <div>Subjects</div>
  <a href="{{route('backend.subjects.create')}}" class="btn btn-primary rounded-pill d-block"><span class="ion ion-md-add"></span>&nbsp;Create Subject</a>
</h4>

<div class="card">
    
    <div class="card-datatable table-responsive">
        <table id="subject-list" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="align-top">S.No</th>
                    <th class="align-top">
					Subject Name
					<input type="text" name="subject_name" id="subject_name" class="form-control">
					</th>
					<th class="align-top">
					School Name
					<select name="school" id="school" class="custom-select" required>
							<option value="" selected="">All</option>
							@foreach($schools as $id => $type)
								<option value="{{$type}}" data-id="{{$id}}">{{$type}}</option>
							@endforeach
						 </select>
					</th>
					<th style="min-width: 7rem" class="align-top">
						Course
						<select name="course" id="school_course" class="custom-select" required>
									<option value="" selected="">All</option>
						</select>
					</th>
					<th style="min-width: 7rem" class="align-top">
						Class
						<select name="class" id="class" class="custom-select" required>
                                <option value="" selected="">All</option>                        
                        </select>
					</th>
					   <th class="align-top">
					Price
					</th>
                    <th class="align-top">Status</th>
                    <th class="align-top">Action</th>
                </tr>
            <tbody>
                @php $i=0; @endphp
                @foreach($subjects as $subject)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{$subject->subject_name}}</td>
					<td>{{$subject->school_details($subject->course_details($subject->subject_class->course_id)->school_id)}}</td>
					<td>{{$subject->course_details($subject->subject_class->course_id)->name}}</td>
					<td>@if(isset($subject->subject_class->class_name) && !empty(($subject->subject_class->class_name))){{$subject->subject_class->class_name}}@endif</td>
					<td>{{$subject->subject_price}}</td>
                    <td>{{$subject->status ? 'Active':'Disabled'}}</td>
                   <td>
                        <a href ="{{route('backend.subjects.edit', $subject->id)}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Edit"><i class="ion ion-md-create"></i></a>
                        @role('admin')
						<form method="POST" action="{{route('backend.subjects.destroy', $subject->id)}}" style="display: inline-block;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" onclick="return confirm('You are about to delete this record?')" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Remove"><i class="ion ion-md-close"></i></button>

                        </form>
						@endrole
						<a href ="{{route('backend.subjects.show', $subject->id)}}" style="display:none" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="View subject details"><i class="ion ion-md-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </thead>
        </table>
    </div>
</div>
@endsection