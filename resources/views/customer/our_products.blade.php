<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Sixteen Clothing Products</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">

    <style>
      .search-bar {
    background-color: #f8f9fa;
    padding: 20px 0;
}

.search-form {
    display: flex;
    align-items: center;
}

.search-form .form-control {
    flex: 1;
    margin-right: 10px;
}

.search-form .btn {
    background-color: #007bff;
    color: #fff;
    border: none;
}

/* Additional styling as per your design preferences */

    </style>

  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
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
                <a class="nav-link" href="{{url('/')}}">Home
                </a>
              </li> 
              <li class="nav-item active">
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

    <!-- Page Content -->
    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Our Products</h4>
              {{-- <h2>sixteen products</h2> --}}
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <div class="products">
      <div class="container">
        <div class="row">
          @include('success')
          @include('error')
          <div class="col-md-12">
            <div class="filters">
              <ul>
                  <li class="active" data-filter="*">All Products</li>
              </ul>
            </div>
          </div>
<div class="search-bar text-center">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <form action="{{ url('search') }}" method="GET" class="search-form">
                  <div class="input-group">
                      <input type="text" required class="form-control" name="key" placeholder="Search for products...">
                      <div class="input-group-append">
                          <button type="submit" class="btn btn-primary">Search</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

          <div class="col-md-12">
            <div class="filters-content">
                <div class="row grid">
                    @foreach ($products as $product)
                    <div class="col-lg-4 col-md-4 all des">
                        <div class="product-item">
                            <a href="{{ url("products/$product->id") }}">
                              <img style="max-width: 50%; height: auto;" src="{{ asset("storage/$product->image") }}" alt="">
                            </a>
                            <div class="down-content">
                                <a href="{{ url("products/$product->id") }}">
                                    <h4>{{ $product->name }}</h4>
                                </a>
                                @if ($product->discount_price !== null)
                                <h6 style="color: red; margin-bottom: 5px;">
                                    {{ $product->discount_price }}L.E <span style="text-decoration: line-through; color: gray;">{{ $product->price }}L.E</span>
                                </h6>
                                @else
                                <h6>
                                    {{ $product->price }}L.E
                                </h6>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
        {{ $products->links() }}
        </div>
      </div>
    </div>

    
    @include('customer.footer')


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>


    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>


  </body>

</html>
