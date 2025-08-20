@extends('layouts.default')

@section('title')
    {{ localize('Recurring Product Plan') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection
@section("pagetitle", localize("Recurring Product Plan"))
@section('breadcrumb')
    @php
        $breadcrumbItems = [['href' => null, 'title' => 'Recurring  Product Plan']];
    @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection



@section('content')
    <!-- Page Content  -->
    <section class="mb-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-4 pb-350">
                                <!--left sidebar-->
                                <div class="col-xl-12 order-2 order-md-2 order-lg-2 order-xl-1">

                                    @if(!($isActivePaypal == 1 || $isActiveStripe == 1))
                                        <x-common.empty-div h5='No Payment Gateway Available Now!' text="This feature is available when the PayPal or Stripe payment gateway is enabled in the system." />
                                    @endif
                                    @if ($isActivePaypal == 1)
                                        <!--auto subscription active/deactive permission-->
                                        <div class="card mb-4" id="section-4">
                                            <div class="card-body">
                                                <h5 class="mb-4">
                                                    {{ localize('Create Auto Renew Subscription Product For Paypal') }}
                                                </h5>
                                                <form
                                                    action="{{ route('admin.subscription-settings.store.gateway.product') }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="gateway" value="paypal">
                                                    <div class="mb-4">
                                                        <label class="form-label">{{ localize('Packages') }}</label>
                                                        <select class="form-control select2" name="packages[]"
                                                            data-toggle="select2" multiple
                                                            data-placeholder="{{ localize('Select Package..') }}">
                                                            @foreach ($paypalPackages as $package)
                                                                <option value="{{ $package->id }}">
                                                                    {{ $package->title }}
                                                                    [{{ $package->package_type }}][{{ $package->price }}]
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="d-flex align-items-center mt-4">
                                                        <button class="btn btn-primary"
                                                            type="submit">{{ localize('Submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @isset($gateWaysProductsPaypal)
                                            <div class="card mb-4" id="section-5">
                                                <div class="card-body">
                                                    <h5 class="mb-4">
                                                        {{ localize('Auto Renew Subscription Plans For Paypal') }}</h5>
                                                    <div class="card mb-4">

                                                        @include(
                                                            'backend.admin.subscriptions.settings.gatewayPlan.paypal-plan-list',
                                                            ['gateWaysProducts' => $gateWaysProductsPaypal]
                                                        )
                                                    </div>
                                                </div>
                                            </div>
                                        @endisset
                                    @endif
                                    @if ($isActiveStripe == 1)
                                        <!--auto subscription active/deactive permission-->
                                        <div class="card mb-4" id="section-4">
                                            <div class="card-body">
                                                <h5 class="mb-4">
                                                    {{ localize('Create Auto Renew Subscription Product For Stripe') }}
                                                </h5>
                                                <form
                                                    action="{{ route('admin.subscription-settings.store.gateway.product') }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="gateway" value="stripe">
                                                    <div class="mb-4">
                                                        <label class="form-label">{{ localize('Packages') }}</label>
                                                        <select class="form-control select2" name="packages[]"
                                                            data-toggle="select2" multiple
                                                            data-placeholder="{{ localize('Select Package..') }}">
                                                            @foreach ($stripPackages as $package)
                                                                <option value="{{ $package->id }}">
                                                                    {{ $package->title }}
                                                                    [{{ $package->package_type }}][{{ $package->price }}]
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="d-flex align-items-center mt-4">
                                                        <button class="btn btn-primary"
                                                            type="submit">{{ localize('Submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @isset($gateWaysProductsStripe)
                                            <div class="card mb-4" id="section-5">
                                                <div class="card-body">
                                                    <h5 class="mb-4">
                                                        {{ localize('Auto Renew Subscription Plans for Stripe') }}</h5>
                                                    <div class="card mb-4">

                                                        @include(
                                                            'backend.admin.subscriptions.settings.gatewayPlan.paypal-plan-list',
                                                            ['gateWaysProducts' => $gateWaysProductsStripe]
                                                        )


                                                    </div>
                                                </div>
                                            </div>
                                        @endisset
                                    @endif



                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Page Content  -->

@endsection

