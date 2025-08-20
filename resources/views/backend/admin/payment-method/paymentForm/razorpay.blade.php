<form action="{{ route('admin.payment-gateways.store') }}" class="paymentForm" id="razorpayPaymentForm" method="POST">
    @method('POST')
    @csrf
    <div class="offcanvas offcanvas-end" id="offcanvasRazorpay" tabindex="-1">
        <div class="offcanvas-header border-bottom py-3">
            <h5 class="offcanvas-title">{{ localize('Razorpay Configuration') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <x-common.splitter />
        <div class="offcanvas-body" data-simplebar>

            <input type="hidden" name="payment_method" value="razorpay">
            <div class="mb-3">
                <label for="RAZORPAY_KEY" class="form-label">{{ localize('Razorpay Key') }}</label>
                <input type="text" id="RAZORPAY_KEY" name="types[RAZORPAY_KEY]" class="form-control"
                    value="{{ paymentGatewayValue('razorpay', 'RAZORPAY_KEY') }}">
            </div>
            <div class="mb-3">
                <label for="RAZORPAY_SECRET" class="form-label">{{ localize('Razorpay Secret') }}</label>
                <input type="text" id="RAZORPAY_SECRET" name="types[RAZORPAY_SECRET]" class="form-control"
                    value="{{ paymentGatewayValue('razorpay', 'RAZORPAY_SECRET') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ localize('Enable Razorpay') }}</label>
                <select id="enable_razorpay" class="form-control select2" name="is_active" data-toggle="select2">
                    <option value="0" {{ paymentGateway('razorpay')?->is_active == '0' ? 'selected' : '' }}>
                        {{ localize('Disable') }}</option>
                    <option value="1" {{ paymentGateway('razorpay')?->is_active == '1' ? 'selected' : '' }}>
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
