@extends('app')

@section('title', 'Restaurants')

@section('css-stylesheet', 'css/addRestaurants.css')

@section('content')
   

    <div class="_main_container">

            <form name="form" id="form" method="post" action="" id="FORM_ID" >
                @csrf
                <br>
                <b>Name</b><br> 
                <input type="text" placeholder="Enter Restaurant Name" name="name" required value="{{old('name')}}"><br>
                
                <b>Address</b><br>
                <input type="text" placeholder="Enter Restaurant Address" name="address" value="{{old('address')}}"><br>
                
                <b>Bank Account</b><br> 
                <input type="text" placeholder="Enter Restaurant Bank Account" name="bank_account" value="{{old('bank_account')}}"> <br>

                <b>Phone number</b><br> 
                <input type="text" placeholder="Enter Restaurant Phone number" name="phone" value="{{old('phone')}}"> <br>

                <b>Admin Email</b><br> 
                <input type="text" placeholder="Enter Restaurant Admin email" name="admin" value="{{old('admin')}}"> <br>

                <b>Restaurant icon</b><br> 
                <input type="file" name="image" value="{{old('image')}}"> <br>
    
                <br><br> 
     
                <button type="submit" 
                    method="POST" 
                    class="btn btn-success" 
                    name="form_btn"
                    value="create">Create New
                </button>

                <button type="submit" 
                    method="POST" 
                    class="btn btn-info" 
                    name="form_btn"
                    value="read">Search by name
                </button>

                @if ($errors->any() > 0)
                    <div class="error-list">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            <!--
                @php
                $items = ['name', 'address', 'bank_account']
                @endphp
                @foreach ($items as $item)
                    <br>
                    <b>{{ $item }}</b><br> 
                    <input type="text" placeholder="Enter Restaurant {{$item}}" name="{{$item}}" required><br>
                @endforeach
            -->

            </form>

            <div class="_restaurants">
                @forelse($listRestaurants as $restaurant)
                    <div class="_restaurant_container">
                        <img src="{{ $restaurant->image_url }}" alt="">
                        <div class="row">
                            <div class="col">
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
                            <div class="col">
                                <form name="form_delete" id="form_delete" action="" id="FORM_DELETE" >
                                    @csrf
                                    <button
                                        class="btn btn-warning" 
                                        name="form_btn"
                                        value="edit"><a href="editRestaurant/{{ $restaurant->id }}">
                                            Edit
                                        </a>
                                    </button>
                                </form>
                            </div>
                        </div> 
                        
                    </div>
                @empty
                    <p>No restaurants available!</p>
                @endforelse
            </div>
        
    </div>
    
@endsection