@extends('frontend.layouts.app')
@section('header-styles')
<style>
    .home-login-container{
        background-color: #a2e8ff;
        border-radius: 5px;
        border: 1px #9ce2ff solid;
        padding: 15px;                
    }
</style>
@endsection
@section('content')
<div class="py-4 bg-white border-bottom">    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">

                @php
                $boxTitle = "Join a class";
                $joinButton  = "submit";
                @endphp

                @include('frontend.includes.join_a_class_box')
            </div>
        </div>
    </div>
</div>

<div class="py-4 bg-light border-bottom">    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <p class="text-center mt-5 font-weight-lighter">	
                    <i>
                        Insert various device types<br/>
                        with screen mockup<br/>
                    </i>
                </p>
            </div>
            <div class="col-sm-6">
                <div class="login-form-wrapper p-5 text-right">
                    <h2 class="font-weight-bold">Join from any device</h2>
                    <h5>More sub text here</h5>
                    <a class="btn border mt-5" href="#">LEARN HOW</a>
                </div>                
            </div>
        </div>
    </div>
</div>

<div class="py-4 bg-white border-bottom">    
    <div class="container">
        @guest
        <div class="row justify-content-center home-login-container m-1 mb-3">
            <div class="col-sm-6">
                <div class="w-100 py-3">
                    <h3 class="font-weight-bold px-5">Login</h3>
                    <p class="px-5">{{ __('to enable you ask a question, nd connect with classmates') }}</p>
                    @include('auth.forms.login-form')
                </div>
            </div>

            <div class="col-sm-6">
                <p class="text-center mt-5 font-weight-lighter">	
                    <i>
                        Insert photograph here<br/>
                        of student using app<br/>
                        on a device <br/>
                        (DES schoolgirl img)
                    </i>
                </p>
            </div>
        </div>
        @endguest

        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card text-white bg-primary shadow">
                    <div class="card-body">
                        <h3>Get your school online</h3>
                        <p>Contact us to get your school online at no cost</p>

                        <a class="btn border text-white" href="#">CONTACT US</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card bg-white shadow">
                    <div class="card-body justify-content-center">                        
                        <p class="text-center m-5 font-weight-lighter">	
                            <i>
                                Other promotional info on this card.

                            </i>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
