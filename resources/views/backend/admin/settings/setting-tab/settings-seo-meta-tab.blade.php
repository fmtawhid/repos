<div class="card">
    <form action="{{ route('admin.settings.store') }}" class="settings-seo-meta-form settingsForm" enctype="multipart/form-data" id="settings-seo-meta-form">
        <div class="card-header">
            <h5 class="mb-0">{{ localize('SEO Meta Configuration') }}</h5>
        </div>
    <div class="card-body">
        <div class="tab-content">
           
                @csrf
                <div class="row g-3">
                    <div class="col-md-12">

                        <x-form.label for="global_meta_title" label="{{ localize('Meta Title') }}"
                            isRequired=true />
                        <x-form.input name="settings[global_meta_title]" id="global_meta_title"
                            type="text" placeholder="{{ localize('Type meta title') }}"
                            value="" showDiv=false />
                            {{ localize('Set a meta tag title. Recommended to be simple and unique.') }}
                    </div>

                    <div class="col-md-12">
                        <x-form.label for="global_meta_description"
                            label="{{ localize('Meta Description') }}"
                            isRequired=true />
                          
                        <x-form.textarea name="settings[global_meta_description]" id="global_meta_description"
                            type="text" placeholder="{{ localize('Type your meta description') }}" value="" showDiv=false />
                    </div>
                    <div class="col-md-12">
                        <x-form.label for="global_meta_keywords"
                            label="{{ localize('Meta Keywords') }}" isRequired=true />
                        <x-form.textarea name="settings[global_meta_keywords]" id="global_meta_keywords"
                            type="text" placeholder="Keyword, Keyword"
                            value="" showDiv=false />
                    </div>
                    
                    <div class="col-md-12">
                        <label class="form-label">{{localize('Meta Image')}}</label>
                        <div class="file-drop-area file-upload text-center rounded-3">
                            <input type="file" class="file-drop-input" name="settings[global_meta_image]" />
                            <div class="file-drop-icon ci-cloud-upload">
                                <i data-feather="image"></i>
                            </div>
                            <p class="mb-0 file-name text-muted">
                                ({{localize('Only *jpg, png, webp will be accepted')}})
                            </p>
                        </div>
                    </div>
                </div>
           

        </div>
    </div>
    <div class="card-footer bg-transparent mt-3">
        <x-form.button type="submit" class="settingsSubmitButton btn-sm"><i data-feather="save"></i>{{ localize('Save Configuration') }}</x-form.button>
    </div>
</form>
</div>