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

                    

                    <li class="nav-item dropdown tt-user-dropdown">
                        <a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!" role="button" data-bs-toggle="dropdown"
                           data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="true">
                            <div class="avatar avatar-sm status-online">
                                
                                    <img class="rounded-circle" src="{{ avatarImage(user()->avatar) }}"
                                        alt="avatar">
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
