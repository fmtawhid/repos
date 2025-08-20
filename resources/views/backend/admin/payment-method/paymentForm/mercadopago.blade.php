<form action="{{ route('admin.payment-gateways.store') }}" class="paymentForm" id="mercadopagoPaymentForm" method="POST">
    @method('POST')
    @csrf
    <div class="offcanvas offcanvas-end" id="offcanvasMercadopago" tabindex="-1">
        <div class="offcanvas-header border-bottom py-3">
            <h5 class="offcanvas-title">{{ localize('Mercadopago Configuration') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <x-common.splitter />
        <div class="offcanvas-body" data-simplebar>


            <input type="hidden" name="payment_method" value="mercadopago">

            <div class="mb-3">
                <label for="MERCADOPAGO_SECRET_KEY" class="form-label">{{ localize('Mercadopago Secret Key') }}</label>
                <input type="text" id="MERCADOPAGO_SECRET_KEY" name="types[MERCADOPAGO_SECRET_KEY]"
                    class="form-control" value="{{ paymentGatewayValue('mercadopago', 'MERCADOPAGO_SECRET_KEY') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ localize('Enable Mercadopago') }}</label>
                <select id="is_active" class="form-control select2" name="is_active" data-toggle="select2">
                    <option value="0" {{ paymentGateway('mercadopago')?->is_active == '0' ? 'selected' : '' }}>
                        {{ localize('Disable') }}</option>
                    <option value="1" {{ paymentGateway('mercadopago')?->is_active == '1' ? 'selected' : '' }}>
                        {{ localize('Enable') }}</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ localize('Gateway') }}</label>
                <select id="payment_type" class="form-control select2" name="payment_type" data-toggle="select2">
                    <option value="sandbox" {{ paymentGateway('mercadopago')?->type == 'sandbox' ? 'selected' : '' }}>
                        {{ localize('Sandbox') }}</option>
                    <option value="live" {{ paymentGateway('mercadopago')?->type == 'live' ? 'selected' : '' }}>
                        {{ localize('Live') }}</option>
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
