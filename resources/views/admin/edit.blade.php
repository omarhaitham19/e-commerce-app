@extends('admin.layout')

@section('body')
@include('error')
<form method="POST" action="{{url("products/update/$product->id")}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="1">Product Name</label>
      <input type="text" class="form-control" value="{{$product->name}}" id="1" name="name"  placeholder="Enter product name">
    </div>
    <div class="form-group">
        <label for="2">Product Description</label>
        <textarea type="text" class="form-control"  name="desc" id="2" placeholder="Enter product description" >{{$product->desc}}</textarea>
    </div>
      <div class="form-group">
        <label for="3">Product Price</label>
        <input type="number" name="price" class="form-control" value="{{$product->price}}" id="3"  placeholder="Enter product price">
      </div>
      <div class="form-group">
        <label for="10">Discount Price</label>
        <input type="number" name="discount_price" class="form-control" value="{{$product->discount_price}}" id="10"  placeholder="Enter discount price">
      </div>
      <div class="form-group">
        <label for="4">Product Quantity</label>
        <input type="text" name="quantity" class="form-control" value="{{$product->quantity}}" id="4" placeholder="Enter product quantity">
      </div>
      <div class="form-group">
        <label for="5">Product Image</label>
        <input type="file" name="image" class="form-control" id="5">
        <img src="{{asset("storage/$product->image")}}"height="100px" width ="100px" alt="" srcset="">
      </div>
      <div class="form-group">
        <label for="6">category</label>
        <select name="category_id" id="6">
          <option value="{{$product->category_id}}">{{$product->category->name}}</option>
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection