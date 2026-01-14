@forelse($itemCategories ?? [] as $key => $row)
<tr class="{{ $row->trashed() ? 'table-danger' : '' }}">
    <td class="text-center">{{ $key + 1 + ($itemCategories->currentPage() - 1) * $itemCategories->perPage() }}</td>
    <td>{{ $row->name }}</td>
    <td>{{ $row->vendor?->full_name ?? '' }}</td>
    <td class="text-center">
        @if(!$row->trashed())
            @include("common.active-status-button", ["active" => $row->is_active, "route" => route('admin.item-categories.statusUpdate', $row->id)])
        @else
            <span class="badge bg-secondary">{{ localize('Deleted') }}</span>
        @endif
    </td>
    <td class="text-center">
        @if(!$row->trashed())
            @if(isRouteExists('admin.item-categories.edit'))
                <a href="#" data-id="{{ $row->id }}" class="editIcon">
                    <span data-bs-toggle="tooltip" title="{{ localize('Edit') }}"><i data-feather="edit" class="icon-14"></i></span>
                </a>
            @endif
            @if(isRouteExists('admin.item-categories.destroy'))
                <x-delete-btn route="{{ route('admin.item-categories.destroy', $row->id) }}" id="{{ $row->id }}"></x-delete-btn>
            @endif
        @else
            @if(isRouteExists('admin.item-categories.restore'))
                <form action="{{ route('admin.item-categories.restore', $row->id) }}" method="POST" class="d-inline me-1">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 text-success" data-bs-toggle="tooltip" title="{{ localize('Restore') }}">
                        <i data-feather="rotate-ccw" class="icon-14"></i>
                    </button>
                </form>
            @endif
            @if(isRouteExists('admin.item-categories.forceDelete'))
                <x-delete-btn route="{{ route('admin.item-categories.forceDelete', $row->id) }}" id="{{ $row->id }}"></x-delete-btn>
            @endif
        @endif
    </td>
</tr>
@empty
<x-common.empty-row colspan="9" />
@endforelse

{{ paginationFooter($itemCategories, 9) }}
