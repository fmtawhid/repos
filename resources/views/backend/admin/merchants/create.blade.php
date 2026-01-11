
<form action="{{ route('admin.merchants.store') }}" method="POST" id="addMerchantFrm">
    <div class="offcanvas offcanvas-end" id="addMerchantSideBar" tabindex="-1">
        @csrf
        @method("POST")
        <x-form.input name="id" id="id" type="hidden" value="" showDiv=0 />
        <div class="offcanvas-header border-bottom py-3">
            <h5 class="offcanvas-title">{{ localize('Add New Vendor') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <x-common.splitter />
        <div class="offcanvas-body">
            <x-common.message class="mb-3" />

            <div class="row">
                <div class="col mb-3">
                    <x-form.label for="first_name" label="{{ localize('First Name') }}" isRequired=true />
                    <x-form.input name="first_name" id="first_name" type="text" placeholder="{{ localize('First Name') }}" value="" showDiv=false />
                </div>

                <div class="col mb-3">
                    <x-form.label for="last_name" label="{{ localize('Last Name') }}" isRequired=true />
                    <x-form.input name="last_name" id="last_name" type="text" placeholder="{{ localize('Last Name') }}" value="" showDiv=false />
                </div>
            </div>
            
            <div class="row">
                <div class="col mb-3">
                    <x-form.label for="email" label="{{ localize('Email') }}" isRequired=true />
                    <x-form.input name="email" type="email" id="email"
                                placeholder="{{ localize('Email') }}" value="" showDiv=false />
                </div>
                
                <div class="col mb-3">
                    <x-form.label for="mobile_no" label="{{ localize('Mobile Number') }}" />
                    <x-form.input name="mobile_no" id="mobile_no" type="text" placeholder="{{ localize('Mobile Number') }}" value="" showDiv=false />
                </div>
            </div>

            <div class="mb-3">
                <div class="mb-4">
                    <x-form.label for="avatar" label="{{ localize('Avatar') }}"  />
                    <div class="tt-image-drop rounded">
                        <span class="fw-semibold">{{ localize('Choose Avatar') }}</span>
                        <!-- choose media -->
                        <div class="tt-product-thumb show-selected-files mt-3">
                            <div class="avatar avatar-xl cursor-pointer choose-media"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                onclick="showMediaManager(this)" data-selection="single">
                                <input type="hidden" name="avatar" id="avatar">
                                <div class="no-avatar rounded-circle">
                                    <span><i data-feather="plus"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- choose media -->
                    </div>

                </div>
            </div>
            <div class="mb-3 password_wrapper">
                <x-form.label for="password" label="{{ localize('Password') }}" isRequired=true />
                <x-form.input name="password" id="password" type="password" placeholder="{{ localize('Password') }}" value="" showDiv=false />
            </div>
            <div class="mb-3 password_wrapper">
                <div class="form-check form-switch">
                    <label for="assign_plan" class="me-2">{{localize('Do you want assign plan ?')}}</label>
                    <input type="checkbox"
                           name="assign_plan"
                           id="assign_plan"
                           class="form-check-input me-2 subscription-plan-status"
                    />
                </div>
            </div>
            <div class="subscription-plan-div d-none" id="subscription-plan-div">
                <div class="mb-3">
                    <x-form.label for="subscription_plan_id" label="{{ localize('Subscription Plan') }}" isRequired=true />
                    <x-form.select name="subscription_plan_id" class="subscriptionPlanOption" id="subscription_plan_id">
                        <option value="">{{localize('Select Subscription Plan')}}</option>
                        @foreach ($plans as $id => $title)
                            <option value="{{ $id }}">{{ $id }} | {{ $title }}</option>
                        @endforeach
                    </x-form.select>
                </div>
                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input is_paid" name="is_paid" type="radio" value="paid" id="paid">
                        <label class="form-check-label" for="paid">{{localize('Paid')}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input is_paid" name="is_paid" type="radio" value="free" id="free">
                        <label class="form-check-label" for="free">{{localize('Free')}}</label>
                    </div>
                </div>
                <div class="payment-option" id="payment-option">
                    <div class="mb-3">
                        <x-form.label for="payment_amount" label="{{ localize('Payment Amount') }}" isRequired=true />
                        <x-form.input name="payment_amount" id="payment_amount" type="text" placeholder="{{ localize('Payment Amount') }}" value="" showDiv=false />
                    </div>
                    <div class="mb-3">
                        <x-form.label for="payment_method" label="{{ localize('Payment Method') }}" isRequired=true />
                        <x-form.select name="payment_method" id="payment_method">
                            <option value="">{{localize('Select Payment Method')}}</option>
                            @foreach ($payment_gateways as  $gateway)
                                <option value="{{ $gateway->id }}">{{ $gateway->gateway }}</option>
                            @endforeach
                        </x-form.select>
                    </div>               
                    <div class="mb-3">
                        <x-form.label for="payment_detail" label="{{ localize('Payment Detail') }}" isRequired=true />
                        <x-form.textarea name="payment_detail" id="payment_detail" type="text" placeholder="{{ localize('Payment Detail') }}" value="" showDiv=false />
                    </div>
                </div>
            </div>
           
            <div class="mb-3">
                <x-form.label for="account_status" label="{{ localize('Account Status') }}" />
                <x-form.select name="account_status" id="account_status">
                    @foreach (appStatic()::ACCOUNT_STATUS_LIST as $userStatusId => $userStatus)
                        <option value="{{ $userStatusId }}" {{ $userStatusId == appStatic()::ACCOUNT_STATUS_ACTIVE ? 'selected' : '' }}>{{ $userStatus }}</option>
                    @endforeach
                </x-form.select>
            </div>

        </div>
        <div class="offcanvas-footer border-top">
            <div class="d-flex gap-3">
                <x-form.button id="addUserBtn">{{ localize('Save') }}</x-form.button>
                <x-form.button color="secondary" type="reset">{{ localize('Reset') }}</x-form.button>
            </div>
        </div>
    </div>
</form>
