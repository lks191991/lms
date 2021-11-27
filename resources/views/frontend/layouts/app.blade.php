<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
		integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- Owl Carousel -->
	<link rel="stylesheet" href="{{ asset('css/front/owl.carousel.min.css')}}" type="text/css">

	<!-- Bootstrap CSS -->
	<link href="{{ asset('css/front/bootstrap.min.css')}}" type="text/css" rel="stylesheet">

	<!-- Style CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/front/style.css')}}">

	<!-- Responsive CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/front/responsive.css')}}">
   <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@yield('styles')
    <title>Bright Horizon</title>
	
		
  </head>
  
    <body>
	@include('frontend.includes.header')
        <div id="app" >
            
            @yield('content')


        </div>
	@include('frontend.includes.footer')
	<script type="text/javascript" src="{{ asset('js/front/bootstrap.bundle.min.js') }}"></script>
	 <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
	 <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	  <!-- To include time picker on period page. -->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
	  @if(Session::has('error'))

        <script>
        $(function () {
            toastr['error']('{{ Session::get("error") }}')
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

        @if(Session::has('success'))

        <script>
            $(function () {
                toastr['success']('{{ Session::get("success") }}')
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
	<script type="text/javascript" src="{{ asset('js/front/owl.carousel.min.js') }}"></script>
	<script>
		$(document).ready(function () {
			var owl = $('.owl-carousel');
			owl.owlCarousel({
				loop: true,
				margin: 30,
				nav: true,
				navRewind: false,
				navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
				responsive: {
					0: {
						items: 1
					},
					600: {
						items: 3
					},
					1000: {
						items: 4
					}
				}
			})
		})
	</script>
  
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
@yield('scripts')
    </body>
</html>
