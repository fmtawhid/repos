@forelse ($histories as $key => $history)
<tr>
    <td class="text-center fs-sm">
        {{ $key + 1 + ($histories->currentPage() - 1) * $histories->perPage() }}
    </td>

    @if (auth()->user()->user_type != 'customer')
        <td>
            <a href="javascript:void(0);" class="d-flex align-items-center">
                <div class="avatar avatar-sm">
                    <img class="rounded-circle"
                        src="{{ urlVersion($history->user->avatar) }}"
                        alt=""
                        onerror="this.onerror=null;this.src='{{ avatarImage($history->user->avatar) }}';" />
                </div>
              
                <h6 class="fs-sm mb-0 ms-2">{{ $history->createdBy->name }}
                </h6>
            </a>
        </td>
    @endif


    <td class="text-capitalize fw-sm">
        {{ $history->plan->title }}/{{ $history->plan->package_type == 'starter' ? localize('Monthly') : $history->plan->package_type }}
    </td>

    <td class="text-capitalize fw-sm">
        {{ $history->plan->price > 0 ? formatPrice($history->plan->price) : localize('Free') }}
    </td>

    <td>
        <span
            class="fs-sm">{{ date('d M, Y', strtotime($history->created_at)) }}</span>
    </td>


    <td class="text-end">

        <span class="badge bg-soft-primary rounded-pill text-capitalize">
            {{ $history->payment_method == 0 ? localize('N\F') :$history->payment_method }}
        </span>
    </td>


</tr>
@empty
<x-common.empty-row colspan=5 />
@endforelse
{{ paginationFooter($histories, 5) }}
