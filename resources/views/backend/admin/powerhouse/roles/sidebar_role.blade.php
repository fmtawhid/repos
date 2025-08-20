<form action="{{ route('admin.roles.store') }}" method="POST" id="addFrm">
    <div class="offcanvas offcanvas-end" id="addFormSidebar" tabindex="-1">
        @method('POST')
        @csrf
        <x-form.input name="id" id="id" type="hidden" value="" showDiv=0 />
        <div class="offcanvas-header border-bottom py-3">
            <h5 class="offcanvas-title">{{ localize('Add New Role') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <x-common.splitter />
        <div class="offcanvas-body">
            <x-common.message class="mb-3" />

            <div class="mb-3">
                <x-form.label for="name" label="{{ localize('Name') }}" isRequired=true />
                <x-form.input name="name" type="text" id="name" placeholder="{{ localize('Name') }}"
                    value="" showDiv=false />
            </div>

            <div class="mb-3">
                <x-form.label for="is_active" label="{{ localize('Status') }}" />
                <x-form.select name="is_active" id="is_active">
                    @foreach (appStatic()::STATUS_ARR as $dataStatusId => $dataStatus)
                        <option value="{{ $dataStatusId }}">{{ $dataStatus }}</option>
                    @endforeach
                </x-form.select>
            </div>

            <div class="mb-3">
                @if (isVendorTeam())
                    @include('backend.admin.powerhouse.roles.team-group-permissions')
                @else
                    @include('backend.admin.powerhouse.roles.group-permissions')
                @endif
            </div>


        </div>
        <div class="offcanvas-footer border-top">
            <div class="d-flex gap-3">
                <x-form.button id="frmActionBtn">{{ localize('Save') }}</x-form.button>
                <x-form.button color="secondary" type="reset">{{ localize('Reset') }}</x-form.button>
            </div>
        </div>
    </div>
</form>
