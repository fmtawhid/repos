<form action="" method="get" name="searchForm" id="searchForm">
    <div class="row g-3">

        <div class="col-auto flex-grow-1">
            <div class="tt-search-box w-auto">
                <div class="input-group">
                    <span class="position-absolute top-50 start-0 translate-middle-y ms-2">
                        <i data-feather="search" class="icon-16"></i>
                    </span>
                    <x-form.input
                        class="form-control rounded-start form-control-sm"
                        type="text"
                        name="keyword"
                        id="keyword"
                        placeholder="Search..."
                    />
                </div>
            </div>
        </div>

        <div class="col-auto">
            <div class="input-group">
                <x-form.select name="branch_id" id="branch_id" class="form-select-sm">
                    <option value="">{{localize('Select Branch')}}</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </x-form.select>
            </div>
        </div>

        <div class="col-auto">
            <div class="input-group">
                <x-form.select name="search_status" id="search_status" class="form-select-sm">
                    <option value="">{{localize('Status')}}</option>
                    @foreach (appStatic()::STATUS_ARR as $statusKey => $status)
                        <option value="{{ $statusKey }}">{{ $status }}</option>
                    @endforeach
                </x-form.select>
            </div>
        </div>

        <div class="col-auto">
            <x-form.button color="dark" type="button" class="btn-sm" id="searchBtn">
                <i data-feather="search" class="icon-14"></i>
                {{ localize('Search') }}
            </x-form.button>
        </div>

    </div>
</form>
