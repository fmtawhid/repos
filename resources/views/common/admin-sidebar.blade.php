@php
    // Dashboard
    $dashboardRoutes = ['admin.dashboard'];
@endphp

@if (isMenuGroupShow($dashboardRoutes) && isRouteExists('admin.dashboard'))
    <li class="side-nav-item nav-item">
        <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
            <span class="tt-nav-link-icon"><span data-feather="home" class="icon-14"></span></span>
            <span class="tt-nav-link-text">{{ localize('Dashboard') }}</span>
        </a>
    </li>
@endif

{{-- ================================= --}}
{{-- Vendor / Merchant Management --}}
{{-- ================================= --}}
@php
    $merchantRoutes = ['admin.merchants.index','admin.merchants.edit'];
@endphp

@if (isMenuGroupShow($merchantRoutes))
    <li class="side-nav-item nav-item">
        <a data-bs-toggle="collapse" href="#MerchantManagement" aria-expanded="{{ areActiveRoutes(['admin.merchants.index'], 'true') }}" class="side-nav-link tt-menu-toggle">
            <span class="tt-nav-link-icon"><i data-feather="git-pull-request"></i></span>
            <span class="tt-nav-link-text">{{ localize("Vendor Management") }}</span>
        </a>
        <div class="collapse" id="MerchantManagement">
            <ul class="side-nav-second-level">
                @if(isRouteExists('admin.merchants.index'))
                    <li class="{{ areActiveRoutes(['admin.merchants.index','admin.merchants.edit'], 'tt-menu-item-active') }}">
                        <a href="{{ route('admin.merchants.index') }}">{{ localize('All Vendors') }}</a>
                    </li>
                @endif
            </ul>
        </div>
    </li>
@endif

{{-- ================================= --}}
{{-- Subscriptions --}}
{{-- ================================= --}}
@php
    $subscriptionRoutes = [
        'admin.subscription-plans.index',
        'admin.plan-histories.index',
        'admin.subscription-settings.index',
        'admin.plan-histories.show'
    ];
@endphp

@if (isMenuGroupShow($subscriptionRoutes))
    <li class="side-nav-item nav-item">
        <a data-bs-toggle="collapse" href="#subscriptions" aria-expanded="false" class="side-nav-link tt-menu-toggle">
            <span class="tt-nav-link-icon"><span data-feather="zap" class="icon-14"></span></span>
            <span class="tt-nav-link-text">{{ localize('Subscriptions') }}</span>
        </a>
        <div class="collapse" id="subscriptions">
            <ul class="side-nav-second-level">
                @if(isRouteExists('admin.subscription-plans.index'))
                    <li><a href="{{ route('admin.subscription-plans.index') }}">{{ localize('Subscription Plan') }}</a></li>
                @endif
                @if(isRouteExists('admin.plan-histories.index'))
                    <li><a href="{{ route('admin.plan-histories.index') }}">{{ localize('Subscription History') }}</a></li>
                @endif
                <!-- @if(isRouteExists('admin.subscription-settings.index'))
                    <li><a href="{{ route('admin.subscription-settings.index') }}">{{ localize('Recurring Product Plan') }}</a></li>
                @endif -->
            </ul>
        </div>
    </li>
@endif

{{-- ================================= --}}
{{-- Staff / Role Management --}}
{{-- ================================= --}}
@php
    $roleManagements = ['admin.users.index','admin.roles.index'];
@endphp

@if (isMenuGroupShow($roleManagements))
    <li class="side-nav-item nav-item">
        <a data-bs-toggle="collapse" href="#userRoleManagement" aria-expanded="false" class="side-nav-link tt-menu-toggle">
            <span class="tt-nav-link-icon"><span data-feather="user-check" class="icon-14"></span></span>
            <span class="tt-nav-link-text">{{ localize('Staff') }}</span>
        </a>
        <div class="collapse" id="userRoleManagement">
            <ul class="side-nav-second-level">
                @if(isRouteExists('admin.users.index'))
                    <li><a href="{{ route('admin.users.index') }}">{{ localize('Admin Staff') }}</a></li>
                @endif
                @if(isRouteExists('admin.roles.index'))
                    <li><a href="{{ route('admin.roles.index') }}">{{ localize('Manage Roles') }}</a></li>
                @endif
            </ul>
        </div>
    </li>
@endif

{{-- ================================= --}}
{{-- Support --}}
{{-- ================================= --}}
@php
    $supportRoutes = [
        'admin.support-categories.index',
        'admin.support-priorities.index',
        'admin.support-tickets.index',
        'admin.support-tickets.reply'
    ];
@endphp

@if(isMenuGroupShow($supportRoutes))
    <li class="side-nav-title side-nav-item nav-item mt-4"><span class="tt-nav-title-text">{{ localize('Support') }}</span></li>
    <li class="side-nav-item nav-item">
        <a data-bs-toggle="collapse" href="#supportTicketManagement" aria-expanded="false" class="side-nav-link tt-menu-toggle">
            <span class="tt-nav-link-icon"><span data-feather="headphones" class="icon-14"></span></span>
            <span class="tt-nav-link-text">{{ localize('Support Ticket') }}</span>
        </a>
        <div class="collapse" id="supportTicketManagement">
            <ul class="side-nav-second-level">
                @if(isRouteExists('admin.support-categories.index'))
                    <li><a href="{{ route('admin.support-categories.index') }}">{{ localize('Category') }}</a></li>
                @endif
                @if(isRouteExists('admin.support-priorities.index'))
                    <li><a href="{{ route('admin.support-priorities.index') }}">{{ localize('Priority') }}</a></li>
                @endif
                @if(isRouteExists('admin.support-tickets.index'))
                    <li><a href="{{ route('admin.support-tickets.index') }}">{{ localize('Tickets') }}</a></li>
                @endif
            </ul>
        </div>
    </li>
