@if (getSetting('enable_speech_to_text') != '0')
    <li>
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                                    <span><i data-feather="check-circle"
                                             class="icon-14 me-2 text-success"></i>
                                            <strong class="tt_update_text"
                                                    data-name="package-total_speech_to_text_per_month" id="allow_speech_to_text_text"
                                                    onkeypress="nonNumericFilter()">{{ $subscriptionPlan->allow_unlimited_speech_to_text == 1 ? localize('Unlimited') : $subscriptionPlan->total_speech_to_text_per_month }}</strong>
                                        {{ $subscriptionPlan->package_type != 'prepaid' ? localize('Speech to Text per month') : localize('Speech to Texts') }}</span>
                <span class="tt-edit-icon ms-2 text-muted {{$subscriptionPlan->allow_unlimited_speech_to_text == 1 ? 'd-none' : ''}}"><i
                            class="tt_editable cursor-pointer icon-14" id="allow_speech_to_text_edit"
                            data-name="package-total_speech_to_text_per_month"
                            data-feather="edit"></i></span>
            </div>

            <div class="d-flex align-items-center gap-4">
                <div class="form-check tt-checkbox">
                    <input type="checkbox" class="form-check-input cursor-pointer unlimited_balance"
                           data-name="allow_unlimited_speech_to_text"
                           id="allow_unlimited_speech_to_text"
                           @if ($subscriptionPlan->allow_unlimited_speech_to_text == 1) checked @endif>
                </div>
                <div class="form-check tt-checkbox">
                    <input class="form-check-input cursor-pointer tt_editable" type="checkbox"
                           id="show_speech_to_text"
                           data-name="show_speech_to_text"
                           @if ($subscriptionPlan->show_speech_to_text == 1) checked @endif>
                </div>
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input cursor-pointer tt_editable"
                           data-name="allow_speech_to_text"
                           id="allow_speech_to_text"
                           @if ($subscriptionPlan->allow_speech_to_text == 1) checked @endif>
                </div>
            </div>
        </div>

        <ul class="list-unstyled ms-4 my-2">
            <li class="p-0 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                                        <span>- </i><strong class="tt_update_text"
                                                            data-name="package-speech_to_text_filesize_limit"
                                                            onkeypress="nonNumericFilter()">{{ $subscriptionPlan->speech_to_text_filesize_limit }}</strong>
                                            MB {{ localize('Audio file size limit') }}</span>
                    <span class="tt-edit-icon ms-2 text-muted"><i
                                class="tt_editable cursor-pointer icon-14"
                                data-name="package-speech_to_text_filesize_limit"
                                data-feather="edit"></i></span>
                </div>
            </li>
        </ul>
    </li>
@endif