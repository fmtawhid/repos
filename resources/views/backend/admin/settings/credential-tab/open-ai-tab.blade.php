<div class="card">
    <form action="{{ route('admin.settings.store') }}" class="open-ai-form settingsForm"
    enctype="multipart/form-data" id="open-ai-form">
    <div class="card-header">
        <h5 class="mb-0">{{ localize('Open AI Setup') }}</h5>
    </div>
    <div class="card-body">
        <div class="tab-content">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <x-form.label for="OPENAI_SECRET_KEY"
                        label="{{ localize('Open AI Secret Key') }}" isRequired=true />
                    <x-form.input name="env[OPENAI_SECRET_KEY]"
                        id="OPENAI_SECRET_KEY" type="text"
                        placeholder="************************************" value="{{getSetting('OPENAI_SECRET_KEY')}}"
                        showDiv=false />
                </div>
                <div class="col-md-6">
                    <x-form.label for="default_open_ai_model"
                        label="{{ localize('Default AI Model') }}" />
                    <x-form.select name="settings[default_open_ai_model]"
                        id="default_open_ai_model">
                        @foreach (appStatic()::OPEN_AI_MODELS as $key => $model)
                            <option value="{{ $key }}"
                                {{ getSetting('default_open_ai_model') == $key ? 'selected' : '' }}>
                                {{ localize($model) }}
                            </option>
                        @endforeach
                    </x-form.select>
                </div>
                <div class="col-md-6">
                    <x-form.label for="ai_chat_model"
                        label="{{ localize('AI Chat Model') }}" />
                    <x-form.select name="settings[ai_chat_model]" id="ai_chat_model">
                        @foreach (appStatic()::OPEN_AI_MODELS as $key => $model)
                            <option value="{{ $key }}"
                                {{ getSetting('ai_chat_model') == $key ? 'selected' : '' }}>
                                {{ localize($model) }}
                            </option>
                        @endforeach
                    </x-form.select>
                </div>
                <div class="col-md-6">
                    <x-form.label for="ai_blog_wizard_model"
                        label="{{ localize('AI Blog Wizard Model') }}" />
                    <x-form.select name="settings[ai_blog_wizard_model]"
                        id="ai_blog_wizard_model">
                        @foreach (appStatic()::OPEN_AI_MODELS as $key => $model)
                        <option value="{{ $key }}"
                            {{ getSetting('ai_blog_wizard_model') == $key ? 'selected' : '' }}>
                            {{ localize($model) }}
                        </option>
                    @endforeach
                    </x-form.select>
                </div>
                <div class="col-md-6">
                    <x-form.label for="generate_image_option"
                        label="{{ localize('Generate Images AI Blog Wizard') }}" />
                    <x-form.select name="settings[generate_image_option]"
                        id="generate_image_option">
                        <option value="dall_e_2"
                            @if (getSetting('generate_image_option') == 'dall_e_2') selected @endif>
                            {{ localize('Dall-E 2') }}
                        </option>
                        <option value="dall_e_3"
                            @if (getSetting('generate_image_option') == 'dall_e_3') selected @endif>
                            {{ localize('Dall-E 3') }}
                        </option>
                        <option value="stable_diffusion"
                            @if (getSetting('generate_image_option') == 'stable_diffusion') selected @endif>
                            {{ localize('Stable Diffusion') }}
                        </option>
                    </x-form.select>
                </div>
                <div class="col-md-6">
                    <x-form.label for="default_creativity"
                        label="{{ localize('Default Creativity Level') }}" />
                    <x-form.select name="settings[default_creativity]"
                        id="default_creativity">
                        <option value="1"
                            @if (getSetting('default_creativity') == '1') selected @endif>
                            {{ localize('High') }}
                        </option>
                        <option value="0.5"
                            @if (getSetting('default_creativity') == '0.5') selected @endif>
                            {{ localize('Medium') }}
                        </option>
                        <option value="0"
                            @if (getSetting('default_creativity') == '0') selected @endif>
                            {{ localize('Low') }}
                        </option>
                    </x-form.select>
                </div>
                <div class="col-md-6">
                    <x-form.label for="default_number_of_results"
                        label="{{ localize('Default Number Of Results') }}" />
                    <x-form.select name="settings[default_number_of_results]"
                        id="default_number_of_results">
                        <option value="1"
                            @if (getSetting('default_number_of_results') == '1') selected @endif>1
                        </option>
                        <option value="2"
                            @if (getSetting('default_number_of_results') == '2') selected @endif>2
                        </option>
                        <option value="3"
                            @if (getSetting('default_number_of_results') == '3') selected @endif>3
                        </option>
                        <option value="4"
                            @if (getSetting('default_number_of_results') == '4') selected @endif>4
                        </option>
                        <option value="5"
                            @if (getSetting('default_number_of_results') == '5') selected @endif>5
                        </option>
                    </x-form.select>
                </div>
                <div class="col-md-6">
                    <x-form.label for="default_tone"
                        label="{{ localize('Default Tone Of Output Result') }}" />
                    <x-form.select name="settings[default_tone]" id="default_tone">
                        <option value="Friendly"
                            @if (getSetting('default_tone') == 'Friendly') selected @endif>
                            {{ localize('Friendly') }}
                        </option>
                        <option value="Luxury"
                            @if (getSetting('default_tone') == 'Luxury') selected @endif>
                            {{ localize('Luxury') }}
                        </option>
                        <option value="Relaxed"
                            @if (getSetting('default_tone') == 'Relaxed') selected @endif>
                            {{ localize('Relaxed') }}
                        </option>
                        <option value="Professional"
                            @if (getSetting('default_tone') == 'Professional') selected @endif>
                            {{ localize('Professional') }}
                        </option>
                        <option value="Casual"
                            @if (getSetting('default_tone') == 'Casual') selected @endif>
                            {{ localize('Casual') }}
                        </option>
                        <option value="Excited"
                            @if (getSetting('default_tone') == 'Excited') selected @endif>
                            {{ localize('Excited') }}
                        </option>
                        <option value="Bold"
                            @if (getSetting('default_tone') == 'Bold') selected @endif>
                            {{ localize('Bold') }}
                        </option>
                        <option value="Masculine"
                            @if (getSetting('default_tone') == 'Masculine') selected @endif>
                            {{ localize('Masculine') }}
                        </option>
                        <option value="Dramatic"
                            @if (getSetting('default_tone') == 'Dramatic') selected @endif>
                            {{ localize('Dramatic') }}
                        </option>
                    </x-form.select>
                </div>

                <div class="col-md-6">
                    <x-form.label for="api_key_use"
                        label="{{ localize('Openai API Key Usage Model') }}" />
                    <x-form.select name="settings[api_key_use]" id="api_key_use">
                        <option value="main"
                            {{ getSetting('api_key_use') == 'main' || !getSetting('api_key_use') ? 'selected' : '' }}>
                            {{ localize('Main Api key') }}
                        </option>
                      
                    </x-form.select>
                </div>
                <div class="col-md-6">
                    <x-form.label for="default_max_result_length"
                        label="{{ localize('Default Max Result Length') }}" />
                    <x-form.input name="settings[default_max_result_length]"
                        id="default_max_result_length" type="text" placeholder=""
                        value="" showDiv=false />
                </div>
                <div class="col-md-6">
                    <x-form.label for="default_max_result_length_blog_wizard"
                        label="{{ localize('Default Max Result Length Blog Wizard') }}" />
                    <x-form.input
                        name="settings[default_max_result_length_blog_wizard]"
                        id="default_max_result_length_blog_wizard" type="text"
                        placeholder="" value="" showDiv=false />

                </div>
                <div class="col-md-12">
                    <x-form.label for="ai_filter_bad_words"
                        label="{{ localize('Bad Words') }}" />

                    <x-form.textarea name="settings[ai_filter_bad_words]"
                        id="ai_filter_bad_words" type="text" placeholder=""
                        value="" showDiv=false />
                    <small>* {{ localize('Comma Separated: One, Two') }}</small>
                </div>
                <div class="col-md-6">
                    <x-form.label for="opne_ai_tts_maximum_character"
                        label="{{ localize('Maximum characters for Text to Speech') }}" />
                    <x-form.input name="settings[opne_ai_tts_maximum_character]"
                        id="opne_ai_tts_maximum_character" type="text" placeholder=""
                        value="" showDiv=false />
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer bg-transparent mt-3">
        <x-form.button type="submit" class="settingsSubmitButton btn-sm"><i data-feather="save"></i>{{ localize('Save Configuration') }}</x-form.button>
    </div>
</form>
</div>