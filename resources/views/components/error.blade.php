@props([
    "name" => null
])

@if(!empty($name))
    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
@endif
