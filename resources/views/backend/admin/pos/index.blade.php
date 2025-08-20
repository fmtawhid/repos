@extends('layouts.default')

@section('content')


        <!-- Page Header  -->
        <div class="tt-page-header py-4">
            <div class="container-fluid">
                <div class="row g-2 align-items-center">
                    <div class="col-auto flex-grow-1">
                        <div class="tt-page-title">
                            <h1 class="h4 mb-lg-1">Product Listing</h1>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-secondary btn-sm">
                            <i data-feather="cloud" class="icon-14"></i>
                            Draft Order
                        </button>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-secondary btn-sm">
                            <i data-feather="codesandbox" class="icon-14"></i>
                            QR Order
                        </button>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-secondary btn-sm">
                            <i data-feather="octagon" class="icon-14"></i>
                            Table Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header  -->
    
        <!-- Pos Content -->
        <section class="tt-pos-area pb-4">
            <div class="container-fluid">
                <div class="row g-3">
                    <!--left sidebar start-->
                    <div class="col-12 col-lg-8">
                        <div class="bg-secondary border rounded-3 p-3 tt-pos-left h-100 d-flex flex-column">
                            <div class="tt-pos-category-brand-wrap position-relative">
                                <div class="row justify-content-between align-items-center g-3 mb-3">
                                    <div class="col-auto flex-grow-1">
                                        <form action="#" class="header-search-form">
                                            <div class="input-group">
                                                <input type="search" placeholder="Search your item here" class="form-control border border-end-0">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn bg-light-subtle border text-dark rounded rounded-start-0"><i data-feather="search" class="icon-16"></i> Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-pos-products-wrap">
                                <ul class="list-inline list-unstyled">
                                    <li class="list-inline-item"><button class="bg-light-subtle btn-sm border shadow-sm px-2 rounded-3">Show All</button></li>
                                    <li class="list-inline-item"><button class="bg-light-subtle btn-sm border shadow-sm px-2 rounded-3">Pizza</button></li>
                                    <li class="list-inline-item"><button class="bg-light-subtle btn-sm border shadow-sm px-2 rounded-3">Fried Rice</button></li>
                                    <li class="list-inline-item"><button class="bg-light-subtle btn-sm border shadow-sm px-2 rounded-3">Pasta</button></li>
                                    <li class="list-inline-item"><button class="bg-light-subtle btn-sm border shadow-sm px-2 rounded-3">Sub Sanduice</button></li>
                                    <li class="list-inline-item"><button class="bg-light-subtle btn-sm border shadow-sm px-2 rounded-3">Burger</button></li>
                                    <li class="list-inline-item"><button class="bg-light-subtle btn-sm border shadow-sm px-2 rounded-3">Soup</button></li>
                                    <li class="list-inline-item"><button class="bg-light-subtle btn-sm border shadow-sm px-2 rounded-3">Beverages</button></li>
                                    <li class="list-inline-item"><button class="bg-light-subtle btn-sm border shadow-sm px-2 rounded-3">Rice</button></li>
                                    <li class="list-inline-item"><button class="bg-light-subtle btn-sm border shadow-sm px-2 rounded-3">Chicken Fried</button></li>
                                </ul>
                                <div class="tt-pos-products" data-simplebar>
                                    <div class="row g-xl-3 g-lg-2 g-2 row-cols-xl-5 row-cols-lg-4 row-cols-sm-3 row-cols-3 row-cols-md-4">
                                        <div class="col">
                                            <div class="tt-single-pos-item card border-0 active-item">
                                                <div class="img-left me-2">
                                                    <img src="assets/img/products/1.jpg" alt="products" class="img-fluid" />
                                                </div>
                                                <div class="d-flex flex-column p-2">
                                                    <h3 class="fs-sm mb-1 tt-line-clamp tt-clamp-1 fw-medium">
                                                        Popped Rice Special Chocolate
                                                    </h3>
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-muted">$250</del>
                                                        <span class="text-accent">$150</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-single-pos-item card border-0" data-bs-toggle="modal" data-bs-target="#productVariation">
                                                <div class="img-left me-2">
                                                    <img src="assets/img/products/2.jpg" alt="products" class="img-fluid" />
                                                </div>
                                                <div class="d-flex flex-column p-2">
                                                    <h3 class="fs-sm mb-1 tt-line-clamp tt-clamp-1 fw-medium">
                                                        Popped Rice Special Chocolate
                                                    </h3>
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-muted">$250</del>
                                                        <span class="text-accent">$150</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-single-pos-item card border-0 active-item">
                                                <div class="img-left me-2">
                                                    <img src="assets/img/products/3.jpg" alt="products" class="img-fluid" />
                                                </div>
                                                <div class="d-flex flex-column p-2">
                                                    <h3 class="fs-sm mb-1 tt-line-clamp tt-clamp-1 fw-medium">
                                                        Popped Rice Special Chocolate
                                                    </h3>
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-muted">$250</del>
                                                        <span class="text-accent">$150</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-single-pos-item card border-0" data-bs-toggle="modal" data-bs-target="#productVariation">
                                                <div class="img-left me-2">
                                                    <img src="assets/img/products/4.jpg" alt="products" class="img-fluid" />
                                                </div>
                                                <div class="d-flex flex-column p-2">
                                                    <h3 class="fs-sm mb-1 tt-line-clamp tt-clamp-1 fw-medium">
                                                        Popped Rice Special Chocolate
                                                    </h3>
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-muted">$250</del>
                                                        <span class="text-accent">$150</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-single-pos-item card border-0 active-item">
                                                <div class="img-left me-2">
                                                    <img src="assets/img/products/5.jpg" alt="products" class="img-fluid" />
                                                </div>
                                                <div class="d-flex flex-column p-2">
                                                    <h3 class="fs-sm mb-1 tt-line-clamp tt-clamp-1 fw-medium">
                                                        Popped Rice Special Chocolate
                                                    </h3>
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-muted">$250</del>
                                                        <span class="text-accent">$150</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-single-pos-item card border-0">
                                                <div class="img-left me-2">
                                                    <img src="assets/img/products/6.jpg" alt="products" class="img-fluid" />
                                                </div>
                                                <div class="d-flex flex-column p-2">
                                                    <h3 class="fs-sm mb-1 tt-line-clamp tt-clamp-1 fw-medium">
                                                        Popped Rice Special Chocolate
                                                    </h3>
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-muted">$250</del>
                                                        <span class="text-accent">$150</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-single-pos-item card border-0">
                                                <div class="img-left me-2">
                                                    <img src="assets/img/products/7.jpg" alt="products" class="img-fluid" />
                                                </div>
                                                <div class="d-flex flex-column p-2">
                                                    <h3 class="fs-sm mb-1 tt-line-clamp tt-clamp-1 fw-medium">
                                                        Popped Rice Special Chocolate
                                                    </h3>
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-muted">$250</del>
                                                        <span class="text-accent">$150</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-single-pos-item card border-0">
                                                <div class="img-left me-2">
                                                    <img src="assets/img/products/8.jpg" alt="products" class="img-fluid" />
                                                </div>
                                                <div class="d-flex flex-column p-2">
                                                    <h3 class="fs-sm mb-1 tt-line-clamp tt-clamp-1 fw-medium">
                                                        Popped Rice Special Chocolate
                                                    </h3>
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-muted">$250</del>
                                                        <span class="text-accent">$150</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-single-pos-item card border-0 active-item">
                                                <div class="img-left me-2">
                                                    <img src="assets/img/products/1.jpg" alt="products" class="img-fluid" />
                                                </div>
                                                <div class="d-flex flex-column p-2">
                                                    <h3 class="fs-sm mb-1 tt-line-clamp tt-clamp-1 fw-medium">
                                                        Popped Rice Special Chocolate
                                                    </h3>
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-muted">$250</del>
                                                        <span class="text-accent">$150</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-single-pos-item card border-0" data-bs-toggle="modal" data-bs-target="#productVariation">
                                                <div class="img-left me-2">
                                                    <img src="assets/img/products/2.jpg" alt="products" class="img-fluid" />
                                                </div>
                                                <div class="d-flex flex-column p-2">
                                                    <h3 class="fs-sm mb-1 tt-line-clamp tt-clamp-1 fw-medium">
                                                        Popped Rice Special Chocolate
                                                    </h3>
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-muted">$250</del>
                                                        <span class="text-accent">$150</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-single-pos-item card border-0 active-item">
                                                <div class="img-left me-2">
                                                    <img src="assets/img/products/3.jpg" alt="products" class="img-fluid" />
                                                </div>
                                                <div class="d-flex flex-column p-2">
                                                    <h3 class="fs-sm mb-1 tt-line-clamp tt-clamp-1 fw-medium">
                                                        Popped Rice Special Chocolate
                                                    </h3>
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-muted">$250</del>
                                                        <span class="text-accent">$150</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-single-pos-item card border-0" data-bs-toggle="modal" data-bs-target="#productVariation">
                                                <div class="img-left me-2">
                                                    <img src="assets/img/products/4.jpg" alt="products" class="img-fluid" />
                                                </div>
                                                <div class="d-flex flex-column p-2">
                                                    <h3 class="fs-sm mb-1 tt-line-clamp tt-clamp-1 fw-medium">
                                                        Popped Rice Special Chocolate
                                                    </h3>
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-muted">$250</del>
                                                        <span class="text-accent">$150</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-single-pos-item card border-0 active-item">
                                                <div class="img-left me-2">
                                                    <img src="assets/img/products/5.jpg" alt="products" class="img-fluid" />
                                                </div>
                                                <div class="d-flex flex-column p-2">
                                                    <h3 class="fs-sm mb-1 tt-line-clamp tt-clamp-1 fw-medium">
                                                        Popped Rice Special Chocolate
                                                    </h3>
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-muted">$250</del>
                                                        <span class="text-accent">$150</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-single-pos-item card border-0">
                                                <div class="img-left me-2">
                                                    <img src="assets/img/products/6.jpg" alt="products" class="img-fluid" />
                                                </div>
                                                <div class="d-flex flex-column p-2">
                                                    <h3 class="fs-sm mb-1 tt-line-clamp tt-clamp-1 fw-medium">
                                                        Popped Rice Special Chocolate
                                                    </h3>
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-muted">$250</del>
                                                        <span class="text-accent">$150</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-single-pos-item card border-0">
                                                <div class="img-left me-2">
                                                    <img src="assets/img/products/7.jpg" alt="products" class="img-fluid" />
                                                </div>
                                                <div class="d-flex flex-column p-2">
                                                    <h3 class="fs-sm mb-1 tt-line-clamp tt-clamp-1 fw-medium">
                                                        Popped Rice Special Chocolate
                                                    </h3>
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-muted">$250</del>
                                                        <span class="text-accent">$150</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-single-pos-item card border-0">
                                                <div class="img-left me-2">
                                                    <img src="assets/img/products/8.jpg" alt="products" class="img-fluid" />
                                                </div>
                                                <div class="d-flex flex-column p-2">
                                                    <h3 class="fs-sm mb-1 tt-line-clamp tt-clamp-1 fw-medium">
                                                        Popped Rice Special Chocolate
                                                    </h3>
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-muted">$250</del>
                                                        <span class="text-accent">$150</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--left sidebar end-->

                    <!--right sidebar start-->
                    <div class="col-12 col-lg-4">
                        <div class="bg-secondary border rounded-3 p-3 tt-pos-right h-100 d-flex flex-column">
                            <div class="row justify-content-between align-items-center g-2 mb-3">
                                <div class="col-auto flex-grow-1">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCustomer">
                                        <i data-feather="plus" class="icon-14"></i>
                                        New Order
                                    </button>
                                </div>
                                <div class="col-auto">
                                    <select class="form-select form-select-sm" aria-label="Small select example">
                                        <option selected="">Delivery Option</option>
                                        <option value="1">Dine In</option>
                                        <option value="2">Delivery</option>
                                        <option value="3">Pickup</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#selectTable"><i data-feather="octagon" class="me-1 icon-14"></i>Select Table</button>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#deliveryBoy"><i data-feather="truck" class="me-1 icon-14"></i>Select Delivery Boy</button>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-soft-danger btn-sm"><i data-feather="minus-circle" class="me-1 icon-14"></i>Cancel</button>
                                </div>
                            </div>

                            <div class="tt-pos-customer bg-light-subtle rounded p-2 px-3 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-md">
                                        <img class="rounded-circle" src="assets/img/avatar/2.jpg" alt="avatar" />
                                    </div>
                                    <div class="ms-2">
                                        <h6 class="mb-0 fs-md">Aminul Islam</h6>
                                        <span class="text-muted fs-sm">+0189 31234232</span>
                                    </div>
                                </div>
                            </div>

                            <div class="tt-pos-selected-items">
                                <h6><i data-feather="file-text" class="me-1 icon-16"></i>Order # 16</h6>
                                <div class="tt-pos-added-item" data-simplebar>
                                    <ul class="d-flex flex-column list-unstyled gap-2">
                                        <li class="card border-0 p-3 shadow-sm w-100">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <div>
                                                        <h3 class="fs-md mb-0 tt-line-clamp tt-clamp-1 fw-medium">
                                                            Popped Rice Special Chocolate
                                                        </h3>
                                                        <ul class="list-unstyled ps-0">
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Add-ons:</strong> Extra Cheese
                                                            </li>
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Variant:</strong> French Fries
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <button type="button" class="border-0 px-2 bg-transparent">
                                                        <i data-feather="trash-2" class="icon-16 text-danger"></i>
                                                    </button>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-body-secondary">$250</del>
                                                        <span>$150</span>
                                                    </div>
                                                    <div class="tt-num-block">
                                                        <div class="tt-num-input">
                                                            <span class="tt-minus tt-dis"></span>
                                                            <input type="text" class="tt-in-num fs-xs" value="1" readonly="" />
                                                            <span class="tt-plus"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="card border-0 p-3 shadow-sm w-100">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <div>
                                                        <h3 class="fs-md mb-0 tt-line-clamp tt-clamp-1 fw-medium">
                                                            Popped Rice Special Chocolate
                                                        </h3>
                                                        <ul class="list-unstyled ps-0">
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Add-ons:</strong> Extra Cheese
                                                            </li>
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Variant:</strong> French Fries
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <button type="button" class="border-0 px-2 bg-transparent">
                                                        <i data-feather="trash-2" class="icon-16 text-danger"></i>
                                                    </button>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-body-secondary">$250</del>
                                                        <span>$150</span>
                                                    </div>
                                                    <div class="tt-num-block">
                                                        <div class="tt-num-input">
                                                            <span class="tt-minus tt-dis"></span>
                                                            <input type="text" class="tt-in-num fs-xs" value="1" readonly="" />
                                                            <span class="tt-plus"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="card border-0 p-3 shadow-sm w-100">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <div>
                                                        <h3 class="fs-md mb-0 tt-line-clamp tt-clamp-1 fw-medium">
                                                            Popped Rice Special Chocolate
                                                        </h3>
                                                        <ul class="list-unstyled ps-0">
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Add-ons:</strong> Extra Cheese
                                                            </li>
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Variant:</strong> French Fries
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <button type="button" class="border-0 px-2 bg-transparent">
                                                        <i data-feather="trash-2" class="icon-16 text-danger"></i>
                                                    </button>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-body-secondary">$250</del>
                                                        <span>$150</span>
                                                    </div>
                                                    <div class="tt-num-block">
                                                        <div class="tt-num-input">
                                                            <span class="tt-minus tt-dis"></span>
                                                            <input type="text" class="tt-in-num fs-xs" value="1" readonly="" />
                                                            <span class="tt-plus"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="card border-0 p-3 shadow-sm w-100">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <div>
                                                        <h3 class="fs-md mb-0 tt-line-clamp tt-clamp-1 fw-medium">
                                                            Popped Rice Special Chocolate
                                                        </h3>
                                                        <ul class="list-unstyled ps-0">
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Add-ons:</strong> Extra Cheese
                                                            </li>
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Variant:</strong> French Fries
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <button type="button" class="border-0 px-2 bg-transparent">
                                                        <i data-feather="trash-2" class="icon-16 text-danger"></i>
                                                    </button>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-body-secondary">$250</del>
                                                        <span>$150</span>
                                                    </div>
                                                    <div class="tt-num-block">
                                                        <div class="tt-num-input">
                                                            <span class="tt-minus tt-dis"></span>
                                                            <input type="text" class="tt-in-num fs-xs" value="1" readonly="" />
                                                            <span class="tt-plus"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="card border-0 p-3 shadow-sm w-100">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <div>
                                                        <h3 class="fs-md mb-0 tt-line-clamp tt-clamp-1 fw-medium">
                                                            Popped Rice Special Chocolate
                                                        </h3>
                                                        <ul class="list-unstyled ps-0">
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Add-ons:</strong> Extra Cheese
                                                            </li>
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Variant:</strong> French Fries
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <button type="button" class="border-0 px-2 bg-transparent">
                                                        <i data-feather="trash-2" class="icon-16 text-danger"></i>
                                                    </button>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-body-secondary">$250</del>
                                                        <span>$150</span>
                                                    </div>
                                                    <div class="tt-num-block">
                                                        <div class="tt-num-input">
                                                            <span class="tt-minus tt-dis"></span>
                                                            <input type="text" class="tt-in-num fs-xs" value="1" readonly="" />
                                                            <span class="tt-plus"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="card border-0 p-3 shadow-sm w-100">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <div>
                                                        <h3 class="fs-md mb-0 tt-line-clamp tt-clamp-1 fw-medium">
                                                            Popped Rice Special Chocolate
                                                        </h3>
                                                        <ul class="list-unstyled ps-0">
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Add-ons:</strong> Extra Cheese
                                                            </li>
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Variant:</strong> French Fries
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <button type="button" class="border-0 px-2 bg-transparent">
                                                        <i data-feather="trash-2" class="icon-16 text-danger"></i>
                                                    </button>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-body-secondary">$250</del>
                                                        <span>$150</span>
                                                    </div>
                                                    <div class="tt-num-block">
                                                        <div class="tt-num-input">
                                                            <span class="tt-minus tt-dis"></span>
                                                            <input type="text" class="tt-in-num fs-xs" value="1" readonly="" />
                                                            <span class="tt-plus"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="card border-0 p-3 shadow-sm w-100">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <div>
                                                        <h3 class="fs-md mb-0 tt-line-clamp tt-clamp-1 fw-medium">
                                                            Popped Rice Special Chocolate
                                                        </h3>
                                                        <ul class="list-unstyled ps-0">
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Add-ons:</strong> Extra Cheese
                                                            </li>
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Variant:</strong> French Fries
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <button type="button" class="border-0 px-2 bg-transparent">
                                                        <i data-feather="trash-2" class="icon-16 text-danger"></i>
                                                    </button>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-body-secondary">$250</del>
                                                        <span>$150</span>
                                                    </div>
                                                    <div class="tt-num-block">
                                                        <div class="tt-num-input">
                                                            <span class="tt-minus tt-dis"></span>
                                                            <input type="text" class="tt-in-num fs-xs" value="1" readonly="" />
                                                            <span class="tt-plus"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="card border-0 p-3 shadow-sm w-100">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <div>
                                                        <h3 class="fs-md mb-0 tt-line-clamp tt-clamp-1 fw-medium">
                                                            Popped Rice Special Chocolate
                                                        </h3>
                                                        <ul class="list-unstyled ps-0">
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Add-ons:</strong> Extra Cheese
                                                            </li>
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Variant:</strong> French Fries
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <button type="button" class="border-0 px-2 bg-transparent">
                                                        <i data-feather="trash-2" class="icon-16 text-danger"></i>
                                                    </button>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-body-secondary">$250</del>
                                                        <span>$150</span>
                                                    </div>
                                                    <div class="tt-num-block">
                                                        <div class="tt-num-input">
                                                            <span class="tt-minus tt-dis"></span>
                                                            <input type="text" class="tt-in-num fs-xs" value="1" readonly="" />
                                                            <span class="tt-plus"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="card border-0 p-3 shadow-sm w-100">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <div>
                                                        <h3 class="fs-md mb-0 tt-line-clamp tt-clamp-1 fw-medium">
                                                            Popped Rice Special Chocolate
                                                        </h3>
                                                        <ul class="list-unstyled ps-0">
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Add-ons:</strong> Extra Cheese
                                                            </li>
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Variant:</strong> French Fries
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <button type="button" class="border-0 px-2 bg-transparent">
                                                        <i data-feather="trash-2" class="icon-16 text-danger"></i>
                                                    </button>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-body-secondary">$250</del>
                                                        <span>$150</span>
                                                    </div>
                                                    <div class="tt-num-block">
                                                        <div class="tt-num-input">
                                                            <span class="tt-minus tt-dis"></span>
                                                            <input type="text" class="tt-in-num fs-xs" value="1" readonly="" />
                                                            <span class="tt-plus"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="card border-0 p-3 shadow-sm w-100">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <div>
                                                        <h3 class="fs-md mb-0 tt-line-clamp tt-clamp-1 fw-medium">
                                                            Popped Rice Special Chocolate
                                                        </h3>
                                                        <ul class="list-unstyled ps-0">
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Add-ons:</strong> Extra Cheese
                                                            </li>
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Variant:</strong> French Fries
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <button type="button" class="border-0 px-2 bg-transparent">
                                                        <i data-feather="trash-2" class="icon-16 text-danger"></i>
                                                    </button>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-body-secondary">$250</del>
                                                        <span>$150</span>
                                                    </div>
                                                    <div class="tt-num-block">
                                                        <div class="tt-num-input">
                                                            <span class="tt-minus tt-dis"></span>
                                                            <input type="text" class="tt-in-num fs-xs" value="1" readonly="" />
                                                            <span class="tt-plus"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="card border-0 p-3 shadow-sm w-100">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <div>
                                                        <h3 class="fs-md mb-0 tt-line-clamp tt-clamp-1 fw-medium">
                                                            Popped Rice Special Chocolate
                                                        </h3>
                                                        <ul class="list-unstyled ps-0">
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Add-ons:</strong> Extra Cheese
                                                            </li>
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Variant:</strong> French Fries
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <button type="button" class="border-0 px-2 bg-transparent">
                                                        <i data-feather="trash-2" class="icon-16 text-danger"></i>
                                                    </button>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-body-secondary">$250</del>
                                                        <span>$150</span>
                                                    </div>
                                                    <div class="tt-num-block">
                                                        <div class="tt-num-input">
                                                            <span class="tt-minus tt-dis"></span>
                                                            <input type="text" class="tt-in-num fs-xs" value="1" readonly="" />
                                                            <span class="tt-plus"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="card border-0 p-3 shadow-sm w-100">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <div>
                                                        <h3 class="fs-md mb-0 tt-line-clamp tt-clamp-1 fw-medium">
                                                            Popped Rice Special Chocolate
                                                        </h3>
                                                        <ul class="list-unstyled ps-0">
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Add-ons:</strong> Extra Cheese
                                                            </li>
                                                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                                                <strong>Variant:</strong> French Fries
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <button type="button" class="border-0 px-2 bg-transparent">
                                                        <i data-feather="trash-2" class="icon-16 text-danger"></i>
                                                    </button>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="heading-font fw-bold fs-sm">
                                                        <del class="text-body-secondary">$250</del>
                                                        <span>$150</span>
                                                    </div>
                                                    <div class="tt-num-block">
                                                        <div class="tt-num-input">
                                                            <span class="tt-minus tt-dis"></span>
                                                            <input type="text" class="tt-in-num fs-xs" value="1" readonly="" />
                                                            <span class="tt-plus"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="mt-auto">
                                <div class="tt-pos-calculation mb-3">
                                    <div class="tt-pos-cal">
                                        <p class="mb-0">Subtotal</p>
                                        <strong>$1258.00</strong>
                                    </div>
                                    <div class="tt-pos-cal">
                                        <p class="mb-0">Tax</p>
                                        <strong>$1258.00</strong>
                                    </div>
                                    <div class="tt-pos-cal tt-pos-discount">
                                        <p class="mb-0">Discount</p>
                                        <div class="d-flex align-items-center btn btn-sm" data-bs-toggle="modal" data-bs-target="#otherDiscount">
                                            <span><i data-feather="edit-3" class="me-1"></i></span>
                                            <strong>00</strong>
                                        </div>
                                    </div>
                                    <div class="tt-pos-cal">
                                        <p class="mb-0 fw-bold">Total</p>
                                        <strong>$1258.00</strong>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3 gap-2">
                                    <div class="col-auto flex-grow-1">
                                        <button class="btn btn-soft-dark w-100 btn-sm"><i data-feather="sun" class="icon-16 me-1"></i>Send to Kitchen</button>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-light w-100 btn-sm"><i data-feather="save" class="icon-16 me-1"></i>Send to Kitchen</button>
                                    </div>
                                </div>
                                <div class="tt-pos-payment mb-3">
                                    <div class="tt-single-pos-payment">
                                        <input type="radio" class="tt-custom-radio" name="tt-radio" id="cashPayment">
                                        <label for="cashPayment" class="tt-payment btn btn-sm btn-warning fw-semibold d-block"><i data-feather="briefcase" class="me-1 icon-14"></i> Cash</label>
                                    </div>
                                    <div class="tt-single-pos-payment">
                                        <input type="radio" class="tt-custom-radio" name="tt-radio" id="cardPayment">
                                        <label for="cardPayment" class="tt-payment btn btn-sm btn-success fw-semibold d-block" data-bs-toggle="modal" data-bs-target="#cardModal"><i data-feather="credit-card" class="me-1 icon-14"></i> Card</label>
                                    </div>
                                    <div class="tt-single-pos-payment">
                                        <input type="radio" class="tt-custom-radio" name="tt-radio" id="walletPayment">
                                        <label for="walletPayment" class="tt-payment btn btn-sm btn-dark fw-semibold d-block"><i data-feather="dollar-sign" class="me-1 icon-14"></i> Wallet</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--right sidebar end-->

                    <!-- add item by code modal start -->
                    <div class="modal fade" id="addItemCode" tabindex="-1" aria-labelledby="addItemCodeLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content p-4">
                                <div class="modal-header border-bottom-0 pb-0">
                                    <h2 class="modal-title h5" id="addItemCodeLabel">Enter/Scan Your Item Barcode</h1>
                                </div>
                                <div class="modal-body">
                                    <div class="tt-search-box">
                                        <div class="input-group">
                                            <span class="position-absolute top-50 start-0 translate-middle-y ms-2"> <i data-feather="search"></i></span>
                                            <input class="form-control rounded-start w-100" type="text" placeholder="Enter/scan your item barcode">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-start border-top-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Add This Item</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- add item by code modal end -->

                    <!-- product variation modal start -->
                    <div class="modal fade" id="productVariation" tabindex="-1" aria-labelledby="productVariationLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content p-3">
                                <div class="modal-header border-bottom-0 pb-0">
                                    <h2 class="modal-title h5" id="productVariationLabel">Select Your Variation</h1>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="fw-bold mb-0">Classic Chicken Pizza</h5>
                                        <button class="btn-close" aria-label="Close"></button>
                                    </div>

                                    <p class="fs-5 fw-semibold mt-2">Tk 275</p>
                                    <p class="text-muted">Topped with chicken, pizza sauce, cheese, capsicum & onion</p>

                                    <div class="variation-box">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fw-semibold">Variation</span>
                                            <span class="badge bg-light text-muted">Completed</span>
                                        </div>

                                        <div class="form-check">
                                            <div>
                                                <input class="form-check-input" type="radio" name="size" id="size6">
                                                <label class="form-check-label" for="size6">6"</label>
                                            </div>
                                            <span class="text-muted">Tk 160</span>
                                        </div>

                                        <div class="form-check">
                                            <div>
                                                <input class="form-check-input" type="radio" name="size" id="size9" checked>
                                                <label class="form-check-label" for="size9">9"</label>
                                            </div>
                                            <span class="text-muted">Tk 275</span>
                                        </div>

                                        <div class="form-check">
                                            <div>
                                                <input class="form-check-input" type="radio" name="size" id="size12">
                                                <label class="form-check-label" for="size12">12"</label>
                                            </div>
                                            <span class="text-muted">Tk 390</span>
                                        </div>
                                    </div>

                                    <div class="section-title d-flex align-items-center">
                                        Add Ons – 9" Pizza
                                        <span class="optional-label">Optional</span>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="cheeseAddon" checked>
                                        <label class="form-check-label d-flex justify-content-between w-100" for="cheeseAddon">
                                            <span>Cheese</span>
                                            <span class="text-muted">+ Tk 80</span>
                                        </label>
                                    </div>

                                    <div class="section-title d-flex align-items-center">
                                        Frequently bought together
                                        <span class="optional-label">Optional</span>
                                    </div>

                                    <div class="frequently-item">
                                        <div class="frequently-left">
                                            <input class="form-check-input me-2" type="checkbox" checked>
                                            <img src="https://i.imgur.com/VNwYFZW.jpg" alt="Hot Chicken Wings">
                                            <span>Hot Chicken Wings</span>
                                        </div>
                                        <span class="text-muted">+ Tk 160</span>
                                    </div>

                                    <div class="frequently-item">
                                        <div class="frequently-left">
                                            <input class="form-check-input me-2" type="checkbox" checked>
                                            <img src="https://i.imgur.com/FRbhnLf.jpg" alt="Crispy Fried Chicken">
                                            <span>Crispy Fried Chicken</span>
                                        </div>
                                        <span class="text-muted">+ Tk 120</span>
                                    </div>

                                    <div class="frequently-item">
                                        <div class="frequently-left">
                                            <input class="form-check-input me-2" type="checkbox" checked>
                                            <img src="https://i.imgur.com/DldC9bp.jpg" alt="Deep Dish Pizza">
                                            <span>Deep Dish Pizza</span>
                                        </div>
                                        <span class="text-muted">+ Tk 1,050</span>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-start border-top-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary">Add This Item</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product variation modal end -->

                    <!-- add customer modal start -->
                    <div class="modal fade" id="addCustomer" tabindex="-1" aria-labelledby="addCustomerLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content p-3">
                                <div class="modal-header border-bottom-0 pb-0">
                                    <h2 class="modal-title h6" id="addCustomerLabel">Existing Customer</h1>
                                </div>
                                <div class="modal-body mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="input-group">
                                            <select class="form-select form-select-sm">
                                                <option selected>Select or search existing customer</option>
                                                <option>Aminul</option>
                                                <option>Ahammed</option>
                                                <option>Ripon</option>
                                                <option>Saiful</option>
                                                <option>Faruk</option>
                                            </select>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-primary ms-2">Select</button>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <h2 class="modal-title h6 mb-3" id="addCustomerLabel">Add New Customer</h1>

                                        <form action="#">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <div class="mb-0">
                                                        <label for="customerName" class="form-label">Customer Name</label>
                                                        <input class="form-control form-control-sm" type="text" id="customerName" value="" placeholder="Name">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-0">
                                                        <label for="customerPhone" class="form-label">Phone Number</label>
                                                        <input class="form-control form-control-sm" type="text" id="customerPhone" value="" placeholder="Phone number">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                </div>
                                <div class="modal-footer justify-content-start border-top-0">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary btn-sm">Save Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- add customer modal end -->


                    <!-- select table modal start -->
                    <div class="modal fade" id="selectTable" tabindex="-1" aria-labelledby="selectTableLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content p-3">
                                <div class="modal-header border-bottom-0 pb-0">
                                    <h2 class="modal-title h5" id="addCustomerLabel">Available Table List</h1>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3 border-bottom">
                                        <strong>Floor One</strong>
                                        <small>Available table <strong>4</strong></small>
                                    </div>
                                    <div class="row g-2 row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-4">
                                        <div class="col">
                                            <div class="tt-table-item border rounded-3 p-2 cursor-pointer">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-0">Table- 1</h6>
                                                    <div><i data-feather="edit" class="me-1 icon-14"></i></div>
                                                </div>
                                                <span class="text-muted fs-sm">Available Seats <strong>6</strong></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-table-item border rounded-3 p-2 cursor-pointer">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-0">Table- 2</h6>
                                                    <div><i data-feather="edit" class="me-1 icon-14"></i></div>
                                                </div>
                                                <span class="text-muted fs-sm">Available Seats <strong>2</strong></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-table-item border rounded-3 p-2 cursor-pointer">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-0">Table- 3</h6>
                                                    <div><i data-feather="edit" class="me-1 icon-14"></i></div>
                                                </div>
                                                <span class="text-muted fs-sm">Available Seats <strong>5</strong></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-table-item border rounded-3 p-2 cursor-pointer">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-0">Table- 4</h6>
                                                    <div><i data-feather="edit" class="me-1 icon-14"></i></div>
                                                </div>
                                                <span class="text-muted fs-sm">Available Seats <strong>4</strong></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-table-item border rounded-3 p-2 cursor-pointer">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-0">Table- 5</h6>
                                                    <div><i data-feather="edit" class="me-1 icon-14"></i></div>
                                                </div>
                                                <span class="text-muted fs-sm">Available Seats <strong>6</strong></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-table-item border rounded-3 p-2 cursor-pointer">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-0">Table- 6</h6>
                                                    <div><i data-feather="edit" class="me-1 icon-14"></i></div>
                                                </div>
                                                <span class="text-muted fs-sm">Available Seats <strong>2</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3 border-bottom">
                                        <strong>Floor One</strong>
                                        <small>Available table <strong>6</strong></small>
                                    </div>
                                    <div class="row g-2 row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-4">
                                        <div class="col">
                                            <div class="tt-table-item border rounded-3 p-2 cursor-pointer">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-0">Table- 1</h6>
                                                    <div><i data-feather="edit" class="me-1 icon-14"></i></div>
                                                </div>
                                                <span class="text-muted fs-sm">Available Seats <strong>6</strong></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-table-item border rounded-3 p-2 cursor-pointer">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-0">Table- 2</h6>
                                                    <div><i data-feather="edit" class="me-1 icon-14"></i></div>
                                                </div>
                                                <span class="text-muted fs-sm">Available Seats <strong>2</strong></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-table-item border rounded-3 p-2 cursor-pointer">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-0">Table- 3</h6>
                                                    <div><i data-feather="edit" class="me-1 icon-14"></i></div>
                                                </div>
                                                <span class="text-muted fs-sm">Available Seats <strong>5</strong></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-table-item border rounded-3 p-2 cursor-pointer">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-0">Table- 4</h6>
                                                    <div><i data-feather="edit" class="me-1 icon-14"></i></div>
                                                </div>
                                                <span class="text-muted fs-sm">Available Seats <strong>4</strong></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-table-item border rounded-3 p-2 cursor-pointer">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-0">Table- 5</h6>
                                                    <div><i data-feather="edit" class="me-1 icon-14"></i></div>
                                                </div>
                                                <span class="text-muted fs-sm">Available Seats <strong>6</strong></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="tt-table-item border rounded-3 p-2 cursor-pointer">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-0">Table- 6</h6>
                                                    <div><i data-feather="edit" class="me-1 icon-14"></i></div>
                                                </div>
                                                <span class="text-muted fs-sm">Available Seats <strong>2</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- select table modal end -->

                    <!-- select delivery boy modal start -->
                    <div class="modal fade" id="deliveryBoy" tabindex="-1" aria-labelledby="deliveryBoyLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content p-3">
                                <div class="modal-header border-bottom-0 pb-0">
                                    <h2 class="modal-title h6" id="addCustomerLabel">Existing Customer</h1>
                                </div>
                                <div class="modal-body mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="input-group">
                                            <select class="form-select form-select-sm">
                                                <option selected>Select Existing Delivery Boy</option>
                                                <option>Aminul</option>
                                                <option>Ahammed</option>
                                                <option>Ripon</option>
                                                <option>Saiful</option>
                                                <option>Faruk</option>
                                            </select>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-primary ms-2">Select</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- select delivery boy modal end -->

                    <!-- coupon discount modal start -->
                    <div class="modal fade" id="couponDiscount" tabindex="-1" aria-labelledby="couponDiscountLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content p-4">
                                <div class="modal-header border-bottom-0 pb-0">
                                    <h2 class="modal-title h5" id="couponDiscountLabel">Inter Your Coupon</h1>
                                </div>
                                <div class="modal-body">
                                    <div class="input-group">
                                        <input class="form-control rounded-start w-100" type="text" placeholder="Enter your coupon">
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-start border-top-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Apply Coupon</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- coupon discount modal end -->

                    <!-- other discount modal start -->
                    <div class="modal fade" id="otherDiscount" tabindex="-1" aria-labelledby="otherDiscountLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content p-4">
                                <div class="modal-header border-bottom-0 pb-0">
                                    <h2 class="modal-title h5" id="otherDiscountLabel">Inter Your Disocunt</h1>
                                </div>
                                <div class="modal-body">
                                    <ul class="nav nav-underline tt-pos-discount-tab mb-2" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link py-0 ps-0 active" aria-current="page" href="#" id="percentage-home-tab" data-bs-toggle="pill" data-bs-target="#percentage-home" role="tab" aria-controls="percentage-home" aria-selected="true">Percentage</a>

                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link py-0 ps-0" href="#" id="fixed-tab" data-bs-toggle="pill" data-bs-target="#fixed" role="tab" aria-controls="fixed" aria-selected="false">Fixed</a>

                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="percentage-home" role="tabpanel" aria-labelledby="percentage-home-tab" tabindex="0">
                                            <div class="input-group">
                                                <input class="form-control rounded-start w-100" type="text" placeholder="Enter discount percentage amount">
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="fixed" role="tabpanel" aria-labelledby="fixed-tab" tabindex="0">
                                            <div class="input-group">
                                                <input class="form-control rounded-start w-100" type="text" placeholder="Enter discount amount">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-start border-top-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Apply Discount</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- other discount modal end -->

                    <!-- other discount modal start -->
                    <div class="modal fade" id="cardModal" tabindex="-1" aria-labelledby="cardModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content p-4">
                                <div class="modal-header border-bottom-0 pb-0">
                                    <h2 class="modal-title h5" id="cardModalLabel">Inter Your Disocunt</h1>
                                </div>
                                <div class="modal-body">
                                    <form action="#">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="mb-0">
                                                    <label for="customerName" class="form-label">Card Number</label>
                                                    <input class="form-control" type="number" id="customerName" value="" placeholder="Debit/Credit card number">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-9">
                                                <div class="mb-0">
                                                    <label for="customerPhone" class="form-label">Expiration</label>
                                                    <input class="form-control" type="date" id="customerPhone" value="" placeholder="Phone number">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-3">
                                                <div class="mb-0">
                                                    <label for="customerState" class="form-label">Card CVV</label>
                                                    <input class="form-control" type="text" id="customerState" value="" placeholder="State">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer justify-content-start border-top-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary">Apply Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- other discount modal end -->

                </div>
            </div>
        </section>
        <!-- /Pos Content -->
@endsection