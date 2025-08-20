<div class="row mb-4 g-4">
    <!--left sidebar-->
    <div class="col-xl-12 order-2 order-md-2 order-lg-2 order-xl-1">
        <form action="{{ route('admin.appearance.update') }}"  id="feature6" method="POST"  class="appearanceForm">
            @csrf
            <input type="hidden" name="language_key" id="language_id" value="{{ $lang_key }}">
            <!--Navbar-->
            <div class="card mb-4" id="section-1">
                <div class="card-header">
                    <h5 class="mb-0">{{ localize('Feature 6') }}</h5>
                </div>
                <div class="card-body">

                    <div class="mb-3">
                        <label for="feature_6_svg_code" class="form-label">
                            {{ localize('Icon SVG Code') }}
                        </label>
                        <input type="text"
                               id="feature_6_svg_code"
                               name="types[feature_6_svg_code]"
                               class="form-control"
                               placeholder="{{ localize("Your SVG Code enter here") }}"
                               value="{{ systemSettingsLocalization('feature_6_svg_code', $lang_key,null) }}">
                    </div>
                    
                    
                    <div class="mb-3">
                        <label for="feature_6_title" class="form-label">{{ localize('Title') }}</label>
                        <input type="text" id="feature_6_title" name="types[feature_6_title]" class="form-control"
                            value="{{ systemSettingsLocalization('feature_6_title', $lang_key) }}">
                    </div>                   
                    <div class="mb-3">
                        <label for="feature_6_short_description" class="form-label">{{ localize('Short Description') }}</label>
                        <input type="text" id="feature_6_short_description" name="types[feature_6_short_description]" class="form-control"
                            value="{{ systemSettingsLocalization('feature_6_short_description', $lang_key) }}">
                    </div>
                    
                  
                    <div class="col-md-12">
                        <x-form.label for="is_active"
                            label="{{ localize('Is Active?') }}" />
                        <x-form.select name="settings[feature_6_is_active]" id="is_active">
                            <option value="1" {{ getSetting('feature_6_is_active') == '1' ? 'selected' : '' }}> {{ localize('Enable') }}</option>
                            <option value="0" {{ getSetting('feature_6_is_active') == '0' ? 'selected' : '' }}>{{ localize('Disable') }}</option>                           
                        </x-form.select>
                    </div>
                </div>
                <div class="card-footer bg-transparent mt-3">
                    <x-form.button type="submit" class="settingsSubmitButton btn-sm"><i data-feather="save"></i>{{ localize('Save Configuration') }}</x-form.button>
                </div>
            </div>
        </form>

    </div>


</div>
