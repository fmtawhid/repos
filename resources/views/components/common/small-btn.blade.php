@props([
    'icon'      => 'refresh',
    'label'     => 'Generate',
])

<button type="button" data-bs-toggle="offcanvas" {{ $attributes->merge(['class' => 'btn btn-sm btn-secondary pe-2 ps-1 py-0 rounded-pill mb-1 d-inline-flex align-items-center gap-1 sidecanvas-toggler']) }}>
    <span class="material-symbols-rounded lh-1">{{ $icon }}</span>
    <span class="d-inline-block fs-xs"> {{ $label }} </span>
</button>