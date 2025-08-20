@extends('layouts.default')


@section('title')
    {{ localize('Subscription Plan') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection

@section("pagetitle", localize("Subscription Plan")) 

@section('breadcrumb')
    @php
    $breadcrumbItems = [['href' => null, 'title' => localize('Subscription Plan')]]; @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection
@section('pageTitleButtons')
    @if (isAdminUserGroup())
        <div class="col-auto">
            <x-form.button type="button" id="addPlanOffCanvas" data-bs-toggle="offcanvas" data-bs-target="#addPlanFormSidebar">
                <i data-feather="plus"></i>{{ localize('Add Plan') }}
            </x-form.button>
        </div>
    @endif
@endsection
@section('content')
    <!-- Page Content  -->

    <section class="mb-4">
        <div class="container">
            <div class="tt-section mb-4">
                <div class="container">
                    <div class="row">
                        @if(session()->has("success"))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session()->has("error"))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="tt-page-heading text-center mb-5">
                                @include('backend.admin.subscription-plan.inc.subscription-type')
                                @if (isAdmin())
                                    <p class="text-muted mt-3">{{ localize('Create and add subscription plans for customers to select. These plans will be visible to customers during the subscription process') }}</p>
                                @else
                                    <p class="text-muted mt-3">{{ localize('Choose your subscription plan from the options below. Select the plan that best suits your needs to get started with our services.') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row g-0 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 justify-content-center" id="package-list">
                        @include("backend.admin.subscription-plan.plan-list")
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Page Content  -->
    @include('backend.admin.subscription-plan.add-plan')
    <!-- Add tag Category -->

@endsection
@section('js')
    @include('backend.admin.subscription-plan.js')
    @include('layouts.active-status-core-script')
@endsection
