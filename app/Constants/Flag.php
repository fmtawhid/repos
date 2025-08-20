<?php

namespace App\Constants;

class Flag
{
    const HOUSEWIFE_BASKET_CATEGORY_ID = 13;
    const DEFAULT_COUNTRY_TOGO_ID      = 218;
    const DEFAULT_OTHER_CATEGORY_ID    = 24;
    const TYPE_FLAT                    = 1;
    const TYPE_PERCENTAGE              = 2;
    const CLOTHING_CATEGORY_ID         = 3;
    const IS_DEFAULT_CURRENCY = 1;
    const SEEN          = 1;
    const SHOW_SECTION  = 1;
    const NOT_SEEN      = 0;

    const ADMIN_DASHBOARD_PREFIX = "admin";


    # Pagination setting
    public const PER_PAGE_DEFAULT   = 10;
    public const PER_PAGE_ARR       = [25, 50, 100, 200, 500];

    /**
     * ######################################
     *              PANEL START
     * ######################################
     * */
    const PANEL_VENDOR = "VENDOR";
    const PANEL_SUPPLIER = "supplier";
    const PANEL_VENDOR_STORE = "VENDOR_stores";
    const PANEL_VENDOR_STORE_FILTER = "VENDOR_store_filter";
    const PANEL_WEBSITE = "website";
    const PANEL_WEBSITE_FILTER = "website_filter";
    /**
     * ######################################
     *              PANEL END
     * ######################################
     * */



    /**
     * ######################################
     *              PANEL END
     * ######################################
     * */

    const DELIVERY_BOY_ORDER_HAS_ACCEPTED = 1;
    const DELIVERY_BOY_ORDER_PENDING = 2;
    const DELIVERY_BOY_ORDER_HAS_DECLINED = 3;




    /**
     * #################################
     * #    Discount   #
     * #################################
     * */

    const NO_DISCOUNT_IS_APPLIED = 0;
    const DISCOUNT_TYPE_FLAT = 1;
    const DISCOUNT_TYPE_PERCENTAGE = 2;




    /**
     * #################################
     * #     Delivery Status Start     #
     * #################################
     * */
    const CANCEL_REQUEST_ACCEPT = 'accept';
    const CANCEL_REQUEST_REJECT = 'reject';

    const ORDER_CANCEL_PENDING = 0;
    const ORDER_CANCEL_APPROVE = 1;
    const ORDER_CANCEL_REJECT = 2;

    const ORDER_CANCELED = 13; // ORDER CANCELED BY CUSTOMER / ADMIN / VENDOR / SUPPLIER

    const ORDER_CANCEL_CUSTOMIZED_VALUE = 13;

    const ORDER_CANCELED_TEXT = "Canceled";
    const ORDER_COMPLETED = 1; // SUCCESSFUL COMPLETION
    const ORDER_DELIVERED = 1; // SUCCESSFUL COMPLETION
    const ORDER_COMPLETED_TEXT = "Delivered";
    const ORDER_CONFIRMED = 4; // Order Confirmed
    const ORDER_CONFIRMED_TEXT = "Confirmed";

    const ORDER_DECLINED = 2; // DECLINED BY DELIVERY-BOY AS PER CUSTOMER REQUEST
    const ORDER_DECLINED_TEXT = "Declined";

    const ORDER_PENDING = 3; // PENDING OR ON-PROGRESS
    const ORDER_PENDING_TEXT = "Pending";

    //Picked up
    const ORDER_PICKED_UP = 5;
    const ORDER_PICKED_UP_TEXT = "Picked up";

    const ORDER_PROCESSING = 6;
    const ORDER_PROCESSING_TEXT = "Processing";

    const ORDER_SHIPPED = 7;
    const ORDER_SHIPPED_TEXT = "Shipped";

    const ORDER_RECEIVED_BY_WAREHOUSE = 8;
    const ORDER_RECEIVED_BY_WAREHOUSE_TEXT = "Received by Warehouse";

    const ORDER_DELIVERY_BOY_ASSIGNED = 9;
    const ORDER_DELIVERY_BOY_ASSIGNED_TEXT = "Delivery Boy Assigned";

    const ORDER_READY_TO_DELIVERY = 10;
    const ORDER_READY_TO_DELIVERY_TEXT = "Ready to Delivery";

    const ORDER_SEND_OTP = 11;
    const ORDER_SEND_OTP_TEXT = "Send OTP";
    const ORDER_OTP_VERIFIED = 12;
    const ORDER_OTP_VERIFIED_TEXT = "OTP Verified";

    const ORDER_CANCELLED = 13;
    const ORDER_CANCELLED_TEXT = "Canceled";

    const ORDER_ON_THE_WAY_TO_DELIVERY = 14;
    const ORDER_ON_THE_WAY_TO_DELIVERY_TEXT = "On The Way To Delivery";

    const DElIVERY_CHARGE_AMOUNT = 50;

    //    Delivery Status Access
    const DELIVERY_BOY_ACCESS_TRUE = 1;


