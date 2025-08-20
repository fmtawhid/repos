
@if(isVendor())
    <li class="side-nav-item nav-item mb-2">
        <label for="" class="text-left w-100 px-2">{{ localize("Select Branch") }}</label>
        <select class="form-select side-nav-link updateUserBranch" id="select-input2">
            @forelse(getBranchesByVendorId(getUserParentId()) as $branch)
                <option value="{{ $branch->id }}" @selected($branch->id == getUserBranchId())>{{ $branch->name }}</option>
            @empty
            @endforelse
        </select>
    </li>
@endif

@php
    $dashboardRoutes = [
        'admin.dashboard'
    ]
@endphp

@if (isMenuGroupShow($dashboardRoutes))
    @if (isRouteExists('admin.dashboard'))
        <li class="side-nav-item nav-item">
            <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                <span class="tt-nav-link-icon">
                    <span data-feather="home" class="icon-14"></span>
                </span>
                <span class="tt-nav-link-text">{{ localize('Dashboard') }}</span>
            </a>
        </li>
    @endif
@endif

@php
    $subscriptionRoutes = [
        "admin.availablePlans",
        'admin.subscription-plans.index',
        'admin.plan-histories.index',
        'admin.subscription-settings.index',
        'admin.plan-histories.show'
    ];
@endphp

@if (isMenuGroupShow($subscriptionRoutes))
    <li class="side-nav-item nav-item ">
        <a data-bs-toggle="collapse" href="#subscriptions" aria-expanded="false"
           class="side-nav-link tt-menu-toggle">
            <span class="tt-nav-link-icon">
                <span data-feather="zap" class="icon-14"></span>
            </span>
            <span class="tt-nav-link-text">{{ localize('Subscriptions') }}</span>

        </a>
        <div class="collapse" id="subscriptions">
            <ul class="side-nav-second-level">
                @if (isRouteExists('admin.availablePlans'))
                    <li> <a
                            href="{{ route('admin.availablePlans') }}">{{ localize('Subscription Plan') }}</a>
                    </li>
                @endif
                @if (isRouteExists('admin.plan-histories.index'))
                    <li>
                        <a href="{{ route('admin.plan-histories.index') }}">{{ localize('Subscription History') }}</a>
                    </li>
                @endif
            </ul>
        </div>
    </li>
@endif


@php
    $dashboardRoutes = [
        'pos.dashboard'
    ];
@endphp

@if (isMenuGroupShow($dashboardRoutes))
    @if (isRouteExists('pos.dashboard'))
        <li class="side-nav-item nav-item">
            <a href="{{ route("pos.dashboard") }}" class="side-nav-link">
                <span class="tt-nav-link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid icon-14">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                </span>
                <span class="tt-nav-link-text">{{ localize('POS') }}</span>
            </a>
        </li>
    @endif
@endif

{{-- ================================= --}}
{{-- Menu Module Start --}}
{{-- ================================= --}}
@php
    $menuRoutes = [
        'admin.menus.index',
        'admin.item-categories.index',
        'admin.menu-items.index',
    ];
@endphp
@if (isMenuGroupShow($menuRoutes))
    <li class="side-nav-item nav-item ">
        <a data-bs-toggle="collapse" href="#menus" aria-expanded="false"
            class="side-nav-link tt-menu-toggle">
            <span class="tt-nav-link-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-octagon icon-14">
                    <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                </svg>
            </span>
            <span class="tt-nav-link-text">{{ localize('Menu') }}</span>
        </a>

        <div class="collapse" id="menus">
            <ul class="side-nav-second-level">
                @if (isRouteExists('admin.menus.index'))
                    <li>
                        <a href="{{ route('admin.menus.index') }}">{{ localize('Menus') }} </a>
                    </li>
                @endif

                @if (isRouteExists('admin.item-categories.index'))
                    <li>
                        <a href="{{ route('admin.item-categories.index') }}">{{ localize('Item Category') }}</a>
                    </li>
                @endif

                @if (isRouteExists('admin.menu-items.index'))
                    <li>
                        <a href="{{ route('admin.menu-items.index') }}">{{ localize('Menu Items') }}</a>
                    </li>
                @endif
            </ul>
        </div>
    </li>
