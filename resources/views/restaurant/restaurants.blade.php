@extends('app')

@section('title', 'Restaurants')

@section('content')
    <h1>X restaurants</h1>

    <ul>
        @forelse($listRestaurants as $restaurant)
            <li>{{ $restaurant->name }}</li>
        @empty
            <li>No restaurant found!</li>
        @endforelse
    </ul>
