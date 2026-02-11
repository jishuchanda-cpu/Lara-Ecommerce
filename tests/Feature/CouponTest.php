<?php

use App\Models\Coupon;
use App\Models\Product;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->customer()->create();
    $this->admin = User::factory()->admin()->create();
    $this->product = Product::factory()->create(['price' => 50.00, 'stock_quantity' => 10]);
    $this->coupon = Coupon::factory()->create(['type' => 'percentage', 'value' => 20]);
});

describe('Coupon Model', function () {
    it('calculates percentage discount correctly', function () {
        $subtotal = 100.00;
        $discount = $this->coupon->calculateDiscount($subtotal);

        expect($discount)->toBe(20.00);
    });

    it('calculates fixed discount correctly', function () {
        $coupon = Coupon::factory()->state(['type' => 'fixed', 'value' => 15.00])->create();
        $subtotal = 100.00;
        $discount = $coupon->calculateDiscount($subtotal);

        expect($discount)->toBe(15.00);
    });

    it('returns discount not exceeding subtotal for fixed coupon', function () {
        $coupon = Coupon::factory()->create(['type' => 'fixed', 'value' => 100.00]);
        $subtotal = 50.00;
        $discount = $coupon->calculateDiscount($subtotal);

        expect($discount)->toBe(50.00);
    });

    it('validates coupon is active', function () {
        expect($this->coupon->isValid())->toBeTrue();
    });

    it('rejects inactive coupon', function () {
        $this->coupon->update(['is_active' => false]);

        expect($this->coupon->isValid())->toBeFalse();
    });

    it('rejects expired coupon', function () {
        $this->coupon->update(['expires_at' => now()->subDay()]);

        expect($this->coupon->isValid())->toBeFalse();
    });

    it('rejects coupon not yet started', function () {
        $this->coupon->update(['starts_at' => now()->addDay()]);

        expect($this->coupon->isValid())->toBeFalse();
    });

    it('validates minimum order amount', function () {
        $coupon = Coupon::factory()->create(['min_order_amount' => 200.00]);
        $subtotal = 100.00;

        expect($coupon->isValidForOrder($subtotal))->toBeFalse();
    });

    it('accepts order meeting minimum amount', function () {
        $coupon = Coupon::factory()->create(['min_order_amount' => 50.00]);
        $subtotal = 100.00;

        expect($coupon->isValidForOrder($subtotal))->toBeTrue();
    });

    it('formats percentage value correctly', function () {
        expect($this->coupon->formattedValue())->toBe('20%');
    });

    it('formats fixed value correctly', function () {
        $coupon = Coupon::factory()->create(['type' => 'fixed', 'value' => 25.50]);

        expect($coupon->formattedValue())->toBe('$25.50');
    });

    it('tracks usage count', function () {
        $this->coupon->incrementUsage();

        expect($this->coupon->fresh()->used_count)->toBe(1);
    });
});

describe('Coupon Application', function () {
    it('allows applying a valid coupon to cart', function () {
        $cart = [$this->product->id => 2];
        session()->put('cart', $cart);

        $response = $this->post(route('coupon.apply'), [
            'coupon_code' => $this->coupon->code,
        ]);

        $response->assertRedirect()->with('success');
        $this->assertNotNull(session('coupon'));
    });

    it('rejects invalid coupon code', function () {
        $cart = [$this->product->id => 2];
        session()->put('cart', $cart);

        $response = $this->post(route('coupon.apply'), [
            'coupon_code' => 'INVALID',
        ]);

        $response->assertRedirect()->with('error');
        expect(session('coupon'))->toBeNull();
    });

    it('rejects expired coupon', function () {
        $this->coupon->update(['expires_at' => now()->subDay()]);
        $cart = [$this->product->id => 2];
        session()->put('cart', $cart);

        $response = $this->post(route('coupon.apply'), [
            'coupon_code' => $this->coupon->code,
        ]);

        $response->assertRedirect()->with('error');
    });

    it('rejects coupon with unmet minimum order', function () {
        $coupon = Coupon::factory()->create(['min_order_amount' => 200.00]);
        $cart = [$this->product->id => 2]; // $100 total
        session()->put('cart', $cart);

        $response = $this->post(route('coupon.apply'), [
            'coupon_code' => $coupon->code,
        ]);

        $response->assertRedirect()->with('error');
    });

    it('allows removing coupon', function () {
        session()->put('coupon', [
            'id' => $this->coupon->id,
            'code' => $this->coupon->code,
            'discount' => 20.00,
        ]);

        $response = $this->get(route('coupon.remove'));

        $response->assertRedirect()->with('success');
        expect(session('coupon'))->toBeNull();
    });

    it('calculates correct discount in cart', function () {
        $cart = [$this->product->id => 2]; // $100 total
        session()->put('cart', $cart);
        session()->put('coupon', [
            'id' => $this->coupon->id,
            'code' => $this->coupon->code,
            'discount' => 20.00,
        ]);

        $response = $this->get(route('cart'));

        $response->assertStatus(200)
            ->assertSee('Discount')
            ->assertSee('$20.00');
    });
});

