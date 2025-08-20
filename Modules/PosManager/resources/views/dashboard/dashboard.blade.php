@extends("posmanager::layouts.master")


@section("content")

    <!-- Page Header  -->
    <div class="tt-page-header py-4">
        <div class="container-fluid">
            <div class="row g-2 align-items-center">
                <div class="col-auto flex-grow-1">
                    <div class="tt-page-title">
                        <h1 class="h4 mb-lg-1">{{ localize("Point of Sale") }}</h1>
                    </div>
                </div>
                <div class="col-auto">
                     <button type="button"
                            class="btn btn-primary btn-sm posNewOrder">
                        <i data-feather="plus" class="icon-14"></i>
                        {{ localize("New Order") }}
                    </button>
                </div>
                 <div class="col-auto">
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#receivePayment">
                        <i data-feather="dollar-sign" class="icon-14"></i>
                        {{ localize("Receive Bill") }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Header  -->

    <section class="tt-pos-area pb-4">
        <div class="container-fluid">
            <div class="row g-3">
                <!-- Sidebar Left -->
                <div class="col-12 col-lg-8">
                    <div class="card border rounded-3 p-3 tt-pos-left h-100 d-flex flex-column">

                        <div class="tt-pos-category-brand-wrap position-relative">
                            <div class="row justify-content-between align-items-center g-3 mb-3">
                                <div class="col-auto flex-grow-1">
                                    <div class="input-group">
                                        <input type="search"
                                               placeholder="Search your item here"
                                               class="form-control border border-end-0 keyword">
                                        <div class="input-group-append">
                                            <button type="button"
                                                    class="searchBtn btn bg-light-subtle border text-dark rounded rounded-start-0">
                                                <i data-feather="search" class="icon-16"></i>
                                                 {{ localize("Search") }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tt-pos-products-wrap">
                            <ul class="list-inline list-unstyled posCategories">
                                <li class="list-inline-item">
                                    <button class="bg-light-subtle btn-sm border shadow-sm px-2 rounded-3 itemCategory border-primary" data-id="">{{ localize("Show All") }}</button></li>
                            </ul>

                            {{--Products Load Here--}}
                            <div class="tt-pos-products" data-simplebar>
                                <div class="row g-xl-3 g-lg-2 g-2 row-cols-xl-5 row-cols-lg-4 row-cols-sm-3 row-cols-3 row-cols-md-4 posProducts">

                                </div>
                            </div>

                            <button type="button"
                                class="loadMoreProducts mt-3 btn btn-sm btn-primary d-block mx-auto pos-load-more">
                                <span> <svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-refresh-cw me-2">
                                        <polyline
                                            points="23 4 23 10 17 10"></polyline>
                                        <polyline
                                            points="1 20 1 14 7 14"></polyline>
                                        <path
                                            d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                                    </svg>{{ localize("Load More") }}</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /Sidebar Left -->

                <!-- Sidebar Rtght -->
                <div class="col-12 col-lg-4">
                    <div class="tt-pos-right card flex-column h-100 p-3">
                        <form action="{{ route('pos.order.placeOrder') }}"
                              method="post"
                              class="d-flex flex-column h-100 pos-cart-list-form posPlaceOrderFrm">
                            @csrf

                            {{-- Table ID --}}
                            <x-form.input
                                :showDiv="false"
                                type="hidden"
                                name="table_id"
                                id="posTableId"
                                class="posTableId"
                                value="{{ isset($table_id) ? $table_id : '' }}"
                            />


                            {{--Billing Section --}}
                            @include("posmanager::dashboard.billing.billing-section")

                            {{-- Billing Cart Lists--}}
                            @include("posmanager::dashboard.billing.cart-area")

                            {{-- Card Pay Modal --}}
                            @include("posmanager::common.modal.pos-card-pay-modal")

                            {{-- Billing information Total Discount, Money Etc--}}
                            @include("posmanager::dashboard.billing.billing-information")
                        </form>
                    </div>
                </div>
                <!-- /Sidebar Rtght -->
            </div>
        </div>
    </section>

    @include("posmanager::common.modal.add-customer-modal")

    {{-- receive payment Modal --}}
    @include("posmanager::modals.receive-payment-modal")

    {{-- Product Modal --}}
    @include("posmanager::modals.product-modal")

    {{-- Table Select Modal ---}}
    @include("posmanager::modals.table-modal")


@endsection

@section("script")
    @include("posmanager::dashboard.js")

    {{-- Cart JS --}}
    @include("cartmanager::commonJs.cart-js") 
    
    @include('commonJs.print-js')
@endsection

@section("styles")
@endsection
