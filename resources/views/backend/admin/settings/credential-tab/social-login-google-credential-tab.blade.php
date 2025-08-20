<div class="card">
    <form action="{{ route('admin.settings.store') }}" class="google-setup-form settingsForm"
    enctype="multipart/form-data" id="google-setup-form">
    <div class="card-header">
        <h5 class="mb-0">{{ localize('Google Setup') }}</h5>
    </div>
    <div class="card-body">
        <div class="tab-content">
                @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <x-form.label for="GOOGLE_CLIENT_ID"
                        label="{{ localize('Google Client ID') }}" isRequired=true />
                    <x-form.input name="env[GOOGLE_CLIENT_ID]"
                        id="GOOGLE_CLIENT_ID" type="text"
                        placeholder="************************************" value="{{getSetting('GOOGLE_CLIENT_ID')}}"
                        showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for="GOOGLE_CLIENT_SECRET"
                        label="{{ localize('Google Client Secret') }}" isRequired=true />
                    <x-form.input name="env[GOOGLE_CLIENT_SECRET]"
                        id="GOOGLE_CLIENT_SECRET" type="text"
                        placeholder="************************************" value="{{getSetting('GOOGLE_CLIENT_SECRET')}}"
                        showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for=""
                        label="{{ localize('Google Redirect URL') }}" isRequired=true />
                    <x-form.input name="" id="" type="text"
                        placeholder="************************************"
                        value="{{ url('/social-login/redirect/google') }}"
                        showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for=""
                        label="{{ localize('Google Callback URL') }}" isRequired=true />
                    <x-form.input name="" id="" type="text"
                        placeholder="************************************"
                        value="{{ url('/social-login/google/callback') }}"
                        showDiv=false />
                </div>

                <div class="col-md-12">
                    <x-form.label for="google_login"
                        label="{{ localize('Enable Google Login ?') }}" />
                    <x-form.select name="settings[google_login]" id="google_login">
                        <option value="1"
                            {{ getSetting('google_login') == '1' ? 'selected' : '' }}>
                            {{ localize('Enable') }}</option>
                        <option value="0"
                            {{ getSetting('google_login') == '0' ? 'selected' : '' }}>
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