<div class="row mb-4 g-4">
    <!--left sidebar-->
    <div class="col-xl-12 order-2 order-md-2 order-lg-2 order-xl-1">
        <form action="{{ route('admin.appearance.update') }}"id="featureDocument2" method="POST"  class="appearanceForm">
            @csrf
            <input type="hidden" name="language_key" id="language_id" value="{{ $lang_key }}">
            <!--Navbar-->
            <div class="card mb-4" id="section-1">
                <div class="card-header">
                    <h5 class="mb-0">{{ localize('Feature Item 1') }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="feature_document_2_title" class="form-label">{{ localize('Title') }}</label>
                        <input type="text" id="feature_document_2_title" name="types[feature_document_2_title]" class="form-control"
                            value="{{ systemSettingsLocalization('feature_document_2_title', $lang_key) }}">
                    </div>                   
                    <div class="mb-3">
                        <label for="feature_document_2_sub_title" class="form-label">{{ localize('Sub Title') }}</label>
                        <input type="text"
                               id="feature_document_2_sub_title"
                               name="types[feature_document_2_sub_title]"
                               class="form-control"
                            value="{{ systemSettingsLocalization('feature_document_2_sub_title', $lang_key) }}">
                    </div>                   
                   
                    <div class="mb-3">
                        <label class="form-label">{{ localize('Images') }}</label>
                        <div class="tt-image-drop rounded">
                            <span class="fw-semibold">{{ localize('Choose') }}</span>
                            <!-- choose media -->
                            <div class="tt-product-thumb show-selected-files mt-3">
                                <div class="avatar avatar-xl cursor-pointer choose-media" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasBottom" onclick="showMediaManager(this)"
                                    data-selection="multi">
                                    <input type="hidden" name="types[feature_document_2_image]"
                                        value="{{ getSetting('feature_document_2_image') }}">
                                    <div class="no-avatar rounded-circle">
                                        <span><i data-feather="plus"></i></span>
                                    </div>
                                </div>
                            </div>
                            <!-- choose media -->
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="feature_document_2_short_title" class="form-label">{{ localize('Short Ttile') }}</label>
                        <input type="text" id="feature_document_2_short_title" name="types[feature_document_2_short_title]" class="form-control"
                            value="{{ systemSettingsLocalization('feature_document_2_short_title', $lang_key) }}">
                    </div>
                    <div class="mb-3">
                        <label for="feature_document_2_short_description" class="form-label">{{ localize('Short Description') }}</label>
                        <input type="text" id="feature_document_2_short_description" name="types[feature_document_2_short_description]" class="form-control"
                            value="{{ systemSettingsLocalization('feature_document_2_short_description', $lang_key) }}">
                    </div>
                    <div class="mb-3">
                        <label for="feature_document_2_btn_text"
                            class="form-label">{{ localize('Button Text') }}</label>
                        <input type="text" id="feature_document_2_btn_text" name="types[feature_document_2_btn_text]"
                            class="form-control"
                            value="{{ systemSettingsLocalization('feature_document_2_btn_text', $lang_key) ?? "Explore More" }}">
                    </div>
                    <div class="mb-3">
                        <label for="feature_document_2_btn_link"
                            class="form-label">{{ localize('Button Link') }}</label>
                        <input type="text" id="feature_document_2_btn_link" name="types[feature_document_2_btn_link]"
                            class="form-control" value="{{ getSetting('feature_document_2_btn_link') ?? route('login') }}">
                    </div>
                    <div class="col-md-12">
                        <x-form.label for="is_active"
                            label="{{ localize('Is Active?') }}" />
                        <x-form.select name="settings[feature_document_2_is_active]" id="is_active">
                            <option value="1"
                            {{ getSetting('feature_document_2_is_active') == '1' ? 'selected' : '' }}>
                            {{ localize('Enable') }}</option>
                            <option value="0"
                                {{ getSetting('feature_document_2_is_active') == '0' ? 'selected' : '' }}>
                                {{ localize('Disable') }}</option>
                          
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
