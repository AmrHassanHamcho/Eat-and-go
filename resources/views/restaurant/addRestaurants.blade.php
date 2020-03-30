@extends('app')

@section('title', 'Restaurants')
@section('css-stylesheet', 'css/restaurants.css')

@section('content')
   

    <div class="_main_container">
        <form name="form" id="form" method="post" action="/restaurants" id="FORM_ID" >
            @csrf
            <select class="_filter" name="filter" onchange="this.form.submit()">
                <option disabled selected>Select an option</option>
                <option value="name_asc">Name ascend</option>
            </select>    

            <br> 
            <b>Name</b><br> 
            <input type="text" placeholder="Enter Restaurant Name" name="name" required><br>
            
            <b>Address</b><br> 
            <input type="text" placeholder="Enter Restaurant Address" name="address" required><br>
            
            <b>Bank Account</b><br> 
            <input type="text" placeholder="Enter Restaurant Bank Account"name="psw" required> 
            <br><br> 
            <button type="submit" class="registerbtn"> 
                                              Register</button>   
        </form>
        
    </div>
    
@endsection