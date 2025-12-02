<x-layout
    pageTitle="I'm a teapot"
>

    <x-slot:includes>
        <link
            type="text/css"
            href="/css/errors.css"
            rel="stylesheet"
        />
    </x-slot:includes>

    <div
        class="container"
    >
        <div
            class="mt-4 text-center justify-content-center text-white-recursive"
        >
            <p
                class="m-4 fs-2"
            >418 | Unhandled Error</p>
            <div class="m-4 fs-1">🫖</div>
            <p
                class="m-4 fs-4"
            >Unhandled Error | Please contact support (<a href="mailto:{{ env('SUPPORT_EMAIL') }}" class="text-white">{{ env('SUPPORT_EMAIL') }}</a>)</p>
        </div>
    </div>

</x-layout>