<form action="{{ route('admin.payment-gateways.store') }}" class="paymentForm" id="midtransPaymentForm" method="POST">
    @method('POST')
    @csrf
    <div class="offcanvas offcanvas-end" id="offcanvasMidtrans" tabindex="-1">
        <div class="offcanvas-header border-bottom py-3">
            <h5 class="offcanvas-title">{{ localize('Midtrans Configuration') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <x-common.splitter />
        <div class="offcanvas-body" data-simplebar>

            <input type="hidden" name="payment_method" value="midtrans">

            <div class="mb-3">
                <label for="MIDTRANS_SERVER_KEY" class="form-label">{{ localize('Midtrans Server Key') }}</label>
                <input type="text" id="MIDTRANS_SERVER_KEY" name="types[MIDTRANS_SERVER_KEY]" class="form-control"
                    value="{{ paymentGatewayValue('midtrans', 'MIDTRANS_SERVER_KEY') }}">
            </div>

            <div class="mb-3">
                <label for="MIDTRANS_CLIENT_KEY" class="form-label">{{ localize('Midtrans Client Key') }}</label>
                <input type="text" id="MIDTRANS_CLIENT_KEY" name="types[MIDTRANS_CLIENT_KEY]" class="form-control"
                    value="{{ paymentGatewayValue('midtrans', 'MIDTRANS_CLIENT_KEY') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ localize('Finish URL') }}</label>
                <input type="text" class="form-control" value="{{ route('midtrans.success') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ localize('Payment Notification URL') }}</label>
                <input type="text" class="form-control" value="{{ route('midtrans.payment-notification') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ localize('Payment Failed URL') }}</label>
                <input type="text" class="form-control" value="{{ route('midtrans.failed') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ localize('Enable Midtrans') }}</label>
                <select id="enable_midtrans" class="form-control select2" name="is_active" data-toggle="select2">
                    <option value="0" {{ paymentGateway('midtrans')?->is_active == '0' ? 'selected' : '' }}>
                        {{ localize('Disable') }}</option>
                    <option value="1" {{ paymentGateway('midtrans')?->is_active == '1' ? 'selected' : '' }}>
                        {{ localize('Enable') }}</option>
                </select>
            </div>



            <div class="mb-3">
                <label class="form-label">{{ localize('Enable Test Sandbox Mode') }}</label>
                <select id="midtrans_sandbox" class="form-control select2" name="sandbox" data-toggle="select2">
                    <option value="0" {{ paymentGateway('midtrans')?->sandbox == '0' ? 'selected' : '' }}>
                        {{ localize('Disable') }}</option>
                    <option value="1" {{ paymentGateway('midtrans')?->sandbox == '1' ? 'selected' : '' }}>
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
