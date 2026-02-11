@extends('layouts.app')

@section('title', 'All Products')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">All Products</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Browse our complete collection</p>
        </div>

        <livewire:shop.product-listing />
    </div>
</div>
@endsection