    //5 = Packaging Done,6 = Handover to the Courier,7 = Product Shipped,8 = Shipment Done,
    //9 = Product delivering via Delivery Boy

    const ORDER_STATUSES_ENUM = [
        self::ORDER_CANCELED                => self::ORDER_CANCELED_TEXT,
        self::ORDER_CANCELLED               => self::ORDER_CANCELLED_TEXT,
        self::ORDER_CONFIRMED               => self::ORDER_CONFIRMED_TEXT,
        self::ORDER_COMPLETED               => self::ORDER_COMPLETED_TEXT,
        self::ORDER_DECLINED                => self::ORDER_DECLINED_TEXT,
        self::ORDER_PENDING                 => self::ORDER_PENDING_TEXT,
        self::ORDER_RECEIVED_BY_WAREHOUSE   => self::ORDER_RECEIVED_BY_WAREHOUSE_TEXT,
        self::ORDER_DELIVERY_BOY_ASSIGNED   => self::ORDER_DELIVERY_BOY_ASSIGNED_TEXT,
        self::ORDER_PICKED_UP               => self::ORDER_PICKED_UP_TEXT,
        self::ORDER_ON_THE_WAY_TO_DELIVERY  => self::ORDER_ON_THE_WAY_TO_DELIVERY_TEXT,
        self::ORDER_READY_TO_DELIVERY       => self::ORDER_READY_TO_DELIVERY_TEXT,
        self::ORDER_SEND_OTP                => self::ORDER_SEND_OTP_TEXT,
        self::ORDER_OTP_VERIFIED            => self::ORDER_OTP_VERIFIED_TEXT,
    ];


    //only 3 status
    const ORDER_STATUSES_ENUM_FOR_VENDOR_REPORT = [
        self::ORDER_CANCELLED               => self::ORDER_CANCELLED_TEXT,
        self::ORDER_COMPLETED               => self::ORDER_COMPLETED_TEXT,
        self::ORDER_PENDING                 => self::ORDER_PENDING_TEXT,
    ];


    # table data status
    public const STATUS_ARR = [
        1 => 'Active',
        0 => 'Disable',
    ];

    const COD    = "cod";
    const PAYPAL = "paypal";
    const STRIPE = "stripe";


    //==============================================
    //Delivery Boy Commission Type
    //==============================================
    const DELIVERY_BOY_COMMISSION_TYPE_FIXED        = 1;
    const DELIVERY_BOY_COMMISSION_TYPE_PERCENTAGE   = 2;


    /**
     * #################################
     * #     Delivery Status END     #
     * #################################
     * */


    /**
     * #################################
     * #     Delivery Boy Order Status     #
     * #################################
     * */
    const ACCEPTED_DELIVERY_BOY_ORDER = 1;
    const PENDING_DELIVERY_BOY_ORDER  = 2;
    const DECLINED_DELIVERY_BOY_ORDER = 3;


    const TEXT_ACCEPTED_DELIVERY_BOY_ORDER = 'Accepted';
    const TEXT_PENDING_DELIVERY_BOY_ORDER  = 'Pending';
    const TEXT_DECLINED_DELIVERY_BOY_ORDER = 'Declined';

    //1 means auto assign. others/else not auto and should take delivery boy's approval
    const DELIVERY_BOY_AUTO_APPROVAL_SETTING_KEYWORD = "delivery_boy_assigned_to_order_auto_approval";

    const IS_OTP_VERIFICATION_REQUIRED_FOR_MARK_AS_DELIVERED = "is_otp_verification_required_for_mark_as_delivered";

    const OTP_VERIFICATION_REQUIRED       = 1;
    const OTP_VERIFICATION_NOT_REQUIRED   = 2;


    /**
     * #################################
     * #       ORDER FLAG'S START      #
     * #################################
     * */
    const ORDER_TYPE_COD          = 0;
    const ORDER_TYPE_COD_TEXT     = "Cash on Delivery";
    const ORDER_TYPE_ONLINE       = 1;
    const ORDER_TYPE_ONLINE_TEXT  = "Online Payment";
    const ORDER_TYPE_FUNDED_WALLET  = 2;
    const ORDER_TYPE_FUNDED_WALLET_TEXT  = "Funded Wallet";

    const ORDER_TYPES = [
        self::ORDER_TYPE_COD          => self::ORDER_TYPE_COD_TEXT,
        self::ORDER_TYPE_ONLINE       => self::ORDER_TYPE_ONLINE_TEXT,
        self::ORDER_TYPE_FUNDED_WALLET => self::ORDER_TYPE_FUNDED_WALLET_TEXT,
    ];

    const CREDIT  = "credit"; // if new amount in means credit
    const DEBIT  = "debit"; // withdraw or invest or cost as debit

    // Payments
    const PAYMENT_UNPAID   = 0;
    const PAYMENT_PAID     = 1;
    const PAYMENT_PARTIAL  = 2;

