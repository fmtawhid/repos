<div class="card">
    <form action="{{ route('admin.settings.store') }}" method="POST" class="copy-write-text-form settingsForm" enctype="multipart/form-data" id="copy-write-text-form">
    <div class="card-header">
        <h5 class="mb-0">{{ localize('Copywrite Text') }}</h5>
    </div>
    <div class="card-body">
        <div class="tab-content">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <x-form.label for="copywrite_text" label="{{ localize('CopyWrite Text') }}" />
                        <x-form.textarea name="settings[copywrite_text]" id="editor" class="editor"
                                    type="text"
                                    placeholder="{{ localize('write something here ....') }}"
                                    value="{!! html_entity_decode(getSetting('copywrite_text')) !!}"
                                    showDiv=false
                        />
                        
                    </div>
                </div>
                
           
        </div>
    </div>
    <div class="card-footer bg-transparent mt-3">
        <x-form.button type="submit" class="settingsSubmitButton btn-sm"><i data-feather="save"></i>{{ localize('Save Configuration') }}</x-form.button>
    </div>
</form>
</div>