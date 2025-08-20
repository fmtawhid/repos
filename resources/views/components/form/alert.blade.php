@props([
    'color' => 'success',
    'icon'  => '',
    'close' => '',
])

@if($icon)
    @php $icon = ' d-flex'; @endphp
@endif
@if($close)
    @php $close = ' alert-dismissible fade show'; @endphp
@endif

<div {{ $attributes->merge(['class' => 'alert alert-'.$color.$icon.$close]) }} role="alert">
    {{ $slot }}
    @if ($close)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>
