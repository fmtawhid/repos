@if($items)
<ol {{ $attributes->merge(['class' => 'breadcrumb tt-breadcrumb-dot']) }} >
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    @foreach ($items as $key => $item)
        <li class="breadcrumb-item">@if(!is_null($item['href']) && $item['title'])<a href="{{ $item['href'] }}" @isset($item['target']) target="{{ $item['target'] }}"@endisset>{{ $item['title'] }}</a>@else {{ $item['title'] }} @endif</li>
    @endforeach
</ol>
@endif
