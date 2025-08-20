
<form action="{{ route('admin.branches.store') }}" method="POST" id="addBranchFrm">
    <div class="offcanvas offcanvas-end" id="addBranchSideBar" tabindex="-1">
        @csrf
        @method("POST")
        <x-form.input name="id" id="id" type="hidden" value="" showDiv=0 />
        <div class="offcanvas-header border-bottom py-3">
            <h5 class="offcanvas-title">{{ localize('Add New Branch') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <x-common.splitter />
        <div class="offcanvas-body">
            <x-common.message class="mb-3" />

            <div class="mb-3">
                <x-form.label for="name" label="{{ localize('Branch Name') }}" isRequired=true />
                <x-form.input name="name" id="name" type="text" placeholder="{{ localize('Name') }}" value="" showDiv=false />
            </div>

            <div class="mb-3">
                <x-form.label for="name" label="{{ localize('Branch Code') }}" isRequired=true />
                <x-form.input
                    name="branch_code"
                    id="branch_code"
                    type="text"
                    placeholder="{{ localize('Branch Code') }}"
                    value=""
                    showDiv=false
                />
            </div>

            <div class="mb-3">
                <x-form.label for="address" label="{{ localize('Address') }}" />
                <x-form.textarea name="address" id="address" placeholder="{{ localize('Address') }}" value="" showDiv=false />
            </div>

            <div class="mb-3">
                <x-form.label for="mobile_no" label="{{ localize('Mobile No') }}" />
                <x-form.input
                    name="mobile_no"
                    id="mobile_no"
                    type="text"
                    placeholder="{{ localize('Mobile No') }}"
                    value=""
                    showDiv=false
                />
            </div>

            <div class="mb-3">
                <x-form.label for="email" label="{{ localize('Email') }}" />
                <x-form.input name="email" id="email" type="email" placeholder="{{ localize('Email') }}" value="" showDiv=false />
            </div>


            <div class="mb-3">
                <x-form.label for="is_active" label="{{ localize('Status') }}" />
                <x-form.select name="is_active" id="is_active">
                    @foreach (appStatic()::STATUS_ARR as $MenuStatusId => $MenuStatus)
                        <option value="{{ $MenuStatusId }}">{{ $MenuStatus }}</option>
                    @endforeach
                </x-form.select>
            </div>

        </div>
        <div class="offcanvas-footer border-top">
            <div class="d-flex gap-3">
                <x-form.button id="addBranchBtn">{{ localize('Save') }}</x-form.button>
                <x-form.button color="secondary" type="reset">{{ localize('Reset') }}</x-form.button>
            </div>
        </div>
    </div>
</form>
