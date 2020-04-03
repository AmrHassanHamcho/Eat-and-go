@extends('app')

@section('title', 'Login')
@section('css-stylesheet', 'css/user.css')
@section('css-stylesheet', 'css/restaurant.css')

@section('content')    
    <br />
    <div class="container box">
        <h3 align="center">Login</h3><br />

        {{-- @if ($message = Session::get('error'))
            <div class="error-list">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
         @endif --}}

        @include('error-list')

        <form method="post" action="/checklogin">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" />
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" />
            </div>

            <div class="form-group">
                <input type="submit" name="login" class="btn btn-primary" value="Login" />
            </div>
        </form>
        <div class="container">
            <div class = "row">
                <div class = "col-sem">
                    Don't have an accout? <a href="{{url('/register')}}">sign up here</a>  <br>
                    {{-- By creating an account, you agree to our <a href="">terms and conditions</a> .<br>
                    Please read our <a href="">private policy</a> and <a href="">cookies policy</a>. --}}
                </div>
            </div>
        </div>
    </div>  
@endsection