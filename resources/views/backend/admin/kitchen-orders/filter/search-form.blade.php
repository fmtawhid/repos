<form action="{{ route('admin.kitchen_orders.index') }}" method="get" name="searchForm" id="searchForm">
    <div class="row g-3">

        <div class="col-auto flex-grow-1">
            <div class="input-group">
                <x-form.input
                    name="date_range"
                    id="date_range"
                    class="date-range-picker form-control form-control-sm"
                  />
            </div>
        </div>

        <div class="col-auto">
            <div class="input-group">
                <x-form.select name="status_id" id="search_status" class="form-select-sm">
                    <option value="">{{localize('Status')}}</option>
                    @foreach (getKitchenStatuses() as $statusKey => $status)
                        <option value="{{ $status->id }}">{{ $status->title }}</option>
                    @endforeach
                </x-form.select>
            </div>
        </div>

        <div class="col-auto">
            <x-form.button color="dark" type="submit" class="btn-sm" id="searchBtn">
                <i data-feather="search" class="icon-14"></i>
                {{ localize('Search') }}
            </x-form.button>
        </div>

    </div>
</form>
