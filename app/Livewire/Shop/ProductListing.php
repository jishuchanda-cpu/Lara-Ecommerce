<?php

namespace App\Livewire\Shop;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductListing extends Component
{
    use WithPagination;

    public string $search = '';
    public ?int $categoryId = null;
    public string $sortBy = 'latest';
    public string $viewMode = 'grid';
    public array $priceRange = ['min' => '', 'max' => ''];
    public bool $showFilters = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryId' => ['except' => null],
        'sortBy' => ['except' => 'latest'],
        'viewMode' => ['except' => 'grid'],
    ];

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCategoryId(): void
    {
        $this->resetPage();
    }

    public function updatedSortBy(): void
    {
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->reset(['search', 'categoryId', 'sortBy', 'priceRange']);
        $this->resetPage();
    }

    public function toggleViewMode(): void
    {
        $this->viewMode = $this->viewMode === 'grid' ? 'list' : 'grid';
    }

    public function render()
    {
        $query = Product::query()
            ->with('category')
            ->where('is_active', true);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%")
                  ->orWhere('sku', 'like', "%{$this->search}%");
            });
        }

        if ($this->categoryId) {
            $query->where('category_id', $this->categoryId);
        }

        if ($this->priceRange['min'] !== '') {
            $query->where('price', '>=', $this->priceRange['min']);
        }

        if ($this->priceRange['max'] !== '') {
            $query->where('price', '<=', $this->priceRange['max']);
        }

        switch ($this->sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12);
        $categories = Category::where('is_active', true)->orderBy('name')->get();

        return view('livewire.shop.product-listing', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
