<?php
$products = [
    [
        'title' => 'Test 1',
        'description' => 'This is a sample description of test 1. There is a decent amount of text here to show what
            it might look like on multiple lines.',
        'price' => 35.0,
    ],
];
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
            <div
                class="col"
            >

            </div>
        </div>

        <div
            class="row-cols-1 row-cols-sm-3"
        >
            @foreach ($products as $test)
                <x-product
                    title="{{ $test['title'] }}"
                    description="{{ $test['description'] }}"
                    price="{{ $test['price'] }}"
                ></x-product>
            @endforeach
        </div>
    </div>

</x-layout>
