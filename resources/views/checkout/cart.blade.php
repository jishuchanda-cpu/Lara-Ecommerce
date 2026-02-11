@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Shopping Cart</h1>

        @if(session('success'))
            <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                <p class="text-sm text-green-700 dark:text-green-300">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                <p class="text-sm text-red-700 dark:text-red-300">{{ session('error') }}</p>
            </div>
        @endif

        @if(count($cartItems) > 0)
            <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-8">
                    <form action="{{ route('cart.update') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                            <div class="p-6 space-y-6">
                                @foreach($cartItems as $item)
                                    <div class="flex gap-4 pb-6 border-b border-gray-200 dark:border-gray-700 last:border-0 last:pb-0">
                                        <!-- Product Image -->
                                        <div class="w-24 h-24 flex-shrink-0 bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden">
                                            @if(!empty($item['product']->images) && isset($item['product']->images[0]))
                                                <img src="{{ asset('storage/' . $item['product']->images[0]) }}" alt="{{ $item['product']->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Product Details -->
                                        <div class="flex-1">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <a href="{{ route('products.show', $item['product']) }}" class="text-lg font-semibold text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400">
                                                        {{ $item['product']->name }}
                                                    </a>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">SKU: {{ $item['product']->sku }}</p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">${{ number_format($item['product']->price, 2) }} each</p>
                                                </div>
                                                
                                                <!-- Remove Button -->
                                                <a href="{{ route('cart.remove', $item['product']->id) }}" 
                                                   onclick="return confirm('Are you sure you want to remove this item?')"
                                                   class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </a>
                                            </div>

                                            <div class="flex justify-between items-center mt-4">
                                                <!-- Quantity Adjuster -->
                                                <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-lg">
                                                    <button type="button" onclick="updateQuantity('{{ $item['product']->id }}', -1)" class="px-3 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-l-lg">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                        </svg>
                                                    </button>
                                                    <input type="number" name="quantities[{{ $item['product']->id }}]" value="{{ $item['quantity'] }}" min="0" max="{{ $item['product']->stock_quantity }}"
                                                           class="w-16 text-center border-0 dark:bg-gray-800 dark:text-white focus:ring-0 p-2"
                                                           onchange="this.form.submit()">
                                                    <button type="button" onclick="updateQuantity('{{ $item['product']->id }}', 1)" class="px-3 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-r-lg">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                        </svg>
                                                    </button>
                                                </div>

                                                <!-- Item Total -->
                                                <p class="text-lg font-semibold text-gray-900 dark:text-white">${{ number_format($item['total'], 2) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 flex justify-between items-center">
                                <a href="{{ route('products.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                    ← Continue Shopping
                                </a>
                                <button type="submit" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                                    Update Cart
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-4 mt-8 lg:mt-0">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 sticky top-24">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Order Summary</h2>
                        
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Subtotal</span>
                                <span class="font-medium text-gray-900 dark:text-white">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            @if($discount > 0)
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Discount</span>
                                <span class="font-medium text-green-600">-${{ number_format($discount, 2) }}</span>
                            </div>
                            @endif
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Tax (8%)</span>
                                <span class="font-medium text-gray-900 dark:text-white">${{ number_format($tax, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Shipping</span>
                                <span class="font-medium text-gray-900 dark:text-white">${{ number_format($shipping, 2) }}</span>
                            </div>
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-3 mt-3">
                                <div class="flex justify-between text-lg font-bold">
                                    <span class="text-gray-900 dark:text-white">Total</span>
                                    <span class="text-gray-900 dark:text-white">${{ number_format($total, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Coupon Section -->
                        @if(session('coupon'))
                            <div class="mt-4 p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-sm font-medium text-green-800 dark:text-green-300">Coupon Applied</p>
                                        <p class="text-xs text-green-600 dark:text-green-400">{{ session('coupon.code') }}</p>
                                    </div>
                                    <a href="{{ route('coupon.remove') }}" class="text-xs text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                        Remove
                                    </a>
                                </div>
                            </div>
                        @else
                            <form action="{{ route('coupon.apply') }}" method="POST" class="mt-4">
                                @csrf
                                <div class="flex gap-2">
                                    <input type="text" name="coupon_code" placeholder="Enter coupon code" 
                                           class="flex-1 px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500"
                                           required>
                                    <button type="submit" class="px-4 py-2 text-sm font-medium text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20">
                                        Apply
                                    </button>
                                </div>
                            </form>
                        @endif

                        <a href="{{ route('checkout') }}" class="mt-6 block w-full py-3 px-4 bg-blue-600 text-white text-center font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                            Proceed to Checkout
                        </a>

                        <div class="mt-4 flex items-center justify-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Secure checkout
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-16">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <h2 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">Your cart is empty</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Looks like you haven't added anything to your cart yet.</p>
                <a href="{{ route('products.index') }}" class="mt-6 inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</div>

<script>
    function updateQuantity(productId, change) {
        const input = document.querySelector(`input[name="quantities[${productId}]"]`);
        const newValue = parseInt(input.value) + change;
        if (newValue >= 0) {
            input.value = newValue;
            input.form.submit();
        }
    }
</script>
@endsection
