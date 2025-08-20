

@forelse($categories as $category)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $category->name }}</td>
        <td class="text-center">
            @include("common.active-status-button",["active" => $category->is_active,"route" => route('admin.support-categories.statusUpdate', $category->id)])
        </td>
        <td class="text-center">
            @if(isRouteExists("admin.support-categories.edit"))
                <a href="#"
                   data-update-url="{{ route('admin.support-categories.update', $category->id) }}"
                   data-url="{{ route('admin.support-categories.edit',$category->id) }}"
                   data-id="{{ $category->id }}"
                   class="editIcon">
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Edit Category') }}"><i data-feather="edit" class="icon-14"></i></span>
                </a>
            @endif

            @if(isRouteExists("admin.support-categories.destroy"))
                <a href="#" data-id="{{ $category->id }}"
                               data-href="{{ route('admin.support-categories.destroy', $category->id) }}"
                               data-method="DELETE"
                               class="erase btn-sm p-0 bg-transparent border-0"
                               type="button">
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Delete Category') }}" class="text-danger ms-1"><i data-feather="trash-2" class="icon-14"></i></span>
                </a>
            @endif
        </td>
    </tr>
@empty
     <x-common.empty-row colspan=4 />
@endforelse
{{ paginationFooter($categories, 4) }}
