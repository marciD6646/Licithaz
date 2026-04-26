<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::orderByDesc('id')->get();

        return response()->json(['products' => $products]);
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['image_url'] = $this->storeProductImage($request->file('image_url'));

        $newProduct = Product::create($data);

        return response()->json([
            'msg' => "{$newProduct->name} created successfully",
            'product' => $newProduct,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): JsonResponse
    {
        return response()->json(['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image_url')) {
            $this->deleteStoredProductImage($product->image_url);
            $data['image_url'] = $this->storeProductImage($request->file('image_url'));
        }

        $product->update($data);

        return response()->json([
            'msg' => "{$product->name} updated successfully",
            'product' => $product,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        $this->deleteStoredProductImage($product->image_url);

        $product->delete();

        return response()->json(['msg' => "{$product->name} deleted successfully"]);
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
