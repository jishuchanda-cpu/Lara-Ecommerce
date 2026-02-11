<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateOrderRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request): View
    {
        $query = Order::with(['user', 'orderItems']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->input('payment_status'));
        }

        $orders = $query->latest()->paginate(20)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $order->load(['user', 'orderItems.product', 'histories.user']);

        // Build timeline
        $timeline = $this->buildTimeline($order);

        return view('admin.orders.show', compact('order', 'timeline'));
    }

    public function edit(Order $order): View
    {
        $order->load(['user', 'orderItems.product']);
        return view('admin.orders.edit', compact('order'));
    }

    public function update(UpdateOrderRequest $request, Order $order): RedirectResponse
    {
        $data = $request->validated();
        $order->update($data);

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', "Order {$order->order_number} updated successfully.");
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:pending,processing,shipped,delivered,cancelled'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $newStatus = $request->input('status');
        $notes = $request->input('notes');

        if ($order->status === $newStatus) {
            return redirect()->back()->with('error', 'Order is already in this status.');
        }

        $this->orderService->updateStatus(
            $order,
            $newStatus,
            $notes,
            auth()->id(),
            'admin'
        );

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', "Order status updated to {$newStatus}.");
    }

    public function updatePaymentStatus(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'payment_status' => ['required', 'in:pending,paid,failed,refunded'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $this->orderService->updatePaymentStatus(
            $order,
            $request->input('payment_status'),
            $request->input('notes')
        );

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Payment status updated successfully.');
    }

    public function addNote(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'note' => ['required', 'string', 'max:1000'],
        ]);

        $this->orderService->addNote($order, $request->input('note'), auth()->id());

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Note added successfully.');
    }

    public function cancel(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'reason' => ['required', 'string', 'max:500'],
        ]);

        if ($order->status === 'cancelled') {
            return redirect()->back()->with('error', 'Order is already cancelled.');
        }

        if ($order->status === 'delivered') {
            return redirect()->back()->with('error', 'Cannot cancel a delivered order.');
        }

        $this->orderService->cancelOrder($order, $request->input('reason'), auth()->id());

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Order has been cancelled successfully.');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $orderNumber = $order->order_number;

        // Restore stock for order items
        foreach ($order->orderItems as $item) {
            if ($item->product && $item->product->track_quantity) {
                $item->product->increment('stock_quantity', $item->quantity);
            }
        }

        $order->orderItems()->delete();
        $order->histories()->delete();
        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', "Order {$orderNumber} deleted successfully.");
    }

    private function buildTimeline(Order $order): array
    {
        $timeline = [];
        $statuses = ['pending', 'processing', 'shipped', 'delivered'];

        // Add order creation
        $timeline[] = [
            'status' => 'Order Placed',
            'date' => $order->created_at,
            'completed' => true,
            'description' => 'Order received.',
            'icon' => 'clipboard',
        ];

        // Get status history
        $history = $order->histories()->orderBy('created_at')->get();

        foreach ($statuses as $status) {
            $statusHistory = $history->firstWhere('status', $status);

            if ($statusHistory) {
                $timeline[] = [
                    'status' => ucfirst($status),
                    'date' => $statusHistory->created_at,
                    'completed' => true,
                    'description' => $statusHistory->notes ?: '',
                    'user' => $statusHistory->user?->name ?? 'System',
                    'icon' => $this->getStatusIcon($status),
                ];
            } elseif ($order->status !== 'cancelled') {
                $timeline[] = [
                    'status' => ucfirst($status),
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
                'status' => 'Cancelled',
                'date' => $cancelHistory?->created_at,
                'completed' => true,
                'description' => $cancelHistory?->notes ?: 'Order cancelled.',
                'user' => $cancelHistory?->user?->name ?? 'System',
                'icon' => 'x-circle',
                'is_cancelled' => true,
            ];
        }

        return $timeline;
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
