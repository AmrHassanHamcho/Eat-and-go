@extends('app')

@section('title', 'Restaurants')
@section('css-stylesheet', 'css/restaurants.css')

@section('content')   
    <div class="_main_container">        
        <div class="_main_restaurants_container">                              
            <div class="_restaurants">
                @forelse($restaurants as $restaurant)
                    <div class="_restaurant_container">
                        <img src="{{ $restaurant->image_url }}" alt="">
                        <div class="restaurant-info">
                            <ul>
                                <li>
                                    <a class="restaurant-name" href="restaurants/{{ $restaurant->id }}">
                                        {{ $restaurant->name }}
                                    </a>
                                </li>
                                <li>{{ $restaurant->number_reviews }} reviews</li>
                                <li>{{ $restaurant->address }}</li>
                            </ul>                               
                            <a href="/editRestaurant/{{ $restaurant->id }}">Edit</a>
                        </div> 
                    </div>
                @empty
                    <p>No restaurants available!</p>
                @endforelse
            </div>
        </div>
    </div>
    
@endsection