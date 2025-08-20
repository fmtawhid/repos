
<form action="{{ route('admin.menus.store') }}" method="POST" id="addMenuFrm">
<div class="offcanvas offcanvas-end" id="addMenuSideBar" tabindex="-1">
        @csrf
        @method("POST")
        <x-form.input name="id" id="id" type="hidden" value="" showDiv=0 />
        <div class="offcanvas-header border-bottom py-3">
            <h5 class="offcanvas-title">{{ localize('Add New Admin') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <x-common.splitter />
        <div class="offcanvas-body">
            <x-common.message class="mb-3" />

            <div class="mb-3">
                <x-form.label for="name" label="{{ localize('Name') }}" isRequired=true />
                <x-form.input name="name" id="name" type="text" placeholder="{{ localize('Name') }}" value="" showDiv=false />
            </div>

            <div class="mb-3">
                <x-form.label for="branch_ids" label="{{ localize('Branch') }}" isRequired="true" />
                <x-form.select multiple class="select2" name="branch_ids[]" id="branch_ids" style="width: 100%" data-placeholder="{{ localize('Select Branches') }}" required>
                    @foreach ($branches as $branchId => $branchName)
                        <option value="{{ $branchId }}">{{ $branchName ?? '' }}</option>
                    @endforeach
                </x-form.select>
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
                <x-form.button id="addMenuBtn">{{ localize('Save') }}</x-form.button>
                <x-form.button color="secondary" type="reset">{{ localize('Reset') }}</x-form.button>
            </div>
        </div>
    </div>
</form>
