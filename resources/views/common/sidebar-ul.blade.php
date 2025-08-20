    <ul class="tt-side-nav">
        @if(isAdmin() || isVendorTeam())
            @include('common.admin-sidebar')
            
        @elseif (isVendor() || isVendorTeam())
            @include('common.vendor-sidebar')
        @endif
    </ul>  
