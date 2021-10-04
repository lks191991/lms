<form action="{{ route('registerStep4') }}" method="post" id="registerForm4" enctype="multipart/form-data">
	{{ csrf_field() }}
	
	
	<div class="form-group mb-3">
		<input type="hidden" name="avatarImage"/>
		<div class="frofile_img">
			<img class="" data-path="images/avatar/avatar_01.png" src="{{asset('images/avatar/avatar_01.png')}}" alt="" />
		</div>
		<div class="frofile_img">
			<img class="" data-path="images/avatar/avatar_02.png" src="{{asset('images/avatar/avatar_02.png')}}" alt="" />
		</div>
		<div class="frofile_img">
			<img class="" data-path="images/avatar/avatar_03.png" src="{{asset('images/avatar/avatar_03.png')}}" alt="" />
		</div>
		<div class="frofile_img">
			<img class="" data-path="images/avatar/avatar_04.png" src="{{asset('images/avatar/avatar_04.png')}}" alt="" />
		</div>
		<div class="frofile_img">
			<img class="" data-path="images/avatar/avatar_05.png" src="{{asset('images/avatar/avatar_05.png')}}" alt="" />
		</div>
		<div class="frofile_img">
			<img class="" data-path="images/avatar/avatar_06.png" src="{{asset('images/avatar/avatar_06.png')}}" alt="" />
		</div>
		<div class="frofile_img">
			<img class="" data-path="images/avatar/avatar_07.png" src="{{asset('images/avatar/avatar_07.png')}}" alt="" />
		</div>
		<div class="frofile_img">
			<img class="" data-path="images/avatar/avatar_08.png" src="{{asset('images/avatar/avatar_08.png')}}" alt="" />
		</div>
	</div>
	
	<div class="form-group mb-3">
		<div class="custom-file mt-5">
			<input type="file" class="custom-file-input" id="user_image" name="user_image">
			<label class="custom-file-label" for="user_image">Choose file</label>
		</div>
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