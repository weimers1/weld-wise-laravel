<x-layout
    pageTitle="Unauthorized"
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
            >401 | Unauthorized</p>
            <p
                class="m-4 fs-4"
            >You don't have permission to access this resource. Please log in or contact support (<a href="mailto:{{ env('SUPPORT_EMAIL') }}" class="text-white">{{ env('SUPPORT_EMAIL') }}</a>) if you believe this is an error.</p>
        </div>
    </div>

</x-layout>