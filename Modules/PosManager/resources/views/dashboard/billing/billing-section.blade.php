<div class="row justify-content-between align-items-center g-2 mb-3">
    <div class="col-auto flex-grow-1">
        <button type="button" class="newCustomerBtn btn btn-primary btn-sm d-inline-flex align-items-center justify-content-center gap-1">
            <span class="icon-clr-primary">
                <i data-feather="plus" class="icon-14"></i>
            </span>
            <span class="d-inline-block">
                {{ localize("Customer") }}
            </span>
        </button>
    </div>

    <div class="col-auto">
        <x-form.select class="form-select form-select-sm posBranchEmployees select2" name="employee_id">
            <option value="">{{ localize("Select waiter") }}</option>
        </x-form.select>
    </div>

    <div class="col-auto">
        <select class="form-select form-select-sm posDeliveryType" aria-label="Small select example" name="is_take_way_order">
            @forelse(appStatic()::POS_DELIVERY_TYPES as $indexId => $posDeliveryType)
                <option value="{{ $indexId }}">{{ $posDeliveryType }}</option>
            @empty
            @endforelse
        </select>
    </div>

    <div class="col-auto">
        <button type="button" class="btn btn-light btn-sm posSelectTable">
            <i data-feather="octagon" class="me-1 icon-14"></i> {{ localize("Select Table") }}
        </button>
    </div>
    
    <div class="col-auto">
        <x-form.select class="form-select form-select-sm posCustomers select2" name="customer_id" id="customer_id">
            <option value="">{{ localize("Select customer") }}</option>
        </x-form.select>
    </div>

    

{{--    <div class="col-auto">--}}
{{--        <button class="btn btn-soft-danger btn-sm posNewOrder">--}}
{{--            <i data-feather="minus-circle" class="me-1 icon-14"></i>--}}
{{--            {{ localize("Cancel") }}--}}
{{--        </button>--}}
{{--    </div>--}}
</div>
