@extends('layouts.default')

@section('title')
    {{ localize('Branch List') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection

@section("pagetitle", localize('Manage Branch'))

@section('breadcrumb')
    @php
        $breadcrumbItems = [
            ["href"  => null, "title" => localize("Branch List")]
        ];
    @endphp

    <x-common.breadcumb :items="$breadcrumbItems"/>
@endsection

@section('pageTitleButtons')
    <div class="col-auto">
        <x-form.button type="button" id="addBranchBtnForOffCanvas" data-bs-toggle="offcanvas"
                       data-bs-target="#addBranchSideBar">
            <i data-feather="plus" class="icon-14"></i>{{ localize('Add Branch') }}
        </x-form.button>
    </div>
@endsection

@section('content')
    <!-- Page Content  -->
    <section class="mb-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-0 bg-transparent pb-0">
                            @include("branchmodule::branches.search-form")
                        </div>

                        <div class="card-body table-responsive-md">
                            <table class="table tt-footable border rounded" data-use-parent-width="true">
                                <thead>
                                    <tr class="bg-secondary-subtle">
                                        <th data-breakpoints="xs" data-type="number"
                                            class="text-center">{{localize('S/L')}}</th>
                                        <th>{{localize('Name')}}</th>
                                        <th>{{localize('Address')}}</th>
                                        <th>{{localize('Phone Number')}}</th>
                                        <th>{{localize('Email')}}</th>
                                        <th>{{localize('Created At')}}</th>
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
        </div>
    </section>
    <!-- /Page Content  -->

    <!-- Add User start-->
    @include('branchmodule::branches.form-branch')
    <!-- Add User -->

@endsection

@section('js')
    @include('common.media-manager.uppyScripts')
    @include('branchmodule::branches.js')
    @include('layouts.active-status-core-script')
    @include('layouts.delete-core-script')
@endsection

