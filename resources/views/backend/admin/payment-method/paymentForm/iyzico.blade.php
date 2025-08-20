<form action="{{ route('admin.payment-gateways.store') }}" class="paymentForm" id="iyzicoPaymentForm" method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="offcanvas offcanvas-end" id="offcanvasIyzico" tabindex="-1">
        <div class="offcanvas-header border-bottom py-3">
            <h5 class="offcanvas-title">{{ localize('Iyzico Configuration') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <x-common.splitter />
        <div class="offcanvas-body">

            <input type="hidden" name="payment_method" value="iyzico">
            <div class="mb-3">
                <label for="IYZICO_API_KEY" class="form-label">{{ localize('IyZico API Key') }}</label>
                <input type="text" id="IYZICO_API_KEY" name="types[IYZICO_API_KEY]" class="form-control"
                    value="{{ paymentGatewayValue('iyzico', 'IYZICO_API_KEY') }}">
            </div>

            <div class="mb-3">
                <label for="IYZICO_SECRET_KEY" class="form-label">{{ localize('IyZico Secret Key') }}</label>
                <input type="text" id="IYZICO_SECRET_KEY" name="types[IYZICO_SECRET_KEY]" class="form-control"
                    value="{{ paymentGatewayValue('iyzico', 'IYZICO_SECRET_KEY') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ localize('Enable IyZico') }}</label>
                <select id="enable_iyzico" class="form-control select2" name="is_active" data-toggle="select2">
                    <option value="0" {{ paymentGateway('iyzico')?->is_active == '0' ? 'selected' : '' }}>
                        {{ localize('Disable') }}</option>
                    <option value="1" {{ paymentGateway('iyzico')?->is_active == '1' ? 'selected' : '' }}>
                        {{ localize('Enable') }}</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ localize('Enable Test Sandbox Mode') }}</label>
                <select id="iyzico_sandbox" class="form-control select2" name="sandbox" data-toggle="select2">
                    <option value="0" {{ paymentGateway('iyzico')?->sandbox == '0' ? 'selected' : '' }}>
                        {{ localize('Disable') }}</option>
                    <option value="1" {{ paymentGateway('iyzico')?->sandbox == '1' ? 'selected' : '' }}>
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
