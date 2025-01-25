<?php
use App\Models\Page;
$pages = Page::header();
?>
<header>
    <nav
        class="navbar navbar-expand-md bg-ww-dark shadow"
        aria-label="Main page navigation"
    >
        <div
            class="container-fluid"
        >
            <a
                class="navbar-brand"
                href="/"
            >
                <img
                    class="img-fluid navbar-brand"
                    src="/images/weld-wise.png"
                    alt="Weld WISE"
                />
            </a>
            <button
                class="navbar-toggler btn-ww-orange"
                data-bs-toggle="collapse"
                data-bs-target="#navbar-pages"
                type="button"
                aria-controls="navbar-pages"
                aria-expanded="false"
                aria-label="Toggle mobile navigation menu"
            >
                <i
                    class="bi bi-list"
                ></i>
            </button>

            <div
                class="collapse navbar-collapse"
                id="navbar-pages"
            >
                <ul
                    class="navbar-nav me-auto mb-2 mb-md-0"
                >
                    @foreach ($pages as $nav_item)
                        <x-nav-item
                            class="text-ww-grey"
                            title="{{ $nav_item['title'] }}"
                            icon="{{ $nav_item['icon'] }}"
                            link="{{ $nav_item['link'] }}"
                        ></x-nav-item>
                    @endforeach
                </ul>
                <ul
                    class="navbar-nav mb-2 mb-md-0"
                >
                    @if (!auth()->check())
                        <x-nav-item
                            class="text-ww-grey"
                            title="Log In"
                            icon="bi-box-arrow-in-right"
                            link="/user/login"
                        ></x-nav-item>
                    @endif
                    @if (auth()->check())
                        <li
                            class="nav-item"
                        >
                            <a
                                class="badge bg-ww-orange mt-2 me-2 text-decoration-none no-underline"
                                href="/user/settings"
                            >
                                {{ auth()->user()->name_first . ' ' . auth()->user()->name_last }}
                            </a>
                        </li>
                        <li
                            class="nav-item dropdown"
                        >
                            <a
                                class="nav-link dropdown-toggle text-ww-grey"
                                id="profile-actions"
                                data-bs-toggle="dropdown"
                                href="#"
                                aria-expanded="false"
                            >
                                <i
                                    class="bi bi-person-fill"
                                >
                                </i> Profile
                            </a>
                            <ul
                                class="dropdown-menu dropdown-menu-end shadow bg-ww-orange"
                                aria-labelledby="profile-actions"
                            >
                                <x-nav-item
                                    class="dropdown-item btn-ww-orange"
                                    title="Settings"
                                    icon="bi-gear-fill"
                                    link="/user/settings"
                                ></x-nav-item>
                                <x-nav-item
                                    class="dropdown-item btn-ww-orange"
                                    title="Log Out"
                                    icon="bi-box-arrow-right"
                                    link="/user/logout"
                                ></x-nav-item>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
