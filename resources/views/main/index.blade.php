<?php
$pages = [
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
    [
        'title' => 'Log In',
        'icon' => 'bi-box-arrow-in-right',
        'link' => '/user/login',
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

    <div
        class="container pt-3"
    >
        <div
            class="row pt-4"
        >
            @foreach ($pages as $tile)
                <x-tile
                    :title="$tile['title']"
                    :icon="$tile['icon']"
                    :link="$tile['link']"
                ></x-tile>
            @endforeach
        </div>
    </div>

</x-layout>
