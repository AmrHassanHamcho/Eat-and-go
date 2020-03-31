<ul class="food-list">
    @forelse($restaurant->foods as $food)                
        <div class="food">
            <li>
                {{ $food->name }} <br>
                <span class="food-description">{{ $food->description }}</span>
            </li>                    
            <button type="button" name={{ "food" . $food->id }}>+</button>  
        </div>             
    @empty            
        <p class="food"> The restaurant {{ $restaurant->name }} does not have foods available right now. </p>
    @endforelse
</ul>

<div class="restaurant-order">            
    <div class="order">
        <ul>
            @forelse($order->orderlines as $orderline)                
                <ul class="total-price">
                    <button class="remove-button" type="button" name={{ "line" . $orderline->id}}>-</button>
                    <li class="orderline">{{ $orderline->food->name }}</li>
                    <li class="price-number">{{ $orderline->total_price }} €</li>
                </ul>                        
            @empty            
                <li class="no-food-selected">No food selected.</li>
            @endforelse                
        </ul>

        <ul class="total-price final">
            <li>Total</li>
            <li class="price-number">50,65 €</li>
        </ul>
    </div>
    <button class="buy-button">BUY</button>
</div>