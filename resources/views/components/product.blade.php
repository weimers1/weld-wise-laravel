@props([
    'title' => '',
    'description' => '',
    'price' => '',
])
<div
    class="card col-md-4 col"
>
    <div
        class="card-header"
    >
        <h5
            class="py-1 fw-bold"
        >
            Test 1
        </h5>
        <p>
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
