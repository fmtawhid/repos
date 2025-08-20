@php
    $name = $name ?? 'is_active';
@endphp

<div class="form-check form-switch d-flex justify-content-center">
    <input type="checkbox"
           name="{{ $name }}"
           id="{{ $name }}"
           class="form-check-input changeStatus"
           data-route="{{ $route }}"
           @checked(isset($active) && $active == 1)
    />
</div>
