<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function apply(Request $request)
    {
        $validated = $request->validate([
            'coupon_code' => 'required|string',
        ]);

        $coupon = Coupon::where('code', strtoupper($validated['coupon_code']))->first();

        if (!$coupon) {
            return back()->with('error', 'Coupon code not found.');
        }

        if (!$coupon->isValid()) {
            return back()->with('error', 'This coupon is no longer valid.');
        }

        // Get cart items to calculate subtotal
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        $subtotal = 0;
        foreach ($cart as $productId => $quantity) {
            $product = \App\Models\Product::find($productId);
            if ($product) {
                $subtotal += $product->price * $quantity;
            }
        }

        if (!$coupon->isValidForOrder($subtotal, auth()->user())) {
            if ($subtotal < $coupon->min_order_amount) {
                return back()->with('error', 'Minimum order amount of $' . number_format($coupon->min_order_amount, 2) . ' required.');
            }

            return back()->with('error', 'This coupon cannot be applied to your order.');
        }

        // Calculate discount
        $discount = $coupon->calculateDiscount($subtotal);

        // Store coupon in session
        session()->put('coupon', [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'discount' => $discount,
            'type' => $coupon->type,
            'value' => $coupon->value,
        ]);

        return back()->with('success', 'Coupon "' . $coupon->code . '" applied successfully! You saved $' . number_format($discount, 2) . '.');
    }

    public function remove()
    {
        session()->forget('coupon');

        return back()->with('success', 'Coupon removed successfully.');
    }
}
