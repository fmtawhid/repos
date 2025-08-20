<div class="card">
    <form action="{{ route('admin.settings.store') }}" method="POST" class="general-settings-form settingsForm"
    enctype="multipart/form-data" id="general-settings-form">
    <div class="card-header">
        <h5 class="mb-0">{{ localize('System Setting Configuration') }}</h5>
    </div>
    <div class="card-body">
        <div class="tab-content">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <x-form.label for="enable_preloader" label="{{ localize('Enable Preloader') }}" />
                        <x-form.select name="settings[enable_preloader]" id="enable_preloader">
                            <option value="1" {{ getSetting('enable_preloader') == 1 ? 'selected' : '' }}>
                                {{ localize('Enable') }}</option>
                            <option value="0" {{ getSetting('enable_preloader') == 0 ? 'selected' : '' }}>
                                {{ localize('Disable') }}</option>
                        </x-form.select>
                    </div>
                    <div class="col-md-6">
                        <x-form.label for="default_date_format" label="{{ localize('Date Format') }}" />
                        <x-form.select name="settings[default_date_format]" id="default_date_format">
                            @foreach (appStatic()::DATE_FORMAT_LIST as $key => $format)
                                <option value="{{ $key }}"
                                    {{ getSetting('default_date_format') == $key ? 'selected' : '' }}>
                                    {{ $format }}</option>
                            @endforeach
                        </x-form.select>
                    </div>
                    <div class="col-md-6">
                        <x-form.label for="default_currency" label="{{ localize('Default Currency') }}" />
                        <x-form.select name="settings[default_currency]" id="default_currency">
                            <option value="USD">{{ localize('USD') }}</option>
                        </x-form.select>
                    </div>
                    <div class="col-md-6">
                        <x-form.label for="default_language" label="{{ localize('Set Default Language') }}" />
                        <x-form.select name="settings[default_language]" id="default_language">
                            <option value="en">{{ localize('English') }}</option>
                        </x-form.select>
                    </div>
                    <div class="col-md-6">
                        <x-form.label for="active_storage" label="{{ localize('Active Storage') }}" />
                        <x-form.select name="settings[active_storage]" id="active_storage">
                            @foreach ($storages as $key => $list)
                            <option value="{{ $list->type }}"
                                {{ getSetting('active_storage') == $list->type ? 'selected' : '' }}>
                                {{ strtoupper($list->type) }} {{ localize('Storage') }}
                            </option>
                        @endforeach
                        </x-form.select>
                    </div>
                    <div class="col-md-6">
                        <x-form.label for="enable_maintenance_mode"
                            label="{{ localize('Enable Maintenance Mode') }}" />
                        <x-form.select name="settings[enable_maintenance_mode]" id="enable_maintenance_mode">
                            <option value="0"
                                {{ getSetting('enable_maintenance_mode') == '0' ? 'selected' : '' }}>
                                {{ localize('Disable') }}</option>
                            <option value="1"
                                {{ getSetting('enable_maintenance_mode') == '1' ? 'selected' : '' }}>
                                {{ localize('Enable') }}</option>
                        </x-form.select>
                    </div>
                    <div class="col-md-6">

                        <x-form.label for="enable_frontend" label="{{ localize('Frontend Status') }}" />
                        <span>({{ localize('if disable only login, registration page will be show.') }})</span>
                        <x-form.select name="settings[enable_frontend]" id="enable_frontend">
                            <option value="1" {{ getSetting('enable_frontend') == '1' ? 'selected' : '' }}>
                                {{ localize('Enable') }}</option>
                            <option value="0" {{ getSetting('enable_frontend') == '0' ? 'selected' : '' }}>
                                {{ localize('Disable') }}</option>
                        </x-form.select>
                    </div>
                    <div class="col-md-6">
                        <x-form.label for="registration_with" label="{{ localize('Customer Registration') }}" />
                        <x-form.select name="settings[registration_with]" id="registration_with">
                            <option value="email" {{ getSetting('registration_with') == 'email' ? 'selected' : '' }}>
                                {{ localize('Email Required') }}</option>
                            <option value="email_and_phone"
                                {{ getSetting('registration_with') == 'email_and_phone' ? 'selected' : '' }}>
                                {{ localize('Email & Phone Both Required') }}</option>
                        </x-form.select>
                    </div>
                    <div class="col-md-6">
                        <x-form.label for="registration_verification_with"
                            label="{{ localize('Registration Verification') }}" />
                        <x-form.select name="settings[registration_verification_with]"
                            id="registration_verification_with">
                            <option value="disable"
                                {{ getSetting('registration_verification_with') == 'disable' ? 'selected' : '' }}>
                                {{ localize('Disable') }}</option>
                            <option value="email"
                                {{ getSetting('registration_verification_with') == 'email' ? 'selected' : '' }}>
                                {{ localize('Email Verification') }}</option>
                            <option value="phone"
                                {{ getSetting('registration_verification_with') == 'email_and_phone' ? 'selected' : '' }}>
                                {{ localize('OTP Verification') }}</option>
                        </x-form.select>
                    </div>
                    <div class="col-md-6">
                        <x-form.label for="welcome_email"
                            label="{{ localize('Send Welcome Email After Registration') }}" />
                        <x-form.select name="settings[welcome_email]" id="welcome_email">
                            <option value="0" {{ getSetting('welcome_email') == 'disable' ? 'selected' : '' }}>
                                {{ localize('Disable') }}</option>
                            <option value="1" {{ getSetting('welcome_email') == 'email' ? 'selected' : '' }}>
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
