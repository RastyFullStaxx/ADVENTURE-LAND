@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
<h2 class="mb-4">User Management</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Full Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col" class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $index => $user)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <span class="badge {{ $user->role === 'admin' ? 'bg-primary' : 'bg-info' }}">
                    {{ ucfirst($user->role) }}
                </span>
            </td>
            <td class="text-center">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">No users found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection