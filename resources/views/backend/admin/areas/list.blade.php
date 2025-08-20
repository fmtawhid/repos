@forelse($areas ?? [] as $key => $row)
    <tr>
        <td class="text-center">{{ $key + 1 + ($areas->currentPage() - 1) * $areas->perPage() }}</td>

        <td>{{ $row->name }}</td>

        <td>
            @foreach ($row->branches as $branch)
                <span class="badge bg-info">{{ $branch->name }}</span>
            @endforeach
        </td>

        <td>
            <span class="badge bg-soft-success"><b>{{ $row->number_of_tables ?? '-' }}</b></span>
        </td>

        <td class="text-center">
            @include("common.active-status-button",["active" => $row->is_active,"route" => route('admin.areas.statusUpdate', $row->id)])
        </td>

        <td class="text-center">
            @if(isRouteExists("admin.branches.edit"))
                <a href="#" data-id="{{ $row->id }}" class="editIcon">
                    <span data-bs-toggle="tooltip"
                          data-bs-placement="top"
                          title="{{ localize('Edit') }}">
                        <i data-feather="edit" class="icon-14"></i>
                    </span>
                </a>
            @endif

            @if(isRouteExists("admin.areas.destroy"))
                <x-delete-btn
                    route="{{ route('admin.areas.destroy',$row->id) }}"
                    id="{{ $row->id }}"></x-delete-btn>
            @endif
        </td>
    </tr>
@empty
    <x-common.empty-row colspan=9 />
@endforelse

{{ paginationFooter($areas, 9) }}

