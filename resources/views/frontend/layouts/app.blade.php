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

        <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">



        <!-- Developer Styles Css -->
        <link href="{{ asset('css/developer.css') }}" rel="stylesheet">
        <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
        
        @yield('after-styles')
        @yield('header-styles')
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        @if(Session::has('jsError'))

       
        @endif

        @if(Session::has('jsSuccess'))

        <script>
        
        @endif

    </head>
    <body class="register-banner">
        <div id="app" >
            
            @yield('content')


        </div>

        <!-- Loader div -->
        <div id="cover-spin"> 
            <div>	
                <div class="spinner-grow spinner-grow-lg"></div>
                <b>Please wait.....</b>
            </div>
        </div>


        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>


        @yield('scripts')
        @yield('footer-scripts')
    </body>
</html>
