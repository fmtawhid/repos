@forelse($branches ?? [] as $key => $row)
<tr class="{{ $row->trashed() ? 'table-danger' : '' }}">
    <td class="text-center">
        {{ $key + 1 + ($branches->currentPage() - 1) * $branches->perPage() }}
    </td>

    <td>{{ $row->name }}</td>
    <td>{{ $row->address ?? '-' }}</td>
    <td>{{ $row->mobile_no ?? '-' }}</td>
    <td>{{ $row->email ?? '-' }}</td>
    <td>{{ manageDateTime($row->created_at, 2) }}</td>

    <td class="text-center">
        <span class="badge {{ $row->is_active ? 'bg-success' : 'bg-danger' }}">
            {{ $row->is_active ? 'Active' : 'Inactive' }}
        </span>
    </td>

    <td class="text-center">
        @if(!$row->trashed())
            {{-- Edit --}}
            <a href="#" data-id="{{ $row->id }}" class="editIcon me-1">
                <i data-feather="edit" class="icon-14"></i>
            </a>

            {{-- Soft delete --}}
            <a href="#"
               data-id="{{ $row->id }}"
               data-url="{{ route('admin.branches.destroy', $row->id) }}"
               data-method="DELETE"
               class="deleteBranch text-danger">
                <i data-feather="trash-2" class="icon-14"></i>
            </a>
        @else
            {{-- Restore --}}
            <a href="#"
               data-id="{{ $row->id }}"
               data-url="{{ route('admin.branches.restore', $row->id) }}"
               class="restoreBranch text-success me-1">
                <i data-feather="rotate-ccw" class="icon-14"></i>
            </a>

            {{-- Force delete --}}
            <a href="#"
               data-id="{{ $row->id }}"
               data-url="{{ route('admin.branches.forceDelete', $row->id) }}"
               class="forceDeleteBranch text-danger">
                <i data-feather="trash" class="icon-14"></i>
            </a>
        @endif
    </td>
</tr>
@empty
<tr>
    <td colspan="9" class="text-center text-muted">
        No Data Found
    </td>
</tr>
@endforelse

{{ paginationFooter($branches, 9) }}
