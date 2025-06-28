@php
    $colorMap = [
        'Playgrounds' => '#99CCFF',
        'Slides' => '#8BC43F',
        'Climbs' => '#EF4445',
        'Ball Pits' => '#FF9900',
        'Packages' => '#FF0099',
    ];
@endphp

@foreach($categories as $category)
<section class="py-5 category-section" id="{{ Str::slug($category->name) }}"
         style="background-color: #fff;">
    <div class="container">
        <!-- Category Header -->
        <div class="text-center mb-4">
            <h2 class="lilita" style="color: {{ $colorMap[$category->name] ?? '#333' }};">
                {{ $category->name }}
            </h2>
        </div>

        <!-- Product Cards -->
        <div class="row justify-content-center">
            @foreach($category->products as $product)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card shadow text-center p-3 border-0"
                         style="border-radius: 15px; background-color: {{ $colorMap[$category->name] }}20;">
                        <img src="{{ asset('images/' . $product->image_path) }}"
                             alt="{{ $product->name }}"
                             class="card-img-top img-fluid"
                             style="border-radius: 10px; max-height: 220px; object-fit: contain;">

                        <div class="card-body">
                            <h5 class="card-title lilita text-dark">{{ $product->name }}</h5>
                            <p class="fw-bold text-dark">PHP {{ number_format($product->price) }}</p>
                            <a href="{{ route('products.show', $product->id) }}"
                                class="btn fw-bold"
                                style="
                                    background-color: {{ $colorMap[$category->name] }};
                                    color: white;
                                    border: 2px solid {{ $colorMap[$category->name] }};
                                ">
                                View Details
                                </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endforeach
