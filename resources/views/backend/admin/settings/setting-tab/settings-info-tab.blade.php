<div class="card">
    <form action="{{ route('admin.settings.store') }}" method="POST" class="settings-info-form settingsForm" enctype="multipart/form-data" id="settings-info-form">
        <div class="card-header">
            <h5 class="mb-0">{{ localize('System Info Setup') }}</h5>
        </div>
    <div class="card-body">
        <div class="tab-content">
            
                @csrf
                
                <div class="row g-3">
                   
                    <div class="col-md-6">

                        <x-form.label for="system_title" label="{{ localize('System Title') }}"
                            isRequired=true />
                        <x-form.input name="settings[system_title]" id="system_title"
                            type="text" placeholder="{{ localize('System Title') }}"
                            value="{{getSetting('system_title')}}" showDiv=false />
                    </div>

                    <div class="col-md-6">
                        <x-form.label for="tab_separator"
                            label="{{ localize('Browser Tab Title Separator') }}"
                            isRequired=true />
                        <x-form.input name="settings[tab_separator]" id="tab_separator"
                            type="text" placeholder=":" value="{{getSetting('tab_separator')}}" showDiv=false />
                    </div>
                    <div class="col-md-6">
                        <x-form.label for="contact_email"
                            label="{{ localize('Contact Email') }}" isRequired=true />
                        <x-form.input name="settings[contact_email]" id="contact_email"
                            type="email" placeholder="{{ localize('Contact Email') }}"
                            value="{{getSetting('contact_email')}}" showDiv=false />
                    </div>
                    <div class="col-md-6">
                        <x-form.label for="contact_phone"
                            label="{{ localize('Contact Phone') }}" isRequired=true />
                        <x-form.input name="settings[contact_phone]" id="contact_phone"
                            type="text" placeholder="{{ localize('Contact Phone') }}"
                            value="{{getSetting('contact_phone')}}" showDiv=false />
                    </div>
                    <div class="col-md-12">
                        <x-form.label for="contact_address"
                            label="{{ localize('Contact Address') }}" isRequired=true />
                        <x-form.textarea name="settings[contact_address]" id="contact_address"
                            type="text" placeholder=""
                            value="{{getSetting('contact_address')}}" showDiv=false />
                    </div>
                    <div class="col-md-6">                        
                        <div class="mb-3">
                            <div class="mb-4">
                                <x-form.label for="logo_for_light" label="{{localize('Dashboard logo for light version')}}"  />
                                <div class="tt-image-drop rounded bg-secondary-subtle">
                                    <span class="fw-semibold">{{ localize('Choose logo') }}</span>
                                    <!-- choose media -->
                                    <div class="tt-product-thumb show-selected-files mt-3">
                                        <div class="avatar avatar-xl cursor-pointer choose-media "
                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                            onclick="showMediaManager(this)" data-selection="single">
                                            <input type="hidden" name="settings[logo_for_light]" value="{{getSetting('logo_for_light')}}" id="logo_for_light">
                                            <div class="no-avatar rounded-circle">
                                                <span><i data-feather="plus"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- choose media -->
                                </div>
            
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">                        
                        <div class="mb-3">
                            <div class="mb-4">
                                <x-form.label for="logo_for_dark" label="{{localize('Dashboard logo for dark version')}}"  />
                                <div class="tt-image-drop rounded bg-secondary-subtle">
                                    <span class="fw-semibold">{{ localize('Choose logo') }}</span>
                                    <!-- choose media -->
                                    <div class="tt-product-thumb show-selected-files mt-3">
                                        <div class="avatar avatar-xl cursor-pointer choose-media"
                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                            onclick="showMediaManager(this)" data-selection="single">
                                            <input type="hidden" name="settings[logo_for_dark]" value="{{getSetting('logo_for_dark')}}" id="logo_for_dark">
                                            <div class="no-avatar rounded-circle">
                                                <span><i data-feather="plus"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- choose media -->
                                </div>
            
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">                        
                        <div class="mb-3">
                            <div class="mb-4">
                                <x-form.label for="collapse_able_icon" label="{{localize('Dashboard Collapseable Icon')}}"  />
                                <div class="tt-image-drop rounded bg-secondary-subtle">
                                    <span class="fw-semibold">{{ localize('Choose Icon') }}</span>
                                    <!-- choose media -->
                                    <div class="tt-product-thumb show-selected-files mt-3">
                                        <div class="avatar avatar-xl cursor-pointer choose-media"
                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                            onclick="showMediaManager(this)" data-selection="single">
                                            <input type="hidden" name="settings[collapse_able_icon]" value="{{getSetting('collapse_able_icon')}}" id="collapse_able_icon">
                                            <div class="no-avatar rounded-circle">
                                                <span><i data-feather="plus"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- choose media -->
                                </div>
            
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">                        
                        <div class="mb-3">
                            <div class="mb-4">
                                <x-form.label for="favicon" label="{{localize('Favicon')}}"  />
                                <div class="tt-image-drop rounded bg-secondary-subtle">
                                    <span class="fw-semibold">{{ localize('Choose Icon') }}</span>
                                    <!-- choose media -->
                                    <div class="tt-product-thumb show-selected-files mt-3">
                                        <div class="avatar avatar-xl cursor-pointer choose-media"
                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                            onclick="showMediaManager(this)" data-selection="single">
                                            <input type="hidden" name="settings[favicon]" value="{{getSetting('favicon')}}" id="favicon">
                                            <div class="no-avatar rounded-circle">
                                                <span><i data-feather="plus"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- choose media -->
                                </div>
            
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">                        
                        <div class="mb-3">
                            <div class="mb-4">
                                <x-form.label for="preloader" label="{{localize('Preloader')}}"  />
                                <div class="tt-image-drop rounded bg-secondary-subtle">
                                    <span class="fw-semibold">{{ localize('Choose logo') }}</span>
                                    <!-- choose media -->
                                    <div class="tt-product-thumb show-selected-files mt-3">
                                        <div class="avatar avatar-xl cursor-pointer choose-media"
                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                            onclick="showMediaManager(this)" data-selection="single">
                                            <input type="hidden" name="settings[preloader]" value="{{getSetting('preloader')}}" id="preloader">
                                            <div class="no-avatar rounded-circle">
                                                <span><i data-feather="plus"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- choose media -->
                                </div>
            
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="card-footer bg-transparent mt-3">
        <x-form.button type="submit" class="settingsSubmitButton btn-sm"><i data-feather="save"></i>{{ localize('Save Configuration') }}</x-form.button>
    </div>
</form>
</div>