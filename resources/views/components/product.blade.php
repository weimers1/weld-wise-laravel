@props([
    'title' => '',
    'description' => '',
    'price' => '',
])
<x-slot:includes>
    <link
        type="text/css"
        href="/css/product.css"
        rel="stylesheet"
    />
</x-slot:includes>

<div
    class="product col-md-4 col-12 mb-md-0 mb-4 mt-4"
>
    <div
        class="card w-100"
    >
        <div
            class="card-header"
        >
            <h5
                class="py-1 fw-bold"
            >
                {{ $title }}
            </h5>
            <p
                class="h-50 overflow-auto"
            >
                {{ $description }}
            </p>
        </div>
        <div
            class="card-body d-flex"
        >
            <button
                class="btn btn-ww-orange"
                type="button"
            >
                <i
                    class="bi bi-cart"
                ></i> Add to Cart
            </button>
            <span
                class="fw-bold mt-2 ms-auto"
            >
                ${{ number_format($price, 2, '.', ',') }}
            </span>
        </div>
    </div>
</div>
