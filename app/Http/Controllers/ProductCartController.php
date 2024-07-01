<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCart;

class ProductCartController extends Controller
{
    public function add($product_id,$user_id)
    { 
       
        $cart = Cart::firstOrCreate(
            ['user_id' => $user_id],
            ['date' => now()]  
        );
        
        

        $productcart = ProductCart::where('product_id', $product_id)
        ->where('cart_id', $cart->id)
        ->first();

        if ($productcart) {
                // If product exists, increment the quantity
             $productcart->increment('quantity');
                } 
        else {
             // If product does not exist, create it with quantity set to 1
            $productcart = ProductCart::create([
            'product_id' => $product_id,
            'cart_id' => $cart->id,
            'quantity' => 1,
        ]);
        }
      // Add a flash message to the session
    session()->flash('success', 'Product added to cart successfully');

    // Assuming you want to stay on the same page, you can redirect back
    return back();
    }
}
