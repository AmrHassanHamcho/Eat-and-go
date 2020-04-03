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
                <li><a href="/restaurants/{{ $restaurant->id }}">Foods</a></li>
                <li><a href="/restaurants/{{ $restaurant->id }}/reviews">Reviews</a></li>
                @if((Auth::user()->id == $restaurant->admin_id && Auth::user()->isAdminRestaurant()) || Auth::user()->isAdminApp())
                    <li><a href="/editRestaurant/{{ $restaurant->id }}">Edit</a></li>
                @endif
            </ul>
        </div>
        
        <div class="food-form">
            <h4>Manage foods</h4>
            @include('error-list')
            <form method="post" action="/editFood/{{ $restaurant->id }}&{{ $food->id }}">
                @csrf            
                <input type="hidden" name="food_id" value={{ $food->id }}>

                <div class="form-group">
                    <label>Name</label>        
                    <input type="text" name="name" placeholder="{{ $food->name }}" class="form-control">
                <div>

                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description" placeholder="{{ $food->description }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Price (€)</label>
                    <input type="text" name="price" placeholder="{{ $food->price }}" class="form-control">
                </div>
                <div class="form-group btn">
                    <button type="submit" class="edit-food-btn create" name="food-btn" value="create">Create</button>
                    
                    @if((Auth::user()->id == $restaurant->admin_id && Auth::user()->isAdminRestaurant()) || Auth::user()->isAdminApp())
                        <button type="submit" class="edit-food-btn edit" name="food-btn" value="edit">Update</button>
                    @endif
                    <button type="submit" class="edit-food-btn delete" name="food-btn" value="delete">Delete</button>
                </div>
            </form>
        </div>
    </div>
@endsection