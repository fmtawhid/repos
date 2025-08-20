<div class="card">
    <form action="{{ route('admin.settings.store') }}" class="google-adsense-form settingsForm"
                enctype="multipart/form-data" id="google-adsense-form">
    <div class="card-header">
        <h5 class="mb-0">{{ localize('Google Adsense Setup') }}</h5>
    </div>
    <div class="card-body">
        <div class="tab-content">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <x-form.label for="adsense_code_snippet"
                        label="{{ localize('AdSense code snippet') }}" isRequired=true />
                    <x-form.textarea name="settings[adsense_code_snippet]" value="{!! getSetting('adsense_code_snippet') !!}"
                        id="adsense_code_snippet" type="text" showDiv=false />
                </div>

                <div class="col-md-12">
                    <x-form.label for="enable_google_adsense"
                        label="{{ localize('Enable Recaptcha') }}" />
                    <x-form.select name="settings[enable_google_adsense]"
                        id="enable_google_adsense">
                        <option value="0"
                            {{ getSetting('enable_google_adsense') == '0' ? 'selected' : '' }}>
                            {{ localize('Disable') }}</option>
                        <option value="1"
                            {{ getSetting('enable_google_adsense') == '1' ? 'selected' : '' }}>
                            {{ localize('Enable') }}</option>
                    </x-form.select>
                </div>
            </div>

        </div>
    </div>
    <div class="card-footer bg-transparent mt-3">
        <x-form.button type="submit" class="settingsSubmitButton btn-sm"><i data-feather="save"></i>{{ localize('Save Configuration') }}</x-form.button>
    </div>
</form>
</div>