<div class="card">
    <form action="{{ route('admin.settings.store') }}" method="POST" class="invoice-settings-form settingsForm"
    enctype="multipart/form-data" id="invoice-settings-form">
    <div class="card-header">
        <h5 class="mb-0">{{ localize('Invoice Settings') }}</h5>
    </div>
    <div class="card-body">
        <div class="tab-content">

                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="mb-4">
                                <x-form.label for="invoice_logo" label="{{localize('Invoice Logo')}}"  />
                                <div class="tt-image-drop rounded bg-secondary-subtle">
                                    <span class="fw-semibold">{{ localize('Choose logo') }}</span>
                                    <!-- choose media -->
                                    <div class="tt-product-thumb show-selected-files mt-3">
                                        <div class="avatar avatar-xl cursor-pointer choose-media "
                                             data-bs-toggle="offcanvas"
                                             data-bs-target="#offcanvasBottom"
                                             onclick="showMediaManager(this)"
                                             data-selection="single">
                                            <input type="hidden" name="settings[invoice_logo]" value="{{getSetting('invoice_logo')}}" id="logo_for_light">
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
                        <x-form.label for="order_code_prefix" label="{{ localize('Code Prefix') }}" isRequired=true />
                        <x-form.input name="settings[order_code_prefix]" id="order_code_prefix"
                                      type="text"
                                      placeholder=""
                                      value="{{ getSetting('order_code_prefix') }}"
                                      showDiv=false
                        />
                    </div>

                    {{-- Invoice Font Size --}}
                    <div class="col-md-6">
                        <x-form.label for="invoice_font_size" label="{{ localize('Font Size as px') }}" isRequired=true />
                        <x-form.input name="settings[invoice_font_size]" id="invoice_font_size"
                                      type="text"
                                      placeholder=""
                                      value="{{ getSetting('invoice_font_size') }}"
                                      showDiv=false
                        />
                    </div>

                    {{-- Invoice Width in mm --}}
                    <div class="col-md-6">
                        <x-form.label for="invoice_paper_width" label="{{ localize('Invoice Width in mm Size') }}" isRequired=true />
                        <x-form.input name="settings[invoice_paper_width]" id="invoice_paper_width"
                                      type="text"
                                      placeholder=""
                                      value="{{ getSetting('invoice_paper_width') }}"
                                      showDiv=false
                        />
                    </div>

                    <div class="col-md-12">
                        <x-form.label for="order_code_start" label="{{ localize('Code Prefix Start') }}" isRequired=true />
                        <x-form.input name="settings[order_code_start]" id="order_code_start"
                                      type="text"
                                      value="{{ getSetting('order_code_start') }}"
                                      showDiv=false
                        />
                    </div>
                    <div class="col-md-12">
                        <x-form.label for="invoice_thanksgiving" label="{{ localize('Thanks Message') }}" isRequired=true />
                        <x-form.textarea name="settings[invoice_thanksgiving]" id="invoice_thanksgiving"
                                      type="text"
                                      value="{{ getSetting('invoice_thanksgiving') }}"
                                      showDiv=false
                        />
                    </div>
                </div>

        </div>
    </div>
    <div class="card-footer bg-transparent mt-3">
        <x-form.button type="submit" class="settingsSubmitButton btn-sm"><i data-feather="save"></i>{{ localize('Save Configuration') }}</x-form.button>
    </div>
</form>
</div>