@endif

{{-- ================================= --}}
{{-- FAQs, Utilities & Settings --}}
{{-- ================================= --}}
@php
    $settingsRoutes = [
        'admin.settings.index',
        'admin.settings.credentials',
        'admin.email-templates.index',
        'admin.languages.index',
        'admin.currencies.index',
        'admin.payment-gateways.index',
        'admin.offline-payment-methods.index',
        'admin.cron-list',
        'admin.pwa-settings.index',
        'admin.systemUpdate.health-check',
        'admin.systemUpdate.update',
        'admin.utilities'
    ];
@endphp

@if(isMenuGroupShow($settingsRoutes))
    <li class="side-nav-title side-nav-item nav-item mt-4"><span class="tt-nav-title-text">{{ localize('MANAGE SETTINGS') }}</span></li>
    <li class="side-nav-item nav-item">
        <a data-bs-toggle="collapse" href="#sidebarSettingsMenu" aria-expanded="false" class="side-nav-link tt-menu-toggle">
            <span class="tt-nav-link-icon"><span data-feather="settings" class="icon-14"></span></span>
            <span class="tt-nav-link-text">{{ localize('Settings') }}</span>
        </a>
        <div class="collapse" id="sidebarSettingsMenu">
            <ul class="side-nav-second-level">
                @if(isRouteExists('admin.settings.index'))
                    <li><a href="{{ route('admin.settings.index') }}">{{ localize('Feature Settings') }}</a></li>
                @endif
                @if(isRouteExists('admin.settings.credentials'))
                    <li><a href="{{ route('admin.settings.credentials') }}">{{ localize('All Credentials Setup') }}</a></li>
                @endif
                @if(isRouteExists('admin.email-templates.index'))
                    <li><a href="{{ route('admin.email-templates.index') }}">{{ localize('Email Template') }}</a></li>
                @endif
                <!-- @if(isRouteExists('admin.languages.index'))
                    <li><a href="{{ route('admin.languages.index') }}">{{ localize('Languages') }}</a></li>
                @endif -->
                @if(isRouteExists('admin.currencies.index'))
                    <li><a href="{{ route('admin.currencies.index') }}">{{ localize('Multi Currency') }}</a></li>
                @endif
                @if(isRouteExists('admin.payment-gateways.index'))
                    <li><a href="{{ route('admin.payment-gateways.index') }}">{{ localize('Payment Gateway') }}</a></li>
                @endif
                @if(isRouteExists('admin.offline-payment-methods.index'))
                    <li><a href="{{ route('admin.offline-payment-methods.index') }}">{{ localize('Offline Payment') }}</a></li>
                @endif
                <!-- @if(isRouteExists('admin.cron-list'))
                    <li><a href="{{ route('admin.cron-list') }}">{{ localize('Cron List') }}</a></li>
                @endif -->
                <!-- @if(isRouteExists('admin.pwa-settings.index'))
                    <li><a href="{{ route('admin.pwa-settings.index') }}">{{ localize('PWA Settings') }}</a></li>
                @endif -->
                @if(isRouteExists('admin.utilities'))
                    <li><a href="{{ route('admin.utilities') }}">{{ localize('Utilities') }}</a></li>
                @endif
                <!-- @if(isRouteExists('admin.systemUpdate.health-check'))
                    <li><a href="{{ route('admin.systemUpdate.health-check') }}">{{ localize('Health Check') }}</a></li>
                @endif
                @if(isRouteExists('admin.systemUpdate.update'))
                    <li><a href="{{ route('admin.systemUpdate.update') }}">{{ localize('System Update') }}</a></li>
                @endif -->
            </ul>
        </div>
    </li>
@endif



@php
    $mediaRoutes = ['admin.media-managers.index', 'admin.uppy.index'];
@endphp

@if(isMenuGroupShow($mediaRoutes))
<li class="side-nav-item nav-item">
    <a data-bs-toggle="collapse" href="#mediaManager" aria-expanded="false" class="side-nav-link tt-menu-toggle">
        <span class="tt-nav-link-icon"><i data-feather="image"></i></span>
        <span class="tt-nav-link-text">{{ localize('Media Manager') }}</span>
    </a>
    <div class="collapse" id="mediaManager">
        <ul class="side-nav-second-level">
            @if(isRouteExists('admin.media-managers.index'))
                <li><a href="{{ route('admin.media-managers.index') }}">{{ localize('Media Library') }}</a></li>
            @endif
            <!-- @if(isRouteExists('admin.uppy.index'))
                <li><a href="{{ route('admin.uppy.index') }}">{{ localize('File Uploader') }}</a></li>
            @endif -->
        </ul>
    </div>
</li>
@endif

