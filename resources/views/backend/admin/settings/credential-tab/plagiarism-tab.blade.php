<div class="card">
    <form action="{{ route('admin.settings.store') }}" class="plagiarism-form settingsForm"
                enctype="multipart/form-data" id="plagiarism-form">
        <div class="card-header">
            <h5 class="mb-0">{{ localize('Plagiarism  Setup') }}</h5>
        </div>
        <div class="card-body">
            <div class="tab-content">
                @csrf
                <div class="row g-3">
                    <div class="col-md-12">
                        <x-form.label for="plagiarism_api_key"
                            label="{{ localize('Plagiarism Api key for real time data') }}"
                            isRequired=true>
                            <a href="https://dev.gowinston.ai/" target="_blank" >
                                {{ localize("Generate API Key") }}
                            </a>
                        </x-form.label>
                        <x-form.input
                                name="settings[plagiarism_api_key]" id="plagiarism_api_key"
                                type="text"
                                placeholder="************************************"
                                value="{{getSetting('plagiarism_api_key')}}"
                                showDiv=false />
                    </div>
                    <div class="col-md-12">
                        <x-form.label for="enable_plagiarism"
                            label="{{ localize('Enable Plagiarism ?') }}" />
                        <x-form.select name="settings[enable_plagiarism]" id="enable_plagiarism">
                            <option value="0"
                                {{ getSetting('enable_plagiarism') == '0' ? 'selected' : '' }}>
                                {{ localize('Disable') }}</option>
                            <option value="1"
                                {{ getSetting('enable_plagiarism') == '1' ? 'selected' : '' }}>
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