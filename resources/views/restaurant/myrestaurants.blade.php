@extends('app')

@section('title', 'Restaurants')
@section('css-stylesheet', 'css/restaurants.css')

@section('content')                    
    <div class="_main_container">                 
        <div class="_restaurants">
            @forelse($restaurants as $restaurant)
                <div class="card">
                    <div class="row no-gutters">
                        <div class="col-4">
                            <img height="120" width="120" src="{{ $restaurant->image_url }}" alt="">
                        </div>
                        <div class="col-8">
                            <div class="card-body">

                                <a class="card-title" href="restaurants/{{ $restaurant->id }}">
                                    {{ $restaurant->name }}
                                </a>
                                <p class="card-subtitle text-muted">{{ $restaurant->number_reviews }} reviews</p>
                                <p class="card-text">{{ $restaurant->address }}</p>

                            </div> 
                        </div>
                    </div>
                </div>
                <br>
            @empty
                <p>No restaurants available!</p>
            @endforelse
        </div>
    </div>
    
@endsection