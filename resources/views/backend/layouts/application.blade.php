<!DOCTYPE html>

<html lang="en" class="default-style">
    <head>
        <title>Bright-Horizon</title>

        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
        <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">

        <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">

        <!-- Icon fonts -->
        <link rel="stylesheet" href="{{ mix('/assets/vendor/fonts/fontawesome.css') }}">
        <link rel="stylesheet" href="{{ mix('/assets/vendor/fonts/ionicons.css') }}">
        <link rel="stylesheet" href="{{ mix('/assets/vendor/fonts/linearicons.css') }}">
        <link rel="stylesheet" href="{{ mix('/assets/vendor/fonts/open-iconic.css') }}">
        <link rel="stylesheet" href="{{ mix('/assets/vendor/fonts/pe-icon-7-stroke.css') }}">

        <!-- Core stylesheets -->
        <link rel="stylesheet" href="{{ mix('/assets/vendor/css/rtl/bootstrap.css') }}" class="theme-settings-bootstrap-css">
        <link rel="stylesheet" href="{{ mix('/assets/vendor/css/rtl/appwork.css') }}" class="theme-settings-appwork-css">
        <link rel="stylesheet" href="{{ mix('/assets/vendor/css/rtl/theme-corporate.css') }}" class="theme-settings-theme-css">
        <link rel="stylesheet" href="{{ mix('/assets/vendor/css/rtl/colors.css') }}" class="theme-settings-colors-css">
        <link rel="stylesheet" href="{{ mix('/assets/vendor/css/rtl/uikit.css') }}">
        <link rel="stylesheet" href="{{ mix('/assets/css/demo.css') }}">
        <link rel="stylesheet" href="{{ mix('/assets/vendor/libs/datatables/datatables.css') }}">
		
		<link href="{{ asset('css/backend.css') }}" rel="stylesheet">
        <!-- Load polyfills -->
        <script src="{{ mix('/assets/vendor/js/polyfills.js') }}"></script>
        <script>document['documentMode'] === 10 && document.write('<script src="https://polyfill.io/v3/polyfill.min.js?features=Intl.~locale.en"><\/script>')</script>

        <script src="{{ mix('/assets/vendor/js/material-ripple.js') }}"></script>
        <script src="{{ mix('/assets/vendor/js/layout-helpers.js') }}"></script>

        <!-- Theme settings -->
        <!-- This file MUST be included after core stylesheets and layout-helpers.js in the <head> section -->
        <script src="{{ mix('/assets/vendor/js/theme-settings.js') }}"></script>
        <script>
            
            window.themeSettings = new ThemeSettings({
                    cssPath: '',
                    themesPath: '',
                    pathResolver: function(path) {
                        var resolvedPaths = {
                        // Core stylesheets
                        //
                            @foreach (['bootstrap', 'appwork', 'colors'] as $name)
                            '{{ $name }}.css': '{{ mix("/assets/vendor/css/rtl/{$name}.css") }}',
                            '{{ $name }}-material.css': '{{ mix("/assets/vendor/css/rtl/{$name}-material.css") }}',
                            @endforeach

                            // UI Kit
                            'uikit.css': '{{ mix("/assets/vendor/css/rtl/uikit.css") }}',
                            // Themes
                            //
                            @foreach (config('constants.themes') as $name)
                            'theme-{{ $name }}.css': '{{ mix("/assets/vendor/css/rtl/theme-{$name}.css") }}',
                            'theme-{{ $name }}-material.css': '{{ mix("/assets/vendor/css/rtl/theme-{$name}-material.css") }}',
                            @endforeach
                        }

                        return resolvedPaths[path] || path;
                    }
            }); 
            
            window.themeSettings.setTheme("{{Auth::user()->getSchoolTheme()}}",true);
        
        </script>
        
        <!-- Core scripts -->
        <script src="{{ mix('/assets/vendor/js/pace.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Libs -->
        <link rel="stylesheet" href="{{ mix('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">

        <!-- To include time picker on period page. -->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
        
        <style>
            .theme-settings-open-btn{display: none !important;}
        </style>
        @yield('styles')
    </head>
    <body>
        <div class="page-loader"><div class="bg-primary"></div></div>

        @yield('layout-content')

        <!-- Core scripts -->
        <script src="{{ mix('/assets/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ mix('/assets/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ mix('/assets/vendor/js/sidenav.js') }}"></script>

        <!-- Scripts -->
        <script src="{{ mix('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ mix('/assets/js/demo.js') }}"></script>
        <script src="{{ mix('/assets/vendor/libs/datatables/datatables.js') }}"></script>
        <script>
            // Disable search and ordering by default
            $.extend( $.fn.dataTable.defaults, {
                lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
                pageLength: {{SiteHelpers::pageLimit()}}
            } );
        </script>
        @yield('scripts')
    </body>
</html>
