<div class="space-y-6" wire:loading.class="opacity-50">
    <!-- Header with Search and Controls -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 md:p-6">
        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search" 
                        placeholder="Search products..."
                        class="w-full pl-10 pr-4 py-2 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    >
                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Category Filter -->
            <div class="w-full lg:w-48">
                <select wire:model.live="categoryId" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sort -->
            <div class="w-full lg:w-48">
                <select wire:model.live="sortBy" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="latest">Newest First</option>
                    <option value="price_low">Price: Low to High</option>
                    <option value="price_high">Price: High to Low</option>
                    <option value="name">Name: A to Z</option>
                </select>
            </div>

            <!-- View Toggle -->
            <div class="flex items-center gap-2">
                <button wire:click="toggleViewMode" class="p-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 {{ $viewMode === 'grid' ? 'bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300' : 'text-gray-600 dark:text-gray-400' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                </button>
                <button wire:click="toggleViewMode" class="p-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 {{ $viewMode === 'list' ? 'bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300' : 'text-gray-600 dark:text-gray-400' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Active Filters -->
        @if($search || $categoryId || $priceRange['min'] !== '' || $priceRange['max'] !== '')
            <div class="mt-4 flex flex-wrap items-center gap-2">
                <span class="text-sm text-gray-600 dark:text-gray-400">Active filters:</span>
                @if($search)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                        Search: {{ $search }}
                        <button wire:click="$set('search', '')" class="ml-2 text-blue-600 hover:text-blue-800">×</button>
                    </span>
                @endif
                @if($categoryId)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                        {{ $categories->firstWhere('id', $categoryId)?->name }}
                        <button wire:click="$set('categoryId', null)" class="ml-2 text-green-600 hover:text-green-800">×</button>
                    </span>
                @endif
                <button wire:click="resetFilters" class="text-sm text-red-600 hover:text-red-800 dark:text-red-400">Clear all</button>
            </div>
        @endif
    </div>

    <!-- Results Count -->
    <div class="flex justify-between items-center">
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Showing {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products
        </p>
    </div>

    <!-- Products Grid/List -->
    @if($viewMode === 'grid')
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden group hover:shadow-lg transition-shadow">
                    <!-- Image -->
                    <a href="{{ route('products.show', $product) }}" class="block relative aspect-square overflow-hidden bg-gray-100 dark:bg-gray-700">
                        @if(!empty($product->images) && isset($product->images[0]))
                            <img src="{{ asset('storage/' .$product->images[0]) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        @if($product->compare_price)
                            <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">SALE</span>
                        @endif
                    </a>
                    
                    <!-- Content -->
                    <div class="p-4">
                        <a href="{{ route('products.show', $product) }}" class="block">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1 line-clamp-2 hover:text-blue-600 dark:hover:text-blue-400">{{ $product->name }}</h3>
                        </a>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{ $product->category?->name }}</p>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="text-lg font-bold text-gray-900 dark:text-white">${{ number_format($product->price, 2) }}</span>
                                @if($product->compare_price)
                                    <span class="text-sm text-gray-500 line-through">${{ number_format($product->compare_price, 2) }}</span>
                                @endif
                            </div>
                        </div>

                        <livewire:shop.add-to-cart :product-id="$product->id" :key="'cart-'.$product->id" />
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No products found</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try adjusting your search or filters.</p>
                </div>
            @endforelse
        </div>
    @else
        <div class="space-y-4">
            @forelse($products as $product)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden group hover:shadow-lg transition-shadow">
                    <div class="flex flex-col sm:flex-row">
                        <!-- Image -->
                        <a href="{{ route('products.show', $product) }}" class="block relative w-full sm:w-48 h-48 sm:h-auto flex-shrink-0 overflow-hidden bg-gray-100 dark:bg-gray-700">
                            @if(!empty($product->images) && isset($product->images[0]))
                                <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            @if($product->compare_price)
                                <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">SALE</span>
                            @endif
                        </a>
                        
                        <!-- Content -->
                        <div class="flex-1 p-4 sm:p-6 flex flex-col">
                            <div class="flex-1">
                                <a href="{{ route('products.show', $product) }}">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2 hover:text-blue-600 dark:hover:text-blue-400">{{ $product->name }}</h3>
                                </a>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{ $product->category?->name }}</p>
                                <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-2 mb-4">{{ Str::limit($product->description, 150) }}</p>
                            </div>
                            
                            <div class="flex items-center justify-between mt-4">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl font-bold text-gray-900 dark:text-white">${{ number_format($product->price, 2) }}</span>
                                    @if($product->compare_price)
                                        <span class="text-lg text-gray-500 line-through">${{ number_format($product->compare_price, 2) }}</span>
                                    @endif
                                </div>
                                <livewire:shop.add-to-cart :product-id="$product->id" :key="'cart-'.$product->id" />
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No products found</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try adjusting your search or filters.</p>
                </div>
            @endforelse
        </div>
    @endif

    <!-- Pagination -->
    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
