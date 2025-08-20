<!--header section start-->
<header class="tt-top-fixed bg-secondary-subtle">
    <div class="container-fluid">
        <nav class="navbar navbar-top navbar-expand" id="navbarDefault">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="tt-mobile-toggle-brand d-lg-none d-md-none">
                    <a class="tt-toggle-sidebar pe-3" href="#offcanvasLeft" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasLeft">
                        <i data-feather="menu"></i>
                    </a>
                    <div class="tt-brand pe-3">

                    </div>
                </div>
                <div class="tt-search-box d-none d-md-block d-lg-block flex-grow-1 me-4">
                    <div class="input-group">
                        <span class="position-absolute top-50 start-0 translate-middle-y ms-2"> <i
                                data-feather="search"></i></span>
                        <input class="form-control rounded-start w-100 border-0 bg-transparent" type="text"
                            placeholder="Search...">
                    </div>
                </div>

                <ul class="navbar-nav flex-row align-items-center tt-top-navbar">
                    @if (isVendorUserGroup() && user()->subscription_plan_id)
                        <li class="nav-item me-2 d-none d-md-block d-lg-block">
                            <a href="{{ route('admin.plan-histories.index') }}"
                                class="btn btn-sm btn-primary text-capitalize rounded-pill">
                                <i data-feather="zap" class="me-1"></i>
                                {!! html_entity_decode(optional(user()->plan)->title) !!}/{{ ucfirst(optional(user()->plan)->package_type) }}
                            </a>
                        </li>
                    @endif

                    @auth
                        <li class="nav-item dropdown tt-user-dropdown">
                            <a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!" role="button"
                                data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true"
                                aria-expanded="true">
                                <div class="avatar avatar-sm status-online">
                                    <img class="rounded-circle" src="{{ avatarImage(user()->avatar) }}"
                                        alt="avatar">
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end py-0 shadow border-0"
                                aria-labelledby="navbarDropdownUser">
                                <div class="card position-relative border-0">
                                    <div class="card-body py-2">
                                        <ul class="tt-user-nav list-unstyled d-flex flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link px-0 py-1" href="{{route('admin.profile')}}">
                                                    <i data-feather="user" class="me-1 fs-sm"></i>{{localize('My Account')}}
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link px-0 py-1" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                    <i data-feather="log-out"
                                                        class="me-1 fs-sm"></i>{{ localize('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </div>
</header>
<!--mobile offcanvas menu start-->
<div class="offcanvas offcanvas-start tt-aside-navbar bg-info" id="offcanvasLeft" tabindex="-1">
    <div class="offcanvas-header border-bottom py-3">
        <div class="tt-brand">
            <a href="index.html" class="tt-brand-link">

                <img src="{{ getSetting('collapse_able_icon') ? avatarImage(getSetting('collapse_able_icon')) : asset('assets') }}/img/logo-icon.png" class="tt-brand-favicon ms-1 d-none" width="44"
                alt="favicon" />
            <img src="{{ getSetting('logo_for_light') ? avatarImage(getSetting('logo_for_light')) : asset('assets') }}/img/logo.png" class="tt-brand-logo ms-2" alt="logo" width="164" />
            </a>
        </div>
        <button class="btn-close" type="button" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-2 pb-9 tt-custom-scrollbar">
        <div class="tt-sidebar-nav">
            <nav class="navbar navbar-vertical">
                <div class="w-100">
                    @include('common.sidebar-ul')
                </div>
            </nav>
        </div>
    </div>
</div><!--mobile offcanvas menu end--> <!--header section end-->
