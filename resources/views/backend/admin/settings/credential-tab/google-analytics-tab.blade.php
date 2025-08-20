<div class="card">
    <form action="{{ route('admin.settings.store') }}" class="google-analyties-form settingsForm"
                enctype="multipart/form-data" id="google-analyties-form">
    <div class="card-header">
        <h5 class="mb-0">{{ localize('Google Analytics Setup') }}</h5>
    </div>
    <div class="card-body">
        <div class="tab-content">
            
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <x-form.label for="TRACKING_ID" label="{{ localize('Tracking ID') }}"
                        isRequired=true />
                    <x-form.input name="env[TRACKING_ID]"
                        id="TRACKING_ID" type="text"
                        placeholder="************************************" value="{{getSetting('TRACKING_ID')}}"
                        showDiv=false />
                </div>

                <div class="col-md-12">
                    <x-form.label for="enable_google_analytics"
                        label="{{ localize('Enable Google Analytics') }}" />
                    <x-form.select name="settings[enable_google_analytics]"
                        id="enable_google_analytics">
                        <option value="0"
                            {{ getSetting('enable_google_analytics') == '0' ? 'selected' : '' }}>
                            {{ localize('Disable') }}</option>
                        <option value="1"
                            {{ getSetting('enable_google_analytics') == '1' ? 'selected' : '' }}>
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