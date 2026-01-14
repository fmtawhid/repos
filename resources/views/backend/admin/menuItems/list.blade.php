@forelse($menuItems ?? [] as $key => $row)
<tr class="{{ $row->trashed() ? 'table-danger' : '' }}">
    {{-- SL --}}
    <td class="text-center">{{ $key + 1 + ($menuItems->currentPage() - 1) * $menuItems->perPage() }}</td>

    {{-- ITEM NAME & IMAGE --}}
    <td>
        <a href="#" class="d-flex align-items-center">
            <div class="avatar avatar-xl flex-shrink-0">
                <img class="rounded" src="{{ mediaImage($row->media_manager_id) ?? defaultImage() }}" alt="{{ $row->name ?? '' }}">
            </div>
            <div class="ms-2">
                <h6 class="fs-sm mb-0">{{ $row->name ?? '' }}</h6>
                <span class="text-body-secondary">{{ $row->description ?? '' }}</span>
            </div>
        </a>
    </td>

    {{-- PRICE --}}
    <td>{{ formatPrice($row->lowestVariationPrice()) }}</td>

    {{-- CATEGORY --}}
    <td>{{ $row->category?->name ?? '' }}</td>

    {{-- ADDONS --}}
    <td>
        @forelse($row->product_addons ?? [] as $productAddon)
            <span class="badge bg-info">
                {{ $productAddon["title"] }} - {{ formatPrice($productAddon["price"]) }}
            </span>
        @empty
            <span class="text-muted">N/A</span>
        @endforelse
    </td>

    {{-- STATUS --}}
    <td class="text-center">
        @if(!$row->trashed())
            @include("common.active-status-button", ["active" => $row->is_active, "route" => route('admin.menu-items.statusUpdate', $row->id)])
        @else
            <span class="badge bg-secondary">{{ localize('Deleted') }}</span>
        @endif
    </td>

    {{-- ACTIONS --}}
    <td class="text-center">
        @if(!$row->trashed())
            {{-- EDIT --}}
            @if(isRouteExists("admin.menu-items.edit"))
                <a href="#" data-id="{{ $row->id }}" class="editIcon me-2">
                    <span data-bs-toggle="tooltip" title="{{ localize('Edit') }}">
                        <i data-feather="edit" class="icon-14"></i>
                    </span>
                </a>
            @endif

            {{-- SOFT DELETE --}}
            @if(isRouteExists('admin.menu-items.destroy'))
                <x-delete-btn route="{{ route('admin.menu-items.destroy', $row->id) }}" id="{{ $row->id }}"></x-delete-btn>
            @endif
        @else
            {{-- RESTORE --}}
            @if(isRouteExists('admin.menu-items.restore'))
                <form action="{{ route('admin.menu-items.restore', $row->id) }}" method="POST" class="d-inline me-1">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 text-success" data-bs-toggle="tooltip" title="{{ localize('Restore') }}">
                        <i data-feather="rotate-ccw" class="icon-14"></i>
                    </button>
                </form>
            @endif

            {{-- FORCE DELETE --}}
            @if(isRouteExists('admin.menu-items.forceDelete'))
                <x-delete-btn route="{{ route('admin.menu-items.forceDelete', $row->id) }}" id="{{ $row->id }}"></x-delete-btn>
            @endif
        @endif
    </td>
</tr>
@empty
    <x-common.empty-row colspan="9" />
@endforelse

{{ paginationFooter($menuItems, 9) }}
