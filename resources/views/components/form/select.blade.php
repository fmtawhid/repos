@php
    $classes = 'form-select';
    if (!Str::contains($attributes->get('class', ''), 'form-select')) {
        $classes .= ' form-select-sm';
    }
@endphp
<select {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</select>

{{ errorBlock($attributes['name']) }}