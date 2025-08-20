@extends('layouts.default')

@section('title')
    {{ localize('User List') }}
@endsection

@section('breadcrumb')
@php
$breadcrumbItems = [
    ["href"  => route('list'),      "title" => "Users"],
    ["href"  => null,               "title" => "Add User"]
];
@endphp
<x-common.breadcumb :items="$breadcrumbItems" />
@endsection

@section('pageTitleButtons')
<div class="col-auto">
    <a href="#">
        <x-form.button type="button" color="light"><i data-feather="upload" class="icon-14 text-primary"></i>Import</x-form.button>
    </a>
</div>
<div class="col-auto">
    <x-form.button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"><i data-feather="plus"></i>Add Category</x-form.button>
</div>
<div class="col-auto">
    <div class="dropdown tt-tb-dropdown">
        <a class="btn btn-light" id="navbarDropdownUser" href="#!" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="true">
            More
            <i data-feather="more-vertical" class="ms-1 fs-sm"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end shadow">
            <a class="dropdown-item" href="javascript:void(0);">
                <i data-feather="edit-3" class="me-2"></i>Edit
            </a>
            <a class="dropdown-item" href="javascript:void(0);">
                <i data-feather="trash" class="me-2"></i>Delete
            </a>
            <a class="dropdown-item" href="javascript:void(0);">
                <i data-feather="eye" class="me-2"></i>View Details
            </a>
        </div>
    </div>
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
                        <div class="row g-3">
                            <div class="col-auto flex-grow-1">
                                <div class="tt-search-box w-auto">
                                    <div class="input-group">
                                        <span class="position-absolute top-50 start-0 translate-middle-y ms-2"> <i
                                                data-feather="search" class="icon-16"></i></span>
                                        <input class="form-control rounded-start form-control-sm" type="text" placeholder="Search...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="input-group">
                                    <select class="form-select form-select-sm">
                                        <option selected="">Select brand</option>
                                        <option>Apple</option>
                                        <option>Dell</option>
                                        <option>Samsung</option>
                                        <option>Lg Butterfly</option>
                                        <option>Sony Vivo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="input-group">
                                    <select class="form-select form-select-sm">
                                        <option selected="">Status</option>
                                        <option>Published</option>
                                        <option>Hidden</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-dark btn-sm">
                                    <i data-feather="search" class="icon-14"></i>
                                    Search
                                </button>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-secondary btn-sm">
                                    <i data-feather="sliders" class="icon-14"></i>
                                    Filter
                                </button>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-sm bttn-link text-decoration-underline">
                                    Advanced Search
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table tt-footable border rounded" data-use-parent-width="true">
                            <thead>
                                <tr class="bg-secondary-subtle">
                                    <th data-breakpoints="xs" data-type="number" class="text-center">S/L</th>
                                    <th>Product Name</th>
                                    <th>Brand</th>
                                    <th data-breakpoints="xs">Categories</th>
                                    <th data-breakpoints="xs sm">Price</th>
                                    <th data-breakpoints="xs sm md">Published</th>
                                    <th data-breakpoints="xs sm md" class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>
                                        <a href="#" class="d-flex align-items-center">
                                            <div class="avatar avatar-sm">
                                                <img class="rounded-circle" src="assets/img/avatar/1.jpg" alt="avatar" />
                                            </div>
                                            <h6 class="fs-sm mb-0 ms-2">Almond Nut Dried fruit Oil</h6>
                                        </a>
                                    </td>
                                    <td>
                                        <span class="fs-sm">Grocery</span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-secondary">Foods</span>
                                        <span class="badge rounded-pill bg-secondary">Grocery</span>
                                        <span class="badge rounded-pill bg-secondary">Foods</span>
                                    </td>
                                    <td>
                                        <div class="tt-tb-price fs-sm fw-semibold">
                                            <span class="text-header">$15.50</span>
                                            <del class="text-muted">$25</del>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" name="switch" checked="">
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown tt-tb-dropdown">
                                            <button type="button" class="btn p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end shadow" style="">
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="edit-3" class="me-2"></i>Edit
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="trash" class="me-2"></i>Delete
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="eye" class="me-2"></i>View Details
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>
                                        <a href="#" class="d-flex align-items-center">
                                            <div class="avatar avatar-sm">
                                                <img class="rounded-circle" src="assets/img/avatar/2.jpg" alt="avatar" />
                                            </div>
                                            <h6 class="fs-sm mb-0 ms-2">Juice Apple Fruit Graphy</h6>
                                        </a>
                                    </td>
                                    <td>
                                        <span class="fs-sm">Grocery</span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-secondary">Foods</span>
                                        <span class="badge rounded-pill bg-secondary">Grocery</span>
                                        <span class="badge rounded-pill bg-secondary">Foods</span>
                                    </td>
                                    <td>
                                        <div class="tt-tb-price fs-sm fw-semibold">
                                            <span class="text-header">$355.50</span>
                                            <del class="text-muted">$375</del>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" name="switch" checked="">
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown tt-tb-dropdown">
                                            <button type="button" class="btn p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end shadow" style="">
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="edit-3" class="me-2"></i>Edit
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="trash" class="me-2"></i>Delete
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="eye" class="me-2"></i>View Details
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>
                                        <a href="#" class="d-flex align-items-center">
                                            <div class="avatar avatar-sm">
                                                <img class="rounded-circle" src="assets/img/avatar/3.jpg" alt="avatar" />
                                            </div>
                                            <h6 class="fs-sm mb-0 ms-2">Raw meat Food Grocery</h6>
                                        </a>
                                    </td>
                                    <td>
                                        <span class="fs-sm">Grocery</span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-secondary">Foods</span>
                                        <span class="badge rounded-pill bg-secondary">Grocery</span>
                                        <span class="badge rounded-pill bg-secondary">Foods</span>
                                    </td>
                                    <td>
                                        <div class="tt-tb-price fs-sm fw-semibold">
                                            <span class="text-header">$45.50</span>
                                            <del class="text-muted">$75</del>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" name="switch">
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown tt-tb-dropdown">
                                            <button type="button" class="btn p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end shadow" style="">
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="edit-3" class="me-2"></i>Edit
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="trash" class="me-2"></i>Delete
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="eye" class="me-2"></i>View Details
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td>
                                        <a href="#" class="d-flex align-items-center">
                                            <div class="avatar avatar-sm">
                                                <img class="rounded-circle" src="assets/img/avatar/4.jpg" alt="avatar" />
                                            </div>
                                            <h6 class="fs-sm mb-0 ms-2">Sour Cherry Sweetness Food </h6>
                                        </a>
                                    </td>
                                    <td>
                                        <span class="fs-sm">Grocery</span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-secondary">Foods</span>
                                        <span class="badge rounded-pill bg-secondary">Grocery</span>
                                        <span class="badge rounded-pill bg-secondary">Foods</span>
                                    </td>
                                    <td>
                                        <div class="tt-tb-price fs-sm fw-semibold">
                                            <span class="text-header">$255.50</span>
                                            <del class="text-muted">$25</del>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" name="switch" checked="">
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown tt-tb-dropdown">
                                            <button type="button" class="btn p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end shadow" style="">
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="edit-3" class="me-2"></i>Edit
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="trash" class="me-2"></i>Delete
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="eye" class="me-2"></i>View Details
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>
                                        <a href="#" class="d-flex align-items-center">
                                            <div class="avatar avatar-sm">
                                                <img class="rounded-circle" src="assets/img/avatar/2.jpg" alt="avatar" />
                                            </div>
                                            <h6 class="fs-sm mb-0 ms-2">Juice Apple Fruit Graphy</h6>
                                        </a>
                                    </td>
                                    <td>
                                        <span class="fs-sm">Grocery</span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-secondary">Foods</span>
                                        <span class="badge rounded-pill bg-secondary">Grocery</span>
                                        <span class="badge rounded-pill bg-secondary">Foods</span>
                                    </td>
                                    <td>
                                        <div class="tt-tb-price fs-sm fw-semibold">
                                            <span class="text-header">$355.50</span>
                                            <del class="text-muted">$375</del>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" name="switch" checked="">
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown tt-tb-dropdown">
                                            <button type="button" class="btn p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end shadow" style="">
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="edit-3" class="me-2"></i>Edit
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="trash" class="me-2"></i>Delete
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="eye" class="me-2"></i>View Details
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>
                                        <a href="#" class="d-flex align-items-center">
                                            <div class="avatar avatar-sm">
                                                <img class="rounded-circle" src="assets/img/avatar/3.jpg" alt="avatar" />
                                            </div>
                                            <h6 class="fs-sm mb-0 ms-2">Raw meat Food Grocery</h6>
                                        </a>
                                    </td>
                                    <td>
                                        <span class="fs-sm">Grocery</span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-secondary">Foods</span>
                                        <span class="badge rounded-pill bg-secondary">Grocery</span>
                                        <span class="badge rounded-pill bg-secondary">Foods</span>
                                    </td>
                                    <td>
                                        <div class="tt-tb-price fs-sm fw-semibold">
                                            <span class="text-header">$45.50</span>
                                            <del class="text-muted">$75</del>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" name="switch">
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown tt-tb-dropdown">
                                            <button type="button" class="btn p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end shadow" style="">
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="edit-3" class="me-2"></i>Edit
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="trash" class="me-2"></i>Delete
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="eye" class="me-2"></i>View Details
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td>
                                        <a href="#" class="d-flex align-items-center">
                                            <div class="avatar avatar-sm">
                                                <img class="rounded-circle" src="assets/img/avatar/4.jpg" alt="avatar" />
                                            </div>
                                            <h6 class="fs-sm mb-0 ms-2">Sour Cherry Sweetness Food </h6>
                                        </a>
                                    </td>
                                    <td>
                                        <span class="fs-sm">Grocery</span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-secondary">Foods</span>
                                        <span class="badge rounded-pill bg-secondary">Grocery</span>
                                        <span class="badge rounded-pill bg-secondary">Foods</span>
                                    </td>
                                    <td>
                                        <div class="tt-tb-price fs-sm fw-semibold">
                                            <span class="text-header">$255.50</span>
                                            <del class="text-muted">$25</del>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" name="switch" checked="">
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown tt-tb-dropdown">
                                            <button type="button" class="btn p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end shadow" style="">
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="edit-3" class="me-2"></i>Edit
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="trash" class="me-2"></i>Delete
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="eye" class="me-2"></i>View Details
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>
                                        <a href="#" class="d-flex align-items-center">
                                            <div class="avatar avatar-sm">
                                                <img class="rounded-circle" src="assets/img/avatar/2.jpg" alt="avatar" />
                                            </div>
                                            <h6 class="fs-sm mb-0 ms-2">Juice Apple Fruit Graphy</h6>
                                        </a>
                                    </td>
                                    <td>
                                        <span class="fs-sm">Grocery</span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-secondary">Foods</span>
                                        <span class="badge rounded-pill bg-secondary">Grocery</span>
                                        <span class="badge rounded-pill bg-secondary">Foods</span>
                                    </td>
                                    <td>
                                        <div class="tt-tb-price fs-sm fw-semibold">
                                            <span class="text-header">$355.50</span>
                                            <del class="text-muted">$375</del>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" name="switch" checked="">
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown tt-tb-dropdown">
                                            <button type="button" class="btn p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end shadow" style="">
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="edit-3" class="me-2"></i>Edit
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="trash" class="me-2"></i>Delete
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="eye" class="me-2"></i>View Details
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>
                                        <a href="#" class="d-flex align-items-center">
                                            <div class="avatar avatar-sm">
                                                <img class="rounded-circle" src="assets/img/avatar/3.jpg" alt="avatar" />
                                            </div>
                                            <h6 class="fs-sm mb-0 ms-2">Raw meat Food Grocery</h6>
                                        </a>
                                    </td>
                                    <td>
                                        <span class="fs-sm">Grocery</span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-secondary">Foods</span>
                                        <span class="badge rounded-pill bg-secondary">Grocery</span>
                                        <span class="badge rounded-pill bg-secondary">Foods</span>
                                    </td>
                                    <td>
                                        <div class="tt-tb-price fs-sm fw-semibold">
                                            <span class="text-header">$45.50</span>
                                            <del class="text-muted">$75</del>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" name="switch">
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown tt-tb-dropdown">
                                            <button type="button" class="btn p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end shadow" style="">
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="edit-3" class="me-2"></i>Edit
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="trash" class="me-2"></i>Delete
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="eye" class="me-2"></i>View Details
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td>
                                        <a href="#" class="d-flex align-items-center">
                                            <div class="avatar avatar-sm">
                                                <img class="rounded-circle" src="assets/img/avatar/4.jpg" alt="avatar" />
                                            </div>
                                            <h6 class="fs-sm mb-0 ms-2">Sour Cherry Sweetness Food </h6>
                                        </a>
                                    </td>
                                    <td>
                                        <span class="fs-sm">Grocery</span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-secondary">Foods</span>
                                        <span class="badge rounded-pill bg-secondary">Grocery</span>
                                        <span class="badge rounded-pill bg-secondary">Foods</span>
                                    </td>
                                    <td>
                                        <div class="tt-tb-price fs-sm fw-semibold">
                                            <span class="text-header">$255.50</span>
                                            <del class="text-muted">$25</del>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" name="switch" checked="">
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown tt-tb-dropdown">
                                            <button type="button" class="btn p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end shadow" style="">
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="edit-3" class="me-2"></i>Edit
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="trash" class="me-2"></i>Delete
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i data-feather="eye" class="me-2"></i>View Details
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row g-2 g-md-4 align-items-center">
                            <div class="col-md-2">
                                <div class="d-flex align-items-center">
                                    <span class="d-block flex-shrink-0">
                                        Per Page
                                    </span>
                                    <select class="form-select table-pagination-select">
                                        <option selected>6</option>
                                        <option value="1">10</option>
                                        <option value="2">15</option>
                                        <option value="3">20</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="d-flex flex-wrap justify-content-md-end align-items-center g-2 g-md-4">
                                    <span class="d-inline-block">
                                        Showing 1-15 of 37 results
                                    </span>
                                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <span data-feather="chevron-left"></span>
                                                </a>
                                            </li>
                                            <li class="page-item d-sm-none"><span
                                                    class="page-link page-link-static">2 /
                                                    5</span></li>
                                            <li class="page-item d-none d-sm-block"><a class="page-link" href="#">1</a>
                                            </li>
                                            <li class="page-item active d-none d-sm-block" aria-current="page"><span
                                                    class="page-link">2<span
                                                        class="visually-hidden">(current)</span></span>
                                            </li>
                                            <li class="page-item d-none d-sm-block"><a class="page-link" href="#">3</a>
                                            </li>
                                            <li class="page-item d-none d-sm-block"><a class="page-link" href="#">4</a>
                                            </li>
                                            <li class="page-item d-none d-sm-block"><a class="page-link" href="#">5</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Next">
                                                    <span data-feather="chevron-right"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Page Content  -->

