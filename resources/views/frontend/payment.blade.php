@extends('frontend.layouts.app')
@section('styles')
<style type="text/css">
        .panel-title {
        display: inline;
        font-weight: bold;
        }
        .display-table {
            display: table;
        }
        .display-tr {
            display: table-row;
        }
        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
        }
	.hide{
	display:none;}
	
    </style>
	@endsection('styles')
@section('content')

<!-- Breadcrumbs -->

	<section class="breadcrumbs bg-light py-3">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="m-0 p-0 list-unstyled d-flex flex-wrap">
						<li>
							<a href="/">Home</a>
						</li>
						<li>
							<span class="mx-2">></span>Payment
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- Breadcrumbs Ends-->

	<!-- Order Summary -->

    <section class="order-summary section-padding border-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="page_title">Order Summary</h1>
                    <p class="description"><span class="today_date">{{date('d-M-Y')}}</span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="order-summary-main-table">
                        <div class="table-responsive">
                            <table class="table custom-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Course Type</th>
                                        <th scope="col">Course</th>
                                        <th scope="col">Level</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$course->name}}</td>
                                        <td>{{$subject->subject_name}}</td>
                                        <td>{{$subject->subject_class->class_name}}</td>
                                        <td><b><i class="fas fa-rupee-sign"></i>{{$subject->subject_price}}</b></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">Total</th>
                                        <td><b><i class="fas fa-rupee-sign"></i>{{$subject->subject_price}}</b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
						 <form 
                            role="form" 
                            action="{{ route('frontend.paymentpost') }}" 
                            method="post" 
                            class="require-validation"
                            data-cc-on-file="false"
                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="payment-form">
                        @csrf
  
                        <div class='form-row row' style="display:none">
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Name on Card</label> <input
                                    class='form-control'  size='4' value="Test" type='text'>
                            </div>
                        </div>
  
                        <div class='row' style="display:none">
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Card Number</label> <input
                                    autocomplete='off' class='form-control card-number' value="4242424242424242"  size='20'
                                    type='text'>
                            </div>
                        </div>
  
                        <div class='row' style="display:none">
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label> <input autocomplete='off'
                                    class='form-control card-cvc'  value="123" placeholder='ex. 311' size='4'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required' style="display:none">
                                <label class='control-label'>Expiration Month</label> <input
                                    class='form-control card-expiry-month' value="12" placeholder='MM' size='2'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required' style="display:none">
                                <label class='control-label'>Expiration Year</label> <input
                                    class='form-control card-expiry-year' value="2024"  placeholder='YYYY' size='4'
                                    type='text'>
                            </div>
                        </div>
						<input type="hidden"  name="sid" value="{{$subject->uuid}}" />
						<div class='form-row row'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.</div>
                            </div>
                        </div>
                       
  
                        <div class="row">
                             <div class="payment-action-btns d-flex flex-wrap justify-content-center mt-md-5 mt-4">
                        <button class="btn btn-fade">Cancel</button>
                        <button type="submit" class="btn btn-primary ms-md-5 ms-3">Confirm</button>
                    </div>
                        </div>
                          
                    </form>
                    </div>
                   
                </div>
            </div>
        </div>
    </section>
	@endsection
@section('scripts')
    <!-- Order Summary Ends-->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  
<script type="text/javascript">
$(function() {
   
    var $form         = $(".require-validation");
   
    $('form.require-validation').bind('submit', function(e) {
        var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.addClass('hide');
  
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });
   
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }
  
  });
  
  function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
               
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
   
});
</script>
@endsection