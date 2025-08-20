<!-- The Modal -->
<div class="modal fade" id="payWithCardModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="modal-title">{{ localize("Card Details") }}</h4>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <x-form.label>{{ localize("Account Name") }}</x-form.label>
                                <x-form.input
                                    type="text"
                                    name="account_name"
                                    class="account_name"
                                    value="{{ old('account_name') }}"
                                />
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <x-form.label>{{ localize("Card Number") }}</x-form.label>
                                <x-form.input
                                    type="text"
                                    name="card_number"
                                    class="card_number"
                                    placeholder="Ex. 1234567890"
                                    value="{{ old('card_number') }}"
                                />
                            </div>
                        </div>


                        <div class="col-lg-8">
                            <div class="mb-3">
                                <x-form.label>{{ localize("Expiration") }}</x-form.label>
                                <x-form.input
                                    type="text"
                                    name="expiration"
                                    class="expiration"
                                    placeholder="YY/mm"
                                    value="{{ old('expiration') }}"
                                />
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="mb-3">
                                <x-form.label>{{ localize("CVV/CVC") }}</x-form.label>
                                <x-form.input
                                    type="text"
                                    name="cvv"
                                    class="cvv"
                                    value="{{ old('cvv') }}"
                                />
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="mb-3">
                                <button type="button"
                                        data-bs-dismiss="modal"
                                        class="btn btn-sm btn-success w-100">
                                    {{ localize("Save Information") }}
                                </button>
                            </div>
                        </div>
                    </div>
            </div>

        </div>
    </div>
</div>
