<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe;

class OrderController extends Controller
{
    
    public function stripe(Request $request){
        $totalPrice = $request->totalPrice;
        return view('customer.stripe')->with("totalPrice" , $totalPrice);
    }


    public function stripePost(Request $request ,  $totalPrice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalPrice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "thanks for payment" 
        ]);

        $userID = Auth::user()->id;
        $amount = $totalPrice; 

        
        DB::beginTransaction();

        try {

            $order = Order::create([
                'amount' => $amount,
                'payment_status' => 'paid',
                'payment_method' => "card",
                'user_id' => $userID
            ]);

            $orderID = $order->id;

            $cartItems = Cart::where('user_id', $userID)->get();

            foreach ($cartItems as $cartItem) {
                OrderProduct::create([
                    'product_quantity' => $cartItem->quantity,
                    'amount' => $cartItem->price,
                    'product_id' => $cartItem->product_id,
                    'order_id' => $orderID
                ]); 

            }

            Cart::where('user_id', $userID)->delete();

            DB::commit();
            session()->flash('success', 'Payment successful!');             
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash("error" ,'Failed to place order. Please try again.');
            return redirect()->back();
        }
    }


    public function makeOrder(Request $request)
    {

        $userID = Auth::user()->id;
        $amount = $request->totalPrice; 

        
        DB::beginTransaction();

        try {

            $order = Order::create([
                'amount' => $amount,
                'user_id' => $userID
            ]);

            $orderID = $order->id;

            $cartItems = Cart::where('user_id', $userID)->get();

            foreach ($cartItems as $cartItem) {
                OrderProduct::create([
                    'product_quantity' => $cartItem->quantity,
                    'amount' => $cartItem->price,
                    'product_id' => $cartItem->product_id,
                    'order_id' => $orderID
                ]); 

            }

            Cart::where('user_id', $userID)->delete();

            DB::commit();
            session()->flash('success' , 'Order placed successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash("error" ,'Failed to place order. Please try again.');
            return redirect()->back();
        }
    }

    public function displayOrdersToCustomer(){
        $userID = Auth::user()->id;
        $orders = Order::where("user_id" , $userID)->where("delivery_status" , "undelivered")->orWhere("delivery_status" , "delivered")->latest()->paginate(5);
        return view('customer.display_orders' , compact("orders"));
    }

    public function showOrderDetailsToCustomer($id){
        $order = Order::FindOrFail($id);
        $details = OrderProduct::where("order_id" , $id)->get();
        return view('customer.show_order' , compact("details"));
    }

    
    public function viewOrders(){
        $orders = Order::orderByRaw("delivery_status = 'undelivered' desc, created_at asc")
        ->paginate(10);
        return view('admin.orders', compact('orders'));
    }

    public function searchOrder(Request $request){
        $request->validate([
            'search' => 'required|string|email',
        ]);
        $email = $request->search;
        $user = User::where("email", "like", "%$email%")->first();
        if ($user) {
            $customerID = $user->id;
            $orders = Order::where("user_id", $customerID)->paginate(10);
            return view('admin.orders', compact("orders"));
        }else{
            $orders = Order::orderByRaw("delivery_status = 'undelivered' desc, created_at asc")
            ->paginate(10);
            return view('admin.orders', compact('orders'));
        } 
    }

    public function showOrder($id){
        $order = Order::FindOrFail($id);
        $details = OrderProduct::where("order_id" , $id)->get();
        return view('admin.show_order' , compact("details" , "order")); 
    }

    public function delivered($id){
        $order = order::FindOrFail($id);
        $order->delivery_status = "delivered";
        $order->payment_status = "paid";
        $order->save();
        return redirect()->back();
    }

    public function printPDF($id){
        $order = Order::FindOrFail($id);
        $details = OrderProduct::where("order_id" , $id)->get();
        $pdf = PDF::loadView('admin.pdf',compact("order" , "details"));
        return $pdf->download('order_details.pdf');
    }

}
