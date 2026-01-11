<div class="mt-auto pos-summary border-top pt-3">
    <div class="mb-3">
        <div class="tt-pos-cal">
            <p class="mb-0">{{ localize("Subtotal") }}</p>
            <strong class="posCartSubTotal">0</strong>
        </div>
        <!-- <div class="tt-pos-cal">
            <p class="mb-0">{{ localize("Shipping Charge") }}</p>
            <input class="form-control form-control-sm"
                   type="number"
                   placeholder="Type discount amount"
                   id="total_shipping_cost"
                   value="0"
                   step="0.001"
                   min="0"
                   name="total_shipping_cost">
        </div> -->
        <div class="tt-pos-cal">
            <label for="discount_value" class="form-label">{{ localize("Discount") }}</label>
            <div class="input-group d-flex align-items-center gap-2">
                <input class="form-control form-control-sm rounded"
                        type="number"
                        placeholder="Type discount amount"
                        id="additional_discount_value"
                        value="0"
                        step="0.001"
                        min="0"
                        name="discount_value"
                />
                <select class="form-select form-select-sm rounded" name="discount_type">
                    <option selected="" value="{{ constantFlags()::TYPE_FLAT }}">{{ localize("Fixed") }}</option>
                    <option value="{{ constantFlags()::TYPE_PERCENTAGE }}">{{ localize("Percent") }} %</option>
                </select>
            </div>
        </div>

        <div class="tt-pos-cal mt-2">
            <div class="row g-3">
                <div class="col-12">

                    <div class="d-flex justify-content-between">
                        <strong>{{ localize("Order Total ") }}</strong>
                        <strong class="fw-semibold posCartGrandTotal">0</strong>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="tt-pos-payment mb-3">
        <div class="tt-single-pos-payment">
            <x-form.input type="radio" class="tt-custom-radio" name="payment_method" id="cashPayment" value="{{ appStatic()::PAYMENT_METHOD_CASH }}" checked="" />
            <label for="cashPayment" class="tt-payment btn btn-sm btn-secondary fw-semibold d-block">{{ localize("Cash") }}</label>
        </div>

        <div class="tt-single-pos-payment">
            <x-form.input type="radio" class="tt-custom-radio" name="payment_method" id="cardPayment" value="{{ appStatic()::PAYMENT_METHOD_CARD }}" />
            <label for="cardPayment"
                   class="tt-payment btn btn-sm btn-secondary fw-semibold d-block cardPay">
                {{ localize("Card") }}
            </label>
        </div>

        <div class="tt-single-pos-payment">
            <x-form.input type="radio" class="tt-custom-radio" name="payment_method" id="cod" value="{{ appStatic()::PAYMENT_METHOD_COD }}" />
            <label for="cod" class="tt-payment btn btn-sm btn-secondary fw-semibold d-block">{{ localize("COD") }}</label>
        </div>
    </div>


    <div class="d-flex justify-content-between">
        <button type="submit"
                class="btn btn-primary btn-block fw-semibold w-100 complete-order-btn">
            <span>{{ localize("Complete Order") }}</span>
        </button>
    </div>

</div>
<style>
    .tt-payment {
    border: 1px solid #ddd;
    transition: all 0.2s ease;
}

.tt-payment.active {
    border: 2px solid #0d6efd;
    background-color: rgba(13, 110, 253, 0.1);
}

</style>