<!-- offcanvas right start-->
<!-- Offcanvas -->
<div class="offcanvas offcanvas-end" id="offcanvasRight" data-bs-backdrop="static" tabindex="-1">
    <div class="offcanvas-header border-bottom py-3">
        <h5 class="offcanvas-title">Add New Product</h5>
        <span class="tt-close-btn" data-bs-dismiss="offcanvas">
        <i data-feather="x"></i>
    </span>
    </div>
    <div class="offcanvas-body tt-custom-scrollbar">
        <fieldset class="form-group-card mb-4">
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" id="productName" placeholder="Enter Product Name">
            </div>
            <div class="mb-3">
                <label for="productSummary" class="form-label">Summary</label>
                <textarea class="form-control" id="productSummary" rows="3" placeholder="Description"></textarea>
            </div>
            <div class="summer-note mb-3">
                <label class="form-label">Description</label>
                <div id="productDescription"></div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">
                        Categories
                        <span class="text-danger">*</span>
                    </label>
                    <select class="form-select form-select-transparent form-select--sm">
                        <option selected>Home Appliances</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">
                        Brand
                        <span class="text-danger">*</span>
                    </label>
                    <select class="form-select form-select-transparent form-select--sm">
                        <option selected>Samsung</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
        </fieldset>

        <fieldset class="form-group-card mb-4">
            <legend class="form-group-card__title">Basic Information</legend>
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" id="productName" placeholder="Enter Product Name">
            </div>
            <div class="mb-3">
                <label for="productSummary" class="form-label">Summary</label>
                <textarea class="form-control" id="productSummary" rows="3" placeholder="Description"></textarea>
            </div>
            <div class="summer-note mb-3">
                <label class="form-label">Description</label>
                <div id="productDescription"></div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">
                        Categories
                        <span class="text-danger">*</span>
                    </label>
                    <select class="form-select form-select-transparent form-select--sm">
                        <option selected>Home Appliances</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">
                        Brand
                        <span class="text-danger">*</span>
                    </label>
                    <select class="form-select form-select-transparent form-select--sm">
                        <option selected>Samsung</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
        </fieldset>

        <fieldset class="form-group-card mb-4">
            <legend class="form-group-card__title">Product Images</legend>
            <div class="mb-3">
                <label for="productName" class="form-label">
                    Gallery
                </label>
                <input type="file" class="form-control form-control-sm">
            </div>
            <div class="file-drop-area file-upload text-center rounded-3 py-5">
                <input type="file" class="file-drop-input" name="dp" />
                <p class="clr-placeholder text-decoration-underline">Choose Product images</p>
                <span
            class="d-grid w-12 h-12 rounded-cricle place-content-center lh-1 bg-admin-light clr-placeholder rounded-circle mx-auto">
            <span class="material-symbols-rounded fs-24">
            add
            </span>
                </span>
            </div>
        </fieldset>

        <fieldset class="form-group-card mb-4">
            <legend class="form-group-card__title">Price, Sku & Stock</legend>
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-check form-switch d-flex justify-content-end gap-2">
                        <input id="hasVariant" class="form-check-input" type="checkbox" role="switch">
                        <label for="hasVariant" class="d-inline-block">
                            Has Variations?
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="inputPrice" class="form-label">
                        Price <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control form-control-sm" id="inputPrice" value="$500">
                </div>
                <div class="col-md-4">
                    <label for="inputStock" class="form-label">
                        Stock <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control form-control-sm" id="inputStock" value="2">
                </div>
                <div class="col-md-4">
                    <label for="productSKU" class="form-label">
                        SKU <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control form-control-sm" id="productSKU" value="23432">
                </div>
            </div>
        </fieldset>

        <fieldset class="form-group-card mb-4">
            <legend class="form-group-card__title">Product Discount</legend>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="dateRange" class="form-label">Date Range</label>
                    <input type="date" class="form-control form-control-sm" id="dateRange">
                </div>
                <div class="col-md-4">
                    <label for="discount" class="form-label">Discount</label>
                    <input type="text" class="form-control form-control-sm" id="discount" value="0">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Percent or Fixed</label>
                    <select class="form-select form-select-sm">
                        <option selected>5%</option>
                        <option value="1">10%</option>
                        <option value="2">15%</option>
                        <option value="3">20%</option>
                    </select>
                </div>
            </div>
        </fieldset>

        <fieldset class="form-group-card mb-4">
            <legend class="form-group-card__title">Shipping Configuration</legend>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="minPurchaseQty" class="form-label">
                        Minimum Purchase Qty
                    </label>
                    <input type="text" class="form-control form-control-sm" id="minPurchaseQty" value="01">
                </div>
                <div class="col-md-6">
                    <label for="maxPriceQty" class="form-label">
                        Maximum Purchase Qty
                    </label>
                    <input type="text" class="form-control form-control-sm" id="maxPriceQty" value="10">
                </div>
            </div>
        </fieldset>

        <fieldset class="form-group-card mb-4">
            <legend class="form-group-card__title">SEO Meta Configuration</legend>
            <div class="row g-3">
                <div class="col-12">
                    <label for="minPurchaseQty" class="form-label">
                        Meta Title <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control form-control-sm" id="minPurchaseQty" placeholder="Meta Title">
                </div>
                <div class="col-12">
                    <label for="metaDescription" class="form-label">
                        Meta Description <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control" id="metaDescription" rows="3" placeholder="Type your meta discriptions"></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label d-block">
                        SEO Meta Configuration
                    </label>
                    <span class="d-block fs-12 margin-bottom-1">
            Set a status for your product to determine whether your product is displayed or not
            </span>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch">
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="offcanvas-footer border-top">
        <div class="d-flex gap-3">
            <button class="btn btn-primary">Offcanvas Button</button>
            <button class="btn btn-success">Offcanvas Button</button>
        </div>
    </div>
