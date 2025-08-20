@if (getSetting('enable_text_to_speech') != '0')
    <li>
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                                    <span><i data-feather="check-circle"
                                             class="icon-14 me-2 text-success"></i><strong class="tt_update_text"
                                                                                           data-name="package-total_text_to_speech_per_month" id="allow_text_to_speech"
                                                                                           onkeypress="nonNumericFilter()">{{ $subscriptionPlan->allow_unlimited_text_to_speech == 1 ? localize('Unlimited') : $subscriptionPlan->total_text_to_speech_per_month }}</strong>
                                        {{ $subscriptionPlan->package_type != 'prepaid' ? localize('Text To Speech per month') : localize('Text To Speech') }}</span>
                <span class="tt-edit-icon ms-2 text-muted {{$subscriptionPlan->allow_unlimited_text_to_speech == 1 ? 'd-none' : ''}}"
                        id="allow_text_to_speech_edit"><i
                            class="tt_editable cursor-pointer icon-14"
                            data-name="package-total_text_to_speech_per_month"
                            data-feather="edit"></i></span>
            </div>

            <div class="d-flex align-items-center gap-4">
                <div class="form-check tt-checkbox">
                    <input type="checkbox" class="form-check-input cursor-pointer  unlimited_balance"
                           data-name="allow_unlimited_text_to_speech"
                           id="allow_unlimited_text_to_speech"
                           @if ($subscriptionPlan->allow_unlimited_text_to_speech == 1) checked @endif>
                </div>
                <div class="form-check tt-checkbox">
                    <input class="form-check-input cursor-pointer tt_editable" type="checkbox"
                           id="show_text_to_speech"
                           data-name="show_text_to_speech"
                           @if ($subscriptionPlan->show_text_to_speech == 1) checked @endif>
                </div>
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input cursor-pointer tt_editable"
                           data-name="allow_text_to_speech"
                           id="allow_text_to_speech"
                           @if ($subscriptionPlan->allow_text_to_speech == 1) checked @endif>
                </div>
            </div>
        </div>

        <ul class="list-unstyled ms-4 my-2">

            <li class="p-0 d-flex justify-content-between align-items-center">
                                    <span>- <label for="allow_text_to_speech_open_ai"
                                                   class="cursor-pointer">{{ localize('Open AI') }}</label></span>
                <div class="d-flex align-items-center gap-4">

                    <div class="form-check tt-checkbox">
                        <input class="form-check-input cursor-pointer tt_editable"
                               type="checkbox" id="show_text_to_speech_open_ai"
                               data-name="show_text_to_speech_open_ai"
                               @if ($subscriptionPlan->show_text_to_speech_open_ai == 1) checked @endif>
                    </div>
                    <div class="form-check form-switch">
                        <input type="checkbox"
                               class="form-check-input cursor-pointer tt_editable"
                               id="allow_text_to_speech_open_ai"
                               data-name="allow_text_to_speech_open_ai"
                               @if ($subscriptionPlan->allow_text_to_speech_open_ai == 1) checked @endif>
                    </div>
                </div>
            </li>

            @if (getSetting('enable_eleven_labs') != '0')
                <li class="p-0 d-flex justify-content-between align-items-center">
                                    <span>- <label for="allow_eleven_labs"
                                                   class="cursor-pointer">{{ localize('Elevenlabs') }}</label></span>
                    <div class="d-flex align-items-center gap-4">

                        <div class="form-check tt-checkbox">
                            <input class="form-check-input cursor-pointer tt_editable"
                                   type="checkbox" id="show_eleven_labs"
                                   data-name="show_eleven_labs"
                                   @if ($subscriptionPlan->show_eleven_labs == 1) checked @endif>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input cursor-pointer tt_editable"
                                   id="allow_eleven_labs"
                                   data-name="allow_eleven_labs"
                                   @if ($subscriptionPlan->allow_eleven_labs == 1) checked @endif>
                        </div>
                    </div>
                </li>
            @endif
            @if (getSetting('enable_google_cloud') != '0')
                <li class="p-0 d-flex justify-content-between align-items-center">
                                    <span>- <label for="allow_google_cloud"
                                                   class="cursor-pointer">{{ localize('Google Cloud') }}</label></span>
                    <div class="d-flex align-items-center gap-4">

                        <div class="form-check tt-checkbox">
                            <input class="form-check-input cursor-pointer tt_editable"
                                   type="checkbox" id="show_google_cloud"
                                   data-name="show_google_cloud"
                                   @if ($subscriptionPlan->show_google_cloud == 1) checked @endif>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input cursor-pointer tt_editable"
                                   id="allow_google_cloud"
                                   data-name="allow_google_cloud"
                                   @if ($subscriptionPlan->allow_google_cloud == 1) checked @endif>
                        </div>
                    </div>
                </li>
            @endif
            @if (getSetting('enable_azure') != '0')
                <li class="p-0 d-flex justify-content-between align-items-center">
                                    <span>- <label for="allow_azure"
                                                   class="cursor-pointer">{{ localize('Azure') }}</label></span>
                    <div class="d-flex align-items-center gap-4">

                        <div class="form-check tt-checkbox">
                            <input class="form-check-input cursor-pointer tt_editable"
                                   type="checkbox" id="show_azure"
                                   data-name="show_azure"
                                   @if ($subscriptionPlan->show_azure == 1) checked @endif>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input cursor-pointer tt_editable"
                                   id="allow_azure"
                                   data-name="allow_azure"
                                   @if ($subscriptionPlan->allow_azure == 1) checked @endif>
                        </div>
                    </div>
                </li>
            @endif

        </ul>
    </li>
@endif
