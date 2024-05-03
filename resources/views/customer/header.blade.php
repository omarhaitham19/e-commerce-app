<header class="">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="{{url('/')}}"><h2>Sixteen <em>Clothing</em></h2></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link active" href="{{url('/')}}">Home
              </a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="{{url('allProducts')}}">Our Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('about')}}">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('contact')}}">Contact</a>
            </li>
            @guest
            <li class="nav-item">
              <a class="nav-link" href="{{route('login')}}">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('register')}}">Register</a>
            </li>
            @endguest
            @auth
            <li class="nav-item">
              <a class="nav-link" href="{{url('showCart')}}">Cart</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('displayOrder')}}">Orders</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('profile.show')}}">Profile</a>
            </li>     
            <form action="{{ route('logout') }}" method="post">
              @csrf
              <li class="nav-item">
                  <a class="nav-link" style="cursor: pointer;" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
              </li>
          </form>          
            @endauth
          </ul>
        </div>
      </div>
    </nav>
  </header>