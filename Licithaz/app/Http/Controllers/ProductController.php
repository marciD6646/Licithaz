<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
{
    $query = Product::where('status', '!=', 'sold');

    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    $products = $query->paginate(18)->withQueryString();

    return view('products.index', [
        'products' => $products
    ]);
}

    public function create(): View
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image_url'] = $this->storeProductImage($request->file('image_url'));

        Product::create($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(int $id, AuctionResolutionController $auctionResolutionController): View
    {
        $product = Product::with('bids.user')->findOrFail($id);
        $auctionResolutionController->resolveIfEnded($product);

        return view('products.show', [
            'product' => $product,
            'currentHighestBid' => $product->currentHighestBidAmount(),
            'minimumBid' => $product->minimumNextBidAmount(),
        ]);
    }

    public function edit(Product $product): View
    {
        return view('products.edit', [
            'product' => $product
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product, AuctionResolutionController $auctionResolutionController): RedirectResponse
    {
        $oldProduct = $product->name;
        $data = $request->validated();

        if ($request->hasFile('image_url')) {
            $this->deleteStoredProductImage($product->image_url);
            $data['image_url'] = $this->storeProductImage($request->file('image_url'));
        }

        $product->update($data);

        // Re-evaluate auction status after date change
        $product->refresh();
        $auctionResolutionController->resolveIfEnded($product);

        return redirect()
            ->route('products.index')
            ->with('success', "Product $oldProduct updated successfully.");
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->deleteStoredProductImage($product->image_url);

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', "Product {$product->name} deleted successfully.");
    }

    public function restore(int $id): RedirectResponse
    {
        $product = Product::withTrashed()->findOrFail($id);

        $this->authorize('restore', $product);

        $product->restore();

        return redirect()
            ->route('products.index')
            ->with('success', "Product {$product->name} restored successfully.");
    }

    public function forceDelete(int $id): RedirectResponse
    {
        $product = Product::onlyTrashed()->findOrFail($id);

        $this->authorize('forceDelete', $product);

        $imagePath = $this->storedImagePath($product->image_url);

        $product->bids()->delete();
        $product->forceDelete();

        if ($imagePath) {
            Storage::disk('public')->delete($imagePath);
        }

        return redirect()
            ->route('products.index')
            ->with('success', "Product {$product->name} permanently deleted.");
    }

    public function search(Request $request): JsonResponse
    {
        $searchTerm = trim((string) $request->get('q', ''));

        if ($searchTerm == '') {
            return response()->json([]);
        }

        $products = Product::where('status', '!=', 'sold')
            ->where('name', 'LIKE', "{$searchTerm}%")
            ->limit(5)
            ->get();

        return response()->json($products);
    }

    private function storeProductImage(?UploadedFile $file): ?string
    {
        if ($file === null) {
            return null;
        }

        return 'storage/' . $file->store('products', 'public');
    }

    private function deleteStoredProductImage(?string $imageUrl): void
    {
        $imagePath = $this->storedImagePath($imageUrl);

        if ($imagePath !== null) {
            Storage::disk('public')->delete($imagePath);
        }
    }

    private function storedImagePath(?string $imageUrl): ?string
    {
        if ($imageUrl === null || !str_starts_with($imageUrl, 'storage/')) {
            return null;
        }

        return str_replace('storage/', '', $imageUrl);
    }
}