@endif
{{-- ================================= --}}
{{-- Menu module End --}}
{{-- ================================= --}}




{{-- ================================= --}}
{{-- Table Module Start --}}
{{-- ================================= --}}
@php
    $tableModuleRoutes = [
        'admin.areas.index',
        'admin.tables.index',
        'admin.subscription-plans.index',
        'admin.plan-histories.index',
        'admin.subscription-settings.index',
        'admin.plan-histories.show'
    ];
@endphp
@if (isMenuGroupShow($tableModuleRoutes))
    <li class="side-nav-item nav-item ">
        <a data-bs-toggle="collapse" href="#table" aria-expanded="false"
            class="side-nav-link tt-menu-toggle">
            <span class="tt-nav-link-icon">
                <i data-feather="server" class="icon-14"></i>
            </span>
            <span class="tt-nav-link-text">{{ localize('Table') }}</span>
        </a>

        <div class="collapse" id="table">
            <ul class="side-nav-second-level">
                @if (isRouteExists('admin.areas.index'))
                    <li>
                        <a href="{{ route('admin.areas.index') }}">{{ localize('Areas') }} </a>
                    </li>
                @endif

                @if (isRouteExists('admin.tables.index'))
                    <li>
                        <a href="{{ route('admin.tables.index') }}">{{ localize('Tables') }}</a>
                    </li>
                @endif

                @if (isRouteExists('admin.qr-codes.index'))
                    <li>
                        <a href="{{ route('admin.qr-codes.index') }}">{{ localize('QR Codes') }}</a>
                    </li>
                @endif
            </ul>
        </div>
    </li>
@endif
{{-- ================================= --}}
{{-- Table module End --}}
{{-- ================================= --}}


{{-- ================================= --}}
{{-- Orders Module Start --}}
{{-- ================================= --}}
@php
    $kitchenOrderRoutes = [
        'admin.orders.index',
        'admin.kitchen_orders.index'
    ];
@endphp

@if (isMenuGroupShow($kitchenOrderRoutes))
    <li class="side-nav-item nav-item ">
        <a data-bs-toggle="collapse" href="#orders" aria-expanded="false"
            class="side-nav-link tt-menu-toggle">
            <span class="tt-nav-link-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell icon-14">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
            </span>
            <span class="tt-nav-link-text">{{ localize('Orders') }}</span>
        </a>

        <div class="collapse" id="orders">
            <ul class="side-nav-second-level">
                {{-- orders --}}
                @if (isRouteExists('admin.orders.index'))
                    <li>
                        <a href="{{ route('admin.orders.index') }}">{{ localize('orders') }} </a>
                    </li>
                @endif

                {{-- kitchen Orders --}}
                @if (isRouteExists('admin.kitchen_orders.index'))
                    <li>
                        <a href="{{ route('admin.kitchen_orders.index') }}">{{ localize('Kitche Orders') }}</a>
                    </li>
                @endif
            </ul>
        </div>
    </li>
@endif
{{-- Orders Module End --}}


{{-- ================================= --}}
{{--  Kitchen Start--}}
{{-- ================================= --}}
    @php
    $kitchenOrderRoutes = [
        'admin.kitchens.index',
    ];
@endphp

@if (isMenuGroupShow($kitchenOrderRoutes))
    @if (isRouteExists('admin.kitchens.index'))
        <li class="side-nav-item nav-item">
            <a href="{{ route('admin.kitchens.index') }}" class="side-nav-link">
                <span class="tt-nav-link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-watch icon-14">
                        <circle cx="12" cy="12" r="7"></circle>
                        <polyline points="12 9 12 12 13.5 13.5"></polyline>
                        <path d="M16.51 17.35l-.35 3.83a2 2 0 0 1-2 1.82H9.83a2 2 0 0 1-2-1.82l-.35-3.83m.01-10.7l.35-3.83A2 2 0 0 1 9.83 1h4.35a2 2 0 0 1 2 1.82l.35 3.83"></path>
                    </svg>
                </span>
                <span class="tt-nav-link-text">{{ localize('Kitchen') }}</span>
            </a>
        </li>
    @endif
