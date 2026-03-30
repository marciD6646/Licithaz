<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return response()->json($users);
    }

    public function banUser(User $user)
    {
        $user->is_banned = true;
        $user->save();
        return response()->json(["msg" => "{$user->name} has been banned"]);
    }

    public function unbanUser(User $user)
    {
        $user->is_banned = false;
        $user->save();
        return response()->json(["msg" => "{$user->name} has been unbanned"]);
    }
}