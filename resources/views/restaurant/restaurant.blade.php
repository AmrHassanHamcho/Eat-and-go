@extends('app')

@section('title', '{{ $restaurant->name }}')
@section('css-stylesheet', asset('css/restaurant.css'))

@section('content')
    <div class="restaurant">        
        <img src="{{ $restaurant->image_url }}" alt="{{ $restaurant->name }}">
        <div class="restaurant-info">
            <ul>
                <li class="restaurant-name">{{ $restaurant->name }}</li>
                <li>{{ $restaurant->number_reviews }} reviews</li>
                <li>{{ $restaurant->address }}</li>
            </ul>
        </div>
        
        <div class="restaurant-buttons">
            <ul>
                <li><a href="">Foods</a></li>
                <li><a href="">Reviews</a></li>
                <li><a href="">Edit</a></li>
            </ul>
        </div>

        
        <ul class="food-list">
            @forelse($restaurant->foods as $food)                
                <div class="food">
                    <li>
                        {{ $food->name }} <br>
                        <span class="food-description">{{ $food->description }}</span>
                    </li>                    
                    <button type="button" name={{ "Food" . $food->id }}>+</button>  
                </div>             
            @empty            
                <p> The restaurant {{ $restaurant->name }} does not have foods available right now. </p>
            @endforelse
        </ul>

        <div class="restaurant-order">
            {{-- @forelse($orderlines as $orderline)
                <button class="buy-button">BUY</button>
                <div class="orderline">                
                </div>
            @empty            
                <p>No food selected.</p>
            @endforelse --}}
        </div>
    </div>
@endsection