@endif
{{-- ================================= --}}
{{--  Kitchen End--}}
{{-- ================================= --}}


{{-- ================================= --}}
{{--  Reservations Start--}}
{{-- ================================= --}}
@if (isRouteExists('reservationmanager.index'))
    <li class="side-nav-item nav-item">
        <a href="{{ route('reservationmanager.index') }}" class="side-nav-link">
            {{-- <span class="tt-nav-link-icon">
                <span data-feather="users" class="icon-14"></span>
            </span> --}}
            <span class="tt-nav-link-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar icon-14">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
            </span>
            <span class="tt-nav-link-text">{{ localize('Reservations') }}</span>
        </a>
    </li>
@endif
{{-- ================================= --}}
{{--  Reservations End--}}
{{-- ================================= --}}


{{-- ================================= --}}
{{-- Offerings start--}}
{{-- ================================= --}}
@php
    $userManagementRoutes = [
        'admin.branches.index',
    ];
@endphp


@if (isMenuGroupShow($userManagementRoutes))
    <li class="side-nav-title side-nav-item nav-item mt-4">
        <span class="tt-nav-title-text">{{ localize('OFFERINGS') }}</span>
    </li>

    @if (isRouteExists('admin.branches.index'))
        <li class="side-nav-item nav-item">
            <a href="{{ route('admin.branches.index') }}" class="side-nav-link">
                <span class="tt-nav-link-icon">
                    <span data-feather="map-pin" class="icon-14"></span>
                </span>
                <span class="tt-nav-link-text">{{ localize('Branches') }}</span>
            </a>
        </li>
    @endif

    @php
        $customersRoutes = ['admin.customers.index'];
    @endphp

    @if(isMenuGroupShow($customersRoutes))
        <li class="side-nav-item nav-item {{ areActiveRoutes(['admin.customers.index'], 'tt-menu-item-active') }}">
            <a href="{{ route('admin.customers.index') }}" class="side-nav-link">
                <span class="tt-nav-link-icon"><i data-feather="users"></i></span>
                <span class="tt-nav-link-text">{{ localize('Customers') }}</span>
            </a>
        </li>
    @endif
@endif

@php
    $roleManagements = ['admin.users.index', 'admin.roles.index'];
@endphp
@if (isMenuGroupShow($roleManagements))
    <li class="side-nav-item nav-item">
        <a data-bs-toggle="collapse" href="#userROleManagement" aria-expanded="false"
            class="side-nav-link tt-menu-toggle">
            <span class="tt-nav-link-icon">
                <span data-feather="user-check" class="icon-14"></span>
            </span>
            <span class="tt-nav-link-text">{{ localize('Vendor Staff') }}</span>
        </a>
        <div class="collapse" id="userROleManagement">
            <ul class="side-nav-second-level">
                @if (isRouteExists('admin.users.index'))
                    <li> <a href="{{ route('admin.users.index') }}">{{ localize('Staff') }}</a>
                    </li>
                @endif
                @if (isRouteExists('admin.roles.index'))
                    <li> <a href="{{ route('admin.roles.index') }}">{{ localize('Manage Roles') }}</a>
                    </li>
                @endif
            </ul>
        </div>
    </li>
@endif



{{-- ================================= --}}
{{-- Offerings end --}}
{{-- ================================= --}}

@php
    $supportoutes = [
        'admin.support-tickets.index',
        'admin.support-tickets.reply'
    ];
@endphp

@if (isMenuGroupShow($supportoutes))
    <li class="side-nav-title side-nav-item nav-item mt-4">
        <span class="tt-nav-title-text">{{ localize('Support') }}</span>
    </li>
    <li class="side-nav-item nav-item">
        <a data-bs-toggle="collapse" href="#supportTicketManagement" aria-expanded="false"
           class="side-nav-link tt-menu-toggle">
            <span class="tt-nav-link-icon">
                <span data-feather="headphones" class="icon-14"></span>
            </span>
            <span class="tt-nav-link-text">{{ localize('Support Ticket') }}</span>
        </a>
        <div class="collapse" id="supportTicketManagement">
            <ul class="side-nav-second-level">

                @if (isRouteExists('admin.support-tickets.index'))
                    <li> <a href="{{ route('admin.support-tickets.index') }}">{{ localize('Tickets') }}</a></li>
                @endif
            </ul>
        </div>
    </li>
