@extends('layouts.admin')

@section('title', 'Add New User')

@section('content')
<h2 class="mb-4">Add New User</h2>

<form action="{{ route('admin.users.store') }}" method="POST" class="row g-4">
    @csrf

    <div class="col-md-6">
        <label class="form-label fw-bold">Full Name</label>
        <input type="text" name="name" class="form-control" placeholder="e.g., Juan Dela Cruz" required>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Email</label>
        <input type="email" name="email" class="form-control" placeholder="e.g., juan@email.com" required>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Role</label>
        <select name="role" class="form-select" required>
            <option value="">-- Select Role --</option>
            <option value="admin">Admin</option>
            <option value="product-manager">Product Manager</option>
        </select>
    </div>

    <div class="col-12 text-end">
        <a href="#" class="btn btn-secondary" onclick="confirmCancel('{{ route('admin.users.index') }}')">Cancel</a>
        <button type="submit" class="btn btn-primary">Add User</button>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/admin.js') }}"></script>
@endsection
