@forelse($kitchens ?? [] as $key => $row)
    <tr>
        <td class="text-center">{{ $key + 1 + ($kitchens->currentPage() - 1) * $kitchens->perPage() }}</td>
        <td>{{ $row->name }}</td>
        <td>{{ $row->branch?->name ?? '' }}</td>
        <td>{{ manageDateTime($row->created_at,2)  }}</td>
        <td class="text-center">
            @include("common.active-status-button",["active" => $row->is_active,"route" => route('admin.kitchens.statusUpdate', $row->id)])
        </td>
        <td class="text-center">

            @if(isRouteExists("admin.kitchens.edit"))
                <a href="#" data-id={{ $row->id }} class="editIcon">
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Edit') }}"><i data-feather="edit" class="icon-14"></i></span>
                </a>
            @endif

            @if(isRouteExists("admin.kitchens.destroy"))
                <x-delete-btn route="{{ route('admin.kitchens.destroy',$row->id) }}"
                              id="{{ $row->id }}"></x-delete-btn>
            @endif
        </td>
    </tr>
@empty
    <x-common.empty-row colspan=6 />
@endforelse

{{ paginationFooter($kitchens, 9) }}

