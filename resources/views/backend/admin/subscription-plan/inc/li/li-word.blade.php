@if (   getSetting('enable_ai_chat') != '0' ||
                           getSetting('enable_generate_code') != '0' ||
                           getSetting('enable_templates') != '0')
    <li>
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <span>
                    <i data-feather="check-circle" class="icon-14 me-2 text-success"></i>
                    <strong
                            class="tt_update_text"
                            id="allow_word_text"
                            data-name="total_words_per_month"
                            onkeypress="nonNumericFilter()">
                        {{ $subscriptionPlan->allow_unlimited_word == 1 ? localize('Unlimited') : $subscriptionPlan->total_words_per_month }}
                    </strong>

                    {{ $subscriptionPlan->package_type != 'prepaid' && $subscriptionPlan->package_type != 'starter' ? localize('Words per month') : localize('Words') }}
                </span>

                <span class="tt-edit-icon ms-2 text-muted {{$subscriptionPlan->allow_unlimited_word == 1 ? 'd-none' : ''}}"
                      id="allow_word_edit">
                    <i class="tt_editable cursor-pointer icon-14"
                       data-name="total_words_per_month"
                       data-feather="edit"></i>
                </span>
            </div>

            <div class="d-flex align-items-center gap-4">
                <div class="form-check tt-checkbox">
                    <input class="form-check-input cursor-pointer  unlimited_balance unlimited_word"
                           type="checkbox"
                           id="allow_unlimited_word"
                           data-name="allow_unlimited_word"
                           @if ($subscriptionPlan->allow_unlimited_word == 1) checked @endif>
                </div>
                <div class="form-check tt-checkbox">
                    <input class="form-check-input cursor-pointer tt_editable"
                           type="checkbox"
                           id="show_words"
                           data-name="show_words"
                           @if ($subscriptionPlan->show_words == 1) checked @endif>
                </div>

                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input cursor-pointer tt_editable"
                           id="allow_words"
                           data-name="allow_words"
                           @if ($subscriptionPlan->allow_words == 1) checked @endif>
                </div>
            </div>
        </div>

        <ul class="list-unstyled ms-4 my-2">


            @if (getSetting('enable_ai_chat') != '0')
                <li class="p-0 d-flex justify-content-between align-items-center">
                                        <span>- <label for="allow_ai_chat"
                                                       class="cursor-pointer">{{ localize('AI Chat') }}</label></span>
                    <div class="d-flex align-items-center gap-4">
                        <div class="form-check tt-checkbox">
                            <input class="form-check-input cursor-pointer tt_editable"
                                   type="checkbox" id="show_ai_chat"
                                   data-name="show_ai_chat"
                                   @if ($subscriptionPlan->show_ai_chat == 1) checked @endif>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input cursor-pointer tt_editable"
                                   id="allow_ai_chat"
                                   data-name="allow_ai_chat"
                                   @if ($subscriptionPlan->allow_ai_chat == 1) checked @endif>
                        </div>
                    </div>
                </li>
                <li class="p-0 d-flex justify-content-between align-items-center">
                                        <span>- <label for="allow_real_time_data"
                                                       class="cursor-pointer">{{ localize('Chat Real Time Data') }}</label></span>
                    <div class="d-flex align-items-center gap-4">
                        <div class="form-check tt-checkbox">
                            <input class="form-check-input cursor-pointer tt_editable"
                                   type="checkbox" id="show_real_time_data"
                                   data-name="show_real_time_data"
                                   @checked($subscriptionPlan->show_real_time_data == 1)
                            />
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input cursor-pointer tt_editable"
                                   id="allow_real_time_data"
                                   data-name="allow_real_time_data"
                                   @checked($subscriptionPlan->allow_real_time_data == 1)
                            />
                        </div>
                    </div>
                </li>
            @endif

            @if (getSetting('enable_ai_writer') != '0')
                <li class="p-0 d-flex justify-content-between align-items-center">
                    <span>-
                        <label for="allow_ai_rewriter" class="cursor-pointer">
                            {{ localize('AI Writer') }}
                        </label>
                    </span>
                    <div class="d-flex align-items-center gap-4">
                        <div class="form-check tt-checkbox">
                            <input class="form-check-input cursor-pointer tt_editable"
                                   type="checkbox"
                                   id="show_ai_writer"
                                   data-name="show_ai_writer"
                                   @checked($subscriptionPlan->show_ai_writer == 1)
                            />
                        </div>

                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input cursor-pointer tt_editable"
                                   id="allow_ai_writer"
                                   data-name="allow_ai_writer"
                                   @checked($subscriptionPlan->allow_ai_writer == 1)
                            />
                        </div>
                    </div>
                </li>
            @endif

            @if (getSetting('enable_ai_rewriter') != '0')
                <li class="p-0 d-flex justify-content-between align-items-center">
                                        <span>- <label for="allow_ai_rewriter"
                                                       class="cursor-pointer">{{ localize('AI ReWriter') }}</label></span>
                    <div class="d-flex align-items-center gap-4">
                        <div class="form-check tt-checkbox">
                            <input class="form-check-input cursor-pointer tt_editable"
                                   type="checkbox" id="show_ai_rewriter"
                                   data-name="show_ai_rewriter"
                                   @if ($subscriptionPlan->show_ai_rewriter == 1) checked @endif>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input cursor-pointer tt_editable"
                                   id="allow_ai_rewriter"
                                   data-name="allow_ai_rewriter"
                                   @if ($subscriptionPlan->allow_ai_rewriter == 1) checked @endif>
                        </div>
                    </div>
                </li>
            @endif

            @if (getSetting('enable_ai_vision') != '0')
                <li class="p-0 d-flex justify-content-between align-items-center">
                                        <span>- <label for="allow_ai_vision"
                                                       class="cursor-pointer">{{ localize('AI Vision') }}</label></span>
                    <div class="d-flex align-items-center gap-4">
                        <div class="form-check tt-checkbox">
                            <input class="form-check-input cursor-pointer tt_editable"
                                   type="checkbox" id="show_ai_vision"
                                   data-name="show_ai_vision"
                                   @if ($subscriptionPlan->show_ai_vision == 1) checked @endif>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input cursor-pointer tt_editable"
                                   id="allow_ai_vision"
                                   data-name="allow_ai_vision"
                                   @if ($subscriptionPlan->allow_ai_vision == 1) checked @endif>
                        </div>
                    </div>
                </li>
            @endif

            @if (getSetting('enable_ai_pdf_chat') != '0')
                <li class="p-0 d-flex justify-content-between align-items-center">
                                    <span>- <label for="allow_ai_vision"
                                                   class="cursor-pointer">{{ localize('AI PDF Chat') }}</label></span>
                    <div class="d-flex align-items-center gap-4">
                        <div class="form-check tt-checkbox">
                            <input class="form-check-input cursor-pointer tt_editable"
                                   type="checkbox" id="show_ai_pdf_chat"
                                   data-name="show_ai_pdf_chat"
                                   @if ($subscriptionPlan->show_ai_pdf_chat == 1) checked @endif>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input cursor-pointer tt_editable"
                                   id="allow_ai_pdf_chat"
                                   data-name="allow_ai_pdf_chat"
                                   @if ($subscriptionPlan->allow_ai_pdf_chat == 1) checked @endif>
                        </div>
                    </div>
                </li>
            @endif

            @if (getSetting('enable_generate_code') != '0')
                <li class="p-0 d-flex justify-content-between align-items-center">
                                        <span>- <label for="allow_ai_code"
                                                       class="cursor-pointer">{{ localize('AI Code') }}</label></span>
                    <div class="d-flex align-items-center gap-4">
                        <div class="form-check tt-checkbox">
                            <input class="form-check-input cursor-pointer tt_editable"
                                   type="checkbox" id="show_ai_code"
                                   data-name="show_ai_code"
                                   @if ($subscriptionPlan->show_ai_code == 1) checked @endif>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input cursor-pointer tt_editable"
                                   id="allow_ai_code"
                                   data-name="allow_ai_code"
                                   @if ($subscriptionPlan->allow_ai_code == 1) checked @endif>
                        </div>
                    </div>
                </li>
            @endif

            {{-- blog wizard --}}
            @if (getSetting('enable_ai_blog_wizard') != '0')
                <li class="p-0 d-flex justify-content-between align-items-center">
                                        <span>- <label for="allow_blog_wizard"
                                                       class="cursor-pointer">{{ localize('AI Blog Wizard') }}</label></span>
                    <div class="d-flex align-items-center gap-4">
                        <div class="form-check tt-checkbox">
                            <input class="form-check-input cursor-pointer tt_editable"
                                   type="checkbox" id="show_blog_wizard"
                                   data-name="show_blog_wizard"
                                   @if ($subscriptionPlan->show_blog_wizard == 1) checked @endif>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input cursor-pointer tt_editable"
                                   data-name="allow_blog_wizard"
                                   id="allow_blog_wizard"
                                   @if ($subscriptionPlan->allow_blog_wizard == 1) checked @endif>
                        </div>
                    </div>
                </li>
            @endif
            {{-- blog wizard --}}


            {{-- AI ai_plagiarism --}}
            @if (getSetting('enable_ai_plagiarism') != '0')
                <li class="p-0 d-flex justify-content-between align-items-center">
                                        <span>- <label for="allow_ai_plagiarism"
                                                       class="cursor-pointer">{{ localize('AI Plagiarism') }}</label></span>
                    <div class="d-flex align-items-center gap-4">
                        <div class="form-check tt-checkbox">
                            <input class="form-check-input cursor-pointer tt_editable"
                                   type="checkbox" id="show_ai_plagiarism"
                                   data-name="show_ai_plagiarism"
                                   @if ($subscriptionPlan->show_ai_plagiarism == 1) checked @endif>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input cursor-pointer tt_editable"
                                   data-name="allow_ai_plagiarism"
                                   id="allow_ai_plagiarism"
                                   @if ($subscriptionPlan->allow_ai_plagiarism == 1) checked @endif>
                        </div>
                    </div>
                </li>
            @endif
            {{-- AI plagiarism --}}

            {{-- AI _ai_detector --}}
            @if (getSetting('enable_ai_detector') != '0')
                <li class="p-0 d-flex justify-content-between align-items-center">
                                        <span>- <label for="allow_ai_detector"
                                                       class="cursor-pointer">{{ localize('AI Detector') }}</label></span>
                    <div class="d-flex align-items-center gap-4">
                        <div class="form-check tt-checkbox">
                            <input class="form-check-input cursor-pointer tt_editable"
                                   type="checkbox" id="show_ai_detector"
                                   data-name="show_ai_detector"
                                   @if ($subscriptionPlan->show_ai_detector == 1) checked @endif>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input cursor-pointer tt_editable"
                                   data-name="allow_ai_detector"
                                   id="allow_ai_detector"
                                   @if ($subscriptionPlan->allow_ai_detector == 1) checked @endif>
                        </div>
                    </div>
                </li>
            @endif
            {{-- AI plagiarism --}}
        </ul>
    </li>
@endif