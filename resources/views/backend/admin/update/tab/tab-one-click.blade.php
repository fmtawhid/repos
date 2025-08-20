<div class="d-flex justify-content-left">

    <div class="tt-version tt-your-version py-5 px-9 bg-secondary-subtle rounded d-flex flex-column border border-secondary me-5">
        <h6>{{ localize('Your Version') }}</h6>
        <div class="h2 fw-bold">v{{ currentVersion() }}</div>
        <div class="fs-md">{{ getSetting('last_update') }}</div>
    </div>
    <div class="tt-version tt-latest-version py-5 px-9 bg-secondary-subtle rounded d-flex flex-column border border-secondary">
        <h6>{{ localize('Latest Version') }}</h6>
        <div class="h2 fw-bold text-success">
            <div class="w-100 d-flex h-100 align-items-center justify-content-center messages-container-loader">
                <div class="tt-text-preloader">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <span id="latestVersion" class="me-2"></span>
            </div>
        </div>
        <div class="fs-md">
            <a href="{{ route('admin.systemUpdate.file-permission') }}"
               class="fw-medium">
                {{ localize('View Changelog') }}
            </a>
        </div>
    </div>
</div>

<form action="{{ route('admin.systemUpdate.oneClickUpdate') }}" method="GET">
    @if($is_purchase==false)
        @include('backend.admin.update.license_admin', ['submit'=>false])
    @endif


    <div class="d-flex align-items-center justify-content-left mt-5">
        <button  class="btn btn-primary me-2"
                 type="submit"
                 id="update_now">{{ localize('Update Now') }}
        </button>

        <a href="{{ route('admin.systemUpdate.file-permission') }}" target="blank"
           class="btn btn-secondary me-2">{{ localize('Check Compatibility') }}
        </a>
    </div>
</form>