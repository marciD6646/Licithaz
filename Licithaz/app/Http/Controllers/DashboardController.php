<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $products = Product::all();
        $trashedProducts = Product::onlyTrashed()->orderByDesc('deleted_at')->get();

        return view('dashboard', compact('users', 'products', 'trashedProducts'));
    }
}
