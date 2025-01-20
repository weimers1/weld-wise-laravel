<?php
$tiles = [
    [
        'title' => 'Tests',
        'icon' => 'bi-file-text',
        'link' => '/test',
    ],
    [
        'title' => 'FAQ',
        'icon' => 'bi-question-circle',
        'link' => '/faq',
    ],
    [
        'title' => 'Profile',
        'icon' => 'bi-person',
        'link' => '/user/home',
    ],
];
?>
<x-layout
    pageTitle="Home"
>
    <x-slot:includes>
        <link
            type="text/css"
            href="/css/home.css"
            rel="stylesheet"
        />
    </x-slot:includes>

    <x-navbar></x-navbar>

    <div
        class="container pt-3"
    >
        <div
            class="row pt-4"
        >
            <h1
                class="fw-bold"
            >Welcome{{ auth()->check() ? ', ' . auth()->user()->name_first : ' to the Weld WISE testing site' }}!</h1>
        </div>
        <div
            class="row pt-4"
        >
            @foreach ($tiles as $tile)
                <x-tile
                    :title="$tile['title']"
                    :icon="$tile['icon']"
                    :link="$tile['link']"
                ></x-tile>
            @endforeach
        </div>

        <div
            class="row position-absolute bottom-0 pb-3"
        >
            <div
                class="col"
            >
                <span
                    class="d-inline pe-3"
                >
                    Looking for our main website?
                </span>
                <a
                    class="text-light no-underline"
                    href="https://weld-wise.com"
                >
                    <button
                        class="btn btn-ww-orange shadow"
                        type="button"
                    >
                        <i
                            class="bi bi-globe-americas"
                        ></i> Main Website
                    </button>
                </a>
            </div>
        </div>
    </div>
</x-layout>
