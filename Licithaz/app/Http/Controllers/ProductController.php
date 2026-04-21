<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /* Display a listing of the resource.*/
    public function index()
    {
        $products = Product::paginate(18);
        return view('products.index', ['products' => $products]);
    }
    /* Show the form for creating a new resource.*/
    public function create()
    {
        return view('products.create');
    }
    /* Store a newly created resource in storage.*/
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store("products", "public");
            $data['image_url'] = 'storage/' . $imagePath;
        } else {
            $data['image_url'] = null;
        }

        Product::create($data);
        return redirect()->route('products.index');
    }
    /* Display the specified resource. */
    public function show(int $id)
    {
        $product = Product::with('bids.user')->findOrFail($id);

        return view('products.show', [
            'product' => $product,
            'currentHighestBid' => $product->currentHighestBidAmount(),
            'minimumBid' => $product->minimumNextBidAmount(),
        ]);
    }
    /* Show the form for editing the specified resource.*/
    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }
    /* Update the specified resource in storage.*/
    public function update(UpdateProductRequest $request, Product $product)
    {
        $oldProduct = $product->name;
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
        return redirect()->route('products.index')->with('success', "Product $oldProduct updated successfully.");
    }
    /* Remove the specified resource from storage.*/
    public function destroy(Product $product)
    {
        if ($product->image_url && str_starts_with($product->image_url, 'storage/')) {
            Storage::disk('public')->delete(
                str_replace('storage/', '', $product->image_url)
            );
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', "Product $product->name deleted successfully.");
    }

    public function restore(int $id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $this->authorize('restore', $product);
        $product->restore();
        return redirect()->route('products.index')->with('success', "Product $product->name restored successfully.");
    }

    public function forceDelete(int $id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $product);

        $imagePath = null;
        if ($product->image_url && str_starts_with($product->image_url, 'storage/')) {
            $imagePath = str_replace('storage/', '', $product->image_url);
        }

        $product->bids()->delete();
        $product->forceDelete();

        if ($imagePath) {
            Storage::disk('public')->delete($imagePath);
        }

        return redirect()->route('products.index')->with('success', "Product $product->name permanently deleted.");
    }
  public function search(Request $request)
{
    $query = $request->get('q');

    if (!$query) {
        return response()->json([]);
    }

    $products = Product::where('name', 'LIKE', "{$query}%")
        ->limit(5)
        ->get();

    return response()->json($products);
}
}
