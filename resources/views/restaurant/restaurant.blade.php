@extends('app')

@section('title', {{ $restaurant->name }})

@section('content')
    <div class="restaurant">
        <div class="restaurant-info">

        </div>

        <div class="restaurant-buttons">

        </div>

        <div class="list-food">
            @forelse($restaurant->foods as $food)
                <div class="food">
                    <p class="food-info"></p>
                    <button class="button" type="button" name={{ "Food" . $food->id }}>+</button>
                </div>
            @empty            
                <p> The restaurant {{ $restaurant->name }} does not have foods available right now. </p>
            @endforelse
        </div>

        <div class="restaurant-order">
            <div class="buy-button">
            </div>
        </div>

    </div>
@endsection