    <div class="card-body">
        <div class="tab-content">
           
            <form action="{{ route('admin.settings.store') }}" class="gemini-ai-form settingsForm" enctype="multipart/form-data" id="gemini-ai-form">
                @csrf
                <div class="row g-3">
                    <div class="col-md-12">
                        <x-form.label for="GEMINIAI_SECRET_KEY"
                            label="{{ localize('GEMINI AI Secret Key') }}" isRequired=true />
                        <x-form.input name="env[GEMINIAI_SECRET_KEY]"
                            id="GEMINIAI_SECRET_KEY" type="text" required
                            placeholder="************************************" value="{{getSetting('GEMINIAI_SECRET_KEY')}}"
                            showDiv=false />
                            <span>{{localize('Uses only :AI code, Template, AI Blog Wizard, AI Writer')}}</span>
                    </div>
                    
                    <div class="col-12">
                        <button type="submit" class="btn btn-sm btn-primary settingsSubmitButton" id="geminiSubmitButton">
                            {{ localize('Save Configuration') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>