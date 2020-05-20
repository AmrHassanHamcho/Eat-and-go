@extends('layouts.app')

@section('title', 'Eat & Go')

@section('content')    
    <style>
        html {
            height: 100%;
            width: 100%;
            background-image: url('/img/index-banner.jpeg');
            background-repeat: no-repeat;    
            background-size: cover;                
        }
    </style>
    <div class="address-container">
        <form class="address-form col-12 col-lg-8" method="post" name="address-form" action="/address">
            @csrf
            <p id="address-text">Address</p>
            <input type="text" id="address-box" name="address" placeholder="03690 San Vicente del Raspeig Alicante">
            <input type="submit" id="address-submit" value="Find">
            @if($errors->any())
                <div class="error-list">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>        
    </div>
@endsection