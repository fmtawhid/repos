
@forelse($menus ?? [] as $key => $row)
    <tr class="{{ $row->trashed() ? 'table-danger' : '' }}">

        {{-- SL --}}
        <td class="text-center">
            {{ $key + 1 + ($menus->currentPage() - 1) * $menus->perPage() }}
        </td>

        {{-- NAME --}}
        <td>{{ $row->name }}</td>

        {{-- BRANCHES --}}
        <td>
            @forelse ($row->branches as $branch)
                <span class="badge bg-{{ ['primary','success','info','warning','danger'][rand(0,4)] }}">
                    {{ $branch->name }}
                </span>
            @empty
                <span class="text-muted">N/A</span>
            @endforelse
        </td>

        {{-- CREATED AT --}}
        <td>{{ manageDateTime($row->created_at,2) }}</td>

        {{-- STATUS --}}
        <td class="text-center">
            @if(!$row->trashed())
                @include("common.active-status-button", [
                    "active" => $row->is_active,
                    "route" => route('admin.menus.statusUpdate', $row->id)
                ])
            @else
                <span class="badge bg-secondary">{{ localize('Deleted') }}</span>
            @endif
        </td>

        {{-- ACTION --}}
        <td class="text-center">

            {{-- ===== ACTIVE MENU ACTIONS ===== --}}
            @if(!$row->trashed())

                {{-- EDIT --}}
                @if(isRouteExists("admin.menus.edit"))
                    <a href="#" data-id="{{ $row->id }}" class="editIcon me-2">
                        <span data-bs-toggle="tooltip" title="{{ localize('Edit') }}">
                            <i data-feather="edit" class="icon-14"></i>
                        </span>
                    </a>
                @endif

                {{-- SOFT DELETE --}}
                @if(isRouteExists("admin.menus.destroy"))
                    <x-delete-btn 
                        route="{{ route('admin.menus.destroy',$row->id) }}" 
                        id="{{ $row->id }}" 
                    />
                @endif

            {{-- ===== DELETED MENU ACTIONS ===== --}}
            @else

                {{-- RESTORE --}}
                @if(isRouteExists("admin.menus.restore"))
                    <form action="{{ route('admin.menus.restore',$row->id) }}" method="POST" class="d-inline me-1">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 text-success" data-bs-toggle="tooltip" title="{{ localize('Restore') }}">
                            <i data-feather="rotate-ccw" class="icon-14"></i>
                        </button>
                    </form>
                @endif

                {{-- FORCE DELETE --}}
                @if(isRouteExists("admin.menus.forceDelete"))
                    <x-delete-btn 
                        route="{{ route('admin.menus.forceDelete',$row->id) }}" 
                        id="{{ $row->id }}" 
                    />
                @endif

            @endif

        </td>
    </tr>
@empty
    <x-common.empty-row colspan="9" />
@endforelse


{{ paginationFooter($menus, 9) }}
