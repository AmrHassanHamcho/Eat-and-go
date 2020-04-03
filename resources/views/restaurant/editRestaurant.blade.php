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
        
        
        <div class="food-form">
            <h4>Manage Restaurant information</h4>
            @include('error-list')
            <form method="post" action="/editRestaurant/{{ $restaurant->id }}" enctype="multipart/form-data">
                @csrf            
              
                <div class="form-group">
                    <label>Name</label>        
                    <input type="text" name="name" placeholder="{{ $restaurant->name }}" class="form-control">
                <div>

                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" placeholder="{{ $restaurant->address }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Bank Account</label>
                    <input type="text" name="bank_account" placeholder="{{ $restaurant->bank_account }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" placeholder="{{ $restaurant->phone }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Restaurant icon</label>
                    <input type="file" name="image" placeholder="{{ $restaurant->image_url }}" class="form-control">
                </div>

                <div class="form-group btn">
                    <button type="submit" class="edit-food-btn create" name="restaurant-btn" value="create">Create</button>
                    <button type="submit" class="edit-food-btn edit" name="restaurant-btn" value="edit">Update</button>
                    <button type="submit" class="edit-food-btn delete" name="restaurant-btn" value="delete">Delete</button>
                </div>
            </form>
        </div>
    </div>
@endsection