

@forelse($priorities as $row)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $row->name }}</td>
        <td class="text-center">
             @include("common.active-status-button",["active" => $row->is_active,"route" => route('admin.support-priorities.statusUpdate', $row->id)])
        </td>
        <td class="text-center">
            @if(isRouteExists("admin.support-priorities.edit"))
                <a href="#"
                   data-update-url="{{ route('admin.support-priorities.update', $row->id) }}"
                   data-url="{{ route('admin.support-priorities.edit',$row->id) }}"
                   data-id="{{ $row->id }}"
                   class="editIcon">
                   <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Edit Priority') }}"><i data-feather="edit" class="icon-14"></i></span>
                </a>
            @endif

            @if(isRouteExists("admin.support-priorities.destroy"))
                <a href="#" data-id="{{ $row->id }}"
                               data-href="{{ route('admin.support-priorities.destroy', $row->id) }}"
                               data-method="DELETE"
                               class="erase btn-sm p-0 bg-transparent border-0"
                               type="button">
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Delete Priority') }}" class="text-danger ms-1"><i data-feather="trash-2" class="icon-14"></i></span>
                </a>
            @endif
        </td>
    </tr>
@empty
     <x-common.empty-row colspan=4 />
@endforelse
{{ paginationFooter($priorities, 4) }}
