
<div class="row g-3 mb-3">
    <div class="col-xl-12">
        <div class="row g-3">
            {{-- total earning chart --}}
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="card h-100 flex-column">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="text-muted">{{ localize('Total Earning') }}</span>
                            <div class="dropdown tt-tb-dropdown fs-sm">
                                <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    @if (isset($timelineText))
                                        {{ $timelineText }}
                                    @else
                                        {{ localize('Last 7 days') }}
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-end shadow">
                                    <a class="dropdown-item"
                                        href="{{ route('dashboard') }}">{{ localize('Last 7 days') }}</a>
                                    <a class="dropdown-item"
                                        href="{{ route('dashboard') }}?&timeline=30">{{ localize('Last 30 days') }}</a>
                                    <a class="dropdown-item"
                                        href="{{ route('dashboard') }}?&timeline=90">{{ localize('Last 3 months') }}</a>
                                </div>
                            </div>
                        </div>
                        <h4 class="fw-bold">{{ formatPrice($totalEarning) }}</h4>
                    </div>
                    <div id="totalSales"></div>
                </div>
            </div>
            {{-- total earning chart ends --}}

            {{-- top 5 product chart --}}
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="card h-100 flex-column">
                    <div class="card-body d-flex flex-column h-100">
                        <span class="text-muted">{{ localize('Top 5 Category Sales') }}</span>
                        <h4 class="fw-bold">{{ $totalCatSalesData->totalCategorySalesCount }}</h4>
                        <div id="topFive"></div>
                    </div>
                </div>
            </div>
            {{-- top 5 product chart ends --}}


            {{-- last 30days orders --}}
            <div class="col-sm-6 col-md-4 col-lg-4 d-none d-lg-block d-md-block">
                <div class="card h-100 flex-column">
                    <div class="card-body">
                        <span class="text-muted">{{ localize('Last 30 Days Orders') }}</span>
                        <h4 class="fw-bold">{{ $totalOrdersData->totalOrders }}</h4>
                    </div>
                    <div id="last30DaysOrders"></div>
                </div>
            </div>
            {{-- last 30days orders ends --}}

            {{-- this month chart --}}
            <div class="col-l2">
                <div class="card">
                    <div class="card-body pb-0">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="text-muted">{{ localize('Sales This Months') }}</span>
                        </div>
                        <h4 class="fw-bold mb-0">{{ formatPrice($thisMonthSaleData->totalEarning) }}</h4>
                    </div>
                    <div id="thisMonthChart" class="px-3"></div>
                </div>
            </div>
            {{-- this month chart ends --}}
        </div>
    </div>
</div>