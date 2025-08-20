<div class="card">
    <form action="{{ route('admin.settings.store') }}"
          class="serper-form settingsForm"
          enctype="multipart/form-data"
          id="aiClipDrop-form">
        <div class="card-header">
            <h5 class="mb-0">{{ localize('AI Photo Studio Setup') }}</h5>
        </div>
        <div class="card-body">
            <div class="tab-content">
                @csrf
                <div class="row g-3">
                    <div class="col-md-12">
                        <x-form.label for="ai_photo_studio_api_key"
                                      label="{{ localize('ClipDrop  API key for AI Photo Studio') }}"
                                      isRequired=true >

                            <a href="https://clipdrop.co/apis" target="_blank" class="btn btn-sm btn-soft-success">
                                {{ localize("Generate API Key") }}
                            </a>
                        </x-form.label>
                        <x-form.input name="settings[ai_photo_studio_api_key]" 
                                      id="ai_photo_studio_api_key"
                                      type="text"
                                      placeholder="************************************"
                                      value="{{getSetting('ai_photo_studio_api_key')}}"
                                      showDiv=false />
                    </div>
                    <div class="col-md-12">
                        <x-form.label for="enable_ai_photo_studio"
                                      label="{{ localize('Enable AI Photo Studio ?') }}" />
                        <x-form.select name="settings[enable_ai_photo_studio]" id="enable_ai_photo_studio">
                            <option value="0"
                                    {{ getSetting('enable_ai_photo_studio') == '0' ? 'selected' : '' }}>
                                {{ localize('Disable') }}</option>
                            <option value="1"
                                    {{ getSetting('enable_ai_photo_studio') == '1' ? 'selected' : '' }}>
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