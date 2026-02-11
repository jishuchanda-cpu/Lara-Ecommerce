@extends('layouts.app')

@section('title', 'Order ' . $order->order_number)

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-6">
            <a href="{{ route('home') }}" class="hover:text-gray-900 dark:hover:text-white">Home</a>
            <svg class="mx-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('orders.index') }}" class="hover:text-gray-900 dark:hover:text-white">My Orders</a>
            <svg class="mx-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-gray-900 dark:text-white">Order #{{ $order->order_number }}</span>
        </nav>

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

        <div class="lg:grid lg:grid-cols-3 lg:gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Order Header -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Order #{{ $order->order_number }}</h1>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                    'processing' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                    'shipped' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
                                    'delivered' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                    'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                ];
                            @endphp
                            <span class="px-4 py-2 text-sm font-semibold rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Order Timeline -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Order Status</h2>
                    <div class="relative">
                        @foreach($timeline as $index => $event)
                            <div class="flex gap-4 mb-8 last:mb-0">
                                <div class="flex flex-col items-center">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $event['completed'] ? ($event['is_cancelled'] ?? false ? 'bg-red-100 dark:bg-red-900' : 'bg-green-100 dark:bg-green-900') : 'bg-gray-100 dark:bg-gray-700' }}">
                                        @if($event['completed'])
                                            @if($event['is_cancelled'] ?? false)
                                                <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            @endif
                                        @else
                                            <div class="w-3 h-3 rounded-full bg-gray-300 dark:bg-gray-500"></div>
                                        @endif
                                    </div>
                                    @if(!$loop->last)
                                        <div class="w-0.5 h-full bg-gray-200 dark:bg-gray-700 mt-2"></div>
                                    @endif
                                </div>
                                <div class="flex-1 pb-8">
                                    <h3 class="font-semibold text-gray-900 dark:text-white">{{ $event['status'] }}</h3>
                                    @if($event['date'])
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $event['date']->format('M d, Y \a\t h:i A') }}</p>
                                    @endif
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ $event['description'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Order Items -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden mb-6">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Order Items</h2>
                    </div>
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($order->orderItems as $item)
                            <div class="p-6 flex gap-4">
                                <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden flex-shrink-0">
                                    @if($item->product && !empty($item->product->images) && isset($item->product->images[0]))
                                        <img src="{{ asset('storage/' . $item->product->images[0]) }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-medium text-gray-900 dark:text-white">{{ $item->product_name }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">SKU: {{ $item->product_sku }}</p>
                                    <div class="flex justify-between items-center mt-2">
                                        <p class="text-sm text-gray-600 dark:text-gray-300">Qty: {{ $item->quantity }} × ${{ number_format($item->price, 2) }}</p>
                                        <p class="font-semibold text-gray-900 dark:text-white">${{ number_format($item->total, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Cancel Order Form -->
                @if(in_array($order->status, ['pending', 'processing']))
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <h2 class="text-lg font-semibold text-red-600 mb-4">Cancel Order</h2>
                        <form action="{{ route('orders.cancel', $order) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?')">
                            @csrf
                            <div class="mb-4">
                                <label for="reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Reason for cancellation</label>
                                <textarea name="reason" id="reason" rows="3" required
                                          class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-red-500 focus:ring-red-500"></textarea>
                            </div>
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700">
                                Cancel Order
                            </button>
                        </form>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="mt-8 lg:mt-0">
                <!-- Order Summary -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6 sticky top-24">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Order Summary</h2>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Subtotal</span>
                            <span class="font-medium text-gray-900 dark:text-white">${{ number_format($order->total_amount - $order->tax_amount - $order->shipping_amount + $order->discount_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Tax</span>
                            <span class="font-medium text-gray-900 dark:text-white">${{ number_format($order->tax_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Shipping</span>
                            <span class="font-medium text-gray-900 dark:text-white">${{ number_format($order->shipping_amount, 2) }}</span>
                        </div>
                        @if($order->discount_amount > 0)
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Discount</span>
                                <span class="font-medium text-green-600">-${{ number_format($order->discount_amount, 2) }}</span>
                            </div>
                        @endif
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-3">
                            <div class="flex justify-between text-lg font-bold">
                                <span class="text-gray-900 dark:text-white">Total</span>
                                <span class="text-gray-900 dark:text-white">${{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Status -->
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Payment Status</h3>
                        @php
                            $paymentColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                'paid' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                'failed' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                'refunded' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                            ];
                        @endphp
                        <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $paymentColors[$order->payment_status] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                            {{ match($order->payment_method) {
                                'credit_card' => 'Paid with Credit Card',
                                'paypal' => 'Paid with PayPal',
                                'cash_on_delivery' => 'Cash on Delivery',
                                default => ucfirst(str_replace('_', ' ', $order->payment_method))
                            } }}
                        </p>
                    </div>
                </div>

                <!-- Shipping Address -->
                @if($order->shipping_address)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Shipping Address</h2>
                        <div class="text-sm text-gray-600 dark:text-gray-300">
                            <p class="font-medium text-gray-900 dark:text-white">{{ $order->shipping_address['name'] ?? 'N/A' }}</p>
                            @if(!empty($order->shipping_address['email']))
                                <p>{{ $order->shipping_address['email'] }}</p>
                            @endif
                            @if(!empty($order->shipping_address['phone']))
                                <p>{{ $order->shipping_address['phone'] }}</p>
                            @endif
                            @if(!empty($order->shipping_address['address_line_1']))
                                <p class="mt-2">{{ $order->shipping_address['address_line_1'] }}</p>
                            @endif
                            @if(!empty($order->shipping_address['address_line_2']))
                                <p>{{ $order->shipping_address['address_line_2'] }}</p>
                            @endif
                            @if(!empty($order->shipping_address['city']))
                                <p>{{ $order->shipping_address['city'] }}{{ !empty($order->shipping_address['state']) ? ', ' . $order->shipping_address['state'] : '' }} {{ $order->shipping_address['postal_code'] ?? '' }}</p>
                            @endif
                            @if(!empty($order->shipping_address['country']))
                                <p>{{ $order->shipping_address['country'] }}</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
