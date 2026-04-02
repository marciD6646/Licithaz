<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy("id", "desc")->get();
        return response()->json(["products" => $products]);
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store("products", "public");
            $data['image_url'] = 'storage/' . $imagePath;
        } else {
            $data['image_url'] = null;
        }

        $newProduct = Product::create($data);
        return response()->json(["msg" => "{$newProduct->name} created successfully", "product" => $newProduct]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json(["product" => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('image_url')) {
            // Delete old image if it's a stored file
            if ($product->image_url && str_starts_with($product->image_url, 'storage/')) {
                Storage::disk('public')->delete(
                    str_replace('storage/', '', $product->image_url)
                );
            }

            $imagePath = $request->file('image_url')->store("products", "public");
            $data['image_url'] = 'storage/' . $imagePath;
        }

        $product->update($data);
        return response()->json(["msg" => "{$product->name} updated successfully", "product" => $product]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image_url && str_starts_with($product->image_url, 'storage/')) {
            Storage::disk('public')->delete(
                str_replace('storage/', '', $product->image_url)
            );
        }

        $product->delete();
        return response()->json(["msg" => "{$product->name} deleted successfully"]);
    }
}
