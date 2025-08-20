@if (getSetting('enable_ai_video') != '0')
    <li>
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <span>
                    <i data-feather="check-circle"
                         class="icon-14 me-2 text-success"></i>
                        <strong class="tt_update_text"
                                data-name="package-total_ai_video_per_month"
                                id="allow_ai_video_text"
                                onkeypress="nonNumericFilter()">{{ $subscriptionPlan->allow_unlimited_ai_video == 1 ? localize('Unlimited') : $subscriptionPlan->total_ai_video_per_month }}</strong>
                        {{ $subscriptionPlan->package_type != 'prepaid' ? localize('AI Video per month') : localize('AI Video') }}
                </span>

                <span class="tt-edit-icon ms-2 text-muted {{$subscriptionPlan->allow_unlimited_ai_video == 1 ? 'd-none' : ''}}">
                    <i  class="tt_editable cursor-pointer icon-14" id="allow_ai_video_edit"
                        data-name="package-total_ai_video_per_month"
                        data-feather="edit"></i>
                </span>
            </div>

            <div class="d-flex align-items-center gap-4">
                <div class="form-check tt-checkbox">
                    <input type="checkbox" class="form-check-input cursor-pointer unlimited_balance"
                           data-name="allow_unlimited_ai_video"
                           id="allow_unlimited_ai_video"
                           @if ($subscriptionPlan->allow_unlimited_ai_video == 1) checked @endif>
                </div>

                <div class="form-check tt-checkbox">
                    <input class="form-check-input cursor-pointer tt_editable" type="checkbox"
                           id="show_ai_video"
                           data-name="show_ai_video"
                           @checked($subscriptionPlan->show_ai_video)
                    />
                </div>

                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input cursor-pointer tt_editable"
                           data-name="allow_ai_video"
                           id="allow_ai_video"
                           @checked($subscriptionPlan->allow_ai_video)
                    />
                </div>
            </div>
        </div>
        <ul class="list-unstyled ms-4 my-2">
            @if (getSetting('enable_ai_avatar_pro') != '0')
                <li class="p-0 d-flex justify-content-between align-items-center">
                       <span>-
                           <label for="allow_ai_image_chat"
                                  class="cursor-pointer">{{ localize('AI Avatar Pro') }}</label>
                       </span>
                    <div class="d-flex align-items-center gap-4">
                        <div class="form-check tt-checkbox">
                            <input class="form-check-input cursor-pointer tt_editable"
                                   type="checkbox"
                                   id="show_ai_avatar_pro"
                                   data-name="show_ai_avatar_pro"
                                   @checked($subscriptionPlan->show_ai_avatar_pro)
                            />
                        </div>

                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input cursor-pointer tt_editable"
                                   id="allow_ai_avatar_pro"
                                   data-name="allow_ai_avatar_pro"
                                   @checked($subscriptionPlan->allow_ai_avatar_pro)
                            />
                        </div>
                    </div>
                </li>
            @endif
        </ul>
    </li>
@endif