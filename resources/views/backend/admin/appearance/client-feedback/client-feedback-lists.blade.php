

@forelse($client_feedbacks as $row)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>
            <div class="avatar avatar-sm">
                <img class="rounded-circle" src="{{avatarImage($row->avatar)}}" alt="avatar">
            </div>
        </td>
        <td>{{ $row->name }}</td>
        <td>{{ $row->designation }}</td>
        <td>{{ renderStarRating($row->rating) }}</td>
        <td>{{ $row->review }}</td>  
        <td class="text-center">
            @if(isRouteExists("admin.client-feedbacks.edit"))
                <a href="#"
                   data-update-url="{{ route('admin.client-feedbacks.update', $row->id) }}"
                   data-url="{{ route('admin.client-feedbacks.edit',$row->id) }}"
                   data-id="{{ $row->id }}"
                   class="editIcon">
                    <span title="Edit"><i data-feather="edit" class="icon-14"></i></span>
                </a>
            @endif

            @if(isRouteExists("admin.client-feedbacks.destroy"))
                <a href="#" data-id="{{ $row->id }}"
                               data-href="{{ route('admin.client-feedbacks.destroy', $row->id) }}"
                               data-method="DELETE"
                               class="erase btn-sm p-0 bg-transparent border-0"
                               type="button">
                    <span title="Delete User" class="text-danger ms-1"><i data-feather="trash-2" class="icon-14"></i></span>
                </a>
            @endif
        </td>
    </tr>
@empty
     <x-common.empty-row colspan=8 />
@endforelse
{{ paginationFooter($client_feedbacks, 8) }}
