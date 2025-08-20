<div class="row mb-4 g-4">
    <!--left sidebar-->
    <div class="col-xl-12 order-2 order-md-2 order-lg-2 order-xl-1">
        <form action="{{ route('admin.appearance.update') }}" id="featureTool5" method="POST"  class="appearanceForm">
            @csrf
            <input type="hidden" name="language_key" id="language_id" value="{{ $lang_key }}">
            <!--Navbar-->
            <div class="card mb-4" id="section-1">
                <div class="card-header">
                    <h5 class="mb-0">{{ localize('Feature Tool 5') }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="feature_tool_5_title" class="form-label">{{ localize('Title') }}</label>
                        <input type="text" id="feature_tool_5_title" name="types[feature_tool_5_title]" class="form-control"
                            value="{{ systemSettingsLocalization('feature_tool_5_title', $lang_key) }}">
                    </div>                   
                    <div class="mb-3">
                        <label for="feature_tool_5_short_description" class="form-label">{{ localize('Short Description') }}</label>
                        <input type="text" id="feature_tool_5_short_description" name="types[feature_tool_5_short_description]" class="form-control"
                            value="{{ systemSettingsLocalization('feature_tool_5_short_description', $lang_key) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ localize('Image') }}</label>
                        <div class="tt-image-drop rounded">
                            <span class="fw-semibold">{{ localize('Choose') }}</span>
                            <!-- choose media -->
                            <div class="tt-product-thumb show-selected-files mt-3">
                                <div class="avatar avatar-xl cursor-pointer choose-media" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasBottom" onclick="showMediaManager(this)"
                                    data-selection="single">
                                    <input type="hidden" name="types[feature_tool_5_image]"
                                        value="{{ getSetting('feature_tool_5_image') }}">
                                    <div class="no-avatar rounded-circle">
                                        <span><i data-feather="plus"></i></span>
                                    </div>
                                </div>
                            </div>
                            <!-- choose media -->
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <x-form.label for="is_active"
                            label="{{ localize('Is Active?') }}" />
                        <select class="form-control" name="settings[feature_tool_5_is_active]" id="is_active">
                            <option value="1" {{ getSetting('feature_tool_5_is_active') == '1' ? 'selected' : '' }}> {{ localize('Enable') }}</option>
                            <option value="0" {{ getSetting('feature_tool_5_is_active') == '0' ? 'selected' : '' }}>{{ localize('Disable') }}</option>                           
                        </select>
                    </div>
                </div>
                <div class="card-footer bg-transparent mt-3">
                    <x-form.button type="submit" class="settingsSubmitButton btn-sm"><i data-feather="save"></i>{{ localize('Save Configuration') }}</x-form.button>
                </div>
            </div>
        </form>

    </div>


</div>
