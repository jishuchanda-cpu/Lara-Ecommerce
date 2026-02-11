@extends('layouts.admin')

@section('title', 'Coupon Details')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a href="{{ route('admin.coupons.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">
                ← Back to Coupons
            </a>
        </div>

        <div class="lg:grid lg:grid-cols-3 lg:gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white font-mono">{{ $coupon->code }}</h1>
                            @if($coupon->description)
                                <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $coupon->description }}</p>
                            @endif
                        </div>
                        <div class="flex gap-2">
                            @if($coupon->is_active)
                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                    Active
                                </span>
                            @else
                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                    Inactive
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Discount Type</p>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ ucfirst($coupon->type) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Discount Value</p>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $coupon->formattedValue() }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Min Order</p>
                            <p class="font-semibold text-gray-900 dark:text-white">${{ number_format($coupon->min_order_amount, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Valid Until</p>
                            <p class="font-semibold text-gray-900 dark:text-white">
                                {{ $coupon->expires_at ? $coupon->expires_at->format('M d, Y') : 'Never' }}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total Uses</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $coupon->used_count }}
                                @if($coupon->max_uses)
                                    <span class="text-sm font-normal text-gray-500">/ {{ $coupon->max_uses }}</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Max Per User</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $coupon->max_uses_per_user ?? '∞' }}
                            </p>
                        </div>
                    </div>

                    @if($coupon->starts_at || $coupon->expires_at)
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Validity Period</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                {{ $coupon->starts_at ? $coupon->starts_at->format('M d, Y h:i A') : 'Now' }}
                                -
                                {{ $coupon->expires_at ? $coupon->expires_at->format('M d, Y h:i A') : 'Unlimited' }}
                            </p>
                        </div>
                    @endif

                    <div class="mt-6 flex gap-4">
                        <a href="{{ route('admin.coupons.edit', $coupon) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Edit Coupon
                        </a>
                        <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this coupon?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                Delete Coupon
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Usage History</h2>
                    @if($coupon->usages->count() > 0)
                        <div class="space-y-4">
                            @foreach($coupon->usages->take(10) as $usage)
                                <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div>
                                        @if($usage->user)
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $usage->user->name }}</p>
                                        @else
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Guest</p>
                                        @endif
                                        @if($usage->order)
                                            <a href="{{ route('admin.orders.show', $usage->order) }}" class="text-xs text-blue-600 hover:underline">
                                                Order #{{ $usage->order->order_number }}
                                            </a>
                                        @endif
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $usage->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <span class="font-semibold text-green-600">-${{ number_format($usage->discount_amount, 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                        @if($coupon->usages->count() > 10)
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-4 text-center">
                                And {{ $coupon->usages->count() - 10 }} more...
                            </p>
                        @endif
                    @else
                        <p class="text-gray-500 dark:text-gray-400 text-center py-8">No usage history yet</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
