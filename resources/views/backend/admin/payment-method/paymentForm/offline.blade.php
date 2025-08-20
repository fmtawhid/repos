<form action="{{ route('admin.payment-gateways.store') }}" class="paymentForm" id="PaymentForm" method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="offcanvas offcanvas-end" id="offcanvasOffline" tabindex="-1">
        <div class="offcanvas-header border-bottom py-3">
            <h5 class="offcanvas-title">{{ localize('Offline Configuration') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <x-common.splitter />
        <div class="offcanvas-body" data-simplebar>
            <input type="hidden" name="payment_method" value="offline">
            <div class="mb-3">
                <label class="form-label">{{ localize('Enable Offline') }}</label>
                <select id="is_active" class="form-control select2" name="is_active" data-toggle="select2">
                    <option value="1" {{ paymentGateway('offline')?->is_active == '1' ? 'selected' : '' }}>
                        {{ localize('Enable') }}</option>
                    <option value="0" {{ paymentGateway('offline')?->is_active == '0' ? 'selected' : '' }}>
                        {{ localize('Disable') }}</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ localize('Image') }}</label>
                <div class="tt-image-drop rounded">
                    <span class="fw-semibold">{{ localize('Choose Image') }}</span>
                    <div class="tt-product-thumb show-selected-files mt-3">
                        <div class="avatar avatar-xl cursor-pointer choose-media" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasBottom" onclick="showMediaManager(this)" data-selection="single">
                            <input type="hidden" name="offline_image" value="{{ getSetting('offline_image') }}">
                            <div class="no-avatar rounded-circle">
                                <span><i data-feather="plus"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="offcanvas-footer border-top">
            <div class="d-flex gap-3">
                 <x-form.button id="frmActionBtn" class="paymentFormSubmitButton">{{ localize('Save Configuration') }}</x-form.button>
                <x-form.button color="secondary" data-bs-dismiss="offcanvas">{{ localize('Close') }}</x-form.button>
            </div>
        </div>
    </div>
</form>
