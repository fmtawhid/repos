<div class="card">
    <form action="{{ route('admin.settings.store') }}" class="azure-form settingsForm"
    enctype="multipart/form-data" id="azure-form">
    <div class="card-header">
        <h5 class="mb-0">{{ localize('Azure Setup') }}</h5>
    </div>
    <div class="card-body">
        <div class="tab-content">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <x-form.label for="azure_key" label="{{ localize('Azure Key') }}"
                        isRequired=true />
                    <x-form.input name="settings[azure_key]" id="azure_key"
                        type="text" placeholder="************************************"
                        value="{{getSetting('azure_key')}}" showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for="azure_region" label="{{ localize('Azure Region') }}"
                        isRequired=true />
                    <x-form.input name="settings[azure_region]" id="azure_region"
                        type="text" placeholder="************************************"
                        value="{{getSetting('azure_region')}}" showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for="azure_maximum_character"
                        label="{{ localize('Maximum characters') }}" isRequired=false />
                    <x-form.input name="settings[azure_maximum_character]"
                        id="azure_maximum_character" type="text" placeholder="" value="{{getSetting('azure_maximum_character')}}"
                        showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for="enable_azure"
                        label="{{ localize('Enable Azure ?') }}" />
                    <x-form.select name="settings[enable_azure]" id="enable_azure">
                        <option value="0"
                            {{ getSetting('enable_azure') == '0' ? 'selected' : '' }}>
                            {{ localize('Disable') }}</option>
                        <option value="1"
                            {{ getSetting('enable_azure') == '1' ? 'selected' : '' }}>
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