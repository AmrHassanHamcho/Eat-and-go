@extends('app')

@section('title', 'Restaurants')
@section('stylesheet', 'css/restaurants.css')

@section('content')
    <h1>X restaurants</h1>

    <div style="width:800px;
                margin: auto;
                padding: 10px">
        <div id="_address">
            Calle de San Lorenzo
        </div>
        
        <div style="width:300px; float:right;">
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