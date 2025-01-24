@props([
    'class' => '',
    'title' => '',
    'icon' => 'bi-question-square',
    'link' => '/',
])
<li
    class="nav-item {{ request()->path() === $link ? 'active' : '' }} {{ $class }}"
>
    <a
        class="nav-link"
        href="{{ $link }}"
    >
        <i
            class="bi {{ $icon }}"
        >
        </i> {{ $title }}
    </a>
</li>
