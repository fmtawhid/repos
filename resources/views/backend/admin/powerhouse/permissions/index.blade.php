@extends("layouts.default")

@section('title',localize('Permissions'))

@section('pagetitle')
    {{ localize('Permissions') }}
@endsection

@section('breadcrumb') @php
    $breadcrumbItems = [
        ["href"  => null, "title" => "Permissions"]
    ]; @endphp
<x-common.breadcumb :items="$breadcrumbItems" />
@endsection

@section("content")
    <section class="mb-4">
        <div class="container">
            <div class="row g-3 mb-3">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive-sm">

                                <table class="table tt-footable border" data-use-parent-width="true">
                                    <thead>
                                        <tr>
                                            <th data-breakpoints="xs" data-type="number" class="text-center">S/L</th>
                                            <th>{{ localize('Display Title') }}</th>
                                            <th>{{ localize('URL') }}</th>
                                            <th>{{ localize('Route Name') }}</th>
                                            <th>{{ localize('Method Type') }}</th>
                                            <th>{{ localize('Is Allowed in demo') }}?</th>
                                            <th>{{ localize('Active Status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="permissions">

                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


@section('js')
    @include("backend.admin.powerhouse.permissions.js")
@endsection
