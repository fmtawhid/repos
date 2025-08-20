<form action="{{ route('admin.payment-gateways.store') }}" class="paymentForm" id="molilePaymentForm" method="POST">
    @method('POST')
    @csrf
    <div class="offcanvas offcanvas-end" id="offcanvasMolile" tabindex="-1">
        <div class="offcanvas-header border-bottom py-3">
            <h5 class="offcanvas-title">{{ localize('Molile Configuration') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <x-common.splitter />
        <div class="offcanvas-body" data-simplebar>

            <input type="hidden" name="payment_method" value="molile">

            <div class="mb-3">
                <label for="MOLILE_API_KEY" class="form-label">{{ localize('Molile API Key') }}</label>
                <input type="text" id="MOLILE_API_KEY" name="types[MOLILE_API_KEY]" class="form-control"
                    value="{{ paymentGatewayValue('molile', 'MOLILE_API_KEY') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ localize('Enable Molile') }}</label>
                <select id="enable_molile" class="form-control select2" name="is_active" data-toggle="select2">
                    <option value="0" {{ paymentGateway('molile')?->is_active == '0' ? 'selected' : '' }}>
                        {{ localize('Disable') }}</option>
                    <option value="1" {{ paymentGateway('molile')?->is_active == '1' ? 'selected' : '' }}>
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
