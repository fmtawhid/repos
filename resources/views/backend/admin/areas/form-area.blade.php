
<form action="{{ route('admin.areas.store') }}" method="POST" id="addAreaFrm">
<div class="offcanvas offcanvas-end" id="addAreaSideBar" tabindex="-1">
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
                <x-form.label for="branch_ids" label="{{ localize('Branch') }}" />
                <x-form.select multiple class="select2" name="branch_ids[]" id="branch_ids" style="width: 100%">
                    <option>-- {{ localize('Select Branches') }} --</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </x-form.select>
            </div>

            <div class="mb-3">
                <x-form.label for="number_of_tables" label="{{ localize('Number Of Tables') }}" />
                <x-form.input name="number_of_tables" id="number_of_tables" type="number" placeholder="{{ localize('Number Of Tables') }}" value="" showDiv=false />
            </div>

            <div class="mb-3">
                <x-form.label for="is_active" label="{{ localize('Status') }}" />
                <x-form.select name="is_active" id="is_active">
                    @foreach (appStatic()::STATUS_ARR as $areaStatusId => $areaStatus)
                        <option value="{{ $areaStatusId }}">{{ $areaStatus }}</option>
                    @endforeach
                </x-form.select>
            </div>

        </div>
        <div class="offcanvas-footer border-top">
            <div class="d-flex gap-3">
                <x-form.button id="addAreaBtn">{{ localize('Save') }}</x-form.button>
                <x-form.button color="secondary" type="reset">{{ localize('Reset') }}</x-form.button>
            </div>
        </div>
    </div>
</form>
