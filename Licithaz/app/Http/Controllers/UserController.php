<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function toggleBan(User $user)
    {
        if (auth()->user()->id === $user->id && $user->is_admin) {
            return redirect()->back()->with('error', 'You cannot ban yourself as admin.');
        }

        $user->is_banned = !$user->is_banned;
        $user->save();

        return redirect()->back()->with('success', $user->is_banned ? 'User banned.' : 'User unbanned.');
    }
}