</div> <!-- offcanvas right end-->

<!-- Add Product Offcanvas -->
<div class="sidecanvas">
    <div class="sidecanvas__header offcanvas-lg d-flex justify-content-between align-items-center gap-4">
        <h4 class="mb-0">Product Information</h4>
        <button class="sidecanvas-toggler btn btn-danger btn-sm btn-icon flex-shrink-0 rounded-circle text-white">
            <span class="material-symbols-rounded fs-18">
                close
            </span>
        </button>
    </div>
    <div class="offcanvas-body">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <span class="d-block fw-medium flex-grow-1">
                Basic Information
            </span>
            <div class="d-flex justify-content-end gap-2 flex-shrink-0">
                <button type="button" class="btn bttn--action w-8 h-8 clr-primary">
                    <span class="material-symbols-rounded fs-20">
                        autorenew
                    </span>
                </button>
                <button type="button" class="btn bttn--action w-8 h-8 clr-primary">
                    <span class="material-symbols-rounded fs-20">
                        save
                    </span>
                </button>
            </div>
        </div>
        <fieldset class="form-group-card mb-5">
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name <span class="text-primary">*</span></label>
                <input type="text" class="form-control form-control-sm" id="productName" placeholder="Enter Product Name">
            </div>
            <div class="mb-3">
                <label for="productSummary" class="form-label">Summary</label>
                <textarea class="form-control" id="productSummary" rows="3" placeholder="Description"></textarea>
            </div>
            <div class="summer-note mb-3">
                <label class="form-label">Description</label>
                <div id="productDescription"></div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">
                        Categories
                        <span class="text-primary">*</span>
                    </label>
                    <select class="form-select form-select-transparent form-select--sm">
                        <option selected>Home Appliances</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">
                        Brand
                        <span class="text-primary">*</span>
                    </label>
                    <select class="form-select form-select-transparent form-select--sm">
                        <option selected>Samsung</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
        </fieldset>

        <fieldset class="form-group-card mb-5">
            <legend class="form-group-card__title">Basic Information</legend>
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name <span class="text-primary">*</span></label>
                <input type="text" class="form-control form-control-sm" id="productName" placeholder="Enter Product Name">
            </div>
            <div class="mb-3">
                <label for="productSummary" class="form-label">Summary</label>
                <textarea class="form-control" id="productSummary" rows="3" placeholder="Description"></textarea>
            </div>
            <div class="summer-note mb-3">
                <label class="form-label">Description</label>
                <div id="productDescription"></div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">
                        Categories
                        <span class="text-primary">*</span>
                    </label>
                    <select class="form-select form-select-transparent form-select--sm">
                        <option selected>Home Appliances</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">
                        Brand
                        <span class="text-primary">*</span>
                    </label>
                    <select class="form-select form-select-transparent form-select--sm">
                        <option selected>Samsung</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
        </fieldset>

        <fieldset class="form-group-card mb-5">
            <legend class="form-group-card__title">Product Images</legend>
            <div class="mb-3">
                <label for="productName" class="form-label">
                    Gallery
                </label>
                <input type="file" class="form-control form-control-sm">
            </div>
            <div class="file-drop-area file-upload text-center rounded-3 py-5">
                <input type="file" class="file-drop-input" name="dp" />
                <p class="clr-placeholder text-decoration-underline">Choose Product images</p>
                <span
                    class="d-grid w-12 h-12 rounded-cricle place-content-center lh-1 bg-admin-light clr-placeholder rounded-circle mx-auto">
                    <span class="material-symbols-rounded fs-24">
                        add
                    </span>
                </span>
            </div>
        </fieldset>

        <fieldset class="form-group-card mb-5">
            <legend class="form-group-card__title">Price, Sku & Stock</legend>
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-check form-switch d-flex justify-content-end gap-2">
                        <input id="hasVariant" class="form-check-input" type="checkbox" role="switch">
                        <label for="hasVariant" class="d-inline-block">
                            Has Variations?
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="inputPrice" class="form-label">
                        Price <span class="text-primary">*</span>
                    </label>
                    <input type="text" class="form-control form-control-sm" id="inputPrice" value="$500">
                </div>
                <div class="col-md-4">
                    <label for="inputStock" class="form-label">
                        Stock <span class="text-primary">*</span>
                    </label>
                    <input type="text" class="form-control form-control-sm" id="inputStock" value="2">
                </div>
                <div class="col-md-4">
                    <label for="productSKU" class="form-label">
                        SKU <span class="text-primary">*</span>
                    </label>
                    <input type="text" class="form-control form-control-sm" id="productSKU" value="23432">
                </div>
            </div>
        </fieldset>

        <fieldset class="form-group-card mb-5">
            <legend class="form-group-card__title">Product Discount</legend>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="dateRange" class="form-label">Date Range</label>
                    <input type="date" class="form-control form-control-sm" id="dateRange">
                </div>
                <div class="col-md-4">
                    <label for="discount" class="form-label">Discount</label>
                    <input type="text" class="form-control form-control-sm" id="discount" value="0">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Percent or Fixed</label>
                    <select class="form-select form-select-sm">
                        <option selected>5%</option>
                        <option value="1">10%</option>
                        <option value="2">15%</option>
                        <option value="3">20%</option>
                    </select>
                </div>
            </div>
        </fieldset>

        <fieldset class="form-group-card mb-5">
            <legend class="form-group-card__title">Shipping Configuration</legend>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="minPurchaseQty" class="form-label">
                        Minimum Purchase Qty
                    </label>
                    <input type="text" class="form-control form-control-sm" id="minPurchaseQty" value="01">
                </div>
                <div class="col-md-6">
                    <label for="maxPriceQty" class="form-label">
                        Maximum Purchase Qty
                    </label>
                    <input type="text" class="form-control form-control-sm" id="maxPriceQty" value="10">
                </div>
            </div>
        </fieldset>

        <fieldset class="form-group-card mb-5">
            <legend class="form-group-card__title">SEO Meta Configuration</legend>
            <div class="row g-3">
                <div class="col-12">
                    <label for="minPurchaseQty" class="form-label">
                        Meta Title <span class="text-primary">*</span>
                    </label>
                    <input type="text" class="form-control form-control-sm" id="minPurchaseQty" placeholder="Meta Title">
                </div>
                <div class="col-12">
                    <label for="metaDescription" class="form-label">
                        Meta Description <span class="text-primary">*</span>
                    </label>
                    <textarea class="form-control" id="metaDescription" rows="3" placeholder="Type your meta discriptions"></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label d-block">
                        SEO Meta Configuration
                    </label>
                    <span class="d-block fs-12 margin-bottom-1">
                        Set a status for your product to determine whether your product is displayed or not
                    </span>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch">
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="sidecanvas__footer">
        <div class="d-flex align-items-center gap-2 gap-sm-4 flex-wrap">
            <button class="btn btn-sm btn-primary">
                Create Content
            </button>
            <button class="btn btn-sm bttn-light">
                Stop Generation
            </button>
        </div>
    </div>
</div>
<!-- /Add Product Offcanvas -->
@endsection
