@extends('frontend.layouts.app')

@section('title', 'How To Access')
@section('header-styles')
<style>    
    .back-to-top {
        position: fixed;
        bottom: 25px;
        right: 25px;
        display: none;
    }
</style>
@endsection
@section('content')
<section class="howtoaccess-banner">	
    <div class="container">
        <div class="row h-100">
            <div class="col-md-7">
                <div class="caption">
                    <h1 class="heading">Accessing XtraClass</h1>
                    <h3 class="heading-sub-text">How to use the platform on the various device types and App stores</h3>
                </div>
            </div>
            <div class="col-md-5 d-flex align-items-end justify-content-center justify-content-md-end">
                <img src="{{asset('images/hand-mobile.png')}}" alt="" class="img-fluid">
            </div>
        </div>	
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-0 py-md-3" id="sub-nav">
        <div class="row">
            <div class="col-6 col-md-3 text-center">
                <div class="device-type-card" data-target="from_desktop">
                    <img src="{{asset('images/desktop.png')}}" alt="Desktop">
                    <h3>Desktop</h3>
                </div>	
            </div>
            <div class="col-6 col-md-3 text-center">
                <div class="device-type-card" data-target="from_smartphone">
                    <img src="{{asset('images/smart-phone.png')}}" alt="Smartphone">
                    <h3>Smartphone</h3>
                </div>
            </div>
            <div class="col-6 col-md-3 text-center">
                <div class="device-type-card" data-target="from_smart_tv">
                    <img src="{{asset('images/smart-tv.png')}}" alt="Smart TV">
                    <h3>Smart TV</h3>
                </div>	
            </div>
            <div class="col-6 col-md-3 text-center">
                <div class="device-type-card" data-target="from_any_phone_tablet">
                    <img src="{{asset('images/any-phone.png')}}" alt="any phone /Tablet">
                    <h3>any phone /Tablet</h3>
                </div>	
            </div>
        </div>
    </div>	
</section>	

<section class="bg-gray py-5" id="from_desktop">
    <div class="container py-0 py-md-3">
        <div class="row">
            <div class="col-md-4 d-flex flex-column justify-content-center">
                <h2 class="sub-heading pb-3">From your PC</h2>
                <p>Open your favourite browser & browse to <a href="http://www.xtraclas.com"  class="text-inherit" title="www.xtraclas.com" target="_blank">www.xtraclas.com</a>, select your course & join a class to start learning.</p>
            </div>
            <div class="col-md-8 text-right">
                <img src="{{asset('images/pc-image.png')}}" alt="From your PC" class="img-fluid">
            </div>
        </div>	
    </div>
</section>

<section class="bg-sky-blue py-5" id="from_smartphone">
    <div class="container py-0 py-md-3">
        <div class="row">
            <div class="col-md-6 mb-2 mb-md-0">
                <img src="images/smartphone-image.png" alt="From your smartphone" class="img-fluid">
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-center">
                <h2 class="sub-heading pb-3">From your smartphone</h2>
                <p>Go to the Playstore on your Android device to download the app. Go to the Appstore on your iPhone, iPad or Apple device to download the app</p>
                <div class="d-flex pt-3 ">
                    <div class="barcode-hover-wrapper">
                        <div class="barcode-hover-content">
                            <img src="images/scan-to-download.png" alt="Scan to Download">
                        </div>
                        <a href="#" title="App Store"><img src="images/appstore.png" alt="App Store" class="img-fluid"></a>
                    </div>
                    <div class="ml-3">
                        <a href="#" title="Google Play" ><img src="images/googleplay.png" alt="Google Play" class="img-fluid"></a>
                    </div>	
                </div>
            </div>			
        </div>	
    </div>
</section>	


<section class="bg-gray py-5" id="from_smart_tv">
    <div class="container py-0 py-md-3">
        <div class="row">
            <div class="col-md-4 d-flex flex-column justify-content-center">
                <h2 class="sub-heading pb-3">From your Smart TV</h2>
                <p>From your smart menu open the TV’s browser and open <a href="http://www.xtraclas.com"  class="text-inherit" title="www.xtraclas.com" target="_blank">www.xtraclas.com</a> select your course & join a class to start learning.</p>

            </div>
            <div class="col-md-8 text-right">
                <img src="images/smarttv-image.png" alt="From your Smart TV" class="img-fluid">
            </div>
        </div>	
    </div>
</section>	

<section class="bg-light-purple" id="from_any_phone_tablet">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-2 mb-md-0 d-flex flex-column justify-content-end">
                <img src="images/phonetablet-image.png" alt="From any Phone or Tablet" class="img-fluid">
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-center  py-5">
                <h2 class="sub-heading pb-3">From any Phone or Tablet</h2>
                <p>If you cant access an appstore on your tablet or feature phone, then just open your browser and navigate to <a href="http://www.xtraclas.com" class="text-inherit" title="www.xtraclas.com" target="_blank">www.xtraclas.com</a>. It works on all browsers from Firefox & Chrome to Opera-mini</p>				
            </div>			
        </div>	
    </div>
</section>

<a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top rounded-circle" role="button"><i class="fas fa-chevron-up"></i></a>

@endsection

@section('footer-scripts')
<script>
    $(document).ready(function(){
	$(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                    $('#back-to-top').fadeIn();
            } else {
                    $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('body,html').animate({
                    scrollTop: 0
            }, 400);
            return false;
        });
        
        $("body").scrollspy({target: "#sub-nav"});
        //Add smooth scrolling
        $("#sub-nav .device-type-card").on("click", function(e){

            e.preventDefault();
            var target = $(this).data('target');

            if(target !== ""){        
               //Animate smooth scroll
                $("html, body").animate({
                        scrollTop: $('#'+target).offset().top - 70
                    }, 600, function(){            
                });
            }
        });
    });
    
    

</script>
@endsection