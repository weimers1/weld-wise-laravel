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
                    <a
                        class="nav-link text-ww-grey"
                        href="/"
                    >
                        <i
                            class="bi bi-house-fill"
                        >
                        </i> Home
                    </a>
                    <li
                        class="nav-item"
                    >
                        <a
                            class="nav-link text-ww-grey"
                            href="/faq"
                        >
                            <i
                                class="bi bi-question-circle-fill"
                            >
                            </i> FAQ
                        </a>
                    </li>
                </ul>
                <ul
                    class="navbar-nav mb-2 mb-md-0"
                >
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
                    @endif
                    <li
                        class="nav-item {{ auth()->check() ? 'd-none' : '' }}"
                    >
                        <a
                            class="nav-link text-ww-grey"
                            href="/user/login"
                        >
                            <i
                                class="bi bi-box-arrow-in-right"
                            >
                            </i> Log In
                        </a>
                    </li>
                    <li
                        class="nav-item dropdown {{ auth()->check() ? '' : 'd-none' }}"
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
                            <li>
                                <a
                                    class="dropdown-item btn-ww-orange"
                                    href="/user/settings"
                                >
                                    <i
                                        class="bi bi-gear-fill"
                                    >
                                    </i> Settings
                                </a>
                            </li>
                            <li>
                                <a
                                    class="dropdown-item btn-ww-orange"
                                    href="/"
                                >
                                    <i
                                        class="bi bi-box-arrow-right"
                                    >
                                    </i> Log Out
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
