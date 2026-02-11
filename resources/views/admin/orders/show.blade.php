@extends('layouts.admin')

@section('title', 'Order ' . $order->order_number)
@section('header', 'Order Details')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Header -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $order->order_number }}</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}
                            @if($order->user)
                                by <a href="{{ route('admin.users.show', $order->user) }}" class="text-blue-600 hover:underline">{{ $order->user->name }}</a>
                            @else
                                by Guest
                            @endif
                        </p>
                    </div>
                    <div class="mt-4 md:mt-0 flex items-center gap-2">
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
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Order Timeline</h2>
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
                                <div class="flex justify-between items-start">
                                    <h3 class="font-semibold text-gray-900 dark:text-white">{{ $event['status'] }}</h3>
                                    @if($event['date'])
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $event['date']->format('M d, Y h:i A') }}</span>
                                    @endif
                                </div>
                                @if($event['date'])
                                    <p class="text-sm text-gray-500 dark:text-gray-400">by {{ $event['user'] ?? 'System' }}</p>
                                @endif
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ $event['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Order Items</h2>
                </div>
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Qty</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($order->orderItems as $item)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if($item->product && !empty($item->product->images) && isset($item->product->images[0]))
                                            <img src="{{ asset('storage/' . $item->product->images[0]) }}" alt="{{ $item->product_name }}" class="w-12 h-12 rounded-lg object-cover mr-3">
                                        @else
                                            <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center mr-3">
                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">{{ $item->product_name }}</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">SKU: {{ $item->product_sku }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">${{ number_format($item->price, 2) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $item->quantity }}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white text-right">${{ number_format($item->total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Order Notes -->
            @if($order->notes)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Order Notes</h2>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <p class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $order->notes }}</p>
                    </div>
                </div>
            @endif

            <!-- Add Note Form -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Add Note</h2>
                <form action="{{ route('admin.orders.note.add', $order) }}" method="POST">
                    @csrf
                    <textarea name="note" rows="3" placeholder="Add a note about this order..."
                              class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 mb-4"></textarea>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Add Note
                    </button>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Management -->
            @if($order->status !== 'cancelled' && $order->status !== 'delivered')
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Update Status</h2>
                    <form action="{{ route('admin.orders.status.update', $order) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <select name="status" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <textarea name="notes" rows="2" placeholder="Status change notes (optional)"
                                      class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"></textarea>
                        </div>
                        <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Update Status
                        </button>
                    </form>
                </div>
            @endif

            <!-- Payment Status -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Payment Status</h2>
                @php
                    $paymentColors = [
                        'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                        'paid' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                        'failed' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                        'refunded' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                    ];
                @endphp
                <div class="mb-4">
                    <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $paymentColors[$order->payment_status] ?? 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>
                <form action="{{ route('admin.orders.payment.update', $order) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <select name="payment_status" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                            <option value="refunded" {{ $order->payment_status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <textarea name="notes" rows="2" placeholder="Payment status notes (optional)"
                                  class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"></textarea>
                    </div>
                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Update Payment
                    </button>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
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
            </div>

            <!-- Shipping Address -->
            @if($order->shipping_address)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Shipping Address</h2>
                    <div class="text-sm text-gray-600 dark:text-gray-300">
                        <p class="font-medium text-gray-900 dark:text-white">{{ $order->shipping_address['name'] }}</p>
                        <p>{{ $order->shipping_address['email'] }}</p>
                        <p>{{ $order->shipping_address['phone'] }}</p>
                        <p class="mt-2">{{ $order->shipping_address['address_line_1'] }}</p>
                        @if(!empty($order->shipping_address['address_line_2']))
                            <p>{{ $order->shipping_address['address_line_2'] }}</p>
                        @endif
                        <p>{{ $order->shipping_address['city'] }}, {{ $order->shipping_address['state'] }} {{ $order->shipping_address['postal_code'] }}</p>
                        <p>{{ $order->shipping_address['country'] }}</p>
                    </div>
                </div>
            @endif

            <!-- Billing Address -->
            @if($order->billing_address)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Billing Address</h2>
                    <div class="text-sm text-gray-600 dark:text-gray-300">
                        <p class="font-medium text-gray-900 dark:text-white">{{ $order->billing_address['name'] }}</p>
                        <p>{{ $order->billing_address['email'] }}</p>
                        <p>{{ $order->billing_address['phone'] }}</p>
                        <p class="mt-2">{{ $order->billing_address['address_line_1'] }}</p>
                        @if(!empty($order->billing_address['address_line_2']))
                            <p>{{ $order->billing_address['address_line_2'] }}</p>
                        @endif
                        <p>{{ $order->billing_address['city'] }}, {{ $order->billing_address['state'] }} {{ $order->billing_address['postal_code'] }}</p>
                        <p>{{ $order->billing_address['country'] }}</p>
                    </div>
                </div>
            @endif

            <!-- Cancel Order -->
            @if($order->status !== 'cancelled' && $order->status !== 'delivered')
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border-2 border-red-200 dark:border-red-800">
                    <h2 class="text-lg font-semibold text-red-600 mb-4">Cancel Order</h2>
                    <form action="{{ route('admin.orders.cancel', $order) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?')">
                        @csrf
                        <div class="mb-4">
                            <textarea name="reason" rows="2" placeholder="Reason for cancellation" required
                                      class="w-full rounded-lg border-red-300 dark:border-red-700 dark:bg-gray-700 dark:text-white shadow-sm focus:border-red-500 focus:ring-red-500 text-sm"></textarea>
                        </div>
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            Cancel Order
                        </button>
                    </form>
                </div>
            @endif

            <!-- Delete Order -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border-2 border-red-200 dark:border-red-800">
                <h2 class="text-lg font-semibold text-red-600 mb-4">Danger Zone</h2>
                <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2 bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300 rounded-lg hover:bg-red-200 dark:hover:bg-red-800">
                        Delete Order
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
