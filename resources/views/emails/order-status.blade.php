<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Status Update</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #111827;
            margin: 0;
            font-size: 24px;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            margin-top: 10px;
        }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-processing { background-color: #dbeafe; color: #1e40af; }
        .status-shipped { background-color: #e0e7ff; color: #3730a3; }
        .status-delivered { background-color: #d1fae5; color: #065f46; }
        .status-cancelled { background-color: #fee2e2; color: #991b1b; }
        .order-info {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
        }
        .order-info p {
            margin: 8px 0;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #2563eb;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 20px 0;
        }
        .button:hover {
            background-color: #1d4ed8;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 14px;
        }
        .items-list {
            margin: 20px 0;
        }
        .item {
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Order Status Update</h1>
            <div class="status-badge status-{{ $status }}">
                {{ ucfirst($status) }}
            </div>
        </div>

        <p>Hello {{ $order->user->name ?? 'Valued Customer' }},</p>

        <p>Your order <strong>{{ $order->order_number }}</strong> status has been updated.</p>

        <div class="order-info">
            <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('F d, Y') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($status) }}</p>
            <p><strong>Total:</strong> ${{ number_format($order->total_amount, 2) }}</p>
        </div>

        @if($order->orderItems->count() > 0)
        <div class="items-list">
            <h3>Order Items:</h3>
            @foreach($order->orderItems as $item)
            <div class="item">
                <strong>{{ $item->product_name }}</strong><br>
                Qty: {{ $item->quantity }} × ${{ number_format($item->price, 2) }}
            </div>
            @endforeach
        </div>
        @endif

        <div style="text-align: center;">
            <a href="{{ route('orders.show', $order) }}" class="button">View Order Details</a>
        </div>

        <p>If you have any questions about your order, please don't hesitate to contact our customer service team.</p>

        <div class="footer">
            <p>Thank you for shopping with us!</p>
            <p>{{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>
