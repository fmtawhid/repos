<form action="{{ route('admin.languages.store') }}" method="POST" id="addLanguageForm">
    <div class="offcanvas offcanvas-end" id="addLanguageFormSidebar" tabindex="-1">
        @method('POST')
        @csrf
        <x-form.input name="id" id="id" type="hidden" value="" showDiv=0 />
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">{{ localize('Add New Language') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <x-common.splitter />
        <div class="offcanvas-body">
            <x-common.message class="mb-3" />

            <div class="mb-3">
                <x-form.label for="name" label="{{ localize('Language Name') }}" isRequired=true />
                <x-form.input name="name" id="name" type="text" placeholder="{{ localize('Name') }}"
                    value="" showDiv=false />
            </div>
            <div class="mb-3">
                <x-form.label for="code" label="{{ localize('ISO 639-1 Code') }}" isRequired=true />
                <x-form.input name="code" id="code" type="text" placeholder="{{ localize('en/bn') }}"
                    value="" showDiv=false />
            </div>


            <div class="mb-3">
                <x-form.label for="flag" label="{{ localize('Flag') }}" />
                <x-form.select name="flag" id="flag" class="select2 country-flag-select">
                    @foreach (\File::files(base_path('public/assets/img/flags')) as $path)
                        <option value="{{ pathinfo($path)['filename'] }}"
                            data-flag="{{ urlVersion('assets/img/flags/' . pathinfo($path)['filename'] . '.png') }}">
                            {{ strtoupper(pathinfo($path)['filename']) }}
                        </option>
                    @endforeach
                </x-form.select>
            </div>
            <div class="mb-3">
                <x-form.label for="is_active_for_templates" label="{{ localize('Show In Templates') }}" />
                <x-form.select name="is_active_for_templates" id="is_active_for_templates">
                    <option value="0">
                        {{ localize('No') }}
                    </option>
                    <option value="1">
                        {{ localize('Yes') }}
                    </option>
                </x-form.select>
            </div>
            <div class="mb-3">
                <x-form.label for="is_rtl" label="{{ localize('IS RTL') }}" />
                <x-form.select name="is_rtl" id="is_rtl">
                    <option value="0">
                        {{ localize('No') }}
                    </option>
                    <option value="1">
                        {{ localize('Yes') }}
                    </option>
                </x-form.select>
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
