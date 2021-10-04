<form action="{{route('backend.classes.update', $class->id)}}" method = "POST">
            @csrf
            @method('PUT')
			<input type="hidden" name="course" value="{{$class->course_id}}">
			<input type="hidden" name="ajax_request" value="1">
			<div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right">Class Name</label>
                <div class="col-sm-9">
                    <input type="text" name="class_name" placeholder="Class Name" class="form-control" value="{{$class->class_name}}" required>
                </div>
            </div>
           
            <div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right"></label>
                <div class="col-sm-9">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" name="status" value="1" class="custom-control-input" @if($class->status) checked @endif>
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