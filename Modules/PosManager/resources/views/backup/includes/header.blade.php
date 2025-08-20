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
                        <a href="{{ route("admin.dashboard") }}">
                            <img src="{{ systemLogo() }}" class="tt-brand-favicon" alt="favicon" />
                        </a>
                    </div>
                </div>
                @php
                    $systemLogo = getSetting("system_login_register_welcome_logo_media_manager_id");
                    $logoMedia  = !empty($systemLogo) ? getMediaManagerById($systemLogo) : defaultImage();
                @endphp
                <div class="tt-search-box d-none d-lg-block flex-grow-1 me-4">
                    <div class="input-group">
                        <a href="{{ route("admin.dashboard") }}">
                        <img src="{{ urlVersion($logoMedia?->media_file ?? defaultImage()) }}" alt="logo" class="img-fluid logo-color" />
                        </a>
                    </div>
                </div>

                <ul class="navbar-nav flex-row align-items-center tt-top-navbar">
                    
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">
                            <i data-feather="monitor" class="me-1"></i> {{ localize("Visit Store") }}
                        </a>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link position-relative tt-notification" href="#" role="button" id="notificationDropdown"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside">
                            <i data-feather="bell"></i>
                            <span class="tt-notification-dot tt-notification-number bg-danger rounded-circle">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end py-0 shadow border-0" aria-labelledby="notificationDropdown">
                            <div class="card position-relative border-0">
                                <div class="card-body p-0">
                                    <div class="scrollbar-overlay">
                                        <div class="p-3 position-relative border-bottom">
                                            <div class="d-flex">
                                                <div class="avatar avatar-md me-2 tt-notification-img flex-shrink-0">
                                                    <div class="no-avatar rounded-circle">
                                                        <span><i data-feather="image"></i></span>
                                                    </div>
                                                </div>
                                                <div class="me-2 flex-1">
                                                    <h4 class="fs-md mb-0">New User Register</h4>
                                                    <span class="text-muted fs-sm">12 Jan 2023 - 15:30 PM</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3 position-relative border-bottom">
                                            <div class="d-flex">
                                                <div class="avatar avatar-md me-2 tt-notification-img flex-shrink-0">
                                                    <div class="no-avatar rounded-circle">
                                                        <span><i data-feather="image"></i></span>
                                                    </div>
                                                </div>
                                                <div class="me-2 flex-1">
                                                    <h4 class="fs-md mb-0">New User Register</h4>
                                                    <span class="text-muted fs-sm">12 Jan 2023 - 15:30 PM</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3 position-relative border-bottom">
                                            <div class="d-flex">
                                                <div class="avatar avatar-md me-2 tt-notification-img flex-shrink-0">
                                                    <div class="no-avatar rounded-circle">
                                                        <span><i data-feather="image"></i></span>
                                                    </div>
                                                </div>
                                                <div class="me-2 flex-1">
                                                    <h4 class="fs-md mb-0">New User Register</h4>
                                                    <span class="text-muted fs-sm">12 Jan 2023 - 15:30 PM</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3 position-relative">
                                            <div class="d-flex">
                                                <div class="avatar avatar-md me-2 tt-notification-img flex-shrink-0">
                                                    <div class="no-avatar rounded-circle">
                                                        <span><i data-feather="image"></i></span>
                                                    </div>
                                                </div>
                                                <div class="me-2 flex-1">
                                                    <h4 class="fs-md mb-0">New User Register</h4>
                                                    <span class="text-muted fs-sm">12 Jan 2023 - 15:30 PM</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-0 border-top border-0">
                                    <a class="fw-bolder my-2 text-center d-block" href="#">Notification
                                        history</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown tt-user-dropdown">
                        <a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!" role="button" data-bs-toggle="dropdown"
                           data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="true">
                            <div class="avatar avatar-sm status-online">
                                <img class="rounded-circle" src="{{ urlVersion(user()->avatar ?? null) }}" alt="avatar">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end py-0 shadow border-0" aria-labelledby="navbarDropdownUser">
                            <div class="card position-relative border-0">
                                <div class="card-body py-2">
                                    <ul class="tt-user-nav list-unstyled d-flex flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link px-0 py-1" href="{{ route('home') }}">
                                                <i data-feather="user" class="me-1 fs-sm"></i>{{ localize("My Account") }}
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
                </ul>
            </div>
        </nav>
    </div>
</header>
