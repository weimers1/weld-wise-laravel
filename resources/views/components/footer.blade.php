<?php
use App\Models\Page;
$pages = Page::footer();
?>
<footer
    class="container"
>
    <div
        class="row row-cols-1 row-cols-sm-3 py-5 my-5 border-top"
    >
        <div
            class="col d-inline-flex text-nowrap justify-content-center"
        >
            <a
                class="align-items-center text-decoration-none p-1"
                id="footer-logo"
                href="/"
            >
                <img
                    class="img-fluid navbar-brand"
                    src="/images/weld-wise.png"
                    alt="Weld WISE"
                />
            </a>
            <span
                class="ms-4 text-white mt-3"
            >
                © {{ date('Y') }} Weld WISE
            </span>
        </div>

        <div
            class="col"
        >
            <ul
                class="nav justify-content-center"
            >
                @foreach ($pages as $nav_item)
                    <x-nav-item
                        class="p-1 text-white-recursive"
                        title="{{ $nav_item['title'] }}"
                        icon=''
                        link="{{ $nav_item['link'] }}"
                    ></x-nav-item>
                @endforeach
            </ul>
        </div>

        <div
            class="col text-nowrap mt-2 text-center text-sm-end"
        >
            <div
                class="row row-cols-1 row-cols-sm-2"
            >
                <div
                    class="col my-2 text-white"
                >
                    Looking for our main website?
                </div>

                <div
                    class="col text-center text-sm-start"
                >
                    <a
                        class="text-white no-underline"
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
    </div>
</footer>
