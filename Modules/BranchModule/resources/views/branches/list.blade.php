@forelse($branches ?? [] as $key => $row)
    <tr>
        <td class="text-center">{{ $key + 1 + ($branches->currentPage() - 1) * $branches->perPage() }}</td>
        <td>{{ $row->name }}</td>
        <td>{{ $row->address ?? '' }}</td>
        <td>{{ $row->mobile_no ?? '' }}</td>
        <td>{{ $row->email ?? '' }}</td>
        <td>{{ manageDateTime($row->created_at,2)  }}</td>
        <td class="text-center">
            @include("common.active-status-button",["active" => $row->is_active,"route" => route('admin.branches.statusUpdate', $row->id)])
        </td>
        <td class="text-center">

            @if(isRouteExists("admin.branches.edit"))
                <a href="#" data-id={{ $row->id }} class="editIcon">
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Edit') }}"><i data-feather="edit" class="icon-14"></i></span>
                </a>
            @endif

            @if(isRouteExists("admin.branches.destroy"))
                <x-delete-btn route="{{ route('admin.branches.destroy',$row->id) }}"
                              id="{{ $row->id }}"></x-delete-btn>
            @endif
        </td>
    </tr>
@empty
    <x-common.empty-row colspan=9 />
@endforelse

{{ paginationFooter($branches, 9) }}

