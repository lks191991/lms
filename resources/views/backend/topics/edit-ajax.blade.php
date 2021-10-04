<form action="{{route('backend.topics.update', $topic->id)}}" method = "POST">
            @csrf
            @method('PUT')
			<input type="hidden" name="subject" value="{{$topic->subject_id}}">
			<input type="hidden" name="ajax_request" value="1">
			<div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right">Topic Name</label>
                <div class="col-sm-9">
                    <input type="text" name="topic_name" placeholder="Topic Name" class="form-control" value="{{$topic->topic_name}}" required>
                </div>
            </div>
           
            <div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right"></label>
                <div class="col-sm-9">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" name="status" value="1" class="custom-control-input" @if($topic->status) checked @endif>
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