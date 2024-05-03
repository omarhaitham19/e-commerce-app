@extends('admin.layout')

@section('body')
@include('success')

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

            <div class="card mt-3">
                <div class="card-body">
                    <h3>Order Information</h3>
                    <p><strong>Total Amount:</strong> {{ $order->amount }}L.E</p>
                    <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                    <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
                    <p><strong>Delivery Status:</strong> {{ $order->delivery_status }}</p>
                    <p><strong>Order Date:</strong> {{ $order->created_at }}</p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h3>Products</h3>
                    <div class="row">
                        @foreach ($details as $detail)
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <img src="{{asset("storage/".$detail->product->image) }}" class="card-img-top" alt="{{ $detail->product->name }}" style="max-width: 200px; max-height: 200px;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $detail->product->name }}</h5>
                                    <p class="card-text">Quantity: {{ $detail->product_quantity }}</p>
                                    <p class="card-text">Amount: {{ $detail->amount }}L.E</p>
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

@endsection
