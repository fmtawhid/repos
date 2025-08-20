@extends('layouts.default')

@section('title')
    {{ localize('Sales Report') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection
@section("pagetitle", localize('Sales Report'))
@section('breadcrumb')
    @php
        $breadcrumbItems = [['href' => null, 'title' => localize('Sales Report')]];
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
                                            {{-- <span class="input-group-text"><i data-feather="search"></i></span> --}}
                                            <input class="form-control form-control-sm" type="text" name="search" id="search" placeholder="Search" value="{{ request()->get('search') }}">
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
                            <table class="table border rounded">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ localize('S/L') }} </th>
                                        <th>{{ localize('Date') }}</th>
                                        <th data-breakpoints="xs">{{ localize('Total Order') }}</th>
                                        <th data-breakpoints="xs">{{ localize('Tax') }}</th>
                                        <th data-breakpoints="xs">{{ localize('Payment Method') }}</th>
                                        <th data-breakpoints="xs">{{ localize('Discount') }}</th>
                                        <th data-breakpoints="xs">{{ localize('Total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <x-common.empty-row colspan=7 loading=true />
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
    @include('backend.admin.reports.js.items-js')
@endsection
