@forelse($users ?? [] as $key => $row)
    <tr>
        <td class="text-center">{{ $key + 1 + ($users->currentPage() - 1) * $users->perPage() }}</td>
        <td class="">{{ appStatic()::USER_TYPES[$row->user_type] }}</td>
        <td>
            <strong class="badge bg-accent badge-shadow">
                {{ $row->roles[0]->name ?? "N?A"}}
            </strong>
        </td>
        <td>{{ $row->getFullNameAttribute() }}</td>
        <td>{{ $row->email }}</td>
        <td>{{ $row->mobile_no }}</td>
       
        @if (isVendor() || isVendorTeam())
            <td>{{ $row->branch->name ?? "N?A" }}</td>
        @endif

        <td>{{ manageDateTime($row->created_at,2)  }}</td>

        <td class="text-center">
            {{-- @if($row->user_type !== appStatic()::TYPE_ADMIN)
                <a href="#" data-id={{ $row->id }} data-status={{ $row->account_status }} class="changeUserStatus">
                    {!! $row->account_status == 1 ? '<span class="text-success" title="Active"><i data-feather="check-circle" class="icon-14"></i></span>' : '<span class="text-danger" title="disable"><i data-feather="x-circle" class="icon-14"></i></span>' !!}
                </a>
            @endif --}}
            
            @include("common.active-status-button",["active" => $row->account_status,"route" => route('admin.users.statusUpdate', $row->id)])
        </td>
        <td class="text-center">
            @if(user()->user_type == appStatic()::TYPE_ADMIN || userID() === $row->created_by_id)
                <a href="#" data-id={{ $row->id }} class="editIcon">
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Edit') }}"><i data-feather="edit" class="icon-14"></i></span>
                </a>
            @endif
            <a href="#"
                data-id="{{ $row->id }}"
                data-url="{{ route('admin.users.destroy', $row->id) }}"
                data-method="DELETE"
                class="deleteUser text-danger ms-1">
                <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Delete') }}"><i data-feather="trash-2" class="icon-14"></i></span>
            </a>
        </td>
    </tr>
@empty
    <x-common.empty-row colspan=9 />
@endforelse

{{ paginationFooter($users, 9) }}

