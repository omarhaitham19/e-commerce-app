@extends('admin.layout')

@section('body')
@include('error')
<form method="POST" action="{{url('products')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="1">Product Name</label>
      <input type="text" class="form-control" required id="1" name="name" value="{{old('name')}}"  placeholder="Enter product name">
    </div>
    <div class="form-group">
        <label for="2">Product Description</label>
        <textarea type="text" class="form-control"  name="desc"  id="2" placeholder="Enter product description" >{{old('desc')}}</textarea>
    </div>
      <div class="form-group">
        <label for="3">Product Price</label>
        <input type="number" name="price" required value="{{old('price')}}" class="form-control" id="3"  placeholder="Enter product price">
      </div>
      <div class="form-group">
        <label for="3">Discount Price</label>
        <input type="number" name="discount_price" value="{{old('discount_price')}}" class="form-control" id="3"  placeholder="Enter discount price">
      </div>
      <div class="form-group">
        <label for="4">Product Quantity</label>
        <input type="text" name="quantity" required value="{{old('quantity')}}" class="form-control" id="4" placeholder="Enter product quantity">
      </div>
      <div class="form-group">
        <label for="5">Product Image</label>
        <input type="file" name="image" required class="form-control" id="5"  >
      </div>
      <div class="form-group">
        <label for="6">category</label>
        <select name="category_id" required id="6">
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection