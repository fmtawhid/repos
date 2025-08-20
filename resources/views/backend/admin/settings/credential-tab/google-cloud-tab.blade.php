<div class="card">
    <form action="{{ route('admin.settings.store') }}" class="google-tts-form settingsForm"
    enctype="multipart/form-data" id="google-tts-form">
    <div class="card-header d-flex justify-content-between align-content-center">
        <h5 class="mb-0">{{ localize('Google TTS Settings') }}</h5>
        <a href="" target="_blank"
                rel="noopener noreferrer">{{ localize('Documentation') }}</a>
    </div>
    <div class="card-body">        
        @csrf
        <div class="mb-3">
            <label for="default_creativity" class="form-label">{{ localize('GCS File (JSON)') }}
                <span class="text-danger ms-1">*</span></label>


            <div class="file-drop-area file-upload text-center rounded-3">
                <input type="file" class="file-drop-input" name="file" id="json" />
                <div class="file-drop-icon ci-cloud-upload">
                    <i data-feather="image"></i>
                </div>
                <p class="text-dark fw-bold mb-2 mt-3">
                    {{ localize('Drop your files here or') }}
                    <a href="javascript::void(0);"
                        class="text-primary">{{ localize('Browse') }}</a>
                </p>
                <p class="mb-0 file-name text-muted">
                        {{getSetting('google_tts_file_name')}}
                        <small>* {{ localize('Allowed file types: ') }} .json
                        </small>
                    

                </p>
            </div>
            
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                
                <x-form.label for="project_name" label="{{ localize('Project Name') }}" />
                <x-form.input name="settings[project_name]" id="project_name" type="text" placeholder="" value="{{getSetting('project_name')}}" showDiv=false />
            </div>

            <div class="col-md-6">
                    <x-form.label for="google_tts_maximum_character"
                            label="{{ localize('Maximum characters') }}" />
                        <x-form.input name="settings[google_tts_maximum_character]"
                            id="google_tts_maximum_character" type="text" placeholder="" value="{{getSetting('google_tts_maximum_character')}}" showDiv=false />
            </div>
            <div class="col-md-12">
                <x-form.label for="enable_google_tts" isRequired=false
                    label="{{ localize('Enable Google TTS ?') }}" />
                <x-form.select name="settings[enable_google_tts]" id="enable_google_tts">
                    <option value="0"
                        {{ getSetting('enable_google_tts') == '0' ? 'selected' : '' }}>
                        {{ localize('Disable') }}</option>
                    <option value="1"
                        {{ getSetting('enable_google_tts') == '1' ? 'selected' : '' }}>
                        {{ localize('Enable') }}</option>
                </x-form.select>
            </div>
        </div>
    </div>
    <div class="card-footer bg-transparent mt-3">
        <x-form.button type="submit" class="settingsSubmitButton btn-sm"><i data-feather="save"></i>{{ localize('Save Configuration') }}</x-form.button>
    </div>
</form>
</div>