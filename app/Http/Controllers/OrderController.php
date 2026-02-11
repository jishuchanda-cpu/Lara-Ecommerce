<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display customer's order history
     */
    public function index(): View
    {
        $orders = Order::where('user_id', auth()->id())
            ->with(['orderItems.product'])
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Display order details with timeline
     */
    public function show(Order $order): View
    {
        // Ensure user can only view their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['orderItems.product', 'histories.user']);

        // Build timeline data
        $timeline = $this->buildTimeline($order);

        return view('orders.show', compact('order', 'timeline'));
    }

    /**
     * Cancel an order
     */
    public function cancel(Order $order, Request $request)
    {
        // Ensure user can only cancel their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Only allow cancellation of pending or processing orders
        if (!in_array($order->status, ['pending', 'processing'])) {
            return redirect()->back()->with('error', 'This order cannot be cancelled.');
        }

        $request->validate([
            'reason' => ['required', 'string', 'max:500'],
        ]);

        $orderService = app(\App\Services\OrderService::class);
        $orderService->cancelOrder($order, $request->input('reason'), auth()->id());

        return redirect()->route('orders.show', $order)
            ->with('success', 'Your order has been cancelled successfully.');
    }

    /**
     * Build order status timeline
     */
    private function buildTimeline(Order $order): array
    {
        $timeline = [];
        $statuses = ['pending', 'processing', 'shipped', 'delivered'];

        // Add order creation
        $timeline[] = [
            'status' => 'Order Placed',
            'date' => $order->created_at,
            'completed' => true,
            'description' => 'Your order has been received and is being processed.',
            'icon' => 'clipboard',
        ];

        // Get status history
        $history = $order->histories()->orderBy('created_at')->get();

        foreach ($statuses as $status) {
            $statusHistory = $history->firstWhere('status', $status);

            if ($statusHistory) {
                $timeline[] = [
                    'status' => $this->getStatusLabel($status),
                    'date' => $statusHistory->created_at,
                    'completed' => true,
                    'description' => $statusHistory->notes ?: $this->getStatusDescription($status),
                    'icon' => $this->getStatusIcon($status),
                ];
            } elseif ($order->status !== 'cancelled') {
                // If status not yet reached and order not cancelled
                $timeline[] = [
                    'status' => $this->getStatusLabel($status),
                    'date' => null,
                    'completed' => false,
                    'description' => 'Pending',
                    'icon' => $this->getStatusIcon($status),
                ];
            }
        }

        // Add cancellation if order is cancelled
        if ($order->status === 'cancelled') {
            $cancelHistory = $history->firstWhere('status', 'cancelled');
            $timeline[] = [
                'status' => 'Order Cancelled',
                'date' => $cancelHistory?->created_at,
                'completed' => true,
                'description' => $cancelHistory?->notes ?: 'Your order has been cancelled.',
                'icon' => 'x-circle',
                'is_cancelled' => true,
            ];
        }

        return $timeline;
    }

    private function getStatusLabel(string $status): string
    {
        $labels = [
            'pending' => 'Order Confirmed',
            'processing' => 'Processing',
            'shipped' => 'Shipped',
            'delivered' => 'Delivered',
        ];

        return $labels[$status] ?? ucfirst($status);
    }

    private function getStatusDescription(string $status): string
    {
        $descriptions = [
            'pending' => 'Your order is confirmed and awaiting processing.',
            'processing' => 'Your order is being prepared for shipment.',
            'shipped' => 'Your order has been shipped and is on its way.',
            'delivered' => 'Your order has been delivered.',
        ];

        return $descriptions[$status] ?? '';
    }

    private function getStatusIcon(string $status): string
    {
        $icons = [
            'pending' => 'check',
            'processing' => 'refresh',
            'shipped' => 'truck',
            'delivered' => 'home',
        ];

        return $icons[$status] ?? 'circle';
    }
}
