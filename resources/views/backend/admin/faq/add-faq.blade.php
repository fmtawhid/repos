<form action="{{ route('admin.faqs.store') }}" method="POST" id="addFAQForm">
    <div class="offcanvas offcanvas-end" id="addFAQFormSidebar" tabindex="-1">
        @method('POST')
        @csrf
        <x-form.input name="id" id="id" type="hidden" value="" showDiv=0 />
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">{{ localize('Add FAQ') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <x-common.splitter />
        <div class="offcanvas-body">
            <x-common.message class="mb-3" />

            <div class="mb-3">
                <x-form.label for="question" label="{{ localize('Question') }}" isRequired=true />
                <x-form.input name="question" id="question" type="text" placeholder="{{ localize('Question') }}"
                    value="" showDiv=false />
            </div>
            <div class="mb-3">
                <x-form.label for="answer" label="{{ localize('Answer') }}" isRequired=true />
                <x-form.textarea name="answer" id="answer" type="text" placeholder="{{ localize('Answer') }}"
                    value="" showDiv=false />
            </div>


            <div class="mb-3">
                <x-form.label for="is_active" label="{{ localize('Status') }}" />
                <x-form.select name="is_active" id="is_active">
                    @foreach (appStatic()::STATUS_ARR as $dataStatusId => $dataStatus)
                        <option value="{{ $dataStatusId }}">{{ $dataStatus }}</option>
                    @endforeach
                </x-form.select>
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
