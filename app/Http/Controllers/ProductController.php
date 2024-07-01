<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Product;

class ProductController extends Controller
{
    
    public function index()
    {if (! Gate::allows('show-product')) {
        abort(403);
    }
        $products = Product::all();
        return view("product.index", ["products" => $products]);
    }

    public function create(): View
    {
        if (! Gate::allows('create-product')) {
            abort(403);
        }
        return view('product.create');
    }

    public function store(Request $request): RedirectResponse
    {
        if (! Gate::allows('create-product')) {
            abort(403);
        }
        $request->validate([
            'title' => ['required', 'string', 'max:20'],
            'description' => ['required', 'string', 'max:300'],
            'price'=>['required','integer'],
            'image'=>['required', 'string'],
        ]);

        $product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->image,
            
        ]);



        return redirect(route('product.index', absolute: false));
    }
    public function show(string $id): View
    {
        if (! Gate::allows('show-product')) {
            abort(403);
        }
        $product = Product::findOrFail($id);

        return view('product.show', [
            'product' => $product,
        ]);
    }
    
    public function edit(string $id): View
    {
        if (! Gate::allows('update-product')) {
            abort(403);
        }
        $product = product::findOrFail($id);
        return view('product.create', [
            'product' => $product,
        ]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        if (! Gate::allows('update-product')) {
            abort(403);
        }
        $product = Product::findOrFail($id);

        
        $request->validate([
            'title' => ['required', 'string', 'max:20'],
            'description' => ['required', 'string', 'max:300'],
            'price'=>['required','integer'],
            'img'=>['required', 'string'],
            
        ]);

        $product::update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->image,
        ]);

        return redirect(route('product.index', absolute: false));
    }

    public function destroy(string $id): RedirectResponse
    {
        if (! Gate::allows('delete-product')) {
            abort(403);
        }
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect(route('product.index', absolute: false))->with('success', 'Product deleted successfully');
    }
}
