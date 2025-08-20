<!-- The Modal -->
<div class="modal" id="loadingModal">
    <div class="modal-dialog  modal-dialog-centered modal-sm">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title loadingModalTitle">{{ localize("Updating") }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body loadingModalBody">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">{{ localize("Loading") }}...</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>