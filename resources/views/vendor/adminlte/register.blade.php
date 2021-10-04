@extends('adminlte::master')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', 'register-page')

@section('body')
    <div class="register-box w-25">
        <div class="register-logo">
            <a href="{{ url('/') }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>
        <div class="card shadow">
            <div class="card-body register-card-body rounded-lg px-4 py-3">
				@if(isset($num) && $num == 1)
					<h3 class="font-weight-bold">Register</h3>
					<p class="">{{ __('to enable you ask a question, nd connect with classmates') }}</p>
					
					@include('adminlte::forms.register-step1-form')
				@elseif(isset($num) && $num == 2)
					<h3 class="font-weight-bold">Activate account</h3>
					<p class="">{{ __('Enter the 5 digit code send to your mobile number') }}</p>
					
					@include('adminlte::forms.register-step2-form')
				@elseif(isset($num) && $num == 3)
					<h3 class="font-weight-bold">More about you</h3>
					<p class="">{{ __('Tell us more so we can help you learn better') }}</p>
					
					@include('adminlte::forms.register-step3-form')
				@elseif(isset($num) && $num == 4)
					<h3 class="font-weight-bold">Build your profile</h3>
					<p class="">{{ __('Select an avatar that represents you or upload your profile') }}</p>
					
					@include('adminlte::forms.register-step4-form')
				@endif
			</div>
        </div>
    </div>
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop

@section('footer-scripts')
	<script>	
		$(document).ready(function () {
			
			// Active class add on avatar add
			$(".frofile_img").on('click', function(){
				$('#registerForm4').get(0).reset();
				
				$(".frofile_img").removeClass('active');
				$(this).addClass('active');
				
				$("#user_image").closest('div').nextAll('div.invalid-feedback').remove();
				$("#user_image").closest('div').nextAll('span').show();
				
				$('input[name="avatarImage"]').val($(this).find('img').data('path'));
				
				$('div.custom-file').find("label.custom-file-label").removeClass("selected").html('Choose file');
			});
			
			// Add the following code if you want the name of the file appear on select
			$(".custom-file-input").on("change", function() {
				$(".frofile_img").removeClass('active');
				$('input[name="avatarImage"]').val('');
				
				var fileName = $(this).val().split("\\").pop();
					
				$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
			});
			
			$('#registerForm4').submit(function(event) {
				if($("input[type='image'][name='user_image']").val() == ''){
					var avatarSelect = 0;
					$('.frofile_img').each(function(e){
						if($(this).hasClass('active'))
							avatarSelect = 1;
					});
					
					if(avatarSelect == 0){
						event.preventDefault(); //this will prevent the default submit
						
						$("#user_image").closest('div').nextAll('div.invalid-feedback').remove();
						$("#user_image").closest('div').nextAll('span').hide();
						
						$('<div class="invalid-feedback"><strong>this is required if you dont select any avatar.</strong></div>').insertAfter($("#user_image").closest('div')).show();
						
						return false;
					}
				}
			 });
		});
	</script>
@stop