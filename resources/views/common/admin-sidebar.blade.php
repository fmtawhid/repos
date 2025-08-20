
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


        {{-- ================================= --}}
        {{-- Offerings start--}}
        {{-- ================================= --}}
        @php
            $merchantRoutes = [
                'admin.merchants.index',
                'admin.merchants.edit',
            ];
        @endphp

        @php
            $vendorRoutes = ['admin.merchants.index'];
        @endphp

    @if (isMenuGroupShow($merchantRoutes))               
        <li class="side-nav-item nav-item">
            <a data-bs-toggle="collapse" href="#MerchantManagement" aria-expanded="{{ areActiveRoutes($vendorRoutes, 'true') }}" class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"> <i data-feather="git-pull-request"></i></span>
                <span class="tt-nav-link-text">{{ localize("Vendor Management") }}</span>
            </a>
            <div class="collapse" id="MerchantManagement">
                <ul class="side-nav-second-level">
                    @if(isRouteExists("admin.merchants.index"))
                        <li class="{{ areActiveRoutes(['admin.merchants.index', 'admin.merchants.edit'], 'tt-menu-item-active') }}"> 
                            <a href="{{ route('admin.merchants.index') }}">{{ localize('All Vendors') }}</a> 
                        </li>
                    @endif
                </ul>
            </div>
        </li>
    @endif            

    @php
        $subscriptionRoutes = [
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
                    @if (isRouteExists('admin.subscription-plans.index'))
                        <li> <a
                                href="{{ route('admin.subscription-plans.index') }}">{{ localize('Subscription Plan') }}</a>
                        </li>
                    @endif
                    @if (isRouteExists('admin.plan-histories.index'))
                        <li> <a
                                href="{{ route('admin.plan-histories.index') }}">{{ localize('Subscription History') }}</a>
                        </li>
                    @endif
                    @if (isRouteExists('admin.subscription-settings.index'))
                        <li> <a
                                href="{{ route('admin.subscription-settings.index') }}">{{ localize('Recurring Product Plan') }}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
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
                <span class="tt-nav-link-text">{{ localize('Staff') }}</span>
            </a>
            <div class="collapse" id="userROleManagement">
                <ul class="side-nav-second-level">
                    @if (isRouteExists('admin.users.index'))
                        <li> <a href="{{ route('admin.users.index') }}">{{ localize('Admin Staff') }}</a>
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


    @php
        $supportRoutes = [
            'admin.support-categories.index',
            'admin.support-priorities.index',
            'admin.support-tickets.index',
            'admin.support-tickets.reply'
        ];
    @endphp

    @if (isMenuGroupShow($supportRoutes))
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
                    @if (isRouteExists('admin.support-categories.index'))
                        <li> <a href="{{ route('admin.support-categories.index') }}">{{ localize('Category') }}</a> </li>
                    @endif

                    @if (isRouteExists('admin.support-priorities.index'))
                        <li> <a href="{{ route('admin.support-priorities.index') }}">{{ localize('priority') }}</a></li>
                    @endif

                    @if (isRouteExists('admin.support-tickets.index'))
                        <li> <a href="{{ route('admin.support-tickets.index') }}">{{ localize('Tickets') }}</a></li>
                    @endif
                </ul>
            </div>
        </li>
        <li class="side-nav-item nav-item d-none">
            <a href="{{ route('admin.queries.index') }}" class="side-nav-link">
                <span class="tt-nav-link-icon">
                    <span data-feather="help-circle" class="icon-14"></span>
                </span>
                <span class="tt-nav-link-text"> {{ localize('Queries') }} </span>
            </a>
        </li>
    @endif

    @php
        $contentRoutes = [
            'admin.faqs.index',
            'admin.support-categories.index',
            'admin.support-priorities.index',
            'admin.support-tickets.index',

        ];
    @endphp

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
                    @if (isRouteExists('admin.settings.credentials'))
                        <li>
                            <a href="{{ route('admin.settings.credentials') }}">
                                {{ localize('All Credentials Setup') }}
                            </a>
                        </li>
                    @endif
                   
                    @if (isRouteExists('admin.email-templates.index'))
                        <li>
                            <a href="{{ route('admin.email-templates.index') }}">
                                {{ localize('Email Template') }}
                            </a>
                        </li>
                    @endif
                    @if (isRouteExists('admin.currencies.index'))
                        <li>
                            <a href="{{ route('admin.currencies.index') }}">
                                {{ localize('Multi Currency') }}
                            </a>
                        </li>
                    @endif
                    @if (isRouteExists('admin.payment-gateways.index'))
                        <li>
                            <a href="{{ route('admin.payment-gateways.index') }}">
                                {{ localize('Payment Gateway') }}
                            </a>
                        </li>
                    @endif
                    @if (isRouteExists('admin.offline-payment-methods.index'))
                        <li>
                            <a href="{{ route('admin.offline-payment-methods.index') }}">
                                {{ localize('Offline Payment') }}
                            </a>
                        </li>
                    @endif
                    @if (isRouteExists('admin.cron-list'))
                        <li>
                            <a href="{{ route('admin.cron-list') }}">
                                {{ localize('Cron List') }}
                            </a>
                        </li>
                    @endif
                    @if (isRouteExists('admin.utilities'))
                        <li>
                            <a href="{{ route('admin.utilities') }}">
                                {{ localize('Utilities') }}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
    @endif
   