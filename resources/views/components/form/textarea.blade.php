@props([
    'name',
    'placeholder'   => localize('Ex.Your content here'),
    'value'         => '',
    'showError'     => true,
    'showDiv'       => true,
    'divClass'      => '',
    'showClass'     => false,
    "rows"          => 3,
    "cols"          => 5
])

@if($showDiv) <div class=" {{ $divClass }}" > @endif
    <textarea name="{{ $name }}" rows="{{ $rows }}" cols="{{ $cols }}" 
              {{ $attributes->merge(['class' => 'form-control form-control-sm', 'is-invalid' =>  $errors->has($name)]) }}
              placeholder="{{ $placeholder ?? '' }}">{{ old($name,$value) }}{{ $slot }}</textarea>

@if($showDiv) </div> @endif
