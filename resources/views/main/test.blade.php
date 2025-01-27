<?php
use App\Models\Test;
$tests = Test::paginate(3);
?>
<x-layout
    pageTitle="Tests"
>

    <div
        class="container pt-3"
    >
        <h1
            class="text-white my-4"
        >
            Browse Tests
        </h1>

        <div
            class="row"
        >
            @foreach ($tests as $product)
                <x-product
                    title="{{ $product['title'] }}"
                    description="{{ $product['description'] }}"
                    price="{{ $product['price'] }}"
                ></x-product>
            @endforeach
        </div>

        <div
            class="rounded bg-white mt-2 px-4 pt-3"
        >
            {{ $tests->links() }}
        </div>
    </div>

</x-layout>