@endif


<!-- Report -->
@php
    $reportRoutes = [
        'admin.reports.items',
        'admin.reports.items_category',
        'admin.reports.subscriptions',
        'admin.reports.sales',
    ];
@endphp
@if (isMenuGroupShow($reportRoutes))
    <!-- Report -->
    <li class="side-nav-item nav-item ">
        <a data-bs-toggle="collapse" href="#reports" aria-expanded="false"
            class="side-nav-link tt-menu-toggle">
            <span class="tt-nav-link-icon"><i data-feather="bar-chart" class="icon-14"></i></span>
            <span class="tt-nav-link-text">{{ localize('Reports') }}</span>
        </a>
        <div class="collapse" id="reports">
            <ul class="side-nav-second-level">
                @if (isRouteExists('admin.reports.items'))
                    <li>
                        <a href="{{ route('admin.reports.items') }}">{{ localize('Item Reports') }}</a>
                    </li>
                @endif

                @if (isRouteExists('admin.reports.items_category'))
                    <li>
                        <a href="{{ route('admin.reports.items_category') }}">{{ localize('Item Category Reports') }}</a>
                    </li>
                @endif

                @if (isRouteExists('admin.reports.sales'))
                    <li>
                        <a href="{{ route('admin.reports.sales') }}">{{ localize('Sales Reports') }}</a>
                    </li>
                @endif

                @if (isRouteExists('admin.reports.reservations'))
                    <li>
                        <a href="{{ route('admin.reports.reservations') }}">{{ localize('Reservations Reports') }}</a>
                    </li>
                @endif
            </ul>
        </div>
    </li>
@endif


@php
    $settingsRoutes = [
        'admin.settings.index',
        'admin.pwa-settings.index',
        'admin.systemUpdate.health-check',
        'admin.systemUpdate.update',
    ];
@endphp

@if (isMenuGroupShow($settingsRoutes))
    <li class="side-nav-title side-nav-item nav-item mt-4">
        <span class="tt-nav-title-text">{{ localize('MANAGE SETTINGS') }}</span>
    </li>
    <li class="side-nav-item nav-item">
        <a data-bs-toggle="collapse" href="#sidebarSettingsMenu" aria-expanded="false"
           class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon">
                    <span data-feather="settings" class="icon-14"></span>
                </span>
            <span class="tt-nav-link-text">{{ localize('Settings') }}</span>
        </a>
        <div class="collapse" id="sidebarSettingsMenu">
            <ul class="side-nav-second-level">
                @if (isRouteExists('admin.settings.index'))
                    <li>
                        <a href="{{ route('admin.settings.index') }}">
                            {{ 'Features Settings' }}
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </li>
@endif

@php
    $contentRoutes = [
        'admin.media-managers.index',
        'admin.support-categories.index',
        'admin.support-priorities.index',
        'admin.support-tickets.index',

    ];
@endphp

@if (isMenuGroupShow($contentRoutes))

    <li class="side-nav-title side-nav-item nav-item mt-4">
        <span class="tt-nav-title-text">{{ localize('Manage Contents') }}</span>
    </li>

    @if (isRouteExists('admin.media-managers.index'))
        <li class="side-nav-item nav-item">
            <a href="{{ route('admin.media-managers.index') }}" class="side-nav-link">
                <span class="tt-nav-link-icon">
                    <span data-feather="folder" class="icon-14"></span>
                </span>
                <span class="tt-nav-link-text"> {{ localize('Media Manager') }} </span>
            </a>
        </li>
    @endif
@endif


@php
    $settingsRoutes = [
        'admin.settings.index',
        'admin.settings.credentials',
        'admin.email-templates.index',
        'admin.settings.adSense.index',
        'admin.languages.index',
        'admin.currencies.index',
        'admin.payment-gateways.index',
        'admin.offline-payment-methods.index',
        'admin.cron-list',
        'admin.pwa-settings.index',
        'admin.systemUpdate.health-check',
        'admin.systemUpdate.update',
    ];
@endphp
