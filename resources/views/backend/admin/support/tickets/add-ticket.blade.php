<form action="{{ route('admin.support-tickets.store') }}" method="POST" id="addTicketForm">
    <div class="offcanvas offcanvas-end" id="addTicketFormSidebar" tabindex="-1">
        @method('POST')
        @csrf
        <x-form.input name="id" id="id" type="hidden" value="" showDiv=0 />
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">{{ localize('Add Ticket') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <div class="offcanvas-body">
            <x-common.message class="mb-3" />

            <div class="mb-3">
                <x-form.label for="title" label="{{ localize('Title') }}" isRequired=true />
                <x-form.input name="title" id="title"
                              type="text"
                              placeholder="{{ localize('Title') }}"
                              value=""
                            showDiv=false
                />
            </div>

            <div class="mb-3">
                <x-form.label for="category_id" label="{{ localize('Category') }}" /> 
                    
                <x-form.select name="category_id" id="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-form.select>
            </div>
            <div class="mb-3">
                <x-form.label for="priority_id" label="{{ localize('Priority') }}" />
                <x-form.select name="priority_id" id="priority_id"> 
                    @foreach ($priorities as  $id=>$name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </x-form.select>
            </div>
            <div class="mb-3">
                <x-form.label for="description" label="{{ localize('Description') }}" />
                <x-form.textarea name="description" id="editor" class="editor"
                              type="text"
                              placeholder="{{ localize('write something here ....') }}"
                              value=""
                              showDiv=false
                />
            </div>
            <div class="mb-3">
                <div class="file-drop-area file-upload text-center rounded-3 py-3 mb-4">
                    <input type="file"
                           class="file-drop-input"
                            name="files[]"
                            multiple
                    />
                    <p class="text-dark fw-bold mb-2">
                    <i data-feather="image" class="me-2"></i> {{ localize('Drop your files here or') }}
                    <a href="#" class="text-primary">{{ localize('Browse') }}</a>
                    </p>
                    <p class="mb-0 file-name text-muted">
                        <small>* (Only .jpg, .png, will be accepted) </small>
                    
                    </p>
                    @if ($errors->has('files'))
                    <span class="text-danger">{{ $errors->first('files') }}</span>
                @endif
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
