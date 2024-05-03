@extends('admin.layout') 

@section('body')
@include('success')
<div class="col-lg-12 margin-tb mb-4">
  <div class="pull-left">
      <li class="nav-item w-100">
          <form method="GET" action="{{ url('/searchProduct') }}" class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
            <input type="text" name="key" class="form-control" required placeholder="Search for a Product">
            <button class="btn btn-primary">Search</button>
          </form> 
        </li>
      </div>
</div>
<table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th> Product Name </th>
        <th> Product Price </th>
        <th> Product Quantity </th>
        <th> Product Image </th>
        <th> Actions </th>
      </tr>
    </thead>
    <tbody>
        @foreach ($products as $product) 
      <tr>
        <td>{{$loop->iteration}}</td>
        <td> {{$product->name}}</td>
        <td> {{$product->price}} </td>
        <td> {{$product->quantity}} </td>
        <td>
            <img src="{{asset("storage/$product->image")}}" alt="" srcset="">
        </td>
        <td>
          @can('show-products')
          <a href="{{url("products/show/$product->id")}}"> <div class="btn btn-info">Show</div></a>
          @endcan
          @can('edit-products')              
          <a href="{{url("products/edit/$product->id")}}"> <div class="btn btn-success">Edit</div></a> 
          @endcan
          @can('delete-products')      
          <form action="{{url("products/delete/$product->id")}}" method="post" class = "my-3">
              @csrf
            <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            @endcan
          </td>
      </tr>
      @endforeach

    </tbody>
  </table>
  {{$products->links()}}
@endsection