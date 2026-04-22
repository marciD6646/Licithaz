<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('status', '!=', 'sold')
            ->paginate(18);

        return view('products.index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('products', 'public');
            $data['image_url'] = 'storage/' . $imagePath;
        } else {
            $data['image_url'] = null;
        }

        Product::create($data);

        return redirect()->route('products.index');
    }

    public function show(int $id)
    {
        $product = Product::with('bids.user')->findOrFail($id);

        if (now()->greaterThan($product->bid_end_date)) {

            if ($product->status === 'active') {

                $highestBid = $product->bids()->orderByDesc('amount')->first();

                if ($highestBid) {
                    $product->winner_id = $highestBid->user_id;
                    $product->status = 'pending_payment';
                } else {
                    $product->status = 'closed';
                }

                $product->save();
            }
        }

        return view('products.show', [
            'product' => $product,
            'currentHighestBid' => $product->currentHighestBidAmount(),
            'minimumBid' => $product->minimumNextBidAmount(),
        ]);
    }

    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $oldProduct = $product->name;
        $data = $request->validated();

        if ($request->hasFile('image_url')) {

            if ($product->image_url && str_starts_with($product->image_url, 'storage/')) {
                Storage::disk('public')->delete(
                    str_replace('storage/', '', $product->image_url)
                );
            }

            $imagePath = $request->file('image_url')->store('products', 'public');
            $data['image_url'] = 'storage/' . $imagePath;
        }

        $product->update($data);

        return redirect()
            ->route('products.index')
            ->with('success', "Product $oldProduct updated successfully.");
    }

    public function destroy(Product $product)
    {
        if ($product->image_url && str_starts_with($product->image_url, 'storage/')) {
            Storage::disk('public')->delete(
                str_replace('storage/', '', $product->image_url)
            );
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', "Product {$product->name} deleted successfully.");
    }

    public function restore(int $id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        $this->authorize('restore', $product);

        $product->restore();

        return redirect()
            ->route('products.index')
            ->with('success', "Product {$product->name} restored successfully.");
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

        return redirect()
            ->route('products.index')
            ->with('success', "Product {$product->name} permanently deleted.");
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return response()->json([]);
        }
        $products = Product::where('status', '!=', 'sold')
            ->where('name', 'LIKE', "{$query}%")
            ->limit(5)
            ->get();
        return response()->json($products);
    }

    public function checkout(Product $product)
    {
        if (!auth()->check()) {
            abort(403);
        }

        if (auth()->id() !== $product->winner_id) {
            abort(403, 'You are not the winner of this auction.');
        }

        if ($product->status !== 'pending_payment') {
            abort(403, 'This auction is not ready for payment.');
        }

        $amount = $product->winningBid()->amount;

        return view('payment', compact('product', 'amount'));
    }

    public function pay(Product $product, Request $request)
    {
        if (!auth()->check()) {
            abort(403);
        }

        if (auth()->id() !== $product->winner_id) {
            abort(403, 'You are not the winner of this auction.');
        }

        if ($product->status !== 'pending_payment') {
            abort(403, 'This product is not awaiting payment.');
        }

        $request->validate([
            'card_name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'card_number' => ['required', 'digits_between:13,19'],
            'expiry_date' => ['required'],
            'cvv' => ['required', 'digits_between:3,4'],
        ]);

        $product->status = 'sold';
        $product->save();

        return redirect()
            ->route('products.index')
            ->with('success', 'Payment successful. You now own the item!');
    }
}