@extends('frontend.layouts.app')

@section('content')
<section class="register-banner"></section>
<section class="register-wrapper">
    <div class="container">
        <div class="register-card-wrapper">	
            <div class="register-card">
                <div class="register-card-header">
                    <h1 class="heading">{{ __('Confirm Password') }}</h1>
                </div>
                @includeif('auth.forms.passwords.confirm')
            </div>
        </div>
    </div>	
</section>	

@endsection
