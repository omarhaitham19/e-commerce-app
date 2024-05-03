<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiProductController extends Controller
{
    public function all(){
        $products = Product::all();
        if ($products === null) {
            return response()->json([
                "msg"=>"products not found!"
            ],404); 
        }
        return ProductResource::collection($products);
    }

    public function show($id){
        $product = Product::find($id);

        if ($product === null) {
            return response()->json([
                "msg"=>"product not found!"
            ],404);
        }
        return new ProductResource($product);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all() , [
            "name"=>"required|string|max:255",
            "desc"=>"required|string",
            "price"=>"required|numeric",
            "quantity"=>"required|numeric",
            "image"=>"required|image|mimes:jpg,jpeg,png",
            "category_id"=>"required|exists:categories,id"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "errors"=>$validator->errors()
            ],301);
        }

        $ImageName = Storage::putFile("products" , $request->image);

        Product::create([
            "name"=>$request->name,
            "desc"=>$request->desc,
            "price"=>$request->price,
            "quantity"=>$request->quantity,
            "image"=>$ImageName,
            "category_id"=>$request->category_id
        ]);

        return response()->json([
            "msg"=>"product added successfully"
        ],201);
    }

    public function update(Request $request , $id){
        $validator = Validator::make($request->all() , [
            "name"=>"required|string|max:255",
            "desc"=>"required|string",
            "price"=>"required|numeric",
            "quantity"=>"required|numeric",
            "image"=>"image|mimes:jpg,jpeg,png",
            "category_id"=>"required|exists:categories,id"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "errors"=>$validator->errors()
            ],301);
        }

        $product = Product::find($id);

        if ($product === null) {
            return response()->json([
                "msg"=>"product not found!"
            ],404);
        }

        $ImageName = $product->image;

        if ($request->has("image")) {
            Storage::delete($ImageName);
            $ImageName = Storage::putFile("products" , $request->image);
        }

        $product->update([
            "name"=>$request->name,
            "desc"=>$request->desc,
            "price"=>$request->price,
            "quantity"=>$request->quantity,
            "image"=>$ImageName,
            "category_id"=>$request->category_id
        ]);

        return response()->json([
            "msg"=>"product updated successfully"
        ],201);

    }

    public function delete($id){
        $product = Product::find($id);

        if ($product === null) {
            return response()->json([
                "msg"=>"product not found!"
            ],404);
        }

        if ($product->image !== null) {
            Storage::delete($product->image);
        }

        $product->delete();

        return response()->json([
            "success"=>"product deleted successfully"
        ],200);
    }
}
