<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <style>
      /* Additional custom styles */
      .product-item {
          margin-bottom: 30px;
          border: 1px solid #ddd;
          padding: 20px;
      }
      .product-item img {
          max-width: 100%;
          height: auto;
      }
      .remove-button {
          font-size: 12px; /* Decrease the size of the remove button */
      }
      .empty-cart-container {
          text-align: center;
          max-width: 50%;
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
      }
      .proceed-to-order-container {
          display: flex;
          justify-content: center;
          margin-top: 20px; /* Adjust the margin as needed */
      }
      .proceed-to-order-btn {
          padding: 10px 20px;
          background-color: #007bff;
          color: #fff;
          border: none;
          border-radius: 5px;
          font-size: 16px;
          cursor: pointer;
          transition: background-color 0.3s ease;
      }
      .proceed-to-order-btn:hover {
          background-color: #0056b3;
      }
      /* CSS for button container */
      .button-container {
    display: flex;
    justify-content: space-between; /* Align buttons horizontally with space between */
    align-items: center; /* Center buttons vertically */
}

/* CSS for Details button */
.details-button,
.cancel-button {
    padding: 8px 7px; /* Adjust padding to decrease space */
    border-radius: 4px;
    font-size: 14px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.details-button {
    background-color: #28a745;
    color: #fff;
}

.cancel-button {
    background-color: #dc3545;
    color: #fff;
}

/* Hover states */
.details-button:hover {
    background-color: #218838;
}

.cancel-button:hover {
    background-color: #c82333;
}
  </style>
  
</head>
<body>
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
              <li class="nav-item ">
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
              <li class="nav-item active">
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

    @if ($orders->isEmpty())
    <div class="empty-cart-container">
      @include('success')
      @include('error')
        <img src="assets/images/empty_cart.png" alt="" class="empty-cart-image">
        <p>No orders yet</p>
    </div>
    @else
    <div class="page-heading products-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>My Orders </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                  @include('error')
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Amount</th>
                                    <th>Payment Status</th>
                                    <th>Delivery Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                                              
                                @foreach ($orders as $order)
                                <tr>
                                  <td>{{$loop->iteration}}</td>
                                  <td>{{$order->amount}} L.E</td>
                                    <td>{{$order->payment_status}}</td>
                                    <td>{{$order->delivery_status}}</td>
                                    <td>{{$order->created_at}}</td>
                                    <td class="button-container">
                                      <a href="{{url("order/details/$order->id")}}" class="details-button">Details</a>
                                  </td>                                                                                            
                                  </tr>
                                @endforeach
                            </tbody>
                            <tfoot>                           
                            </tfoot>
                        </table>
                    @endif
                </div>
            </div>
            {{$orders->links()}}

        </div>
    </div>

    <footer>
        <!-- Footer content -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>
</body>
</html>
