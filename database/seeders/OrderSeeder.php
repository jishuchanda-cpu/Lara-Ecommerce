<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'customer')->get();
        $products = Product::where('is_active', true)->get();

        if ($users->isEmpty()) {
            $this->command->warn('No customers found. Creating sample customers...');
            $users = User::factory(10)->customer()->create();
        }

        if ($products->isEmpty()) {
            $this->command->warn('No products found. Please run ProductSeeder first.');

            return;
        }

        foreach ($users as $user) {
            $orderCount = rand(1, 3);

            for ($i = 0; $i < $orderCount; $i++) {
                $order = Order::factory()->create([
                    'user_id' => $user->id,
                ]);

                $itemCount = rand(1, 5);
                $selectedProducts = $products->random(min($itemCount, $products->count()));

                foreach ($selectedProducts as $product) {
                    $quantity = rand(1, 3);
                    $price = $product->price;
                    $total = $price * $quantity;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'product_sku' => $product->sku,
                        'price' => $price,
                        'quantity' => $quantity,
                        'total' => $total,
                    ]);
                }

                $order->refresh();
                $order->total_amount = $order->orderItems->sum('total');
                $order->save();
            }
        }

        Order::factory(5)->pending()->create();
        Order::factory(10)->completed()->create();
        Order::factory(3)->cancelled()->create();
    }
}
