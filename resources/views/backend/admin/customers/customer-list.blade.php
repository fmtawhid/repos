@forelse($customers ?? [] as $key => $row)
    <tr>
        <td class="text-center">{{ $key + 1 + ($customers->currentPage() - 1) * $customers->perPage() }}</td>
        <td>
            <a href="" target="_blank">
            <div class="avatar avatar-sm">

                <img class="rounded-circle" src="{{avatarImage($row->avatar)}}" alt="avatar">
            </div>
        </a>
        </td>
        <td>{{ $row->first_name ?? '' }}</td>
        <td>{{ $row->last_name ?? '' }}</td>
        <td>{{ $row->email }}</td>
        <td>{{ $row->mobile_no }}</td>
        <td>{{ dateFormat($row->created_at)  }}</td>        
        <td class="text-center">           
             @include("common.active-status-button",["active" => $row->account_status,"route" => route('admin.users.statusUpdate', $row->id)])
        </td>
        <td class="text-center">
            <a href="#" data-id={{ $row->id }} class="editIcon"  data-update-url="{{ route('admin.customers.update', $row->id) }}"
                data-url="{{ route('admin.customers.edit',$row->id) }}">
                <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Edit') }}"><i data-feather="edit" class="icon-14"></i></span>
            </a>

            <a href="#"
               data-url="{{ route('admin.customers.destroy', $row->id) }}"
               data-method="DELETE"
               data-id="{{ $row->id }}"
               class="deleteCustomer text-danger ms-1">
                <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Delete') }}"><i data-feather="trash-2" class="icon-14"></i></span>
            </a>
        </td>
    </tr>
@empty
    <x-common.empty-row colspan=9 />
@endforelse

{{ paginationFooter($customers, 9) }}

