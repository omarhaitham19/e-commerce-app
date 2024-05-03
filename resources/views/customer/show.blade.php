<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
  <style>
        /* Custom CSS for enhancements */
        .product-image {
            max-width: 100%;
            height: 300px; /* Fixed height */
            width: auto; /* Set width to auto for maintaining aspect ratio */
            background-color: #f1f1f1; /* Grey background color */
            padding: 10px; /* Add padding for spacing */
        }
        .card {
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}"><h2>Sixteen <em>Clothing</em></h2></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{url('/')}}">Home
            </a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="{{url("allProducts")}}">Our Products</a> 
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
      <div class="container mt-5">
        @include('success')
        @include('error')
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                  
                    <img src="{{asset("storage/$product->image")}}" class="card-img-top product-image" alt="Product Image">
                    <div class="card-body">
                        <h1 class="card-title">{{$product->name}}</h1>
                        <p class="card-text">{{$product->desc}}</p>
                        
                        @if ($product->discount_price !== null)
                        <h6 style="color: red; margin-bottom: 5px;">
                            {{ $product->discount_price }}L.E <span style="text-decoration: line-through; color: gray;">{{ $product->price }}L.E</span>
                        </h6>
                        @else
                        <h6>
                            {{ $product->price }}L.E
                        </h6>
                        @endif     
                        @if ($product->quantity <= 5)
                        <p class="card-text" style="color: red;">Hurry! Limited stock available: {{$product->quantity}} left</p>  
                        @endif
                    
                        <p class="card-text">Category: {{$product->category->name}}</p>
                        
                        <form action="{{url("add_cart/$product->id")}}" method="POST" id="add-to-cart-form">
                          @csrf
                          <div class="row">
                              <div class="col-md-3">
                                  <input type="number" name="quantity" id="quantity" value="1" min="1" style="width: 100px">
                                  <span id="quantity-error" style="color: red; display: none;">Not enough stock available.</span>
                              </div>
                              <div class="col-md-4">
                                  <input type="submit" class="btn btn-primary" value="Add To Cart" id="add-to-cart-btn">
                              </div>
                          </div>
                      </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
  document.getElementById('add-to-cart-form').addEventListener('submit', function(event) {
      var selectedQuantity = parseInt(document.getElementById('quantity').value);
      var availableQuantity = parseInt("{{$product->quantity}}");

      if (selectedQuantity > availableQuantity) {
          event.preventDefault(); // Prevent form submission
          document.getElementById('quantity-error').style.display = 'block';
      } else {
          document.getElementById('quantity-error').style.display = 'none';
      }
  });
</script>

</html>
