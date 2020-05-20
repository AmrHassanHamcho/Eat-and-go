@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="container mt-0">
        <h1 class="display-4">Welcome to our page!</h1>
        <hr class="my-4">
        <p>Here you will find loads of different options to satisfy your appetite!</p>
        <p class="lead">
        <a class="btn btn-primary btn-lg" href="/address" role="button">See more</a>
        </p>
  </div>
@endsection