

@forelse($queries as $row)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $row->name }}</td>
        <td >{{ $row->email }} </td>
        <td >{{ $row->phone }} </td>
        <td >{{ $row->message }} </td>
        <td class="text-center">
            @if(isRouteExists("admin.queries.markRead"))
                <a href="#"
                   data-update-url="{{ route('admin.queries.markRead', ['id' => $row->id, 'lang_key' => env('DEFAULT_LANGUAGE')]) }}&localize"
                   data-url="{{ route('admin.queries.markRead', ['id' => $row->id, 'lang_key' => env('DEFAULT_LANGUAGE')]) }}&localize"
                   data-id="{{ $row->id }}"
                   class="markRead">
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $row->is_seen == 0 ? localize('Mark As Read') : localize('Mark As Unread') }}">  <i data-feather="check" class="me-2" class="icon-14"></i></span>
                </a>
            @endif
            <a class="" href="mailto:{{ $row->email }}">
                <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Reply in Email') }}">
                <i data-feather="message-circle" class="icon-14" class="me-2"></i></span>
            </a>
            @if(isRouteExists("admin.queries.delete"))
                <a href="#" data-id="{{ $row->id }}"
                               data-href="{{ route('admin.queries.delete', [$row->id, 'clear']) }}"
                               data-method="DELETE"
                               class="erase btn-sm p-0 bg-transparent border-0"
                               type="button">
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Delete') }}" class="text-danger ms-1"><i data-feather="trash-2" class="icon-14"></i></span>
                </a>
            @endif
        </td>
    </tr>
@empty
     <x-common.empty-row colspan=6 />
@endforelse
{{ paginationFooter($queries, 6) }}
