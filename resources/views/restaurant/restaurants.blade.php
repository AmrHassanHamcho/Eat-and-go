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
            
            <div class="test">
                <div class="_restaurants_count">
                    <span>{{ $listRestaurants->count() }} restaurants available.</span>
                </div>
                <div class="_restaurants_filter">
                    filter
                </div>
            </div>
      
            <div class="_restaurants">
                @forelse($listRestaurants as $restaurant)
                    <div class="_restaurant_container">
                        <p>{{ $restaurant->name }}</p>
                    </div>
                @empty
                    <p>No restaurants available!</p>
                @endforelse
            </div>
        </div>
    </div>
    
@endsection