
<form action="{{ route('admin.tables.store') }}" method="POST" id="addTableFrm">
<div class="offcanvas offcanvas-end" id="addTableSideBar" tabindex="-1">
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
                <x-form.label for="area_id" label="{{ localize('Choose Area') }}" isRequired=true />
                <x-form.select name="area_id" id="area_id">
                    <option value="">{{ localize('Select Area') }}</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                </x-form.select>
            </div>

            <div class="mb-3">
                <x-form.label for="table_code" label="{{ localize('Table Code') }}" isRequired=true />
                <x-form.input name="table_code" id="table_code" type="text" placeholder="{{ localize('e.g: A01') }}" value="" showDiv=false />
            </div>
            
            
            <div class="mb-3">
                <x-form.label for="number_of_seats" label="{{ localize('Seating Capacity') }}" />
                <x-form.input name="number_of_seats" id="number_of_seats" type="number" placeholder="{{ localize('Enter the number of seats (e.g: 5)') }}" value="" showDiv=false />
            </div>                  
           
            <div class="mb-3">
                <x-form.label for="is_active" label="{{ localize('Status') }}" />
                <x-form.select name="is_active" id="is_active">
                    @foreach (appStatic()::STATUS_ARR as $TableStatusId => $TableStatus)
                        <option value="{{ $TableStatusId }}">{{ $TableStatus }}</option>
                    @endforeach
                </x-form.select>
            </div>

        </div>
        <div class="offcanvas-footer border-top">
            <div class="d-flex gap-3">
                <x-form.button id="addTableBtn">{{ localize('Save') }}</x-form.button>
                <x-form.button color="secondary" type="reset">{{ localize('Reset') }}</x-form.button>
            </div>
        </div>
    </div>
</form>
