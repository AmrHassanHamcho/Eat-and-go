<nav class="_navbar">
    
        <a class="logo" href="/address">
            <img src="/img/justeat.png" alt="">
            Eat & Go
        </a>
        <ul class="">
            <li><a href="/restaurants">Restaurants</a></li>
            <li><a href="/about">About us</a></li>
            <li><a href="/contact">Contact</a></li>
            @if(Auth::check())
                @if(Auth::user()->isAdminApp())
                    <li><a href="/addRestaurants">Add restaurants</a></li>
                @endif
                <li><a href="/logout">Log out</a></li>
            @else
                <li><a href='/login'>Log in</a></li>
                <li><a href='/register'>Sign up</a></li>
            @endif
        </ul>  
        
       
    
</nav>