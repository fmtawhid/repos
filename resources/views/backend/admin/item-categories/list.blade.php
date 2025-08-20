@forelse($itemCategories ?? [] as $key => $row)
    <tr>
        <td class="text-center">{{ $key + 1 + ($itemCategories->currentPage() - 1) * $itemCategories->perPage() }}</td>
        <td>{{ $row->name }}</td>
        <td>{{ $row->vendor?->full_name ?? ''  }}</td>
        <td class="text-center">
            @include("common.active-status-button",["active" => $row->is_active,"route" => route('admin.item-categories.statusUpdate', $row->id)])
        </td>
        <td class="text-center">

            @if('admin.item-categories.edit')
                <a href="#" data-id={{ $row->id }} class="editIcon">
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Edit') }}"><i data-feather="edit" class="icon-14"></i></span>
                </a>
            @endif

            @if(isRouteExists('admin.item-categories.destroy'))
                <x-delete-btn route="{{ route('admin.item-categories.destroy', $row->id) }}" id="{{ $row->id }}"></x-delete-btn>
            @endif
        </td>
    </tr>
@empty
    <x-common.empty-row colspan=9 />
@endforelse

{{ paginationFooter($itemCategories, 9) }}

