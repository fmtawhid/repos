@forelse($histories ?? [] as $key => $row)
    <tr>
        <td class="text-center">{{ $key + 1 + ($histories->currentPage() - 1) * $histories->perPage() }}</td>
        <td>
            <div class="avatar avatar-sm">

                <img class="rounded-circle" src="{{avatarImage($row->customer->avatar)}}" alt="avatar">
            </div>
        </td>
        <td>{{ $row->customer->getFullNameAttribute() }}</td>
        <td>{{ $row->customer->mobile_no }} {{$row->customer->avatar}}</td>
        <td>{{ $row->plan->title }}</td>
        <td>{{ $row->price }}</td>
        <td>{{ dateFormat($row->start_at)  }}</td>
        <td>{{ dateFormat($row->expire_at)  }}</td>
        <td >{{ optional($row->paymentMethod)->gateway }}

            @if ($row->payment_status == 1)
            <span class="badge bg-soft-success rounded-pill text-capitalize">
                {{ getSubscriptionPaymentStatusName($row->payment_status) }}</span>
        @elseif($row->payment_status == 2)
            <span class="badge bg-soft-danger rounded-pill text-capitalize">
                {{ getSubscriptionPaymentStatusName($row->payment_status) }}</span>
        @elseif ($row->payment_status == 3)
            <span class="badge bg-soft-info rounded-pill text-capitalize">
                {{ getSubscriptionPaymentStatusName($row->payment_status) }}</span>
        @elseif($row->payment_status == 4)  
        <span class="badge bg-soft-info rounded-pill text-capitalize">
            {{ getSubscriptionPaymentStatusName($row->payment_status) }}</span>            
        @else
            <span class="badge bg-soft-warning rounded-pill text-capitalize">
                {{ localize('Invalid') }}</span>
        @endif
        </td>
      

        <td class="text-center">
            @if ($row->subscription_status == 1)
                <span class="badge bg-soft-success rounded-pill text-capitalize">
                    {{ getSubscriptionStatusName($row->subscription_status) }}</span>
            @elseif($row->subscription_status == 2)
                <span class="badge bg-soft-danger rounded-pill text-capitalize">
                    {{ getSubscriptionStatusName($row->subscription_status) }}</span>
            @elseif ($row->subscription_status == 3)
                <span class="badge bg-soft-info rounded-pill text-capitalize">
                    {{ getSubscriptionStatusName($row->subscription_status) }}</span>
            @elseif($row->subscription_status == 4)  
            <span class="badge bg-soft-info rounded-pill text-capitalize">
                {{ getSubscriptionStatusName($row->subscription_status) }}</span>
            @elseif($row->subscription_status == 5)  
                <span class="badge bg-soft-info rounded-pill text-capitalize">
                {{ getSubscriptionStatusName($row->subscription_status) }}</span>
            @else
                <span class="badge bg-soft-warning rounded-pill text-capitalize">
                    {{ localize('Invalid') }}</span>
            @endif
        </td>
        <td class="text-center">
           
            <a href="{{route('admin.plan-invoice.download',$row->id)}}" target="_blank">
                <span data-bs-toggle="tooltip" data-bs-placement="top" title="download"><i data-feather="download" class="icon-14"></i></span>
            </a>

            <a href="{{route('admin.plan-histories.show',$row->id)}}" target="_blank">
                <span data-bs-toggle="tooltip" data-bs-placement="top" title="history"><i data-feather="eye" class="icon-14"></i></span>
            </a>
        </td>
    </tr>
@empty
    <x-common.empty-row colspan=11 />
@endforelse

{{ paginationFooter($histories, 11) }}

