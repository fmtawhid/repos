<form action="{{ route('admin.payment-gateways.store') }}" class="paymentForm" id="yookassaPaymentForm" method="POST">
    @method('POST')
    @csrf
    <div class="offcanvas offcanvas-end" id="offcanvasYookassa" tabindex="-1">
        <div class="offcanvas-header border-bottom py-3">
            <h5 class="offcanvas-title">{{ localize('Yookassa Configuration') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <x-common.splitter />
        <div class="offcanvas-body" data-simplebar>

            <input type="hidden" name="payment_method" value="yookassa">
            <div class="mb-3">
                <label for="YOOKASSA_SHOP_ID" class="form-label">{{ localize('Yookassa Shop ID') }}</label>
                <input type="text" id="YOOKASSA_SHOP_ID" name="types[YOOKASSA_SHOP_ID]" class="form-control"
                    value="{{ paymentGatewayValue('yookassa', 'YOOKASSA_SHOP_ID') }}">
            </div>
            <div class="mb-3">
                <label for="YOOKASSA_SECRET_KEY" class="form-label">{{ localize('Yookassa Secret Key') }}</label>
                <input type="text" id="YOOKASSA_SECRET_KEY" name="types[YOOKASSA_SECRET_KEY]" class="form-control"
                    value="{{ paymentGatewayValue('yookassa', 'YOOKASSA_SECRET_KEY') }}">
            </div>

            <div class="mb-3">
                <label for="YOOKASSA_CURRENCY_CODE" class="form-label">{{ localize('YOOKASSA Currency Code') }}</label>
                <input type="text" id="YOOKASSA_CURRENCY_CODE" name="types[YOOKASSA_CURRENCY_CODE]"
                    class="form-control" value="{{ paymentGatewayValue('yookassa', 'YOOKASSA_CURRENCY_CODE') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ localize('Enable Yookassa') }}</label>
                <select id="enable_yookassa" class="form-control select2" name="is_active" data-toggle="select2">
                    <option value="0" {{ paymentGateway('yookassa')->is_active == '0' ? 'selected' : '' }}>
                        {{ localize('Disable') }}
                    </option>
                    <option value="1" {{ paymentGateway('yookassa')->is_active == '1' ? 'selected' : '' }}>
                        {{ localize('Enable') }}
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <div class="form-check form-switch">
                    <label for="is_active" class="form-label ms-2">{{ localize('Reciept ?') }} <span
                            class="text-danger ms-1"> </span></label>
                    <input type="checkbox" class="form-check-input" id="yookassa_reciept_active"
                        name="types[YOOKASSA_RECIEPT]" @if (paymentGatewayValue('yookassa', 'YOOKASSA_RECIEPT') == 'on') checked @endif>
                </div>
            </div>
            <div class="reciept {{ paymentGatewayValue('yookassa', 'YOOKASSA_RECIEPT') == 'on' ? '' : 'd-none' }}"
                id="reciept_yookassa">
                @php
                    $vatLists = [
                        '1' => 'VAT not included',
                        '2' => '0% VAT rate',
                        '3' => '10% VAT rate',
                        '4' => '20% receipt’s VAT rate',
                        '5' => '10/110 receipt’s estimate VAT rate',
                        '6' => '20/120 receipt’s estimate VAT rate',
                    ];
                @endphp
                <div class="mb-3">
                    <label class="form-label">{{ localize('VAT rates Yookassa') }}</label>

                    <select id="yookassa_vat" class="form-control select2" name="types[YOOKASSA_VAT]"
                        data-toggle="select2">
                        @foreach ($vatLists as $key => $vat)
                            <option value="{{ $key }}"
                                {{ paymentGatewayValue('yookassa', 'YOOKASSA_VAT') == $key ? 'selected' : (2 == $key ? 'selected' : '') }}>
                                {{ localize($vat) }}
                            </option>
                        @endforeach
                    </select>
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

