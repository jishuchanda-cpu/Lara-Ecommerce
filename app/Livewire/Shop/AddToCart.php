<?php

namespace App\Livewire\Shop;

use Livewire\Component;

class AddToCart extends Component
{
    public int $productId;
    public int $quantity = 1;
    public bool $added = false;
    public bool $pendingAdd = false;

    protected $listeners = ['auth-success' => 'retryAddToCart'];

    public function mount(int $productId): void
    {
        $this->productId = $productId;
    }

    public function increment(): void
    {
        $this->quantity++;
    }

    public function decrement(): void
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart(): void
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            $this->pendingAdd = true;
            $this->dispatch('show-auth-modal');
            return;
        }

        $this->performAddToCart();
    }

    public function retryAddToCart(): void
    {
        if ($this->pendingAdd && auth()->check()) {
            $this->pendingAdd = false;
            $this->performAddToCart();
        }
    }

    protected function performAddToCart(): void
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$this->productId])) {
            $cart[$this->productId] += $this->quantity;
        }
        else {
            $cart[$this->productId] = $this->quantity;
        }

        session()->put('cart', $cart);
        $this->added = true;

        $this->dispatch('cart-updated');

        $this->dispatch('notify', [
            'message' => 'Product added to cart!',
            'type' => 'success'
        ]);

        $this->quantity = 1;

        // Reset added state after 2 seconds
        $this->dispatch('reset-added');
    }

    public function render()
    {
        return view('livewire.shop.add-to-cart');
    }
}
