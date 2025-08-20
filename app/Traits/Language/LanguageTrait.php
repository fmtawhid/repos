<?php

namespace App\Traits\Language;

trait LanguageTrait

{

    public function languageList()
    {
        $languages =
            [
                "af-ZA"     => localize('Afrikaans (South Africa)'),
                "ar-XA"     => localize('Arabic'),
                "eu-ES"     => localize('Basque (Spain)'),
                "bn-IN"     => localize('Bengali (India)'),
                "bg-BG"     => localize('Bulgarian (Bulgaria)'),
                "ca-ES"     => localize('Catalan (Spain) '),
                "yue-HK"    => localize('Chinese (Hong Kong)'),
                "cs-CZ"     => localize('Czech (Czech Republic)'),
                "da-DK"     => localize('Danish (Denmark)'),
                "nl-BE"     => localize('Dutch (Belgium)'),
                "nl-NL"     => localize('Dutch (Netherlands)'),
                "en-AU"     => localize('English (Australia)'),
                "en-IN"     => localize('English (India)'),
                "en-GB"     => localize('English (UK)'),
                "en-US"     => localize('English (US)'),
                "fil-PH"    => localize('Filipino (Philippines)'),
                "fi-FI"     => localize('Finnish (Finland)'),
                "fr-CA"     => localize('French (Canada)'),
                "fr-FR"     => localize('French (France)'),
                "gl-ES"     => localize('Galician (Spain)'),
                "de-DE"     => localize('German (Germany)'),
                "el-GR"     => localize('Greek (Greece)'),
                "gu-IN"     => localize('Gujarati (India)'),
                "he-IL"     => localize('Hebrew (Israel)'),
                "hi-IN"     => localize('Hindi (India)'),
                "hu-HU"     => localize('Hungarian (Hungary)'),
                "is-IS"     => localize('Icelandic (Iceland)'),
                "id-ID"     => localize('Indonesian (Indonesia)'),
                "it-IT"     => localize('Italian (Italy)'),
                "ja-JP"     => localize('Japanese (Japan)'),
                "kn-IN"     => localize('Kannada (India)'),
                "ko-KR"     => localize('Korean (South Korea)'),
                "lv-LV"     => localize('Latvian (Latvia)'),
                "ms-MY"     => localize('Malay (Malaysia)'),
                "ml-IN"     => localize('Malayalam (India)'),
                "cmn-CN"    => localize('Mandarin Chinese'),
                "cmn-TW"    => localize('Mandarin Chinese (T)'),
                "mr-IN"     => localize('Marathi (India)'),
                "nb-NO"     => localize('Norwegian (Norway)'),
                "pl-PL"     => localize('Polish (Poland)'),
                "pt-BR"     => localize('Portuguese (Brazil)'),
                "pt-PT"     => localize('Portuguese (Portugal)'),
                "pa-IN"     => localize('Punjabi (India)'),
                "ro-RO"     => localize('Romanian (Romania)'),
                "ru-RU"     => localize('Russian (Russia)'),
                "sr-RS"     => localize('Serbian (Cyrillic)'),
                "sk-SK"     => localize('Slovak (Slovakia)'),
                "es-ES"     => localize('Spanish (Spain)'),
                "es-US"     => localize('Spanish (US)'),
                "sv-SE"     => localize('Swedish (Sweden)'),
                "ta-IN"     => localize('Tamil (India)'),
                "te-IN"     => localize('Telugu (India)'),
                "th-TH"     => localize('Thai (Thailand)'),
                "tr-TR"     => localize('Turkish (Turkey)'),
                "uk-UA"     => localize('Ukrainian (Ukraine)'),
                "vi-VN"     => localize('Vietnamese (Vietnam)')
            ];
        if (getSetting('default_voiceover') == 'azure') {
            return  $this->azureLanguageList();
        }
        return $languages;
    }
    public function languageVoicesData()
    {

        if (getSetting('default_voiceover') == 'azure') {
            return  $this->azureVoiceDetailList();
        }else{
            return $this->googleVoiceDetails();
        }

    }
    public function azureVoiceDetailList()
    {
        $voices =  array(
            'ar-EG' =>
            array(
                0 =>
                array(
                    'value' => 'ar-EG-SalmaNeural',
                    'label' => 'Rene(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ar-EG-ShakirNeural	',
                    'label' => 'Fae(neural) -Male',
                ),
            ),
            'ar-SA' =>
            array(
                0 =>
                array(
                    'value' => 'ar-SA-ZariyahNeural',
                    'label' => 'Elmo(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ar-SA-HamedNeural',
                    'label' => 'Eldora(neural) -Male',
                ),
            ),
            'bg-BG' =>
            array(
                0 =>
                array(
                    'value' => 'bg-BG-KalinaNeural',
                    'label' => 'Remington(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'bg-BG-BorislavNeural',
                    'label' => 'Delpha(neural) -Male',
                ),
            ),
            'ca-ES' =>
            array(
                0 =>
                array(
                    'value' => 'ca-ES-AlbaNeural',
                    'label' => 'Dedrick(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ca-ES-JoanaNeural',
                    'label' => 'Oral(neural) -Female',
                ),
                2 =>
                array(
                    'value' => 'ca-ES-EnricNeural',
                    'label' => 'Allison(neural) -Male',
                ),
            ),
            'zh-HK' =>
            array(
                0 =>
                array(
                    'value' => 'zh-HK-HiuGaaiNeural',
                    'label' => 'Moises(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'zh-HK-HiuMaanNeural',
                    'label' => 'Wilton(neural) -Female',
                ),
                2 =>
                array(
                    'value' => 'zh-HK-WanLungNeural',
                    'label' => 'Bessie(neural) -Male',
                ),
            ),
            'zh-CN' =>
            array(
                0 =>
                array(
                    'value' => 'zh-CN-XiaoxiaoNeural',
                    'label' => 'Freeman(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'zh-CN-XiaoyouNeural',
                    'label' => 'Uriel(neural) -Female',
                ),
                2 =>
                array(
                    'value' => 'zh-CN-XiaomoNeural',
                    'label' => 'Kaley(neural) -Female',
                ),
                3 =>
                array(
                    'value' => 'zh-CN-XiaoxuanNeural',
                    'label' => 'Sigurd(neural) -Female',
                ),
                4 =>
                array(
                    'value' => 'zh-CN-XiaohanNeural',
                    'label' => 'Jess(neural) -Female',
                ),
                5 =>
                array(
                    'value' => 'zh-CN-XiaoruiNeural',
                    'label' => 'Jettie(neural) -Female',
                ),
                6 =>
                array(
                    'value' => 'zh-CN-YunyangNeural',
                    'label' => 'Velma(neural) -Male',
                ),
                7 =>
                array(
                    'value' => 'zh-CN-YunyeNeural',
                    'label' => 'Norene(neural) -Male',
                ),
                8 =>
                array(
                    'value' => 'zh-CN-YunxiNeural',
                    'label' => 'Suzanne(neural) -Male',
                ),
                9 =>
                array(
                    'value' => 'zh-CN-XiaochenNeural',
                    'label' => 'Gussie(neural) -Female',
                ),
                10 =>
                array(
                    'value' => 'zh-CN-XiaoyanNeural',
                    'label' => 'Zane(neural) -Female',
                ),
                11 =>
                array(
                    'value' => 'zh-CN-XiaoshuangNeural',
                    'label' => 'Valentin(neural) -Female',
                ),
                12 =>
                array(
                    'value' => 'zh-CN-XiaoqiuNeural',
                    'label' => 'Herminio(neural) -Female',
                ),
            ),
            'zh-TW' =>
            array(
                0 =>
                array(
                    'value' => 'zh-TW-HsiaoChenNeural',
                    'label' => 'Wilburn(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'zh-TW-HsiaoYuNeural',
                    'label' => 'Kelton(neural) -Female',
                ),
                2 =>
                array(
                    'value' => 'zh-TW-YunJheNeural',
                    'label' => 'Joannie(neural) -Male',
                ),
            ),
            'hr-HR' =>
            array(
                0 =>
                array(
                    'value' => 'hr-HR-GabrijelaNeural',
                    'label' => 'Emerald(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'hr-HR-SreckoNeural',
                    'label' => 'Chloe(neural) -Male',
                ),
            ),
            'cs-CZ' =>
            array(
                0 =>
                array(
                    'value' => 'cs-CZ-VlastaNeural',
                    'label' => 'Carlo(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'cs-CZ-AntoninNeural',
                    'label' => 'Carley(neural) -Male',
                ),
            ),
            'da-DK' =>
            array(
                0 =>
                array(
                    'value' => 'da-DK-ChristelNeural',
                    'label' => 'Cristina(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'da-DK-JeppeNeural',
                    'label' => 'Arlie(neural) -Male',
                ),
            ),
            'nl-BE' =>
            array(
                0 =>
                array(
                    'value' => 'nl-BE-DenaNeural',
                    'label' => 'Mustafa(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'nl-BE-ArnaudNeural',
                    'label' => 'Kelsi(neural) -Male',
                ),
            ),
            'nl-NL' =>
            array(
                0 =>
                array(
                    'value' => 'nl-NL-ColetteNeural',
                    'label' => 'Waldo(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'nl-NL-FennaNeural',
                    'label' => 'Emery(neural) -Female',
                ),
                2 =>
                array(
                    'value' => 'nl-NL-MaartenNeural',
                    'label' => 'Amiya(neural) -Male',
                ),
            ),
            'en-AU' =>
            array(
                0 =>
                array(
                    'value' => 'en-AU-NatashaNeural',
                    'label' => 'Buford(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'en-AU-WilliamNeural',
                    'label' => 'Dayna(neural) -Male',
                ),
            ),
            'en-CA' =>
            array(
                0 =>
                array(
                    'value' => 'en-CA-ClaraNeural',
                    'label' => 'King(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'en-CA-LiamNeural',
                    'label' => 'Mariela(neural) -Male',
                ),
            ),
            'en-HK' =>
            array(
                0 =>
                array(
                    'value' => 'en-HK-YanNeural',
                    'label' => 'Devante(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'en-HK-SamNeural',
                    'label' => 'Mafalda(neural) -Male',
                ),
            ),
            'en-IN' =>
            array(
                0 =>
                array(
                    'value' => 'en-IN-NeerjaNeural',
                    'label' => 'Dudley(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'en-IN-PrabhatNeural',
                    'label' => 'Heloise(neural) -Male',
                ),
            ),
            'en-IE' =>
            array(
                0 =>
                array(
                    'value' => 'en-IE-EmilyNeural',
                    'label' => 'Avery(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'en-IE-ConnorNeural',
                    'label' => 'Pearlie(neural) -Male',
                ),
            ),
            'en-NZ' =>
            array(
                0 =>
                array(
                    'value' => 'en-NZ-MollyNeural',
                    'label' => 'Demond(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'en-NZ-MitchellNeural',
                    'label' => 'Ashtyn(neural) -Male',
                ),
            ),
            'en-PH' =>
            array(
                0 =>
                array(
                    'value' => 'en-PH-RosaNeural',
                    'label' => 'Elliott(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'en-PH-JamesNeural',
                    'label' => 'Kimberly(neural) -Male',
                ),
            ),
            'en-SG' =>
            array(
                0 =>
                array(
                    'value' => 'en-SG-LunaNeural',
                    'label' => 'Eli(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'en-SG-WayneNeural',
                    'label' => 'Alysa(neural) -Male',
                ),
            ),
            'en-ZA' =>
            array(
                0 =>
                array(
                    'value' => 'en-ZA-LeahNeural',
                    'label' => 'Matt(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'en-ZA-LukeNeural',
                    'label' => 'Vincenza(neural) -Male',
                ),
            ),
            'en-GB' =>
            array(
                0 =>
                array(
                    'value' => 'en-GB-LibbyNeural',
                    'label' => 'Allen(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'en-GB-RyanNeural',
                    'label' => 'Linda(neural) -Male',
                ),
                2 =>
                array(
                    'value' => 'en-GB-SoniaNeural',
                    'label' => 'Greg(neural) -Female',
                ),
                3 =>
                array(
                    'value' => 'en-GB-AbbiNeural',
                    'label' => 'Emmet(neural) -Female',
                ),
                4 =>
                array(
                    'value' => 'en-GB-BellaNeural',
                    'label' => 'Orrin(neural) -Female',
                ),
                5 =>
                array(
                    'value' => 'en-GB-HollieNeural',
                    'label' => 'Evans(neural) -Female',
                ),
                6 =>
                array(
                    'value' => 'en-GB-OliviaNeural',
                    'label' => 'Ryley(neural) -Female',
                ),
                7 =>
                array(
                    'value' => 'en-GB-MaisieNeural',
                    'label' => 'Burdette(neural) -Female(child)',
                ),
                8 =>
                array(
                    'value' => 'en-GB-AlfieNeural',
                    'label' => 'Adrianna(neural) -Male',
                ),
                9 =>
                array(
                    'value' => 'en-GB-ElliotNeural',
                    'label' => 'Else(neural) -Male',
                ),
                10 =>
                array(
                    'value' => 'en-GB-EthanNeural',
                    'label' => 'Lulu(neural) -Male',
                ),
                11 =>
                array(
                    'value' => 'en-GB-NoahNeural',
                    'label' => 'Amiya(neural) -Male',
                ),
                12 =>
                array(
                    'value' => 'en-GB-OliverNeural',
                    'label' => 'Dayana(neural) -Male',
                ),
                13 =>
                array(
                    'value' => 'en-GB-ThomasNeural',
                    'label' => 'Ivy(neural) -Male',
                ),
            ),
            'en-US' =>
            array(
                0 =>
                array(
                    'value' => 'en-US-AriaNeural',
                    'label' => 'Leonardo(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'en-US-JennyNeural',
                    'label' => 'Eli(neural) -Female',
                ),
                2 =>
                array(
                    'value' => 'en-US-GuyNeural',
                    'label' => 'Ivah(neural) -Male',
                ),
                3 =>
                array(
                    'value' => 'en-US-AmberNeural',
                    'label' => 'Coby(neural) -Female',
                ),
                4 =>
                array(
                    'value' => 'en-US-AshleyNeural',
                    'label' => 'Vito(neural) -Female',
                ),
                5 =>
                array(
                    'value' => 'en-US-CoraNeural',
                    'label' => 'Keeley(neural) -Female',
                ),
                6 =>
                array(
                    'value' => 'en-US-ElizabethNeural',
                    'label' => 'Alexie(neural) -Female',
                ),
                7 =>
                array(
                    'value' => 'en-US-MichelleNeural',
                    'label' => 'Geo(neural) -Female',
                ),
                8 =>
                array(
                    'value' => 'en-US-MonicaNeural',
                    'label' => 'Hayden(neural) -Female',
                ),
                9 =>
                array(
                    'value' => 'en-US-SaraNeural',
                    'label' => 'Alberto(neural) -Female',
                ),
                10 =>
                array(
                    'value' => 'en-US-AnaNeural',
                    'label' => 'Celestine(neural) -Female(child)',
                ),
                11 =>
                array(
                    'value' => 'en-US-BrandonNeural',
                    'label' => 'Rosetta(neural) -Male',
                ),
                12 =>
                array(
                    'value' => 'en-US-ChristopherNeural',
                    'label' => 'Shakira(neural) -Male',
                ),
                13 =>
                array(
                    'value' => 'en-US-EricNeural',
                    'label' => 'Dawn(neural) -Male',
                ),
                14 =>
                array(
                    'value' => 'en-US-JacobNeural',
                    'label' => 'Leanne(neural) -Male',
                ),
            ),
            'et-EE' =>
            array(
                0 =>
                array(
                    'value' => 'et-EE-AnuNeural',
                    'label' => 'Wilber(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'et-EE-KertNeural',
                    'label' => 'Gloria(neural) -Male',
                ),
            ),
            'fi-FI' =>
            array(
                0 =>
                array(
                    'value' => 'fi-FI-NooraNeural',
                    'label' => 'Toni(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'fi-FI-SelmaNeural',
                    'label' => 'Stephen(neural) -Female',
                ),
                2 =>
                array(
                    'value' => 'fi-FI-HarriNeural',
                    'label' => 'Candice(neural) -Male',
                ),
            ),
            'fr-BE' =>
            array(
                0 =>
                array(
                    'value' => 'fr-BE-CharlineNeural',
                    'label' => 'Stefan(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'fr-BE-GerardNeural',
                    'label' => 'Kenya(neural) -Male',
                ),
            ),
            'fr-CA' =>
            array(
                0 =>
                array(
                    'value' => 'fr-CA-SylvieNeural',
                    'label' => 'Emmanuel(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'fr-CA-AntoineNeural',
                    'label' => 'Alberta(neural) -Male',
                ),
                2 =>
                array(
                    'value' => 'fr-CA-JeanNeural',
                    'label' => 'Anabelle(neural) -Male',
                ),
            ),
            'fr-FR' =>
            array(
                0 =>
                array(
                    'value' => 'fr-FR-DeniseNeural',
                    'label' => 'Kadin(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'fr-FR-HenriNeural',
                    'label' => 'Noelia(neural) -Male',
                ),
                2 =>
                array(
                    'value' => 'fr-FR-BrigitteNeural',
                    'label' => 'Lambert(neural) -Female',
                ),
                3 =>
                array(
                    'value' => 'fr-FR-CelesteNeural',
                    'label' => 'Antone(neural) -Female',
                ),
                4 =>
                array(
                    'value' => 'fr-FR-CoralieNeural',
                    'label' => 'Mervin(neural) -Female',
                ),
                5 =>
                array(
                    'value' => 'fr-FR-JacquelineNeural',
                    'label' => 'Brook(neural) -Female',
                ),
                6 =>
                array(
                    'value' => 'fr-FR-JosephineNeural',
                    'label' => 'Norbert(neural) -Female',
                ),
                7 =>
                array(
                    'value' => 'fr-FR-YvetteNeural',
                    'label' => 'Roosevelt(neural) -Female',
                ),
                8 =>
                array(
                    'value' => 'fr-FR-EloiseNeural',
                    'label' => 'Deanna(neural) -Female(child)',
                ),
                9 =>
                array(
                    'value' => 'fr-FR-AlainNeural',
                    'label' => 'Mireille(neural) -Male',
                ),
                10 =>
                array(
                    'value' => 'fr-FR-ClaudeNeural',
                    'label' => 'Willow(neural) -Male',
                ),
                11 =>
                array(
                    'value' => 'fr-FR-JeromeNeural',
                    'label' => 'Liliane(neural) -Male',
                ),
                12 =>
                array(
                    'value' => 'fr-FR-MauriceNeural',
                    'label' => 'Mazie(neural) -Male',
                ),
                13 =>
                array(
                    'value' => 'fr-FR-YvesNeural',
                    'label' => 'Otilia(neural) -Male',
                ),
            ),
            'fr-CH' =>
            array(
                0 =>
                array(
                    'value' => 'fr-CH-ArianeNeural',
                    'label' => 'Jamel(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'fr-CH-FabriceNeural',
                    'label' => 'Myrtis(neural) -Male',
                ),
            ),
            'de-AT' =>
            array(
                0 =>
                array(
                    'value' => 'de-AT-IngridNeural',
                    'label' => 'Dennis(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'de-AT-JonasNeural',
                    'label' => 'Felicity(neural) -Male',
                ),
            ),
            'de-DE' =>
            array(
                0 =>
                array(
                    'value' => 'de-DE-KatjaNeural',
                    'label' => 'Domenic(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'de-DE-ConradNeural',
                    'label' => 'Freda(neural) -Male',
                ),
                2 =>
                array(
                    'value' => 'de-DE-AmalaNeural',
                    'label' => 'Gus(neural) -Female',
                ),
                3 =>
                array(
                    'value' => 'de-DE-ElkeNeural',
                    'label' => 'Hilbert(neural) -Female',
                ),
                4 =>
                array(
                    'value' => 'de-DE-KlarissaNeural',
                    'label' => 'Kamron(neural) -Female',
                ),
                5 =>
                array(
                    'value' => 'de-DE-LouisaNeural',
                    'label' => 'Giovanni(neural) -Female',
                ),
                6 =>
                array(
                    'value' => 'de-DE-MajaNeural',
                    'label' => 'Peter(neural) -Female',
                ),
                7 =>
                array(
                    'value' => 'de-DE-TanjaNeural',
                    'label' => 'Charley(neural) -Female',
                ),
                8 =>
                array(
                    'value' => 'de-DE-GiselaNeural',
                    'label' => 'Cayla(neural) -Female(child)',
                ),
                9 =>
                array(
                    'value' => 'de-DE-BerndNeural',
                    'label' => 'Mariane(neural) -Male',
                ),
                10 =>
                array(
                    'value' => 'de-DE-ChristophNeural',
                    'label' => 'Lorna(neural) -Male',
                ),
                11 =>
                array(
                    'value' => 'de-DE-KasperNeural',
                    'label' => 'Audreanne(neural) -Male',
                ),
                12 =>
                array(
                    'value' => 'de-DE-KillianNeural',
                    'label' => 'Carlee(neural) -Male',
                ),
                13 =>
                array(
                    'value' => 'de-DE-KlausNeural',
                    'label' => 'Noemi(neural) -Male',
                ),
                14 =>
                array(
                    'value' => 'de-DE-RalfNeural',
                    'label' => 'Marguerite(neural) -Male',
                ),
            ),
            'de-CH' =>
            array(
                0 =>
                array(
                    'value' => 'de-CH-LeniNeural',
                    'label' => 'Richie(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'de-CH-JanNeural',
                    'label' => 'Chanelle(neural) -Male',
                ),
            ),
            'el-GR' =>
            array(
                0 =>
                array(
                    'value' => 'el-GR-AthinaNeural',
                    'label' => 'Heber(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'el-GR-NestorasNeural',
                    'label' => 'Nyah(neural) -Male',
                ),
            ),
            'gu-IN' =>
            array(
                0 =>
                array(
                    'value' => 'gu-IN-DhwaniNeural',
                    'label' => 'Ford(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'gu-IN-NiranjanNeural',
                    'label' => 'Carolina(neural) -Male',
                ),
            ),
            'he-IL' =>
            array(
                0 =>
                array(
                    'value' => 'he-IL-HilaNeural',
                    'label' => 'Larry(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'he-IL-AvriNeural',
                    'label' => 'Willie(neural) -Male',
                ),
            ),
            'hi-IN' =>
            array(
                0 =>
                array(
                    'value' => 'hi-IN-SwaraNeural',
                    'label' => 'Seamus(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'hi-IN-MadhurNeural',
                    'label' => 'Marlen(neural) -Male',
                ),
            ),
            'hu-HU' =>
            array(
                0 =>
                array(
                    'value' => 'hu-HU-NoemiNeural',
                    'label' => 'Travon(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'hu-HU-TamasNeural',
                    'label' => 'Destiny(neural) -Male',
                ),
            ),
            'id-ID' =>
            array(
                0 =>
                array(
                    'value' => 'id-ID-GadisNeural',
                    'label' => 'Kristian(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'id-ID-ArdiNeural',
                    'label' => 'Laurianne(neural) -Male',
                ),
            ),
            'ga-IE' =>
            array(
                0 =>
                array(
                    'value' => 'ga-IE-OrlaNeural',
                    'label' => 'Clair(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ga-IE-ColmNeural',
                    'label' => 'Aryanna(neural) -Male',
                ),
            ),
            'it-IT' =>
            array(
                0 =>
                array(
                    'value' => 'it-IT-ElsaNeural',
                    'label' => 'Jaylen(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'it-IT-IsabellaNeural',
                    'label' => 'Elton(neural) -Female',
                ),
                2 =>
                array(
                    'value' => 'it-IT-DiegoNeural',
                    'label' => 'Lacy(neural) -Male',
                ),
                3 =>
                array(
                    'value' => 'it-IT-PierinaNeural',
                    'label' => 'Fernando(neural) -Female',
                ),
                4 =>
                array(
                    'value' => 'it-IT-FabiolaNeural',
                    'label' => 'Gaston(neural) -Female',
                ),
                5 =>
                array(
                    'value' => 'it-IT-ImeldaNeural',
                    'label' => 'Dante(neural) -Female',
                ),
                6 =>
                array(
                    'value' => 'it-IT-PalmiraNeural',
                    'label' => 'Oscar(neural) -Female',
                ),
                7 =>
                array(
                    'value' => 'it-IT-FiammaNeural',
                    'label' => 'Samir(neural) -Female',
                ),
                8 =>
                array(
                    'value' => 'it-IT-IrmaNeural',
                    'label' => 'Gregory(neural) -Female',
                ),
                9 =>
                array(
                    'value' => 'it-IT-BenignoNeural',
                    'label' => 'Ivah(neural) -Male',
                ),
                10 =>
                array(
                    'value' => 'it-IT-CataldoNeural',
                    'label' => 'Dolly(neural) -Male',
                ),
                11 =>
                array(
                    'value' => 'it-IT-LisandroNeural',
                    'label' => 'Bianka(neural) -Male',
                ),
                12 =>
                array(
                    'value' => 'it-IT-GianniNeural',
                    'label' => 'Krystal(neural) -Male',
                ),
                13 =>
                array(
                    'value' => 'it-IT-CalimeroNeural',
                    'label' => 'Patience(neural) -Male',
                ),
                14 =>
                array(
                    'value' => 'it-IT-RinaldoNeural',
                    'label' => 'Verlie(neural) -Male',
                ),
            ),
            'ja-JP' =>
            array(
                0 =>
                array(
                    'value' => 'ja-JP-NanamiNeural',
                    'label' => 'Frank(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ja-JP-KeitaNeural',
                    'label' => 'Antonietta(neural) -Male',
                ),
            ),
            'ko-KR' =>
            array(
                0 =>
                array(
                    'value' => 'ko-KR-SunHiNeural',
                    'label' => 'Isaac(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ko-KR-InJoonNeural',
                    'label' => 'Sarina(neural) -Male',
                ),
            ),
            'lv-LV' =>
            array(
                0 =>
                array(
                    'value' => 'lv-LV-EveritaNeural',
                    'label' => 'Kennedy(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'lv-LV-NilsNeural',
                    'label' => 'Angelica(neural) -Male',
                ),
            ),
            'lt-LT' =>
            array(
                0 =>
                array(
                    'value' => 'lt-LT-OnaNeural',
                    'label' => 'Raven(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'lt-LT-LeonasNeural',
                    'label' => 'Carmela(neural) -Male',
                ),
            ),
            'ms-MY' =>
            array(
                0 =>
                array(
                    'value' => 'ms-MY-YasminNeural',
                    'label' => 'Erin(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ms-MY-OsmanNeural',
                    'label' => 'Marian(neural) -Male',
                ),
            ),
            'mt-MT' =>
            array(
                0 =>
                array(
                    'value' => 'mt-MT-GraceNeural',
                    'label' => 'Boyd(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'mt-MT-JosephNeural',
                    'label' => 'Idell(neural) -Male',
                ),
            ),
            'mr-IN' =>
            array(
                0 =>
                array(
                    'value' => 'mr-IN-AarohiNeural',
                    'label' => 'Felipe(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'mr-IN-ManoharNeural',
                    'label' => 'Lilyan(neural) -Male',
                ),
            ),
            'nb-NO' =>
            array(
                0 =>
                array(
                    'value' => 'nb-NO-IselinNeural',
                    'label' => 'Buford(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'nb-NO-PernilleNeural',
                    'label' => 'Cortez(neural) -Female',
                ),
                2 =>
                array(
                    'value' => 'nb-NO-FinnNeural',
                    'label' => 'Theresia(neural) -Male',
                ),
            ),
            'pl-PL' =>
            array(
                0 =>
                array(
                    'value' => 'pl-PL-AgnieszkaNeural',
                    'label' => 'Louie(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'pl-PL-ZofiaNeural',
                    'label' => 'Hiram(neural) -Female',
                ),
                2 =>
                array(
                    'value' => 'pl-PL-MarekNeural',
                    'label' => 'Clemmie(neural) -Male',
                ),
            ),
            'pt-BR' =>
            array(
                0 =>
                array(
                    'value' => 'pt-BR-FranciscaNeural',
                    'label' => 'Jocelyn(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'pt-BR-AntonioNeural',
                    'label' => 'Eliza(neural) -Male',
                ),
                2 =>
                array(
                    'value' => 'pt-BR-DonatoNeural',
                    'label' => 'Raegan(neural) -Male',
                ),
                3 =>
                array(
                    'value' => 'pt-BR-FabioNeural',
                    'label' => 'Allene(neural) -Male',
                ),
                4 =>
                array(
                    'value' => 'pt-BR-JulioNeural',
                    'label' => 'Kenna(neural) -Male',
                ),
                5 =>
                array(
                    'value' => 'pt-BR-NicolauNeural',
                    'label' => 'Rhea(neural) -Male',
                ),
                6 =>
                array(
                    'value' => 'pt-BR-ValerioNeural',
                    'label' => 'Destiny(neural) -Male',
                ),
                7 =>
                array(
                    'value' => 'pt-BR-LeticiaNeural',
                    'label' => 'Kole(neural) -Female',
                ),
                8 =>
                array(
                    'value' => 'pt-BR-BrendaNeural',
                    'label' => 'Vern(neural) -Female',
                ),
                9 =>
                array(
                    'value' => 'pt-BR-ElzaNeural',
                    'label' => 'Louisa(neural) -Female',
                ),
                10 =>
                array(
                    'value' => 'pt-BR-ManuelaNeural',
                    'label' => 'Manuel(neural) -Female',
                ),
                11 =>
                array(
                    'value' => 'pt-BR-GiovannaNeural',
                    'label' => 'Leopoldo(neural) -Female',
                ),
                12 =>
                array(
                    'value' => 'pt-BR-LeilaNeural',
                    'label' => 'Winfield(neural) -Female',
                ),
                13 =>
                array(
                    'value' => 'pt-BR-YaraNeural',
                    'label' => 'Zander(neural) -Female',
                ),
                14 =>
                array(
                    'value' => 'pt-BR-HumbertoNeural',
                    'label' => 'Martina(neural) -Male',
                ),
            ),
            'pt-PT' =>
            array(
                0 =>
                array(
                    'value' => 'pt-PT-FernandaNeural',
                    'label' => 'Victor(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'pt-PT-RaquelNeural',
                    'label' => 'Demetrius(neural) -Female',
                ),
                2 =>
                array(
                    'value' => 'pt-PT-DuarteNeural',
                    'label' => 'Eulah(neural) -Male',
                ),
            ),
            'ro-RO' =>
            array(
                0 =>
                array(
                    'value' => 'ro-RO-AlinaNeural',
                    'label' => 'Will(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ro-RO-EmilNeural',
                    'label' => 'Jordane(neural) -Male',
                ),
            ),
            'ru-RU' =>
            array(
                0 =>
                array(
                    'value' => 'ru-RU-DariyaNeural',
                    'label' => 'Alexzander(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ru-RU-SvetlanaNeural',
                    'label' => 'Jasen(neural) -Female',
                ),
                2 =>
                array(
                    'value' => 'ru-RU-DmitryNeural',
                    'label' => 'Yvette(neural) -Male',
                ),
            ),
            'sk-SK' =>
            array(
                0 =>
                array(
                    'value' => 'sk-SK-ViktoriaNeural',
                    'label' => 'Darrick(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'sk-SK-LukasNeural',
                    'label' => 'Shanelle(neural) -Male',
                ),
            ),
            'sl-SI' =>
            array(
                0 =>
                array(
                    'value' => 'sl-SI-PetraNeural',
                    'label' => 'Michale(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'sl-SI-RokNeural',
                    'label' => 'Jermaine(neural) -Male',
                ),
            ),
            'es-AR' =>
            array(
                0 =>
                array(
                    'value' => 'es-AR-ElenaNeural',
                    'label' => 'Kenny(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-AR-TomasNeural',
                    'label' => 'Berenice(neural) -Male',
                ),
            ),
            'es-CO' =>
            array(
                0 =>
                array(
                    'value' => 'es-CO-SalomeNeural',
                    'label' => 'Irwin(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-CO-GonzaloNeural',
                    'label' => 'Carolanne(neural) -Male',
                ),
            ),
            'es-MX' =>
            array(
                0 =>
                array(
                    'value' => 'es-MX-DaliaNeural',
                    'label' => 'Jonas(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-MX-JorgeNeural',
                    'label' => 'Felicia(neural) -Male',
                ),
                2 =>
                array(
                    'value' => 'es-MX-CecilioNeural',
                    'label' => 'Virginia(neural) -Male',
                ),
                3 =>
                array(
                    'value' => 'es-MX-GerardoNeural',
                    'label' => 'Valentina(neural) -Male',
                ),
                4 =>
                array(
                    'value' => 'es-MX-LibertoNeural',
                    'label' => 'Lynn(neural) -Male',
                ),
                5 =>
                array(
                    'value' => 'es-MX-LucianoNeural',
                    'label' => 'Nina(neural) -Male',
                ),
                6 =>
                array(
                    'value' => 'es-MX-PelayoNeural',
                    'label' => 'Christine(neural) -Male',
                ),
                7 =>
                array(
                    'value' => 'es-MX-YagoNeural',
                    'label' => 'Cathrine(neural) -Male',
                ),
                8 =>
                array(
                    'value' => 'es-MX-BeatrizNeural',
                    'label' => 'Paul(neural) -Female',
                ),
                9 =>
                array(
                    'value' => 'es-MX-CarlotaNeural',
                    'label' => 'Trevor(neural) -Female',
                ),
                10 =>
                array(
                    'value' => 'es-MX-NuriaNeural',
                    'label' => 'Johnpaul(neural) -Female',
                ),
                11 =>
                array(
                    'value' => 'es-MX-CandelaNeural',
                    'label' => 'Gerhard(neural) -Female',
                ),
                12 =>
                array(
                    'value' => 'es-MX-LarissaNeural',
                    'label' => 'Ned(neural) -Female',
                ),
                13 =>
                array(
                    'value' => 'es-MX-RenataNeural',
                    'label' => 'Cornell(neural) -Female',
                ),
                14 =>
                array(
                    'value' => 'es-MX-MarinaNeural',
                    'label' => 'Frankie(neural) -Female',
                ),
            ),
            'es-ES' =>
            array(
                0 =>
                array(
                    'value' => 'es-ES-ElviraNeural',
                    'label' => 'Lowell(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-ES-AlvaroNeural',
                    'label' => 'Bettye(neural) -Male',
                ),
            ),
            'es-US' =>
            array(
                0 =>
                array(
                    'value' => 'es-US-PalomaNeural',
                    'label' => 'Jessie(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-US-AlonsoNeural',
                    'label' => 'Natasha(neural) -Male',
                ),
            ),
            'sw-KE' =>
            array(
                0 =>
                array(
                    'value' => 'sw-KE-ZuriNeural',
                    'label' => 'Hester(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'sw-KE-RafikiNeural',
                    'label' => 'Rosemary(neural) -Male',
                ),
            ),
            'sv-SE' =>
            array(
                0 =>
                array(
                    'value' => 'sv-SE-HilleviNeural',
                    'label' => 'Carson(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'sv-SE-SofieNeural',
                    'label' => 'Oral(neural) -Female',
                ),
                2 =>
                array(
                    'value' => 'sv-SE-MattiasNeural',
                    'label' => 'Shirley(neural) -Male',
                ),
            ),
            'ta-IN' =>
            array(
                0 =>
                array(
                    'value' => 'ta-IN-PallaviNeural',
                    'label' => 'Shawn(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ta-IN-ValluvarNeural',
                    'label' => 'Noemie(neural) -Male',
                ),
            ),
            'te-IN' =>
            array(
                0 =>
                array(
                    'value' => 'te-IN-ShrutiNeural',
                    'label' => 'Floy(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'te-IN-MohanNeural',
                    'label' => 'Ima(neural) -Male',
                ),
            ),
            'th-TH' =>
            array(
                0 =>
                array(
                    'value' => 'th-TH-AcharaNeural',
                    'label' => 'Declan(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'th-TH-PremwadeeNeural',
                    'label' => 'Ernie(neural) -Female',
                ),
                2 =>
                array(
                    'value' => 'th-TH-NiwatNeural',
                    'label' => 'Delfina(neural) -Male',
                ),
            ),
            'tr-TR' =>
            array(
                0 =>
                array(
                    'value' => 'tr-TR-EmelNeural',
                    'label' => 'Gardner(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'tr-TR-AhmetNeural',
                    'label' => 'Vallie(neural) -Male',
                ),
            ),
            'uk-UA' =>
            array(
                0 =>
                array(
                    'value' => 'uk-UA-PolinaNeural',
                    'label' => 'Lavern(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'uk-UA-OstapNeural',
                    'label' => 'Rebekah(neural) -Male',
                ),
            ),
            'ur-PK' =>
            array(
                0 =>
                array(
                    'value' => 'ur-PK-UzmaNeural',
                    'label' => 'Davion(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ur-PK-AsadNeural',
                    'label' => 'Christa(neural) -Male',
                ),
            ),
            'vi-VN' =>
            array(
                0 =>
                array(
                    'value' => 'vi-VN-HoaiMyNeural',
                    'label' => 'Presley(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'vi-VN-NamMinhNeural',
                    'label' => 'Lydia(neural) -Male',
                ),
            ),
            'cy-GB' =>
            array(
                0 =>
                array(
                    'value' => 'cy-GB-NiaNeural',
                    'label' => 'Lew(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'cy-GB-AledNeural',
                    'label' => 'Guiseppe(neural) -Female',
                ),
            ),
            'af-ZA' =>
            array(
                0 =>
                array(
                    'value' => 'af-ZA-AdriNeural',
                    'label' => 'Ezekiel(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'af-ZA-WillemNeural',
                    'label' => 'Antonette(neural) -Male',
                ),
            ),
            'am-ET' =>
            array(
                0 =>
                array(
                    'value' => 'am-ET-MekdesNeural',
                    'label' => 'Deon(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'am-ET-AmehaNeural',
                    'label' => 'Neoma(neural) -Male',
                ),
            ),
            'ar-DZ' =>
            array(
                0 =>
                array(
                    'value' => 'ar-DZ-AminaNeural',
                    'label' => 'Ismael(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ar-DZ-IsmaelNeural',
                    'label' => 'Mossie(neural) -Male',
                ),
            ),
            'ar-BH' =>
            array(
                0 =>
                array(
                    'value' => 'ar-BH-LailaNeural',
                    'label' => 'Toby(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ar-BH-AliNeural',
                    'label' => 'Annamae(neural) -Male',
                ),
            ),
            'ar-IQ' =>
            array(
                0 =>
                array(
                    'value' => 'ar-IQ-RanaNeural',
                    'label' => 'Erling(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ar-IQ-BasselNeural',
                    'label' => 'Addie(neural) -Male',
                ),
            ),
            'ar-JO' =>
            array(
                0 =>
                array(
                    'value' => 'ar-JO-SanaNeural',
                    'label' => 'Nash(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ar-JO-TaimNeural',
                    'label' => 'Eunice(neural) -Male',
                ),
            ),
            'ar-KW' =>
            array(
                0 =>
                array(
                    'value' => 'ar-KW-NouraNeural',
                    'label' => 'Sidney(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ar-KW-FahedNeural',
                    'label' => 'Viviane(neural) -Male',
                ),
            ),
            'ar-LY' =>
            array(
                0 =>
                array(
                    'value' => 'ar-LY-ImanNeural',
                    'label' => 'Gianni(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ar-LY-OmarNeural',
                    'label' => 'Linnie(neural) -Male',
                ),
            ),
            'ar-MA' =>
            array(
                0 =>
                array(
                    'value' => 'ar-MA-MounaNeural',
                    'label' => 'Candido(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ar-MA-JamalNeural',
                    'label' => 'Jessyca(neural) -Male',
                ),
            ),
            'ar-QA' =>
            array(
                0 =>
                array(
                    'value' => 'ar-QA-AmalNeural',
                    'label' => 'Rhiannon(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ar-QA-MoazNeural',
                    'label' => 'Eliane(neural) -Male',
                ),
            ),
            'ar-SY' =>
            array(
                0 =>
                array(
                    'value' => 'ar-SY-AmanyNeural',
                    'label' => 'Donnie(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ar-SY-LaithNeural',
                    'label' => 'Norma(neural) -Male',
                ),
            ),
            'ar-TN' =>
            array(
                0 =>
                array(
                    'value' => 'ar-TN-ReemNeural',
                    'label' => 'Rey(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ar-TN-HediNeural',
                    'label' => 'Danyka(neural) -Male',
                ),
            ),
            'ar-AE' =>
            array(
                0 =>
                array(
                    'value' => 'ar-AE-FatimaNeural',
                    'label' => 'Ryleigh(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ar-AE-HamdanNeural',
                    'label' => 'Constance(neural) -Male',
                ),
            ),
            'ar-YE' =>
            array(
                0 =>
                array(
                    'value' => 'ar-YE-MaryamNeural',
                    'label' => 'Jerry(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ar-YE-SalehNeural',
                    'label' => 'Henriette(neural) -Male',
                ),
            ),
            'bn-BD' =>
            array(
                0 =>
                array(
                    'value' => 'bn-BD-NabanitaNeural',
                    'label' => 'Aric(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'bn-BD-PradeepNeural',
                    'label' => 'Angelina(neural) -Male',
                ),
            ),
            'my-MM' =>
            array(
                0 =>
                array(
                    'value' => 'my-MM-NilarNeural',
                    'label' => 'Jasmin(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'my-MM-ThihaNeural',
                    'label' => 'Kathryn(neural) -Male',
                ),
            ),
            'en-KE' =>
            array(
                0 =>
                array(
                    'value' => 'en-KE-AsiliaNeural',
                    'label' => 'Zack(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'en-KE-ChilembaNeural',
                    'label' => 'Lilla(neural) -Male',
                ),
            ),
            'en-NG' =>
            array(
                0 =>
                array(
                    'value' => 'en-NG-EzinneNeural',
                    'label' => 'Jules(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'en-NG-AbeoNeural',
                    'label' => 'Meggie(neural) -Male',
                ),
            ),
            'en-TZ' =>
            array(
                0 =>
                array(
                    'value' => 'en-TZ-ImaniNeural',
                    'label' => 'Zachery(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'en-TZ-ElimuNeural',
                    'label' => 'Lila(neural) -Male',
                ),
            ),
            'fil-PH' =>
            array(
                0 =>
                array(
                    'value' => 'fil-PH-BlessicaNeural',
                    'label' => 'Stephen(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'fil-PH-AngeloNeural',
                    'label' => 'Verla(neural) -Male',
                ),
            ),
            'gl-ES' =>
            array(
                0 =>
                array(
                    'value' => 'gl-ES-SabelaNeural',
                    'label' => 'Elton(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'gl-ES-RoiNeural',
                    'label' => 'Lelia(neural) -Male',
                ),
            ),
            'jv-ID' =>
            array(
                0 =>
                array(
                    'value' => 'jv-ID-SitiNeural',
                    'label' => 'Kieran(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'jv-ID-DimasNeural',
                    'label' => 'Carlotta(neural) -Male',
                ),
            ),
            'km-KH' =>
            array(
                0 =>
                array(
                    'value' => 'km-KH-SreymomNeural',
                    'label' => 'Adrien(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'km-KH-PisethNeural',
                    'label' => 'Destiny(neural) -Male',
                ),
            ),
            'fa-IR' =>
            array(
                0 =>
                array(
                    'value' => 'fa-IR-DilaraNeural',
                    'label' => 'Jesse(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'fa-IR-FaridNeural',
                    'label' => 'Lauriane(neural) -Male',
                ),
            ),
            'so-SO' =>
            array(
                0 =>
                array(
                    'value' => 'so-SO-UbaxNeural',
                    'label' => 'Deron(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'so-SO-MuuseNeural',
                    'label' => 'Emmie(neural) -Male',
                ),
            ),
            'es-BO' =>
            array(
                0 =>
                array(
                    'value' => 'es-BO-SofiaNeural',
                    'label' => 'Laron(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-BO-MarceloNeural',
                    'label' => 'Jalyn(neural) -Male',
                ),
            ),
            'es-CL' =>
            array(
                0 =>
                array(
                    'value' => 'es-CL-CatalinaNeural',
                    'label' => 'Claud(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-CL-LorenzoNeural',
                    'label' => 'Etha(neural) -Male',
                ),
            ),
            'es-CR' =>
            array(
                0 =>
                array(
                    'value' => 'es-CR-MariaNeural',
                    'label' => 'Milford(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-CR-JuanNeural',
                    'label' => 'Heaven(neural) -Male',
                ),
            ),
            'es-CU' =>
            array(
                0 =>
                array(
                    'value' => 'es-CU-BelkysNeural',
                    'label' => 'Raul(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-CU-ManuelNeural',
                    'label' => 'Jade(neural) -Male',
                ),
            ),
            'es-DO' =>
            array(
                0 =>
                array(
                    'value' => 'es-DO-RamonaNeural',
                    'label' => 'Mauricio(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-DO-EmilioNeural',
                    'label' => 'Lizzie(neural) -Male',
                ),
            ),
            'es-EC' =>
            array(
                0 =>
                array(
                    'value' => 'es-EC-AndreaNeural',
                    'label' => 'Remington(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-EC-LuisNeural',
                    'label' => 'Marisol(neural) -Male',
                ),
            ),
            'es-SV' =>
            array(
                0 =>
                array(
                    'value' => 'es-SV-LorenaNeural',
                    'label' => 'Boyd(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-SV-RodrigoNeural',
                    'label' => 'Yazmin(neural) -Male',
                ),
            ),
            'es-GQ' =>
            array(
                0 =>
                array(
                    'value' => 'es-GQ-TeresaNeural',
                    'label' => 'Austin(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-GQ-JavierNeural',
                    'label' => 'Dora(neural) -Male',
                ),
            ),
            'es-GT' =>
            array(
                0 =>
                array(
                    'value' => 'es-GT-MartaNeural',
                    'label' => 'Javon(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-GT-AndresNeural',
                    'label' => 'Lucinda(neural) -Male',
                ),
            ),
            'es-HN' =>
            array(
                0 =>
                array(
                    'value' => 'es-HN-KarlaNeural',
                    'label' => 'Emile(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-HN-CarlosNeural',
                    'label' => 'Alisa(neural) -Male',
                ),
            ),
            'es-NI' =>
            array(
                0 =>
                array(
                    'value' => 'es-NI-YolandaNeural',
                    'label' => 'Kieran(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-NI-FedericoNeural',
                    'label' => 'Karina(neural) -Male',
                ),
            ),
            'es-PA' =>
            array(
                0 =>
                array(
                    'value' => 'es-PA-MargaritaNeural',
                    'label' => 'Clark(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-PA-RobertoNeural',
                    'label' => 'Chloe(neural) -Male',
                ),
            ),
            'es-PY' =>
            array(
                0 =>
                array(
                    'value' => 'es-PY-TaniaNeural',
                    'label' => 'Sheldon(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-PY-MarioNeural',
                    'label' => 'Otha(neural) -Male',
                ),
            ),
            'es-PE' =>
            array(
                0 =>
                array(
                    'value' => 'es-PE-CamilaNeural',
                    'label' => 'Rolando(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-PE-AlexNeural',
                    'label' => 'Caitlyn(neural) -Male',
                ),
            ),
            'es-PR' =>
            array(
                0 =>
                array(
                    'value' => 'es-PR-KarinaNeural',
                    'label' => 'Johnpaul(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-PR-VictorNeural',
                    'label' => 'Ofelia(neural) -Male',
                ),
            ),
            'es-UY' =>
            array(
                0 =>
                array(
                    'value' => 'es-UY-ValentinaNeural',
                    'label' => 'Jeffrey(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-UY-MateoNeural',
                    'label' => 'Zelma(neural) -Male',
                ),
            ),
            'es-VE' =>
            array(
                0 =>
                array(
                    'value' => 'es-VE-PaolaNeural',
                    'label' => 'Cleveland(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'es-VE-SebastianNeural',
                    'label' => 'Lolita(neural) -Male',
                ),
            ),
            'su-ID' =>
            array(
                0 =>
                array(
                    'value' => 'su-ID-TutiNeural',
                    'label' => 'Pablo(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'su-ID-JajangNeural',
                    'label' => 'Marina(neural) -Male',
                ),
            ),
            'sw-TZ' =>
            array(
                0 =>
                array(
                    'value' => 'sw-TZ-RehemaNeural',
                    'label' => 'Neal(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'sw-TZ-DaudiNeural',
                    'label' => 'Hulda(neural) -Male',
                ),
            ),
            'ta-SG' =>
            array(
                0 =>
                array(
                    'value' => 'ta-SG-VenbaNeural',
                    'label' => 'Eric(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ta-SG-AnbuNeural',
                    'label' => 'Emmanuelle(neural) -Male',
                ),
            ),
            'ta-LK' =>
            array(
                0 =>
                array(
                    'value' => 'ta-LK-SaranyaNeural',
                    'label' => 'Derrick(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ta-LK-KumarNeural',
                    'label' => 'Linda(neural) -Male',
                ),
            ),
            'ur-IN' =>
            array(
                0 =>
                array(
                    'value' => 'ur-IN-GulNeural',
                    'label' => 'Osvaldo(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ur-IN-SalmanNeural',
                    'label' => 'Jennyfer(neural) -Male',
                ),
            ),
            'uz-UZ' =>
            array(
                0 =>
                array(
                    'value' => 'uz-UZ-MadinaNeural',
                    'label' => 'Destin(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'uz-UZ-SardorNeural',
                    'label' => 'Reta(neural) -Male',
                ),
            ),
            'zu-ZA' =>
            array(
                0 =>
                array(
                    'value' => 'zu-ZA-ThandoNeural',
                    'label' => 'Arely(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'zu-ZA-ThembaNeural',
                    'label' => 'Kristina(neural) -Male',
                ),
            ),
            'bn-IN' =>
            array(
                0 =>
                array(
                    'value' => 'bn-IN-TanishaaNeural',
                    'label' => 'Emmitt(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'bn-IN-BashkarNeural',
                    'label' => 'Kelsie(neural) -Male',
                ),
            ),
            'is-IS' =>
            array(
                0 =>
                array(
                    'value' => 'is-IS-GudrunNeural',
                    'label' => 'Gabriel(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'is-IS-GunnarNeural',
                    'label' => 'Adrienne(neural) -Male',
                ),
            ),
            'kn-IN' =>
            array(
                0 =>
                array(
                    'value' => 'kn-IN-SapnaNeural',
                    'label' => 'Jamie(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'kn-IN-GaganNeural',
                    'label' => 'Jaquelin(neural) -Male',
                ),
            ),
            'kk-KZ' =>
            array(
                0 =>
                array(
                    'value' => 'kk-KZ-AigulNeural',
                    'label' => 'Bernardo(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'kk-KZ-DauletNeural',
                    'label' => 'Jody(neural) -Male',
                ),
            ),
            'lo-LA' =>
            array(
                0 =>
                array(
                    'value' => 'lo-LA-KeomanyNeural',
                    'label' => 'Justice(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'lo-LA-ChanthavongNeural',
                    'label' => 'Irma(neural) -Male',
                ),
            ),
            'mk-MK' =>
            array(
                0 =>
                array(
                    'value' => 'mk-MK-MarijaNeural',
                    'label' => 'Kennith(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'mk-MK-AleksandarNeural',
                    'label' => 'Freeda(neural) -Male',
                ),
            ),
            'ml-IN' =>
            array(
                0 =>
                array(
                    'value' => 'ml-IN-SobhanaNeural',
                    'label' => 'Mauricio(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ml-IN-MidhunNeural',
                    'label' => 'Modesta(neural) -Male',
                ),
            ),
            'ps-AF' =>
            array(
                0 =>
                array(
                    'value' => 'ps-AF-LatifaNeural',
                    'label' => 'Rodger(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'ps-AF-GulNawazNeural',
                    'label' => 'Orie(neural) -Male',
                ),
            ),
            'sr-RS' =>
            array(
                0 =>
                array(
                    'value' => 'sr-RS-SophieNeural',
                    'label' => 'Sedrick(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'sr-RS-NicholasNeural',
                    'label' => 'May(neural) -Male',
                ),
            ),
            'si-LK' =>
            array(
                0 =>
                array(
                    'value' => 'si-LK-ThiliniNeural',
                    'label' => 'Lonzo(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'si-LK-SameeraNeural',
                    'label' => 'Katrina(neural) -Male',
                ),
            ),
            'az-AZ' =>
            array(
                0 =>
                array(
                    'value' => 'az-AZ-BabekNeural',
                    'label' => 'Edna(neural) -Male',
                ),
                1 =>
                array(
                    'value' => 'az-AZ-BanuNeural',
                    'label' => 'Darius(neural) -Female',
                ),
            ),
            'ar-LB' =>
            array(
                0 =>
                array(
                    'value' => 'ar-LB-RamiNeural',
                    'label' => 'Sonia(neural) -Male',
                ),
                1 =>
                array(
                    'value' => 'ar-LB-LaylaNeural',
                    'label' => 'Cleve(neural) -Female',
                ),
            ),
            'sq-AL' =>
            array(
                0 =>
                array(
                    'value' => 'sq-AL-IlirNeural',
                    'label' => 'Bette(neural) -Male',
                ),
                1 =>
                array(
                    'value' => 'sq-AL-AnilaNeural',
                    'label' => 'Maxine(neural) -Female',
                ),
            ),
            'ka-GE' =>
            array(
                0 =>
                array(
                    'value' => 'ka-GE-GiorgiNeural',
                    'label' => 'Lucie(neural) -Male',
                ),
                1 =>
                array(
                    'value' => 'ka-GE-EkaNeural',
                    'label' => 'Tremayne(neural) -Female',
                ),
            ),
            'mn-MN' =>
            array(
                0 =>
                array(
                    'value' => 'mn-MN-YesuiNeural',
                    'label' => 'Antonio(neural) -Female',
                ),
                1 =>
                array(
                    'value' => 'mn-MN-BataaNeural',
                    'label' => 'Bria(neural) -Male',
                ),
            ),
            'ne-NP' =>
            array(
                0 =>
                array(
                    'value' => 'ne-NP-SagarNeural',
                    'label' => 'Karlie(neural) -Male',
                ),
                1 =>
                array(
                    'value' => 'ne-NP-HemkalaNeural',
                    'label' => 'Dallas(neural) -Female',
                ),
            ),
            'bs-BA' =>
            array(
                0 =>
                array(
                    'value' => 'bs-BA-GoranNeural',
                    'label' => 'Adeline(neural) -Male',
                ),
                1 =>
                array(
                    'value' => 'bs-BA-VesnaNeural',
                    'label' => 'Adalberto(neural) -Female',
                ),
            ),
            'ar-OM' =>
            array(
                0 =>
                array(
                    'value' => 'ar-OM-AbdullahNeural',
                    'label' => 'Tiffany(neural) -Male',
                ),
                1 =>
                array(
                    'value' => 'ar-OM-AyshaNeural',
                    'label' => 'Holden(neural) -Female',
                ),
            ),
            'ta-MY' =>
            array(
                0 =>
                array(
                    'value' => 'ta-MY-SuryaNeural',
                    'label' => 'Roxanne(neural) -Male',
                ),
                1 =>
                array(
                    'value' => 'ta-MY-KaniNeural',
                    'label' => 'Davin(neural) -Female',
                ),
            ),
        );
        return $voices;
    }
    public function azureLanguageList()
    {
        return array(
            'af-ZA' => 'Afrikaans (South Africa)',
            'ar-XA' => 'Arabic',
            'ar-EG' => 'Arabic (Egypt)',
            'ar-SA' => 'Arabic (Saudi Arabia)',
            'bn-IN' => 'Bengali (India)',
            'bg-BG' => 'Bulgarian (Bulgaria)',
            'ca-ES' => 'Catalan (Spain)',
            'zh-HK' => 'Chinese (Cantonese)',
            'cmn-CN' => 'Chinese (Mandarin)',
            'zh-CN' => 'Chinese (M. Simplified)',
            'zh-TW' => 'Chinese (Taiwanese M.)',
            'hr-HR' => 'Croatian (Croatia)',
            'cs-CZ' => 'Czech (Czech Republic)',
            'da-DK' => 'Danish (Denmark)',
            'nl-BE' => 'Dutch (Belgium)',
            'nl-NL' => 'Dutch (Netherlands)',
            'en-AU' => 'English (Australia)',
            'en-CA' => 'English (Canada)',
            'en-HK' => 'English (Hongkong)',
            'en-IN' => 'English (India)',
            'en-IE' => 'English (Ireland)',
            'en-NZ' => 'English (New Zealand)',
            'en-PH' => 'English (Philippines)',
            'en-SG' => 'English (Singapore)',
            'en-ZA' => 'English (South Africa)',
            'en-GB' => 'English (UK)',
            'en-US' => 'English (USA)',
            'et-EE' => 'Estonian (Estonia)',
            'fil-PH' => 'Filipino (Philippines)',
            'fi-FI' => 'Finnish (Finland)',
            'fr-BE' => 'French (Belgium)',
            'fr-FR' => 'French (France)',
            'fr-CA' => 'French (Canada)',
            'fr-CH' => 'French (Switzerland)',
            'de-AT' => 'German (Austria)',
            'de-DE' => 'German (Germany)',
            'de-CH' => 'German (Switzerland)',
            'el-GR' => 'Greek (Greece)',
            'gu-IN' => 'Gujarati (India)',
            'he-IL' => 'Hebrew (Israel)',
            'hi-IN' => 'Hindi (India)',
            'hu-HU' => 'Hungarian (Hungary)',
            'is-IS' => 'Icelandic (Iceland)',
            'id-ID' => 'Indonesian (Indonesia)',
            'ga-IE' => 'Irish (Ireland)',
            'it-IT' => 'Italian (Italy)',
            'ja-JP' => 'Japanese (Japan)',
            'kn-IN' => 'Kannada (India)',
            'ko-KR' => 'Korean (South Korea)',
            'lv-LV' => 'Latvian (Latvia)',
            'lt-LT' => 'Lithuanian (Lithuania)',
            'ml-IN' => 'Malayalam (India)',
            'ms-MY' => 'Malay (Malaysia)',
            'mt-MT' => 'Maltese (Malta)',
            'mr-IN' => 'Marathi (India)',
            'nb-NO' => 'Norwegian (Norway)',
            'pl-PL' => 'Polish (Poland)',
            'pt-BR' => 'Portuguese (Brazil)',
            'pt-PT' => 'Portuguese (Portugal)',
            'ro-RO' => 'Romanian (Romania)',
            'ru-RU' => 'Russian (Russia)',
            'sr-RS' => 'Serbian (Serbia)',
            'sk-SK' => 'Slovak (Slovakia)',
            'sl-SI' => 'Slovenian (Slovenia)',
            'es-AR' => 'Spanish (Argentina)',
            'es-CO' => 'Spanish (Colombia)',
            'es-ES' => 'Spanish (Spain)',
            'es-MX' => 'Spanish (Mexico)',
            'es-US' => 'Spanish (USA)',
            'sw-KE' => 'Swahili (Kenya)',
            'sv-SE' => 'Swedish (Sweden)',
            'ta-IN' => 'Tamil (India)',
            'te-IN' => 'Telugu (India)',
            'th-TH' => 'Thai (Thailand)',
            'tr-TR' => 'Turkish (Turkey)',
            'uk-UA' => 'Ukrainian (Ukraine)',
            'ur-PK' => 'Urdu (Pakistan)',
            'vi-VN' => 'Vietnamese (Vietnam)',
            'cy-GB' => 'Welsh (Wales)',
            'am-ET' => 'Amharic (Ethiopia)',
            'ar-DZ' => 'Arabic (Algeria)',
            'ar-BH' => 'Arabic (Bahrain)',
            'ar-IQ' => 'Arabic (Iraq)',
            'ar-JO' => 'Arabic (Jordan)',
            'ar-KW' => 'Arabic (Kuwait)',
            'ar-LY' => 'Arabic (Libya)',
            'ar-MA' => 'Arabic (Morocco)',
            'ar-QA' => 'Arabic (Qatar)',
            'ar-SY' => 'Arabic (Syria)',
            'ar-TN' => 'Arabic (Tunisia)',
            'ar-AE' => 'Arabic (UAE)',
            'ar-YE' => 'Arabic (Yemen)',
            'bn-BD' => 'Bangla (Bangladesh)',
            'my-MM' => 'Burmese (Myanmar)',
            'en-KE' => 'English (Kenya)',
            'en-NG' => 'English (Nigeria)',
            'en-TZ' => 'English (Tanzania)',
            'gl-ES' => 'Galician (Spain)',
            'jv-ID' => 'Javanese (Indonesia)',
            'fa-IR' => 'Persian (Iran)',
            'km-KH' => 'Khmer (Cambodia)',
            'so-SO' => 'Somali (Somalia)',
            'es-BO' => 'Spanish (Bolivia)',
            'es-CL' => 'Spanish (Chile)',
            'es-CR' => 'Spanish (Costa Rica)',
            'es-CU' => 'Spanish (Cuba)',
            'es-DO' => 'Spanish (Dominican Republic)',
            'es-EC' => 'Spanish (Ecuador)',
            'es-SV' => 'Spanish (El Salvador)',
            'es-GQ' => 'Spanish (Equatorial Guinea)',
            'es-GT' => 'Spanish (Guatemala)',
            'es-HN' => 'Spanish (Honduras)',
            'es-NI' => 'Spanish (Nicaragua)',
            'es-PA' => 'Spanish (Panama)',
            'es-PY' => 'Spanish (Paraguay)',
            'es-PE' => 'Spanish (Peru)',
            'es-PR' => 'Spanish (Puerto Rico)',
            'es-UY' => 'Spanish (Uruguay)',
            'es-VE' => 'Spanish (Venezuela)',
            'su-ID' => 'Sundanese (Indonesia)',
            'sw-TZ' => 'Swahili (Tanzania)',
            'ta-SG' => 'Tamil (Singapore)',
            'ta-LK' => 'Tamil (Sri Lanka)',
            'ur-IN' => 'Urdu (India)',
            'uz-UZ' => 'Uzbek (Uzbekistan)',
            'zu-ZA' => 'Zulu (South Africa)',
            'kk-KZ' => 'Kazakh (Kazakhstan)',
            'lo-LA' => 'Lao (Laos)',
            'mk-MK' => 'Macedonian (Macedonia)',
            'ps-AF' => 'Pashto (Afghanistan)',
            'si-LK' => 'Sinhala (Sri Lanka)',
            'pa-IN' => 'Punjabi (India)',
            'az-AZ' => 'Azerbaijani (Azerbaijan)',
            'ar-LB' => 'Arabic (Lebanon)',
            'sq-AL' => 'Albanian (Albania)',
            'ka-GE' => 'Georgian (Georgia)',
            'mn-MN' => 'Mongolian (Mongolia)',
            'ne-NP' => 'Nepali (Nepal)',
            'bs-BA' => 'Bosnian (Bosnia and Herzegovina)',
            'ar-OM' => 'Arabic (Oman)',
            'ta-MY' => 'Tamil (Malaysia)',
        );
    }
    public function googleVoiceDetails()
    {
        return  array (
            'af-ZA' => 
            array (
              0 => 
              array (
                'value' => 'af-ZA-Standard-A',
                'label' => 'Easton-FEMALE',
              ),
            ),
            'ar-XA' => 
            array (
              0 => 
              array (
                'value' => 'ar-XA-Standard-A',
                'label' => 'Jamie-FEMALE',
              ),
              1 => 
              array (
                'value' => 'ar-XA-Standard-B',
                'label' => 'Isaiah-MALE',
              ),
              2 => 
              array (
                'value' => 'ar-XA-Standard-C',
                'label' => 'Roosevelt-MALE',
              ),
              3 => 
              array (
                'value' => 'ar-XA-Standard-D',
                'label' => 'Eldon-FEMALE',
              ),
              4 => 
              array (
                'value' => 'ar-XA-Wavenet-A',
                'label' => 'Dallas-FEMALE',
              ),
              5 => 
              array (
                'value' => 'ar-XA-Wavenet-B',
                'label' => 'Alessandro-MALE',
              ),
              6 => 
              array (
                'value' => 'ar-XA-Wavenet-C',
                'label' => 'Ewald-MALE',
              ),
              7 => 
              array (
                'value' => 'ar-XA-Wavenet-D',
                'label' => 'Stone-FEMALE',
              ),
            ),
            'eu-ES' => 
            array (
              0 => 
              array (
                'value' => 'eu-ES-Standard-A',
                'label' => 'Doyle-FEMALE',
              ),
            ),
            'bn-IN' => 
            array (
              0 => 
              array (
                'value' => 'bn-IN-Standard-A',
                'label' => 'Kellen-FEMALE',
              ),
              1 => 
              array (
                'value' => 'bn-IN-Standard-B',
                'label' => 'Delaney-MALE',
              ),
              2 => 
              array (
                'value' => 'bn-IN-Wavenet-A',
                'label' => 'Efren-FEMALE',
              ),
              3 => 
              array (
                'value' => 'bn-IN-Wavenet-B',
                'label' => 'Unique-MALE',
              ),
            ),
            'bg-BG' => 
            array (
              0 => 
              array (
                'value' => 'bg-BG-Standard-A',
                'label' => 'Warren-FEMALE',
              ),
            ),
            'ca-ES' => 
            array (
              0 => 
              array (
                'value' => 'ca-ES-Standard-A',
                'label' => 'Robert-FEMALE',
              ),
            ),
            'yue-HK' => 
            array (
              0 => 
              array (
                'value' => 'yue-HK-Standard-A',
                'label' => 'Jeromy-FEMALE',
              ),
              1 => 
              array (
                'value' => 'yue-HK-Standard-B',
                'label' => 'Johnny-MALE',
              ),
              2 => 
              array (
                'value' => 'yue-HK-Standard-C',
                'label' => 'Lula-FEMALE',
              ),
              3 => 
              array (
                'value' => 'yue-HK-Standard-D',
                'label' => 'Adelbert-MALE',
              ),
            ),
            'cs-CZ' => 
            array (
              0 => 
              array (
                'value' => 'cs-CZ-Standard-A',
                'label' => 'Quincy-FEMALE',
              ),
              1 => 
              array (
                'value' => 'cs-CZ-Wavenet-A',
                'label' => 'Skylar-FEMALE',
              ),
            ),
            'da-DK' => 
            array (
              0 => 
              array (
                'value' => 'da-DK-Standard-A',
                'label' => 'Kevon-FEMALE',
              ),
              1 => 
              array (
                'value' => 'da-DK-Standard-A',
                'label' => 'Cristopher-FEMALE',
              ),
              2 => 
              array (
                'value' => 'da-DK-Standard-A',
                'label' => 'Eladio-FEMALE',
              ),
              3 => 
              array (
                'value' => 'da-DK-Standard-C',
                'label' => 'Jules-MALE',
              ),
              4 => 
              array (
                'value' => 'da-DK-Standard-D',
                'label' => 'Ross-FEMALE',
              ),
              5 => 
              array (
                'value' => 'da-DK-Standard-E',
                'label' => 'Norval-FEMALE',
              ),
              6 => 
              array (
                'value' => 'da-DK-Wavenet-A',
                'label' => 'Jedidiah-FEMALE',
              ),
              7 => 
              array (
                'value' => 'da-DK-Wavenet-C',
                'label' => 'Caleb-MALE',
              ),
              8 => 
              array (
                'value' => 'da-DK-Wavenet-D',
                'label' => 'General-FEMALE',
              ),
              9 => 
              array (
                'value' => 'da-DK-Wavenet-E',
                'label' => 'Jedediah-FEMALE',
              ),
            ),
            'nl-BE' => 
            array (
              0 => 
              array (
                'value' => 'nl-BE-Standard-A',
                'label' => 'Bo-FEMALE',
              ),
              1 => 
              array (
                'value' => 'nl-BE-Standard-B',
                'label' => 'Gregory-MALE',
              ),
              2 => 
              array (
                'value' => 'nl-BE-Wavenet-A',
                'label' => 'Bartholome-FEMALE',
              ),
              3 => 
              array (
                'value' => 'nl-BE-Wavenet-B',
                'label' => 'Agustin-MALE',
              ),
            ),
            'nl-NL' => 
            array (
              0 => 
              array (
                'value' => 'nl-NL-Standard-A',
                'label' => 'Newell-FEMALE',
              ),
              1 => 
              array (
                'value' => 'nl-NL-Standard-B',
                'label' => 'Erik-MALE',
              ),
              2 => 
              array (
                'value' => 'nl-NL-Standard-C',
                'label' => 'Eldon-MALE',
              ),
              3 => 
              array (
                'value' => 'nl-NL-Standard-D',
                'label' => 'Ralph-FEMALE',
              ),
              4 => 
              array (
                'value' => 'nl-NL-Standard-E',
                'label' => 'Brannon-FEMALE',
              ),
              5 => 
              array (
                'value' => 'nl-NL-Wavenet-A',
                'label' => 'Saul-FEMALE',
              ),
              6 => 
              array (
                'value' => 'nl-NL-Wavenet-B',
                'label' => 'Major-MALE',
              ),
              7 => 
              array (
                'value' => 'nl-NL-Wavenet-C',
                'label' => 'Anibal-MALE',
              ),
              8 => 
              array (
                'value' => 'nl-NL-Wavenet-D',
                'label' => 'Kelvin-FEMALE',
              ),
              9 => 
              array (
                'value' => 'nl-NL-Wavenet-E',
                'label' => 'Vidal-FEMALE',
              ),
            ),
            'en-AU' => 
            array (
              0 => 
              array (
                'value' => 'en-AU-News-E',
                'label' => 'Sheridan-FEMALE',
              ),
              1 => 
              array (
                'value' => 'en-AU-News-F',
                'label' => 'Wyatt-FEMALE',
              ),
              2 => 
              array (
                'value' => 'en-AU-News-G',
                'label' => 'Merl-MALE',
              ),
              3 => 
              array (
                'value' => 'en-AU-Polyglot-1',
                'label' => 'Jermey-MALE',
              ),
              4 => 
              array (
                'value' => 'en-AU-Standard-A',
                'label' => 'Allen-FEMALE',
              ),
              5 => 
              array (
                'value' => 'en-AU-Standard-B',
                'label' => 'Rigoberto-MALE',
              ),
              6 => 
              array (
                'value' => 'en-AU-Standard-C',
                'label' => 'Sigrid-FEMALE',
              ),
              7 => 
              array (
                'value' => 'en-AU-Standard-D',
                'label' => 'Jean-MALE',
              ),
              8 => 
              array (
                'value' => 'en-AU-Wavenet-A',
                'label' => 'Percival-FEMALE',
              ),
              9 => 
              array (
                'value' => 'en-AU-Wavenet-B',
                'label' => 'Hailey-MALE',
              ),
              10 => 
              array (
                'value' => 'en-AU-Wavenet-C',
                'label' => 'Blake-FEMALE',
              ),
              11 => 
              array (
                'value' => 'en-AU-Wavenet-D',
                'label' => 'Ari-MALE',
              ),
            ),
            'en-IN' => 
            array (
              0 => 
              array (
                'value' => 'en-IN-Standard-A',
                'label' => 'Danial-FEMALE',
              ),
              1 => 
              array (
                'value' => 'en-IN-Standard-B',
                'label' => 'Clinton-MALE',
              ),
              2 => 
              array (
                'value' => 'en-IN-Standard-C',
                'label' => 'Rogelio-MALE',
              ),
              3 => 
              array (
                'value' => 'en-IN-Standard-D',
                'label' => 'Major-FEMALE',
              ),
              4 => 
              array (
                'value' => 'en-IN-Wavenet-A',
                'label' => 'Triston-FEMALE',
              ),
              5 => 
              array (
                'value' => 'en-IN-Wavenet-B',
                'label' => 'Carson-MALE',
              ),
              6 => 
              array (
                'value' => 'en-IN-Wavenet-C',
                'label' => 'Emerson-MALE',
              ),
              7 => 
              array (
                'value' => 'en-IN-Wavenet-D',
                'label' => 'Izaiah-FEMALE',
              ),
            ),
            'en-GB' => 
            array (
              0 => 
              array (
                'value' => 'en-GB-News-G',
                'label' => 'Hadley-FEMALE',
              ),
              1 => 
              array (
                'value' => 'en-GB-News-H',
                'label' => 'Gennaro-FEMALE',
              ),
              2 => 
              array (
                'value' => 'en-GB-News-I',
                'label' => 'Joel-FEMALE',
              ),
              3 => 
              array (
                'value' => 'en-GB-News-J',
                'label' => 'Ronny-FEMALE',
              ),
              4 => 
              array (
                'value' => 'en-GB-News-K',
                'label' => 'Toby-MALE',
              ),
              5 => 
              array (
                'value' => 'en-GB-News-L',
                'label' => 'Mohammed-MALE',
              ),
              6 => 
              array (
                'value' => 'en-GB-News-M',
                'label' => 'Kelton-MALE',
              ),
              7 => 
              array (
                'value' => 'en-GB-Standard-A',
                'label' => 'Greg-FEMALE',
              ),
              8 => 
              array (
                'value' => 'en-GB-Standard-B',
                'label' => 'Fritz-MALE',
              ),
              9 => 
              array (
                'value' => 'en-GB-Standard-C',
                'label' => 'Charlie-FEMALE',
              ),
              10 => 
              array (
                'value' => 'en-GB-Standard-D',
                'label' => 'Rey-MALE',
              ),
              11 => 
              array (
                'value' => 'en-GB-Standard-F',
                'label' => 'Rocio-FEMALE',
              ),
              12 => 
              array (
                'value' => 'en-GB-Wavenet-A',
                'label' => 'Maxwell-FEMALE',
              ),
              13 => 
              array (
                'value' => 'en-GB-Wavenet-B',
                'label' => 'Oscar-MALE',
              ),
              14 => 
              array (
                'value' => 'en-GB-Wavenet-C',
                'label' => 'Kevin-FEMALE',
              ),
              15 => 
              array (
                'value' => 'en-GB-Wavenet-D',
                'label' => 'Brando-MALE',
              ),
              16 => 
              array (
                'value' => 'en-GB-Wavenet-F',
                'label' => 'Cristina-FEMALE',
              ),
            ),
            'en-US' => 
            array (
              0 => 
              array (
                'value' => 'en-US-News-K',
                'label' => 'Elliot-FEMALE',
              ),
              1 => 
              array (
                'value' => 'en-US-News-L',
                'label' => 'Nestor-FEMALE',
              ),
              2 => 
              array (
                'value' => 'en-US-News-M',
                'label' => 'Luigi-MALE',
              ),
              3 => 
              array (
                'value' => 'en-US-News-N',
                'label' => 'Cordell-MALE',
              ),
              4 => 
              array (
                'value' => 'en-US-Polyglot-1',
                'label' => 'Keegan-MALE',
              ),
              5 => 
              array (
                'value' => 'en-US-Standard-A',
                'label' => 'Alden-MALE',
              ),
              6 => 
              array (
                'value' => 'en-US-Standard-B',
                'label' => 'Brian-MALE',
              ),
              7 => 
              array (
                'value' => 'en-US-Standard-C',
                'label' => 'Darian-FEMALE',
              ),
              8 => 
              array (
                'value' => 'en-US-Standard-D',
                'label' => 'Roel-MALE',
              ),
              9 => 
              array (
                'value' => 'en-US-Standard-E',
                'label' => 'Brennon-FEMALE',
              ),
              10 => 
              array (
                'value' => 'en-US-Standard-F',
                'label' => 'Akeem-FEMALE',
              ),
              11 => 
              array (
                'value' => 'en-US-Standard-G',
                'label' => 'Mackenzie-FEMALE',
              ),
              12 => 
              array (
                'value' => 'en-US-Standard-H',
                'label' => 'Declan-FEMALE',
              ),
              13 => 
              array (
                'value' => 'en-US-Standard-I',
                'label' => 'Schuyler-MALE',
              ),
              14 => 
              array (
                'value' => 'en-US-Standard-J',
                'label' => 'Muhammad-MALE',
              ),
              15 => 
              array (
                'value' => 'en-US-Studio-M',
                'label' => 'Clinton-MALE',
              ),
              16 => 
              array (
                'value' => 'en-US-Studio-O',
                'label' => 'Cooper-FEMALE',
              ),
              17 => 
              array (
                'value' => 'en-US-Wavenet-A',
                'label' => 'Nels-MALE',
              ),
              18 => 
              array (
                'value' => 'en-US-Wavenet-B',
                'label' => 'Kale-MALE',
              ),
              19 => 
              array (
                'value' => 'en-US-Wavenet-C',
                'label' => 'Wilhelm-FEMALE',
              ),
              20 => 
              array (
                'value' => 'en-US-Wavenet-D',
                'label' => 'Mohamed-MALE',
              ),
              21 => 
              array (
                'value' => 'en-US-Wavenet-E',
                'label' => 'Arnaldo-FEMALE',
              ),
              22 => 
              array (
                'value' => 'en-US-Wavenet-F',
                'label' => 'Trey-FEMALE',
              ),
              23 => 
              array (
                'value' => 'en-US-Wavenet-G',
                'label' => 'Kieran-FEMALE',
              ),
              24 => 
              array (
                'value' => 'en-US-Wavenet-H',
                'label' => 'Orrin-FEMALE',
              ),
              25 => 
              array (
                'value' => 'en-US-Wavenet-I',
                'label' => 'Myles-MALE',
              ),
              26 => 
              array (
                'value' => 'en-US-Wavenet-J',
                'label' => 'Victor-MALE',
              ),
            ),
            'fil-PH' => 
            array (
              0 => 
              array (
                'value' => 'fil-PH-Standard-A',
                'label' => 'Cale-FEMALE',
              ),
              1 => 
              array (
                'value' => 'fil-PH-Standard-B',
                'label' => 'Quinton-FEMALE',
              ),
              2 => 
              array (
                'value' => 'fil-PH-Standard-C',
                'label' => 'Charley-MALE',
              ),
              3 => 
              array (
                'value' => 'fil-PH-Standard-D',
                'label' => 'Jaydon-MALE',
              ),
              4 => 
              array (
                'value' => 'fil-PH-Wavenet-A',
                'label' => 'Vito-FEMALE',
              ),
              5 => 
              array (
                'value' => 'fil-PH-Wavenet-B',
                'label' => 'Joany-FEMALE',
              ),
              6 => 
              array (
                'value' => 'fil-PH-Wavenet-C',
                'label' => 'Nick-MALE',
              ),
              7 => 
              array (
                'value' => 'fil-PH-Wavenet-D',
                'label' => 'Haleigh-MALE',
              ),
            ),
            'fi-FI' => 
            array (
              0 => 
              array (
                'value' => 'fi-FI-Standard-A',
                'label' => 'Webster-FEMALE',
              ),
              1 => 
              array (
                'value' => 'fi-FI-Wavenet-A',
                'label' => 'Brook-FEMALE',
              ),
            ),
            'fr-CA' => 
            array (
              0 => 
              array (
                'value' => 'fr-CA-Standard-A',
                'label' => 'Rodolfo-FEMALE',
              ),
              1 => 
              array (
                'value' => 'fr-CA-Standard-B',
                'label' => 'Arne-MALE',
              ),
              2 => 
              array (
                'value' => 'fr-CA-Standard-C',
                'label' => 'Art-FEMALE',
              ),
              3 => 
              array (
                'value' => 'fr-CA-Standard-D',
                'label' => 'Kendrick-MALE',
              ),
              4 => 
              array (
                'value' => 'fr-CA-Wavenet-A',
                'label' => 'Kendall-FEMALE',
              ),
              5 => 
              array (
                'value' => 'fr-CA-Wavenet-B',
                'label' => 'Abdiel-MALE',
              ),
              6 => 
              array (
                'value' => 'fr-CA-Wavenet-C',
                'label' => 'Marc-FEMALE',
              ),
              7 => 
              array (
                'value' => 'fr-CA-Wavenet-D',
                'label' => 'Johnpaul-MALE',
              ),
            ),
            'fr-FR' => 
            array (
              0 => 
              array (
                'value' => 'fr-FR-Polyglot-1',
                'label' => 'Avery-MALE',
              ),
              1 => 
              array (
                'value' => 'fr-FR-Standard-A',
                'label' => 'Leopold-FEMALE',
              ),
              2 => 
              array (
                'value' => 'fr-FR-Standard-B',
                'label' => 'Gustave-MALE',
              ),
              3 => 
              array (
                'value' => 'fr-FR-Standard-C',
                'label' => 'Odell-FEMALE',
              ),
              4 => 
              array (
                'value' => 'fr-FR-Standard-D',
                'label' => 'Benton-MALE',
              ),
              5 => 
              array (
                'value' => 'fr-FR-Standard-E',
                'label' => 'Angus-FEMALE',
              ),
              6 => 
              array (
                'value' => 'fr-FR-Wavenet-A',
                'label' => 'Keshawn-FEMALE',
              ),
              7 => 
              array (
                'value' => 'fr-FR-Wavenet-B',
                'label' => 'Guiseppe-MALE',
              ),
              8 => 
              array (
                'value' => 'fr-FR-Wavenet-C',
                'label' => 'Reginald-FEMALE',
              ),
              9 => 
              array (
                'value' => 'fr-FR-Wavenet-D',
                'label' => 'Joesph-MALE',
              ),
              10 => 
              array (
                'value' => 'fr-FR-Wavenet-E',
                'label' => 'Camden-FEMALE',
              ),
            ),
            'gl-ES' => 
            array (
              0 => 
              array (
                'value' => 'gl-ES-Standard-A',
                'label' => 'Bertrand-FEMALE',
              ),
            ),
            'de-DE' => 
            array (
              0 => 
              array (
                'value' => 'de-DE-Polyglot-1',
                'label' => 'Marcellus-MALE',
              ),
              1 => 
              array (
                'value' => 'de-DE-Standard-A',
                'label' => 'Earnest-FEMALE',
              ),
              2 => 
              array (
                'value' => 'de-DE-Standard-B',
                'label' => 'Markus-MALE',
              ),
              3 => 
              array (
                'value' => 'de-DE-Standard-C',
                'label' => 'Jensen-FEMALE',
              ),
              4 => 
              array (
                'value' => 'de-DE-Standard-D',
                'label' => 'Chesley-MALE',
              ),
              5 => 
              array (
                'value' => 'de-DE-Standard-E',
                'label' => 'Ignacio-MALE',
              ),
              6 => 
              array (
                'value' => 'de-DE-Standard-F',
                'label' => 'Grover-FEMALE',
              ),
              7 => 
              array (
                'value' => 'de-DE-Wavenet-A',
                'label' => 'Sven-FEMALE',
              ),
              8 => 
              array (
                'value' => 'de-DE-Wavenet-B',
                'label' => 'August-MALE',
              ),
              9 => 
              array (
                'value' => 'de-DE-Wavenet-C',
                'label' => 'Jordyn-FEMALE',
              ),
              10 => 
              array (
                'value' => 'de-DE-Wavenet-D',
                'label' => 'Niko-MALE',
              ),
              11 => 
              array (
                'value' => 'de-DE-Wavenet-E',
                'label' => 'Adrain-MALE',
              ),
              12 => 
              array (
                'value' => 'de-DE-Wavenet-F',
                'label' => 'Caleb-FEMALE',
              ),
            ),
            'el-GR' => 
            array (
              0 => 
              array (
                'value' => 'el-GR-Standard-A',
                'label' => 'Elroy-FEMALE',
              ),
              1 => 
              array (
                'value' => 'el-GR-Wavenet-A',
                'label' => 'Faustino-FEMALE',
              ),
            ),
            'gu-IN' => 
            array (
              0 => 
              array (
                'value' => 'gu-IN-Standard-A',
                'label' => 'Clay-FEMALE',
              ),
              1 => 
              array (
                'value' => 'gu-IN-Standard-B',
                'label' => 'Triston-MALE',
              ),
              2 => 
              array (
                'value' => 'gu-IN-Wavenet-A',
                'label' => 'Augustus-FEMALE',
              ),
              3 => 
              array (
                'value' => 'gu-IN-Wavenet-B',
                'label' => 'Dorcas-MALE',
              ),
            ),
            'he-IL' => 
            array (
              0 => 
              array (
                'value' => 'he-IL-Standard-A',
                'label' => 'Milford-FEMALE',
              ),
              1 => 
              array (
                'value' => 'he-IL-Standard-B',
                'label' => 'Ryder-MALE',
              ),
              2 => 
              array (
                'value' => 'he-IL-Standard-C',
                'label' => 'Howard-FEMALE',
              ),
              3 => 
              array (
                'value' => 'he-IL-Standard-D',
                'label' => 'Rosario-MALE',
              ),
              4 => 
              array (
                'value' => 'he-IL-Wavenet-A',
                'label' => 'Frederik-FEMALE',
              ),
              5 => 
              array (
                'value' => 'he-IL-Wavenet-B',
                'label' => 'Deonte-MALE',
              ),
              6 => 
              array (
                'value' => 'he-IL-Wavenet-C',
                'label' => 'Schuyler-FEMALE',
              ),
              7 => 
              array (
                'value' => 'he-IL-Wavenet-D',
                'label' => 'Guiseppe-MALE',
              ),
            ),
            'hi-IN' => 
            array (
              0 => 
              array (
                'value' => 'hi-IN-Standard-A',
                'label' => 'Trenton-FEMALE',
              ),
              1 => 
              array (
                'value' => 'hi-IN-Standard-B',
                'label' => 'Jamal-MALE',
              ),
              2 => 
              array (
                'value' => 'hi-IN-Standard-C',
                'label' => 'Benton-MALE',
              ),
              3 => 
              array (
                'value' => 'hi-IN-Standard-D',
                'label' => 'Mallory-FEMALE',
              ),
              4 => 
              array (
                'value' => 'hi-IN-Wavenet-A',
                'label' => 'Carey-FEMALE',
              ),
              5 => 
              array (
                'value' => 'hi-IN-Wavenet-B',
                'label' => 'Hugh-MALE',
              ),
              6 => 
              array (
                'value' => 'hi-IN-Wavenet-C',
                'label' => 'Terence-MALE',
              ),
              7 => 
              array (
                'value' => 'hi-IN-Wavenet-D',
                'label' => 'Denis-FEMALE',
              ),
            ),
            'hu-HU' => 
            array (
              0 => 
              array (
                'value' => 'hu-HU-Standard-A',
                'label' => 'Cleveland-FEMALE',
              ),
              1 => 
              array (
                'value' => 'hu-HU-Wavenet-A',
                'label' => 'Olen-FEMALE',
              ),
            ),
            'is-IS' => 
            array (
              0 => 
              array (
                'value' => 'is-IS-Standard-A',
                'label' => 'Orlando-FEMALE',
              ),
            ),
            'id-ID' => 
            array (
              0 => 
              array (
                'value' => 'id-ID-Standard-A',
                'label' => 'Reece-FEMALE',
              ),
              1 => 
              array (
                'value' => 'id-ID-Standard-B',
                'label' => 'Monroe-MALE',
              ),
              2 => 
              array (
                'value' => 'id-ID-Standard-C',
                'label' => 'Jerald-MALE',
              ),
              3 => 
              array (
                'value' => 'id-ID-Standard-D',
                'label' => 'Levi-FEMALE',
              ),
              4 => 
              array (
                'value' => 'id-ID-Wavenet-A',
                'label' => 'Odell-FEMALE',
              ),
              5 => 
              array (
                'value' => 'id-ID-Wavenet-B',
                'label' => 'Florian-MALE',
              ),
              6 => 
              array (
                'value' => 'id-ID-Wavenet-C',
                'label' => 'Giles-MALE',
              ),
              7 => 
              array (
                'value' => 'id-ID-Wavenet-D',
                'label' => 'Milan-FEMALE',
              ),
            ),
            'it-IT' => 
            array (
              0 => 
              array (
                'value' => 'it-IT-Standard-A',
                'label' => 'Reuben-FEMALE',
              ),
              1 => 
              array (
                'value' => 'it-IT-Standard-B',
                'label' => 'Erwin-FEMALE',
              ),
              2 => 
              array (
                'value' => 'it-IT-Standard-C',
                'label' => 'Gunner-MALE',
              ),
              3 => 
              array (
                'value' => 'it-IT-Standard-D',
                'label' => 'Francisco-MALE',
              ),
              4 => 
              array (
                'value' => 'it-IT-Wavenet-A',
                'label' => 'Frank-FEMALE',
              ),
              5 => 
              array (
                'value' => 'it-IT-Wavenet-B',
                'label' => 'Kyle-FEMALE',
              ),
              6 => 
              array (
                'value' => 'it-IT-Wavenet-C',
                'label' => 'D\'angelo-MALE',
              ),
              7 => 
              array (
                'value' => 'it-IT-Wavenet-D',
                'label' => 'Kennedy-MALE',
              ),
            ),
            'ja-JP' => 
            array (
              0 => 
              array (
                'value' => 'ja-JP-Standard-A',
                'label' => 'Maximo-FEMALE',
              ),
              1 => 
              array (
                'value' => 'ja-JP-Standard-B',
                'label' => 'Wiley-FEMALE',
              ),
              2 => 
              array (
                'value' => 'ja-JP-Standard-C',
                'label' => 'Leland-MALE',
              ),
              3 => 
              array (
                'value' => 'ja-JP-Standard-D',
                'label' => 'Royce-MALE',
              ),
              4 => 
              array (
                'value' => 'ja-JP-Wavenet-A',
                'label' => 'Wilburn-FEMALE',
              ),
              5 => 
              array (
                'value' => 'ja-JP-Wavenet-B',
                'label' => 'Magnus-FEMALE',
              ),
              6 => 
              array (
                'value' => 'ja-JP-Wavenet-C',
                'label' => 'Tatum-MALE',
              ),
              7 => 
              array (
                'value' => 'ja-JP-Wavenet-D',
                'label' => 'Luther-MALE',
              ),
            ),
            'kn-IN' => 
            array (
              0 => 
              array (
                'value' => 'kn-IN-Standard-A',
                'label' => 'Jordi-FEMALE',
              ),
              1 => 
              array (
                'value' => 'kn-IN-Standard-B',
                'label' => 'Mervin-MALE',
              ),
              2 => 
              array (
                'value' => 'kn-IN-Wavenet-A',
                'label' => 'Cristian-FEMALE',
              ),
              3 => 
              array (
                'value' => 'kn-IN-Wavenet-B',
                'label' => 'Justice-MALE',
              ),
            ),
            'ko-KR' => 
            array (
              0 => 
              array (
                'value' => 'ko-KR-Standard-A',
                'label' => 'Alexis-FEMALE',
              ),
              1 => 
              array (
                'value' => 'ko-KR-Standard-B',
                'label' => 'Lyric-FEMALE',
              ),
              2 => 
              array (
                'value' => 'ko-KR-Standard-C',
                'label' => 'Cordell-MALE',
              ),
              3 => 
              array (
                'value' => 'ko-KR-Standard-D',
                'label' => 'Cornelius-MALE',
              ),
              4 => 
              array (
                'value' => 'ko-KR-Wavenet-A',
                'label' => 'Herminio-FEMALE',
              ),
              5 => 
              array (
                'value' => 'ko-KR-Wavenet-B',
                'label' => 'Leopold-FEMALE',
              ),
              6 => 
              array (
                'value' => 'ko-KR-Wavenet-C',
                'label' => 'Gillian-MALE',
              ),
              7 => 
              array (
                'value' => 'ko-KR-Wavenet-D',
                'label' => 'Moshe-MALE',
              ),
            ),
            'lv-LV' => 
            array (
              0 => 
              array (
                'value' => 'lv-LV-Standard-A',
                'label' => 'Felipe-MALE',
              ),
            ),
            'lv-LT' => 
            array (
              0 => 
              array (
                'value' => 'lv-LT-Standard-A',
                'label' => 'Kamren-MALE',
              ),
            ),
            'ms-MY' => 
            array (
              0 => 
              array (
                'value' => 'ms-MY-Standard-A',
                'label' => 'Moriah-FEMALE',
              ),
              1 => 
              array (
                'value' => 'ms-MY-Standard-B',
                'label' => 'Arno-MALE',
              ),
              2 => 
              array (
                'value' => 'ms-MY-Standard-C',
                'label' => 'Orville-FEMALE',
              ),
              3 => 
              array (
                'value' => 'ms-MY-Standard-D',
                'label' => 'Harrison-MALE',
              ),
              4 => 
              array (
                'value' => 'ms-MY-Wavenet-A',
                'label' => 'Camron-FEMALE',
              ),
              5 => 
              array (
                'value' => 'ms-MY-Wavenet-B',
                'label' => 'Russell-MALE',
              ),
              6 => 
              array (
                'value' => 'ms-MY-Wavenet-C',
                'label' => 'Humberto-FEMALE',
              ),
              7 => 
              array (
                'value' => 'ms-MY-Wavenet-D',
                'label' => 'Mitchel-MALE',
              ),
            ),
            'ml-IN' => 
            array (
              0 => 
              array (
                'value' => 'ml-IN-Standard-A',
                'label' => 'Diamond-FEMALE',
              ),
              1 => 
              array (
                'value' => 'ml-IN-Standard-B',
                'label' => 'Dawson-MALE',
              ),
              2 => 
              array (
                'value' => 'ml-IN-Wavenet-A',
                'label' => 'Daryl-FEMALE',
              ),
              3 => 
              array (
                'value' => 'ml-IN-Wavenet-B',
                'label' => 'Melvin-MALE',
              ),
              4 => 
              array (
                'value' => 'ml-IN-Wavenet-C',
                'label' => 'Clinton-FEMALE',
              ),
              5 => 
              array (
                'value' => 'ml-IN-Wavenet-D',
                'label' => 'Scot-MALE',
              ),
            ),
            'cmn-CN' => 
            array (
              0 => 
              array (
                'value' => 'cmn-CN-Standard-A',
                'label' => 'Americo-FEMALE',
              ),
              1 => 
              array (
                'value' => 'cmn-CN-Standard-B',
                'label' => 'Johnson-MALE',
              ),
              2 => 
              array (
                'value' => 'cmn-CN-Standard-C',
                'label' => 'Joany-MALE',
              ),
              3 => 
              array (
                'value' => 'cmn-CN-Standard-D',
                'label' => 'Braeden-FEMALE',
              ),
              4 => 
              array (
                'value' => 'cmn-CN-Wavenet-A',
                'label' => 'Darrel-FEMALE',
              ),
              5 => 
              array (
                'value' => 'cmn-CN-Wavenet-B',
                'label' => 'Irwin-MALE',
              ),
              6 => 
              array (
                'value' => 'cmn-CN-Wavenet-C',
                'label' => 'Curtis-MALE',
              ),
              7 => 
              array (
                'value' => 'cmn-CN-Wavenet-D',
                'label' => 'Benny-FEMALE',
              ),
            ),
            'cmn-TW' => 
            array (
              0 => 
              array (
                'value' => 'cmn-TW-Standard-A',
                'label' => 'Darwin-FEMALE',
              ),
              1 => 
              array (
                'value' => 'cmn-TW-Standard-B',
                'label' => 'Royce-MALE',
              ),
              2 => 
              array (
                'value' => 'cmn-TW-Standard-C',
                'label' => 'Lambert-MALE',
              ),
              3 => 
              array (
                'value' => 'cmn-TW-Wavenet-A',
                'label' => 'Sam-FEMALE',
              ),
              4 => 
              array (
                'value' => 'cmn-TW-Wavenet-B',
                'label' => 'Martin-MALE',
              ),
              5 => 
              array (
                'value' => 'cmn-TW-Wavenet-C',
                'label' => 'Jacques-MALE',
              ),
            ),
            'mr-IN' => 
            array (
              0 => 
              array (
                'value' => 'mr-IN-Standard-A',
                'label' => 'Stuart-FEMALE',
              ),
              1 => 
              array (
                'value' => 'mr-IN-Standard-B',
                'label' => 'Lucius-MALE',
              ),
              2 => 
              array (
                'value' => 'mr-IN-Standard-C',
                'label' => 'Kim-FEMALE',
              ),
              3 => 
              array (
                'value' => 'mr-IN-Wavenet-A',
                'label' => 'Herminio-FEMALE',
              ),
              4 => 
              array (
                'value' => 'mr-IN-Wavenet-B',
                'label' => 'Oscar-MALE',
              ),
              5 => 
              array (
                'value' => 'mr-IN-Wavenet-C',
                'label' => 'Cordell-FEMALE',
              ),
            ),
            'nb-NO' => 
            array (
              0 => 
              array (
                'value' => 'nb-NO-Standard-A',
                'label' => 'Joesph-FEMALE',
              ),
              1 => 
              array (
                'value' => 'nb-NO-Standard-B',
                'label' => 'Narciso-MALE',
              ),
              2 => 
              array (
                'value' => 'nb-NO-Standard-C',
                'label' => 'Kayley-FEMALE',
              ),
              3 => 
              array (
                'value' => 'nb-NO-Standard-D',
                'label' => 'Deven-MALE',
              ),
              4 => 
              array (
                'value' => 'nb-NO-Standard-E',
                'label' => 'Kenyon-FEMALE',
              ),
              5 => 
              array (
                'value' => 'nb-NO-Wavenet-A',
                'label' => 'Edward-FEMALE',
              ),
              6 => 
              array (
                'value' => 'nb-NO-Wavenet-B',
                'label' => 'Everardo-MALE',
              ),
              7 => 
              array (
                'value' => 'nb-NO-Wavenet-C',
                'label' => 'Raheem-FEMALE',
              ),
              8 => 
              array (
                'value' => 'nb-NO-Wavenet-D',
                'label' => 'Oswald-MALE',
              ),
              9 => 
              array (
                'value' => 'nb-NO-Wavenet-E',
                'label' => 'Melvin-FEMALE',
              ),
            ),
            'pl-PL' => 
            array (
              0 => 
              array (
                'value' => 'pl-PL-Standard-A',
                'label' => 'Elton-FEMALE',
              ),
              1 => 
              array (
                'value' => 'pl-PL-Standard-B',
                'label' => 'Moriah-MALE',
              ),
              2 => 
              array (
                'value' => 'pl-PL-Standard-C',
                'label' => 'Felton-MALE',
              ),
              3 => 
              array (
                'value' => 'pl-PL-Standard-D',
                'label' => 'Judah-FEMALE',
              ),
              4 => 
              array (
                'value' => 'pl-PL-Standard-E',
                'label' => 'Cielo-FEMALE',
              ),
              5 => 
              array (
                'value' => 'pl-PL-Wavenet-A',
                'label' => 'Mike-FEMALE',
              ),
              6 => 
              array (
                'value' => 'pl-PL-Wavenet-B',
                'label' => 'Greyson-MALE',
              ),
              7 => 
              array (
                'value' => 'pl-PL-Wavenet-C',
                'label' => 'Golden-MALE',
              ),
              8 => 
              array (
                'value' => 'pl-PL-Wavenet-D',
                'label' => 'Cristobal-FEMALE',
              ),
              9 => 
              array (
                'value' => 'pl-PL-Wavenet-E',
                'label' => 'Dexter-FEMALE',
              ),
            ),
            'pt-BR' => 
            array (
              0 => 
              array (
                'value' => 'pt-BR-Standard-A',
                'label' => 'Reece-FEMALE',
              ),
              1 => 
              array (
                'value' => 'pt-BR-Standard-B',
                'label' => 'Oscar-MALE',
              ),
              2 => 
              array (
                'value' => 'pt-BR-Standard-C',
                'label' => 'Hugh-FEMALE',
              ),
              3 => 
              array (
                'value' => 'pt-BR-Wavenet-A',
                'label' => 'Cleve-FEMALE',
              ),
              4 => 
              array (
                'value' => 'pt-BR-Wavenet-B',
                'label' => 'Jeramie-MALE',
              ),
              5 => 
              array (
                'value' => 'pt-BR-Wavenet-C',
                'label' => 'Hank-FEMALE',
              ),
            ),
            'pt-PT' => 
            array (
              0 => 
              array (
                'value' => 'pt-PT-Standard-A',
                'label' => 'Muhammad-FEMALE',
              ),
              1 => 
              array (
                'value' => 'pt-PT-Standard-B',
                'label' => 'Jessy-MALE',
              ),
              2 => 
              array (
                'value' => 'pt-PT-Standard-C',
                'label' => 'Wilbert-MALE',
              ),
              3 => 
              array (
                'value' => 'pt-PT-Standard-D',
                'label' => 'Kacey-FEMALE',
              ),
              4 => 
              array (
                'value' => 'pt-PT-Wavenet-A',
                'label' => 'Dustin-FEMALE',
              ),
              5 => 
              array (
                'value' => 'pt-PT-Wavenet-B',
                'label' => 'Alexis-MALE',
              ),
              6 => 
              array (
                'value' => 'pt-PT-Wavenet-C',
                'label' => 'Nathan-MALE',
              ),
              7 => 
              array (
                'value' => 'pt-PT-Wavenet-D',
                'label' => 'Vince-FEMALE',
              ),
            ),
            'pa-IN' => 
            array (
              0 => 
              array (
                'value' => 'pa-IN-Standard-A',
                'label' => 'Brenden-FEMALE',
              ),
              1 => 
              array (
                'value' => 'pa-IN-Standard-B',
                'label' => 'Maurice-MALE',
              ),
              2 => 
              array (
                'value' => 'pa-IN-Standard-C',
                'label' => 'Dallas-FEMALE',
              ),
              3 => 
              array (
                'value' => 'pa-IN-Standard-D',
                'label' => 'Laron-MALE',
              ),
              4 => 
              array (
                'value' => 'pa-IN-Wavenet-A',
                'label' => 'Bertrand-FEMALE',
              ),
              5 => 
              array (
                'value' => 'pa-IN-Wavenet-B',
                'label' => 'Kian-MALE',
              ),
              6 => 
              array (
                'value' => 'pa-IN-Wavenet-C',
                'label' => 'Mario-FEMALE',
              ),
              7 => 
              array (
                'value' => 'pa-IN-Wavenet-D',
                'label' => 'Grayce-MALE',
              ),
            ),
            'ro-RO' => 
            array (
              0 => 
              array (
                'value' => 'ro-RO-Standard-A',
                'label' => 'Marlin-FEMALE',
              ),
              1 => 
              array (
                'value' => 'ro-RO-Wavenet-A',
                'label' => 'Gerson-FEMALE',
              ),
            ),
            'ru-RU' => 
            array (
              0 => 
              array (
                'value' => 'ru-RU-Standard-A',
                'label' => 'Dane-FEMALE',
              ),
              1 => 
              array (
                'value' => 'ru-RU-Standard-B',
                'label' => 'Jaiden-MALE',
              ),
              2 => 
              array (
                'value' => 'ru-RU-Standard-C',
                'label' => 'Jorge-FEMALE',
              ),
              3 => 
              array (
                'value' => 'ru-RU-Standard-D',
                'label' => 'Marty-MALE',
              ),
              4 => 
              array (
                'value' => 'ru-RU-Standard-E',
                'label' => 'Lucio-FEMALE',
              ),
              5 => 
              array (
                'value' => 'ru-RU-Wavenet-A',
                'label' => 'Lula-FEMALE',
              ),
              6 => 
              array (
                'value' => 'ru-RU-Wavenet-B',
                'label' => 'Chaim-MALE',
              ),
              7 => 
              array (
                'value' => 'ru-RU-Wavenet-C',
                'label' => 'Jocelyn-FEMALE',
              ),
              8 => 
              array (
                'value' => 'ru-RU-Wavenet-D',
                'label' => 'Ubaldo-MALE',
              ),
              9 => 
              array (
                'value' => 'ru-RU-Wavenet-E',
                'label' => 'Tillman-FEMALE',
              ),
            ),
            'sr-RS' => 
            array (
              0 => 
              array (
                'value' => 'sr-RS-Standard-A',
                'label' => 'Lionel-FEMALE',
              ),
            ),
            'sk-SK' => 
            array (
              0 => 
              array (
                'value' => 'sk-SK-Standard-A',
                'label' => 'Valentin-FEMALE',
              ),
              1 => 
              array (
                'value' => 'sk-SK-Wavenet-A',
                'label' => 'Chadd-FEMALE',
              ),
            ),
            'es-ES' => 
            array (
              0 => 
              array (
                'value' => 'es-ES-Polyglot-1',
                'label' => 'Hank-MALE',
              ),
              1 => 
              array (
                'value' => 'es-ES-Standard-A',
                'label' => 'Jerad-FEMALE',
              ),
              2 => 
              array (
                'value' => 'es-ES-Standard-B',
                'label' => 'Gonzalo-MALE',
              ),
              3 => 
              array (
                'value' => 'es-ES-Standard-C',
                'label' => 'Eldred-FEMALE',
              ),
              4 => 
              array (
                'value' => 'es-ES-Standard-D',
                'label' => 'Cleo-FEMALE',
              ),
              5 => 
              array (
                'value' => 'es-ES-Wavenet-B',
                'label' => 'Jaquan-MALE',
              ),
              6 => 
              array (
                'value' => 'es-ES-Wavenet-C',
                'label' => 'Kody-FEMALE',
              ),
              7 => 
              array (
                'value' => 'es-ES-Wavenet-D',
                'label' => 'Benjamin-FEMALE',
              ),
            ),
            'es-US' => 
            array (
              0 => 
              array (
                'value' => 'es-US-News-D',
                'label' => 'Albert-MALE',
              ),
              1 => 
              array (
                'value' => 'es-US-News-E',
                'label' => 'Colby-MALE',
              ),
              2 => 
              array (
                'value' => 'es-US-News-F',
                'label' => 'Trent-FEMALE',
              ),
              3 => 
              array (
                'value' => 'es-US-News-G',
                'label' => 'Bernard-FEMALE',
              ),
              4 => 
              array (
                'value' => 'es-US-Polyglot-1',
                'label' => 'Darion-MALE',
              ),
              5 => 
              array (
                'value' => 'es-US-Standard-A',
                'label' => 'Carson-FEMALE',
              ),
              6 => 
              array (
                'value' => 'es-US-Standard-B',
                'label' => 'Theron-MALE',
              ),
              7 => 
              array (
                'value' => 'es-US-Standard-C',
                'label' => 'Willard-MALE',
              ),
              8 => 
              array (
                'value' => 'es-US-Studio-B',
                'label' => 'Walter-MALE',
              ),
              9 => 
              array (
                'value' => 'es-US-Wavenet-A',
                'label' => 'Daryl-FEMALE',
              ),
              10 => 
              array (
                'value' => 'es-US-Wavenet-B',
                'label' => 'Jamison-MALE',
              ),
              11 => 
              array (
                'value' => 'es-US-Wavenet-C',
                'label' => 'Arthur-MALE',
              ),
            ),
            'sv-SE' => 
            array (
              0 => 
              array (
                'value' => 'sv-SE-Standard-A',
                'label' => 'Werner-FEMALE',
              ),
              1 => 
              array (
                'value' => 'sv-SE-Standard-B',
                'label' => 'Moriah-FEMALE',
              ),
              2 => 
              array (
                'value' => 'sv-SE-Standard-C',
                'label' => 'Otto-FEMALE',
              ),
              3 => 
              array (
                'value' => 'sv-SE-Standard-D',
                'label' => 'Sylvan-MALE',
              ),
              4 => 
              array (
                'value' => 'sv-SE-Standard-E',
                'label' => 'Garrick-MALE',
              ),
              5 => 
              array (
                'value' => 'sv-SE-Wavenet-A',
                'label' => 'Clifford-FEMALE',
              ),
              6 => 
              array (
                'value' => 'sv-SE-Wavenet-B',
                'label' => 'Branson-FEMALE',
              ),
              7 => 
              array (
                'value' => 'sv-SE-Wavenet-C',
                'label' => 'Tad-MALE',
              ),
              8 => 
              array (
                'value' => 'sv-SE-Wavenet-D',
                'label' => 'Lawrence-FEMALE',
              ),
              9 => 
              array (
                'value' => 'sv-SE-Wavenet-E',
                'label' => 'Donavon-MALE',
              ),
            ),
            'ta-IN' => 
            array (
              0 => 
              array (
                'value' => 'ta-IN-Standard-A',
                'label' => 'Jasmin-FEMALE',
              ),
              1 => 
              array (
                'value' => 'ta-IN-Standard-B',
                'label' => 'Pierce-MALE',
              ),
              2 => 
              array (
                'value' => 'ta-IN-Standard-C',
                'label' => 'Mekhi-FEMALE',
              ),
              3 => 
              array (
                'value' => 'ta-IN-Standard-D',
                'label' => 'Lucas-MALE',
              ),
              4 => 
              array (
                'value' => 'ta-IN-Wavenet-A',
                'label' => 'Sigmund-FEMALE',
              ),
              5 => 
              array (
                'value' => 'ta-IN-Wavenet-B',
                'label' => 'Judson-MALE',
              ),
              6 => 
              array (
                'value' => 'ta-IN-Wavenet-C',
                'label' => 'Louie-FEMALE',
              ),
              7 => 
              array (
                'value' => 'ta-IN-Wavenet-D',
                'label' => 'Jaren-MALE',
              ),
            ),
            'te-IN' => 
            array (
              0 => 
              array (
                'value' => '-IN-Standard-A',
                'label' => 'Osvaldo-FEMALE',
              ),
              1 => 
              array (
                'value' => '-IN-Standard-B',
                'label' => 'Dave-MALE',
              ),
            ),
            'th-TH' => 
            array (
              0 => 
              array (
                'value' => 'th-TH-Standard-A',
                'label' => 'Mustafa-FEMALE',
              ),
            ),
            'tr-TR' => 
            array (
              0 => 
              array (
                'value' => 'tr-TR-Standard-A',
                'label' => 'Janick-FEMALE',
              ),
              1 => 
              array (
                'value' => 'tr-TR-Standard-B',
                'label' => 'Mathew-MALE',
              ),
              2 => 
              array (
                'value' => 'tr-TR-Standard-C',
                'label' => 'Arne-FEMALE',
              ),
              3 => 
              array (
                'value' => 'tr-TR-Standard-D',
                'label' => 'Orion-FEMALE',
              ),
              4 => 
              array (
                'value' => 'tr-TR-Standard-E',
                'label' => 'Ronaldo-MALE',
              ),
              5 => 
              array (
                'value' => 'tr-TR-Wavenet-A',
                'label' => 'Lukas-FEMALE',
              ),
              6 => 
              array (
                'value' => 'tr-TR-Wavenet-B',
                'label' => 'Cale-MALE',
              ),
              7 => 
              array (
                'value' => 'tr-TR-Wavenet-C',
                'label' => 'Timmothy-FEMALE',
              ),
              8 => 
              array (
                'value' => 'tr-TR-Wavenet-D',
                'label' => 'Domenic-FEMALE',
              ),
              9 => 
              array (
                'value' => 'tr-TR-Wavenet-E',
                'label' => 'Jordy-MALE',
              ),
            ),
            'uk-UA' => 
            array (
              0 => 
              array (
                'value' => 'uk-UA-Standard-A',
                'label' => 'Rickie-FEMALE',
              ),
              1 => 
              array (
                'value' => 'uk-UA-Wavenet-A',
                'label' => 'Torrey-FEMALE',
              ),
            ),
            'vi-VN' => 
            array (
              0 => 
              array (
                'value' => 'vi-VN-Standard-A',
                'label' => 'Tyrel-FEMALE',
              ),
              1 => 
              array (
                'value' => 'vi-VN-Standard-B',
                'label' => 'Garnett-MALE',
              ),
              2 => 
              array (
                'value' => 'vi-VN-Standard-C',
                'label' => 'Darrell-FEMALE',
              ),
              3 => 
              array (
                'value' => 'vi-VN-Standard-D',
                'label' => 'Cleveland-MALE',
              ),
              4 => 
              array (
                'value' => 'vi-VN-Wavenet-A',
                'label' => 'Tavares-FEMALE',
              ),
              5 => 
              array (
                'value' => 'vi-VN-Wavenet-B',
                'label' => 'Russell-MALE',
              ),
              6 => 
              array (
                'value' => 'vi-VN-Wavenet-C',
                'label' => 'Pierce-FEMALE',
              ),
              7 => 
              array (
                'value' => 'vi-VN-Wavenet-D',
                'label' => 'Lindsey-MALE',
              ),
            ),
          );
    }
    public function googleLanguageList()
    {
      return $languages =
      [
          "af-ZA"     => localize('Afrikaans (South Africa)'),
          "ar-XA"     => localize('Arabic'),
          "eu-ES"     => localize('Basque (Spain)'),
          "bn-IN"     => localize('Bengali (India)'),
          "bg-BG"     => localize('Bulgarian (Bulgaria)'),
          "ca-ES"     => localize('Catalan (Spain) '),
          "yue-HK"    => localize('Chinese (Hong Kong)'),
          "cs-CZ"     => localize('Czech (Czech Republic)'),
          "da-DK"     => localize('Danish (Denmark)'),
          "nl-BE"     => localize('Dutch (Belgium)'),
          "nl-NL"     => localize('Dutch (Netherlands)'),
          "en-AU"     => localize('English (Australia)'),
          "en-IN"     => localize('English (India)'),
          "en-GB"     => localize('English (UK)'),
          "en-US"     => localize('English (US)'),
          "fil-PH"    => localize('Filipino (Philippines)'),
          "fi-FI"     => localize('Finnish (Finland)'),
          "fr-CA"     => localize('French (Canada)'),
          "fr-FR"     => localize('French (France)'),
          "gl-ES"     => localize('Galician (Spain)'),
          "de-DE"     => localize('German (Germany)'),
          "el-GR"     => localize('Greek (Greece)'),
          "gu-IN"     => localize('Gujarati (India)'),
          "he-IL"     => localize('Hebrew (Israel)'),
          "hi-IN"     => localize('Hindi (India)'),
          "hu-HU"     => localize('Hungarian (Hungary)'),
          "is-IS"     => localize('Icelandic (Iceland)'),
          "id-ID"     => localize('Indonesian (Indonesia)'),
          "it-IT"     => localize('Italian (Italy)'),
          "ja-JP"     => localize('Japanese (Japan)'),
          "kn-IN"     => localize('Kannada (India)'),
          "ko-KR"     => localize('Korean (South Korea)'),
          "lv-LV"     => localize('Latvian (Latvia)'),
          "ms-MY"     => localize('Malay (Malaysia)'),
          "ml-IN"     => localize('Malayalam (India)'),
          "cmn-CN"    => localize('Mandarin Chinese'),
          "cmn-TW"    => localize('Mandarin Chinese (T)'),
          "mr-IN"     => localize('Marathi (India)'),
          "nb-NO"     => localize('Norwegian (Norway)'),
          "pl-PL"     => localize('Polish (Poland)'),
          "pt-BR"     => localize('Portuguese (Brazil)'),
          "pt-PT"     => localize('Portuguese (Portugal)'),
          "pa-IN"     => localize('Punjabi (India)'),
          "ro-RO"     => localize('Romanian (Romania)'),
          "ru-RU"     => localize('Russian (Russia)'),
          "sr-RS"     => localize('Serbian (Cyrillic)'),
          "sk-SK"     => localize('Slovak (Slovakia)'),
          "es-ES"     => localize('Spanish (Spain)'),
          "es-US"     => localize('Spanish (US)'),
          "sv-SE"     => localize('Swedish (Sweden)'),
          "ta-IN"     => localize('Tamil (India)'),
          "te-IN"     => localize('Telugu (India)'),
          "th-TH"     => localize('Thai (Thailand)'),
          "tr-TR"     => localize('Turkish (Turkey)'),
          "uk-UA"     => localize('Ukrainian (Ukraine)'),
          "vi-VN"     => localize('Vietnamese (Vietnam)')
      ];
    }
    public function openAiTextToSpeechLanguage()
    {
      $language = "Afrikaans, Arabic, Armenian, Azerbaijani, Belarusian, Bosnian, Bulgarian, Catalan, Chinese, Croatian, Czech, Danish, Dutch, English, Estonian, Finnish, French, Galician, German, Greek, Hebrew, Hindi, Hungarian, Icelandic, Indonesian, Italian, Japanese, Kannada, Kazakh, Korean, Latvian, Lithuanian, Macedonian, Malay, Marathi, Maori, Nepali, Norwegian, Persian, Polish, Portuguese, Romanian, Russian, Serbian, Slovak, Slovenian, Spanish, Swahili, Swedish, Tagalog, Tamil, Thai, Turkish, Ukrainian, Urdu, Vietnamese, Welsh";
      $languages = explode(',', $language);
      return $languages;
    }
}
