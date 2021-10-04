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
                        <h4 class="font-weight-bold mb-4">{{$subject->subject_name}}</h4>
                        <div class="row mb-2">
                            <div class="col-md-3 text-muted">School Name:</div>
                            <div class="col-md-9">
                                <a href="{{route('backend.school.show',$course->school->id)}}" class="text-body">{{$course->school->school_name}}</a>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-3 text-muted">Class Name:</div>
                            <div class="col-md-9">
                                <a href="{{route('backend.classes.show', $class->id)}}" class="text-body">{{$class->class_name}}</a>
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

                    <div class="col-md-9"><strong>Topics</strong></div>
                    <div class="col-md-3"><a href="#" class="btn btn-primary rounded-pill d-block" data-toggle="modal" data-target="#createTopic"><span class="ion ion-md-add"></span>&nbsp;Create Topic</a></div>


                </div>

                <div class="card-body">
                    <div class="card-datatable table-responsive">
                        <table id="topic-list" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Topic Name</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            <tbody>
                                @php $i=0; @endphp
                                @if(!$subject->topics->isEmpty())
                                @foreach($subject->topics as $topic)
                                <tr>
                                    <td><i class="ion ion-md-move"></i>
                                        <input type="hidden" class="weight" name="weight[{{$topic->id}}]" value="{{$topic->weight}}"/>
                                    </td>
                                    <td>{{$topic->topic_name}}</td>
                                    <td>@if(isset($topic->subject->subject_name) && !empty(($topic->subject->subject_name))){{$topic->subject->subject_name}}@endif</td>
                                    <td>{{$topic->status ? 'Active':'Disabled'}}</td>
                                    <td>
                                        <a href ="javascript:void(0)" data-attr-id="{{$topic->id}}" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip edit-topic-link" title="Edit"><i class="ion ion-md-create"></i></a>
                                        @role('admin')
                                        <form method="POST" action="{{route('backend.topics.destroy', $topic->id)}}" style="display: inline-block;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" name="subject" value="{{$subject->id}}">
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
<div class="modal" id="createTopic">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create Topic</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('backend.topics.store')}}" method = "post">
                    @csrf

                    <input type="hidden" name="subject" value="{{$subject->id}}">
                    <input type="hidden" name="ajax_request" value="1">

                    <div class="form-group row">
                        <label class="col-form-label col-sm-3 text-sm-right">Topic Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="topic_name" placeholder="Topic Name" class="form-control" required>
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

<!-- edit period modal -->
<div class="modal" id="editTopic">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Topic</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body edit_topic">

            </div>

        </div>
    </div>
</div>
<!-- / Content -->
@endsection

@section('scripts')
<script>
    $(document).ready(function () {

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
            var url = "{{route('backend.topics.ordering.save')}}";

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

        $("#topic-list tbody").sortable({
                helper: fixHelperModified,
                stop: updateIndex,
                cursor: 'move',
                opacity: 0.6,
        }).disableSelection();

        $(".edit-topic-link").on("click", function () {
            var topic_id = $(this).attr("data-attr-id");
            $(".edit_topic").html("Loading...");
            $("#editTopic").modal();
            if (topic_id) {
                $.ajax({
                    type: "POST",
                    url: '{{ route("backend.topics.edit_ajax") }}',
                    data: {'topic_id': topic_id, '_token': '{{ csrf_token() }}'},
                    success: function (data) {
                        $(".edit_topic").html(data);
                        return true;
                    }
                });
            }
        });

    });
    /*
    $(function () {
        $('#topic-list').dataTable(
                {
                    "columns": [
                        {"orderable": false},
                        null,
                        {"orderable": false},
                        null,
                        {"orderable": false}
                    ]
                }
        );
    });
    */
</script>
@stop