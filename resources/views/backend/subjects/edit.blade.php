@extends('backend.layouts.layout-2')

@section('content')
<h4 class="font-weight-bold py-3 mb-4">
    <span class="text-muted font-weight-light">Subjects /</span> Edit Subject
</h4>
<div class="card mb-4">
    <h6 class="card-header">
        Edit Subject
    </h6>
    <div class="card-body">
        @includeif('backend.message')
        <form action="{{route('backend.subjects.update', $subject->id)}}" method = "POST">
            @csrf
            @method('PUT')
			<div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Institute Type</label>
                        <div class="col-sm-10">
                            <select name="institute_type" id="institute_type" class="custom-select" disabled required>
                                <option value="" selected="" disabled="" class="d-none">Select Institute Type</option>
                                @foreach($institutes as $id => $type)
                                <option value="{{$id}}" @if($id == $subject->category_id ) selected @endif>{{$type}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">School</label>
                        <div class="col-sm-10">
                            <select name="school" id="school" class="custom-select" disabled required>
                                <option value="" disabled selected="">Select School</option>
								@foreach($schools as $id => $val)
                                <option value="{{$id}}" @if($id == $subject->school_id ) selected @endif>{{$val}}</option>
                                @endforeach								
                            </select>
                        </div>
                    </div>
					<div class="form-group row" id="department-field" @if($subject->category_id != config("constants.UNIVERSITY")) style="display:none;" @endif>
						<label class="col-form-label col-sm-2 text-sm-right">Department</label>
						<div class="col-sm-10">
							
							<select name="department" id="department" class="custom-select" disabled>
								<option value="">Select Department</option>
								@foreach($departments as $id => $type)
									<option value="{{$id}}" @if($subject->department_id == $id) selected @endif>{{$type}}</option>
								@endforeach
							</select>
							<input type="hidden" name="department" value="{{$subject->department_id}}">
						</div>
					</div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Course</label>
                        <div class="col-sm-10">
                            <select name="course" id="school_course" class="custom-select" disabled required>
                                <option value="" disabled selected="">Select Course</option>
								@foreach($courses as $id => $val)
                                <option value="{{$id}}" @if($id == $subject->course_id ) selected @endif>{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Class</label>
                        <div class="col-sm-10">
                            <select name="class" id="class" class="custom-select" disabled required>
                                <option value="" disabled selected="">Select Class</option>
								@foreach($classes as $id => $val)
                                <option value="{{$id}}" @if($id == $subject->class_id ) selected @endif>{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            
			<div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-right">Subject Name</label>
                <div class="col-sm-10">
                    <input type="text" name="subject_name" placeholder="Subject Name" class="form-control" value="{{$subject->subject_name}}" required>
                </div>
            </div>
			
            <div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-right"></label>
                <div class="col-sm-10">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" name="status" value="1" class="custom-control-input" @if($subject->status) checked @endif>
                               <span class="custom-control-label">Active</span>
                    </label>
                </div>
            </div>


            <div class="form-group row">
                <div class="col-sm-10 ml-sm-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection