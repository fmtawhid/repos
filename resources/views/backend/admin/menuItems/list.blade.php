@forelse($menuItems ?? [] as $key => $row)
    <tr>
        <td class="text-center">{{ $key + 1 + ($menuItems->currentPage() - 1) * $menuItems->perPage() }}</td>
        <td>
            <a href="#" class="d-flex align-items-center">
                <div class="avatar avatar-xl flex-shrink-0">
                    <img class="rounded" src="{{  mediaImage($row->media_manager_id) ?? defaultImage() }}" alt="{{ $row->name ?? '' }} ">
                </div>
                <div class="ms-2">
                    <h6 class="fs-sm mb-0">
                        {{ $row->name ?? '' }}
                    </h6>
                    <span class="text-body-secondary"> {{ $row->description ?? '' }}</span>
                </div>
            </a>
        </td>

        <td>{{ formatPrice($row->lowestVariationPrice()) }}</td>
        <td>{{ $row->category?->name ?? '' }}</td>

        <td>
            @forelse($row->product_addons ?? [] as $productAddon)
                <span class="badge bg-info">
                    {{ $productAddon["title"] }} - {{ formatPrice($productAddon["price"]) }}
                </span>
            @empty
            @endforelse
        </td>

        <td class="text-center">
            @include("common.active-status-button",["active" => $row->is_active,"route" => route('admin.menu-items.statusUpdate', $row->id)])
        </td>
        <td class="text-center">

            @if(isRouteExists("admin.menu-items.edit"))
                <a href="#" data-id={{ $row->id }} class="editIcon">
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Edit') }}"><i data-feather="edit" class="icon-14"></i></span>
                </a>
            @endif

            @if(isRouteExists('admin.menu-items.destroy'))
                <x-delete-btn route="{{ route('admin.menu-items.destroy', $row->id) }}" id="{{ $row->id }}"></x-delete-btn>
            @endif
        </td>
    </tr>
@empty
    <x-common.empty-row colspan=9 />
@endforelse

{{ paginationFooter($menuItems, 9) }}

