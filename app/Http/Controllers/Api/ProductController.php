<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy("id", "desc")->get();
        return response()->json(["products" => $products]);
    }

    public function store(StoreProductRequest $request)
    {
        $newProduct = Product::create($request->validated());
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
        $product->update($request->validated());
        return response()->json(["msg" => "{$product->name} updated successfully", "product" => $product]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(["msg" => "{$product->name} deleted successfully"]);
    }
}
