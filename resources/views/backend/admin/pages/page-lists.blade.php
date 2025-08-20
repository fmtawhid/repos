

@forelse($pages as $page)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $page->title }}</td>
        <td>{{ \Request::root() . '/' . $page->slug }}</td>
        <td class="text-center">
             @include("common.active-status-button",["active" => $page->is_active,"route" => route('admin.pages.statusUpdate', $page->id)])
        </td>
        <td class="text-center">
            @if(isRouteExists("admin.pages.edit"))
                <a href="#"
                   data-update-url="{{ route('admin.pages.update', $page->id) }}"
                   data-url="{{ route('admin.pages.edit',$page->id) }}"
                   data-id="{{ $page->id }}"
                   class="editIcon">
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Edit') }}"><i data-feather="edit" class="icon-14"></i></span>
                </a>
            @endif

            @if(isRouteExists("admin.pages.destroy"))
                <a href="#" data-id="{{ $page->id }}"
                               data-href="{{ route('admin.pages.destroy', $page->id) }}"
                               data-method="DELETE"
                               class="erase btn-sm p-0 bg-transparent border-0"
                               type="button">
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Delete') }}" class="text-danger ms-1"><i data-feather="trash-2" class="icon-14"></i></span>
                </a>
            @endif
        </td>
    </tr>
@empty
     <x-common.empty-row colspan=5 />
@endforelse
{{ paginationFooter($pages, 5) }}
