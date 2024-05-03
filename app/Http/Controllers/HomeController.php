<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect(){
        if (Auth::user()->status == "active") {
            if (Auth::user()->type == "admin") {
                return view('admin.home');
            }elseif(Auth::user()->type == "customer" ) {               
                return view('customer.home');
            }
        }else{
            Auth::logout();
            return redirect()->back();
        }
    }

}
