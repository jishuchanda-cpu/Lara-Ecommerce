<?php

namespace App\Console\Commands;

use App\Services\OrderService;
use Illuminate\Console\Command;

class ProcessOrders extends Command
{
    protected $signature = 'orders:process
                            {action : The action to perform (process-pending, auto-ship, mark-delivered, stats)}
                            {--limit=50 : Maximum number of orders to process}
                            {--hours=24 : Hours old for auto-ship}
                            {--days=3 : Days since shipping for delivered status}';

    protected $description = 'Process orders with various actions';

    public function handle(OrderService $orderService): int
    {
        $action = $this->argument('action');
        $limit = (int) $this->option('limit');

        switch ($action) {
            case 'process-pending':
                return $this->processPendingOrders($orderService, $limit);

            case 'auto-ship':
                $hours = (int) $this->option('hours');
                return $this->autoShipOrders($orderService, $limit, $hours);

            case 'mark-delivered':
                $days = (int) $this->option('days');
                return $this->markDeliveredOrders($orderService, $limit, $days);

            case 'stats':
                return $this->showStats($orderService);

            default:
                $this->error("Unknown action: {$action}");
                $this->info("Available actions: process-pending, auto-ship, mark-delivered, stats");
                return 1;
        }
    }

    private function processPendingOrders(OrderService $orderService, int $limit): int
    {
        $this->info('Processing pending orders...');

        $count = $orderService->processPendingOrders($limit);

        if ($count > 0) {
            $this->info("Successfully processed {$count} pending orders.");
        } else {
            $this->info('No pending orders to process.');
        }

        return 0;
    }

    private function autoShipOrders(OrderService $orderService, int $limit, int $hours): int
    {
        $this->info("Auto-shipping orders that have been processing for {$hours} hours...");

        $count = $orderService->autoShipOrders($hours, $limit);

        if ($count > 0) {
            $this->info("Successfully shipped {$count} orders.");
        } else {
            $this->info('No orders ready to ship.');
        }

        return 0;
    }

    private function markDeliveredOrders(OrderService $orderService, int $limit, int $days): int
    {
        $this->info("Marking orders as delivered after {$days} days...");

        $count = $orderService->markDelivered($days, $limit);

        if ($count > 0) {
            $this->info("Successfully marked {$count} orders as delivered.");
        } else {
            $this->info('No orders to mark as delivered.');
        }

        return 0;
    }

    private function showStats(OrderService $orderService): int
    {
        $this->info('Order Statistics');
        $this->info('================');

        $stats = $orderService->getOrderStats();

        $this->table(
            ['Metric', 'Value'],
            [
                ['Total Orders', $stats['total_orders']],
                ['Pending', $stats['pending']],
                ['Processing', $stats['processing']],
                ['Shipped', $stats['shipped']],
                ['Delivered', $stats['delivered']],
                ['Cancelled', $stats['cancelled']],
                ['Today\'s Orders', $stats['today_orders']],
                ['Pending Payment', $stats['pending_payment']],
            ]
        );

        return 0;
    }
}
