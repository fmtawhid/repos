<div class="row mb-4 g-4">
    <!--left sidebar-->
    <div class="col-xl-12 order-2 order-md-2 order-lg-2 order-xl-1">
        <form action="{{ route('admin.appearance.update') }}" id="brandInformation" method="POST"  class="appearanceForm">
            @csrf
            <input type="hidden" name="language_key" id="language_id" value="{{ $lang_key }}">
            <!--Navbar-->
            <div class="card mb-4" id="section-1">
                <div class="card-header">
                    <h5 class="mb-0">{{ localize('Brand Image') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <x-form.label for="brandText"
                                          label="{{ localize('Brand Text without Color') }}">
                                <small>{{ localize("Ex. making the cloud effortless for") }}</small>
                            </x-form.label>

                            <x-form.input type="text"
                                   id="brandText"
                                   name="types[brand_text_without_color]"
                                   class="form-control"
                                   value="{{ systemSettingsLocalization('brand_text_without_color', $lang_key) }}"
                            />
                        </div>

                        <div class="col-md-6 mb-3">
                            <x-form.label for="brandText"
                                          label="{{ localize('Brand Text with Color') }}">
                                <small>{{ localize("Ex. thousands of Companies") }}</small>
                            </x-form.label>

                            <x-form.input type="text"
                                   id="brandText"
                                   name="types[brand_text_with_color]"
                                   class="form-control"
                                   value="{{ systemSettingsLocalization('brand_text_with_color', $lang_key) }}"
                            />
                        </div>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">{{ localize('Image') }}</label>
                        <div class="tt-image-drop rounded">
                            <span class="fw-semibold">{{ localize('Choose') }}</span>
                            <!-- choose media -->
                            <div class="tt-product-thumb show-selected-files mt-3">
                                <div class="avatar avatar-xl cursor-pointer choose-media" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasBottom" onclick="showMediaManager(this)"
                                    data-selection="multi">
                                    <input type="hidden"
                                           name="types[brand_background_images]"
                                           value="{{ getSetting('brand_background_images') }}"
                                    />
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
                        <select name="settings[brand_is_active]" id="is_active" class="form-control">
                            <option value="1" {{ getSetting('brand_is_active') == '1' ? 'selected' : '' }}> {{ localize('Enable') }}</option>
                            <option value="0" {{ getSetting('brand_is_active') == '0' ? 'selected' : '' }}> {{ localize('Disable') }}</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer bg-transparent mt-3">
                    <x-form.button type="submit" class="settingsSubmitButton btn-sm">
                        <i data-feather="save"></i>
                        {{ localize('Save Configuration') }}
                    </x-form.button>
                </div>
            </div>
        </form>

    </div>


</div>
