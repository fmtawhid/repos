<aside class="tt-sidebar bg-secondary-subtle {{ isSideBarCollapsed() }}" id="sidebar">
    <div class="tt-brand">
        <a href="{{ route('admin.dashboard') }}" class="tt-brand-link">
            <img src="{{ getSetting('collapse_able_icon') ? avatarImage(getSetting('collapse_able_icon')) : asset('assets') }}/img/logo-icon.png" class="tt-brand-favicon d-none" width="44"
                alt="favicon" />
            <img src="{{ getSetting('logo_for_light') ? avatarImage(getSetting('logo_for_light')) : asset('assets') }}/img/logo.png" class="tt-brand-logo ms-2" alt="logo" width="164" />
        </a>
        <a href="javascript:void(0);" class="tt-toggle-sidebar">
            <span><i data-feather="chevron-left"></i></span>
        </a>
    </div>

    <div class="tt-sidebar-nav pb-9 pt-3 d-flex flex-column h-100 justify-content-between tt-custom-scrollbar">
        <nav class="navbar navbar-vertical navbar-expand-lg">
            <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
                <div class="w-100" id="leftside-menu-container">
                   @include('common.sidebar-ul')
                </div>
            </div>
        </nav>
        <ul class="tt-side-nav m-3 tt-user-side-nav">
            <!-- logout button for admin -->
            <li class="side-nav-item nav-item">
                <a href="{{ route('logout') }}"
                    class="side-nav-link justify-content-center btn border border-primary rounded-pill text-center">
                    {{ localize('Logout') }} <i data-feather="log-out" class="icon-14 ms-2"></i>
                </a>
            </li>
        </ul>
    </div>
</aside>
