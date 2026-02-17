<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function show(User $user)
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

}