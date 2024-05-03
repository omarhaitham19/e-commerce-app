<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{

    public function index(){
        return view('customer.home');
    }

    public function all(){
        $products = Product::Latest()->where("quantity" , ">" , "0")->paginate(9);
        return view('customer.our_products')->with("products" , $products);
    }

    public function show($id){
        $product = Product::FindOrFail($id);
        return view('customer.show')->with("product" , $product);
    }

    public function search(Request $request){
        $validatedData = $request->validate([
            "key" => "string|required"
        ]);
    
        $key = $validatedData['key']; 
    
        $products = Product::where("name" , "like" , "%$key%")->where("quantity", ">", 0)->paginate(9);
        
        if ($products->isNotEmpty()) {
            return view('customer.our_products', compact("products"));
        } else {
            $products = Product::latest()->where("quantity", ">", 0)->paginate(9);
            return view('customer.our_products')->with("products", $products);
        }
    }

    
}
