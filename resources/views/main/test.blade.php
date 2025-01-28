<?php
use App\Models\Test;

if (!isset($num_tests_per_page)) {
    $num_tests_per_page = 3;
}

$tests = Test::query();

if (isset($sort) && $sort === 'price_asc') {
    $tests = $tests->orderBy('price', 'asc');
}

if (isset($sort) && $sort === 'price_desc') {
    $tests = $tests->orderBy('price', 'desc');
}

$tests_paginate = $tests->paginate($num_tests_per_page);

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

        <form
            action="/test"
            method="GET"
        >
            <div
                class="row rounded bg-white mb-4 mx-0 p-3"
            >
                <div
                    class="col-10 col-sm-4 my-2 my-sm-0 d-flex"
                >
                    <label
                        class="me-2 mt-1 text-nowrap"
                        for="sort-by"
                    >
                        Sort By
                    </label>
                    <select
                        class="form-control"
                        id="sort-by"
                        name="sort"
                    >
                        <option
                            value="0"
                            {{ !isset($sort) ? 'selected' : '' }}
                        >
                            None
                        </option>
                        <option
                            value="price_desc"
                            {{ isset($sort) && $sort === 'price_desc' ? 'selected' : '' }}
                        >
                            Price High to Low
                        </option>
                        <option
                            value="price_asc"
                            {{ isset($sort) && $sort === 'price_asc' ? 'selected' : '' }}
                        >
                            Price Low to High
                        </option>
                    </select>
                </div>
                <div
                    class="col-6 col-sm-2 mt-2 mt-sm-0 d-flex"
                >
                    <select
                        class="form-control"
                        id="num-per-page"
                        name="num_tests_per_page"
                    >
                        <option
                            value="3"
                            {{ $num_tests_per_page == 3 ? 'selected' : '' }}
                        >
                            3
                        </option>
                        <option
                            value="6"
                            {{ $num_tests_per_page == 6 ? 'selected' : '' }}
                        >
                            6
                        </option>
                        <option
                            value="9"
                            {{ $num_tests_per_page == 9 ? 'selected' : '' }}
                        >
                            9
                        </option>
                    </select>
                    <label
                        class="ms-2 mt-1 text-nowrap"
                        for="num-per-page"
                    >
                        per page
                    </label>
                </div>
                <div
                    class="col-6 text-end mt-2 mt-sm-0"
                >
                    <button
                        class="btn btn-ww-orange"
                        type="submit"
                    >
                        <i
                            class="bi bi-arrow-clockwise"
                        ></i> Reload
                    </button>
                </div>
            </div>
        </form>

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
