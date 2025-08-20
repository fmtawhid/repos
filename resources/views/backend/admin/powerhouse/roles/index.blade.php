@extends("layouts.default")

@section('title')
    {{ localize('Roles') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection

@section("pagetitle", localize('Roles')) 



@section('breadcrumb') @php
    $breadcrumbItems = [
        ["href"  => null, "title" => localize("Roles")]
    ]; @endphp
<x-common.breadcumb :items="$breadcrumbItems" />
@endsection


@section('pageTitleButtons')
    <div class="col-auto">
        <x-form.button type="button"
                       id="addFrmOffCanvas"
                       data-bs-toggle="offcanvas"
                       data-bs-target="#addFormSidebar">
            <i data-feather="plus" class="icon-14"></i>{{ localize("Add New Role") }}
        </x-form.button>
    </div>
@endsection

@section("content")
    <section class="mb-4">
        <div class="container">
            <div class="row g-3 mb-3">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body table-responsive-md">
                            <table class="table tt-footable border" data-use-parent-width="true">
                                <thead>
                                <tr>
                                    <th data-breakpoints="xs" data-type="number">{{localize('S/L')}}</th>
                                    <th>{{ localize('Title') }}</th>
                                    <th class="text-center">{{ localize('Active Status') }}</th>
                                    <th>{{ localize('Permissions') }}</th>
                                    <th data-breakpoints="xs sm md" class="text-center">{{localize('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody class="roles">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include("backend.admin.powerhouse.roles.sidebar_role")
@endsection


@section('js')
    @include("backend.admin.powerhouse.roles.js")
    @include('layouts.active-status-core-script')
@endsection
