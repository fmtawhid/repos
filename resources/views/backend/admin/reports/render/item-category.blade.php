@forelse ($item_categories as $key => $item_category)
    <tr>
        <td class="text-center">
            {{ $key + 1 + ($item_categories->currentPage() - 1) * $item_categories->perPage() }}
        </td>
        <td> {{ $item_category->itemCategory->name ?? '' }} </td>
        <td> {{ $item_category->total_quantity ?? '' }} </td>
        <td> {{ $item_category->total_price ?? '' }} </td>
    </tr>
@empty
    <x-common.empty-row colspan=5 />
@endforelse

{{ paginationFooter($item_categories, 5) }}
