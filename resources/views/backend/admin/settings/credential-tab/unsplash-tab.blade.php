<div class="card">
    <form action="{{ route('admin.settings.store') }}"
          class="serper-form settingsForm"
          enctype="multipart/form-data"
          id="unsplash-form">
        <div class="card-header">
            <h5 class="mb-0">{{ localize('Unsplash Setup') }}</h5>
        </div>
        <div class="card-body">
            <div class="tab-content">
                @csrf
                <div class="row g-3">
                    <div class="col-md-12">
                        <x-form.label for="unsplash_api_key"
                                      label="{{ localize('Unsplash Client key for Image') }}"
                                      isRequired=true />
                        
                        <x-form.input name="settings[unsplash_client_key]"
                                      id="unsplash_client_key"
                                      type="text" 
                                      placeholder="************************************"
                                      value="{{getSetting('unsplash_client_key')}}"
                                      showDiv=false />
                    </div>

                    <div class="col-md-12">
                        <x-form.label for="unsplash_secret_key"
                                      label="{{ localize('Unsplash Secret key for Image') }}"
                                      isRequired=true />

                        <x-form.input name="settings[unsplash_secret_key]"
                                      id="unsplash_secret_key"
                                      type="text"
                                      placeholder="************************************"
                                      value="{{getSetting('unsplash_secret_key')}}"
                                      showDiv=false />
                    </div>
                    
                    <div class="col-md-12">
                        <x-form.label for="enable_unsplash"
                                      label="{{ localize('Enable Unsplash ?') }}" />
                        <x-form.select name="settings[enable_unsplash]" id="enable_unsplash">
                            <option value="0"
                                    {{ getSetting('enable_unsplash') == '0' ? 'selected' : '' }}>
                                {{ localize('Disable') }}</option>
                            <option value="1"
                                    {{ getSetting('enable_unsplash') == '1' ? 'selected' : '' }}>
                                {{ localize('Enable') }}</option>
                        </x-form.select>
                    </div>
                </div>

            </div>
        </div>
        <div class="card-footer bg-transparent mt-3">
            <x-form.button type="submit" class="settingsSubmitButton btn-sm">
                <i data-feather="save"></i>{{ localize('Save Configuration') }}
            </x-form.button>
        </div>
    </form>
</div>