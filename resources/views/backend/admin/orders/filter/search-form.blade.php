<form action="{{ route('admin.orders.index') }}" method="get" name="searchForm" id="searchForm">
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
                <x-form.select name="branch_id" id="branch_id" class="form-select-sm select2">
                    <option value="">{{localize('Select Branch')}}</option>
                    @if(isVendorTeam())
                        <option value="{{ getUserBranchId() }}">{{ getUserBranch()?->name }}</option>
                    @else
                        @forelse($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->branch_code }} - {{ $branch->name }}</option>
                        @empty
                        @endforelse
                    @endif
                </x-form.select>
            </div>
        </div>

        <div class="col-auto">
            <div class="input-group">
                <x-form.select name="employee_id" id="employee_id" class="form-select-sm select2">
                    <option value="">{{localize('Select a Waiter')}}</option>
                    @forelse($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->id }} - {{ $employee->full_name }}</option>
                    @empty
                    @endforelse
                </x-form.select>
            </div>
        </div>

        <div class="col-auto">
            <div class="input-group">
                <x-form.select name="status_id" id="search_status" class="form-select-sm">
                    <option value="">{{localize('Status')}}</option>
                    @foreach (getOrderStatuses() as $statusKey => $status)
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
