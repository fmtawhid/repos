@forelse($roles ?? [] as $key => $row)
    <tr>
        <td >{{ $loop->iteration }}</td>
        <td>
            <a href="#" class="d-flex align-items-center">
                <h6 class="fs-sm mb-0 ms-2">{{ $row->name }}</h6>
            </a>
        </td>

        <td class="text-center"> 
             @include("common.active-status-button",["active" => $row->is_active,"route" => route('admin.roles.statusUpdate', $row->id)])
        </td>
        <td>
            @forelse($row->permissions as $key=>$permission)
                <strong class="badge bg-success"> {{ $permission->display_title }} </strong>
            @empty
            @endforelse
        </td>

        <td class="text-center">
            <a href="#"
               data-bs-toggle="offcanvas"
               data-bs-target="#addFormSidebar"
               data-id="{{ $row->id }}"
               class="editIcon">
                <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Edit') }}"><i data-feather="edit" class="icon-14"></i></span>
            </a>

            <a href="#"
               data-url="{{ route('admin.roles.destroy', $row->id) }}"
               data-method="DELETE"
               data-id="{{ $row->id }}"
               class="deleteRole text-danger ms-1">
                <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Delete') }}"><i data-feather="trash-2" class="icon-14"></i></span>
            </a>
        </td>
    </tr>
@empty
    <x-common.empty-row colspan=8 />
@endforelse

{{ paginationFooter($roles, 8) }}

