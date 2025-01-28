<?php
use App\Models\Test;

$num_tests_per_page = 6;

$tests = Test::query();

$tests_paginate = $tests->paginate($num_tests_per_page);

?>
<x-layout
    pageTitle="Tests"
>

    <div
        class="container pt-3"
    >
        <h1
            class="text-white mt-4"
        >
            Browse Tests
        </h1>

        <div
            class="row"
        >
            @foreach ($tests_paginate as $product)
                <x-product
                    title="{{ $product['title'] }}"
                    description="{{ $product['description'] }}"
                    price="{{ $product['price'] }}"
                ></x-product>
            @endforeach
        </div>

        @if ($tests_paginate->total() > $num_tests_per_page)
            <div
                class="rounded bg-white mt-4 px-4 pt-3"
            >
                {{ $tests_paginate->links() }}
            </div>
        @endif
    </div>

</x-layout>
