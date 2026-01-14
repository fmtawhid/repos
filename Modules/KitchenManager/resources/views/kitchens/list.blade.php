@forelse($kitchens ?? [] as $key => $row)
<tr class="{{ $row->trashed() ? 'table-danger' : '' }}">
    <td class="text-center">{{ $key + 1 + ($kitchens->currentPage() - 1) * $kitchens->perPage() }}</td>
    <td>{{ $row->name }}</td>
    <td>{{ $row->branch?->name ?? '-' }}</td>
    <td>{{ manageDateTime($row->created_at,2) }}</td>
    <td class="text-center">
        @if(!$row->trashed())
            @include("common.active-status-button", ["active" => $row->is_active, "route" => route('admin.kitchens.statusUpdate', $row->id)])
        @else
            <span class="badge bg-secondary">{{ localize('Deleted') }}</span>
        @endif
    </td>
    <td class="text-center">
        @if(!$row->trashed())
            <a href="#" data-id="{{ $row->id }}" class="editIcon"><i data-feather="edit" class="icon-14"></i></a>

            <a href="#" data-id="{{ $row->id }}" data-url="{{ route('admin.kitchens.destroy', $row->id) }}" data-method="DELETE" class="deleteKitchen text-danger ms-1">
                <i data-feather="trash-2" class="icon-14"></i>
            </a>
        @else
            <a href="#" data-id="{{ $row->id }}" data-url="{{ route('admin.kitchens.restore', $row->id) }}" class="restoreKitchen text-success me-1">
                <i data-feather="rotate-ccw" class="icon-14"></i>
            </a>

            <a href="#" data-id="{{ $row->id }}" data-url="{{ route('admin.kitchens.forceDelete', $row->id) }}" class="forceDeleteKitchen text-danger ms-1">
                <i data-feather="trash" class="icon-14"></i>
            </a>
        @endif
    </td>
</tr>
@empty
<x-common.empty-row colspan=6 />
@endforelse
