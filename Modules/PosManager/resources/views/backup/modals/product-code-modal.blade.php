<!-- Modal -->
<div class="modal fade" id="addGroup" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-bottom-0 pb-0 justify-content-between align-items-center">
                <h5 class="modal-title">
                   {{ localize("Search With Product Barcode,Title") }}
                </h5>
                <button type="button" class="btn bttn--icon p-2 lh-1" data-bs-dismiss="modal">
                    <span class="material-symbols-rounded fs-28 lh-1">
                        {{ localize("Close") }}
                    </span>
                </button>
            </div>
            <div class="modal-body padding-bottom-12">
                <div class="mb-4">
                    <input type="text"
                           class="form-control form-control--sm form-control-transparent"
                           id="posProductSearch"
                           placeholder="Enter product code"
                     />
                </div>

                <div class="posModalResult">

                </div>

                <div class="d-flex align-items-center flex-wrap gap-3">
                    <button class="btn btn-sm btn-secondary"  data-bs-dismiss="modal">
                        {{ localize("Cancel") }}
                    </button>
                    <button class="btn btn-sm btn-primary" type="button" id="posProductSearchBtn">
                        {{ localize("Search Products") }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Modal -->
