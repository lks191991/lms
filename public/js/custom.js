$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	
	
	$(".mobile-toggle-btn").click(function(){		
		$(".header-nav").slideToggle();			
		$(".mobile-toggle-btn").toggleClass("open");
	});
	
	
	
	$(".school-carousel").owlCarousel({
	center: false,	
	loop:false,    
	autoplay:false,
	slideSpeed: 200,
	autoplaySpeed:1000,	
	responsive:{
		0:{
			items:1,
			nav:true,
			dots:false,
			margin:0,
			center:true
		},
		600:{
			items:2,
			nav:true,
			dots:false,
			margin:0
		},
		1000:{
			items:3,
			nav:true,
			dots:false,
			margin:0
		},
		1200:{
			items:4,
			nav:true,
			dots:false,
			margin:0
		}
	}

});	
	
$(".profile-carousel").owlCarousel({
	center: false,	
	loop:false,    
	autoplay:false,
	slideSpeed: 200,
	autoplaySpeed:1000,	
	responsive:{
		0:{
			items:1,
			nav:false,
			dots:true,
			margin:0,
			center:true
		},
		600:{
			items:1,
			nav:false,
			dots:true,
			margin:0
		},
		1000:{
			items:1,
			nav:false,
			dots:true,
			margin:0
		}
	}

});	
	

	
	
if ($(window).width() < 1199) {		
$(".btn-group, .dropdown").hover(
  function () {
      $('>.dropdown-menu', this).stop(true, true).fadeIn("fast");
      $(this).addClass('open');
  },
  function () {
      $('>.dropdown-menu', this).stop(true, true).fadeOut("fast");
      $(this).removeClass('open');
  });	
}	
	
	
	
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
					$input.closest('div').nextAll('small').hide();
					
					$('<div class="invalid-feedback">'+errorMessage+'</div>').insertAfter($input.closest('div')).show();
				}else if($input.closest('div').hasClass('custom-file') || $input.closest('div').hasClass('custom-radio')){
					$input.closest('div').nextAll('div.invalid-feedback').remove();
					$input.closest('div').nextAll('small').hide();
					
					$('<div class="invalid-feedback">'+errorMessage+'</div>').insertAfter($input.closest('div')).show();
				}else{
					$input.nextAll('div.invalid-feedback').remove();
					$input.nextAll('small').hide();
					
					$('<div class="invalid-feedback">'+errorMessage+'</div>').insertAfter($input).show();
				}
			}else {
				if($input.closest('div').hasClass('input-group') || $input.closest('div').hasClass('custom-file')){
					$input.closest('div').nextAll('div.invalid-feedback').remove();
					$input.closest('div').nextAll('small').show();
				}else{
					$input.nextAll('div.invalid-feedback').remove();
					$input.nextAll('small').show();
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

        