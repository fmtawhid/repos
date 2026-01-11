    <ul class="tt-side-nav">
        @if(isAdminUserGroup())
            @include('common.admin-sidebar')
        @elseif (isVendor() || isVendorTeam())
            @include('common.vendor-sidebar')
        @endif
    </ul>  
