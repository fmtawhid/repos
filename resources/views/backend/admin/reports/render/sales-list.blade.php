@forelse ($salesReports as $key => $row)
    <tr>
        <td class="text-center">
            {{ $key + 1 + ($salesReports->currentPage() - 1) * $salesReports->perPage() }}
        </td>
        <td> {{ date('d M, Y', strtotime($row->date)) }} </td>

        @if(isset($row->product_name))
            <td>{{ $row->invoice_no ?? '' }}</td>
            <td>{{ $row->product_name ?? '' }}</td>
            <td>{{ $row->product_qty ?? 0 }}</td>
            <td>{{ $row->product_sub_total ?? 0 }}</td>
            <td>{{ $row->customer_name ?? '-' }}</td>
            <td>{{ $row->payment_method ?? '-' }}</td>
            <td>{{ $row->discount_value ?? $row->discount ?? $row->discount_value ?? 0 }}</td>
            <td>{{ $row->order_total ?? $row->total_amount ?? 0 }}</td>
            <td>{{ $row->paid_amount ?? $row->total_paid ?? 0 }}</td>
        @else
            <td> {{ $row->total_items ?? $row->total_orders ?? 0 }} </td>
            <td> - </td>
            <td> {{ $row->payment_methods ?? '-' }} </td>
            <td> {{ $row->total_discount ?? 0 }} </td>
            <td> {{ $row->total_amount ?? 0 }} </td>
            <td> {{ $row->total_paid ?? 0 }} </td>
        @endif
    </tr>
@empty
    <x-common.empty-row colspan=11 />
@endforelse

{{ paginationFooter($salesReports, 11) }}