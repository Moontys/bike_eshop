{{-- <nav> --}}

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">Steg Beetle</a>
      
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">

          <li class="nav-item active"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
          <li class="nav-item active"><a href="{{ url('/shop') }}" class="nav-link">Shop</a></li>
          <li class="nav-item cta cta-colored"><a href="{{ url('/cart') }}" class="nav-link"><span class="icon-shopping_cart"></span>[{{ Session::has('cart') ? Session::get('cart')->totalQty : 0 }}]</a></li>
          
          @if (Session::has('client'))
            <li class="nav-item active"><a href="{{url('/log-out')}}" class="nav-link"><span class="fa fa-user"></span>Log Out</a></li>
          @else
            <li class="nav-item active"><a href="{{url('/login')}}" class="nav-link"><span class="fa fa-user"></span>Log In</a></li>
          @endif

        </ul>
      </div>
    </div>
</nav>