<div class="card">
    <form action="{{ route('admin.settings.store') }}" class="serper-form settingsForm"
    enctype="multipart/form-data" id="serper-form">
    <div class="card-header">
        <h5 class="mb-0">{{ localize('Serper  Setup') }}</h5>
    </div>
    <div class="card-body">
        <div class="tab-content">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <x-form.label for="serper_api_key"
                        label="{{ localize('Serper Api key for real time data') }}"
                        isRequired=true />
                    <x-form.input name="settings[serper_api_key]" id="serper_api_key"
                        type="text" placeholder="************************************"
                        value="{{getSetting('serper_api_key')}}" showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for="enable_serper"
                        label="{{ localize('Enable Serper ?') }}" />
                    <x-form.select name="settings[enable_serper]" id="enable_serper">
                        <option value="0"
                            {{ getSetting('enable_serper') == '0' ? 'selected' : '' }}>
                            {{ localize('Disable') }}</option>
                        <option value="1"
                            {{ getSetting('enable_serper') == '1' ? 'selected' : '' }}>
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