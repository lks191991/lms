<form action="{{ route('registerStep4') }}" method="post" id="registerForm4" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="register-card-body">
        <div class="register-avatar">
            <input type="hidden" name="avatarImage" value="" />
            <div class="profile-carousel owl-carousel owl-theme">

                @foreach ($avataricons->chunk(12) as $chunk)
                <div class="item">	
                    <ul class="register-avatar-list">
                        @foreach ($chunk as $avataricon)
                        @if(!empty($avataricon->icon) && file_exists($avataricon->icon))

                        <li>
                            <a href="javascript:void(0)" class="profile_img" title="">
                                <img data-path="{{$avataricon->icon}}" data-id="{{$avataricon->id}}" src="{{asset($avataricon->icon)}}" alt="{{$avataricon->avatar_name}}" title = "{{$avataricon->avatar_name}}">
                            </a>
                        </li>
                        @endif
                        @endforeach
                    </ul>	
                </div>
                @endforeach





            </div>

        </div>
    </div>
    <hr class="mt-4">
    <div class="register-card-footer">
        <div class="input-group ">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="user_image" name="user_image">
                <label class="custom-file-label" for="user_image">Upload Photo...</label>
            </div>
        </div>
        @if ($errors->has('user_image'))
        <div class="invalid-feedback">{!! $errors->first('user_image') !!}</div>
        @else
        <small class="form-text mb-4">
            .jpg .png .bmp  |  Size max >= 2mb |  @ 212px by 150px<br>
            <a href="#">photo uploading terms & conditions</a>					
        </small>			
        @endif
        <button type="submit" class="btn btn-primary w-100">{{ __('SUBMIT') }}</button>
    </div>
    <ul class="register-card-step">
        <li class="complete"><span class="count">1</span></li>
        <li class="complete"><span class="count">2</span></li>
        <li class="active"><span class="count">3</span></li>
    </ul>
<!--    <div class="register-card-skip">
        <a href="{{ route('frontend.profile') }}" title="" class="btn-link">Skip</a>
    </div>-->
</form>