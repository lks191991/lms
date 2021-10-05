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

		$("#class").on("change", function () {
            var class_id = $('#class option:selected').attr('data-id');
          
            if(class_id) {                
                $.ajax({
                    type: "POST",
                    url: '{{ route("ajax.school.filterclasssubjects") }}',
                    data: {'class_id' : class_id, '_token': '{{ csrf_token() }}'},
                    success: function (data) {
                        $("#subject").html(data);
                    }
                });
            }
        });
		  
	var table = $('#topic-list').DataTable({
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
		  
	$('#topic_name').on('keyup', function(){
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
		
		$('#subject').on('change', function(){		
		   //alert('gdfgfd');
		   regExSearch = this.value +'\\s*$';
		   table.column(5).search(regExSearch, true, false).draw();
		   table.search(this.value, true, false).draw();   
		});

	
    });
</script>
@endsection

@section('content')
@includeif('backend.message')
<h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
    <div>Topics</div>
    <a href="{{route('backend.topics.create')}}" class="btn btn-primary rounded-pill d-block"><span class="ion ion-md-add"></span>&nbsp;Create Topic</a>
</h4>

<div class="card">
    
    <div class="card-datatable table-responsive">
        <table id="topic-list" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="align-top">S.No</th>
                    <th class="align-top">
						Topic Name
						<input type="text" name="topic_name" id="topic_name" class="form-control">
					</th>
					<th class="align-top">
						School
						<select name="school" id="school" class="custom-select">
								<option value="" selected="">All</option>
								@foreach($schools as $id => $type)
									<option value="{{$type}}" data-id="{{$id}}">{{$type}}</option>
								@endforeach
						</select>
					</th>
					<th class="align-top">
						Course
						<select name="course" id="school_course" class="custom-select">
										<option value="" selected="">All</option>
						</select>
					</th>
					<th class="align-top">
						Class
						<select name="class" id="class" class="custom-select">
								<option value="" selected="">All</option>                        
						</select>
					</th>
					<th class="align-top">
						Subject
						<select name="subject" id="subject" class="custom-select">
									<option value="" selected="">All</option>                        
						</select>
					</th>
                    <th class="align-top">Status</th>
                    <th class="align-top">Action</th>
                </tr>
            <tbody>
                @php $i=0; @endphp
                @foreach($topics as $topic)
				@php 
					$class_details = $topic->class_details($topic->subject->class_id);
					$course_details = $topic->course_details($class_details->course_id);
				@endphp
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{$topic->topic_name}}</td>
					<td>{{$topic->school_details($course_details->school_id)}}</td>
					<td>{{$course_details->name}}</td>
					<td>{{$class_details->class_name}}</td>
					<td>{{$topic->subject->subject_name}}</td>
                    <td>{{$topic->status ? 'Active':'Disabled'}}</td>
                    <td>
                        <a href ="{{route('backend.topics.edit', $topic->id)}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Edit"><i class="ion ion-md-create"></i></a>
                        
						<form method="POST" action="{{route('backend.topics.destroy', $topic->id)}}" style="display: inline-block;">
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