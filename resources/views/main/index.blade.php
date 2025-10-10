<?php
use App\Models\Page;
$pages = Page::tiles();
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

    <div
        class="container"
    >
        <h1
            class="text-white mt-4 text-shadow"
        >
            Weld WISE Test Practice Platform
        </h1>
        <h2
            class="text-white mt-4 text-shadow"
        >
            Home
        </h2>
        <div
            class="d-flex align-items-center justify-content-center min-vh-50"
        >
            <div
                class="d-block d-md-flex justify-content-evenly w-100"
            >
                <div
                    class="min-vh-20 d-md-none"
                ></div>
                @foreach ($pages as $tile)
                    <x-tile
                        :title="$tile['title']"
                        :icon="$tile['icon']"
                        :link="$tile['link']"
                    ></x-tile>
                @endforeach
            </div>
        </div>
    </div>

</x-layout>
