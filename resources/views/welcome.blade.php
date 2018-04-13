@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="content text-center">
            <p class="text-center"> Welcome to IF sales app. To access the application please register</p>
            <p><img src="https://industriesfinest.com/media/wysiwyg/Footer_logo_298x298.png">
                @if (Route::has('login'))
            <div>
                @auth
                <a class="hpbtn" href="{{ url('/home') }}">Search</a>
                @else
                <a class="hpbtn" href="{{ route('login') }}">Login</a>
                <a class="hpbtn" href="{{ route('register') }}">Register</a>
                @endauth
            </div>
            @endif
        </div>
    </div>
</div>
@endsection