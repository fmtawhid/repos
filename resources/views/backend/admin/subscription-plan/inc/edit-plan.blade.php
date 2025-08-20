
<div class="col-12 col-lg-12">
    <input type="hidden" value="{{ $subscriptionPlan->id }}" class="package_id">
    <input type="hidden" value="{{ route('admin.subscription-plans.update',$subscriptionPlan->id) }}" class="update-url">

    <div class="card h-100 package-card">
        <div class="card-body">
            <div class="tt-pricing-plan bg-info-subtle p-3 mb-3">

                <div class="tt-plan-name">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 tt_update_text" data-name="package-title">
                            {!! html_entity_decode($subscriptionPlan->title) !!}
                        </h5>
                        <span class="tt-edit-icon ms-2 text-muted"><i class="tt_editable cursor-pointer icon-14"
                                data-name="package-title" data-feather="edit"></i></span>
                    </div>                    
                </div>

                <div class="tt-price-wrap d-flex align-items-center justify-content-between mt-4">
                    @if ($subscriptionPlan->package_type == 'starter')
                        <div class="monthly-price fs-1 fw-bold">
                            {{ localize('Free') }}
                        </div>
                    @else
                        <div class="monthly-price fs-1 fw-bold">

                            <input type="hidden" name="package-price" class="package-main-price" id="package-main-price"
                                class="package-price" value="{{ $subscriptionPlan->price }}">

                            $<span class="tt_update_text package-price"
                                onkeypress="nonNumericFilter()"
                                data-name="package-price">{{ $subscriptionPlan->discount_status && $subscriptionPlan->discount_price ? $subscriptionPlan->discount_price : $subscriptionPlan->price }}</span>

                            <span class="tt_update_text ">
                                <del
                                    class="package-discount-price">{{ $subscriptionPlan->discount_status && $subscriptionPlan->discount_price ? '$' . $subscriptionPlan->price : '' }}</del></span>
                            
                            <span class="tt-edit-icon me-4 text-muted package-price-edit {{ $subscriptionPlan->discount_status && $subscriptionPlan->discount_price ? 'd-none' : '' }}">
                                <i class="tt_editable cursor-pointer icon-14" data-name="package-price" data-feather="edit"></i>
                                <sup><span class="cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="{{ localize('Set $0 to make it free') }}"><i
                                        data-feather="help-circle" class="icon-14"></i></span></sup>
                            </span>
                        </div>
                        <ul class="tt-pricing-feature list-unstyled rounded mb-0">
                            <li>
                                <div class="d-flex align-items-center justify-content-between">
                                    @if ($subscriptionPlan->package_type != 'starter')
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="discount_option {{ $subscriptionPlan->discount_status != 1 ? 'd-none' : '' }} d-flex align-items-right gap-1" id="discount_option">
                                                <select class="form-select py-1 cursor-pointer discount_type" name="discount_type" onchange="handleDiscountTypeChange(this)">
                                                    <option value="1"
                                                        {{ $subscriptionPlan->discount_type == 1 ? 'selected' : '' }}>
                                                        {{ localize('Fixed') }}</option>
                                                    <option value="2"
                                                        {{ $subscriptionPlan->discount_type == 2 ? 'selected' : '' }}>
                                                        {{ localize('Percentage') }}</option>
                                                </select>
                                                <input class="form-control py-1 px-1 discount_amount package-discount" style="width: 80px;" type="text" onkeypress="nonNumericFilter()" name="discount" placeholder="{{ localize('discount') }}" value="{{ $subscriptionPlan->discount }}" />
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox"
                                                        class="form-check-input cursor-pointer allow_discount tt_editable"
                                                        data-id="{{ $subscriptionPlan->id }}"
                                                        id="allow_discount"
                                                        data-name="discount_status"
                                                        @if ($subscriptionPlan->discount_status == 1) checked @endif>
                                                </div>
                                                <div class="d-flex align-items-center ms-1">
                                                    <label data-name="package-words" for="allow_discount">{{ localize('discount?') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    @endif
                </div>

                
                <div class="d-flex align-items-center justify-content-between">
                    <span class="text-muted tt_update_text"
                        data-name="package-description">{!! html_entity_decode($subscriptionPlan->description) !!}</span>
                    <span class="tt-edit-icon ms-2 text-muted"><i class="tt_editable cursor-pointer icon-14"
                            data-name="package-description" data-feather="edit"></i></span>
                </div>

            </div>


            <div class="tt-pricing-feature">
                <ul class="tt-pricing-feature list-unstyled rounded mb-0">

                    <!-- show hide info icon start -->
                    @include("backend.admin.subscription-plan.inc.li.li-head")
                    <!-- show hide info icon end -->
                    
                    <li>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <span>
                                    <i data-feather="check-circle"
                                        class="icon-14 me-2 text-success"></i>
                                        <strong class="tt_update_text" id="allow_branch_text"
                                                data-name="package-total_branches"
                                                onkeypress="nonNumericFilter()">{{ $subscriptionPlan->allow_unlimited_branches == 1 ? localize('Unlimited') : $subscriptionPlan->total_branches }}</strong>
                                        {{ localize('Branches') }}
                                </span>

                                <span class="tt-edit-icon ms-2 text-muted {{$subscriptionPlan->allow_unlimited_branches == 1 ? 'd-none' : ''}}" id="allow_branch_edit">
                                    <i  class="tt_editable cursor-pointer icon-14"
                                        data-name="package-total_branches"
                                        data-feather="edit"></i>
                                </span>
                            </div>

                            <div class="d-flex align-items-center gap-4">
                                <div class="form-check tt-checkbox">
                                    <input type="checkbox" class="form-check-input cursor-pointer unlimited_balance"
                                        data-name="allow_unlimited_branches"
                                        id="allow_unlimited_branches"
                                        @if ($subscriptionPlan->allow_unlimited_branches == 1) checked @endif>
                                </div>

                                <div class="form-check tt-checkbox">
                                    <input class="form-check-input cursor-pointer" type="checkbox"
                                        @checked(true)
                                        @disabled(true)
                                    />
                                </div>

                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input cursor-pointer"
                                        @checked(true)
                                        @disabled(true)
                                    />
                                </div>
                            </div>
                        </div> 
                    </li>
 

                    <li class="d-flex justify-content-between align-items-center my-2">
                        <div class="d-flex align-items-center">
                            <span><i data-feather="check-circle" class="icon-14 me-2 text-success"></i>
                                <label
                                    for="allow_kitchen_panel"
                                    class="cursor-pointer">{{ localize('Kitchen panel') }}</label>
                            </span>
                        </div>

                        <div class="d-flex align-items-center gap-4"> 
                            <div class="form-check tt-checkbox">
                                <input class="form-check-input cursor-pointer tt_editable" type="checkbox"
                                    id="show_kitchen_panel"
                                    data-name="show_kitchen_panel"
                                    @if ($subscriptionPlan->show_kitchen_panel == 1) checked @endif>
                            </div>

                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input cursor-pointer tt_editable"
                                    data-name="allow_kitchen_panel"
                                    id="allow_kitchen_panel"
                                    @if ($subscriptionPlan->allow_kitchen_panel == 1) checked @endif data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="{{ localize('If this is enabled, vendors can use kitchen panel.') }}">
                            </div>
                        </div>
                    </li>

                    <li class="d-flex justify-content-between align-items-center my-2">
                        <div class="d-flex align-items-center">
                            <span><i data-feather="check-circle" class="icon-14 me-2 text-success"></i>
                                <label
                                    for="allow_reservations"
                                    class="cursor-pointer">{{ localize('Reservations') }}</label>
                            </span>
                        </div>

                        <div class="d-flex align-items-center gap-4"> 
                            <div class="form-check tt-checkbox">
                                <input class="form-check-input cursor-pointer tt_editable" type="checkbox"
                                    id="show_reservations"
                                    data-name="show_reservations"
                                    @if ($subscriptionPlan->show_reservations == 1) checked @endif>
                            </div>

                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input cursor-pointer tt_editable"
                                    data-name="allow_reservations"
                                    id="allow_reservations"
                                    @if ($subscriptionPlan->allow_reservations == 1) checked @endif data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="{{ localize('If this is enabled, vendors can use reservations.') }}">
                            </div>
                        </div>
                    </li>

                    <li class="d-flex justify-content-between align-items-center my-2">
                        <div class="d-flex align-items-center">
                            <span><i data-feather="check-circle" class="icon-14 me-2 text-success"></i>
                                <label
                                    for="allow_support"
                                    class="cursor-pointer">{{ localize('Free Support') }}</label>
                            </span>
                        </div>

                        <div class="d-flex align-items-center gap-4"> 
                            <div class="form-check tt-checkbox">
                                <input class="form-check-input cursor-pointer tt_editable" type="checkbox"
                                    id="show_support"
                                    data-name="show_support"
                                    @if ($subscriptionPlan->show_support == 1) checked @endif>
                            </div>

                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input cursor-pointer tt_editable"
                                    data-name="allow_support"
                                    id="allow_support"
                                    @if ($subscriptionPlan->allow_support == 1) checked @endif data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="{{ localize('If this is enabled, you have to provide free support to the users.') }}">
                            </div>
                        </div>
                    </li>

                    <li class="d-flex justify-content-between align-items-center my-2">
                        <div class="d-flex align-items-center">
                            <span><i data-feather="check-circle" class="icon-14 me-2 text-success"></i><label
                                    for="team"
                                    class="cursor-pointer">{{ localize('Team') }}</label></span>
                        </div>

                        <div class="d-flex align-items-center gap-4">
                            <div class="form-check tt-checkbox">
                                <input class="form-check-input cursor-pointer tt_editable" type="checkbox"
                                    id="show_team"
                                    data-name="show_team"
                                    @if ($subscriptionPlan->show_team == 1) checked @endif>
                            </div>

                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input cursor-pointer tt_editable"
                                    data-name="allow_team"
                                    id="allow_team"
                                    @if ($subscriptionPlan->allow_team == 1) checked @endif data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="{{ localize('If this is enabled, vendors can create teams.') }}">
                            </div>
                        </div>
                    </li> 
                  
                    <li class="d-flex flex-column align-items-start my-2">
                        <div class="w-100 d-flex align-items-center">
                            <i data-feather="check-circle" class="icon-14 me-2 text-success"></i>
                            <x-form.input name="other_features" data-name="other_features" data-type="input" id="other_features" class="other_features tt_update_text"
                                type="text"
                                placeholder="{{ localize('Type additional features') }}"
                                value="{{ $subscriptionPlan->other_features }}"
                                showDiv=false  />
                        </div>
                        <small class="text-muted ps-4">*
                            {{ localize('Comma separated: Feature A,Feature B') }}</small>
                    </li>


                    {{-- duration add for starter pacakge --}}
                    @if ($subscriptionPlan->package_type == 'starter')
                        <li class="d-flex flex-column align-items-start">
                            <div class="w-100 d-flex align-items-center">
                                <i data-feather="check-circle" class="icon-14 me-2 text-success"></i>
                                <x-form.input name="duration" data-name="duration" data-type="input" id="duration" class="duration tt_update_text"
                                    type="number"
                                    placeholder="{{ localize('Expiration duration') }}"
                                    value="{{ $subscriptionPlan->duration }}"
                                    showDiv=false  />

                            </div>
                            <small class="text-muted ps-4">*
                                {{ localize('Expire in number in days for Starter Package') }}</small>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="card-footer">
            <div>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <span><label
                            for="is_featured"
                            class="cursor-pointer">{{ localize('Is featured plan?') }}</label></span>
                    <div class="form-check form-switch ms-2">
                        <input type="checkbox" class="form-check-input cursor-pointer tt_editable"
                            id="is_featured"
                            data-name="is_featured"
                            @if ($subscriptionPlan->is_featured == 1) checked @endif data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            data-bs-title="{{ localize('If this is enabled, a recommend badge will be shown in the subscription plan.') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
