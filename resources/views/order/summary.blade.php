@extends('app')

@section('title', 'Order summary')
@section('css-stylesheet', asset('css/restaurant.css'))

@section('content')

<div class="summary">
    <div class="restaurant">
        <h2>Order summary</h2>    
        <div class="restaurant-order col-12 col-lg-8">          
            <form method="post" action="/thanks">
                @csrf
                <div class="order">
                    <ul>
                        @foreach($order->orderlines as $orderline)                
                            <ul class="total-price">                    
                                <li class="orderline">{{ $orderline->quantity }}x {{ $orderline->food->name }}</li>
                                <li class="price-number">{{ $orderline->total_price }} €</li>
                            </ul>                                        
                        @endforeach
                    </ul>

                    <ul class="total-price final">
                        <li>Total</li>
                        <li class="price-number">{{ $order->total_price }} €</li>
                    </ul>
                </div>
                <button class="buy-button" type="submit" onclick="thanks()">BUY</button>
            </form>
            <div id="success" style="display: none" class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> Your order is going to your address!
            </div>
        </div>
    </div>
</div>

<script>
    function thanks() {
        var x = document.getElementById("success");
        if (x.style.display === "none") {
            x.style.display = "block";
        }
    }
</script>

@endsection