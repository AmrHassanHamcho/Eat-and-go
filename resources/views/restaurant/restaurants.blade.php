@extends('app')

@section('title', 'Restaurants')
@section('css-stylesheet', 'css/restaurants.css')

@section('content')
   

    <div class="container">
        <!--
        <div class="_main_address_container">
            <div class="_address_container"> 
                <img src="/img/position_icon.png" alt=""> <span>{{ $address ?? 'Default Address' }}</span>  
            </div>
            <a href="/address">Change address</a>
        </div>
    -->

        <div class="row">
            <div class="card bg-light mb-3 col-lg-4 col-12" style="max-width: 16rem; max-height: 8rem;">
                <div class="card-header">
                    <img width="25" height="25" src="/img/position_icon.png" alt="">
                     <span>{{ $address ?? 'Default Address' }}</span>  
                </div>
                <div class="card-body">
                    <a href="/address">Change address</a>
                </div>
            </div>
            <div class="col-lg-8 col-12">

                    <div> 
                        <span>{{ $listRestaurants->count() }} restaurants available.</span>
                        <form name="form" id="form" method="post" action="/restaurants" id="FORM_ID" >
                            <span> Sort By </span>
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

        
                <div class="_restaurants">
                    @forelse($listRestaurants as $restaurant)
                        <div class="card flex-row flex-wrap">
                            
                            <div class="card-header border-0">
                                <img height="120" width="120" src="{{ $restaurant->image_url }}" alt="">
                            </div>
                            
                            <div class="card-body">

                                <a class="card-title" href="restaurants/{{ $restaurant->id }}">
                                    {{ $restaurant->name }}
                                </a>
                                <p class="card-subtitle text-muted">{{ $restaurant->number_reviews }} reviews</p>
                                <p class="card-text">{{ $restaurant->address }}</p>

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