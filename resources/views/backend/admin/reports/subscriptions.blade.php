@extends('layouts.default')

@section('title')
    {{ localize('Subscriptions Report') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section("pagetitle", localize('Subscriptions Report'))
@section('breadcrumb')
    @php
        $breadcrumbItems = [['href' => null, 'title' => localize('Subscriptions Report')]];
    @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection

@section('content')
    <section class="tt-section">
        <div class="container">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card mb-4" id="section-1">
                        <form action="" method="get" name="searchForm" id="searchForm">
                            <div class="card-header border-bottom-0">
                                <div class="row justify-content-between g-3">

                                    <div class="col-4">
                                        <div class="input-group">
                                            @php
                                                $start_date = date('m/d/Y', strtotime('7 days ago'));
                                                $end_date = date('m/d/Y', strtotime('today'));
                                                if (isset($date_var)) {
                                                    $start_date = date('m/d/Y', strtotime($date_var[0]));
                                                    $end_date = date('m/d/Y', strtotime($date_var[1]));
                                                }
                                            @endphp

                                            <input class="form-control form-control-sm date-range-picker date-range" type="text"
                                                placeholder="{{ localize('Start date - End date') }}" name="date_range"
                                                data-startdate="'{{ $start_date }}'"
                                                data-enddate="'{{ $end_date }}'">
                                        </div>
                                    </div>
                                    @if (auth()->user()->user_type != 'customer')
                                    <div class="col-auto">
                                        <div class="input-group">                                            
                                            <x-form.select name="user_id" id="user_id" class="form-select-sm select2">
                                                <option value="">{{ localize('Select User') }}</option>
                                                @foreach ($users as $user)                                                
                                                    <option value="{{$user->id}}" {{isset($user_id) ? ($user_id ==  $user->id ? 'selected':''):''}}> {{$user->name}}
                                                    </option>
                                                @endforeach
                                            </x-form.select>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-auto">
                                        <div class="input-group">
                                            <select class="form-select select2" id="package_id" name="package_id">
                                                <option value="">{{ localize('Select Package') }}</option>
                                                @foreach ($packages as $package)                                                
                                                    <option value="{{$package->id}}" {{isset($package_id) ? ($package_id ==  $package->id ? 'selected':''):''}}> {{$package->title}}
                                                       </option>
                                                @endforeach

                                            </select>
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
                                    <div class="col-auto flex-grow-1"></div>
                                    <div class="col-auto text-end">
                                        <strong class="d-block"> {{ formatPrice($totalPrice) }}</strong>
                                        <span class="fs-sm">
                                            {{ localize('Total Amount') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="card-body table-responsive-md">
                            <table class="table tt-footable border-top border align-middle" data-use-parent-width="true">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ localize('S/L') }}</th>
                                        @if (auth()->user()->user_type != 'customer')
                                            <th>{{ localize('User') }}</th>
                                        @endif
                                        <th>{{ localize('Package') }}</th>
                                        <th data-breakpoints="xs sm">{{ localize('Price') }}</th>
                                        <th data-breakpoints="xs sm">{{ localize('Subscribed On') }}</th>
                                        <th data-breakpoints="xs sm" class="text-end">{{ localize('Payment Method') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <x-common.empty-row colpan=5 loading=true/>
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
@include('backend.admin.reports.js.subscriptions-js')
@endsection