<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                }
                );
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        if ($request->filled('status')) {
            $status = $request->input('status');
            if ($status === 'active') {
                $query->where('is_active', true);
            }
            elseif ($status === 'inactive') {
                $query->where('is_active', false);
            }
            elseif ($status === 'low_stock') {
                $query->where('stock_quantity', '<=', 5)->where('is_active', true);
            }
            elseif ($status === 'out_of_stock') {
                $query->where('stock_quantity', 0);
            }
        }

        $products = $query->latest()->paginate(20)->withQueryString();
        $categories = Category::where('is_active', true)->orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', true);
        $data['track_quantity'] = $request->boolean('track_quantity', true);

        // Handle image uploads
        $imagePaths = [];

        // Add existing images if provided
        if ($request->has('existing_images')) {
            $imagePaths = array_merge($imagePaths, $request->input('existing_images'));
        }

        // Handle new uploaded images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('products', $filename, 'public');
                $imagePaths[] = $path;
            }
        }

        $data['images'] = $imagePaths;

        $product = Product::create($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', "Product '{$product->name}' created successfully.");
    }

    public function show(Product $product): View
    {
        $product->load(['category', 'orderItems.order']);
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();

        if ($request->has('is_active')) {
            $data['is_active'] = $request->boolean('is_active');
        }

        if ($request->has('track_quantity')) {
            $data['track_quantity'] = $request->boolean('track_quantity');
        }

        // Handle image uploads
        $imagePaths = [];

        // Add existing images that should be kept
        if ($request->has('existing_images')) {
            $imagePaths = $request->input('existing_images');
        }

        // Handle new uploaded images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('products', $filename, 'public');
                $imagePaths[] = $path;
            }
        }

        // Delete images that were removed
        if (!empty($product->images)) {
            foreach ($product->images as $oldImage) {
                // Skip null or empty image paths
                if (empty($oldImage)) {
                    continue;
                }

                if (!in_array($oldImage, $imagePaths)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        }

        $data['images'] = $imagePaths;

        $product->update($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', "Product '{$product->name}' updated successfully.");
    }

    public function destroy(Product $product): RedirectResponse
    {
        $name = $product->name;

        // Delete all associated images from storage
        if (!empty($product->images)) {
            foreach ($product->images as $image) {
                // Skip null or empty image paths
                if (!empty($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', "Product '{$name}' deleted successfully.");
    }
}
