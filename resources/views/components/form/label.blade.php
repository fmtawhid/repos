@props([
    'label'         => '',
    'for'           => '',
    'isRequired'    => false,
])

<label for="{{ $for }}" {{ $attributes->merge(['class' => 'form-label']) }}>
    {{ $label }}
    @if($isRequired)    
        <span class="text-danger">*</span>
    @endif
    {{ $slot }}
</label>
