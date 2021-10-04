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
                        <h4 class="font-weight-bold mb-4">{{$class->class_name}}</h4>
                        <div class="row mb-2">
                            <div class="col-md-3 text-muted">School Name:</div>
                            <div class="col-md-9">
                                <a href="{{route('backend.school.show',$course->school->id)}}" class="text-body">{{$course->school->school_name}}</a>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-3 text-muted">Course Name:</div>
                            <div class="col-md-9">
                                <a href="{{route('backend.course.show', $class->course_id)}}" class="text-body">{{$class->course->name}}</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-2 ml-10 mt-5">
                <a href="javascript:void(0)" onclick="window.history.go(-1);
                                return false;" class="btn btn-primary rounded-pill d-block detail-back-btn">Back</a>
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

                    <div class="col-md-9"><strong>Periods</strong></div>
                    <div class="col-md-3"><a href="#" class="btn btn-primary rounded-pill d-block" data-toggle="modal" data-target="#createPeriod"><span class="ion ion-md-add"></span>&nbsp;Create Period</a></div>


                </div>

                <div class="card-body">
                    <div class="card-datatable table-responsive">
                        <table id="period-list" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Period Title</th>
                                    <th>Class</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp
                                @if(!$class->periods->isEmpty())
                                @foreach($class->periods as $period)
                                <tr>
                                    <td><i class="ion ion-md-move"></i>
                                        <input type="hidden" class="weight" name="weight[{{$period->id}}]" value="{{$period->weight}}"/>
                                    </td>
                                    <td>{{$period->title}}</td>
                                    <td>@if(isset($period->period_class->class_name) && !empty(($period->period_class->class_name))){{$period->period_class->class_name}}@endif</td>
                                    <td>{{$period->status ? 'Active':'Disabled'}}</td>
                                    <td>
                                        <a href ="#" data-attr-id="{{$period->id}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip edit-period-link" title="Edit"><i class="ion ion-md-create"></i></a>
                                        @role('admin')
                                        <form method="POST" action="{{route('backend.periods.destroy', $period->id)}}" style="display: inline-block;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" name="class" value="{{$class->id}}">
                                            <input type="hidden" name="ajax_request" value="1">
                                            <button type="submit" onclick="return confirm('You are about to delete this record?')" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Remove"><i class="ion ion-md-close"></i></button>

                                        </form>
                                        @endrole
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5"><p class="text-center">No Record Found!</p></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>


    </div>

    <div class="row mt-4">
        <div class="col">
            <div class="card mb-8">
                <div class="card-header row ml-0 mr-0">

                    <div class="col-md-9"><strong>Subjects</strong></div>
                    <div class="col-md-3"><a href="#" class="btn btn-primary rounded-pill d-block" data-toggle="modal" data-target="#createSubject"><span class="ion ion-md-add"></span>&nbsp;Create Subject</a></div>

                </div>

                <div class="card-body">
                    <div class="card-datatable table-responsive">
                        <table id="subject-list1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Subject Name</th>
                                    <th>Class Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            <tbody>
                                @php $i=0; @endphp
                                @if(!$class->subject->isEmpty())
                                @foreach($class->subject as $subject)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{$subject->subject_name}}</td>
                                    <td>{{$subject->subject_class->class_name}}</td>
                                    <td>{{$subject->status ? 'Active':'Disabled'}}</td>
                                    <td>
                                        <a href ="javascript:void(0)" data-attr-id="{{$subject->id}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip edit-subject-link" title="Edit"><i class="ion ion-md-create"></i></a>
                                        @role('admin')
                                        <form method="POST" action="{{route('backend.subjects.destroy', $subject->id)}}" style="display: inline-block;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" name="class" value="{{$class->id}}">
                                            <input type="hidden" name="ajax_request" value="1">
                                            <button type="submit" onclick="return confirm('You are about to delete this record?')" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Remove"><i class="ion ion-md-close"></i></button>

                                        </form>
                                        @endrole
                                        <a href ="{{route('backend.subjects.show', $subject->id)}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="View subject details"><i class="ion ion-md-eye"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5"><p class="text-center">No Record Found!</p></td>
                                </tr>
                                @endif
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
<div class="modal" id="createPeriod">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create Period</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('backend.periods.store')}}" method = "post">
                    @csrf

                    <input type="hidden" name="class" value="{{$class->id}}">
                    <input type="hidden" name="ajax_request" value="1">

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Period Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" placeholder="Period Title" class="form-control" required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right"></label>
                        <div class="col-sm-10">
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

<!-- edit period modal -->
<div class="modal" id="editPeriod">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Period</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body edit_period">

            </div>

        </div>
    </div>
</div>


<!-- create subject modal -->
<div class="modal" id="createSubject">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create Subject</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('backend.subjects.store')}}" method = "post">
                    @csrf

                    <input type="hidden" name="class" value="{{$class->id}}">
                    <input type="hidden" name="ajax_request" value="1">

                    <div class="form-group row">
                        <label class="col-form-label col-sm-3 text-sm-right">Subject Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="subject_name" placeholder="Subject Name" class="form-control" required>
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

<!-- edit subject modal -->
<div class="modal" id="editSubject">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Subject</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body edit_subject">

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
	
    //$( "#categoryTable tbody" ).sortable();
    var fixHelperModified = function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
        },
        updateIndex = function(e, ui) {
            $('.weight', ui.item.parent()).each(function (i) {
                    $(this).val(i + 1);
            });

            //Update ordering of categories into the database.
            var url = "{{route('backend.periods.ordering.save')}}";

            // This step is only needed if you are using Laravel
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

            $.ajax({
                type: 'POST',
                url: url,
                data: $('.weight').serialize(),
                success: function(data) {

                },
                error: function(error) {
                    console.log(error);
                }
            });

        };

        $("#period-list tbody").sortable({
                helper: fixHelperModified,
                stop: updateIndex,
                cursor: 'move',
                opacity: 0.6,
        }).disableSelection();
        
     $(".edit-period-link").on("click", function () {
            var period_id = $(this).attr("data-attr-id");
                        $(".edit_period").html("Loading...");
                        $("#editPeriod").modal();
            if(period_id) {                
                $.ajax({
                    type: "POST",
                    url: '{{ route("backend.periods.edit_ajax") }}',
                    data: {'period_id' : period_id, '_token': '{{ csrf_token() }}'},
                    success: function (data) {
                        $(".edit_period").html(data);
                                                return true;
                    }
                });
            }
        });
		
                $(".edit-subject-link").on("click", function () {
            var subject_id = $(this).attr("data-attr-id");
                        $(".edit_subject").html("Loading...");
                        $("#editSubject").modal();
            if(subject_id) {                
                $.ajax({
                    type: "POST",
                    url: '{{ route("backend.subjects.edit_ajax") }}',
                    data: {'subject_id' : subject_id, '_token': '{{ csrf_token() }}'},
                    success: function (data) {
                        $(".edit_subject").html(data);
                                                return true;
                    }
                });
            }
        });

 
 });
 
 $(function () {
        $('#subject-list').dataTable({
            "order": [[ 1, "asc" ]],
            "drag":true,
            "columns": [
              null,
              null,
              null,
              null,
              { "orderable": false }
            ]
          });
    });
</script>
@stop