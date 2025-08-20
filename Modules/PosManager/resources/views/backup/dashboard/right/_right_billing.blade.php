<div class="mt-auto">
    <div class="tt-pos-calculation mb-3">
        <div class="tt-pos-cal">
            <p class="mb-0">Subtotal</p>
            <strong>$1258.00</strong>
        </div>
        <div class="tt-pos-cal">
            <p class="mb-0">Tax</p>
            <strong>$1258.00</strong>
        </div>
        <div class="tt-pos-cal tt-pos-discount">
            <p class="mb-0">Discount</p>
            <div class="d-flex align-items-center btn btn-sm" data-bs-toggle="modal" data-bs-target="#otherDiscount">
                <span><i data-feather="edit-3" class="me-1"></i></span>
                <strong>00</strong>
            </div>
        </div>
        <div class="tt-pos-cal">
            <p class="mb-0 fw-bold">Total</p>
            <strong>$1258.00</strong>
        </div>
    </div>

    <div class="d-flex align-items-center mb-3 gap-2">
        <div class="col-auto flex-grow-1">
            <button class="btn btn-soft-dark w-100 btn-sm"><i data-feather="sun" class="icon-16 me-1"></i>Send to Kitchen</button>
        </div>
        <div class="col-auto">
            <button class="btn btn-light w-100 btn-sm"><i data-feather="save" class="icon-16 me-1"></i>Send to Kitchen</button>
        </div>
    </div>

    <div class="tt-pos-payment mb-3">
        <div class="tt-single-pos-payment">
            <input type="radio" class="tt-custom-radio" name="tt-radio" id="cashPayment">
            <label for="cashPayment" class="tt-payment btn btn-sm btn-warning fw-semibold d-block"><i data-feather="briefcase" class="me-1 icon-14"></i> Cash</label>
        </div>
        <div class="tt-single-pos-payment">
            <input type="radio" class="tt-custom-radio" name="tt-radio" id="cardPayment">
            <label for="cardPayment" class="tt-payment btn btn-sm btn-success fw-semibold d-block" data-bs-toggle="modal" data-bs-target="#cardModal"><i data-feather="credit-card" class="me-1 icon-14"></i> Card</label>
        </div>
        <div class="tt-single-pos-payment">
            <input type="radio" class="tt-custom-radio" name="tt-radio" id="walletPayment">
            <label for="walletPayment" class="tt-payment btn btn-sm btn-dark fw-semibold d-block"><i data-feather="dollar-sign" class="me-1 icon-14"></i> Wallet</label>
        </div>
    </div>
</div>
