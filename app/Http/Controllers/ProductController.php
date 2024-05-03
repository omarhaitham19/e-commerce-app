<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    function __construct()
    {
        $this->middleware(['permission:all-products'], ['only' => ['all']]);
        $this->middleware(['permission:show-products'], ['only' => ['show']]);
        $this->middleware(['permission:add-products'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit-products'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-products'], ['only' => ['delete']]);
    }


    public function all(){
        $products = Product::orderBy('id', 'desc')->paginate(5);
        return view('admin.allProducts')->with("products" , $products);
    }

    public function search(Request $request){
        $validatedData = $request->validate([
            "key" => "string|required"
        ]);
    
        $key = $validatedData['key']; 
    
        $products = Product::where("name" , "like" , "%$key%")->paginate(5);
        
        if ($products->isNotEmpty()) {
            return view('admin.allProducts', compact("products"));
        } else {
            $products = Product::orderBy('id', 'desc')->paginate(5);
            return view('admin.allProducts')->with("products", $products);
        }
    }

    public function show($id){
        $product = Product::FindOrFail($id);
        return view('admin.show')->with("product" , $product);
    }

    public function create(){
        $categories = Category::all();
        return view('admin.create' , compact("categories"));
    }

    public function store(Request $request){
        $data = $request->validate([
            "name"=>"required|string|max:255",
            "desc"=>"string|nullable",
            "price"=>"required|numeric",
            "discount_price"=>"numeric|nullable",
            "quantity"=>"required|numeric",
            "image"=>"required|image|mimes:jpg,jpeg,png",
            "category_id"=>"required|exists:categories,id"
        ]);

       $data['image'] = Storage::putFile("products" , $data['image']);
       $data['created_by'] = Auth::user()->email;
       Product::create($data);
       session()->flash("success" , "Product added successfully");
       return redirect(url('products'));
    }

    public function edit($id){
        $categories = Category::all();
        $product = Product::FindOrFail($id);
        return view('admin.edit' , compact("categories" , "product"));
    }

    public function update($id , Request $request){
        $data = $request->validate([
            "name"=>"required|string|max:255",
            "desc"=>"string|nullable",
            "price"=>"required|numeric",
            "discount_price"=>"numeric|nullable",
            "quantity"=>"required|numeric",
            "image"=>"image|mimes:jpg,jpeg,png",
            "category_id"=>"required|exists:categories,id"
        ]);

        $product = Product::FindOrFail($id);

        if ($request->has("image")) {
            Storage::delete($product->image);
            $data['image'] = Storage::putFile("products" , $data['image']);
        }

        $product->update($data);
        session()->flash("success" , "product updated successfully");
        return redirect(url("products/show/$product->id"));
    }

    public function delete($id){
        $product = Product::FindOrFail($id);
        Storage::delete($product->image);
        $product->delete();
        session()->flash("success" , "Product deleted successfully");
        return redirect(url('products'));
    }
}
