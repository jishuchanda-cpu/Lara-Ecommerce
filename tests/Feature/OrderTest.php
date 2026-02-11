<?php

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Services\OrderService;

beforeEach(function () {
    $this->user = User::factory()->customer()->create();
    $this->admin = User::factory()->admin()->create();
    $this->product = Product::factory()->create(['stock_quantity' => 10, 'is_active' => true]);
});

describe('Customer Order Management', function () {
    it('allows authenticated customers to view their orders', function () {
        $order = Order::factory()->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
            ->get(route('orders.index'));

        $response->assertStatus(200)
            ->assertSee($order->order_number);
    });

    it('prevents guests from accessing orders', function () {
        $response = $this->get(route('orders.index'));

        $response->assertRedirect(route('login'));
    });

    it('allows customers to view their order details', function () {
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'stock_quantity' => 10,
            'is_active' => true,
        ]);
        $order = Order::factory()->create(['user_id' => $this->user->id]);
        OrderItem::factory()->create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'product_name' => 'Test Product',
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('orders.show', $order));

        $response->assertStatus(200)
            ->assertSee($order->order_number)
            ->assertSee('Test Product');
    });

    it('prevents customers from viewing other users orders', function () {
        $otherUser = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $otherUser->id]);

        $response = $this->actingAs($this->user)
            ->get(route('orders.show', $order));

        $response->assertStatus(403);
    });

    it('allows customers to cancel pending orders', function () {
        $order = Order::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'pending',
        ]);
        OrderItem::factory()->create([
            'order_id' => $order->id,
            'product_id' => $this->product->id,
            'quantity' => 2,
        ]);

        $initialStock = $this->product->fresh()->stock_quantity;

        $response = $this->actingAs($this->user)
            ->post(route('orders.cancel', $order), [
                'reason' => 'Changed my mind',
            ]);

        $response->assertRedirect(route('orders.show', $order))
            ->assertSessionHas('success');

        expect($order->fresh()->status)->toBe('cancelled');
        expect($this->product->fresh()->stock_quantity)->toBe($initialStock + 2);
    });

    it('prevents customers from cancelling delivered orders', function () {
        $order = Order::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'delivered',
        ]);

        $response = $this->actingAs($this->user)
            ->post(route('orders.cancel', $order), [
                'reason' => 'Changed my mind',
            ]);

        $response->assertRedirect()
            ->assertSessionHas('error');

        expect($order->fresh()->status)->toBe('delivered');
    });
});

describe('Admin Order Management', function () {
    it('allows admins to view all orders', function () {
        $order = Order::factory()->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.orders.index'));

        $response->assertStatus(200)
            ->assertSee($order->order_number);
    });

    it('allows admins to update order status', function () {
        $order = Order::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->admin)
            ->post(route('admin.orders.status.update', $order), [
                'status' => 'processing',
                'notes' => 'Order is being prepared',
            ]);

        $response->assertRedirect(route('admin.orders.show', $order))
            ->assertSessionHas('success');

        expect($order->fresh()->status)->toBe('processing');
    });

    it('creates order history entry when status is updated', function () {
        $order = Order::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'pending',
        ]);

        $this->actingAs($this->admin)
            ->post(route('admin.orders.status.update', $order), [
                'status' => 'processing',
                'notes' => 'Order is being prepared',
            ]);

        $history = $order->histories()->first();

        expect($history)->not->toBeNull();
        expect($history->status)->toBe('processing');
        expect($history->previous_status)->toBe('pending');
    });

    it('allows admins to update payment status', function () {
        $order = Order::factory()->create([
            'user_id' => $this->user->id,
            'payment_status' => 'pending',
        ]);

        $response = $this->actingAs($this->admin)
            ->post(route('admin.orders.payment.update', $order), [
                'payment_status' => 'paid',
                'notes' => 'Payment received',
            ]);

        $response->assertRedirect(route('admin.orders.show', $order))
            ->assertSessionHas('success');

        expect($order->fresh()->payment_status)->toBe('paid');
    });

    it('allows admins to add notes to orders', function () {
        $order = Order::factory()->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->admin)
            ->post(route('admin.orders.note.add', $order), [
                'note' => 'Customer called about delivery',
            ]);

        $response->assertRedirect(route('admin.orders.show', $order))
            ->assertSessionHas('success');

        expect($order->fresh()->notes)->toContain('Customer called about delivery');
    });

    it('prevents non-admins from accessing admin order routes', function () {
        $order = Order::factory()->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
            ->get(route('admin.orders.index'));

        $response->assertStatus(403);
    });

    it('allows admins to cancel orders', function () {
        $order = Order::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->admin)
            ->post(route('admin.orders.cancel', $order), [
                'reason' => 'Out of stock',
            ]);

        $response->assertRedirect(route('admin.orders.show', $order))
            ->assertSessionHas('success');

        expect($order->fresh()->status)->toBe('cancelled');
    });
});

describe('Order Service', function () {
    it('processes pending orders correctly', function () {
        $order = Order::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'pending',
            'payment_status' => 'paid',
        ]);

        $service = new OrderService();
        $service->updateStatus($order, 'processing', 'Order processed');

        expect($order->fresh()->status)->toBe('processing');
    });

    it('cancels orders and restores stock', function () {
        $order = Order::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'pending',
        ]);
        OrderItem::factory()->create([
            'order_id' => $order->id,
            'product_id' => $this->product->id,
            'quantity' => 3,
        ]);

        $initialStock = $this->product->fresh()->stock_quantity;

        $service = new OrderService();
        $service->cancelOrder($order, 'Customer request', $this->user->id);

        expect($order->fresh()->status)->toBe('cancelled');
        expect($this->product->fresh()->stock_quantity)->toBe($initialStock + 3);
    });

    it('returns correct order statistics', function () {
        Order::factory()->count(5)->create(['status' => 'pending']);
        Order::factory()->count(3)->create(['status' => 'processing']);
        Order::factory()->count(2)->create(['status' => 'delivered']);

        $service = new OrderService();
        $stats = $service->getOrderStats();

        expect($stats['pending'])->toBe(5);
        expect($stats['processing'])->toBe(3);
        expect($stats['delivered'])->toBe(2);
    });
});

describe('Cart and Checkout', function () {
    it('calculates cart totals correctly', function () {
        $cart = [
            $this->product->id => 2,
        ];
        session()->put('cart', $cart);

        $response = $this->get(route('cart'));

        $response->assertStatus(200)
            ->assertSee($this->product->name)
            ->assertSee(number_format($this->product->price * 2, 2));
    });
});
