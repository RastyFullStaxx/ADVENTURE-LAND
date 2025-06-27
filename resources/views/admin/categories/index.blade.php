@extends('layouts.admin')

@section('title', 'Categories | Admin Panel')

@section('content')
    <h2 class="mb-4">Manage Categories</h2>

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

    <div class="text-end mb-3">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-success">+ Add Category</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ Str::limit($category->description, 80) }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-primary">Edit</a>

                            <button onclick="confirmDelete({{ $category->id }}, true)" class="btn btn-danger btn-sm">Delete</button>

                            <form id="delete-form-{{ $category->id }}"
                                  action="{{ route('admin.categories.destroy', $category->id) }}"
                                  method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4">No categories found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(categoryId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This will permanently delete the category.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${categoryId}`).submit();
                }
            });
        }
    </script>
@endsection