    const ORDER_FROM_CUSTOMER = 1;
    const ORDER_FROM_VENDOR = 2;

    const ORDER_REFUND_PENDING  = 0;
    const ORDER_REFUND_APPROVED = 1;
    const ORDER_REFUND_REJECT   = 2;
    const ORDER_PRODUCT_IS_NOT_REFUND = 0;


    /**
     * #################################
     * #       ORDER FLAG'S END        #
     * #################################
     * */

    /**
     * ######################################
     * #       Payment Gateway Start        #
     * ######################################
     * */
    const GATEWAY_CARD = "card";
    const GATEWAY_COD = "cod";
    const GATEWAY_CASH = "cash";
    const GATEWAY_PAYGATEGLOBAL = "payGateGlobal";
    const PAYMENT_REJECTED   = 0;
    const PAYMENT_SUCCESS     = 1;
    const PAYMENT_PROCESSING  = 2;
    const MANUAL_PAYMENT    = 0;
    const AUTOMATIC_PAYMENT = 1;
    const GATEWAY_WALLET         = "WALLET";
    const GATEWAY_FUNDING_WALLET = "FUNDING_WALLET";
    /**
     * ######################################
     * #       Payment Gateway END          #
     * ######################################
     * */



    // REFUND STATUS
    const REFUND_PENDING  = 0;
    const REFUND_APPROVED = 1;
    const REFUND_REJECTED = 2;
    const ORDER_IS_NOT_REFUND = 0;

    /**
     * #################################
     * #       ORDER FLAG'S END        #
     * #################################
     * */


    /**
     * #################################
     * #      CART FLAG'S START        #
     * #################################
     * */
    const CART_INCREASE = "increase";
    const CART_DECREASE = "decrease";
    const CART_DELETE   = "delete";
    const TEXT_OUT_OF_STOCK = "Out of Stock";

    const SHOULD_CHECK_STOCK_BEFORE_PLACE_AN_ORDER = "should_check_stock_before_place_an_order";

    /**
     * #################################
     * #        CART FLAG'S END        #
     * #################################
     * */


    /**
     * #################################
     * #      LANGUAGE FLAG'S START        #
     * #################################
     * */
    const LANGUAGE_IS_RTL      = 1;
    const LANGUAGE_IS_NOT_RTL  = 0;
    /**
     * #################################
     * #        LANGUAGE FLAG'S END        #
     * #################################
     * */


    /**
     * #########################################
     *       PAYMENT GATEWAY FLAG'S START
     * #########################################
     * */
    const GATEWAY_CASH_ON_DELIVERY = "Cash_on_Delivery";
    const GATEWAY_ENABLED_COD      = "enable_cod";
    const GATEWAY_PAYPAL           = "paypal";
    const GATEWAY_STRIPE           = "stripe";
    const TYPE_SANDBOX = "sandbox";
    const TYPE_LIVE    = "live";
    const GATEWAY_NETWORK_FLOOZ = "FLOOZ";
    const GATEWAY_NETWORK_TMONEY = "TMONEY";
    const PIOMART_PLATFORM = "piomart_platform";
    /**
     * #########################################
     *       PAYMENT GATEWAY FLAG'S END
     * #########################################
     * */

    /**
     * #########################################
     *       SOCIAL DRIVER FLAG'S START
     * #########################################
     * */
    const TWITTER_LOGIN_DRIVER = 'twitter';
    const GOOGLE_LOGIN_DRIVER  = 'google';
    const FACEBOOK_LOGIN_DRIVER  = 'facebook';

    const SOCIAL_PROVIDERS_ARR = [
        self::GOOGLE_LOGIN_DRIVER,
        self::FACEBOOK_LOGIN_DRIVER
    ];

    /**
     * #########################################
     *       SOCIAL DRIVER FLAG'S END
     * #########################################
     * */


    /**
     * #########################################
     *       SUPPORT TICKET FLAG'S START
     * #########################################
     * */
    const TICKET_OPEN   = 0;
    const TICKET_CLOSED = 1;
    /**
     * #########################################
     *       SUPPORT TICKET  FLAG'S END
     * #########################################
     * */


    /*
    * ####################
    * AI START
    * ####################
    **/

    // Product Title
    CONST CONTENT_TYPE_PRODUCT_TITLE = 1;
    CONST CONTENT_TYPE_PRODUCT_TITLE_TXT = "Product Title";
    const CONTENT_TYPE_PRODUCT_TITLE_PROMPT_HINT = "'Create a catchy product title for";

    // Product Short Description
    CONST CONTENT_TYPE_PRODUCT_SHORT_DESCRIPTION = 2;
    CONST CONTENT_TYPE_PRODUCT_SHORT_DESCRIPTION_TEXT = "Product Short Description";

    // Product Long Description
    CONST CONTENT_TYPE_PRODUCT_LONG_DESCRIPTION = 3;
    CONST CONTENT_TYPE_PRODUCT_LONG_DESCRIPTION_TEXT = "Product Short Description";



