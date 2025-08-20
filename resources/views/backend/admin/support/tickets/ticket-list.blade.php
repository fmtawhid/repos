

@forelse($tickets as $row)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $row->name }}</td>
        <td class="text-center">
            @include("common.active-status-button",[
               'active' => $row->is_active,
               'id'     => encrypt($row->id),
               'model'  => 'ticket',
               'name'   => 'is_active',
           ])
        </td>
        <td class="text-center">
            @if(isRouteExists("admin.support-tickets.edit"))
                <a href="#"
                   data-update-url="{{ route('admin.support-tickets.update', $row->id) }}"
                   data-url="{{ route('admin.support-tickets.edit',$row->id) }}"
                   data-id="{{ $row->id }}"
                   class="editIcon">
                    <span title="Edit"><i data-feather="edit" class="icon-14"></i></span>
                </a>
            @endif

            @if(isRouteExists("admin.support-tickets.destroy"))
                <a href="#" data-id="{{ $row->id }}"
                               data-href="{{ route('admin.support-tickets.destroy', $row->id) }}"
                               data-method="DELETE"
                               class="erase btn-sm p-0 bg-transparent border-0"
                               type="button">
                    <span title="Delete User" class="text-danger ms-1"><i data-feather="trash-2" class="icon-14"></i></span>
                </a>
            @endif
        </td>
    </tr>
@empty
     <x-common.empty-row colspan=5 />
@endforelse
{{ paginationFooter($tickets, 5) }}
