@extends('admin.layout')

@section('title', 'Product Details')

@section('body')
@include('success')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{$product->name}}</h3>
                    <p class="card-text">{{$product->desc}}</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Price:</strong> {{$product->price}} L.E</li>
                        <li class="list-group-item"><strong>Discount Price:</strong> {{ $product->discount_price !== null ? $product->discount_price . ' L.E' : '0' }}</li>
                        <li class="list-group-item"><strong>Quantity:</strong> {{$product->quantity}}</li>
                        <li class="list-group-item"><strong>Created_by:</strong> {{$product->created_by}}</li>
                    </ul>
                    <div class="text-center mt-3">
                        <img src="{{asset("storage/$product->image")}}" class="img-fluid" alt="Product Image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
