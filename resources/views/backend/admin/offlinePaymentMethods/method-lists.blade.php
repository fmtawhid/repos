

@forelse($offline_payment_methods as $row)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $row->name }}</td>
        <td>{{ $row->description }}</td>
        <td class="d-flex justify-content-center"> 
             @include("common.active-status-button",["active" => $row->is_active,"route" => route('admin.menus.statusUpdate', $row->id)])
        </td>
        <td class="text-center">
            @if(isRouteExists("admin.offline-payment-methods.edit"))
                <a href="#"
                   data-update-url="{{ route('admin.offline-payment-methods.update', $row->id) }}"
                   data-url="{{ route('admin.offline-payment-methods.edit',$row->id) }}"
                   data-id="{{ $row->id }}"
                   class="editIcon">
                    <span title="Edit"><i data-feather="edit" class="icon-14"></i></span>
                </a>
            @endif

            @if(isRouteExists("admin.offline-payment-methods.destroy"))
                <a href="#" data-id="{{ $row->id }}"
                               data-href="{{ route('admin.offline-payment-methods.destroy', $row->id) }}"
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
{{ paginationFooter($offline_payment_methods, 5) }}
