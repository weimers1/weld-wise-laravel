@props([
    'id' => '',
    'title' => '',
])
<div
    class="modal text-black text-center"
    id="{{ $id }}"
>
    <div
        class="modal-dialog"
    >
        <div
            class="modal-content"
        >
            <div
                class="modal-header"
            >
                <h5
                    class="modal-title"
                >{{ $title }}</h5>
                <button
                    class="btn-close"
                    data-bs-dismiss="modal"
                    type="button"
                ></button>
            </div>
            <div
                class="modal-body"
            >
                <p>{{ $slot }}</p>
            </div>
            <div
                class="modal-footer"
            >
                <a
                    class="btn btn-ww-orange"
                    href="/"
                >Okay</a>
            </div>
        </div>
    </div>
</div>
