@extends('layouts.app')

@section('title', 'Eat & Go - '.$restaurant->name)
@section('css-stylesheet', asset('css/restaurant.css'))

@section('content')
    <div class="restaurant">                
        <div class="restaurant-info">
            <img src={{ asset( $restaurant->image_url ) }} alt="{{ $restaurant->name }}">
            <ul>
                <li class="restaurant-name">{{ $restaurant->name }}</li>
                <li>{{ $restaurant->number_reviews }} reviews</li>
                <li>{{ $restaurant->address }}</li>
            </ul>
        </div>
        
        <div class="restaurant-buttons">
            <ul>
                <li><a href="/restaurants/{{ $restaurant->id }}">Foods</a></li>
                <li><a href="/restaurants/{{ $restaurant->id }}/reviews">Reviews</a></li>
                @if((Auth::user()->id == $restaurant->admin_id && Auth::user()->isAdminRestaurant()) || Auth::user()->isAdminApp())
                    <li><a href="/editRestaurant/{{ $restaurant->id }}">Edit</a></li>
                @endif
            </ul>
        </div>
        
        @if($show_foods)
            @include('restaurant.subviews.foods')
        @else
            @include('restaurant.subviews.reviews')
        @endif        
    </div>
@endsection

