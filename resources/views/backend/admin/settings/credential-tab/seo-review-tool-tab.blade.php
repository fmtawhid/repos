<div class="card">
    <form action="{{ route('admin.settings.store') }}"
          class="serper-form settingsForm"
          enctype="multipart/form-data"
          id="seoReviewTool-form">
        <div class="card-header">
            <h5 class="mb-0">{{ localize('SEO Review Tool Setup') }}</h5>
        </div>
        <div class="card-body">
            <div class="tab-content">
                @csrf
                <div class="row g-3">
                    <div class="col-md-12">
                        <x-form.label for="seo_review_tool_api_key"
                                      label="{{ localize('SEO Review Tool Api key for real time data') }}"
                                      isRequired=true />
                        <x-form.input name="settings[seo_review_tool_api_key]"
                                      id="seo_review_tool_api_key"
                                      type="text"
                                      placeholder="************************************"
                                      value="{{getSetting('seo_review_tool_api_key')}}"
                                      showDiv=false />
                    </div>

                    <div class="col-md-12">
                        <x-form.label for="enable_seo_review_tool" label="{{ localize('Enable SEO Review Tool ?') }}" />
                        <x-form.select name="settings[enable_seo_review_tool]" id="enable_seo_review_tool">
                            <option value="0" {{ getSetting('enable_seo_review_tool') == '0' ? 'selected' : '' }}>{{ localize('Disable') }}</option>
                            <option value="1" {{ getSetting('enable_seo_review_tool') == '1' ? 'selected' : '' }}>{{ localize('Enable') }}</option>
                        </x-form.select>
                    </div>

                    <div class="col-md-12">
                        <x-form.label for="bulk_keyword_research_per_request_credit_cost" label="{{ localize('Keyword Analysis per request credit cost? Official Cost: 4 credits per Keyword Analysis') }}" />                        
                        <x-form.input name="settings[bulk_keyword_research_per_request_credit_cost]" id="bulk_keyword_research_per_request_credit_cost" type="text" required placeholder="Ex. 4" value="{{getSetting('bulk_keyword_research_per_request_credit_cost', 4)}}" showDiv=false />
                        <small class="w-100 d-block">{{ localize("How much credit will be deducted from customer balance when the customer will generate the keywords.") }}</small>
                    </div>

                    <div class="col-md-12">
                        <x-form.label for="content_optimization" label="{{ localize('SEO Content Optimization per request credit cost? Official Cost: 1 credit per SEO Check') }}" />
                        <x-form.input name="settings[content_optimization_per_request_credit_cost]" id="content_optimization" type="text" required placeholder="Ex. 1" value="{{getSetting('content_optimization_per_request_credit_cost', 1)}}" showDiv=false />
                        <small class="w-100 d-block">{{ localize("How much credit will be deducted from customer balance when the customer will check the SEO.") }}</small>
                    </div>

                    <div class="col-md-12">
                        <x-form.label for="helpful_content_optimization_per_request_credit_cost" label="{{ localize('Helpful Content Analysis per request credit cost? Official Cost: 6 credits per SEO Check') }}" />
                        <x-form.input name="settings[helpful_content_optimization_per_request_credit_cost]" id="helpful_content_optimization" type="text" required placeholder="Ex. 6" value="{{getSetting('helpful_content_optimization_per_request_credit_cost', 6)}}" showDiv=false />
                        <small class="w-100 d-block">{{ localize("How much credit will be deducted from customer balance when the customer will check the SEO.") }}</small>
                    </div>

                </div>

            </div>
        </div>
        <div class="card-footer bg-transparent mt-3">
            <x-form.button type="submit" class="settingsSubmitButton btn-sm"><i data-feather="save"></i>{{ localize('Save Configuration') }}</x-form.button>
        </div>
    </form>
</div>