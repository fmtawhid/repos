<div class="card">
    <form action="{{ route('admin.settings.store') }}" class="aws-form settingsForm"
    enctype="multipart/form-data" id="aws-form">
    <div class="card-header">
        <h5 class="mb-0">{{ localize('AWS Access Key') }}</h5>
    </div>
    <div class="card-body">
        <div class="tab-content">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <x-form.label for="AWS_ACCESS_KEY_ID"
                        label="{{ localize('AWS Access Key') }}" isRequired=true />
                    <x-form.input name="env[AWS_ACCESS_KEY_ID]"
                        id="AWS_ACCESS_KEY_ID" type="text"
                        placeholder="************************************" value="{{getSetting('AWS_ACCESS_KEY_ID')}}"
                        showDiv=false />
                </div>

                <div class="col-md-12">
                    <x-form.label for="AWS_SECRET_ACCESS_KEY"
                        label="{{ localize('AWS Secret Access Key') }}"
                        isRequired=false />
                    <x-form.input name="env[AWS_SECRET_ACCESS_KEY]"
                        id="AWS_SECRET_ACCESS_KEY" type="text"
                        placeholder="********************************" value="{{getSetting('AWS_SECRET_ACCESS_KEY')}}"
                        showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for="AWS_DEFAULT_REGION"
                        label="{{ localize('AWS Region') }}" isRequired=false />
                    <x-form.input name="env[AWS_DEFAULT_REGION]"
                        id="AWS_DEFAULT_REGION" type="text" placeholder=""
                        value="{{getSetting('AWS_DEFAULT_REGION')}}" showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for="enable_aws"
                        label="{{ localize('Enable AWS?') }}" />
                    <x-form.select name="settings[enable_aws]" id="enable_aws">
                        <option value="0"
                            {{ getSetting('enable_aws') == '0' ? 'selected' : '' }}>
                            {{ localize('Disable') }}</option>
                        <option value="1"
                            {{ getSetting('enable_aws') == '1' ? 'selected' : '' }}>
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