    const CONTENT_TYPE_ARR = [
        self::CONTENT_TYPE_PRODUCT_TITLE             => self::CONTENT_TYPE_PRODUCT_TITLE_TXT,
        self::CONTENT_TYPE_PRODUCT_SHORT_DESCRIPTION => self::CONTENT_TYPE_PRODUCT_SHORT_DESCRIPTION_TEXT,
        self::CONTENT_TYPE_PRODUCT_LONG_DESCRIPTION  => self::CONTENT_TYPE_PRODUCT_LONG_DESCRIPTION_TEXT,
    ];

    /*
    * ####################
    * AI END
    * ####################
    **/

    /**
     * #########################################
     *       USER FLAG'S START
     * #########################################
     * */
    const CHUNK                     = "chunk";
    const TYPE_ADMIN                = 1;
    const TYPE_ADMIN_AGENT          = 2;
    const TYPE_VENDOR               = 3;
    const TYPE_VENDOR_TEAM          = 31;    
    const TYPE_CUSTOMER             = 4;


    const ACTIVE_ACCOUNT            = 1;
    const INACTIVE_ACCOUNT          = 0;

    const IS_ACTIVE                 = 1;
    const ACTIVE                 = 1;

    const TYPE_ADMIN_TEXT           = "Super Admin";
    const TYPE_ADMIN_AGENT_TEXT     = "Admin Agent";
    const TYPE_VENDOR_TEXT        = "VENDOR";
    const TYPE_VENDOR_TEAM_TEXT   = "VENDOR Team";
    const TYPE_CUSTOMER_TEXT   = "Customer";

    const TYPE_TEXT_ARR = [
        self::TYPE_ADMIN        => self::TYPE_ADMIN_TEXT,
        self::TYPE_ADMIN_AGENT  => self::TYPE_ADMIN_AGENT_TEXT,
        self::TYPE_VENDOR       => self::TYPE_VENDOR_TEXT,
        self::TYPE_VENDOR_TEAM  => self::TYPE_VENDOR_TEAM_TEXT,
        self::TYPE_CUSTOMER => self::TYPE_CUSTOMER_TEXT,
    ];

    # USER TYPES
    public const USER_TYPES = [
        1  => self::TYPE_ADMIN_TEXT,
        2  => self::TYPE_ADMIN_AGENT_TEXT,
        3  => self::TYPE_VENDOR_TEXT,
        31 => self::TYPE_VENDOR_TEAM_TEXT,
    ];

    /**
     * #########################################
     *       USER FLAG'S END
     * #########################################
     * */

    /**
     * #########################################
     *         PRODUCT FLAG'S START
     * #########################################
     * */

    const COMBINATION        = "combination";
    const ADD_NEW_VARIATION  = "add-new-variation";
    const NEW_VARIATION      = "new-variation";

    const COLUMN_KEY_STOCK   = 'stock';
    const PRODUCT_LIMIT      = 8;
    const PRODUCT_OWNER_TYPE_VENDOR = 1;
    const PRODUCT_OWNER_TYPE_SUPPLIER = 2;
    const PRODUCT_OWNER_TYPE_ADMIN    = 3;
    const FUNDED_PRODUCT    = 1;
    const FEATURED_PRODUCT  = 1;
    const FEATURED_VENDOR  = 1;
    const UNFUND_PRODUCT    = 0;

    /**
     * #########################################
     *         PRODUCT FLAG'S END
     * #########################################
     * */

    /**
     * #########################################
     *         TYPE FLAG'S END
     * #########################################
     * */
    const DATA_TYPE_SLIDER           = 1;
    const DATA_TYPE_BANNER_REGULAR   = 2;
    const DATA_TYPE_BANNER_SPECIAL   = 3;
    const DATA_TYPE_CATEGORY         = 4;
    const DATA_TYPE_VENDOR         = 5;
    const DATA_TYPE_CAMPAIGN         = 6;
    const DATA_TYPE_PRODUCT          = 7;
    const DATA_TYPE_COUPON           = 8;

    /**
     * #########################################
     *         TYPE FLAG'S END
     * #########################################
     * */





    /**
     * #########################################
     *         CAMPAIGN FLAG'S START
     * #########################################
     * */

    //  Campaign Position
    const HOME_POSITION_1 = 1; //home top left campaign
    const HOME_POSITION_2 = 2; //home slider bottom campaign

    const CAMPAIGN_PRODUCT_TRUE = 1;

    //1 for showing in website
    const ADMIN_APPROVED_CAMPAIGN = 1;
    const ADMIN_REJECTED_CAMPAIGN = 0; // BUT by default 0 is for pending


    /**
     * #########################################
     *         CAMPAIGN FLAG'S END
     * #########################################
     * */

    public function xy()
    {
        return 123;
    }

