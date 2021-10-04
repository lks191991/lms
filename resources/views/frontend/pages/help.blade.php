@extends('frontend.layouts.app')

@section('title', 'Help')

@section('content')
<section class="inner-banner">	
    <div class="container">            
     	<div class="caption">
          <h1 class="heading">Get help</h1>
           <!-- <h3 class="heading-sub-text">Get help</h3> -->
      </div>
    </div>
</section>

<section class="bg-white py-5">
   <div class="container">
  
	   <div id="accordion" class="custom-accordion">
    <div class="card">
      <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">        
          How to access XtraClass from your PC?        
      </div>
      <div id="collapseOne" class="collapse " data-parent="#accordion">
        <div class="card-body">
			<div class="card-text">
        Open your favourite browser & browse to <a href="{{URL::to('/')}}">{{URL::to('/')}}</a>, select your course & join a class to start learning.
			</div>	
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header collapsed" data-toggle="collapse" href="#collapseTwo">        
        How to access from your smartphone?     
      </div>
      <div id="collapseTwo" class="collapse" data-parent="#accordion">
        <div class="card-body">
          <div class="card-text">
          Go to the <a href="https://play.google.com/store">Playstore </a> on your Android device to download the app. Go to the <a href="https://www.apple.com/ios/app-store">Appstore</a> on your iPhone, iPad or Apple device to download the app
			 


			</div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header collapsed" data-toggle="collapse" href="#collapseThree">        
          How to access from your smart TV?       
      </div>
      <div id="collapseThree" class="collapse" data-parent="#accordion">
        <div class="card-body">
          <div class="card-text">
          From your smart menu open the TV browser and open <a href="{{URL::to('/')}}">{{URL::to('/')}}</a> select your course & join a class to start learning.


			</div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header collapsed" data-toggle="collapse" href="#collapseFour">        
        How to access from any phone or tablet?      
      </div>
      <div id="collapseFour" class="collapse" data-parent="#accordion">
        <div class="card-body">
          <div class="card-text">
          If you cant access an appstore on your tablet or feature phone, then just open your browser and navigate to <a href="{{URL::to('/')}}">{{URL::to('/')}}</a>. It works on all browsers from Firefox & Chrome to Opera-mini




			</div>
        </div>
      </div>
    </div>

  </div>
</div>
</section>

@include('frontend.includes.contact_banner')

@endsection
@section('after-styles')

@endsection
@section('scripts')

@endsection

@section('footer-scripts')
<script>
    $(document).ready(function(){        
//        $(".date").flatpickr({
//            inline: true
//        });        
    });
</script>
@endsection
