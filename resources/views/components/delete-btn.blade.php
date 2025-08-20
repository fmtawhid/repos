@props([
    "route",
    "id",
    "method" => "DELETE",
])

<a href="javascript:void(0);"
    data-id="{{ $id }}"
    data-url="{{ $route }}"
    data-method="{{ $method }}"
    class="erase text-danger btn-sm ms-1">
     <span data-bs-toggle="tooltip"
           data-bs-placement="top"
           title="{{ localize('Delete') }}">
         <i data-feather="trash-2" class="icon-14"></i>
         {{ $slot }}
     </span>
</a>
