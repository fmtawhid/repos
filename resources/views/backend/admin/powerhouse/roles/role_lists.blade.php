@forelse($roles ?? [] as $key => $row)
<tr @if($row->trashed()) class="table-danger" @endif>
    <td>{{ $loop->iteration }}</td>
    <td>
        <a href="#" class="d-flex align-items-center">
            <h6 class="fs-sm mb-0 ms-2">{{ $row->name }}</h6>
        </a>
    </td>

    <td class="text-center"> 
        @include("common.active-status-button", [
            "active" => $row->is_active,
            "route" => route('admin.roles.statusUpdate', $row->id)
        ])
    </td>

    <td>
        @forelse($row->permissions as $permission)
            <strong class="badge bg-success">{{ $permission->display_title }}</strong>
        @empty
        @endforelse
    </td>

    <td class="text-center">
        @if(!$row->trashed())
            <a href="#"
               data-bs-toggle="offcanvas"
               data-bs-target="#addFormSidebar"
               data-id="{{ $row->id }}"
               class="editIcon">
                <span data-bs-toggle="tooltip" title="{{ localize('Edit') }}">
                    <i data-feather="edit" class="icon-14"></i>
                </span>
            </a>

            <a href="#"
               data-url="{{ route('admin.roles.destroy', $row->id) }}"
               data-method="DELETE"
               data-id="{{ $row->id }}"
               class="deleteRole text-danger ms-1">
                <span data-bs-toggle="tooltip" title="{{ localize('Delete') }}">
                    <i data-feather="trash-2" class="icon-14"></i>
                </span>
            </a>
        @else
            <a href="#"
               data-url="{{ route('admin.roles.restore', $row->id) }}"
               class="restoreRole text-success ms-1">
                <span data-bs-toggle="tooltip" title="{{ localize('Restore') }}">
                    <i data-feather="rotate-ccw" class="icon-14"></i>
                </span>
            </a>
            <a href="#"
               data-url="{{ route('admin.roles.forceDelete', $row->id) }}"
               class="forceDeleteRole text-danger ms-1">
                <span data-bs-toggle="tooltip" title="{{ localize('Delete Permanently') }}">
                    <i data-feather="trash" class="icon-14"></i>
                </span>
            </a>
        @endif
    </td>
</tr>
@empty
    <x-common.empty-row colspan=8 />
@endforelse

{{ paginationFooter($roles, 8) }}
