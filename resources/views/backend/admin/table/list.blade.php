@forelse($tables ?? [] as $key => $row)
    <tr>
        <td class="text-center">{{ $key + 1 + ($tables->currentPage() - 1) * $tables->perPage() }}</td>
        <td>
            <span class="badge bg-soft-primary rounded-pill">
                {{ $row->table_code }}
            </span>
        </td>
        <td>
            <span class="badge bg-soft-info rounded-pill">
                <strong>{{ $row->number_of_seats ?? '-' }}</strong>
            </span>
        </td>
        <td>
            <span class="badge bg-soft-info rounded-pill">
                <strong>{{ $row->area->name ?? '-' }}</strong>
            </span>
        </td>
        <td>
            <span class="badge bg-soft-info rounded-pill">
                <strong>{{ $row->area->branches->map(function($branch){ return $branch->name; })->implode(', ') ?? '-' }}</strong>
            </span>
        </td>
        <td>{{ manageDateTime($row->created_at,2)  }}</td>
        <td class="text-center">
            @include("common.active-status-button",["active" => $row->is_active,"route" => route('admin.tables.statusUpdate', $row->id)])
        </td>
        <td class="text-center">                
            <a href="#" data-id={{ $row->id }} class="editIcon">
                <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Edit') }}"><i data-feather="edit" class="icon-14"></i></span>
            </a>

            <a href="#"
                data-id="{{ $row->id }}"
                data-url="{{ route('admin.tables.destroy', $row->id) }}"
                data-method="DELETE"
                class="deleteTable text-danger ms-1">
                <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Delete') }}"><i data-feather="trash-2" class="icon-14"></i></span>
            </a>
        </td>
    </tr>
@empty
    <x-common.empty-row colspan=9 />
@endforelse

{{ paginationFooter($tables, 9) }}

