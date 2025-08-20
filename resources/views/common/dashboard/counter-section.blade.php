<div class="row g-3 mb-3">
    <div class="col-lg-3 col-sm-6">
        <div class="card h-100 flex-column">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-lg">
                        <div class="text-center bg-soft-primary rounded-circle">
                            <span class="text-primary"> <i data-feather="shopping-bag"></i></span>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h4 class="mb-1">{{ $totalOrderCount }}</h4>
                        <span class="text-muted">{{ localize("Total Orders") }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card h-100 flex-column">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-lg">
                        <div class="text-center bg-soft-warning rounded-circle">
                            <span class="text-warning"> <i data-feather="refresh-cw"></i></span>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h4 class="mb-1">{{ $pendingOrderCount }}</h4>
                        <span class="text-muted">{{ localize("Pending Orders") }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card h-100 flex-column">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-lg">
                        <div class="text-center bg-soft-info rounded-circle">
                            <span class="text-info"> <i data-feather="truck"></i></span>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h4 class="mb-1">{{ $processingOrderCount }}</h4>
                        <span class="text-muted">{{ localize("Hold Orders") }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card h-100 flex-column">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-lg">
                        <div class="text-center bg-soft-success rounded-circle">
                            <span class="text-success"> <i data-feather="check-circle"></i></span>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h4 class="mb-1">{{ $completedOrderCount }}</h4>
                        <span class="text-muted">{{ localize("Total Completed") }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>