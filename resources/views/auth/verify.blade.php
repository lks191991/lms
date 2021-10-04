@extends('frontend.layouts.app')

@section('content')
<section class="register-banner"></section>
<section class="register-wrapper">
    <div class="container">
        <div class="register-card-wrapper">	
            <div class="register-card">
                <div class="register-card-header">
                    <h1 class="heading">{{ __('Verify Your Email Address') }}</h1>
                </div>
                <div class="register-card-body">  
                     @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    @includeif('backend.message')

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>	
</section>
@endsection
