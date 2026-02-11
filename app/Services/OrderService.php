<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderHistory;
use App\Notifications\OrderStatusUpdated;
use Illuminate\Support\Facades\Notification;

class OrderService
{
    /**
     * Update order status with history tracking
     */
    public function updateStatus(Order $order, string $newStatus, ?string $notes = null, ?int $userId = null, string $changedBy = 'system'): Order
    {
        $oldStatus = $order->status;

        if ($oldStatus === $newStatus) {
            return $order;
        }

        // Update order status
        $order->update(['status' => $newStatus]);

        // Create history entry
        OrderHistory::create([
            'order_id' => $order->id,
            'status' => $newStatus,
            'previous_status' => $oldStatus,
            'notes' => $notes,
            'user_id' => $userId,
            'changed_by_type' => $changedBy,
        ]);

        // Send notification if customer exists
        if ($order->user) {
            $order->user->notify(new OrderStatusUpdated($order, $oldStatus, $newStatus, $notes));
        }

        return $order->fresh();
    }

    /**
     * Update payment status
     */
    public function updatePaymentStatus(Order $order, string $paymentStatus, ?string $notes = null): Order
    {
        $order->update([
            'payment_status' => $paymentStatus,
            'notes' => $order->notes ? $order->notes . "\n" . $notes : $notes,
        ]);

        return $order->fresh();
    }

    /**
     * Process pending orders (move to processing)
     */
    public function processPendingOrders(int $limit = 50): int
    {
        $orders = Order::where('status', 'pending')
            ->where('payment_status', 'paid')
            ->limit($limit)
            ->get();

        $count = 0;
        foreach ($orders as $order) {
            $this->updateStatus($order, 'processing', 'Order automatically processed by system', null, 'system');
            $count++;
        }

        return $count;
    }

    /**
     * Auto-ship processing orders after 24 hours
     */
    public function autoShipOrders(int $hoursOld = 24, int $limit = 50): int
    {
        $orders = Order::where('status', 'processing')
            ->where('updated_at', '<=', now()->subHours($hoursOld))
            ->limit($limit)
            ->get();

        $count = 0;
        foreach ($orders as $order) {
            $this->updateStatus($order, 'shipped', 'Order automatically shipped after processing', null, 'system');
            $count++;
        }

        return $count;
    }

    /**
     * Mark orders as delivered after shipping time
     */
    public function markDelivered(int $daysShipped = 3, int $limit = 50): int
    {
        $orders = Order::where('status', 'shipped')
            ->whereHas('histories', function ($query) {
                $query->where('status', 'shipped')
                    ->where('created_at', '<=', now()->subDays(3));
            })
            ->limit($limit)
            ->get();

        $count = 0;
        foreach ($orders as $order) {
            $this->updateStatus($order, 'delivered', 'Order marked as delivered', null, 'system');
            $count++;
        }

        return $count;
    }

    /**
     * Get order statistics
     */
    public function getOrderStats(): array
    {
        return [
            'total_orders' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
            'today_orders' => Order::whereDate('created_at', today())->count(),
            'pending_payment' => Order::where('payment_status', 'pending')->count(),
        ];
    }

    /**
     * Cancel order with reason
     */
    public function cancelOrder(Order $order, string $reason, ?int $userId = null): Order
    {
        $this->updateStatus($order, 'cancelled', "Order cancelled: {$reason}", $userId, $userId ? 'admin' : 'system');

        // Restore product stock
        foreach ($order->orderItems as $item) {
            if ($item->product && $item->product->track_quantity) {
                $item->product->increment('stock_quantity', $item->quantity);
            }
        }

        return $order->fresh();
    }

    /**
     * Add note to order
     */
    public function addNote(Order $order, string $note, ?int $userId = null): Order
    {
        $existingNotes = $order->notes ?? '';
        $newNote = sprintf(
            "[%s] %s%s",
            now()->format('Y-m-d H:i'),
            $note,
            $existingNotes ? "\n\n{$existingNotes}" : ''
        );

        $order->update(['notes' => $newNote]);

        return $order->fresh();
    }
}
