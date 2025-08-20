@extends('layouts.default')

@section('title')
    {{ localize('Orders ') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection
@section("pagetitle", localize('Manage Kitchen Orders'))

@section('breadcrumb')
    @php
        $breadcrumbItems = [
            ["href"  => null, "title" => localize("Kitchen Orders List")]
        ];
    @endphp
    <x-common.breadcumb :items="$breadcrumbItems"/>
@endsection

@section('content')
    <!-- Page Content  -->
    <section class="mb-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-0 bg-transparent pb-0">
                            @include("backend.admin.kitchen-orders.filter.search-form")
                        </div>

                        <div class="card-body table-responsive-md ">
                            <div class="row g-3 posOrdersList">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Page Content  -->

@endsection

@section('js')
    @include('backend.admin.kitchen-orders.js')
@endsection

