<div class="card">
    <form action="{{ route('admin.settings.store') }}" class="smtp-settings-form settingsForm" id="smtp-settings-form">
    <div class="card-header">
        <h5 class="mb-0">{{ localize('SMTP Settings') }}</h5>
    </div>
    <div class="card-body">
        <div class="tab-content">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <x-form.label for="MAIL_HOST"
                        label="{{ localize('Mail Host') }}" isRequired=true />
                    <x-form.input name="env[MAIL_HOST]"
                        id="MAIL_HOST" type="text"
                        placeholder="************************************" value="{{getSetting('MAIL_HOST')}}"
                        showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for="MAIL_PORT"
                        label="{{ localize('Mail Port') }}" isRequired=true />
                    <x-form.input name="env[MAIL_PORT]"
                        id="MAIL_PORT" type="text"
                        placeholder="************************************" value="{{getSetting('MAIL_PORT')}}"
                        showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for="MAIL_USERNAME"
                        label="{{ localize('Mail Username') }}" isRequired=true />
                    <x-form.input name="env[MAIL_USERNAME]"
                        id="MAIL_USERNAME" type="text"
                        placeholder="************************************" value="{{getSetting('MAIL_USERNAME')}}"
                        showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for="MAIL_PASSWORD"
                        label="{{ localize('Mail Password') }}" isRequired=true />
                    <x-form.input name="env[MAIL_PASSWORD]"
                        id="MAIL_PASSWORD" type="text"
                        placeholder="************************************" value="{{getSetting('MAIL_PASSWORD')}}"
                        showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for="MAIL_ENCRYPTION"
                        label="{{ localize('Mail Encryption') }}" isRequired=true />
                    <x-form.input name="env[MAIL_ENCRYPTION]"
                        id="MAIL_ENCRYPTION" type="text"
                        placeholder="************************************" value="{{getSetting('MAIL_ENCRYPTION')}}"
                        showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for="MAIL_FROM_ADDRESS"
                        label="{{ localize('Mail Form Address') }}" isRequired=true />
                    <x-form.input name="env[MAIL_FROM_ADDRESS]"
                        id="MAIL_FROM_ADDRESS" type="text"
                        placeholder="************************************" value="{{getSetting('MAIL_FROM_ADDRESS')}}"
                        showDiv=false />
                </div>

                <div class="col-md-12">
                    <x-form.label for="MAIL_FROM_NAME"
                        label="{{ localize('Mail From Name') }}"
                        isRequired=false />
                    <x-form.input name="env[MAIL_FROM_NAME]"
                        id="MAIL_FROM_NAME" type="text"
                        placeholder="********************************" value="{{getSetting('MAIL_FROM_NAME')}}"
                        showDiv=false />
                </div>                    
                <div class="col-md-12">
                    <x-form.label for="MAIL_MAILER"
                        label="{{ localize('Mail Mailer') }}" />
                    <x-form.select name="env[MAIL_MAILER]" id="MAIL_MAILER">
                        <option value="smtp"
                            {{ getSetting('smtp') == 'smtp' ? 'selected' : '' }}>
                            {{ localize('SMTP') }}</option>
                        <option value="sendmail"
                            {{ getSetting('sendmail') == 'sendmail' ? 'selected' : '' }}>
                            {{ localize('Send Mail') }}</option>
                    </x-form.select>
                </div>
                <div class="col-md-12">
                    <x-form.label for="is_active"
                        label="{{ localize('Is Active ?') }}" />
                    <x-form.select name="env[is_active]" id="is_active">
                        <option value="0"
                            {{ getSetting('is_active') == '1' ? 'selected' : '' }}>
                            {{ localize('Active') }}</option>
                        <option value="1"
                            {{ getSetting('is_active') == '0' ? 'selected' : '' }}>
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