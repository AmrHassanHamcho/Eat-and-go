@extends('app')

@section('title', 'Restaurant's Food')

@section('content')
    <h1>Restaurant Menu</h1>

    <ul>
        @forelse($listFoods as $food)
            <li>{{ $food->name }}</li>
        @empty
            <li>No food found!</li>
        @endforelse
    </ul>
