<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{

    public function show(): View
    {
        $user = Auth::user()->load([
            'bids' => function ($query) {
                $query->latest()->with('product');
            },
        ]);

        return view('profile', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|max:2048',
            ]);
            
            $user->name = $request->name;
            
            if ($request->hasFile('avatar')) {
                $path = $request->file('avatar')->store('avatars', 'public');
                $user->avatar = $path;
                }

                $user->save();
                
                return back()->with('status', 'Profile updated successfully!');
                }
                public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'password' => [
            'required',
            'confirmed',
            Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
        ],
    ]);

    if (!Hash::check($request->current_password, auth()->user()->password)) {
        throw ValidationException::withMessages([
            'current_password' => 'Current password is incorrect',
        ]);
    }

    auth()->user()->update([
        'password' => Hash::make($request->password)
    ]);

    return back()->with('success', 'Password updated successfully!');
    
}

}