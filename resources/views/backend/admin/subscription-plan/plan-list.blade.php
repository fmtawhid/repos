    @forelse ($packages as $package)
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

            $isStarter = $package->package_type == 'starter';
        @endphp
        <div class="col mb-3" id="{{$package->id}}">
            <div class="card h-100 rounded-0 package-card">
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
                                    {{ $price ? formatPrice($price) : localize('Free') }}
                                </div>
                                <del class="fs-4 ms-2 text-muted fw-medium">
                                    {{ $package->discount_status && $package->discount_price ? formatPrice($package->price) : '' }}
                                </del>
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

                @if (isVendorUserGroup())
                    <div class="mt-auto d-flex align-items-center gap-2 px-4">
                        <button
                            type="button"
                            @disabled($isStarter == 1)
                            class="btn btn-block btn-sm w-100 mb-4 {{ $package->is_featured == 1 ? 'btn-primary' : 'btn-outline-primary' }}"
                            data-package-id="{{ $package->id }}"
                            data-price="{{ $package->price }}"
                            data-package-type="{{ $package->package_type }}"
                            data-previous-package-type="{{ $package->package_type }}"
                            data-user-type="{{ auth()->check() ? appStatic()::USER_TYPES[user()->user_type] : 'unauthorized' }}"
                            onclick="handlePackagePayment(this)">
                            {{ user()->subscription_plan_id == $package->id ? localize('Renew Now') : localize('Subscribe Now') }}
                        </button>
                    </div>
                @endif


                @if (isAdmin())
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                @include("common.active-status-button",["active" => $package->is_active,"route" => route('admin.subscription-plans.statusUpdate', $package->id)])

                                <span class="ms-1"><label for="is_active_{{$package->id}}"
                                        class="cursor-pointer">{{ localize('Is Active?') }}</label>  @if ($package->package_type == 'starter')<span data-feather="alert-triangle" class="icon-14 text-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ localize('If active, this will be applied to new user\'s registration.') }}"></span>
                                    @endif</span>
                            </div>

                            <div>
                                @if (isAdmin())
                                    <button class="btn-sm p-1 bg-transparent border-0 edit-package"
                                        data-id="{{ $package->id }}"
                                        id="editPackage_{{ $package->id }}"
                                        data-url="{{ route('admin.subscription-plans.edit', $package->id) }}"
                                        data-update-url="{{ route('admin.subscription-plans.update', $package->id) }}"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"

                                        >
                                        <span data-feather="edit" class="icon-16" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Edit this plan') }}"></span>
                                    </button>
                                @endif

                                @if ($package->package_type != 'starter' && isAdmin())
                                    <a href="#" data-id="{{ $package->id }}"
                                        data-href="{{ route('admin.subscription-plans.destroy', $package->id) }}"
                                        data-method="DELETE" class="erase btn-sm p-1 bg-transparent border-0"
                                        type="button"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        >
                                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Delete this plan') }}" class="text-danger ms-1"><i data-feather="trash-2"
                                                class="icon-16"></i></span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="text-center w-100">
            <x-common.empty-div />
        </div>
    @endforelse


@include("common.modal.package-payment-modal")
