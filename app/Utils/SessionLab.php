<?php

namespace App\Utils;

class SessionLab
{
    # Article
    const SESSION_ARTICLE_PROMPT       = "session_article_prompt";
    const SESSION_ARTICLE_CONTENTS     = "session_article_contents";
    const SESSION_META_DESCRIPTION     = "session_meta_description";

    # text Generation
    const SESSION_GENERATE_TEXT        = "session_generate_text";
    const SESSION_GENERATE_TEXT_ID     = "session_generate_text_id";
    const SESSION_GENERATE_TEXT_PROMPT = "session_generate_text_prompt";

    # Cloning
    const SESSION_VOICE_CLONE = "session_voice_clone";

    # Code Generation
    const SESSION_CODE_PROMPT              = "session_code_prompt";
    const SESSION_CODE_CONTENTS            = "session_code_contents";
    const SESSION_ARTICLE_TITLE            = "session_article_title";
    const SESSION_ARTICLE_ID               = "session_article_id";
    const SESSION_ARTICLE_OUTLINES         = "session_article_outlines";
    const SESSION_ARTICLE_PLATFORM         = "session_article_platform";
    const SESSION_T2V_PLATFORM             = "session_t2v_platform";

    # AI Chat
    const SESSION_AI_CHAT_PROMPT           = "session_ai_chat_prompt";
    const SESSION_AI_CHAT_CONTENTS         = "session_ai_chat_contents";
    const SESSION_TEMPLATE_CONTENTS_PROMPT = "session_template_contents_prompt";
    const SESSION_AI_VISION_PROMPT         = "session_ai_vision_prompt";
    const SESSION_AI_VISION_CONTENTS       = "session_ai_vision_contents";

    #Expert
    const SESSION_CHAT_EXPERT_ID              = "session_chat_expert_id";
    const SESSION_CHAT_THREAD_ID              = "session_chat_thread_id";
    const SESSION_CHAT_THREAD_CONVERSATION_ID = "session_chat_thread_conversation_id";
    const SESSION_CHAT_RANDOM_NUMBER          = "session_chat_random_number";
    const SESSION_AI_VISION_IMAGES            = "session_ai_vision_images";

    #Audio 

    const SESSION_TEXT_TO_SPEECH_OPEN_AI   = "session_t2s_open_ai";
    const SESSION_SPEECH_TO_TEXT_OPEN_AI   = "session_s2t_open_ai";

    #AI Code
    const SESSION_AI_CODE_PROMPT           = "session_ai_code_prompt";
    const SESSION_AI_CODE_CONTENTS         = "session_ai_code_contents";


    const SESSION_OPEN_AI_ERROR        = "session_open_ai_error";
    const SESSION_ELEVEN_LABS_ERROR    = "session_eleven_labs_error";
    const SESSION_GOOGLE_ERROR         = "session_google_error";

    const SESSION_SUBSCRIPTION_PLAN_ID = "session_subscription_plan_id";

    #Template Content
    const SESSION_TEMPLATE_PROMPT = "session_template_prompt";
    const SESSION_TEMPLATE_CONTENTS = "session_template_contents";
    const SESSION_TEMPLATE_GENERATED_CONTENT_ID = "session_template_generated_content_id";

    #Pdf Chat
    const SESSION_PDF_CHAT_PDF_CONTENT = "session_pdf_chat_pdf_content";

    const SESSION_PDF_STREAM_CONTENT = "session_pdf_stream_content";
    const SESSION_PDF_CHAT_PROMPT_CONTENT  = "session_pdf_chat_prompt_content";

    const SESSION_TEST_X = "update_session_test2";

}