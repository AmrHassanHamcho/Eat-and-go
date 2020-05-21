@extends('layouts.app')

@section('title', 'Eat & Go - '.$restaurant->name)
@section('css-stylesheet', asset('css/restaurant.css'))

@section('content')
    <div class="restaurant">                
        <div class="restaurant-info">
            <img height="120" width="120" src={{ asset( $restaurant->image_url ) }} alt="{{ $restaurant->name }}">
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
        
        <div class="review-container">
            <h4>Update your review</h4>
            @include('error-list')
            <form class="review-form" method="post" id="review-form" action="/editReview/{{ $restaurant->id }}&{{ $review->id }}">
                @csrf        
                <input type="text" id="title-box" name="title" placeholder="Title: {{ $review->title }}">
                <select id="score-list" name="score">
                    <option value="{{ $review->score }}" selected>Prev. Score: {{ $review->score }}</option>
                    <option value="1">Score: 1</option>
                    <option value="2">Score: 2</option>
                    <option value="3">Score: 3</option>
                    <option value="4">Score: 4</option>
                    <option value="5">Score: 5</option>                    
                </select>           
                <textarea name="comment" id="comment-box" form="review-form" placeholder="Comment: {{ $review->comment }}" formaction="/editReview/{{ $restaurant->id }}&{{ $review->id }}"></textarea>

                <div class="form-group btn">
                    <button type="submit" class="edit-food-btn edit" name="review-btn" value="edit">Update</button>
                    <button type="submit" class="edit-food-btn delete" name="review-btn" value="delete">Delete</button>                
                </div>
            </form>    
        </div>
    </div>
@endsection