    /**
     * #########################################
     *         Media Manager Start
     * #########################################
     * */
    const MEDIA_TYPE_IMAGE = 1;
    const MEDIA_TYPE_VIDEO = 2;
    const IS_META_MEDIA = 1;
    const IS_THUMBNAIL_MEDIA = 2;
    const IS_PRODUCT_PICTURE_MEDIA = 3;

    /**
     * #########################################
     *         Media Manager End
     * #########################################
     * */

    /**
     * #########################################
     *         CURRENCY
     * #########################################
     * */

    const CURRENCY_USD = 'usd';
    const CURRENCY_CFA = 'cfa';
    const DEFAULT = 1;


    /**
     * #########################################
     *         Transaction
     * #########################################
     * */

    const TRANSACTION_DEBIT = 'debit';
    const TRANSACTION_CREDIT = 'credit';
    const TRANSACTION_SUCCESS = 1;
    const TRANSACTION_FAILED  = 13;
    const TRANSACTION_PENDING = 2;


    const TRANSACTION_SUCCESS_TEXT = 'Success';
    const TRANSACTION_PENDING_TEXT = 'Pending';
    const TRANSACTION_FAILED_TEXT  = 'Failed';




    /**
     * #########################################
     *         WALLET RECHARGE START
     * #########################################
     * */
    const ADMIN_TO_VENDOR_WALLET_RECHARGE_NOTE = 'From admin to VENDOR wallet recharge';
    const TRANSFERRED_SUCCESS = 1;
    const TRANSFERRED_FAILED = 0;

    /**
     * #########################################
     *         WALLET RECHARGE END
     * #########################################
     * */

    /**
     * #########################################
     *              WITHDRAW START
     * #########################################
     * */

    const CASE_WITHDRAW_REQUEST_APPROVED                     = 1;
    const CASE_WITHDRAW_REQUEST_NEW                          = 2;
    const CASE_NEW_WITHDRAW_REQUEST_REJECTED                 = 3;
    const CASE_INVESTOR_MADE_OFFER_TO_FUND_RAISE_REQUEST     = 4;
    const CASE_MUN_GRAND_AMOUNT_LARGER_THAN_INVESTOR_AMOUNT  = 5;
    const CASE_MUN_GRAND_AMOUNT_SMALLER_THAN_INVESTOR_AMOUNT = 6;
    const CASE_VENDOR_GOT_INVESTMENT                       = 7;
    const CASE_VENDOR_USING_FUNDED_WALLET                  = 8;
    const CASE_FUND_REQUEST_STATIC_CLOSED                    = 9;
    const CASE_VENDOR_PURCHASING_BY_FUNDED_WALLET          = 10;

    const WITHDRAW_STATUS_SUCCESS  = 1;
    const WITHDRAW_STATUS_PENDING  = 2;
    const WITHDRAW_STATUS_REJECTED = 3;

    /**
     * #########################################
     *              WITHDRAW END
     * #########################################
     * */


    /**
     * #########################################
     *              OTP START
     * #########################################
     * */
    const OTP_TYPE_ORDER = 1;
    const OTP_TYPE_RESET_PASSWORD = 2;
    const OTP_TYPE_DELIVERY = 3;
    const OTP_TYPE_FORGET_PASSWORD = 4;

    const OTP_TYPE_ORDER_TEXT = 'Order';
    const OTP_TYPE_RESET_PASSWORD_TEXT = 'Reset Password';
    const OTP_TYPE_DELIVERY_TEXT = 'Delivery';
    const OTP_TYPE_FORGET_PASSWORD_TEXT = 'Forget Password';

    const OTP_TYPE_LISTS = [
        self::OTP_TYPE_ORDER => self::OTP_TYPE_ORDER_TEXT,
        self::OTP_TYPE_RESET_PASSWORD => self::OTP_TYPE_RESET_PASSWORD_TEXT,
        self::OTP_TYPE_DELIVERY => self::OTP_TYPE_DELIVERY_TEXT,
        self::OTP_TYPE_FORGET_PASSWORD => self::OTP_TYPE_FORGET_PASSWORD_TEXT,
    ];

    /**
     * #########################################
     *              OTP END
     * #########################################
     * */

    /**
     * #########################################
     *                 Investor Start
     * #########################################
     * */
    const FUND_REQUEST_STATIC_PENDING            = 2; // 1
    const ADMIN_NOT_INTERESTED                   = 10; // 1.1 | 1=Admin User type and 0=False and 10=Not Interested
    const FUND_REQUEST_SHORT_LISTED_BY_MUN       = 8; // 2
    const FUND_REQUEST_STATIC_INVESTOR_OFFERED   = 3; // 3
    const INVESTOR_NOT_INTERESTED                = 70; // 3.1  7=Investor User type and 0=False and 70=Not Interested
    const FUND_REQUEST_APPROVED_BY_MUN           = 7; // 4
    const FUND_REQUEST_STATIC_CLOSED             = 6; // 5
    const FUND_REQUEST_STATIC_INVESTED           = 1; // 6
    const FUND_REQUEST_STATIC_VERIFIED           = 5;
    const FUND_REQUEST_STATIC_VERIFICATION_START = 4;

