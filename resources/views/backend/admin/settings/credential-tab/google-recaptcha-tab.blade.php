<div class="card">
    <form action="{{ route('admin.settings.store') }}" class="google-recaptcha-form settingsForm"
                enctype="multipart/form-data" id="google-recaptcha-form">
    <div class="card-header">
        <h5 class="mb-0">{{ localize('Google Recaptcha Setup') }}</h5>
    </div>
    <div class="card-body">
        <div class="tab-content">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <x-form.label for="RECAPTCHAV3_SITEKEY"
                        label="{{ localize('Recaptcha Site Key') }}" isRequired=true />
                    <x-form.input name="env[RECAPTCHAV3_SITEKEY]"
                        id="RECAPTCHAV3_SITEKEY" type="text"
                        placeholder="************************************" value="{{getSetting('RECAPTCHAV3_SITEKEY')}}"
                        showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for="RECAPTCHAV3_SECRET"
                        label="{{ localize('Recaptcha Secret Key') }}" isRequired=true />
                    <x-form.input name="env[RECAPTCHAV3_SECRET]"
                        id="RECAPTCHAV3_SECRET" type="text"
                        placeholder="************************************" value="{{getSetting('RECAPTCHAV3_SECRET')}}"
                        showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for="enable_recaptcha"
                        label="{{ localize('Enable Recaptcha') }}" />
                    <x-form.select name="settings[enable_recaptcha]"
                        id="enable_recaptcha">
                        <option value="0"
                            {{ getSetting('enable_recaptcha') == '0' ? 'selected' : '' }}>
                            {{ localize('Disable') }}</option>
                        <option value="1"
                            {{ getSetting('enable_recaptcha') == '1' ? 'selected' : '' }}>
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