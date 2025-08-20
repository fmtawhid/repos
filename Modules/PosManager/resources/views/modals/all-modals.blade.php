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
