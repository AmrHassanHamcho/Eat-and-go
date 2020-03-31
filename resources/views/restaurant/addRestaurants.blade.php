@extends('app')

@section('title', 'Restaurants')
@section('css-stylesheet', 'css/addRestaurants.css')

@section('content')
   

    <div class="_main_container">

            <form name="form" id="form" method="post" action="" id="FORM_ID" >
                @csrf
                <br>
                <b>Name</b><br> 
                <input type="text" placeholder="Enter Restaurant Name" name="name" required><br>
                
                <b>Address</b><br>
                <input type="text" placeholder="Enter Restaurant Address" name="address" ><br>
                
                <b>Bank Account</b><br> 
                <input type="text" placeholder="Enter Restaurant Bank Account" name="bank_account" > <br>

                <b>Phone number</b><br> 
                <input type="text" placeholder="Enter Restaurant Phone number" name="phone" > <br>

                <b>Admin Email</b><br> 
                <input type="text" placeholder="Enter Restaurant Admin email" name="admin" > <br>

                <b>Restaurant icon</b><br> 
                <input type="file" name="image" > <br>
    
                <br><br> 
     
                <input type=hidden name="is-create" value="false" id="hidden_id">
                <button type="submit" 
                    method="POST" 
                    class="btn btn-success" 
                    name="create-btn"
                    onclick="event.preventDefault(); document.getElementById('hidden_id').value="true"; document.getElementById('submit-form 
                    personal').submit();">Create
                </button>

                <button type="submit" 
                    method="POST" 
                    class="btn btn-info" 
                    name="read-btn" 
                    onclick="event.preventDefault(); document.getElementById('hidden_id').value="false"; document.getElementById('submit-form- 
                    personal').submit();">Read
                </button>

                


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
        
    </div>
    
@endsection