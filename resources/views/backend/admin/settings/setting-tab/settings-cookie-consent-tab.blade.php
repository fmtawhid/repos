<div class="card">
    <form action="{{ route('admin.settings.store') }}" class="settings-cookie-form settingsForm" enctype="multipart/form-data" id="settings-cookie-form">
        <div class="card-header">
            <h5 class="mb-0">{{ localize('Cookie Consent') }}</h5>
        </div>
    <div class="card-body">
        <div class="tab-content">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <x-form.label for="cookie_consent_text"
                        label="{{ localize('Cookie Consent Text') }}"
                        isRequired=true />
                        
                    <x-form.textarea name="settings[cookie_consent_text]" id="cookie_consent_text"
                        type="text" placeholder="" value="" showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for="enable_cookie_consent"
                        label="{{ localize('Enable Cookie Consent?') }}" />
                    <x-form.select name="settings[enable_cookie_consent]" id="enable_cookie_consent">
                        <option value="1"
                        {{ getSetting('enable_cookie_consent') == '1' ? 'selected' : '' }}>
                        {{ localize('Enable') }}</option>
                        <option value="0"
                            {{ getSetting('enable_cookie_consent') == '0' ? 'selected' : '' }}>
                            {{ localize('Disable') }}</option>
                
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