describe('Admin Coupon Management', function () {
    it('allows admins to view coupons list', function () {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.coupons.index'));

        $response->assertStatus(200)
            ->assertSee($this->coupon->code);
    });

    it('prevents non-admins from accessing coupons', function () {
        $response = $this->actingAs($this->user)
            ->get(route('admin.coupons.index'));

        $response->assertStatus(403);
    });

    it('allows admins to create coupon', function () {
        $response = $this->actingAs($this->admin)
            ->post(route('admin.coupons.store'), [
                'code' => 'TEST50',
                'type' => 'percentage',
                'value' => 50,
                'is_active' => true,
            ]);

        $response->assertRedirect(route('admin.coupons.index'))
            ->assertSessionHas('success');

        expect(Coupon::where('code', 'TEST50')->exists())->toBeTrue();
    });

    it('allows admins to update coupon', function () {
        $response = $this->actingAs($this->admin)
            ->put(route('admin.coupons.update', $this->coupon), [
                'code' => $this->coupon->code,
                'type' => 'percentage',
                'value' => 30,
                'is_active' => true,
            ]);

        $response->assertRedirect(route('admin.coupons.index'))
            ->assertSessionHas('success');

        expect($this->coupon->fresh()->value)->toBe(30.00);
    });

    it('allows admins to delete coupon', function () {
        $coupon = Coupon::factory()->create();

        $response = $this->actingAs($this->admin)
            ->delete(route('admin.coupons.destroy', $coupon));

        $response->assertRedirect(route('admin.coupons.index'))
            ->assertSessionHas('success');

        expect(Coupon::find($coupon->id))->toBeNull();
    });

    it('validates unique coupon code', function () {
        $response = $this->actingAs($this->admin)
            ->post(route('admin.coupons.store'), [
                'code' => $this->coupon->code,
                'type' => 'percentage',
                'value' => 10,
            ]);

        $response->assertSessionHasErrors('code');
    });

    it('shows coupon usage history', function () {
        $coupon = Coupon::factory()->create();
        $order = \App\Models\Order::factory()->create(['user_id' => $this->user->id]);
        \App\Models\CouponUsage::create([
            'coupon_id' => $coupon->id,
            'user_id' => $this->user->id,
            'order_id' => $order->id,
            'discount_amount' => 10.00,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.coupons.show', $coupon));

        $response->assertStatus(200)
            ->assertSee($this->user->name);
    });
});

describe('Checkout with Coupon', function () {
    it('applies discount to order total', function () {
        $cart = [$this->product->id => 2]; // $100
        session()->put('cart', $cart);
        session()->put('coupon', [
            'id' => $this->coupon->id,
            'code' => $this->coupon->code,
            'discount' => 20.00,
        ]);

        $response = $this->actingAs($this->user)
            ->post(route('checkout.process'), [
                'shipping_name' => 'Test User',
                'shipping_email' => 'test@example.com',
                'shipping_phone' => '1234567890',
                'shipping_address_line_1' => '123 Main St',
                'shipping_city' => 'Test City',
                'shipping_state' => 'TS',
                'shipping_postal_code' => '12345',
                'shipping_country' => 'United States',
                'payment_method' => 'cash_on_delivery',
            ]);

        $order = \App\Models\Order::where('user_id', $this->user->id)->latest()->first();

        expect($order->discount_amount)->toBe(20.00);
        expect($order->total_amount)->toBe(91.40); // $100 - $20 + $8 tax + $10 shipping - $3.40 adjusted tax

        expect(\App\Models\CouponUsage::where('coupon_id', $this->coupon->id)->exists())->toBeTrue();
    });

    it('records coupon usage', function () {
        $cart = [$this->product->id => 2];
        session()->put('cart', $cart);
        session()->put('coupon', [
            'id' => $this->coupon->id,
            'code' => $this->coupon->code,
            'discount' => 20.00,
        ]);

        $this->actingAs($this->user)
            ->post(route('checkout.process'), [
                'shipping_name' => 'Test User',
                'shipping_email' => 'test@example.com',
                'shipping_phone' => '1234567890',
                'shipping_address_line_1' => '123 Main St',
                'shipping_city' => 'Test City',
                'shipping_state' => 'TS',
                'shipping_postal_code' => '12345',
                'shipping_country' => 'United States',
                'payment_method' => 'cash_on_delivery',
            ]);

        expect($this->coupon->fresh()->used_count)->toBe(1);
    });
});
