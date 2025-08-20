<?php

namespace App\Services\Feature;

class FeatureService
{
    public function aiFeatureList(): array
    {
        return [


            // Generate with HeyGen
            'enable_ai_avatar_pro' => [
                'title'       => 'AI Avatar Pro',
                'description' => localize('If this feature is disabled, no one will not have access to it. If enabled, the customer can chat with AI Video expert if this feature is included in their package'),
                'is_active'   => getSetting('enable_ai_avatar_pro') ? 1 : 0
            ],

            'enable_ai_images' => [
                'title'       => 'AI Image',
                'description' => localize('If this feature is disabled, no one will not have access to it. If enabled, the customer can generate image if this feature is included in their package'),
                'is_active'   => getSetting('enable_ai_images') ? 1 : 0
            ],
            'enable_ai_chat_image' => [
                'title'       => 'AI Chat Image',
                'description' => localize('If this feature is disabled, no one will not have access to it. If enabled, the customer can chat with AI Image expert if this feature is included in their package'),
                'is_active'   => getSetting('enable_ai_chat_image') ? 1 : 0
            ],

            // Generate with Pebblely
            'enable_ai_product_shot' => [
                'title'       => 'AI Product Shot',
                'description' => localize('If this feature is disabled, no one will not have access to it. If enabled, the customer can generate image if this feature is included in their package'),
                'is_active'   => getSetting('enable_ai_product_shot') ? 1 : 0
            ],

            // Generate with ClipDrop
            'enable_ai_photo_studio' => [
                'title'       => 'AI PHOTO Studio',
                'description' => localize('If this feature is disabled, no one will not have access to it. If enabled, the customer can generate image if this feature is included in their package'),
                'is_active'   => getSetting('enable_ai_photo_studio') ? 1 : 0
            ],

            'enable_ai_detector' => [
                'title'       => 'AI Detector',
                'description' => localize('If this feature is disabled, no one will not have access to it.If enabled, the customer can check Detect content with AI if this feature is included in their package'),
                'is_active'   => getSetting('enable_ai_detector') ? 1 : 0
            ],
            'enable_ai_plagiarism' => [
                'title'       => 'AI Plagiarism',
                'description' => localize('If this feature is disabled, no one will not have access to it.If enabled, the customer can check Plagiarism with AI if this feature is included in their package'),
                'is_active'   => getSetting('enable_ai_plagiarism') ? 1 : 0
            ],

            'enable_speech_to_text' => [
                'title'       => 'Speech to Text',
                'description' =>  localize('If this feature is disabled, no one will not have access to it.If enabled, the customer can convert Speech to Text if this feature is included in their package'),
                'is_active'   => getSetting('enable_speech_to_text') ? 1 : 0
            ],
            'enable_text_to_speech' => [
                'title'       => 'Text To Speech',
                'description' =>  localize('If this feature is disabled, no one will not have access to it.If enabled, the customer can convert text to speech if this feature is included in their package'),
                'is_active'   => getSetting('enable_text_to_speech') ? 1 : 0
            ],
            'enable_eleven_labs' => [
                'title'       => 'ElevenLabs',
                'description' =>  localize('If this feature is disabled, no one will not have access to it.If enabled, the customer can convert text to speech if this feature is included in their package'),
                'is_active'   => getSetting('enable_eleven_labs') ? 1 : 0
            ],
            'enable_google_cloud' => [
                'title'       => 'Google Cloud',
                'description' =>  localize('If this feature is disabled, no one will not have access to it.If enabled, the customer can convert text to speech if this feature is included in their package'),
                'is_active'   => getSetting('enable_google_cloud') ? 1 : 0
            ],
            'enable_azure' => [
                'title'       => 'Azure',
                'description' =>  localize('If this feature is disabled, no one will not have access to it.If enabled, the customer can convert text to speech if this feature is included in their package'),
                'is_active'   => getSetting('enable_azure') ? 1 : 0
            ],
            'enable_generate_image' => [
                'title'       => 'Generate Images',
                'description' =>  localize('If this feature is disabled, no one will not have access to it'),
                'is_active'   => getSetting('enable_generate_image') ? 1 : 0
            ],
            'enable_generate_image_step' => [
                'title'       => 'Generate Images Step AI Blog Wizard',
                'description' => localize('If this feature is disabled, can not generate image when blog article generate'),
                'is_active'   => getSetting('enable_generate_image_step') ? 1 : 0
            ],

        ];
    }

