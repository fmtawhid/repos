<form action="{{ route('admin.payment-gateways.store') }}" class="paymentForm" id="paytmPaymentForm" method="POST">
    @method('POST')
    @csrf
    <div class="offcanvas offcanvas-end" id="offcanvasPaytm" tabindex="-1">
        <div class="offcanvas-header border-bottom py-3">
            <h5 class="offcanvas-title">{{ localize('PayTm Configuration') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <x-common.splitter />
        <div class="offcanvas-body" data-simplebar>

            <input type="hidden" name="payment_method" value="paytm">
            <div class="mb-3">
                <label for="PAYTM_ENVIRONMENT" class="form-label">{{ localize('PayTm Environment') }}</label>
                <input type="text" id="PAYTM_ENVIRONMENT" name="types[PAYTM_ENVIRONMENT]" class="form-control"
                    value="{{ paymentGatewayValue('paytm', 'PAYTM_ENVIRONMENT') }}">
            </div>

            <div class="mb-3">
                <label for="PAYTM_MERCHANT_ID" class="form-label">{{ localize('PayTm Merchant ID') }}</label>
                <input type="text" id="PAYTM_MERCHANT_ID" name="types[PAYTM_MERCHANT_ID]" class="form-control"
                    value="{{ paymentGatewayValue('paytm', 'PAYTM_MERCHANT_ID') }}">
            </div>
            <div class="mb-3">
                <label for="PAYTM_MERCHANT_KEY" class="form-label">{{ localize('PayTm Merchant Key') }}</label>
                <input type="text" id="PAYTM_MERCHANT_KEY" name="types[PAYTM_MERCHANT_KEY]" class="form-control"
                    value="{{ paymentGatewayValue('paytm', 'PAYTM_MERCHANT_KEY') }}">
            </div>

            <div class="mb-3">
                <label for="PAYTM_MERCHANT_WEBSITE" class="form-label">{{ localize('PayTm Merchant Website') }}</label>
                <input type="text" id="PAYTM_MERCHANT_WEBSITE" name="types[PAYTM_MERCHANT_WEBSITE]"
                    class="form-control" value="{{ paymentGatewayValue('paytm', 'PAYTM_MERCHANT_WEBSITE') }}">
            </div>

            <div class="mb-3">
                <label for="PAYTM_CHANNEL" class="form-label">{{ localize('PayTm Channel') }}</label>
                <input type="text" id="PAYTM_CHANNEL" name="types[PAYTM_CHANNEL]" class="form-control"
                    value="{{ paymentGatewayValue('paytm', 'PAYTM_CHANNEL') }}">
            </div>

            <div class="mb-3">
                <label for="PAYTM_INDUSTRY_TYPE" class="form-label">{{ localize('PayTm Industry Type') }}</label>
                <input type="text" id="PAYTM_INDUSTRY_TYPE" name="types[PAYTM_INDUSTRY_TYPE]" class="form-control"
                    value="{{ paymentGatewayValue('paytm', 'PAYTM_INDUSTRY_TYPE') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ localize('Enable PayTm') }}</label>
                <select id="enable_paytm" class="form-control select2" name="is_active" data-toggle="select2">
                    <option value="0" {{ paymentGateway('paytm')?->is_active == '0' ? 'selected' : '' }}>
                        {{ localize('Disable') }}</option>
                    <option value="1" {{ paymentGateway('paytm')?->is_active == '1' ? 'selected' : '' }}>
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
