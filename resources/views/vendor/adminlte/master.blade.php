<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{csrf_token()}}">
		<title>
			@yield('title_prefix', config('adminlte.title_prefix', ''))
			@yield('title', config('adminlte.title', 'AdminLTE 3'))
			@yield('title_postfix', config('adminlte.title_postfix', ''))
		</title>
		@if(! config('adminlte.enabled_laravel_mix'))
		<link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
		<link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

		@include('adminlte::plugins', ['type' => 'css'])

		@yield('adminlte_css_pre')

		<link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

		@yield('adminlte_css')

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		@else
		<link rel="stylesheet" href="{{ mix('css/app.css') }}">
		@endif
		
		@yield('meta_tags')

		@if(config('adminlte.use_ico_only'))
			<link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
		@elseif(config('adminlte.use_full_favicon'))
			<link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
			<link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
			<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
			<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
			<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
			<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
			<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
			<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
			<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
			<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
			<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
			<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
			<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
			<link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicons/android-icon-192x192.png') }}">
			<link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
			<meta name="msapplication-TileColor" content="#ffffff">
			<meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
		@endif
		
		<style>
			/**** Loard div css ****/
			#cover-spin {
				position:fixed;
				width:100%;
				left:0;right:0;top:0;bottom:0;
				background-color: rgba(209, 205, 220, 0.7);
				z-index:9999;
				display:none;
			}

			#cover-spin span {
				display:block;
				position:absolute;
				left:40%;top:40%;
				width:100%;
				font-size: 30px;
			}
			.frofile_img {
				width: 3.353rem;
				height: 3.353rem;
				border-radius: 50%;
				border: 4px solid #fff;
				box-shadow: 1px 1px 8px 3px rgba(0, 0, 0, 0.75);
				position: relative;
				float: left;
				margin: 0 9px 15px;
			}
			.frofile_img img {
				border-radius: 50%;
				max-width: 100%;
				display: inline-block;
				cursor:pointer;
			}
			.frofile_img.active{
				border: 4px solid #a4ec0b;
			}
		</style>
	</head>
	<body class="@yield('classes_body')" @yield('body_data')>
		@yield('body')

		@if(! config('adminlte.enabled_laravel_mix'))
			<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
			<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
			<script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

			@include('adminlte::plugins', ['type' => 'js'])

			@yield('adminlte_js')
		@else
			<script src="{{ mix('js/app.js') }}"></script>
		@endif
		
		<!-- Loader div -->
		<div id="cover-spin"> 
			<span>	
				<div class="spinner-grow spinner-grow-lg"></div>
				<b>Please wait.....</b>
			</span>
		</div>
		
		<!-- Jquery validations-->
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
		
		<script>
			$(document).ready(function () { 
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				
				$.validate({ 
					modules : 'security, logic',
					inlineErrorMessageCallback: function($input, errorMessage, config) {
						if (errorMessage) {
							if($input.closest('div').hasClass('input-group')){
								$input.closest('div').nextAll('div.invalid-feedback').remove();
								$input.closest('div').nextAll('span').hide();
								
								$('<div class="invalid-feedback"><strong>'+errorMessage+'</strong></div>').insertAfter($input.closest('div')).show();
							}else if($input.closest('div').hasClass('custom-file') || $input.closest('div').hasClass('custom-radio')){
								$input.closest('div').nextAll('div.invalid-feedback').remove();
								$input.closest('div').nextAll('span').hide();
								
								$('<div class="invalid-feedback"><strong>'+errorMessage+'</strong></div>').insertAfter($input.closest('div')).show();
							}else{
								$input.nextAll('div.invalid-feedback').remove();
								$input.nextAll('span').hide();
								
								$('<div class="invalid-feedback"><strong>'+errorMessage+'</strong></div>').insertAfter($input).show();
							}
						}else {
							if($input.closest('div').hasClass('input-group') || $input.closest('div').hasClass('custom-file')){
								$input.closest('div').nextAll('div.invalid-feedback').remove();
								$input.closest('div').nextAll('span').show();
							}else{
								$input.nextAll('div.invalid-feedback').remove();
								$input.nextAll('span').show();
							}
						}
						return false; // prevent default behaviour
					},
					submitErrorMessageCallback : function($form, errorMessages, config) {
						/* if (errorMessages) {
							customDisplayErrorMessagesInTopOfForm($form, errorMessages);
						} else {
							customRemoveErrorMessagesInTopOfForm($form);
						}
						return false; // prevent default behaviour */
					},
					onSuccess : function($form) {
					  //alert('The form '+$form.attr('id')+' is valid!');
					  //return false; // Will stop the submission of the form
					},
				});
				
			});
		</script>
		
		@yield('footer-scripts')
	</body>
</html>
