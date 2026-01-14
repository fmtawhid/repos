@extends('layouts.default')

@section('title')
    {{ localize('Reservations Report') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection
@section("pagetitle", localize('Reservations Report'))
@section('breadcrumb')
    @php
        $breadcrumbItems = [['href' => null, 'title' => localize('Reservations Report')]];
    @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection
@section('content')
    <section class="mb-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="" method="get" name="searchForm" id="searchForm">
                            <div class="card-header border-bottom-0">
                                <div class="row justify-content-between g-3">

                                    <div class="col-auto">
                                        <div class="input-group">
                                            @php
                                                $start_date = date('m/d/Y', strtotime('7 days ago'));
                                                $end_date = date('m/d/Y', strtotime('today'));
                                                if (isset($date_var)) {
                                                    $start_date = date('m/d/Y', strtotime($date_var[0]));
                                                    $end_date = date('m/d/Y', strtotime($date_var[1]));
                                                }
                                            @endphp

                                            <input class="form-control form-control-sm date-range-picker date-range" id="date_range" type="text"
                                                placeholder="{{ localize('Start date - End date') }}" name="date_range"
                                                data-startdate="'{{ $start_date }}'"
                                                data-enddate="'{{ $end_date }}'">
                                        </div>
                                    </div>
                                    
                                    <div class="col-auto">
                                        <div class="input-group">
                                            <x-form.select name="branch_id" id="branch_id">
                                                <option value="">{{ localize('Select branch') }}</option>                                                    
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                @endforeach
                                            </x-form.select>                                       
                                        </div>
                                    </div>
                                    
                                    <div class="col-auto">
                                        <div class="input-group">
                                            <x-form.select name="status_id" id="status_id">
                                                <option value="">{{ localize('Select Status') }}</option>                                                    
                                                @foreach (getSelectableStatuses('reservation_access', 1) ?? [] as $reservationsStatusId => $reservationsStatus)
                                                    <option value="{{ $reservationsStatusId }}">{{ $reservationsStatus }}</option>
                                                @endforeach
                                            </x-form.select>                                       
                                        </div>
                                    </div>
                                    

                                    <div class="col-auto ms-auto d-flex gap-2">
                                        <x-form.button color="primary" type="button" class="btn-sm" id="exportBtn">
                                            <i data-feather="download" class="icon-14"></i>
                                            {{ localize('Export PDF') }}
                                        </x-form.button>
                                        <x-form.button color="dark" type="button" class="btn-sm" id="searchBtn">
                                            <i data-feather="search" class="icon-14"></i>
                                            {{ localize('Search') }}
                                        </x-form.button>
                                    </div>
                                </div>
                            </div>
                        </form>

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
        </div>
    </section>
@endsection

@section('js')
    @include('backend.admin.reports.js.reservations-js')
@endsection
