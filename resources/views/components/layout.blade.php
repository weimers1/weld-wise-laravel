@props(['pageTitle' => 'Home', 'includes' => ''])
<!DOCTYPE
    html
>
<html
    lang="en"
>

    <head>
        <meta
            charset="UTF-8"
        />
        <meta
            name="viewport"
            content="width=device-width"
        />
        <title>Weld WISE - {{ $pageTitle }}</title>

        <!-- Main CSS -->
        <link
            type="text/css"
            href="/css/main.css"
            rel="stylesheet"
        />

        <!-- Bootstrap -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        />
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"
        ></script>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
            rel="stylesheet"
        />

        {{ $includes }}
    </head>

    <body
        class="bg-ww-light user-select-none"
    >

        <x-header></x-header>

        <main
            class="min-vh-100"
        >
            {{ $slot }}
        </main>

        <x-footer></x-footer>

    </body>

</html>