    /**
     * #########################################
     *                 Investor End
     * #########################################
     * */


    /**
     * #########################################
     *                 COUPON Start
     * #########################################
     * */
    const COUPON_TYPE_QUANTITY  = 1;
    const COUPON_TYPE_SPENDING  = 2;
    const COUPON_OWNER_VENDOR = 1;
    const COUPON_OWNER_SUPPLIER = 2;
    const COUPON_OWNER_ADMIN    = 3;

    /**
     * #########################################
     *                 Investor End
     * #########################################
     * */

    /**
     * Supplier Ads
     *
     * 1=Home Page,2=Shop Page,3=VENDOR Page,4=Shop Filter Page, 5=Product Single Page, 6=About Us,  7=Contact Us,8=VENDOR Store Page
     * */

    const PAGE_HOME = 1;
    const PAGE_HOME_TEXT = "Home Page";

    const PAGE_SHOP = 2;
    const PAGE_SHOP_TEXT = "Shop Page";

    const PAGE_VENDOR = 3;
    const PAGE_VENDOR_TEXT = "VENDOR Page";

    const PAGE_SHOP_FILTER = 4;
    const PAGE_SHOP_FILTER_TEXT = "Shop Filter Page";

    const PAGE_PRODUCT_SINGLE = 5;
    const PAGE_PRODUCT_SINGLE_TEXT = "Product Single Page";

    const PAGE_ABOUT_US = 6;
    const PAGE_ABOUT_US_TEXT = "About Us";

    const PAGE_CONTACT_US = 7;
    const PAGE_CONTACT_US_TEXT = "Contact Us";

    const PAGE_VENDOR_STORE = 8;
    const PAGE_VENDOR_STORE_TEXT = "VENDOR Store Page";

    const PAGE_CAMPAIGN_LIST = 9;
    const PAGE_CAMPAIGN_LIST_TEXT = "Campaign List Page";

    const PAGE_ARR = [
        self::PAGE_HOME => self::PAGE_HOME_TEXT,
        self::PAGE_SHOP => self::PAGE_SHOP_TEXT,
        self::PAGE_VENDOR => self::PAGE_VENDOR_TEXT,
        self::PAGE_PRODUCT_SINGLE => self::PAGE_PRODUCT_SINGLE_TEXT,
        self::PAGE_CONTACT_US => self::PAGE_CONTACT_US_TEXT,
        self::PAGE_CAMPAIGN_LIST => self::PAGE_CAMPAIGN_LIST_TEXT,
        
        // self::PAGE_VENDOR_STORE => self::PAGE_VENDOR_STORE_TEXT,
        // self::PAGE_ABOUT_US => self::PAGE_ABOUT_US_TEXT,
        // self::PAGE_SHOP_FILTER => self::PAGE_SHOP_FILTER_TEXT,
    ];


    /* Ad Type
     * 1=Pop-up Ad,2=Banner Ad,3=Video Ad,4=Search Ads, 5=affiliate ads, 6=native ads, 7=social media ads, 8=email ads, 9=Demand side platform,10=Custom Ads
     * */
    const ACTIVE_BANNER = 1;

    const ACTIVE_POPUP_ADS = 1;


    const AD_TYPE_POP_UP = 1;
    const AD_TYPE_POP_UP_TEXT = "Pop-up Ad";

    const AD_TYPE_BANNER = 2;
    const AD_TYPE_BANNER_TEXT = "Banner Ad";

    const AD_TYPE_VIDEO = 3;
    const AD_TYPE_VIDEO_TEXT = "Video Ad";

    const AD_TYPE_SEARCH = 4;
    const AD_TYPE_SEARCH_TEXT = "Search Ads";

    const AD_TYPE_AFFILIATE = 5;
    const AD_TYPE_AFFILIATE_TEXT = "affiliate ads";

    const AD_TYPE_NATIVE = 6;
    const AD_TYPE_NATIVE_TEXT = "native ads";

    const AD_TYPE_SOCIAL_MEDIA = 7;
    const AD_TYPE_SOCIAL_MEDIA_TEXT = "social media ads";

    const AD_TYPE_EMAIL = 8;
    const AD_TYPE_EMAIL_TEXT = "email ads";

    const AD_TYPE_DEMAND_SIDE_PLATFORM = 9;
    const AD_TYPE_DEMAND_SIDE_PLATFORM_TEXT = "Demand side platform";

    const AD_TYPE_CUSTOM = 10;
    const AD_TYPE_CUSTOM_TEXT = "Custom Ads";

