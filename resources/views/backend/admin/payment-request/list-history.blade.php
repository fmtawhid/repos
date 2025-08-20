@forelse($histories ?? [] as $key => $row)
    <tr>
        <td class="text-center">{{ $key + 1 + ($histories->currentPage() - 1) * $histories->perPage() }}</td>
        <td>
            <div class="avatar avatar-sm">

                <img class="rounded-circle" src="{{ avatarImage($row->customer->avatar) }}" alt="avatar">
            </div>
        </td>
        <td>{{ $row->customer->name }}</td>
        <td>{{ $row->customer->mobile_no }} {{ $row->customer->avatar }}</td>
        <td>{{ $row->plan->title }}</td>
        <td>{{ $row->price }}</td>
        <td>{{ dateFormat($row->start_at) }}</td>
        <td>{{ dateFormat($row->expire_at) }}</td>
        <td>{{ optional($row->paymentMethod)->gateway }}
            <span class="badge  rounded-pill text-capitalize {{ getStatusColor($row->payment_status, 'payment') }}">
                {{ getSubscriptionPaymentStatusName($row->payment_status) }}</span>

        </td>
        <td class="text-center">
            <span
                class="badge  rounded-pill text-capitalize  {{ getStatusColor($row->subscription_status, 'subscription') }}">
                {{ getSubscriptionStatusName($row->subscription_status) }}</span>

        </td>
        <td class="text-center">
            <a href="{{ route('admin.plan-histories.show', $row->id) }}" target="_blank">
                <span title="invoice"><i data-feather="eye" class="icon-14"></i></span>
            </a>
            <a href="{{ route('admin.plan-invoice.index', $row->id) }}" target="_blank">
                <span title="invoice"><i data-feather="file-text" class="icon-14"></i></span>
            </a>
        </td>
    </tr>
@empty
    <x-common.empty-row colspan=11 />
@endforelse

{{ paginationFooter($histories, 11) }}
