@extends('layouts.admin')

@section('title', $product->name)
@section('header', 'Product Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        <!-- Product Images -->
        @if(!empty($product->images) && count($product->images) > 0)
            <div class="bg-gray-100 dark:bg-gray-700 p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($product->images as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}" class="w-full h-32 object-cover rounded-lg">
                    @endforeach
                </div>
            </div>
        @endif

        <div class="p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $product->name }}</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">SKU: {{ $product->sku }}</p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.products.edit', $product) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Edit Product
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Price</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">${{ number_format($product->price, 2) }}</p>
                    @if($product->compare_price)
                        <p class="text-sm text-gray-500 line-through">${{ number_format($product->compare_price, 2) }}</p>
                    @endif
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Stock</p>
                    <p class="text-2xl font-bold {{ $product->stock_quantity <= 5 ? 'text-red-600' : 'text-gray-900 dark:text-white' }}">
                        {{ $product->stock_quantity }}
                    </p>
                    <p class="text-sm text-gray-500">{{ $product->track_quantity ? 'Tracking enabled' : 'Not tracking' }}</p>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
                    <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full {{ $product->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Category</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ $product->category?->name ?? 'Uncategorized' }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Slug</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ $product->slug }}</p>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Description</h3>
                <p class="text-gray-600 dark:text-gray-300 whitespace-pre-line">{{ $product->description ?? 'No description available.' }}</p>
            </div>

            <!-- Order History -->
            @if($product->orderItems->count() > 0)
                <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Order History</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300">Order #</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300">Customer</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300">Quantity</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300">Price</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($product->orderItems as $item)
                                    <tr>
                                        <td class="px-4 py-2 text-sm">
                                            <a href="{{ route('admin.orders.show', $item->order) }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                                {{ $item->order->order_number }}
                                            </a>
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">
                                            {{ $item->order->user?->name ?? 'Guest' }}
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">{{ $item->quantity }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">${{ number_format($item->price, 2) }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">{{ $item->created_at->format('M d, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
