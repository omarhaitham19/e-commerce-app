<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CartController extends Controller
{
    
    public function addCart(Request $request , $id){
        $user_id = Auth::user()->id;
        $product = Product::findOrFail($id);
        $quantity = $request->quantity;

        if ($quantity > $product->quantity) {
        session()->flash("error" , "Selected quantity exceeds available stock.");
        return redirect()->back();
        }

        DB::beginTransaction();

        try {

        $productPrice = ($product->discount_price !== null) ? $product->discount_price * $quantity : $product->price * $quantity;
        Cart::create([
            'price' => $productPrice,
            'quantity' => $quantity,
            'user_id' => $user_id,
            'product_id' => $id
        ]);

        $product->quantity -= $quantity;
        $product->save();

        DB::commit();
        session()->flash("success" , "Product added to your cart");

        return redirect(url('allProducts'));
        } catch (\Exception $e) {
        DB::rollBack();
        session()->flash("error" , 'Failed to add product to cart. Please try again.');

        return redirect()->back();
        }
    }

    public function showCart(){
        $userID = Auth::user()->id;
        $carts = Cart::where('user_id', $userID)->get();
        return view('customer.show_cart', compact('carts'));
    }

    public function removeCart($id){
        $cart = Cart::findOrFail($id);
        
        $product = Product::findOrFail($cart->product_id);
    
        $removedQuantity = $cart->quantity;
    
        $cart->delete();
    
        $product->quantity += $removedQuantity;
        $product->save();
    
        return redirect()->back();
    }

    
}
