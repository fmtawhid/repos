@forelse($users ?? [] as $key => $row)
<tr @if($row->trashed()) class="table-danger" @endif>
    <td class="text-center">{{ $key + 1 + ($users->currentPage() - 1) * $users->perPage() }}</td>
    <td>{{ appStatic()::USER_TYPES[$row->user_type] }}</td>
    <td>
        <strong class="badge bg-accent badge-shadow">
            {{ $row->roles[0]->name ?? "N/A" }}
        </strong>
    </td>
    <td>{{ $row->getFullNameAttribute() }}</td>
    <td>{{ $row->email }}</td>
    <td>{{ $row->mobile_no }}</td>

    @if(isVendor() || isVendorTeam())
        <td>{{ $row->branch->name ?? "N/A" }}</td>
    @endif

    <td>{{ manageDateTime($row->created_at, 2) }}</td>

    <td class="text-center">
        @if(!$row->trashed())
            @include("common.active-status-button",[
                "active" => $row->account_status,
                "route"  => route('admin.users.statusUpdate', $row->id)
            ])
        @else
            <span class="badge bg-danger">Deleted</span>
        @endif
    </td>

    <td class="text-center">
        @if(!$row->trashed())
            @if(user()->user_type == appStatic()::TYPE_ADMIN || userID() === $row->created_by_id)
                <a href="#" data-id="{{ $row->id }}" class="editIcon">
                    <span data-bs-toggle="tooltip" title="{{ localize('Edit') }}">
                        <i data-feather="edit" class="icon-14"></i>
                    </span>
                </a>
            @endif
            <a href="#"
                data-id="{{ $row->id }}"
                data-url="{{ route('admin.users.destroy', $row->id) }}"
                data-method="DELETE"
                class="deleteUser text-danger ms-1">
                <span data-bs-toggle="tooltip" title="{{ localize('Delete') }}">
                    <i data-feather="trash-2" class="icon-14"></i>
                </span>
            </a>
        @else
            <a href="#"
                data-url="{{ route('admin.users.restore', $row->id) }}"
                class="restoreUser text-success ms-1">
                <span data-bs-toggle="tooltip" title="{{ localize('Restore') }}">
                    <i data-feather="rotate-ccw" class="icon-14"></i>
                </span>
            </a>
            <a href="#"
                data-url="{{ route('admin.users.forceDelete', $row->id) }}"
                class="forceDeleteUser text-danger ms-1">
                <span data-bs-toggle="tooltip" title="{{ localize('Delete Permanently') }}">
                    <i data-feather="trash" class="icon-14"></i>
                </span>
            </a>
        @endif
    </td>
</tr>
@empty
    <x-common.empty-row colspan=10 />
@endforelse

{{ paginationFooter($users, 10) }}
