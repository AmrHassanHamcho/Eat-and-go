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
        <form class="address-form col-12 col-lg-8" method="post" name="address-form">
            <p id="address-text">Address</p>
            <input type="text" id="address-box" name="address-text" placeholder="03690 San Vicente del Raspeig Alicante">
            <input type="submit" id="address-submit" value="Find restaurants">
        </form>
    </div>
@endsection