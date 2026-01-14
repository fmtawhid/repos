@forelse($areas ?? [] as $key => $row)
<tr class="{{ $row->trashed() ? 'table-danger' : '' }}">
    <td class="text-center">{{ $key + 1 + ($areas->currentPage() - 1) * $areas->perPage() }}</td>
    <td>{{ $row->name }}</td>
    <td>
        @foreach($row->branches as $branch)
            <span class="badge bg-info">{{ $branch->name }}</span>
        @endforeach
    </td>
    <td><span class="badge bg-soft-success"><b>{{ $row->number_of_tables ?? '-' }}</b></span></td>
    <td class="text-center">
        @if(!$row->trashed())
            @include('common.active-status-button', [
                'active' => $row->is_active,
                'route' => route('admin.areas.statusUpdate', $row->id)
            ])
        @else
            <span class="badge bg-secondary">{{ localize('Deleted') }}</span>
        @endif
    </td>
    <td class="text-center">
        @if(!$row->trashed())
            @if(isRouteExists('admin.areas.edit'))
                <a href="#" data-id="{{ $row->id }}" class="editIcon">
                    <i data-feather="edit" class="icon-14"></i>
                </a>
            @endif

            @if(isRouteExists('admin.areas.destroy'))
                <x-delete-btn route="{{ route('admin.areas.destroy', $row->id) }}" id="{{ $row->id }}" />
            @endif
        @else
            {{-- RESTORE --}}
            @if(isRouteExists('admin.areas.restore'))
                <form action="{{ route('admin.areas.restore', $row->id) }}" method="POST" class="d-inline me-1">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 text-success" title="{{ localize('Restore') }}">
                        <i data-feather="rotate-ccw" class="icon-14"></i>
                    </button>
                </form>
            @endif

            {{-- FORCE DELETE --}}
            @if(isRouteExists('admin.areas.forceDelete'))
                <x-delete-btn route="{{ route('admin.areas.forceDelete', $row->id) }}" id="{{ $row->id }}" />
            @endif
        @endif

    </td>
</tr>
@empty
    <x-common.empty-row colspan=9 />
@endforelse

{{ paginationFooter($areas, 9) }}
