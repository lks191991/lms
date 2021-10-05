<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">		
		@yield('metaData')
        <title>
            @if(View::hasSection('title'))@yield('title') - @endif{{ config('app.name', 'Laravel')}}
        </title>
        @yield('before-styles')
        <!-- Scripts -->
        <!--<script src="{{ asset('js/app.js') }}" defer></script>-->

        <!-- Fonts -->
        <link href="//fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">



        <!-- Developer Styles Css -->
        <link href="{{ asset('css/developer.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="{{ asset('js/axios.min.js') }}"></script>	
		<script src="{{ asset('js/common_new.js') }}"></script>	
        
        @yield('after-styles')
        @yield('header-styles')
        <link href="{{ asset('css/pace.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
		<script>tinymce.init({ selector:'.textarea-editor' });</script>
        @if(Session::has('jsError'))

        <script>
        $(function () {
            toastr['error']('{{ Session::get("jsError") }}')
            toastr.options = {
                "closeButton": true,
                "debug": true,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "showDuration": "200",
                "hideDuration": "2000",
                "timeOut": "6000",
                "extendedTimeOut": "2000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        });
        </script>
        @endif

        @if(Session::has('jsSuccess'))

        <script>
            $(function () {
                toastr['success']('{{ Session::get("jsSuccess") }}')
                toastr.options = {
                    "closeButton": true,
                    "debug": true,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "showDuration": "200",
                    "hideDuration": "2000",
                    "timeOut": "6000",
                    "extendedTimeOut": "2000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            });
        </script>
        @endif

    </head>
    <body>
        <div id="app">
            <header class="header sticky-top">
                <div class="container">
                    <div class="row align-items-center">		
                        <!--<div class="col-6 col-lg-3">
                            <div class="logo">
                                <a href="{{ URL::to('/') }}">
                                    <img src="{{asset('images/logo.png')}}" alt="{{ config('app.name', 'Laravel') }}">
                                </a>
                            </div>
                        </div>	-->

                        <div class="col-6 col-lg-9">
                            <div class="mobile-toggle-btn"> <span></span> </div>
                            <nav class="header-nav">
                                <ul class="main-menu">  
									@if(Request::segment(1) != 'classroom' && !empty(GLB::continueVideo()))
                                     <li>
										<a href="{{GLB::continueVideo()}}" class="btn-custom nav-link" title="Continue">Continue </a>
									</li>
									@endif
                                    @if(Request::segment(1) == 'classroom' && !empty($defaultVideo->school->school_category) && !empty($defaultVideo->school_id))
                                    <li>
                                        <a href="javascript:void(0)" title="" onclick="JoinAClass2.openModel({{$defaultVideo->school->school_category}},{{$defaultVideo->school_id}})" class="btn-custom nav-link" >Change Class </a>
                                    </li>
									@else
									 @if(!Request::is('/') && !Request::is('home'))
                                     <!--- <li>
                                        <a href="javascript:void(0)" title="" class="btn-custom nav-link" data-toggle="modal" data-target="#myModal">Change Class</a>
                                     </li> --->
                                     @endif	
                                    @endif
                                    <!--<li class="header-search pl-0 pl-lg-3">
                                        <form action="{{route('frontend.search')}}" method="get" class="search-form">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" name="search_input" class="form-control" value="{{Request::input('search_input')}}" required="">
                                                <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
                                            </div>	
                                        </form>
                                    </li>-->

                                    <!-- Authentication Links -->
                                    @guest
                                    <li>
                                       <!-- <a href="javascript:void(0)" title="" class="btn-custom "  onclick="loginObj.openPopup()" >
                                            <span class="icon">
                                                <i class="fas fa-user"></i>
                                            </span>
                                            {{ __('Login') }}
                                        </a>-->
                                        @include('frontend.includes.login_popup')
                                    </li>
                                    @else
                                    <li class="nav-item  dropdown ">

                                        <a id="navbarDropdown" class="btn-custom   dropdown-toggle" href="javascript:void(0)" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                            <img src='{{asset(Auth::user()->userData->profile_or_avatar_image)}}' class="rounded-circle" id="profileImageRun" width="24" height="24">
                                            <span class="mx-2">{{ ucwords(Auth::user()->username) }}</span> <span class="caret"></span>
                                        </a>

                                        <div class="dropdown-menu after-login-dropdown dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            @if(Auth::user()->hasRole(['student','tutor']))
                                            <a class="dropdown-item" href="{{ route('frontend.profile') }}">
                                                {{ __('Profile') }}
                                            </a>
                                            @endif
                                            @if(Auth::user()->hasRole(['admin','subadmin','school']))
                                            <a class="dropdown-item" href="{{ route('backend.dashboard') }}">
                                                {{ __('Dashboard') }}
                                            </a>
                                            @endif
											
											@if(SiteHelpers::emailVerified() == 1)
											  <a href="avascript:void(0)" class="dropdown-item firstSendOtp" data-toggle="modal" data-target="#activeModel">Activate Account </a>
											@endif
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                    @endguest

                                </ul>
                            </nav>
                        </div>
                    </div>		


                </div>	
            </header>

            @yield('content')

            <!--<footer class="footer">
                <div class="container">
                    <ul class="footer-menu">
                        @guest
                        <li><a href="{{ route('register') }}" title="Register">Register</a></li>
                        @endguest
                        <li class="d-none"><a href="{{route('frontend.knowledge.articles.index')}}" title="Articles">Articles</a></li>
                        <li class="d-none"><a href="{{route('front')}}" title="About Xc">About Xc</a></li>
                        <li ><a href="{{route('frontend.pages.how_to_access')}}" title="Connect">Connect</a></li>
                        <li ><a href="{{route('frontend.pages.help')}}" title="Help">Help</a></li>
                        <li ><a href="{{route('frontend.pages.contact')}}" title="Contact">Contact</a></li>																
                    </ul>
                    <hr>
                    <h6 class="footer-copyright"><strong>Xtra</strong>Class (c) 2020 All rights reserved     <a href="{{route('frontend.pages.terms_condition')}}" class="d-none">Terms & conditions</a></h6>
                </div>
            </footer>-->

        </div>

        <!-- Loader div -->
        <div id="cover-spin"> 
            <div>	
                <div class="spinner-grow spinner-grow-lg"></div>
                <b>Please wait.....</b>
            </div>
        </div>


        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>		

        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <!-- Jquery validations-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
        <script src="{{ asset('js/custom.js') }}"></script>	
        <script src="{{ asset('js/pace.min.js') }}"></script>	

        @include('frontend.includes.change_class')
		@if(Auth::check())
			@include('frontend.includes.active_account')
		@endif

        @yield('scripts')
        @yield('footer-scripts')
    </body>
</html>
