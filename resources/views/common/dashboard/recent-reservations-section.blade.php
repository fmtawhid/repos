
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-0 bg-transparent pb-0">
                     
                <div class="mb-4">
                    <h5 class="mb-1">{{ localize("Recent Reservations") }}</h5>
                    <span class="text-muted">{{ localize("See your recent reservations here") }}</span>
                </div>    
                <form action="" method="get" name="searchForm" id="searchForm">
                    <div class="row g-3">                     
                        <div class="col-auto">
                            <div class="input-group">
                                <div class="input-group-text btn btn-sm btn-light border">{{ localize('Start Date') }}</div>
                                <input type="date" name="start_date" id="start_date" class="form-control form-control-sm" />
                            </div>
                        </div>

                        <div class="col-auto">
                            <div class="input-group">
                                <div class="input-group-text btn btn-sm btn-light border">{{ localize('End Date') }}</div>
                                <input type="date" name="end_date" id="end_date" class="form-control form-control-sm" />
                            </div>
                        </div>

                        <div class="col-auto flex-grow-1">
                            <div class="tt-search-box w-auto">
                                <div class="input-group">
                                    <span class="position-absolute top-50 start-0 translate-middle-y ms-2"> <i
                                            data-feather="search" class="icon-16"></i></span>
                                    <input class="form-control rounded-start form-control-sm" type="text" name="f_search" id="f_search" placeholder="{{ localize('Search by customer name, email or table code') }}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-auto">
                            <div class="input-group">
                                <x-form.select name="status_id" id="status_id" class="form-select form-select-sm">
                                    <option value="">{{ localize('Select Status') }}</option>                                                    
                                    @foreach (getSelectableStatuses('reservation_access', 1) ?? [] as $reservationsStatusId => $reservationsStatus)
                                        <option value="{{ $reservationsStatusId }}">{{ $reservationsStatus }}</option>
                                    @endforeach
                                </x-form.select>                                       
                            </div>
                        </div>
                        
                        <div class="col-auto">
                            <x-form.button color="dark" type="button" class="btn-size-default btn btn-sm btn-primary" id="searchBtn">
                                <i data-feather="search" class="icon-14"></i>
                                {{ localize('Search') }}
                            </x-form.button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body table-responsive-md">
                <table class="table tt-footable border rounded" data-use-parent-width="true">
                    <thead>
                        <tr class="bg-secondary-subtle fs-sm">
                            <th data-breakpoints="xs" data-type="number" class="text-center">
                                {{localize('S/L')}}
                            </th>
                            <th>{{localize('Branch')}}</th>
                            <th>{{localize('Area')}}</th>
                            <th>{{localize('T.Code')}}</th>
                            <th>{{localize('C.Name')}}</th>
                            <th>{{localize('C.Email')}}</th>
                            <th>{{localize('Period')}}</th>
                            <th>{{localize('R.Start Time')}}</th>
                            <th>{{localize('R.End Time')}}</th>
                            <th>{{localize('Guest')}}</th>
                            <th>{{localize('Total')}}</th>
                            <th>{{localize('Advance')}}</th>
                            <th>{{localize('Due')}}</th>
                            <th>{{localize('Reserved At')}}</th>
                            <th class="text-center">{{localize('Status')}}</th>
                            <th data-breakpoints="xs sm md" class="text-center">{{localize('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <x-common.empty-row colspan=9 loading=true />
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
