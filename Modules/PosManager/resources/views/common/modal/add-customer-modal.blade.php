<!-- Modal -->
<div class="modal fade" id="addCustomerModal"
     tabindex="-1"
     aria-labelledby="addCustomerModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGroupLabel">{{ localize("Quick Customer Register") }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pos.customer.register') }}" id="customerFrm" method="post">
                    @csrf
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <x-form.label>{{ localize("Customer Name") }}</x-form.label>
                                <x-form.input
                                   type="text"
                                   name="first_name"
                                />
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <x-form.label>{{ localize("Phone Number") }}</x-form.label>
                                <x-form.input
                                   type="text"
                                   name="mobile_no"
                                />
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <x-form.label>{{ localize("Email") }}</x-form.label>
                                <x-form.input
                                   type="email"
                                   name="email"

                                />
                            </div>
                        </div>

                        <div class="col-lg-6">
                           
                        </div>

                        <div class="col-lg-4">
                            <button type="submit" class="btn btn-success">{{ localize("Save") }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Modal -->
