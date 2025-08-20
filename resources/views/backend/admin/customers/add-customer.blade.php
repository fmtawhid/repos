
<form action="{{ route('admin.customers.store') }}" method="POST" id="addCustomerFrm">
<div class="offcanvas offcanvas-end" id="addCustomerSideBar" tabindex="-1">
        @csrf
        @method("POST")
        <x-form.input name="id" id="id" type="hidden" value="" showDiv=0 />
        <div class="offcanvas-header border-bottom py-3">
            <h5 class="offcanvas-title">{{ localize('Add New Customer') }}</h5>
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
            <div class="mb-3">
                <x-form.label for="email" label="{{ localize('Email') }}" isRequired=true />
                <x-form.input name="email"
                              type="email"
                              id="email"
                              placeholder="{{ localize('Email') }}"
                              value=""
                              showDiv=false />
            </div>
            <div class="mb-3">
                <x-form.label for="mobile_no" label="{{ localize('Mobile Number') }}" />
                <x-form.input name="mobile_no" id="mobile_no" type="text" placeholder="{{ localize('Mobile Number') }}" value="" showDiv=false />
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
           
            <div class="mb-3">
                <x-form.label for="is_active" label="{{ localize('Status') }}" />
                <x-form.select name="is_active" id="is_active">
                    @foreach (appStatic()::STATUS_ARR as $userStatusId => $userStatus)
                        <option value="{{ $userStatusId }}">{{ $userStatus }}</option>
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
