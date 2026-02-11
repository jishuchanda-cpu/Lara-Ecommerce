<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    public Order $order;
    public string $oldStatus;
    public string $newStatus;
    public ?string $notes;

    public function __construct(Order $order, string $oldStatus, string $newStatus, ?string $notes = null)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
        $this->notes = $notes;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $statusMessages = [
            'pending' => 'Your order has been received and is awaiting processing.',
            'processing' => 'Your order is now being prepared for shipment.',
            'shipped' => 'Great news! Your order has been shipped and is on its way.',
            'delivered' => 'Your order has been delivered. Enjoy your purchase!',
            'cancelled' => 'Your order has been cancelled.',
        ];

        $message = (new MailMessage)
            ->subject("Order {$this->order->order_number} - Status Updated to " . ucfirst($this->newStatus))
            ->greeting("Hello {$notifiable->name},")
            ->line("Your order **{$this->order->order_number}** status has been updated.")
            ->line("")
            ->line("**Previous Status:** " . ucfirst($this->oldStatus))
            ->line("**New Status:** " . ucfirst($this->newStatus))
            ->line("")
            ->line($statusMessages[$this->newStatus] ?? 'Your order status has been updated.');

        if ($this->notes) {
            $message->line("")
                   ->line("**Note:** {$this->notes}");
        }

        $message->line("")
                ->action('View Order Details', route('orders.show', $this->order))
                ->line("")
                ->line('Thank you for shopping with us!');

        return $message;
    }

    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
            'notes' => $this->notes,
        ];
    }
}
