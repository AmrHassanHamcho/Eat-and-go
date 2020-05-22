@extends('layouts.app')

@section('title', 'Restaurants')
@section('css-stylesheet', 'css/restaurants.css')

@section('content')
   

    <div class="container">
        <div class="row">
            <div class="address card bg-light col-lg-4 col-12">
                <div class="card-header">
                    <img width="25" height="25" src="/img/position_icon.png" alt="">
                     <span>{{ $address ?? 'Default Address' }}</span>  
                </div>
                <div class="card-body">
                    <a href="/address">Change address</a>
                </div>
            </div>
            
            <div class="col-lg-8 col-12">
                <div class="search-container">
                    <form class="search-form form-inline d-flex md-form form-sm active-pink active-pink-2 mt-2"
                        name="search-form" id="search-form" method="POST" action="/restaurants" >
                        @csrf
                        <input class="form-control form-control-sm ml-3 w-75" 
                        type="text" placeholder="Search" id="restaurant-search" name="restaurant-search">

                
                    <div class="container row"> 
                        <span>{{ $listRestaurants->count() }} restaurants available.</span>
                    </div> 
                    <div class="container row">  
                        <span> Sort By </span>
                    
                        @csrf
                        <select class="_filter" name="filter" onchange="this.form.submit()">
                            <option disabled selected>Select an option</option>
                            <option value="name_asc">Name ascend</option>
                            <option value="name_desc">Name descend</option>
                            <option value="num_reviews_asc">Reviews ascend</option>
                            <option value="num_reviews_desc">Reviews descend</option>
                        </select>  
                    </div>    
                    </form>

                </div>
        
                <div class="_restaurants">
                    @forelse($listRestaurants as $restaurant)
                        <div class="card">
                            <div class="row no-gutters">
                                <div class="col-4">
                                    <img height="120" width="120" src={{ asset( $restaurant->image_url ) }} alt="{{ $restaurant->name }}">
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
        </div>
    </div>

@endsection