<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "name" , "desc" , "price" , "image" , "quantity" , "category_id" , "discount_price" , "created_by"
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function carts()
    {
        return $this->belongsToMany(User::class, 'carts' , 'product_id' , 'user_id')->withPivot('quantity', 'price');
    }     

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product', 'product_id', 'order_id')->withPivot('quantity', 'amount');
    }
}
