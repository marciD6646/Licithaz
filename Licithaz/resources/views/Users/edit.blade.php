@extends('layouts.app')

@section('content')
    <div class="edit-product-container">
        <h1>Edit User</h1>

        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            @method('PUT')

            <div>
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div>
                <label>New Password</label>
                <input type="password" name="password" placeholder="Leave empty to keep current password">
            </div>

            <div>
                <label>Role</label>
                <select name="is_admin" class="selector">
                    <option value="0" {{ !$user->is_admin ? 'selected' : '' }}>User</option>
                    <option value="1" {{ $user->is_admin ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <button type="submit" class="btn-update">
                Update User
            </button>
        </form>
    </div>
@endsection