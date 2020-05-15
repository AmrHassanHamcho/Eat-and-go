@extends('app')

@section('title', 'Restaurants')
@section('css-stylesheet', 'css/restaurants.css')

@section('content')
   

    <div class="_main_container col-sm-12">
        <div class="_main_address_container col-3">
            <div class="_address_container"> 
                <img src="/img/position_icon.png" alt=""> <span>{{ $address ?? 'Default Address' }}</span>  
            </div>
            <a href="/address">Change address</a>
        </div>
        
        <div class="_main_restaurants_container col-11">
            
            <div>
                <div class="_restaurants_count">
                    <span>{{ $listRestaurants->count() }} restaurants available.</span>
                </div>
                <div class="_restaurants_filter">
                    <span> Sort By </span>
                   
                    <form name="form" id="form" method="post" action="/restaurants" id="FORM_ID" >
                        @csrf
                        <select class="_filter" name="filter" onchange="this.form.submit()">
                            <option disabled selected>Select an option</option>
                            <option value="name_asc">Name ascend</option>
                            <option value="name_desc">Name descend</option>
                            <option value="num_reviews_asc">Reviews ascend</option>
                            <option value="num_reviews_desc">Reviews descend</option>
                        </select>      
                    </form>
                </div>
            </div>
      
            <div class="_restaurants">
                @forelse($listRestaurants as $restaurant)
                    <div class="_restaurant_container">
                        <img src="{{ $restaurant->image_url }}" alt="">
                        <div class="restaurant-info">
                            <ul>
                                <li>
                                    <a class="restaurant-name" href="restaurants/{{ $restaurant->id }}">
                                        {{ $restaurant->name }}
                                    </a>
                                </li>
                                <li>{{ $restaurant->number_reviews }} reviews</li>
                                <li>{{ $restaurant->address }}</li>
                            </ul>
                        </div> 
                    </div>
                @empty
                    <p>No restaurants available!</p>
                @endforelse
            </div>
        </div>
    </div>
    
@endsection