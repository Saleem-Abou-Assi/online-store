<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("This is Cart Page!") }}
                    <x-nav-link :href="route('cart.index', ['user_id' => Auth::user()->id])">
                        {{ __('View Cart') }}
                    </x-nav-link>
                </div>
                <div class=" w-full">
                    <table class="w-full table-auto text-left text-white">
                        <thead>
                            <tr class="text-left">
                                <th>Product Name</th>
                                <th>Price </th>
                                <th>Quantity</th>
                                <th>Added At</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                           
                            @php
                                $totalPrice = 0;
                                $sentProductCart = null;
                            @endphp
                        
                            @forelse ($carts as $cart) 
                            
                                @if ($cart->user_id == Auth::user()->id)
                               @php
                                   $sentProductCart = $cart->id;
                               @endphp
                                    <td>
                                        @foreach ($cart->product_cart as $productcart) <tr>
                                            <td>{{ $productcart->product->title }}</td>
                                            <td>{{ $productcart->product->price }}</td>
                                            <td>{{ $productcart->quantity }}</td>
                                            <td>{{ $cart->created_at }}</td>
                                            
                                            @php
                                            
                                             $totalPrice +=$productcart->quantity*$productcart->product->price 
                                              
                                            @endphp
                                           
                                            <td>
                                                <!-- Delete Button -->
                                                <form method="POST" action="{{ route('cart.destroy', $productcart->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('cart.index', ['user_id' => Auth::user()->id]) }}" class="mt-4">
                                                        <x-danger-button>
                                                            {{ __('Delete') }}
                                                        </x-danger-button>
                                                    </a>
                                                </form>
                                            </td>
                                        @endforeach</tr>
                                       
                                    </td>
                                @endif
                            
                            @empty
                            <tr>
                                <td colspan="5">No carts found</td>
                            </tr>
                            @endforelse
                        </tbody>
                        
                    </table>
                    <tr><div class="p-6 text-gray-900 dark:text-gray-100">
                        <div>
                            <strong>Total Price: </strong> ${{ $totalPrice }}
                        </div>
                       
                        <form action="{{ route('order.create',['user_id'=>Auth::user()->id,'cart_id'=>$sentProductCart,'totalPrice'=>$totalPrice]) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Place Order
                            </button>
                        </form>
                    </div>
                </tr>


                </div>
            </div>
</x-app-layout>