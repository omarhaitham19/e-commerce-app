@extends('customer.layout')
@section('latest')
<div class="latest-products">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2></h2>
            <a href="{{url('allProducts')}}">view all products <i class="fa fa-angle-right"></i></a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="product-item">
           <img src="assets/images/mobile.jpg" width="70px" height="300px" alt=""> 
            <div class="down-content">
              <h4>Electronics</h4>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="product-item">
           <img src="assets/images/mobile.jpg" width="70px" height="300px" alt=""> 
            <div class="down-content">
              <h4>Electronics</h4>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="product-item">
           <img src="assets/images/mobile.jpg" width="70px" height="300px" alt=""> 
            <div class="down-content">
              <h4>Electronics</h4>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection