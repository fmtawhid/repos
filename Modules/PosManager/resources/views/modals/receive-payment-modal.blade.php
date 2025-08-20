<div class="modal modal-lg fade receive_payment_modal"
     id="receivePayment"
     tabindex="-1"
     aria-labelledby="receivePaymentLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 receivePaymentModalContent">
            <div class="modal-header border-bottom-0 py-0 justify-content-between align-items-center">
                <h5 class="modal-title">
                   {{ localize("Receive Bill") }}
                </h5>
                <button type="button" class="btn btn--icon p-2 lh-1" data-bs-dismiss="modal">
                    <span class="material-symbols-rounded fs-28 lh-1">
                        {{ localize("Close") }}
                    </span>
                </button>
            </div>
            <div class="modal-body padding-bottom-12">
                <form action="{{ route('pos.order.receiveBill') }}" class="orderReceiveForm" id="#orderReceiveForm">
                    <div class="mb-4">
                    
                        <label for="orderCode" class="fw-semibold">{{ localize("Order number") }}</label>
                        <input type="text"
                            name="order_code"
                                id="orderCode"
                            class="form-control form-control-sm form-control-transparent"
                            placeholder="{{ localize("Enter order invoice number") }}"
                            required
                        />
                        
                    </div> 

                    <div class="mb-4">
                        <label for="amount" class="fw-semibold">{{ localize("Amount") }}</label>
                        <input type="number"
                                step="0.001"
                            name="amount"
                            id="amount"

                            class="form-control form-control-sm form-control-transparent"
                            placeholder="{{ localize("Enter amount") }}"
                            required
                        />
                    </div>

                    <div class="d-flex align-items-center flex-wrap gap-3">
                        <button class="btn btn-sm btn-primary" type="submit" id="receiveBillSubmitBtn">
                            {{ localize("Submit") }}
                        </button> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

