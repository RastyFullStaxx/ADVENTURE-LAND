@extends('layouts.admin')

@section('title', 'Categories | Admin Panel')

@section('content')
    <h2 style="
        text-align: center;
        margin-bottom: -30px;
        font-size: 4.5rem;
        font-family: 'Lilita One', cursive;
        font-weight: bold;
        color: #ffffff;
        -webkit-text-stroke: 1.2px #0074BC;
        text-shadow: 1px 1px 0 #004085;
    ">
        Manage Categories
    </h2>

    <div class="text-end mb-3 mt-4">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-success fw-bold shadow-sm px-4 py-2 rounded-pill">
            + Add Category
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped border text-center align-middle" style="background-color: #ffffff; border-color: #0074BC;">
            <thead class="text-white" style="background-color: #0074BC;">
                <tr>
                    <th class="py-3">Name</th>
                    <th class="py-3">Description</th>
                    <th class="py-3">Slug</th>
                    <th class="py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ Str::limit($category->description, 80) }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" 
                               class="btn btn-sm btn-outline-primary fw-bold px-3 py-1 rounded-pill">Edit</a>

                            <button onclick="confirmDelete({{ $category->id }})" 
                                    class="btn btn-sm btn-outline-danger fw-bold px-3 py-1 rounded-pill">Delete</button>

                            <form id="delete-form-{{ $category->id }}"
                                  action="{{ route('admin.categories.destroy', $category->id) }}"
                                  method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-muted">No categories found.</td></tr>
                @endforelse
            </tbody>
        </table>
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
