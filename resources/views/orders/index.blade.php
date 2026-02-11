@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">My Orders</h1>

        @if(session('success'))
            <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                <p class="text-sm text-green-700 dark:text-green-300">{{ session('success') }}</p>
            </div>
        @endif

        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Order #{{ $order->order_number }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Placed on {{ $order->created_at->format('F d, Y') }}</p>
                                </div>
                                <div class="mt-2 md:mt-0">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                            'processing' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                            'shipped' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
                                            'delivered' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                            'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <!-- Order Items Summary -->
                            <div class="flex items-center gap-4 mb-4">
                                <div class="flex -space-x-2">
                                    @foreach($order->orderItems->take(3) as $item)
                                        @if($item->product && !empty($item->product->images) && isset($item->product->images[0]))
                                            <img src="{{ asset('storage/' . $item->product->images[0]) }}" alt="" class="w-10 h-10 rounded-full border-2 border-white dark:border-gray-700 object-cover">
                                        @else
                                            <div class="w-10 h-10 rounded-full border-2 border-white dark:border-gray-700 bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    @endforeach
                                    @if($order->orderItems->count() > 3)
                                        <div class="w-10 h-10 rounded-full border-2 border-white dark:border-gray-700 bg-gray-100 dark:bg-gray-600 flex items-center justify-center">
                                            <span class="text-xs font-medium text-gray-600 dark:text-gray-400">+{{ $order->orderItems->count() - 3 }}</span>
                                        </div>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->orderItems->count() }} item(s)</p>
                            </div>

                            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                <div class="mb-4 md:mb-0">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Total Amount</p>
                                    <p class="text-xl font-bold text-gray-900 dark:text-white">${{ number_format($order->total_amount, 2) }}</p>
                                </div>
                                <div class="flex gap-3">
                                    <a href="{{ route('orders.show', $order) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">
                                        View Order
                                    </a>
                                    @if(in_array($order->status, ['pending', 'processing']))
                                        <form action="{{ route('orders.cancel', $order) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to cancel this order?')">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-100 text-red-700 text-sm font-medium rounded-lg hover:bg-red-200">
                                                Cancel Order
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @else
            <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-lg">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <h2 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">No orders yet</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400">You haven't placed any orders yet.</p>
                <a href="{{ route('products.index') }}" class="mt-6 inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
