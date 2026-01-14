@forelse($tables ?? [] as $key => $row)
<tr class="{{ $row->trashed() ? 'table-danger' : '' }}">
    <td class="text-center">{{ $key + 1 + ($tables->currentPage() - 1) * $tables->perPage() }}</td>
    <td><span class="badge bg-soft-primary">{{ $row->table_code }}</span></td>
    <td><strong>{{ $row->number_of_seats ?? '-' }}</strong></td>
    <td>{{ $row->area->name ?? '-' }}</td>
    <td>{{ $row->area->branches->pluck('name')->implode(', ') ?? '-' }}</td>
    <td>{{ manageDateTime($row->created_at, 2) }}</td>
    <td class="text-center">
        @if(!$row->trashed())
            @include("common.active-status-button", ["active" => $row->is_active, "route" => route('admin.tables.statusUpdate', $row->id)])
        @else
            <span class="badge bg-secondary">{{ localize('Deleted') }}</span>
        @endif
    </td>
    <td class="text-center">
        @if(!$row->trashed())
            <a href="#" data-id="{{ $row->id }}" class="editIcon"><i data-feather="edit" class="icon-14"></i></a>

            <a href="#"
                data-id="{{ $row->id }}"
                data-url="{{ route('admin.tables.destroy', $row->id) }}"
                data-method="DELETE"
                class="deleteTable text-danger ms-1">
                <i data-feather="trash-2" class="icon-14"></i>
            </a>
        @else
            {{-- RESTORE --}}
            <a href="#"
                data-id="{{ $row->id }}"
                data-url="{{ route('admin.tables.restore', $row->id) }}"
                class="restoreTable text-success me-1">
                <i data-feather="rotate-ccw" class="icon-14"></i>
            </a>

            {{-- FORCE DELETE --}}
            <a href="#"
                data-id="{{ $row->id }}"
                data-url="{{ route('admin.tables.forceDelete', $row->id) }}"
                class="forceDeleteTable text-danger ms-1">
                <i data-feather="trash" class="icon-14"></i>
            </a>
        @endif
    </td>
</tr>
@empty
<x-common.empty-row colspan="9"/>
@endforelse
