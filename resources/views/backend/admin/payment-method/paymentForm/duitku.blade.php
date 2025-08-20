<form action="{{ route('admin.payment-gateways.store') }}" class="paymentForm" id="duitkuPaymentForm" method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="offcanvas offcanvas-end" id="offcanvasDuitku" tabindex="-1">
        <div class="offcanvas-header border-bottom py-3">
            <h5 class="offcanvas-title">{{ localize('Add Duitku Configuration') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <x-common.splitter />
        <div class="offcanvas-body">

            <input type="hidden" name="payment_method" value="duitku">

            <div class="mb-3">
                <label for="DUITKU_API_KEY" class="form-label">{{ localize('Duitku Api Key') }}</label>
                <input type="text" id="DUITKU_API_KEY" name="types[DUITKU_API_KEY]" class="form-control"
                    value="{{ paymentGatewayValue('duitku', 'DUITKU_API_KEY') }}">
            </div>

            <div class="mb-3">
                <label for="DUITKU_MERCHANT_CODE" class="form-label">{{ localize('Duitku Merchant Code') }}</label>
                <input type="text" id="DUITKU_MERCHANT_CODE" name="types[DUITKU_MERCHANT_CODE]" class="form-control"
                    value="{{ paymentGatewayValue('duitku', 'DUITKU_MERCHANT_CODE') }}">
            </div>

            <div class="mb-3">
                <label for="DUITKU_CALLBACK_URL" class="form-label">{{ localize('Duitku Callback Url') }}</label>
                <input type="url" id="DUITKU_CALLBACK_URL" name="types[DUITKU_CALLBACK_URL]" class="form-control"
                    value="{{ url('/duitku/payment/callback') }}" readonly>
            </div>

            <div class="mb-3">
                <label for="DUITKU_RETURN_URL" class="form-label">{{ localize('Duitku Return Url') }}</label>
                <input type="url" id="DUITKU_RETURN_URL" name="types[DUITKU_RETURN_URL]" class="form-control"
                    value="{{ url('/duitku/payment/return') }}" readonly>
            </div>

            <div class="mb-3">
                <label for="DUITKU_ENV" class="form-label">{{ localize('Duitku Env') }}</label>
                <input type="text" id="DUITKU_ENV" name="types[DUITKU_ENV]" class="form-control"
                    value="{{ paymentGatewayValue('duitku', 'DUITKU_ENV') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ localize('Enable Duitku') }}</label>
                <select id="enable_duitku" class="form-control select2" name="is_active" data-toggle="select2">
                    <option value="0" {{ paymentGateway('duitku')?->is_active == '0' ? 'selected' : '' }}>
                        {{ localize('Disable') }}</option>
                    <option value="1" {{ paymentGateway('duitku')?->is_active == '1' ? 'selected' : '' }}>
                        {{ localize('Enable') }}</option>
                </select>
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
