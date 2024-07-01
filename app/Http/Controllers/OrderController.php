<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\ProductCart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        $user_id = Auth()->user()->id;  // Ensure you use parentheses after user()
        $orders = Order::with('order_history.product')->where('user_id', $user_id)->get();

        return view("order.index", ["orders" => $orders]);
    }

    public function create($user_id, $cart_id, $totalPrice) 
    {
        // Create a new order
        $order = Order::create([
            'user_id' => $user_id,
            'amount' => $totalPrice,
            'status' => 'pending', // Assuming default status is 'pending'
            'date' => now()->toDateString(),
        ]);

        // Retrieve all products from the cart
        $cartProducts = ProductCart::where('cart_id', $cart_id)->get();

        // Create order history entries
        foreach ($cartProducts as $productCart) {
            OrderHistory::create([
                'order_id' => $order->id,
                'product_id' => $productCart->product_id,
                'quantity' => $productCart->quantity,
            ]);
        }

        // Flash a success message to the session
    session()->flash('success', "Order created successfully! Order ID: " . $order->id);

    // Redirect back to the same page or to a specific route
    return redirect()->back();
    }
}
