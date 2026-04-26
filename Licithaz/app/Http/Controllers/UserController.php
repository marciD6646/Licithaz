<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function toggleBan(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id && $user->is_admin) {
            return redirect()->back()->with('error', 'You cannot ban yourself as admin.');
        }

        if ($user->is_admin) {
            return redirect()->back()->with('error', 'You cannot ban an admin.');
        }

        $user->is_banned = !$user->is_banned;
        $user->save();

        return redirect()->back()->with('success', $user->is_banned ? 'User banned.' : 'User unbanned.');
    }

    public function edit(User $user): View
    {
        $this->authorize('update', $user);

        return view('Users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $this->authorize('update', $user);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6',
            'is_admin' => 'required|boolean',
        ]);

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'is_admin' => $validated['is_admin'],
        ]);

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()
            ->route('dashboard')
            ->with('success', 'User updated successfully.');
    }
}