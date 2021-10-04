@extends('backend.layouts.layout-2')

@section('content')
<!-- Header -->
    <div class="container-m-nx container-m-ny bg-white mb-4">
		<div class="row">
			<div class="col-md-10">
        <div class="media col-md-10 col-lg-8 col-xl-7 py-5 mx-auto">
		@if(!empty($student->getProfileOrAvatarImageAttribute()))
                <img class="school_logo mb-2 d-block rounded-circle" src="{{url($student->getProfileOrAvatarImageAttribute())}}" width="120" height="120"  />
        @endif
		   <div class="media-body ml-5">
                <h4 class="font-weight-bold mb-4">{{$student->getFullNameAttribute()}}</h4>
                <div class="text-muted mb-2">
                    <strong>School Name:</strong> <a href="{{route('backend.school.show',$student->school_id)}}" class="text-body">{{$student->school->school_name}}</a>
                </div>
            </div>
        </div>
		</div>
			 <div class="col-md-2 ml-10 mt-5"><a href="javascript:void(0)" onclick="window.history.go(-1); return false;" class="btn btn-primary rounded-pill d-block detail-back-btn">Back</a></div>
			 </div>
        <hr class="m-0">
    </div>
    <!-- Header -->
<!--<h4 class="font-weight-bold py-3 mb-4">
    <span class="text-muted font-weight-light">Students /</span> Assigned Classes
</h4>-->

@if(!$courses->isEmpty())
	
	 @includeif('backend.message')
		
		<form action="{{route('backend.students.saveassignedclasses')}}" method="post">
		@csrf
		<div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header">Assign Classes To Student</div>
                <hr class="border-light m-0">
                <div class="card-body"> 
		<input type="hidden" name="school" value="{{$student->school_id}}">
		<input type="hidden" name="user" value="{{$student->user_id}}">
		@php $classes_exists = 0; @endphp
		@foreach($courses as $course)
				@if(!$course->classes->isEmpty())
				@php $classes_exists++; @endphp
						<div class="m-2"><strong>{{$course->name}}</strong></div>
						
					<div class="form-group period_field_group">
                        
                        <div class="row">
						
						@foreach($course->classes as $class)
						<div class="col-4">
							<label class="custom-control custom-checkbox">
							<input type="checkbox" name="class_id[]" value="{{$class->id}}" @if(in_array($class->id, $studentclasses)) checked @endif class="custom-control-input">
							<span class="custom-control-label">{{ $class->class_name}}</span>
							</label>
							</div>
						@endforeach
						
						
						</div>
                    </div>	
						
						
			
			
			@endif
			@endforeach
			
			@if($classes_exists > 0)
			<div class="col-md-12" style="text-align:center">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
			@else
				<p class="col-md-12" style="text-align:center;color:red;">You should have active courses and classes into the school.</p>
			@endif
			</div></div></div>
			</div>
		</form>
	
	 
</div>
@endif		
@endsection