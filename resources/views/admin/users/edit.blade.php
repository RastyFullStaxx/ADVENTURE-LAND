@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<h2 class="mb-4">Edit User</h2>

<form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="row g-4">
    @csrf
    @method('PUT')

    <div class="col-md-6">
        <label class="form-label fw-bold">Full Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Role</label>
        <select name="role" class="form-select" required>
            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="product-manager" {{ $user->role === 'product-manager' ? 'selected' : '' }}>Product Manager</option>
        </select>
    </div>

    <div class="col-12 text-end">
        <a href="#" class="btn btn-secondary" onclick="confirmCancel('{{ route('admin.users.index') }}')">Cancel</a>
        <button type="submit" class="btn btn-primary">Update User</button>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/admin.js') }}"></script>
@endsection
