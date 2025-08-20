
<form action="{{ route('admin.kitchens.store') }}" method="POST" id="addKitchenFrm">
    <div class="offcanvas offcanvas-end" id="addKitchenSideBar" tabindex="-1">
        @csrf
        @method("POST")
        <x-form.input name="id" id="id" type="hidden" value="" showDiv=0 />
        <div class="offcanvas-header border-bottom py-3">
            <h5 class="offcanvas-title">{{ localize('Add New Kitchen') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <x-common.splitter />
        <div class="offcanvas-body">
            <x-common.message class="mb-3" />

            <div class="mb-3">
                <x-form.label for="name" label="{{ localize('Kitchen Name') }}" isRequired=true />
                <x-form.input name="name" id="name" type="text" placeholder="{{ localize('Name') }}" value="" showDiv=false />
            </div>
            
            <div class="mb-3">
                <x-form.label for="branch_id" label="{{ localize('Branch') }}" isRequired=true/>
                <x-form.select class="select2" name="branch_id" id="branch_id">
                    <option value="">-- {{ localize('Select Branch') }} --</option> 
                    @foreach ($branches as $branchId => $branch)
                        <option value="{{ $branchId }}">{{ $branch ?? '' }}</option>
                    @endforeach
                </x-form.select>
            </div>

            <div class="mb-3">
                <x-form.label for="is_active" label="{{ localize('Status') }}" />
                <x-form.select name="is_active" id="is_active" class="select2">
                    <option value="">-- {{ localize('Select Status') }} --</option> 
                    @foreach (appStatic()::STATUS_ARR as $MenuStatusId => $MenuStatus)
                        <option value="{{ $MenuStatusId }}">{{ $MenuStatus }}</option>
                    @endforeach
                </x-form.select>
            </div>

        </div>
        <div class="offcanvas-footer border-top">
            <div class="d-flex gap-3">
                <x-form.button id="addKitchenBtn">{{ localize('Save') }}</x-form.button>
                <x-form.button color="secondary" type="reset">{{ localize('Reset') }}</x-form.button>
            </div>
        </div>
    </div>
</form>
