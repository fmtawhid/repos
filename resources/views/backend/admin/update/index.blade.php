@extends('layouts.default')

@section('title')
    {{ localize('System Update') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection
@section("pagetitle", localize("Folders"))

@section('breadcrumb')
    @php
        $breadcrumbItems = [['href' => null, 'title' => localize('System Update')]]; @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection

@section('pageTitleButtons')
    <div class="col-auto">
        <x-form.button type="button" >
            <i data-feather="settings"></i>{{ localize('System Update') }}
        </x-form.button>
    </div>
@endsection

@section('content')
    <section class="mb-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div data-type="update-index">
                        @include('common.update.update-content')
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header pb-0 pt-1 bg-light">
                            <ul class="nav nav-line-tab fw-semibold" role="tablist">

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active"
                                       href="#oneClickUpdateTab"
                                       data-bs-toggle="tab"
                                       role="tab"
                                       aria-controls="oneClickUpdateTab"
                                       aria-selected="true">
                                        {{ localize('One Click Update') }}
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link"
                                       href="#manualUpdateTab"
                                       data-bs-toggle="tab"
                                       role="tab"
                                       aria-controls="manualUpdateTab"
                                       aria-selected="false"
                                       tabindex="-1">
                                        {{ localize('Manual Update') }}
                                        <small>
                                            <span class="text-danger">*</span>
                                            {{ localize('Update File (Zip)') }}
                                        </small>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            @include('backend.admin.update.tab-update-application')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection