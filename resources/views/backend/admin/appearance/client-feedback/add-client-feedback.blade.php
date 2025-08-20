<form action="{{ route('admin.client-feedbacks.store') }}" method="POST" id="addClientFeedbackForm">
    <div class="offcanvas offcanvas-end" id="addClientFeedbackFormSidebar" tabindex="-1">
        @method('POST')
        @csrf
        <x-form.input name="id" id="id" type="hidden" value="" showDiv=0 />
        <div class="offcanvas-header border-bottom py-3">
            <h5 class="offcanvas-title">{{ localize('Add Feedback') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <x-common.splitter />
        <div class="offcanvas-body">
            <x-common.message class="mb-3" />

            <div class="mb-3">
                <x-form.label for="name" label="{{ localize('Name') }}" isRequired=true />
                <x-form.input name="name" id="name"
                              type="text"
                              placeholder="{{ localize('Name') }}"
                              value=""
                              showDiv=false
                />
            </div>
            <div class="mb-3">
                <x-form.label for="designation" label="{{ localize('Designation') }}" isRequired=true />
                <x-form.input name="designation" id="designation"
                              type="text"
                              placeholder="{{ localize('Designation') }}"
                              value=""
                              showDiv=false
                />
            </div>
          
            

            <div class="mb-3">
                <x-form.label for="rating" label="{{ localize('Rating') }}" />
                <x-form.select name="rating" id="rating">                   
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                </x-form.select>
            </div>
            <div class="mb-3">
                <x-form.label for="review" label="{{ localize('Review') }}" isRequired=true />
                <x-form.textarea name="review" id="review"/>
            </div>
            <div class="mb-3">
                <div class="mb-4">
                    <x-form.label for="avatar" label="{{ localize('Avatar') }}"  />
                    <div class="tt-image-drop rounded">
                        <span class="fw-semibold">{{ localize('Choose Avatar') }}</span>
                        <!-- choose media -->
                        <div class="tt-product-thumb show-selected-files mt-3">
                            <div class="avatar avatar-xl cursor-pointer choose-media"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                onclick="showMediaManager(this)" data-selection="single">
                                <input type="hidden" name="avatar" id="avatar">
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
        <div class="offcanvas-footer border-top">
            <div class="d-flex gap-3">
                <x-form.button id="frmActionBtn">{{ localize('Save') }}</x-form.button>
                <x-form.button color="secondary" type="reset">{{ localize('Reset') }}</x-form.button>
            </div>
        </div>
    </div>
</form>
