<?php

namespace App\Livewire\Shop;

use Livewire\Component;
use App\Models\Product;

class MiniCart extends Component
{
    public array $cart = [];
    public float $total = 0;
    public int $itemCount = 0;
    public bool $isOpen = false;

    protected $listeners = ['cart-updated' => 'updateCart'];

    public function mount(): void
    {
        $this->updateCart();
    }

    public function updateCart(): void
    {
        $this->cart = session()->get('cart', []);
        $this->calculateTotals();
    }

    public function calculateTotals(): void
    {
        $this->total = 0;
        $this->itemCount = 0;

        foreach ($this->cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $this->total += $product->price * $quantity;
                $this->itemCount += $quantity;
            }
        }
    }

    public function removeItem(int $productId): void
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);
        $this->updateCart();
    }

    public function updateQuantity(int $productId, int $quantity): void
    {
        if ($quantity < 1) {
            $this->removeItem($productId);
            return;
        }

        $cart = session()->get('cart', []);
        $cart[$productId] = $quantity;
        session()->put('cart', $cart);
        $this->updateCart();
    }

    public function toggleCart(): void
    {
        $this->isOpen = !$this->isOpen;
    }

    public function render()
    {
        $cartItems = [];
        foreach ($this->cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                ];
            }
        }

        return view('livewire.shop.mini-cart', [
            'cartItems' => $cartItems,
        ]);
    }
}
