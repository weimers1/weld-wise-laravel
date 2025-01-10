@props(['title' => '', 'icon' => '', 'link' => ''])
<div
    class="col-4 fs-1 d-flex justify-content-center"
>
    <a
        class="text-decoration-none text-black"
        href="{{ $link }}"
    >
        <div
            class="card-layer shadow cursor-pointer"
        >
            <div
                class="card shadow p-4 hover-darken text-capitalize text-center"
            >
                {{ $title }}
                <i
                    class="pt-3 bi {{ $icon }}"
                ></i>
            </div>
        </div>
    </a>
</div>
