@props([
    "labelTitle" => null,
    "labelText"  => null,
    "show_small" => 1,
])

@if ($show_small)
    <small class="text-muted"> <i data-feather="info" class="icon-14 ms-1"></i>
        <strong>{{ $labelTitle ?? "" }}{{ $labelTitle ? ":" : "" }}</strong> {{ $labelText ?? "" }}
    </small>
@else
    <div class="text-muted"> <i data-feather="info" class="icon-14 ms-1"></i>
        <strong>{{ $labelTitle ?? "" }}{{ $labelTitle ? ":" : "" }}</strong> {{ $labelText ?? "" }}
    </div>
@endif
