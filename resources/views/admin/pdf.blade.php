<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .card {
            margin-bottom: 20px;
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .card-text {
            margin-bottom: 5px;
        }
        .card img {
            max-width: 200px;
            max-height: 200px;
            margin-bottom: 10px;
        }
        .row {
            margin-right: -15px;
            margin-left: -15px;
        }
        .col-md-4 {
            width: 33.33333333%;
            float: left;
            padding-right: 15px;
            padding-left: 15px;
            margin-bottom: 20px; /* Add margin to create space between product cards */
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Order Details</h1>
                <div class="card">
                    <div class="card-body">
                        <h3>Customer Information</h3>
                        <p><strong>Name:</strong> {{ $order->user->name }}</p>
                        <p><strong>Phone:</strong> {{ $order->user->phone }}</p>
                        <p><strong>Email:</strong> {{ $order->user->email }}</p>
                        <p><strong>Address:</strong> {{ $order->user->address }}</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h3>Order Information</h3>
                        <p><strong>Total Amount:</strong> {{ $order->amount }} L.E</p>
                        <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                        <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
                        <p><strong>Delivery Status:</strong> {{ $order->delivery_status }}</p>
                        <p><strong>Order Date:</strong> {{ $order->created_at }}</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h3>Products</h3>
                        <div class="row clearfix">
                            @foreach ($details as $detail)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $detail->product->name }}</h5>
                                        <p class="card-text">Quantity: {{ $detail->product_quantity }}</p>
                                        <p class="card-text">Amount: {{ $detail->amount }} L.E</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
