@extends('app')

@section('title', 'Restaurants')
@section('css-stylesheet', 'css/restaurants.css')

@section('content')
   

    <div class="_main_container">
        <div class="_main_address_container">
            <div class="_address_container">
                <img src="/img/position_icon.png" alt=""> <span>Calle de San Lorenzo</span>  
            </div>
            <a href="/index">Change address</a>
        </div>
        
        <div class="_main_restaurants_container">
            <p>{{ $listRestaurants->count() }} restaurants available.</p>
            <ul>
                @forelse($listRestaurants as $restaurant)
                    <li>{{ $restaurant->name }}</li>
                @empty
                    <li>No restaurants available!</li>
                @endforelse
            </ul>
        </div>
      </div>
    
@endsection