@extends('layouts.default')

@section('title')
    {{ localize('Clinet Feedback') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection
@section("pagetitle", localize('Clinet Feedback'))

@section('breadcrumb')
    @php
    $breadcrumbItems = [['href' => null, 'title' => localize('Clinet Feedback')]]; @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection

@section('pageTitleButtons')
    <div class="col-auto">
        <x-form.button type="button" id="addFrmOffCanvas" data-bs-toggle="offcanvas"
            data-bs-target="#addClientFeedbackFormSidebar">
            <i data-feather="plus"></i>{{ localize('Add Feedback') }}
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

                        <div class="card-body table-responsive-md">
                            <table class="table border rounded">
                                <thead>
                                    <tr class="bg-secondary-subtle">
                                        <th>{{ localize('S/L') }}</th>
                                        <th>{{ localize('Image') }}</th>
                                        <th>{{ localize('Name') }}</th>
                                        <th>{{ localize('Designation') }}</th>
                                        <th>{{ localize('Heading') }}</th>
                                        <th>{{ localize('Rating') }}</th>
                                        <th>{{ localize('Review') }}</th>                                  
                                        <th class="text-center">{{ localize('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <x-common.empty-row colspan=8 loading=true />
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Page Content  -->

    <!-- Add Template Category start-->
    @include('backend.admin.appearance.client-feedback.add-client-feedback')
    <!-- Add Template Category -->
@endsection
@section('js')
    @include('common.media-manager.uppyScripts')
    @include('backend.admin.appearance.client-feedback.js')
@endsection
