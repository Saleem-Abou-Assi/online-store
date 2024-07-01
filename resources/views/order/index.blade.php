<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("This is the Orders Page!") }}
                </div>
                <div class="w-full">
                    <table class="w-full table-auto text-left text-white">
                        <thead>
                            <tr class="text-left">
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                            @if ($order->user_id == Auth()->user()->id)
                                
                            
                                @foreach ($order->order_history as $item)
                                    <tr>
                                        <td>{{ $item->product->title }}</td>
                                        <td>${{ number_format($item->price, 2) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                    </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="4">No orders found</td>
                                </tr>
                                @endif
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
