<div class="col-12 col-lg-4">
    <div class="bg-secondary border rounded-3 p-3 tt-pos-right h-100 d-flex flex-column">

        {{-- Right Top New Order, Customer Etc --}}
        @include("posmanager::dashboard.right._right_top")

        {{-- Items --}}
        @include("posmanager::dashboard.right._right_items")

        {{-- Billing --}}
        @include("posmanager::dashboard.right._right_billing")
    </div>
</div>
