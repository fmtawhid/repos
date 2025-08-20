<?php

namespace App\Services\Business;

/**
 * Class CustomerPlanRouteService.
 */
class CustomerPlanRouteService
{

    public function customerPlanRoutes(): array
    {
        $roles              = $this->getRolesRoutes();
        $users              = $this->getUsersRoutes();
        $tickets            = $this->getTicketsRoutes();
        $templates          = $this->getTemplatesRoutes();
        $images             = $this->getImagesRoutes();
        $audios             = $this->getAudiosRoutes();
        $aiWriters          = $this->getAiWriterRoutes();
        $aiReWriters        = $this->getAiReWriterRoutes();
        $commonRoutes       = $this->getCommonRoutes();

        return array_merge(
            $commonRoutes,
            $roles,
            $users,
            $tickets,
            $templates,
            $images,
            $audios,
            $aiWriters,
            $aiReWriters
        );
    }

    public function getAiReWriterRoutes()
    {
        return [
            'admin.ai-rewriter.create'             => 'allow_ai_rewriter',
            'admin.ai-rewriter.index'              => 'allow_ai_rewriter',
            'admin.ai-rewriter.show'               => 'allow_ai_rewriter',
            'admin.ai-rewriter.edit'               => 'allow_ai_rewriter',
            'admin.ai-rewriter.store'              => 'allow_ai_rewriter',
            'admin.ai-rewriter.destroy'            => 'allow_ai_rewriter',
            'admin.ai-rewriter.update'             => 'allow_ai_rewriter',


        ];
    }

    public function getAiWriterRoutes()
    {
        return [
            'admin.ai-writer.create'             => 'allow_ai_writer',
            'admin.ai-writer.index'              => 'allow_ai_writer',
            'admin.ai-writer.show'               => 'allow_ai_writer',
            'admin.ai-writer.store'              => 'allow_ai_writer',
            'admin.ai-writer.edit'               => 'allow_ai_writer',
            'admin.ai-writer.destroy'            => 'allow_ai_writer',
            'admin.ai-writer.update'             => 'allow_ai_writer',

            // AI Writer Content & Save Changes
            "admin.ai-writer.generate"           => "allow_ai_writer",
            "admin.ai-writer.save-change"        => "allow_ai_writer"
        ];
    }


    public function getRolesRoutes(): array
    {
        return [
            'admin.roles.index'    => 'allow_team',
            'admin.roles.create'   => 'allow_team',
            'admin.roles.store'    => 'allow_team',
            'admin.roles.show'     => 'allow_team',
            'admin.roles.edit'     => 'allow_team',
            'admin.roles.update'   => 'allow_team',
            'admin.roles.destroy'  => 'allow_team',
        ];
    }

    public function getUsersRoutes(): array
    {
        return [
            'admin.users.index'    => 'allow_team',
            'admin.users.create'   => 'allow_team',
            'admin.users.store'    => 'allow_team',
            'admin.users.show'     => 'allow_team',
            'admin.users.edit'     => 'allow_team',
            'admin.users.update'   => 'allow_team',
            'admin.users.destroy'  => 'allow_team',
        ];
    }

    public function getTicketsRoutes(): array
    {
        return [
            'admin.support-tickets.index'    => 'has_free_support',
            'admin.support-tickets.create'   => 'has_free_support',
            'admin.support-tickets.store'    => 'has_free_support',
            'admin.support-tickets.show'     => 'has_free_support',
            'admin.support-tickets.edit'     => 'has_free_support',
            'admin.support-tickets.update'   => 'has_free_support',
            'admin.support-tickets.destroy'  => 'has_free_support',

            // Support Categories
            "admin.support-categories.index",
            "admin.support-priorities.index",

            // Replies
            'admin.support-replies.index'    => 'has_free_support',
            'admin.support-replies.create'   => 'has_free_support',
            'admin.support-replies.store'    => 'has_free_support',
            'admin.support-replies.show'     => 'has_free_support',
            'admin.support-replies.edit'     => 'has_free_support',
            'admin.support-replies.update'   => 'has_free_support',
            'admin.support-replies.destroy'  => 'has_free_support',

            // Individual Reply View
            "admin.support-tickets.reply"    => "has_free_support"
        ];
    }

