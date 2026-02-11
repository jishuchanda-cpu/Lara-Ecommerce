@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="bg-white dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-8">
            <a href="{{ route('home') }}" class="hover:text-gray-900 dark:hover:text-white">Home</a>
            <svg class="mx-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('products.index') }}" class="hover:text-gray-900 dark:hover:text-white">Products</a>
            <svg class="mx-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-gray-900 dark:text-white">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Product Images -->
            <div x-data="{ currentImage: 0 }">
                <!-- Main Image -->
                <div class="aspect-square bg-gray-100 dark:bg-gray-700 rounded-xl overflow-hidden mb-4">
                    @if(!empty($product->images))
                        <template x-for="(image, index) in {{ json_encode($product->images) }}" :key="index">
                            <img x-show="currentImage === index" :src="'/storage/' + image" :alt="'{{ $product->name }}'" class="w-full h-full object-cover">
                        </template>
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Thumbnail Gallery -->
                @if(!empty($product->images) && count($product->images) > 1)
                    <div class="flex gap-2 overflow-x-auto pb-2">
                        @foreach($product->images as $index => $image)
                            <button 
                                @click="currentImage = {{ $index }}"
                                :class="{ 'ring-2 ring-blue-500': currentImage === {{ $index }} }"
                                class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-700">
                                <img src="{{ asset('storage/' . $image) }}" alt="" class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="space-y-6">
                <div>
                    <a href="{{ route('categories.show', $product->category) }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                        {{ $product->category?->name }}
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $product->name }}</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">SKU: {{ $product->sku }}</p>
                </div>

                <!-- Price -->
                <div class="flex items-baseline gap-3">
                    <span class="text-4xl font-bold text-gray-900 dark:text-white">${{ number_format($product->price, 2) }}</span>
                    @if($product->compare_price)
                        <span class="text-xl text-gray-500 line-through">${{ number_format($product->compare_price, 2) }}</span>
                        <span class="text-sm bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 px-2 py-1 rounded">
                            Save ${{ number_format($product->compare_price - $product->price, 2) }}
                        </span>
                    @endif
                </div>

                <!-- Stock Status -->
                <div class="flex items-center gap-2">
                    @if($product->stock_quantity > 10)
                        <span class="inline-flex items-center text-green-600 dark:text-green-400">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            In Stock ({{ $product->stock_quantity }} available)
                        </span>
                    @elseif($product->stock_quantity > 0)
                        <span class="inline-flex items-center text-yellow-600 dark:text-yellow-400">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            Low Stock ({{ $product->stock_quantity }} left)
                        </span>
                    @else
                        <span class="inline-flex items-center text-red-600 dark:text-red-400">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Out of Stock
                        </span>
                    @endif
                </div>

                <!-- Description -->
                <div class="prose dark:prose-invert max-w-none">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Description</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ $product->description ?? 'No description available.' }}</p>
                </div>

                <!-- Add to Cart -->
                @if($product->stock_quantity > 0)
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                        <livewire:shop.add-to-cart :product-id="$product->id" />
                    </div>
                @endif

                <!-- Features -->
                <div class="grid grid-cols-3 gap-4 border-t border-gray-200 dark:border-gray-700 pt-6">
                    <div class="text-center">
                        <svg class="w-8 h-8 mx-auto text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Quality Guaranteed</p>
                    </div>
                    <div class="text-center">
                        <svg class="w-8 h-8 mx-auto text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Fast Delivery</p>
                    </div>
                    <div class="text-center">
                        <svg class="w-8 h-8 mx-auto text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Secure Payment</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="mt-16 border-t border-gray-200 dark:border-gray-700 pt-12">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Related Products</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden group hover:shadow-lg transition-shadow">
                            <a href="{{ route('products.show', $related) }}" class="block relative aspect-square overflow-hidden bg-gray-100 dark:bg-gray-600">
                                @if(!empty($related->images) && isset($related->images[0]))
                                    <img src="{{ asset('storage/' . $related->images[0]) }}" alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-300 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </a>
                            <div class="p-4">
                                <a href="{{ route('products.show', $related) }}">
                                    <h3 class="font-semibold text-gray-900 dark:text-white mb-1 hover:text-blue-600 dark:hover:text-blue-400 line-clamp-1">{{ $related->name }}</h3>
                                </a>
                                <p class="text-lg font-bold text-gray-900 dark:text-white">${{ number_format($related->price, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