    const AD_TYPE_ARR = [
        self::AD_TYPE_POP_UP => self::AD_TYPE_POP_UP_TEXT,
        self::AD_TYPE_BANNER => self::AD_TYPE_BANNER_TEXT,
        self::AD_TYPE_VIDEO => self::AD_TYPE_VIDEO_TEXT,
        self::AD_TYPE_SEARCH => self::AD_TYPE_SEARCH_TEXT,
        self::AD_TYPE_AFFILIATE => self::AD_TYPE_AFFILIATE_TEXT,
        self::AD_TYPE_NATIVE => self::AD_TYPE_NATIVE_TEXT,
        self::AD_TYPE_SOCIAL_MEDIA => self::AD_TYPE_SOCIAL_MEDIA_TEXT,
        self::AD_TYPE_EMAIL => self::AD_TYPE_EMAIL_TEXT,
        self::AD_TYPE_DEMAND_SIDE_PLATFORM => self::AD_TYPE_DEMAND_SIDE_PLATFORM_TEXT,
        self::AD_TYPE_CUSTOM => self::AD_TYPE_CUSTOM_TEXT
    ];

    const AD_POSITION_TOP_LEFT = 1;
    const AD_POSITION_TOP_LEFT_TEXT = "Top Left";

    const AD_POSITION_TOP_MIDDLE = 2;
    const AD_POSITION_TOP_MIDDLE_TEXT = "Top Middle";

    const AD_POSITION_TOP_RIGHT = 3;
    const AD_POSITION_TOP_RIGHT_TEXT = "Top Right";

    const AD_POSITION_BOTTOM_LEFT = 4;
    const AD_POSITION_BOTTOM_LEFT_TEXT = "Bottom Left";

    const AD_POSITION_BOTTOM_MIDDLE = 5;
    const AD_POSITION_BOTTOM_MIDDLE_TEXT = "Bottom Middle";

    const AD_POSITION_BOTTOM_RIGHT = 6;
    const AD_POSITION_BOTTOM_RIGHT_TEXT = "Bottom Right";

    const AD_POSITION_ARR = [
        self::AD_POSITION_TOP_LEFT => self::AD_POSITION_TOP_LEFT_TEXT,
        self::AD_POSITION_TOP_MIDDLE => self::AD_POSITION_TOP_MIDDLE_TEXT,
        self::AD_POSITION_TOP_RIGHT => self::AD_POSITION_TOP_RIGHT_TEXT,
        self::AD_POSITION_BOTTOM_LEFT => self::AD_POSITION_BOTTOM_LEFT_TEXT,
        self::AD_POSITION_BOTTOM_MIDDLE => self::AD_POSITION_BOTTOM_MIDDLE_TEXT,
        self::AD_POSITION_BOTTOM_RIGHT => self::AD_POSITION_BOTTOM_RIGHT_TEXT
    ];



    const ADDRESS_TYPE_HOME = 1;
    const ADDRESS_TYPE_HOME_TEXT = "Home";

    const ADDRESS_TYPE_OFFICE = 2;
    const ADDRESS_TYPE_OFFICE_TEXT = "Office";

    const ADDRESS_TYPE_OTHER = 3;
    const ADDRESS_TYPE_OTHER_TEXT = "Other";

    const DEFAULT_ADDRESS = 1;

    const ADDRESS_TYPE_ARR = [
        self::ADDRESS_TYPE_HOME => self::ADDRESS_TYPE_HOME_TEXT,
        self::ADDRESS_TYPE_OFFICE => self::ADDRESS_TYPE_OFFICE_TEXT,
        self::ADDRESS_TYPE_OTHER => self::ADDRESS_TYPE_OTHER_TEXT
    ];

    /**
     * #########################################
     *              Notification START
     * #########################################
     * */
    const IS_PUSH_NOTIFICATION_REQUIRED = 1;
    const IS_SEND = 1;


    const NOTIFICATION_TYPE_OTP            = 1;
    const NOTIFICATION_TYPE_ORDER          = 2;
    const NOTIFICATION_TYPE_WALLET         = 3;
    const NOTIFICATION_TYPE_TRACKING       = 4;
    const NOTIFICATION_TYPE_CAMPAIGN       = 5;
    const NOTIFICATION_TYPE_TICKET         = 6;
    const NOTIFICATION_TYPE_WITHDRAWAL     = 7;
    const NOTIFICATION_TYPE_REFUND         = 8;
    const NOTIFICATION_TYPE_REFUND_REQUEST = 9;
    const NOTIFICATION_TYPE_INVESTMENT     = 10;
    const NOTIFICATION_TYPE_SHOP           = 11;
    const NOTIFICATION_TYPE_WISHLIST       = 12;
    const NOTIFICATION_TYPE_CART           = 13;
    const NOTIFICATION_TYPE_CONTACT_US     = 14;
    const NOTIFICATION_TYPE_SUPPORT_TICKET = 15;
    const NOTIFICATION_TYPE_TRANSACTION_REQUEST = 16;


    # Session
    const SESSION_BROWSER_COUNTRY_ID = 'browser_country_id';

    # Message build type
    const NOTIFICATION_MESSAGE = 'notification_message';
    const EMAIL_MESSAGE = 'email_message';


