<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\ProductCart;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    public function index($user_id)
    {

        $carts = Cart::with('product_cart.product')->get();

        return view("cart.index", ["carts" => $carts]);
    }
    public function add(Request $request)
{
    $productId = $request->input('product_id');
    // Logic to add the product to the cart
    // Redirect to a relevant page or back to the product list
    return back()->with('success', 'Product added to cart successfully!');
}
public function destroy(string $id): RedirectResponse
    {
        $productcart = ProductCart::findOrFail($id);
        $productcart->delete();

        return redirect(route('cart.index', absolute: false))->with('success', 'Product deleted successfully');
    }
}
