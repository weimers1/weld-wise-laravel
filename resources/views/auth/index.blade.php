<x-layout
    pageTitle="FAQ"
>
    <x-slot:includes>
        <link
            type="text/css"
            href="/css/login.css"
            rel="stylesheet"
        />
    </x-slot:includes>

    <x-navbar></x-navbar>

    <div
        class="container"
    >
        <div
            class="row pt-4 justify-content-center"
        >
            <div
                class="col-lg-6 col-12"
            >
                <div
                    class="card p-4 shadow"
                >
                    <div
                        class="card-body"
                    >
                        <ul
                            class="nav nav-pills nav-justified pb-4"
                        >
                            <li
                                class="nav-item"
                            >
                                <a
                                    class="nav-link {{ $errors->has('email_log_in') ? '' : 'active' }} cursor-pointer"
                                    data-bs-toggle="pill"
                                    data-bs-target="#sign-up-tab"
                                >
                                    Sign Up
                                </a>
                            </li>
                            <li
                                class="nav-item"
                            >
                                <a
                                    class="nav-link {{ $errors->has('email_log_in') ? 'active' : '' }} cursor-pointer"
                                    data-bs-toggle="pill"
                                    data-bs-target="#log-in-tab"
                                >
                                    Log In
                                </a>
                            </li>
                        </ul>
                        <div
                            class="tab-content"
                        >
                            <div
                                class="tab-pane {{ $errors->has('email_log_in') ? '' : 'active show' }}"
                                id="sign-up-tab"
                            >
                                <form
                                    method="POST"
                                    action="/user/create"
                                >
                                    @csrf
                                    <h5
                                        class="card-title mb-4"
                                    >Sign Up</h5>
                                    <label
                                        for="name-first"
                                    >First Name</label>
                                    <input
                                        class="form-control"
                                        id="name-first"
                                        name="name_first"
                                        type="text"
                                        value="{{ old('name_first') }}"
                                    />
                                    @if ($errors->has('name_first'))
                                        <div
                                            class="error"
                                        >{{ $errors->first('name_first') }}</div>
                                    @endif
                                    <label
                                        class="mt-4"
                                        for="name-last"
                                    >Last Name</label>
                                    <input
                                        class="form-control"
                                        id="name-last"
                                        name="name_last"
                                        type="text"
                                        value="{{ old('name_last') }}"
                                    />
                                    @if ($errors->has('name_last'))
                                        <div
                                            class="error"
                                        >{{ $errors->first('name_last') }}</div>
                                    @endif
                                    <label
                                        class="mt-4"
                                        for="email-sign-up"
                                    >Email</label>
                                    <input
                                        class="form-control"
                                        id="email-sign-up"
                                        name="email_sign_up"
                                        type="email"
                                        value="{{ old('email_sign_up') }}"
                                    />
                                    @if ($errors->has('email_sign_up'))
                                        <div
                                            class="error"
                                        >{{ $errors->first('email_sign_up') }}</div>
                                    @endif
                                    <label
                                        class="mt-4"
                                        for="email-confirmation"
                                    >Confirm Email</label>
                                    <input
                                        class="form-control"
                                        id="email-confirmation"
                                        name="email_sign_up_confirmation"
                                        type="email"
                                    />
                                    <button
                                        class="btn btn-ww-orange mt-4"
                                        type="submit"
                                    >Sign Up</button>
                                </form>
                            </div>
                            <div
                                class="tab-pane {{ $errors->has('email_log_in') ? 'active show' : '' }}"
                                id="log-in-tab"
                            >
                                <form
                                    method="POST"
                                    action="/user/login"
                                >
                                    @csrf
                                    <h5
                                        class="card-title mb-4"
                                    >Log In</h5>
                                    <label
                                        for="email-log-in"
                                    >Email</label>
                                    <input
                                        class="form-control"
                                        id="email-log-in"
                                        name="email_log_in"
                                        type="email"
                                        value="{{ old('email_log_in') }}"
                                    />
                                    @if ($errors->has('email_log_in'))
                                        <div
                                            class="error"
                                        >{{ $errors->first('email_log_in') }}</div>
                                    @endif
                                    <button
                                        class="btn btn-ww-orange mt-4"
                                        type="submit"
                                    >Log In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

@if (session('modal_info'))
    <x-modal
        id="modal"
        title="{{ session('modal_info')['title'] }}"
    >{{ session('modal_info')['body'] }}</x-modal>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const modal = new bootstrap.Modal(document.getElementById('modal'));
            modal.show();
        });
    </script>
@endif
