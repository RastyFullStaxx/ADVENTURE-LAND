@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')
<h2 class="mb-4">Add New Product</h2>

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="row g-4">
    @csrf

    <!-- Product Name -->
    <div class="col-md-6">
        <label class="form-label fw-bold">Product Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <!-- Category Dropdown -->
    <div class="col-md-6">
        <label class="form-label fw-bold">Category</label>
        <select name="category_id" class="form-select" id="categorySelect" required>
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" data-name="{{ strtolower($category->name) }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Description -->
    <div class="col-md-12">
        <label class="form-label fw-bold">Description</label>
        <textarea name="description" rows="3" class="form-control"></textarea>
    </div>

    <!-- Price (Admin Only) -->
    @if(auth()->user()->role === 'admin')
        <div class="col-md-4">
            <label class="form-label fw-bold">Price (₱)</label>
            <input type="number" name="price" class="form-control" step="0.01" required>
        </div>
    @else
        <!-- Hidden field for product-manager to set default price -->
        <input type="hidden" name="price" value="0">
    @endif

    <!-- Inventory -->
    <div class="col-md-4">
        <label class="form-label fw-bold">Inventory Quantity</label>
        <input type="number" name="inventory_quantity" class="form-control" required>
    </div>

    <!-- Extra Fee (Admin Only) -->
    @if(auth()->user()->role === 'admin')
        <div class="col-md-4">
            <label class="form-label fw-bold">Extra Fee (Optional)</label>
            <input type="number" name="extra_fee" class="form-control" step="0.01">
        </div>
    @else
        <!-- Hidden field for product-manager to set default extra fee -->
        <input type="hidden" name="extra_fee" value="0">
    @endif

    <!-- Dimensions -->
    <div class="col-md-6" id="dimensionField">
        <label class="form-label fw-bold">Dimensions</label>
        <input type="text" name="dimension_long" class="form-control" placeholder="e.g., 10ft x 12ft x 8ft">
    </div>

    <!-- Units -->
    <div class="col-md-6 d-none" id="unitsField">
        <label class="form-label fw-bold">Units (if package)</label>
        <input type="text" name="units" class="form-control" placeholder="e.g., Slide, Ball Pit, Playhouse">
    </div>

    <!-- Image -->
    <div class="col-md-6">
        <label class="form-label fw-bold">Upload Image</label>
        <input type="file" name="image" class="form-control" required>
    </div>

    <!-- Action Buttons -->
    <div class="col-12 text-end">
        <button type="button" class="btn btn-secondary me-2" onclick="confirmCancel('{{ route('admin.products.index') }}')">Cancel</button>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </div>
</form>

<!-- External Scripts -->
<script src="{{ asset('js/admin.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
