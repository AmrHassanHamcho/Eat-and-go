@extends('app')

@section('title', 'Eat & Go - '.$restaurant->name)
@section('css-stylesheet', asset('css/restaurant.css'))

@section('content')
    <div class="restaurant">                
        <div class="restaurant-info">
            <img src="{{ $restaurant->image_url }}" alt="{{ $restaurant->name }}">
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
                    <button type="button" name={{ "food" . $food->id }}>+</button>  
                </div>             
            @empty            
                <p> The restaurant {{ $restaurant->name }} does not have foods available right now. </p>
            @endforelse
        </ul>

        <div class="restaurant-order">            
            <div class="order">
                <ul>
                    @forelse($order->orderlines as $orderline)                
                        <ul class="total-price">
                            <button class="remove-button" type="button" name={{ "line" . $orderline->id}}>-</button>
                            <li class="orderline">{{ $orderline->food->name }}</li>
                            <li class="price-number">{{ $orderline->total_price }} €</li>
                        </ul>                        
                    @empty            
                        <li class="no-food-selected">No food selected.</li>
                    @endforelse                
                </ul>
                {{-- <p class="total-price">Total: {{$order->total_price}}</p> --}}
                <ul class="total-price final">
                    <li>Total</li>
                    <li class="price-number">50,65 €</li>
                </ul>
            </div>
            <button class="buy-button">BUY</button>
        </div>
    </div>
@endsection