    public function getTemplatesRoutes(): array
    {

        return [
            'admin.templates.index'   => 'allow_templates',
            'admin.templates.create'  => 'allow_templates',
            'admin.templates.store'   => 'allow_templates',
            'admin.templates.show'    => 'allow_templates',
            'admin.templates.edit'    => 'allow_templates',
            'admin.templates.update'  => 'allow_templates',
            'admin.templates.destroy' => 'allow_templates',

            'admin.templates.saveContent'  => 'allow_templates',
            'admin.templates.stream'       => 'allow_templates',
        ];
    }

    public function getImagesRoutes(): array
    {

        return [
            "admin.images.index"                    => "allow_images",
            "admin.images.generateImage"            => "allow_images",
            "admin.images.destroy"                  => "allow_images",

            // Open AI
            "admin.images.dallE2"                   => "allow_dall_e_2_image",
            "admin.images.dallE3"                   => "allow_dall_e_3_image",

            //Stable Diffusion
            "admin.images.sdText2Image"             => "allow_sd_images",
            "admin.images.sdImage2ImageMultiPrompt" => "allow_images",
            "admin.images.sdImage2ImagePrompt"      => "allow_images",
            "admin.images.sdImage2ImageMasking"     => "allow_images",
            "admin.images.sdImage2ImageUpscale"     => "allow_images",


            //Photo Studio
            "admin.photoStudio.index"                    => "allow_ai_photo_studio",
            "admin.photoStudio.generatePhotoStudioImage" => "allow_ai_photo_studio",

            // Product Shot
            "admin.productShot.index"                    => "allow_ai_product_shot",
            "admin.productShot.generateProductShotImage" => "allow_ai_product_shot",
        ];
    }



    public function getAudiosRoutes(): array
    {
        return [
            "admin.voice-to-text.index"   => "allow_speech_to_text",
            "admin.voice-to-text.create"  => "allow_speech_to_text",
            "admin.voice-to-text.show"    => "allow_speech_to_text",
            "admin.voice-to-text.edit"    => "allow_speech_to_text",
            "admin.voice-to-text.update"  => "allow_speech_to_text",
            "admin.voice-to-text.destroy" => "allow_speech_to_text",

            // Voice Clone
            "admin.voice.index"              => "allow_voice_clone",
            "admin.voice.cloneVoice"         => "allow_voice_clone",

            // text to speech
            "admin.text-to-speeches.index"   => "allow_text_to_speech",
            "admin.text-to-speeches.create"  => "allow_text_to_speech",
            "admin.text-to-speeches.show"    => "allow_text_to_speech",
            "admin.text-to-speeches.edit"    => "allow_text_to_speech",
            "admin.text-to-speeches.update"  => "allow_text_to_speech",
            "admin.text-to-speeches.destroy" => "allow_text_to_speech",

        ];
    }


    public function getCommonRoutes(): array
    {
        return [
            "admin.profile",
            "admin.profile",
            "admin.info-update",
            "admin.change-password",
            "admin.users.updateBalance",
            "admin.balance-render",

            // Subscriptions
            "admin.subscription-plans.index",
            "admin.subscription-plans.package-update",
            "admin.subscription-plans.get-price",

            // Plan
            "admin.plan-histories.index",
            "admin.plan-histories.show",
            "admin.plan-invoice.index",
            "admin.plan-invoice.download",

            // Documents
            "admin.documents.index",
            "admin.generated-content.show",
            "admin.generated-content.update",
            "admin.generated-content.destroy",

            // Folders
            "admin.folders.index",
            "admin.folders.create",
            "admin.folders.store",
            "admin.folders.edit",
            "admin.folders.update",
            "admin.folders.destroy",

            // Move Folder Content
            "admin.folders.move-folder-content",
            "admin.folders.move-folder",

            // Affiliate Routes
            "admin.affiliate.overview",
            "admin.affiliate.payments.index",
            "admin.affiliate.payout.configure",
            "admin.affiliate.payout.configureStore",
            "admin.affiliate.withdraw.index",
            "admin.affiliate.withdraw.store",
            "admin.affiliate.withdraw.update",
            "admin.affiliate.earnings.index",

            "admin.offline-payment-methods.index",
            "admin.offline-payment-methods.show",

            // Reports
            "admin.reports.words",
            "admin.reports.codes",
            "admin.reports.images",
            "admin.reports.s2t",
            "admin.reports.mostUsed",
            "admin.reports.subscriptions",

        ];
    }

}
