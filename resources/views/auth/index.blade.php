<x-layout
    pageTitle="Log In"
>
    <x-slot:includes>
        <link
            type="text/css"
            href="/css/login.css"
            rel="stylesheet"
        />
    </x-slot:includes>

    <div
        class="container"
    >
        <div
            class="row pt-4 justify-content-center"
        >
            <div
                class="col-lg-6 col-12"
            >
                <x-auth-form
                    :errors="$errors"
                ></x-auth-form>
            </div>
        </div>
    </div>

    @if (session('modal_info'))
        {{-- If modal info is being passed, show the modal --}}
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

</x-layout>
