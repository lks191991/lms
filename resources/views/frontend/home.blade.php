@extends('frontend.layouts.app')

@section('content')
<section class="content-top-wrapper bg-white">
    <div class="container">
        <div class="join-class-wrapper text-white">
            <div class="row pt-0 pb-0 pt-md-4 pb-md-5">
                <div class="col-md-8 col-xl-6 pb-0 pb-md-3">                    
                    <h1 class="heading text-white">Join a Class</h1>
                    <p class="heading-sub-text">remotely from anywhere on the planet, Stream, pause & repeat any teaching session till you understand</p>
                </div>                
            </div>
            <!--            <div class="graphic-card">Insert illustration here...</div>-->

            @php
            $joinButton  = "submit";
            $is_home = true;
            @endphp

            @include('frontend.includes.home_search_form')            
        </div>	
    </div>
</section>


<section class="school-carousel-wrapper bg-white">    		
    <div class="container">
        <h2 class="sub-heading">Schools streaming online now</h2>
        <div class="school-carousel owl-carousel owl-theme">

            @if(!empty($schools[0]))
            @foreach($schools as $school)
            <div class="item">	
                <div class="school-card btn-group" >
                    @php 
                    $coursesHasVideo = $school->coursesHasVideo;
                    @endphp
                    <a href="javascript:void(0)" title="" class="school-card-link @if($coursesHasVideo->count() > 0) openChangeClassModal @endif" onclick="JoinAClass2.openModel({{$school->school_category}},{{$school->id}})" data-cat="{{$school->school_category}}" data-school="{{$school->id}}">
                        @if($school->is_locked)
                        <div class="school-lock">
                            <img src="/images/lock-icon.png" alt="lock">
                        </div>
                        @endif
                        <figure class="school-logo">
                            <img src="{{asset('/uploads/schools/'.$school->logo)}}" class="img-fluid" height="73" alt="{{ $school->school_name }}">
                        </figure>

                        <h3 class="school-name">{{ $school->school_name }}</h3>
                        @if($school->school_category == config('constants.BASIC_SCHOOL'))
                        @php
                        $course = $coursesHasVideo[0];
                        @endphp
                        <p class="school-course-qty">{{$school->coursesLabel($course->classesHasVideosWithKey->count())}} </p>
                       @else 
                        <p class="school-course-qty">{{$school->coursesLabel($coursesHasVideo->count())}}</p>
                       @endif
                        
                    </a>
                </div>
            </div> 
            @endforeach
            @endif       
        </div>		
    </div>		
</section>


<section class="any-device">
    <div class="container">
        <div class="row">            
            <div class="col-md-7 offset-md-5 text-center text-md-right">
                <div class="device-info">
                    <div class="pb-0 pb-md-5" >
                        <h2 class="heading text-center text-md-right">Join from any device</h2>
                        <p class="heading-sub-text text-center text-md-right">PC, smartphone, tablet, iPhone etc.</p>
                    </div>
                    <div class="pt-2 pt-md-4">
                        <a href="{{route('frontend.pages.how_to_access')}}" class="btn-gray-outline">LEARN HOW</a>
                    </div>	
                </div>	
            </div>
        </div>
    </div>	
</section>
@guest
<section class="login-wrapper">    
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="login-card">                        
                    <div class="sub-heading pb-4"><strong>Login </strong>to enable you ask questions, & connect with classmates</div>
                    <form action="{{ route('login') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" value="{{ old('username') }}" placeholder="{{ __('Username') }}">
                            @if ($errors->has('username'))
                            <div class="invalid-feedback">
                                {{ $errors->first('username') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('Password') }}">
                            @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                            @endif
                        </div> 
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary w-100">LOGIN</button>
                        </div>
                        <div class="form-group info-text">or register if you dont have an account</div>
                        <div class="form-group mb-0">
                            <a href="{{ route('register') }}" class="btn btn-secondary w-100" title="Register">REGISTER</a>
                        </div>
                    </form> 
                </div>
            </div>                
        </div>	
    </div>    
</section>
@endguest
<section class="contact-banner bg-white">
    <div class="container">
        <div class="contact-banner-box">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <aside>
                        <h3>Get your school online</h3>
                        <p>Contact us to get your school online at no cost</p>
                    </aside>
                </div>
                <div class="col-lg-5 offset-lg-2 mt-3 mt-lg-0">
                    <a href="{{route('frontend.pages.contact')}}" class="btn-white-outline w-100">CONTACT US</a>                    
                </div>
            </div>
        </div>
    </div>	
</section>	

<script>
//    $(".btn-group, .dropdown").hover(
//        function () {
//            $('>.dropdown-menu', this).stop(true, true).fadeIn("fast");
//            $(this).addClass('open');
//        },
//        function () {
//            $('>.dropdown-menu', this).stop(true, true).fadeOut("fast");
//            $(this).removeClass('open');
//    });
            
    
</script>

@endsection

@section('footer-scripts')
<script>
    /* $(document).ready(function(){        
        $('.openChangeClassModal').on('click', function(){
            var cat_id = $(this).data('cat');
            var school_id = $(this).data('school');
            $('#institution_id2').val(cat_id);
            JoinAClass2.schoolList(true, 'institution', school_id);
            
            $("#myModal").modal();
        });       
    }); */
</script>
@endsection