    # currency
    const SELECTED_CURRENCY_ID = 'SELECTED_CURRENCY_ID';
    const SELECTED_CURRENCY_NAME = 'SELECTED_CURRENCY_NAME';
    const SELECTED_CURRENCY_CODE = 'SELECTED_CURRENCY_CODE';
    const SELECTED_CURRENCY_SYMBOL = 'SELECTED_CURRENCY_SYMBOL';
    const SELECTED_CURRENCY_ALIGNMENT = 'SELECTED_CURRENCY_ALIGNMENT';
    const SELECTED_CURRENCY_RATE = 'SELECTED_CURRENCY_RATE';



    //--------------------------------------------
    // Popup ads page location no
    //--------------------------------------------
    const POPUP_ADS_FOR_HOME_PAGE       = 1;
    const POPUP_ADS_FOR_SHOP_PAGE       = 2;
    const POPUP_ADS_FOR_VENDOR_PAGE   = 3;
    const POPUP_ADS_FOR_SHOP_FILTER_PAGE = 4; //BOTH PAGE ARE SAME
    const POPUP_ADS_FOR_PRODUCT_SINGLE_PAGE = 5;

    const POPUP_ADS_FOR_ABOUT_US_PAGE = 6;
    const POPUP_ADS_FOR_CONTACT_US_PAGE = 7;
    const POPUP_ADS_FOR_VENDOR_STORE_PAGE = 8;
    const POPUP_ADS_FOR_CAMPAIGNS_PAGE = 9;


    const BANNER_PAGES_LIST = [
        [
            'name' => 'Home',
            'page_name' => 'home'
        ]
    ];

    const SECTIONS_FOR_HOME_PAGES = [
        //Banner for new home pag
        [
            'name'          => 'Banner After Weekly Best Deals',
            'context'       => 'banner_after_weekly_best_deals',
            'preview_image' => 'previewFiles/banner_after_weekly_best_deals.png'
        ],
        [
            'name' => 'Banner for Tab Products',
            'context' => 'banner_for_tab_products',
            'preview_image' => 'previewFiles/banner_for_tab_products.png'
        ],
        [
            'name' => 'Banner After Popular Seller',
            'context' => 'banner_after_popular_seller',
            'preview_image' => 'previewFiles/banner_after_popular_seller.png'
        ],

        // Banner for old home page
        // [
        //     'name'          => 'Top Popular Categories',
        //     'context'       => 'top_popular_categories',
        //     'preview_image' => 'previewFiles/top_popular_categories.png'
        // ],
        // [
        //     'name' => 'After Popular Categories',
        //     'context' => 'after_popular_categories',
        //     'preview_image' => 'previewFiles/after_top_popular_categories.png'
        // ],
        // [
        //     'name' => 'Flash Sale',
        //     'context' => 'flash_sale',
        //     'preview_image' => 'previewFiles/flash_sale.jpg'
        // ],
        // [
        //     'name' => 'After Flash Sale',
        //     'context' => 'after_flash_sale',
        //     'preview_image' => 'previewFiles/after_flash_sale.png'
        // ],
        // [
        //     'name' => 'Before Hot Sale Products',
        //     'context' => 'before_hot_sale_products',
        //     'preview_image' => 'previewFiles/before_hot_sale_products.png'
        // ],
        // [
        //     'name' => 'After Hot Sale Products',
        //     'context' => 'after_hot_sale_products',
        //     'preview_image' => 'previewFiles/after_hot_sale.png'
        // ],
        // [
        //     'name' => 'After New Products',
        //     'context' => 'after_new_products',
        //     'preview_image' => 'previewFiles/after_new_product.png'
        // ],
        // [
        //     'name' => 'Popular Section',
        //     'context' => 'popular_section',
        //     'preview_image' => 'previewFiles/popular_section.png'
        // ],
        // [
        //     'name' => 'After Top Seller',
        //     'context' => 'after_top_seller',
        //     'preview_image' => 'previewFiles/after_top_seller.png'
        // ],
        // [
        //     'name' => 'After Top Brands',
        //     'context' => 'after_top_brands',
        //     'preview_image' => 'previewFiles/after_top_brands.png'
        // ],        
    ];


    //--------------------------------------------
    // TYPE ID
    //--------------------------------------------
    const TYPE_ID_FOR_CAMPAIGN_DETAILS = 2;
    const TYPE_ID_FOR_ALL_CAMPAIGNS      = 9;
    const TYPE_ID_FOR_COUPON_PAGE        = 10;
    const TYPE_ID_FOR_DISCOUNTED_PRODUCTS = 6;
    const TYPE_ID_FOR_BEST_VENDORS   = 5;
    const TYPE_ID_FOR_TOP_RATED_PRODUCTS = 8;


    const TYPE_ID_FOR_PRODUCT_DETAILS  = 1;
    const TYPE_ID_FOR_CATEGORY_DETAILS = 3;
    const TYPE_ID_FOR_VENDOR_DETAILS = 4;
    const TYPE_ID_FOR_SHOP_PRODUCTS = 7;
}
