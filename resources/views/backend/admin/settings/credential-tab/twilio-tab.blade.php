<div class="card">
    <form action="{{ route('admin.settings.store') }}" class="twilio-setup-form settingsForm"
    enctype="multipart/form-data" id="twilio-setup-form">
    <div class="card-header">
        <h5 class="mb-0">{{ localize('Twilio  Setup') }}</h5>
    </div>
    <div class="card-body">
        <div class="tab-content">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <x-form.label for="TWILIO_SID" label="{{ localize('Twilio SID') }}"
                        isRequired=true />
                    <x-form.input name="env[TWILIO_SID]" id="TWILIO_SID"
                        type="text" placeholder="************************************"
                        value="{{getSetting('TWILIO_SID')}}" showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for="TWILIO_AUTH_TOKEN"
                        label="{{ localize('Twilio Auth Token') }}" isRequired=true />
                    <x-form.input name="env[TWILIO_AUTH_TOKEN]"
                        id="TWILIO_AUTH_TOKEN" type="text"
                        placeholder="************************************" value="{{getSetting('TWILIO_AUTH_TOKEN')}}"
                        showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for="VALID_TWILIO_NUMBER"
                        label="{{ localize('Valid Twilo Number') }}" isRequired=true />
                    <x-form.input name="env[VALID_TWILIO_NUMBER]"
                        id="VALID_TWILIO_NUMBER" type="text"
                        placeholder="************************************" value="{{getSetting('VALID_TWILIO_NUMBER')}}"
                        showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for="enable_twilio"
                        label="{{ localize('Enable Twilio') }}" />
                    <x-form.select name="settings[enable_twilio]" id="enable_twilio">
                        <option value="0"
                            {{ getSetting('enable_twilio') == '0' ? 'selected' : '' }}>
                            {{ localize('Disable') }}</option>
                        <option value="1"
                            {{ getSetting('enable_twilio') == '1' ? 'selected' : '' }}>
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