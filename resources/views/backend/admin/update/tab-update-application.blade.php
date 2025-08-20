<div class="card-body px-lg-8 py-5">
    <div class="tab-content">
        <div class="tab-pane fade active show" id="oneClickUpdateTab" role="tabpanel">
            @include("backend.admin.update.tab.tab-one-click")
        </div>

        <div class="tab-pane fade" id="manualUpdateTab" role="tabpanel">
           @include("backend.admin.update.tab.tab-manual-update")
        </div>
    </div>
</div>