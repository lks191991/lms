<form action="{{route('backend.course.update', $course->id)}}" method = "POST">
            @csrf
            
			<input type="hidden" name="department" value="{{$course->department_id}}">
			<input type="hidden" name="school_name" value="{{$course->school_id}}">
			@if(isset($department_ajax_request) && !empty($department_ajax_request))
			<input type="hidden" name="department_ajax_request" value="1">
			@else
			<input type="hidden" name="ajax_request" value="1">
			@endif
			
			<div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right">Course Name</label>
                <div class="col-sm-9">
                    <input type="text" name="name" placeholder="Course Name" class="form-control" value="{{$course->name}}" required>
                </div>
            </div>
			
			<div class="form-group row">
                    <label class="col-form-label col-sm-3 text-sm-right">Course Description</label>
                    <div class="col-sm-9">
                        <textarea name="description" class="form-control" placeholder="Course Description">{{$course->description}}</textarea>
                    </div>
                </div>
           
            <div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right"></label>
                <div class="col-sm-9">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" name="status" value="1" class="custom-control-input" @if($course->status) checked @endif>
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