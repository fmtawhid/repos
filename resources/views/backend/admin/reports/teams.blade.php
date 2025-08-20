@extends('layouts.default')

@section('title')
    {{ localize('Teams Report') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection
@section("pagetitle", localize('Teams Report'))
@section('breadcrumb')
    @php
        $breadcrumbItems = [['href' => null, 'title' => localize('Teams Report')]];
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
                                        <x-form.select name="status_id" id="status_id" class="form-select-sm">
                                            <option value="">{{localize('Status')}}</option>
                                            @foreach (appStatic()::STATUS_ARR as $statusKey => $status)
                                                <option value="{{ $statusKey }}">{{ $status }}</option>
                                            @endforeach
                                        </x-form.select>
                                    </div>
                                </div>

                                    <div class="col-auto ms-auto">
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
                                    <tr class="bg-secondary-subtle">
                                        <th data-breakpoints="xs" data-type="number" class="text-center">{{localize('S/L')}}</th>
                                        <th>{{localize('User Type')}}</th>
                                        <th>{{localize('Branch')}}</th>
                                        <th>{{localize('Role')}}</th>
                                        <th>{{localize('Name')}}</th>
                                        <th>{{localize('Email')}}</th>
                                        <th>{{localize('Mobile')}}</th>
                                        <th>{{localize('Created At')}}</th>
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
    @include('backend.admin.reports.js.teams-js')
@endsection
