@extends('admin.layout')

@section('body')
@include('error')
<form method="POST" action="{{url("categories/update/$category->id}")}}">
    @csrf
    <div class="form-group">
      <label for="1">Category Name</label>
      <input type="text" class="form-control" required id="1" name="name" value="{{$category->name}}"  placeholder="Enter category name">
    </div>
    <div class="form-group">
        <label for="2">Category Description</label>
        <textarea type="text" class="form-control" required name="desc"  id="2" placeholder="Enter category description" >{{$category->desc}}</textarea>
    </div> 
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
@endsection