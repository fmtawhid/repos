<div class="tt-pos-customer bg-soft-primary rounded p-2 px-3 mb-3">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <div class="avatar avatar-md">
                <img class="rounded-circle selected_customer_avatar" src="{{ urlVersion(null) }}">
            </div>
            <div class="ms-2">
                <input type="hidden" class="selected_customer_id" name="customer_id" value="">
                <input type="hidden" class="selected_customer_address" name="user_address_id" value="">

                <h6 class="mb-0 fs-md selected_customer_name">{{ localize("Customer") }}</h6>
                <span class="text-muted fs-sm selected_customer_phone">+xxxxxxxxxx</span>

            </div>
        </div>
        <h6 class="mb-0 fs-sm text-muted ">{{ localize("Address") }} : <span class="selected_customer_address_view"></span></h6>
    </div>
</div>
