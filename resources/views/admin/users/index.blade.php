@extends('layouts.admin')

@section('title', 'Users | Admin Panel')

@section('content')
<h2 style="
        text-align: center;
        margin-bottom: -30px;
        font-size: 4.5rem;
        font-family: 'Lilita One', cursive;
        font-weight: bold;
        color: #ffffff;
        -webkit-text-stroke: 1.2px #0074BC;
        text-shadow: 1px 1px 0 #004085;">
    Manage Users
</h2>

<div class="text-end mb-3 mt-4">
    <a href="{{ route('admin.users.create') }}" class="btn btn-success rounded-pill px-4 shadow-sm">
        + Add User
    </a>
</div>

<div class="table-responsive">
    <table class="table table-bordered align-middle text-center shadow-sm">
        <thead class="table-primary text-white" style="background-color: #0074BC;">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @php
                            $roleLabel = $user->role === 'new' ? 'User' : ucfirst(str_replace('-', ' ', $user->role));
                            $badgeClass = match ($user->role) {
                                'admin' => 'bg-danger',
                                'product-manager' => 'bg-info text-dark',
                                'new' => 'bg-success',
                                default => 'bg-secondary'
                            };
                        @endphp

                        <span class="badge px-3 py-2 {{ $badgeClass }}">
                            {{ $roleLabel }}
                        </span>
                    </td>
                    <td>
                        @if ($user->id === auth()->id())
                            <span class="badge bg-secondary text-white px-3 py-2">Current User</span>
                        @elseif ($user->role === 'admin')
                            <button class="btn btn-sm btn-outline-secondary rounded-pill mb-1" disabled title="You can't edit another admin">
                                Edit
                            </button>
                            <button class="btn btn-sm btn-outline-secondary rounded-pill" disabled title="You can't delete another admin">
                                Delete
                            </button>
                        @else
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="btn btn-sm btn-outline-primary rounded-pill mb-1">
                                Edit
                            </a>

                            <button type="button"
                                    class="btn btn-sm btn-outline-danger rounded-pill"
                                    onclick="confirmDelete({{ $user->id }})">
                                Delete
                            </button>

                            <form id="delete-form-{{ $user->id }}"
                                  action="{{ route('admin.users.destroy', $user->id) }}"
                                  method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $users->links() }}
</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#0074BC'
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#d33'
            });
        </script>
    @endif

    <script>
        function confirmDelete(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This will permanently delete the user and all associated data.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${userId}`).submit();
                }
            });
        }
    </script>
@endsection
