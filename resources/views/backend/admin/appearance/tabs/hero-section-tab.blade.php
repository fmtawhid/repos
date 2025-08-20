<div class="row mb-4 g-4">
    <!--left sidebar-->
    <div class="col-xl-12 order-2 order-md-2 order-lg-2 order-xl-1">
        <form action="{{ route('admin.appearance.update') }}" id="heroInformation" method="POST"  class="appearanceForm">
            @csrf
            <input type="hidden" name="language_key" id="language_id" value="{{ $lang_key }}">
            <!--Navbar-->
            <div class="card mb-4" id="section-1">
                <div class="card-header">
                    <h5 class="mb-0">{{ localize('Hero Information') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3">
                            <label for="hero_title" class="form-label">{{ localize('Title') }}</label>
                            <input type="text" id="hero_title" name="types[hero_title]" class="form-control"
                                   value="{{ systemSettingsLocalization('hero_title', $lang_key) }}">
                        </div>
                        <div class="mb-3">
                            <label for="hero_sub_title" class="form-label">{{ localize('Sub Title') }}</label>
                            <input type="text" id="hero_sub_title" name="types[hero_sub_title]" class="form-control"
                                   value="{{ systemSettingsLocalization('hero_sub_title', $lang_key) }}">
                        </div>


                        {{-- Start Writing--}}
                        <div class="mb-3 col-lg-6">
                            <label for="hero_sub_title_btn_text"
                                   class="form-label">{{ localize('Sub Title Button Text') }}</label>
                            <input type="text" id="hero_sub_title_btn_text" name="types[hero_sub_title_btn_text]"
                                   class="form-control"
                                   value="{{ systemSettingsLocalization('hero_sub_title_btn_text', $lang_key) ?? "Start Writing - It\'s Free" }}">
                        </div>

                        <div class="mb-3 col-lg-6">
                            <label for="hero_sub_title_btn_link"
                                   class="form-label">{{ localize('Sub Title Button Link') }}</label>
                            <input type="text" id="hero_sub_title_btn_link" name="types[hero_sub_title_btn_link]"
                                   class="form-control" value="{{ getSetting('hero_sub_title_btn_link') ?? route('login') }}">
                        </div>

                        {{-- Build AI --}}
                        <div class="mb-3 col-lg-6">
                            <label for="hero_build_ai_btn_text"
                                   class="form-label">{{ localize('Build AI') }}</label>
                            <input type="text"
                                   id="hero_build_ai_btn_text"
                                   name="types[hero_build_ai_btn_text]"
                                   class="form-control"
                                   value="{{ systemSettingsLocalization('hero_build_ai_btn_text', $lang_key) ?? "Build AI" }}"
                            />
                        </div>

                        <div class="mb-3 col-lg-6">
                            <label for="hero_sub_title_btn_link"
                                   class="form-label">{{ localize('Build AI Button Link') }}</label>
                            <input type="text"
                                   id="hero_build_ai_btn_link"
                                   name="types[hero_build_ai_btn_link]"
                                   class="form-control"
                                   value="{{ getSetting('hero_build_ai_btn_link') ?? url('/') }}"
                            />
                        </div>




                        <div class="mb-3">
                            <label for="useuse_customer"
                                   class="form-label">{{ localize('Useuse Customer') }}</label>
                            <input type="text" id="useuse_customer" name="types[useuse_customer]"
                                   class="form-control" value="{{ systemSettingsLocalization('useuse_customer', $lang_key) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="hero_background_image">{{ localize('Image') }}</label>
                            <div class="tt-image-drop rounded">
                                <span class="fw-semibold">{{ localize('Choose') }}</span>
                                <!-- choose media -->
                                <div class="tt-product-thumb show-selected-files mt-3">
                                    <div class="avatar avatar-xl cursor-pointer choose-media" data-bs-toggle="offcanvas"
                                         data-bs-target="#offcanvasBottom" onclick="showMediaManager(this)"
                                         data-selection="single">
                                        <input type="hidden" name="types[hero_background_image]" id="hero_background_image"
                                               value="{{ getSetting('hero_background_image') }}">
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
                            <x-form.select name="settings[hero_is_active]" id="is_active">
                                <option value="1" {{ getSetting('hero_is_active') == '1' ? 'selected' : '' }}> {{ localize('Enable') }}</option>
                                <option value="0" {{ getSetting('hero_is_active') == '0' ? 'selected' : '' }}>{{ localize('Disable') }}</option>
                            </x-form.select>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent mt-3">
                    <x-form.button type="submit" class="settingsSubmitButton btn-sm"><i data-feather="save"></i>{{ localize('Save Configuration') }}</x-form.button>
                </div>
            </div>
        </form>

    </div>


</div>
