@extends('layouts.default')

@section('title')
    {{ localize('Utilities') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection
@section("pagetitle", localize('Utilities'))
@section('breadcrumb')
    @php
    $breadcrumbItems = [['href' => null, 'title' => localize('Utilities')]]; @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection

@section('content')
    <section class="tt-section">
        <div class="container">

            <!-- utility start -->
            <div class="row g-2 mb-4">
                <div class="col-lg-4 col-md-4">
                    <a href="{{ route('admin.clear-cache') }}">
                        <div class="tt-utility-card rounded-3 shadow-sm card border-0 h-100 flex-column">
                            <div class="card-body p-lg-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-2 flex-shrink-0">
                                        <div class="text-center rounded-circle bg-soft-success">
                                            <span class="text-success tt-utility-icon"><i data-feather="rotate-cw"
                                                    class="icon-16"></i></span>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1">
                                        <h5 class="mb-0">Clear Cache</h5>
                                        <span class="fs-sm"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4">
                    <a href="{{ route('admin.clearLog') }}">
                        <div class="tt-utility-card rounded-3 shadow-sm card border-0 h-100 flex-column">
                            <div class="card-body p-lg-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-2 flex-shrink-0">
                                        <div class="text-center rounded-circle bg-soft-success">
                                            <span class="text-success tt-utility-icon"><i data-feather="rotate-cw"
                                                    class="icon-16"></i></span>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1">
                                        <h5 class="mb-0">Clear Log</h5>
                                        <span class="fs-sm"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4">
                    <a href="{{ route('admin.debug') }}">
                        <div class="tt-utility-card rounded-3 shadow-sm card border-0 h-100 flex-column">
                            <div class="card-body p-lg-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-2 flex-shrink-0">
                                        <div class="text-center rounded-circle bg-soft-danger">
                                            <span class="text-danger tt-utility-icon"><i data-feather="terminal"
                                                    class="icon-16"></i></span>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1">
                                        <h5 class="mb-0">Debug Mode</h5>
                                        <span class="fs-sm">{{ strtoupper(env('APP_DEBUG') ? 'true' : 'false') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- utility end -->


        </div>
    </section>
@endsection
