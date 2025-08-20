@props([
    'colspan' => 8,
    'loading' => '',
    'showH5'  => 1,
    'h5'      => 'No Data Found',
    'text'    => 'There is no data available.',
])

<div class="null-td">
    <span class="bt-content">
        <div class="text-center section-space-y">
            @if ($loading)
                Loading...
            @else
                <span class="material-symbols-rounded fs-48 margin-bottom-5 lh-1">info</span>
                @if($showH5)
                <h5>{{ localize($h5) }}</h5>
                @endif
                <p>{{ localize($text) }}</p>
            @endif
        </div>
    </span>
</div>
