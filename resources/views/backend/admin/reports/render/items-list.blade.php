@forelse ($items as $key => $item)
    <tr>
        <td class="text-center">
            {{ $key + 1 + ($items->currentPage() - 1) * $items->perPage() }}
        </td>
        <td> {{ $item->item_name ?? '' }} </td>
        <td> {{ $item->itemCategory->name ?? '' }} </td>
        <td> {{ $item->quantity_sold ?? '' }}</td>
        <td> {{ $item->selling_price ?? '' }}</td>
        <td> {{ $item->total_income ?? '' }}</td>       
    </tr>
@empty
    <x-common.empty-row colspan=9 />
@endforelse

{{ paginationFooter($items, 5) }}