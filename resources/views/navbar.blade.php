<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/address"><img height="45" width="45" src="/img/justeat.png" alt="">
        Eat & Go</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link border-down" href="/restaurants">Restaurants <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link border-down" href="/about">About us</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link border-down" href="/contact">Contact</a>
        </li>
      </ul>    
      <ul class="nav navbar-nav navbar-right">
            @if(Auth::check())
                    @if(Auth::user()->isAdminApp())
                        <li class="nav-item">
                            <a class="nav-link" href="/addRestaurants">Add restaurants</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Log out</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href='/login'>Log in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href='/register'>Sign up</a>
                    </li>
                @endif
      </ul>
    </div>
</nav>
