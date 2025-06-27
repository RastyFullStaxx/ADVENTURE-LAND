@extends('layouts.admin')

@section('title', 'Products | Admin Panel')

@section('content')
    <h2 class="mb-4">Manage Products</h2>

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
        <a href="{{ route('admin.products.create') }}" class="btn btn-success">+ Add Product</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Price (₱)</th>
                    <th>Dimension / Units</th>
                    <th>Inventory</th>
                    <th>Extra Fee</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td><img src="{{ asset('images/' . $product->image_path) }}" alt="Product Image" style="height: 60px; object-fit: contain;"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ Str::limit($product->description, 80) }}</td> {{-- Limit to 80 chars --}}
                        <td>{{ number_format($product->price, 2) }}</td>
                        <td>
                            @if($product->category->name === 'Package')
                                {{ $product->units ?? '—' }}
                            @else
                                {{ $product->dimension_long ?? '—' }}
                            @endif
                        </td>
                        <td>{{ $product->inventory_quantity }}</td>
                        <td>{{ $product->extra_fee ? '₱' . number_format($product->extra_fee, 2) : 'None' }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>

                            <button type="button" class="btn btn-sm btn-danger"
                                onclick="confirmDelete({{ $product->id }})">Delete</button>

                            <form id="delete-form-{{ $product->id }}"
                                  action="{{ route('admin.products.destroy', $product->id) }}"
                                  method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8">No products found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(productId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This will permanently delete the product.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${productId}`).submit();
                }
            });
        }
    </script>
@endsection
