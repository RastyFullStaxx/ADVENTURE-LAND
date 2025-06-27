@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
<h2 class="mb-4">Edit Product</h2>

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="row g-4">
    @csrf
    @method('PUT')

    <!-- Product Name -->
    <div class="col-md-6">
        <label class="form-label fw-bold">Product Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
    </div>

    <!-- Category -->
    <div class="col-md-6">
        <label class="form-label fw-bold">Category</label>
        <select name="category_id" class="form-select" id="categorySelect" required>
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                        data-name="{{ strtolower($category->name) }}"
                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Description -->
    <div class="col-md-12">
        <label class="form-label fw-bold">Description</label>
        <textarea name="description" rows="3" class="form-control">{{ old('description', $product->description) }}</textarea>
    </div>

    <!-- Price -->
    <div class="col-md-4">
        <label class="form-label fw-bold">Price (₱)</label>
        <input type="number" name="price" class="form-control" step="0.01" value="{{ old('price', $product->price) }}" required>
    </div>

    <!-- Inventory -->
    <div class="col-md-4">
        <label class="form-label fw-bold">Inventory Quantity</label>
        <input type="number" name="inventory_quantity" class="form-control" value="{{ old('inventory_quantity', $product->inventory_quantity) }}" required>
    </div>

    <!-- Extra Fee -->
    <div class="col-md-4">
        <label class="form-label fw-bold">Extra Fee (Optional)</label>
        <input type="number" name="extra_fee" class="form-control" step="0.01" value="{{ old('extra_fee', $product->extra_fee) }}">
    </div>

    <!-- Dimensions -->
    <div class="col-md-6 {{ strtolower($product->category->name) === 'package' ? 'd-none' : '' }}" id="dimensionField">
        <label class="form-label fw-bold">Dimensions</label>
        <input type="text" name="dimension_long" class="form-control" value="{{ old('dimension_long', $product->dimension_long) }}" placeholder="e.g., 10ft x 12ft x 8ft">
    </div>

    <!-- Units -->
    <div class="col-md-6 {{ strtolower($product->category->name) === 'package' ? '' : 'd-none' }}" id="unitsField">
        <label class="form-label fw-bold">Units (if package)</label>
        <input type="text" name="units" class="form-control" value="{{ old('units', $product->units) }}" placeholder="e.g., Slide, Ball Pit, Playhouse">
    </div>

    <!-- Replace Image -->
    <div class="col-md-6">
        <label class="form-label fw-bold">Replace Image (optional)</label>
        <input type="file" name="image" class="form-control">
    </div>

    <!-- Current Image -->
    <div class="col-md-6">
        <label class="form-label fw-bold">Current Image</label>
        <div>
            <img src="{{ asset('images/' . $product->image_path) }}" alt="Current Image" style="max-height: 120px;">
        </div>
    </div>

    <!-- Buttons -->
    <div class="col-12 text-end">
        <button type="button" class="btn btn-secondary me-2" onclick="confirmCancel('{{ route('admin.products.index') }}')">Cancel</button>
        <button type="submit" class="btn btn-primary">Update Product</button>
    </div>
</form>

<!-- Scripts -->
<script src="{{ asset('js/admin.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Confirm Cancel -->
<script>
function confirmCancel(url) {
    Swal.fire({
        title: 'Cancel Editing?',
        text: 'Your unsaved changes will be lost.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, go back',
        cancelButtonText: 'Stay',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}
</script>
@endsection