    public function subscriptionFeatures(): array
    {
        return [
            'balance_carry_forward' => [
                'title'       => 'Balance Carry Forward:',
                'description' => "Remaining balance from active package(only for active) will be added to next package balance.<br>This service is applicable for same package - Lifetime to Lifetime, Yearly to Yearly, Monthly to Monthly and Prepaid to Prepaid package.",
                'is_active'   => getSetting('balance_carry_forward') ? 1 : 0
            ],
            'new_package_purchase' => [
                'title'       => 'Auto Activated New package Expire Old Package',
                'description' => 'if enable, running package expire when purchase to new package',
                'is_active'   => getSetting('new_package_purchase') ? 1 : 0
            ],
            'auto_subscription_active' => [
                'title'       => 'Allow user to cancel Auto Subscription',
                'description' => 'if enable, user can cancel auto recurring payment if purchase from paypal',
                'is_active'   => getSetting('auto_subscription_active') ? 1 : 0
            ],
            'auto_subscription_deactive' => [
                'title'       => 'Allow user to Active Auto Subscription',
                'description' => 'if enable, user can Active auto recurring payment if purchase from paypal.',
                'is_active'   => getSetting('auto_subscription_deactive') ? 1 : 0
            ],
        ];
    }
    public function settingsTabs()
    {
        if(isVendorUserGroup()){
            return collect([
                'invoice-settings-tab' => [
                    'title' => 'Invoice Settings',
                    'h1'    => 'Invoice Settings',
                    'icon'  => 'shopping-bag'
                ],
            ]);
        }


        $tabs = [
            'settings-info-tab' => [
                'title' => 'General Information',
                'h1'    => 'System Info Setup',
                'icon'  => 'tool'
            ],
            'general-settings-tab' => [
                'title' => 'General Settings',
                'h1'    => 'System Setting Configuration',
                'icon'  => 'settings'
            ],
            
            'auth-tab' => [
                'title' => 'Login & Register',
                'h1'    => 'Login & Register',
                'icon'  => 'key'
            ],
            'subscription-setting-tab' => [
                'title' => 'Subscription Setting',
                'h1'    => 'Subscription Setting',
                'icon'  => 'package'
            ],
            'affiliate-configurations-tab' => [
                'title' => 'Affiliate Configurations',
                'h1'    => 'Affiliate Configurations',
                'icon'  => 'git-pull-request'
            ],
            'invoice-settings-tab' => [
                'title' => 'Invoice Settings',
                'h1'    => 'Invoice Settings',
                'icon'  => 'shopping-bag'
            ],
            'settings-seo-meta-tab' => [
                'title' => 'SEO Meta Configuration',
                'h1'    => 'SEO Meta Configuration',
                'icon'  => 'activity'
            ],
            'settings-cookie-consent-tab' => [
                'title' => 'Cookie Consent',
                'h1'    => 'Cookie Consent',
                'icon'  => 'alert-circle'
            ],
            'settings-custom-scripts-tab' => [
                'title' => 'Custom Scripts & CSS',
                'h1'    => 'Custom Scripts & CSS',
                'icon'  => 'code'
            ],
            'copy-write-text-tab' => [
                'title' => 'CopyWrite Text',
                'h1'    => 'CopyWrite Text',
                'icon'  => 'at-sign'
            ],
            'social-links-tab' => [
                'title' => 'Social Links',
                'h1'    => 'Social Links',
                'icon'  => 'at-sign'
            ],
        ];

        return collect($tabs);
    }
    public function credentialTabs()
    {
        $vendorTabs = [];

        if(isVendorUserGroup()){

            $vendorTabs = [
                'vendor-credentials-tab' => [
                    'title' => 'Vendor Credentials',
                    'h1'    => 'Vendor Credentials',
                    'icon'  => 'lock'
                ],
            ];

           // return $vendorTabs;
        }

        $tabs = [
            'smtp-settings-tab' => [
                'title' => 'SMTP Settings',
                'h1'    => 'SMTP Settings',
                'icon'  => 'settings'
            ],

        ];

        return collect($tabs);
    }
    public function appearanceFeatureTab()
    {
        $tabs = [
            'hero-section-tab' => [
                'title' => 'Hero Section',
                'h1'    => 'Hero Section',
                'icon'  => 'key'
            ],
            'brand-section-tab' => [
                'title' => 'Brand Section',
                'h1'    => 'Brand Section',
                'icon'  => 'key'
            ],
            'feature-document-tab-1' => [
                'title' => 'Feature',
                'h1'    => 'Feature',
                'icon'  => 'key'
            ],
            'feature-document-tab-2' => [
                'title' => 'Feature Item 1',
                'h1'    => 'Feature Item 1',
                'icon'  => 'key'
            ],
            'feature-document-tab-3' => [
                'title' => 'Feature Item 2',
                'h1'    => 'Feature Item 2',
                'icon'  => 'key'
            ],
            'feature-document-tab-4' => [
                'title' => 'Feature Item 3',
                'h1'    => 'Feature Item 3',
                'icon'  => 'key'
            ],
            'feature-document-tab-5' => [
                'title' => 'Feature Item 4',
                'h1'    => 'Feature Item 4',
                'icon'  => 'key'
            ],
            'feature-document-tab-6' => [
                'title' => 'Feature Item 5',
                'h1'    => 'Feature Item 5',
                'icon'  => 'key'
            ],
            'feature-document-tab-7' => [
                'title' => 'Feature Item 6',
                'h1'    => 'Feature Item 6',
                'icon'  => 'key'
            ],


            'feature-tab-1' => [
                'title' => 'Application Feature 1',
                'h1'    => 'Application Feature 1',
                'icon'  => 'key'
            ],
            'feature-tab-2' => [
                'title' => 'Application Feature 2',
                'h1'    => 'Application Feature 2',
                'icon'  => 'key'
            ],
            'feature-tab-3' => [
                'title' => 'Application Feature 3',
                'h1'    => 'Application Feature 3',
                'icon'  => 'key'
            ],
            'feature-tab-4' => [
                'title' => 'Application Feature 4',
                'h1'    => 'Application Feature 4',
                'icon'  => 'key'
            ],
            'feature-tab-5' => [
                'title' => 'Application Feature 5',
                'h1'    => 'Application Feature 5',
                'icon'  => 'key'
            ],
            'feature-tab-6' => [
                'title' => 'Application Feature 6',
                'h1'    => 'Application Feature 6',
                'icon'  => 'key'
            ],

            "integration-tab" => [
                'title' => 'Integration',
                'h1'    => 'Our Integration',
                'icon'  => 'key'
            ],

            "ai-journey-tab" => [
                'title' => 'AI Journey',
                'h1'    => 'AI Journey',
                'icon'  => 'key'
            ],
            'feature-tools-tab-1' => [
                'title' => 'AI Feature Tools 1',
                'h1'    => 'AI Feature Tools',
                'icon'  => 'key'
            ],
            'feature-tools-tab-2' => [
                'title' => 'AI Feature Tools 2',
                'h1'    => 'AI Feature Tools 2',
                'icon'  => 'key'
            ],
            'feature-tools-tab-3' => [
                'title' => 'AI Feature Tools 3',
                'h1'    => 'AI Feature Tools 3',
                'icon'  => 'key'
            ],
            'feature-tools-tab-4' => [
                'title' => 'AI Feature Tools 4',
                'h1'    => 'AI Feature Tools 4',
                'icon'  => 'key'
            ],
            'feature-tools-tab-5' => [
                'title' => 'AI Feature Tools 5',
                'h1'    => 'AI Feature Tools 5',
                'icon'  => 'key'
            ],
            'auth-tab' => [
                'title' => 'Login',
                'h1'    => 'Login',
                'icon'  => 'key'
            ],

        ];

        return collect($tabs);
    }
    public function SubscriptionPlanFeatures(): object
    {
        $packageFeatures = [
            'words' => [
                'total_words'     => 1000,
                'allow'           => 1,
                'show'            => 1,
                'unlimited_words' => 1,
                'title'           => 'Words',

                'features' => [
                    'words' => [
                        'title' => 'Words',
                        'allow' => 1,
                        'show'  => 1,
                    ],
                    'ai_template' => [
                        'title' => 'AI Template',
                        'allow' => 1,
                        'show'  => 1,
                    ],
                    'ai_chat' => [
                        'title' => 'AI Chat',
                        'allow' => 1,
                        'show'  => 1,
                    ],
                ],
            ],
        ];

        return collect($packageFeatures);
    }
}
