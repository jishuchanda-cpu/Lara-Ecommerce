<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function cart(): View
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $subtotal = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $itemTotal = $product->price * $quantity;
                $subtotal += $itemTotal;
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'total' => $itemTotal,
                ];
            }
        }

        // Calculate discount
        $discount = 0;
        if (session()->has('coupon')) {
            $coupon = Coupon::find(session('coupon.id'));
            if ($coupon && $coupon->isValidForOrder($subtotal, auth()->user())) {
                $discount = $coupon->calculateDiscount($subtotal);
            } else {
                // Remove invalid coupon
                session()->forget('coupon');
            }
        }

        $taxRate = 0.08;
        $tax = ($subtotal - $discount) * $taxRate;
        $shipping = $subtotal > 0 ? 10.00 : 0;
        $total = $subtotal + $tax + $shipping - $discount;

        return view('checkout.cart', compact('cartItems', 'subtotal', 'discount', 'tax', 'shipping', 'total'));
    }

    public function checkout(): View|RedirectResponse
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $cartItems = [];
        $subtotal = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $itemTotal = $product->price * $quantity;
                $subtotal += $itemTotal;
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'total' => $itemTotal,
                ];
            }
        }

        // Calculate discount
        $discount = 0;
        $coupon = null;
        if (session()->has('coupon')) {
            $coupon = Coupon::find(session('coupon.id'));
            if ($coupon && $coupon->isValidForOrder($subtotal, auth()->user())) {
                $discount = $coupon->calculateDiscount($subtotal);
            } else {
                session()->forget('coupon');
            }
        }

        $taxRate = 0.08;
        $tax = ($subtotal - $discount) * $taxRate;
        $shipping = 10.00;
        $total = $subtotal + $tax + $shipping - $discount;

        // Pre-fill with user info if authenticated
        $defaultAddress = [];
        if (auth()->check()) {
            $user = auth()->user();
            $defaultAddress = [
                'shipping_name' => $user->name,
                'shipping_email' => $user->email,
            ];
        }

        return view('checkout.checkout', compact('cartItems', 'subtotal', 'discount', 'tax', 'shipping', 'total', 'defaultAddress', 'coupon'));
    }

    public function process(CheckoutRequest $request): RedirectResponse
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        // Calculate totals
        $subtotal = 0;
        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $subtotal += $product->price * $quantity;
            }
        }

        // Calculate discount
        $discount = 0;
        $coupon = null;
        if (session()->has('coupon')) {
            $coupon = Coupon::find(session('coupon.id'));
            if ($coupon && $coupon->isValidForOrder($subtotal, auth()->user())) {
                $discount = $coupon->calculateDiscount($subtotal);
            }
        }

        $taxRate = 0.08;
        $tax = ($subtotal - $discount) * $taxRate;
        $shipping = 10.00;
        $total = $subtotal + $tax + $shipping - $discount;

        // Prepare addresses
        $shippingAddress = [
            'name' => $request->input('shipping_name'),
            'email' => $request->input('shipping_email'),
            'phone' => $request->input('shipping_phone'),
            'address_line_1' => $request->input('shipping_address_line_1'),
            'address_line_2' => $request->input('shipping_address_line_2'),
            'city' => $request->input('shipping_city'),
            'state' => $request->input('shipping_state'),
            'postal_code' => $request->input('shipping_postal_code'),
            'country' => $request->input('shipping_country'),
        ];

        $billingAddress = [
            'name' => $request->input('billing_name'),
            'email' => $request->input('billing_email'),
            'phone' => $request->input('billing_phone'),
            'address_line_1' => $request->input('billing_address_line_1'),
            'address_line_2' => $request->input('billing_address_line_2'),
            'city' => $request->input('billing_city'),
            'state' => $request->input('billing_state'),
            'postal_code' => $request->input('billing_postal_code'),
            'country' => $request->input('billing_country'),
        ];

        // Create order
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'user_id' => auth()->id(),
            'total_amount' => $total,
            'tax_amount' => $tax,
            'shipping_amount' => $shipping,
            'discount_amount' => $discount,
            'status' => 'pending',
            'payment_status' => 'pending',
            'payment_method' => $request->input('payment_method'),
            'shipping_address' => $shippingAddress,
            'billing_address' => $billingAddress,
            'notes' => $request->input('notes'),
        ]);

        // Record coupon usage
        if ($coupon && $discount > 0) {
            \App\Models\CouponUsage::create([
                'coupon_id' => $coupon->id,
                'user_id' => auth()->id(),
                'order_id' => $order->id,
                'discount_amount' => $discount,
            ]);
            $coupon->incrementUsage();
        }

        // Create order items
        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_sku' => $product->sku,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'total' => $product->price * $quantity,
                ]);

                // Update product stock
                if ($product->track_quantity) {
                    $product->decrement('stock_quantity', $quantity);
                }
            }
        }

        // Clear cart and coupon
        session()->forget(['cart', 'coupon']);

        // Store order ID in session for confirmation page
        session()->put('last_order_id', $order->id);

        return redirect()->route('checkout.confirmation', $order);
    }

    public function confirmation(Order $order): View
    {
        // Ensure the user can only see their own orders (or guests can see recent order)
        if (auth()->check() && $order->user_id && $order->user_id !== auth()->id()) {
            abort(403);
        }

        // For guests, check if the order ID matches the last order in session
        if (!auth()->check() && session('last_order_id') !== $order->id) {
            abort(403);
        }

        $order->load(['orderItems.product']);

        return view('checkout.confirmation', compact('order'));
    }

    public function updateCart(Request $request): RedirectResponse
    {
        $request->validate([
            'quantities' => ['required', 'array'],
            'quantities.*' => ['integer', 'min:0'],
        ]);

        $cart = session()->get('cart', []);
        $quantities = $request->input('quantities');

        foreach ($quantities as $productId => $quantity) {
            if ($quantity > 0) {
                $cart[$productId] = $quantity;
            } else {
                unset($cart[$productId]);
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Cart updated successfully.');
    }

    public function removeItem(int $productId): RedirectResponse
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Item removed from cart.');
    }
}
