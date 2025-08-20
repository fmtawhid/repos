<form action="{{ route('admin.payment-gateways.store') }}" class="paymentForm" id="flutterwavePaymentForm" method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="offcanvas offcanvas-end" id="offcanvasFlutterwave" tabindex="-1">
        <div class="offcanvas-header border-bottom py-3">
            <h5 class="offcanvas-title">{{ localize('Flutterwave Configuration') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <x-common.splitter />
        <div class="offcanvas-body">

            <input type="hidden" name="payment_method" value="flutterwave">

            <div class="mb-3">
                <label for="FLW_PUBLIC_KEY" class="form-label">{{ localize('Flutterwave Public Key') }}</label>

                <input type="text" id="FLW_PUBLIC_KEY" name="types[FLW_PUBLIC_KEY]" class="form-control"
                    value="{{ paymentGatewayValue('flutterwave', 'FLW_PUBLIC_KEY') }}">
            </div>

            <div class="mb-3">
                <label for="FLW_SECRET_KEY" class="form-label">{{ localize('Flutterwave Secret Key') }}</label>

                <input type="text" id="FLW_SECRET_KEY" name="types[FLW_SECRET_KEY]" class="form-control"
                    value="{{ paymentGatewayValue('flutterwave', 'FLW_SECRET_KEY') }}">
            </div>

            <div class="mb-3">
                <label for="FLW_SECRET_HASH" class="form-label">{{ localize('Flutterwave Secret Hash') }}</label>

                <input type="text" id="FLW_SECRET_HASH" name="types[FLW_SECRET_HASH]" class="form-control"
                    value="{{ paymentGatewayValue('flutterwave', 'FLW_SECRET_HASH') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ localize('Enable Flutterwave') }}</label>
                <select id="enable_flutterwave" class="form-control select2" name="is_active" data-toggle="select2">
                    <option value="0" {{ paymentGateway('flutterwave')?->is_active == '0' ? 'selected' : '' }}>
                        {{ localize('Disable') }}</option>
                    <option value="1" {{ paymentGateway('flutterwave')?->is_active == '1' ? 'selected' : '' }}>
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
