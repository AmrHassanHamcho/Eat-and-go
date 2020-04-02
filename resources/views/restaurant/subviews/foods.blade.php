<div class="food-info">
    <ul class="food-list">
        <form method="post" action="/addfood/{{ $restaurant->id }}">
            @csrf
            @forelse($restaurant->foods as $food)                
                <div class="food">
                    <li>
                        {{ $food->name }}: {{ $food->price }} € <br>
                        <span class="food-description">{{ $food->description }}</span>
                    </li>                    
                <button type="submit" name="food_id" value={{ $food->id }} formaction="/editFood/{{ $restaurant->id }}&{{ $food->id }}">Edit</button>
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
</div>

<div class="food-form">
    <h4>Create new foods.</h4>
    @include('error-list')
    <form method="post" action="/editFood/{{ $restaurant->id }}&{{ 0 }}">
        @csrf            
        <input type="hidden" name="food_id" value=0>

        <div class="form-group">
            <label>Name</label>        
            <input type="text" name="name" placeholder="Insert name..." class="form-control">
        <div>

        <div class="form-group">
            <label>Description</label>
            <input type="text" name="description" placeholder="Insert description..." class="form-control">
        </div>

        <div class="form-group">
            <label>Price (€)</label>
            <input type="text" name="price" placeholder="Insert price..." class="form-control">
        </div>
        <div class="form-group btn">
            <button type="submit" class="edit-food-btn create" name="food-btn" value="create">Create</button>
        </div>
    </form>
</div>