<div class="card">
    <form action="{{ route('admin.settings.store') }}" class="facebook-setup-form settingsForm"
                enctype="multipart/form-data" id="facebook-setup-form">
    <div class="card-header">
        <h5 class="mb-0">{{ localize('Facebook  Setup') }}</h5>
    </div>
    <div class="card-body">
        <div class="tab-content">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <x-form.label for="FACEBOOK_APP_ID"
                        label="{{ localize('Facebook App ID') }}" isRequired=true />
                    <x-form.input name="env[FACEBOOK_APP_ID]"
                        id="FACEBOOK_APP_ID" type="text"
                        placeholder="************************************" value="{{getSetting('FACEBOOK_APP_ID')}}"
                        showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for="FACEBOOK_APP_SECRET"
                        label="{{ localize('Facebook App Secret') }}" isRequired=true />
                    <x-form.input name="env[FACEBOOK_APP_SECRET]"
                        id="FACEBOOK_APP_SECRET" type="text"
                        placeholder="************************************" value="{{getSetting('FACEBOOK_APP_SECRET')}}"
                        showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for=""
                        label="{{ localize('Facebook Redirect Url') }}"
                        isRequired=true />
                    <x-form.input name="" id="" type="text"
                        placeholder="************************************"
                        value="{{ url('/social-login/redirect/facebook') }}"
                        showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for=""
                        label="{{ localize('facebook Callback URL') }}"
                        isRequired=true />
                    <x-form.input name="" id="" type="text"
                        placeholder="************************************"
                        value="{{ url('/social-login/facebook/callback') }}"
                        showDiv=false />
                </div>

                <div class="col-md-12">
                    <x-form.label for="facebook_login"
                        label="{{ localize('Enable Facebook Login ?') }}" />
                    <x-form.select name="settings[facebook_login]" id="facebook_login">
                        <option value="1"
                            {{ getSetting('facebook_login') == '1' ? 'selected' : '' }}>
                            {{ localize('Enable') }}</option>
                        <option value="0"
                            {{ getSetting('facebook_login') == '0' ? 'selected' : '' }}>
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