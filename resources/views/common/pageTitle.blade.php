<!-- Page Header  -->
<div class="tt-page-header py-4">
    <div class="container">
        <div class="row g-2 align-items-center">
            <div class="col-auto flex-grow-1">
                <div class="tt-page-title">
                    @hasSection('pagetitle')
                    <h1 class="h4 mb-lg-1">@yield('pagetitle', '')</h1>
                    @endif
                    @yield('breadcrumb')
                </div>
            </div>
            @yield('pageTitleButtons')
        </div>
    </div>
</div>
<!-- /Page Header  -->
