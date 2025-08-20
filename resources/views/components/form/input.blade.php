@props([
    'type'          => 'text',
    'name',
    'placeholder'   => '',
    'value'         => '',
    'showError'     => true,
    'showDiv'       => true,
    'divClass'      => '',
    'showClass'     => false,
    "id"            => '',
    "isChecked"     => false,
    "hasIcon"       => false,
])

@if($showDiv) <div class="input-group {{ $divClass }}" > @endif
    @if ($hasIcon) {{ $slot }} @endif
    <input id="{{ $id }}"
           type="{{ $type }}"
           name="{{ $name }}"
           value="{{ old($name, $value) }}"
           placeholder="{{ $placeholder }}"
           aria-label="{{ $placeholder }}"
           @if($isChecked) checked @endif
           {{ $attributes->class(['form-control form-control-sm' => ($type != 'checkbox' && $type != 'radio'), 'is-invalid' =>  $errors->has($name)]) }}
    />
    @if (!$hasIcon) {{ $slot }} @endif
    @if($showError)
        {{ errorBlock($name) }}
    @endif
@if($showDiv) </div> @endif
