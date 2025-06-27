@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')
<h2 class="mb-4">Add New Category</h2>

<form action="{{ route('admin.categories.store') }}" method="POST" class="row g-4">
    @csrf

    <!-- Name -->
    <div class="col-md-6">
        <label class="form-label fw-bold">Category Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <!-- Description -->
    <div class="col-md-12">
        <label class="form-label fw-bold">Description</label>
        <textarea name="description" rows="3" class="form-control"></textarea>
    </div>

    <!-- Buttons -->
    <div class="col-12 text-end">
        <a href="#" class="btn btn-secondary" onclick="confirmCancel('{{ route('admin.categories.index') }}')">Cancel</a>
        <button type="submit" class="btn btn-primary">Add Category</button>
    </div>
</form>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmCancel(redirectUrl) {
        Swal.fire({
            title: 'Cancel adding?',
            text: "Your progress will be lost.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6c757d',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = redirectUrl;
            }
        });
    }
</script>
@endsection
