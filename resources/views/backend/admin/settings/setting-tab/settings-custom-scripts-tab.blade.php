<div class="card">
    <form action="{{ route('admin.settings.store') }}" class="settings-custom-scripts-form" enctype="multipart/form-data" id="settings-custom-scripts-form">
    <div class="card-header">
        <h5 class="mb-0">{{ localize('Custom Scripts') }}</h5>
    </div>
    <div class="card-body">
        <div class="tab-content">
            
                @csrf
                <div class="row g-3">
                    <div class="col-md-12">
                        <x-form.label for="header_custom_scripts"
                            label="{{ localize('Header custom script - before') }} </head> and start with <script></script>" isRequired=true />
                     
                        <x-form.textarea name="settings[header_custom_scripts]" class="code-editor" id="header_custom_scripts"
                            type="text" placeholder="<script></script>" value="{!! getSetting('header_custom_scripts') !!}" showDiv=false />
                        <small>*{{ localize('Copy or write your custom script here') }}</small>
                    </div>
                    <div class="col-md-12">
                        <x-form.label for="footer_custom_scripts"
                            label="{{ localize('Footer custom script - before') }}  </body> start with <script></script>" isRequired=true />

                        <x-form.textarea name="settings[footer_custom_scripts]" class="code-editor" id="footer_custom_scripts"
                            type="text" placeholder="<script></script>" value="{!! getSetting('footer_custom_scripts') !!}" showDiv=false />
                        <small>*{{ localize('Copy or write your custom script here') }}</small>
                    </div>
                    <div class="col-md-12">
                        <x-form.label for="header_custom_css" label="{{ localize('Custom css - before') }} </head> start with <style></style>"
                            isRequired=true />

                        <x-form.textarea name="settings[header_custom_css]" class="code-editor" id="header_custom_css" type="text"
                        placeholder="<style></style>" value="{!! getSetting('header_custom_css') !!}" showDiv=false />
                        <small>*{{ localize('Copy or write your custom css here') }}</small>
                    </div>
                    <div class="col-md-6">
                        <x-form.label for="enable_script" label="{{ localize('Enable Custom script?') }}" />
                        <x-form.select name="settings[enable_script]" id="enable_script">
                            <option value="1" {{ getSetting('enable_script') == '1' ? 'selected' : '' }}>
                                {{ localize('Enable') }}</option>
                            <option value="0" {{ getSetting('enable_script') == '0' ? 'selected' : '' }}>
                                {{ localize('Disable') }}</option>

                        </x-form.select>
                    </div>
                    <div class="col-md-6">
                        <x-form.label for="enable_css" label="{{ localize('Enable Custom CSS?') }}" />
                        <x-form.select name="settings[enable_css]" id="enable_css">
                            <option value="1" {{ getSetting('enable_css') == '1' ? 'selected' : '' }}>
                                {{ localize('Enable') }}</option>
                            <option value="0" {{ getSetting('enable_css') == '0' ? 'selected' : '' }}>
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
