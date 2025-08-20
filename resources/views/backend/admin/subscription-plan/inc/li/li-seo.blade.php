@if ($subscriptionPlan->show_seo || $subscriptionPlan->allow_seo)
    <li>
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <span>
                    <i data-feather="check-circle" class="icon-14 me-2 text-success"></i>
                    <strong class="tt_update_text"
                            data-name="package-total_seo_balance_per_month"
                            id="allow_seo"
                            onkeypress="nonNumericFilter()">
                       {{  $subscriptionPlan->total_seo_balance_per_month }}
                    </strong>
                
                     {{ $subscriptionPlan->package_type != 'prepaid' ? localize('SEO Content per month') : localize('SEO Content') }}
                </span>

                <span class="tt-edit-icon ms-2 text-muted"
                      id="allow_seo_edit">
                    <i
                        class="tt_editable cursor-pointer icon-14"
                        data-name="package-total_seo_balance_per_month"
                        data-feather="edit"></i>
                </span>
            </div>

            <div class="d-flex align-items-center gap-4">
                <div class="form-check tt-checkbox">

                </div>
                <div class="form-check tt-checkbox">
                    <input class="form-check-input cursor-pointer tt_editable"
                           type="checkbox"
                           id="show_seo"
                           data-name="show_seo"
                           @checked($subscriptionPlan->show_seo == 1)
                    />
                </div>

                <div class="form-check form-switch">
                    <input type="checkbox"
                           class="form-check-input cursor-pointer tt_editable"
                           data-name="allow_seo"
                           id="allow_seo"
                           @checked($subscriptionPlan->allow_seo == 1)
                    />
                </div>
            </div>
        </div>

        <ul class="list-unstyled ms-4 my-2">

            @if (getSetting('enable_seo_keywords') != '0')
                <li class="p-0 d-flex justify-content-between align-items-center">
                    <span>- <label for="show_seo_keyword"
                                   class="cursor-pointer">{{ localize('Bulk Keyword Analysis') }}</label></span>
                    <div class="d-flex align-items-center gap-4">
    
                        <div class="form-check tt-checkbox">
                            <input class="form-check-input cursor-pointer tt_editable"
                                   type="checkbox"
                                   id="show_seo_keyword"
                                   data-name="show_seo_keyword"
                                   @if ($subscriptionPlan->show_seo_keyword == 1) checked @endif
                            />
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input cursor-pointer tt_editable"
                                   id="allow_seo_keyword"
                                   data-name="allow_seo_keyword"
                                   @if ($subscriptionPlan->allow_seo_keyword == 1) checked @endif
                            />
                        </div>
                    </div>
                </li>
            @endif

            @if (getSetting('enable_helpful_content_analysis') != '0')
                <li class="p-0 d-flex justify-content-between align-items-center">
                                    <span>- <label for="allow_seo_helpful_content"
                                                   class="cursor-pointer">{{ localize('Helpful Content Optimization') }}</label></span>
                    <div class="d-flex align-items-center gap-4">

                        <div class="form-check tt-checkbox">
                            <input class="form-check-input cursor-pointer tt_editable"
                                   type="checkbox" 
                                   id="show_seo_helpful_content"
                                   data-name="show_seo_helpful_content"
                                   @if ($subscriptionPlan->show_seo_helpful_content == 1) checked @endif>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input cursor-pointer tt_editable"
                                   id="allow_seo_helpful_content"
                                   data-name="allow_seo_helpful_content"
                                   @if ($subscriptionPlan->allow_seo_helpful_content == 1) checked @endif>
                        </div>
                    </div>
                </li>
            @endif
            
            @if (getSetting('enable_seo_content_optimization') != '0')
                <li class="p-0 d-flex justify-content-between align-items-center">
                                    <span>- <label for="allow_seo_content_optimization"
                                                   class="cursor-pointer">{{ localize('SEO Content Optimizations') }}</label></span>
                    <div class="d-flex align-items-center gap-4">

                        <div class="form-check tt-checkbox">
                            <input class="form-check-input cursor-pointer tt_editable"
                                   type="checkbox"
                                   id="show_seo_content_optimization"
                                   data-name="show_seo_content_optimization"
                                   @checked($subscriptionPlan->show_seo_content_optimization == 1)
                            />
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input cursor-pointer tt_editable"
                                   id="allow_seo_content_optimization"
                                   data-name="allow_seo_content_optimization"
                                   @checked($subscriptionPlan->allow_seo_content_optimization == 1)
                            />
                        </div>
                    </div>
                </li>
            @endif
                

        </ul>
    </li>
@endif
