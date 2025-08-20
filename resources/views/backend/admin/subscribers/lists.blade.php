

@forelse($subscribers as $row)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $row->email }}</td>
        <td >{{dateFormat($row->created_at)}}</td>
        <td class="text-center">
            @if(isRouteExists("admin.subscribers.destroy"))
                <a href="#" data-id="{{ $row->id }}"
                               data-href="{{ route('admin.subscribers.destroy', $row->id) }}"
                               data-method="DELETE"
                               class="erase btn-sm p-0 bg-transparent border-0"
                               type="button">
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Delete') }}" class="text-danger ms-1"><i data-feather="trash-2" class="icon-14"></i></span>
                </a>
            @endif
        </td>
    </tr>
@empty
     <x-common.empty-row colspan=4 />
@endforelse
{{ paginationFooter($subscribers, 4) }}
