@extends('layouts.admin')

@section('title', 'Products | Admin Panel')

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
        Manage Products
    </h2>

    <div class="text-end mb-3 mt-4">
        <a href="{{ route('admin.products.create') }}" class="btn btn-success rounded-pill px-4 shadow-sm">
            + Add Product
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle shadow-sm">
            <thead class="table-primary text-white" style="background-color: #0074BC;">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    @if(auth()->user()->role !== 'product-manager')
                        <th>Price (₱)</th>
                    @endif
                    <th>Dimension / Units</th>
                    <th>Inventory</th>
                    @if(auth()->user()->role !== 'product-manager')
                        <th>Extra Fee</th>
                    @endif
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>
                            <img src="{{ asset('images/' . $product->image_path) }}"
                                 alt="Product Image"
                                 style="height: 60px; object-fit: contain; border: 1px solid #ccc; border-radius: 8px;">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ Str::limit($product->description, 80) }}</td>

                        @if(auth()->user()->role !== 'product-manager')
                            <td>₱{{ number_format($product->price, 2) }}</td>
                        @endif

                        <td>
                            @if($product->category->name === 'Package')
                                {{ $product->units ?? '—' }}
                            @else
                                {{ $product->dimension_long ?? '—' }}
                            @endif
                        </td>

                        <td>{{ $product->inventory_quantity }}</td>

                        @if(auth()->user()->role !== 'product-manager')
                            <td>{{ $product->extra_fee ? '₱' . number_format($product->extra_fee, 2) : 'None' }}</td>
                        @endif

                        <td>
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                               class="btn btn-sm btn-outline-primary rounded-pill mb-1">
                                Edit
                            </a>

                            <button type="button"
                                    class="btn btn-sm btn-outline-danger rounded-pill"
                                    onclick="confirmDelete({{ $product->id }})">
                                Delete
                            </button>

                            <form id="delete-form-{{ $product->id }}"
                                  action="{{ route('admin.products.destroy', $product->id) }}"
                                  method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role !== 'product-manager' ? '9' : '7' }}">No products found.</td>
                    </tr>
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
