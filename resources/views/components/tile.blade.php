@props(['title' => '', 'icon' => '', 'link' => ''])
<div
    class="col-12 col-md-4 fs-1 d-flex justify-content-center pt-4"
>
    <a
        class="text-decoration-none text-black"
        href="{{ $link }}"
    >
        <div
            class="card-layer shadow cursor-pointer"
        >
            <div
                class="card shadow p-4 hover-darken text-center"
            >
                {{ $title }}
                <i
                    class="bi tile-icon mt-2 mt-md-0 {{ $icon }}"
                ></i>
            </div>
        </div>
    </a>
</div>
