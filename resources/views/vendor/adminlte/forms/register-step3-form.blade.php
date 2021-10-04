<form action="{{ route('registerStep3') }}" method="post" id="registerForm">
	{{ csrf_field() }}
	
	<div class="form-group mb-3">
		<select name="country" class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" data-validation="required">
			<option value="">Country</option>
			@if(isset($countries) && !empty($countries))
				@foreach($countries as $country)
					<option value="{{ $country->id }}" {{ ($country->id == old('country')) ? 'selected="selected"' : '' }}>{{ $country->name }}</option>
				@endforeach
			@endif
		</select>
		
		@if ($errors->has('country'))
			<div class="invalid-feedback" style="display:block">
				<strong>{!! $errors->first('country') !!}</strong>
			</div>
		@endif
	</div>
	
	<div class="form-group mb-3">
		<select name="school_cat" class="form-control {{ $errors->has('school_cat') ? 'is-invalid' : '' }}" data-validation="required">
			<option value="">School category</option>
			@if(isset($schoolCat) && !empty($schoolCat))
				@foreach($schoolCat as $cat)
					<option value="{{ $cat->id }}" {{ ($cat->id == old('school_cat')) ? 'selected="selected"' : '' }}>{{ $cat->name }}</option>
				@endforeach
			@endif
		</select>
		
		@if ($errors->has('school_cat'))
			<div class="invalid-feedback" style="display:block">
				<strong>{!! $errors->first('school_cat') !!}</strong>
			</div>
		@else
			<span class="small text-primary">{{ "Basic, Junior Hight, Senior High, Tertiary, etc" }}</span>
		@endif
	</div>
	
	<div class="form-group mb-3">
		<select name="class_level" class="form-control {{ $errors->has('class_level') ? 'is-invalid' : '' }}" data-validation="required">
			<option value="">Class / Level</option>
			@if(!empty(config('constants.class_level')))
				@foreach(config('constants.class_level') as $key => $level)
					<option value="{{ $key }}" {{ ($key == old('class_level')) ? 'selected="selected"' : '' }}>{{ $level }}</option>
				@endforeach
			@endif
		</select>
		
		@if ($errors->has('class_level'))
			<div class="invalid-feedback" style="display:block">
				<strong>{!! $errors->first('class_level') !!}</strong>
			</div>
		@endif
	</div>
	
	<div class="form-group mb-3">
		<input name="school_name" class="form-control {{ $errors->has('school_name') ? 'is-invalid' : '' }}" value="{{old('school_name')}}" placeholder="School Name" data-validation="required length" data-validation-length="max255" />
		
		@if ($errors->has('school_name'))
			<div class="invalid-feedback" style="display:block">
				<strong>{!! $errors->first('school_name') !!}</strong>
			</div>
		@endif
	</div>
	
	<button type="submit" class="btn btn-primary btn-block">{{ __('Submit') }}</button>
</form>
<p class="mt-2 mb-1 text-center">
	or<br/>
	<a href="{{ route('registerStep', 4) }}">Skip</a>
</p>