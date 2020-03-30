@extends('app')

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
        <form class="address-form" method="post" name="address-form" action="/restaurants">
            @csrf
            <p id="address-text">Address</p>
            <input type="text" id="address-box" name="address" placeholder="03690 San Vicente del Raspeig Alicante">
            <input type="submit" id="address-submit" value="Find restaurants">
        </form>
    </div>
@endsection