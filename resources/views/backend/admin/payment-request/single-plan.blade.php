@php
if( $package->discount_status && $package->discount_price) {
    $price = $package->discount_price;
}elseif(($package->discount_status && $package->discount_price == 0) ) {
    $price = null;
}elseif(($package->discount_status && $package->discount_price) && $package->price < $package->discount_price) {
    $price = null;
}else{
    $price = $package->price;
}
@endphp
<div class="col mb-3" id="{{$package->id}}">
    <div class="card h-100 rounded-3 package-card">
        <div class="card-body py-5">
            <div class="tt-pricing-plan text-center">
                <div class="tt-plan-name">
                    <h5 class="mb-3 text-uppercase"> {!! html_entity_decode($package->title) !!}</h5>
                </div>
                <div class="tt-price-wrap d-flex justify-content-center @if ($package->is_featured == 1) text-primary @endif">
                    @if ($package->package_type == 'starter')
                        <div class="fs-1 fw-bold lh-1">
                            {{ localize('Free') }}
                        </div>
                        
                    @else
                        <div class="fs-1 fw-bold lh-1">
                            {{ $price ? '$'. $price : localize('Free') }}
                        </div>
                        <del
                            class="fs-4 ms-2 text-muted fw-medium">{{ $package->discount_status && $package->discount_price ? '$' . $package->price : '' }}</del>
                    @endif
                </div>
                <p class="text-muted fs-sm">{!! html_entity_decode($package->description) !!}</p>

            </div>
            @if ($package->is_featured == 1)
                <div class="tt-featured-badge"></div>
            @endif

            <div class="tt-pricing-feature pt-3">
                <ul class="tt-pricing-feature list-unstyled rounded mb-0">
                    
                    <li class="pb-1">
                        <i data-feather="check"
                            class="icon-14 me-2 text-success"></i><strong
                            class="me-1">
                            {{ $package->allow_unlimited_branches == 1 ? localize('Unlimited') : $package->total_branches }}
                        </strong>{{ localize('Branches') }}
                    </li>

                    @if ($package->show_kitchen_panel != 0)
                        <li class="pb-1">
                            <i data-feather="{{ $package->allow_kitchen_panel == 1 ? 'check' : 'x' }}"
                                class="icon-14 me-2 {{ $package->allow_kitchen_panel == 1 ? 'text-success' : 'text-danger' }}"></i>
                                {{ localize('Kitchen Panel') }}
                        </li>
                    @endif 

                    @if ($package->show_reservations != 0)
                        <li class="pb-1">
                            <i data-feather="{{ $package->allow_reservations == 1 ? 'check' : 'x' }}"
                                class="icon-14 me-2 {{ $package->allow_reservations == 1 ? 'text-success' : 'text-danger' }}"></i>
                                {{ localize('Reservations') }}
                        </li>
                    @endif 

                    @if ($package->show_team != 0)
                        <li class="pb-1">
                            <i data-feather="{{ $package->allow_team ? 'check' : 'x' }}"
                                class="icon-14 me-2  {{ $package->allow_team ? 'text-success' : 'text-danger' }}"></i>{{ localize('Team') }}
                        </li>
                    @endif

                    

                    @if ($package->show_support != 0)
                        <li class="pb-1">
                            <i data-feather="{{ $package->allow_support ? 'check' : 'x' }}"
                                class="icon-14 me-2  {{ $package->allow_support ? 'text-success' : 'text-danger' }}"></i>{{ localize('Support Ticket') }}
                        </li>
                    @endif

                    @php
                        $otherFeatures = explode(',', $package->other_features);
                    @endphp

                    @if ($package->other_features)
                        @foreach ($otherFeatures as $feature)
                            <li class="pb-1"><i data-feather="check"
                                    class="icon-14 me-2 text-success"></i>{{ $feature }}
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>

        </div>       
    </div>
</div>