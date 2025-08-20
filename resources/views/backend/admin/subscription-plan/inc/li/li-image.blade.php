@if (getSetting('enable_ai_images') != '0')
    <li>
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                                    <span><i data-feather="check-circle"
                                             class="icon-14 me-2 text-success"></i><strong class="tt_update_text"
                                                                                           data-name="total_images_per_month" id="allow_image_text"
                                                                                           onkeypress="nonNumericFilter()">{{ $subscriptionPlan->allow_unlimited_image == 1 ? localize('Unlimited') : $subscriptionPlan->total_images_per_month }}</strong>
                                        {{ $subscriptionPlan->package_type != 'prepaid' ? localize('Images per month') : localize('Images') }}</span>
                <span class="tt-edit-icon ms-2 text-muted {{$subscriptionPlan->allow_unlimited_image == 1 ? 'd-none' : ''}}" id="allow_image_edit"><i
                            class="tt_editable cursor-pointer icon-14"
                            data-name="total_images_per_month"
                            data-feather="edit"></i></span>
            </div>

            <div class="d-flex align-items-center gap-4">
                <div class="form-check tt-checkbox">
                    <input type="checkbox" class="form-check-input cursor-pointer  unlimited_balance"
                           data-name="allow_unlimited_image"
                           id="allow_unlimited_image"
                           @if ($subscriptionPlan->allow_unlimited_image == 1) checked @endif>
                </div>
                <div class="form-check tt-checkbox">
                    <input class="form-check-input cursor-pointer tt_editable" type="checkbox"
                           id="show_images"
                           data-name="show_images"
                           @if ($subscriptionPlan->show_images == 1) checked @endif>
                </div>
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input cursor-pointer tt_editable"
                           data-name="allow_images"
                           id="allow_images"
                           @if ($subscriptionPlan->allow_images == 1) checked @endif>
                </div>
            </div>
        </div>

        <ul class="list-unstyled ms-4 my-2">
            <li class="p-0 d-flex justify-content-between align-items-center">
                    <span>-
                        <label for="allow_dall_e_2_image"
                               class="cursor-pointer">{{ localize('Dall E 2') }}</label>
                    </span>
                <div class="d-flex align-items-center gap-4">
                    <div class="form-check tt-checkbox">
                        <input class="form-check-input cursor-pointer tt_editable"
                               type="checkbox"
                               id="show_dall_e_2_image"
                               data-name="show_dall_e_2_image"
                               @checked($subscriptionPlan->show_dall_e_2_image)
                        />
                    </div>

                    <div class="form-check form-switch">
                        <input type="checkbox"
                               class="form-check-input cursor-pointer tt_editable"
                               id="allow_dall_e_2_image"
                               data-name="allow_dall_e_2_image"
                               @checked($subscriptionPlan->allow_dall_e_2_image)
                        />
                    </div>
                </div>
            </li>

            <li class="p-0 d-flex justify-content-between align-items-center">
                                    <span>- <label for="allow_dall_e_3_image"
                                                   class="cursor-pointer">{{ localize('Dall E 3') }}</label></span>
                <div class="d-flex align-items-center gap-4">

                    <div class="form-check tt-checkbox">
                        <input class="form-check-input cursor-pointer tt_editable"
                               type="checkbox" id="show_dall_e_3_image"
                               data-name="show_dall_e_3_image"
                               @if ($subscriptionPlan->show_dall_e_3_image == 1) checked @endif>
                    </div>
                    <div class="form-check form-switch">
                        <input type="checkbox"
                               class="form-check-input cursor-pointer tt_editable"
                               id="allow_dall_e_3_image"
                               data-name="allow_dall_e_3_image"
                               @if ($subscriptionPlan->allow_dall_e_3_image == 1) checked @endif>
                    </div>
                </div>
            </li>

            <li class="p-0 d-flex justify-content-between align-items-center">
                                    <span>- <label for="allow_sd_images"
                                                   class="cursor-pointer">{{ localize('Stable Diffusion') }}</label></span>
                <div class="d-flex align-items-center gap-4">
                    <div class="form-check tt-checkbox">
                        <input class="form-check-input cursor-pointer tt_editable"
                               type="checkbox" id="show_sd_images"
                               data-name="show_sd_images"
                               @if ($subscriptionPlan->show_sd_images == 1) checked @endif>
                    </div>
                    <div class="form-check form-switch">
                        <input type="checkbox"
                               class="form-check-input cursor-pointer tt_editable"
                               id="allow_sd_images"
                               data-name="allow_sd_images"
                               @if ($subscriptionPlan->allow_sd_images == 1) checked @endif>
                    </div>
                </div>
            </li>

            @if (getSetting('enable_ai_chat_image') != '0')
                <li class="p-0 d-flex justify-content-between align-items-center">
                       <span>- <label for="allow_ai_image_chat"
                                      class="cursor-pointer">{{ localize('Chat Image') }}</label>
                       </span>
                    <div class="d-flex align-items-center gap-4">
                        <div class="form-check tt-checkbox">
                            <input class="form-check-input cursor-pointer tt_editable"
                                   type="checkbox" id="show_ai_image_chat"
                                   data-name="show_ai_image_chat"
                                   @if ($subscriptionPlan->show_ai_image_chat == 1) checked @endif>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input cursor-pointer tt_editable"
                                   id="allow_ai_image_chat"
                                   data-name="allow_ai_image_chat"
                                   @if ($subscriptionPlan->allow_ai_image_chat == 1) checked @endif>
                        </div>
                    </div>
                </li>
            @endif

            @if (getSetting('enable_ai_product_shot') != '0')
                <li class="p-0 d-flex justify-content-between align-items-center">
                        <span>- <label for="show_ai_product_shot"
                                       class="cursor-pointer">{{ localize('AI Product Shot') }}</label></span>
                    <div class="d-flex align-items-center gap-4">
                        <div class="form-check tt-checkbox">
                            <input class="form-check-input cursor-pointer tt_editable"
                                   type="checkbox"
                                   id="show_ai_product_shot"
                                   data-name="show_ai_product_shot"
                                   @if ($subscriptionPlan->show_ai_product_shot == 1) checked @endif>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input cursor-pointer tt_editable"
                                   id="allow_ai_product_shot"
                                   data-name="allow_ai_product_shot"
                                   @if ($subscriptionPlan->allow_ai_product_shot == 1) checked @endif>
                        </div>
                    </div>
                </li>
            @endif

            @if (getSetting('enable_ai_photo_studio') != '0')
                <li class="p-0 d-flex justify-content-between align-items-center">
                        <span>- <label for="show_ai_photo_studio"
                                       class="cursor-pointer">{{ localize('AI Photo Studio') }}</label></span>
                    <div class="d-flex align-items-center gap-4">
                        <div class="form-check tt-checkbox">
                            <input class="form-check-input cursor-pointer tt_editable"
                                   type="checkbox"
                                   id="show_ai_photo_studio"
                                   data-name="show_ai_photo_studio"
                                   @if ($subscriptionPlan->show_ai_photo_studio == 1) checked @endif>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input cursor-pointer tt_editable"
                                   id="allow_ai_photo_studio"
                                   data-name="allow_ai_photo_studio"
                                   @if ($subscriptionPlan->allow_ai_photo_studio == 1) checked @endif>
                        </div>
                    </div>
                </li>
            @endif

        </ul>
    </li>
@endif