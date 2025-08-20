@extends('layouts.default')

@section('title')
    {{ localize('Languages') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection
@section('pagetitle', localize('Languages'))
@section('breadcrumb')
    @php
    $breadcrumbItems = [['href' => null, 'title' => localize('Languages')]]; @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection

@section('content')
<input type="hidden" name="localization_url" id="localization_url">
    <!-- Page Content  -->
    <section class="mb-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-0 bg-transparent pb-0">
                            <form action="" method="get" name="searchForm" id="searchForm">
                                <div class="row g-3">
                                    <div class="col-auto flex-grow-1">
                                        <div class="tt-search-box w-auto">
                                            <div class="input-group">
                                                <span class="position-absolute top-50 start-0 translate-middle-y ms-2">
                                                    <i data-feather="search" class="icon-16"></i></span>
                                                <input class="form-control rounded-start form-control-sm" type="text"
                                                    name="f_search" id="f_search" placeholder="Search..." />
                                            </div>
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
                        </div>

                        <div class="card-body">
                            <form class="form-horizontal" id="translateForm" action="{{ route('admin.localizations.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $language->id }}">
                                <table class="table tt-footable table-hover border-top" data-use-parent-width="true"
                                    id="localization-table">
                                    <thead class="py-3">
                                        <tr>
                                            <th class="text-center py-3" width="5%">{{ localize('S/L') }}
                                            </th>
                                            <th width="40%" class="py-3">{{ localize('Lang Key') }}</th>
                                            <th data-breakpoints="xs sm" class="py-3">{{ localize('Localizations') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <x-common.empty-row colpsan=3 loading=true />
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-secondary"
                                    onclick="copyLocalizations()">{{ localize('Copy Localizations') }}</button>
                                <button type="submit" class="btn btn-primary" id="frmActionBtn">{{ localize('Save') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Page Content  -->

    <!-- Add Language start-->

    <!-- Add Language -->

@endsection
@section('js')
    @include('backend.admin.localizations.js')
@endsection