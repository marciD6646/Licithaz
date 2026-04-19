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

        if ($user->is_admin) {
            return redirect()->back()->with('error', 'You cannot ban an admin.');
        }

        $user->is_banned = !$user->is_banned;
        $user->save();

        return redirect()->back()->with('success', $user->is_banned ? 'User banned.' : 'User unbanned.');
    }
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6',
            'is_admin' => 'required|boolean',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->is_admin = $validated['is_admin'];

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return redirect()
            ->route('dashboard')
            ->with('success', 'User updated successfully.');
    }
}