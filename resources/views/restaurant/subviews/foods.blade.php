<ul class="food-list">
    <form method="post" action="/addfood/{{ $restaurant->id }}">
        @csrf
        @forelse($restaurant->foods as $food)                
            <div class="food">
                <li>
                    {{ $food->name }}: {{ $food->price }} € <br>
                    <span class="food-description">{{ $food->description }}</span>
                </li>                    
                <button type="submit" name="food_id" value={{ $food->id }}>+</button>                  
            </div>                  
        @empty            
            <li class="food"> The restaurant {{ $restaurant->name }} does not have foods available right now. </li>
        @endforelse
    </form>
</ul>

<div class="restaurant-order">          
    <form method="post" action="/removefood/{{ $restaurant->id }}">
        @csrf
        <div class="order">
            <ul>
                @forelse($order->orderlines as $orderline)                
                    <ul class="total-price">
                    <button class="remove-button" type="submit" name="food_id" value={{ $orderline->food->id }}>-</button>
                    <li class="orderline">{{ $orderline->quantity }}x {{ $orderline->food->name }}</li>
                        <li class="price-number">{{ $orderline->total_price }} €</li>
                    </ul>                        
                @empty            
                    <li class="no-food-selected">No food selected.</li>
                @endforelse                
            </ul>

            <ul class="total-price final">
                <li>Total</li>
                <li class="price-number">{{ $order->total_price }} €</li>
            </ul>
        </div>
    <button class="buy-button" formaction="/summary/{{ $restaurant->id }}">BUY</button>
    </form>
</div>