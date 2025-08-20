<div class="row mb-4 g-4">
    <!--left sidebar-->
    <div class="col-xl-12 order-2 order-md-2 order-lg-2 order-xl-1">
        <form action="{{ route('admin.appearance.update') }}" id="loginRegisterImage" method="POST" class="appearanceForm">
            @csrf
            <input type="hidden" name="language_key" id="language_id" value="{{ $lang_key }}">
            <!--Navbar-->
            <div class="card mb-4" id="section-1">
                <div class="card-body">
                    <h5>{{ localize('Login Register Image') }}</h5>
                   
                    
                    <div class="mb-3">
                        <label class="form-label">{{ localize('Image') }}</label>
                        <div class="tt-image-drop rounded">
                            <span class="fw-semibold">{{ localize('Choose') }}</span>
                            <!-- choose media -->
                            <div class="tt-product-thumb show-selected-files mt-3">
                                <div class="avatar avatar-xl cursor-pointer choose-media" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasBottom" onclick="showMediaManager(this)"
                                    data-selection="single">
                                    <input type="hidden" name="types[auth_image]"
                                        value="{{ getSetting('auth_image') }}">
                                    <div class="no-avatar rounded-circle">
                                        <span><i data-feather="plus"></i></span>
                                    </div>
                                </div>
                            </div>
                            <!-- choose media -->
                        </div>
                    </div>
                    
                </div>
            </div>


            <div class="mb-3">
                <button type="submit" class="btn btn-sm btn-primary settingsSubmitButton">
                    {{ localize('Save Configuration') }}
                </button>
            </div>
        </form>

    </div>


</div>
