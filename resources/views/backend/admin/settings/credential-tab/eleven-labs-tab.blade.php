<div class="card">
    <form action="{{ route('admin.settings.store') }}" class="eleven-labs-form settingsForm"
                enctype="multipart/form-data" id="eleven-labs-form">
    <div class="card-header">
        <h5 class="mb-0">{{ localize('ElevenLabs Voiceover Setup') }}</h5>
    </div>
    <div class="card-body">
        <div class="tab-content">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <x-form.label for="eleven_labs_api_key"
                        label="{{ localize('ElevenLabs API Key') }}" isRequired=true />
                    <x-form.input name="settings[eleven_labs_api_key]"
                        id="eleven_labs_api_key" type="text"
                        placeholder="************************************" value="{{getSetting('eleven_labs_api_key')}}"
                        showDiv=false />
                </div>

                <div class="col-md-12">
                    <x-form.label for="elevenlabs_maximum_character"
                        label="{{ localize('Maximum characters') }}" isRequired=false />
                    <x-form.input name="settings[elevenlabs_maximum_character]"
                        id="elevenlabs_maximum_character" type="text" placeholder=""
                        value="{{getSetting('elevenlabs_maximum_character')}}" showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for="eleven_labs"
                        label="{{ localize('ElevenLabs ?') }}" />
                    <x-form.select name="settings[eleven_labs]" id="eleven_labs">
                        <option value="0"
                            {{ getSetting('eleven_labs') == '0' ? 'selected' : '' }}>
                            {{ localize('Disable') }}</option>
                        <option value="1"
                            {{ getSetting('eleven_labs') == '1' ? 'selected' : '' }}>
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