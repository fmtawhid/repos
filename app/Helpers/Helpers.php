<?php

use Carbon\Carbon;
use App\Enum\PostEnum;
use App\Models\AdSense;
use App\Utils\AppCache;
use App\Models\Currency;
use App\Models\Language;
use App\Utils\AppStatic;
use App\Utils\SessionLab;
use Illuminate\Support\Str;
use App\Models\Localization;
use App\Models\MediaManager;
use App\Models\EmailTemplate;
use App\Models\SystemSetting;
use App\Models\PaymentGateway;
use App\Models\StorageManager;
use App\Models\ThemeTagModule;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionUser;
use App\Services\Log\LogService;
use App\Services\Core\OpenAiCore;
use App\Services\File\FileService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Nwidart\Modules\Facades\Module;
use App\Models\PaymentGatewayDetail;
use App\Models\Status;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Models\SubscriptionUserUsage;
use App\Services\Business\VendorPlanRouteService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;
use Illuminate\Http\Exceptions\HttpResponseException;

if (!function_exists("postStatus")) {
    function postStatus()
    {

        return [
            PostEnum::STATUS_DRAFT,
            PostEnum::STATUS_PUBLISH,
            PostEnum::STATUS_PRIVATE,
            PostEnum::STATUS_FUTURE,
            PostEnum::STATUS_PENDING
        ];
    }
}

/**
 * Beware of changes, Because it's using as API Error Response
 * */

if (!function_exists("errorArray")) {
    function errorArray($e)
    {

        return [
            "title"         => $e->getMessage(),
            "file"          => $e->getFile(),
            "line"          => $e->getLine(),
        ];
    }
}




if (!function_exists("ddError")) {
    function ddError($e, $options = [])
    {

        return dd(errorArray($e), $options);
    }
}

if (!function_exists("clientAgent")) {
    function clientAgent()
    {

        return request()->userAgent();
    }
}

if (!function_exists("wLog")) {
    /**
     * @throws JsonException
     */
    function wLog($title, array $payloads = [], $channel = "daily", $writeToLog = true)
    {

        if (!$writeToLog) {
            return false;
        }

        (new LogService())->wLog(
            $title,
            $payloads,
            $channel
        );
    }
}

if (!function_exists("commonLog")) {
    function commonLog(
        $title,
        $payloads = [],
        $channel = "daily"
    ) {
        (new \App\Services\Log\LogService())->commonLog(
            $title,
            $payloads,
            $channel
        );
    }
}

if (!function_exists("appStatic")) {
    function appStatic()
    {

        return new AppStatic();
    }
}

if (!function_exists("constantFlags")) {
    function constantFlags()
    {

        return new AppStatic();
    }
}



if (!function_exists("sessionLab")) {
    function sessionLab()
    {

        return new SessionLab();
    }
}

if (!function_exists("getSessionChatThreadId")) {
    function getSessionChatThreadId()
    {

        return session(\sessionLab()::SESSION_CHAT_THREAD_ID);
    }
}

if(!function_exists("localize")) {
    function localize($key, $lang = null, $localize = true)
    {
        if ($localize == false) {
            return $key;
        }

        if ($lang == null) {
            $lang = App::getLocale();
        }

        $t_key = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($key)));

        $localization_english = Cache::rememberForever('localizations-en', function () {
            return Localization::where('lang_key', 'en')->pluck('t_value', 't_key');
        });

        if (!isset($localization_english[$t_key])) {
            # add new localization
            newLocalization('en', $t_key, $key);
        }

        # return user session lang
        $localization_user = Cache::rememberForever("localizations-{$lang}", function () use ($lang) {
            return Localization::where('lang_key', $lang)->pluck('t_value', 't_key')->toArray();
        });

        if (isset($localization_user[$t_key])) {
            return trim($localization_user[$t_key]);
        }

        return isset($localization_english[$t_key]) ? trim($localization_english[$t_key]) : $key;
    }
}
if (!function_exists('newLocalization')) {
    # new localization
    function newLocalization($lang, $t_key, $key, $type = null)
    {
        $localization = new Localization;
        $localization->lang_key = $lang;
        $localization->t_key = $t_key;
        $localization->t_key = $t_key;
        $localization->t_value = str_replace(array("\r", "\n", "\r\n"), "", $key);
        $localization->save();

        # clear cache
        Cache::forget('localizations-' . $lang);

        return trim($key);
    }
}

if(!function_exists("expertsArray")) {
    function expertsArray(){

        return ["chat", "pdf", "vision", "image", "video"];
    }
}

if (!function_exists("errorBlock")) {
    function errorBlock($name)
    {
        return view('common.error', ['name' => $name]);
    }
}

// Pagination footer
if (!function_exists("paginationFooter")) {
    function paginationFooter($dataModel, $colspan)
    {
        return view('common.page-info-footer', ['dataModel' => $dataModel, 'colspan' => $colspan]);
    }
}

if (!function_exists("paginationFooterDiv")) {
    function paginationFooterDiv($dataModel)
    {
        return view('common.page-info-footer-div', ['dataModel' => $dataModel]);
    }
}


if (!function_exists("isPublished")) {
    function isPublished($value)
    {

        return $value == 1 || $value == true;
    }
}

if (!function_exists("isPaid")) {
    function isPaid($value): bool
    {

        return (int)$value === \appStatic()::PAYMENT_STATUS_PAID;
    }
}

if (!function_exists("isPaymentPending")) {
    function isPaymentPending($value): bool
    {

        return (int)$value === \appStatic()::PAYMENT_STATUS_PENDING;
    }
}


if (!function_exists("isPaymentRejected")) {
    function isPaymentRejected($value): bool
    {

        return (int)$value === \appStatic()::PAYMENT_STATUS_REJECTED;
    }
}

if (!function_exists("isPaymentResubmit")) {
    function isPaymentResubmit($value)
    {

        return (int)$value === \appStatic()::PAYMENT_STATUS_RESUBMIT;
    }
}


# Get Logged in User ID
if (!function_exists("isLoggedIn")) {
    function isLoggedIn()
    {
        return auth()->check();
    }
}

# Authorize User
if (!function_exists("user")) {
    function user()
    {
        return isLoggedIn() ? auth()->user() : null;
    }
}

if (!function_exists("getUserObject")) {
    function getUserObject()
    {
        if(isLoggedIn()) {

            return empty(user()->parent_user_id) ? user() : user()->parentUser;
        }
    }
}

# User Full name
if (!function_exists("userFullName")) {
    function userFullName()
    {
        return isLoggedIn() ? user()->fullName : null;
    }
}

# Get Logged in User ID
if (!function_exists("userID")) {
    function userID()
    {
        if(!isLoggedIn()){
            return null;
        }

        return  (int) (auth()->id() ?? 0);
    }
}

if (!function_exists("userId")) {
    function userId()
    {
        if(!isLoggedIn()){
            return null;
        }

        return  (int) (auth()->id() ?? 0);
    }
}

# find by primary key
if (!function_exists("findById")) {
    function findById(\Illuminate\Database\Eloquent\Model $model, array | int $id, array | string $withRelationShip = [], array $conditions = [])
    {
        // Relationship Add
        (!empty($withRelationShip) ? $model->with($withRelationShip) : true);

        if(!empty($conditions)) {
            $model->where($conditions);
        }
        if (is_array($id)) {
            return $model->withTrashed()->find($id);
        }

        return  $model->withTrashed()->findOrFail($id);
    }
}


// Return True means Admin user
if (!function_exists("isAdmin")) {
    function isAdmin($userType = null): bool
    {
        if(empty($userType)){
            $userType = isLoggedIn() ? user()->user_type : \appStatic()::TYPE_ADMIN;
        }

        return appStatic()::TYPE_ADMIN === (int)$userType; // True / False
    }
}

// Return True means Admin Staff user
if (!function_exists("isAdminTeam")) {
    function isAdminTeam($userType = null): bool
    {
        if(empty($userType)){
            $userType = isLoggedIn() ? user()->user_type : \appStatic()::TYPE_ADMIN_STAFF;
        }

        return appStatic()::TYPE_ADMIN_STAFF === (int)$userType; // True / False
    }
}

// Return True means Admin user
if (!function_exists("isAdminUserGroup")) {
    function isAdminUserGroup($userType = null): bool
    {
        if(!isLoggedIn()){
            return false;
        }

        if(empty($userType)){
            $userType = user()->user_type;
        }

        return isAdmin($userType) || isAdminTeam($userType);
    }
}



// Return True means Admin user
if (!function_exists("isVendor")) {
    function isVendor($userType = null): bool
    {
        if(empty($userType)){
            $userType = isLoggedIn() ? user()->user_type : \appStatic()::TYPE_VENDOR;
        }

        return appStatic()::TYPE_VENDOR === (int)$userType; // True / False
    }
}

// Return True means Admin Staff user
if (!function_exists("isVendorTeam")) {
    function isVendorTeam($userType = null): bool
    {
        if(empty($userType)){
            $userType = isLoggedIn() ? user()->user_type : \appStatic()::TYPE_VENDOR_TEAM;
        }

        return appStatic()::TYPE_VENDOR_TEAM === (int)$userType; // True / False
    }
}

// Return True means Admin user
if (!function_exists("isVendorUserGroup")) {
    function isVendorUserGroup($userType = null): bool
    {
        if(!isLoggedIn()){
            return false;
        }

        if(empty($userType)){
            $userType = user()->user_type;
        }

        return isVendor($userType) || isVendorTeam($userType);
    }
}



// Return True means Admin user
if (!function_exists("escapeForAdmin")) {
    function escapeForAdmin(): bool
    {
        $user = getUserObject();

        return isAdminUserGroup($user->user_type);
    }
}


if (!function_exists("isPOSRoute")) {
    function isPOSRoute($value = null)
    {
        // When query string has is_pos_route == 1
        if (request()->is_pos_route == 1) {
            return true;
        }

        // When $value is not empty
        if (!empty($value)) {

            return (int) $value === 1; //TODO:: 1 will replace with Const Param as Default identifier
        }

        // Pos Manager url prefix found.
        return request()->segment(2) === 'pos-manager';
    }
}


if (!function_exists("isCustomerCheckoutRoute")) {
    function isCustomerCheckoutRoute($value = null): bool
    {
        if (!empty($value)) {
            return $value == 1; //TODO:: 1 will replace with Const Param as Default identifier
        }

        return currentRoute() == "customer.carts.checkout";
    }
}


if (!function_exists('isWebsiteShop')) {
    function isWebsiteShop()
    {
        return currentRoute() === "shops";
    }
}


// Return  True means customer
if (!function_exists("isCustomer")) {
    function isCustomer($userType = null): bool
    {
        if(empty($userType)){
            $userType = isLoggedIn() ? user()->user_type : \appStatic()::TYPE_CUSTOMER;
        }

        return (int)$userType === \appStatic()::TYPE_CUSTOMER; // True / False
    }
}



// Return True means Admin user
if (!function_exists("allowCustomerSeKeyword")) {
    function allowCustomerSeKeyword(): bool
    {
        if(isCustomerUserGroup()){
            $allowSeoKeyword = allowPlanFeature("allow_seo_keyword");

            if($allowSeoKeyword){
                return true;
            }
        }

        return false;
    }
}


# Merchant ID
if (!function_exists("customerId")) {
    function customerId()
    {
        isLoggedIn();

        if (isCustomer()) {
            return userId();
        }

        return  getUserParentId();
    }
}

# Vendor ID
if (!function_exists("vendorId")) {
    function vendorId()
    {
        isLoggedIn();

        if (isVendor()) {
            return userId();
        }

        return  getUserParentId();
    }
}


// Return Parent User ID
if (!function_exists("getUserParentId")) {
    function getUserParentId()
    {
        if(isLoggedIn()){
            if(isAdmin() || isVendor()){
                return userID();
            }

            return user()->parent_user_id;
        }
    }
}

// Return Parent User ID
if (!function_exists("getUserBranchId")) {
    function getUserBranchId()
    {
        if(isLoggedIn()){

            return user()->branch_id;
        }

        return null;
    }
}

if (!function_exists("getBranchesByVendorId")) {
    function getBranchesByVendorId($vendorId = null)
    {

        if(empty($vendorId)){
            return [];
        }

        return (new \Modules\BranchModule\App\Services\BranchService())->getBranchesByVendorId($vendorId);
    }
}

// Return Parent User ID
if (!function_exists("getUserBranch")) {
    function getUserBranch()
    {
        if(isLoggedIn()){

            return user()->branch;
        }

        return null;
    }
}

// Return Parent User ID
/*
 * 1. When logged in user-type is Admin or Customer means return their id
 * 2. When Admin or Customer Employees logged in return parent_user_id as parent admin/customer
 * */
if (!function_exists("getAdminOrCustomerId")) {
    function getAdminOrCustomerId()
    {
        if (isLoggedIn()) {
            if (isAdmin() || isVendor()) {
                return userID();
            }
        }
    }
}

# Print
if (!function_exists("pr")) {
    function pr($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
}

# Dump
if (!function_exists("dump")) {
    function dump($arr)
    {
        echo '<pre>';
        var_dump($arr);
        echo '</pre>';
    }
}



if (!function_exists("logService")) {
    function logService()
    {

        return new LogService();
    }
}

if (!function_exists("fileService")) {
    function fileService()
    {

        return new FileService();
    }
}


# Price TO USD
if (!function_exists('priceToUsd')) {
    // price to usd
    function priceToUsd($price)
    {
        // convert amount equal to local currency
        if (Session::has('currency_code') && Session::has('local_currency_rate')) {
            $price = floatval($price) / floatval(Session::get('local_currency_rate'));
        }

        return $price ?? 0;
    }
}

#Request Response
if (!function_exists("requestResponse")) {
    function requestResponse()
    {

        return new \App\Constants\RequestResponse();
    }
}


if (!function_exists('formatPrice')) {

    //formats price - truncate price to 1M, 2K if activated by admin
    function formatPrice($price, $truncate = false, $forceTruncate = false, $addSymbol = true, $numberFormat = true)
    {
        // convert amount equal to local currency
        $price = convertAmountEqualToLocalCurrency($price);
        $defaultCurrencyRate = getRate() ?: 1;
        $rate = setRate();

        if ($price > 0) {
            $price = ($price / $defaultCurrencyRate) * $rate;
        }

        if ($numberFormat) {
            // truncate price
            if ($truncate) {
                if (getSetting('truncate_price') == 1 || $forceTruncate == true) {
                    $price = truncatePrice($price);
                }
            } else {
                // decimals
                if (getSetting('no_of_decimals') > 0) {
                    $price = number_format($price, getSetting('no_of_decimals'));
                } else {
                    $price = number_format($price, getSetting('no_of_decimals', 2), '.', ',');
                }
            }
        }

        if ($addSymbol) {
            // currency symbol
            return addSymbol($price);
        }
        return $price;
    }
}


if (!function_exists("setRate")) {
    function setRate()
    {
        return getRate();
    }
}

if (!function_exists("getRate")) {
    function getRate()
    {
        $rate = 1;

        $currencyCookie = getCurrentCurrency();

        if (!empty($currencyCookie)) {
            $rate = $currencyCookie->rate;
        }

        if (!empty($rate)) {
            return floatval($rate);
        }

        return 1;
    }
}


if (!function_exists("systemLogo")) {
    function systemLogo()
    {
        $systemLogoId = getSetting("admin_media_manager_id", null);

        if (!empty($systemLogoId)) {
            $mediaManager = getMediaManagerById($systemLogoId);

            return urlVersion($mediaManager?->media_file ?? null);
        }

        return defaultImage();
    }
}

if (!function_exists("getMediaManagerById")) {
    function getMediaManagerById($mediaManagerId)
    {

        return (new \App\Services\Model\MediaManager\MediaManagerService())->findById($mediaManagerId);
    }
}


if (!function_exists("getCurrentCurrency")) {
    function getCurrentCurrency()
    {

        $currencyCookie = $_COOKIE['currency_cookie'] ?? null;

        if (empty($currencyCookie)) {
            return Currency::query()->where('is_default', 1)->first();
        }

        $currencyCookieJson = json_decode($currencyCookie);

        return $currencyCookieJson ?? Currency::query()->where('is_default', 1)->first();
    }
}



if (!function_exists("getSymbol")) {
    function getSymbol()
    {
        return Session::has('currency_symbol') ? Session::get('currency_symbol') : env('DEFAULT_CURRENCY_SYMBOL');
    }
}

if (!function_exists("truncatePrice")) {
    function truncatePrice($price)
    {
        if ($price < 1000000) {
            // less than a million
            $price = number_format($price, getSetting('no_of_decimals'));
        } else if ($price < 1000000000) {
            // less than a billion
            $price = number_format($price / 1000000, getSetting('no_of_decimals')) . 'M';
        } else {
            // at least a billion
            $price = number_format($price / 1000000000, getSetting('no_of_decimals')) . 'B';
        }

        return $price;
    }
}

if (!function_exists("addSymbol")) {
    function addSymbol($price)
    {
        // currency symbol
        if (request()->hasHeader('Currency-Code')) {
            $symbol             =   ApiCurrencyMiddleWare::currencyData()->symbol;
            $symbolAlignment    =    ApiCurrencyMiddleWare::currencyData()->alignment;
        } else {
            $symbol             = getSymbol();
            $symbolAlignment    = Session::has('currency_symbol_alignment') ? Session::get('currency_symbol_alignment') : env('DEFAULT_CURRENCY_SYMBOL_ALIGNMENT');
        }

        if ($symbolAlignment == 0) {
            return $symbol . $price;
        } else if ($symbolAlignment == 1) {
            return $price . $symbol;
        } else if ($symbolAlignment == 2) {
            # space
            return $symbol . ' ' . $price;
        } else {
            # space
            return $price . ' ' .  $symbol;
        }
    }
}


if (!function_exists("convertAmountEqualToLocalCurrency")) {
    function convertAmountEqualToLocalCurrency($price)
    {

        if (request()->hasHeader('Currency-Code')) {
            $price = floatval($price) / (floatval(env('DEFAULT_CURRENCY_RATE')) || 1);
            $price = floatval($price) * floatval(ApiCurrencyMiddleWare::currencyData()->rate);
        } else if (Session::has('currency_code') && Session::has('local_currency_rate')) {
            $price = floatval($price) / (floatval(env('DEFAULT_CURRENCY_RATE')) || 1);
            $price = floatval($price) * floatval(Session::get('local_currency_rate'));
        }

        return $price;
    }
}



if (!function_exists('carbonParse')) {
    function carbonParse($dateTime = null)
    {
        $dateTime = empty($dateTime) ? now() : $dateTime;
        return Carbon::parse($dateTime);
    }
}


if (!function_exists("clientIP")) {
    function clientIP()
    {

        return request()->ip();
    }
}


if (!function_exists("appCache")) {
    function appCache()
    {

        return new AppCache();
    }
}


if (!function_exists("currentRoute")) {
    function currentRoute(): string
    {
        try {
            return  request()->route()?->getName() ?? "home";
        } catch (\Throwable $e) {
            info("Current Route Name error : " . $e->getMessage());
            return $e->getMessage();
        }
    }
}

if (!function_exists("currentUrl")) {
    function currentUrl()
    {

        return request()->fullUrl();
    }
}


if (!function_exists("manageDateTime")) {
    function manageDateTime($dateTime = null, $formatType = 1)
    {
        $dateTime = is_null($dateTime) ? now() : $dateTime;

        return carbonParse($dateTime)->format(getDateTimeFormat($formatType));
    }
}

if (!function_exists("getDateTimeFormat")) {
    function getDateTimeFormat($formatType = 1)
    {

        return [
            1 => "h:i:s,v d-m-Y",
            2 => "h:i A d-m-Y",
            3 => "H:i A d-M-Y",
            4 => "h:i A d-M-Y",
            5 => "d-M-Y",
            6 => "h:i A",
            7 => "d-m-Y H:i",
        ][$formatType] ?? "";
    }
}


# Slug Maker
if (!function_exists("slugMaker")) {
    function slugMaker($value, $isUnique = false, $separator = "-")
    {
        $slug =  Str::slug($value,$separator);

       if(!$isUnique) {
           $slug = $slug ."-".randomStringNumberGenerator(15,true,true);
       }
       return $slug;
    }
}


# Random String Number Generator

if (!function_exists('randomStringNumberGenerator')) {
    function randomStringNumberGenerator(
        $length = 6,
        $includeNumbers = true,
        $includeLetters = false,
        $includeSymbols = false
    ) {
        $chars = [
            'letters' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            'numbers' => '0123456789',
            'symbols' => '!@#$%^&*()-_+=<>?'
        ];

        $password = '';
        $charSets = [];

        if ($includeLetters) {
            $charSets[] = $chars['letters'];
        }

        if ($includeNumbers) {
            $charSets[] = $chars['numbers'];
        }

        if ($includeSymbols) {
            $charSets[] = $chars['symbols'];
        }

        $charSetsCount = count($charSets);

        if ($charSetsCount === 0) {
            return 'Invalid character set configuration';
        }

        for ($i = 0; $i < $length; $i++) {
            $charSet = $charSets[$i % $charSetsCount];
            $password .= $charSet[random_int(0, strlen($charSet) - 1)];
        }

        return $password;
    }
}



# Image Mimes
if (!function_exists('imageMimes')) {
    function imageMimes()
    {

        return "mimes:jpg,png,webp,bimp,svg";
    }
}



# Is Route exits used in sidebar nav
if (!function_exists('isRouteExists')) {
    function isRouteExists($route = null)
    {
        $route = is_null($route) ? currentRoute() : $route;

        // If it's Admin Allow the routes
        if (isAdmin() || isVendor()) {
            return true;
        }

        // return true; // Temporary till production.
        if(in_array($route, ['dashboard', 'admin.dashboard'])) return true;

        return array_key_exists($route, userPermissions());
    }
}


# Is Route exits
if (!function_exists('isCreatedByMe')) {
    function isCreatedByMe(object $modelData,$createdById)
    {
        return $modelData->created_by_id == $createdById;
    }
}


# Is Route exits
if (!function_exists('isAllowedInDemo')) {
    function isAllowedInDemo($route = null)
    {

        // return true; // Temporary till production.
        $route = is_null($route) ? currentRoute() : $route;

        $cacheKeyword = "perm_" . $route."user_id_".userID();
        if (cache()->has($cacheKeyword)) {
            return cache()->get($cacheKeyword);
        }

        //TODO::check if route is allowed in demo
        $allowedInDemoPermissions = userDemoPermissionSession();
        if (isset($allowedInDemoPermissions[$route]) && empty($allowedInDemoPermissions[$route]['is_allowed_in_demo'])) {
            return false;
        }

        return true;
    }
}


# Is Route exits
if (!function_exists('userRoutesSession')) {
    function userRoutesSession()
    {

        return session("user_routes")  ?? [];
    }
}

# Is Route exits
if (!function_exists('userDemoPermissionSession')) {
    function userDemoPermissionSession()
    {

        return session("demo_permissions")  ?? [];
    }
}


if (!function_exists('isFileExists')) {
    function isFileExists($file)
    {
        return file_exists(public_path($file));
    }
}

if (!function_exists('unlinkFile')) {
    function unlinkFile($pathWithFileName)
    {
        if (isFileExists($pathWithFileName)) {
            File::delete($pathWithFileName);
        }
    }
}

if (!function_exists('allowedImageExtensions')) {
    function allowedImageExtensions()
    {

        return [
            "jpeg",
            "jpg",
            "png",
            "bimp",
            "svg",
            "webp",
        ];
    }
}


if (!function_exists('allowedMediaExtensions')) {
    function allowedMediaExtensions()
    {

        return [
            "mp4",
            "mp3",
            "amr",
            "wev",
        ];
    }
}



/**
 * Discount Calculations
 *
 * @incomingParams $amount contain Exact amount like 350
 * @incomingParams $value contain Exact value of discount like 10
 * @incomingParams $discountType contain Exact value of discount type 1 or 2. Here 1 == Flat & 2= Percent
 *
 * */
if (!function_exists('discountCalculations')) {
    function discountCalculations(
        $amount,
        $value,
        $discountType = 1,
        $maxAllow = 0
    ) {
        $appStatic = \appStatic();

        $calculatedDiscountAmount  = 0;

        // When Discount is Flat
        if (!isPercentage($discountType)) {
            $calculatedDiscountAmount = $value;
        }

        // When Discount is Percentage
        if (isPercentage($discountType)) {
            $calculatedDiscountAmount = percentageCalculations($amount, $value);
        }

        return max($calculatedDiscountAmount, 0);
    }
}


/**
 * Is Percentage
 * */
if (!function_exists('isPercentage')) {
    function isPercentage($type)
    {

        return $type == \appStatic()::TYPE_PERCENTAGE;
    }
}


if (!function_exists('percentageCalculations')) {
    function percentageCalculations($amount, $value)
    {
        if ($value <= 0 || $amount <= 0) {
            return 0;
        }

        return ($amount * $value) / 100;
    }
}


if (!function_exists('dateRangeParse')) {
    function dateRangeParse($dateRange = null)
    {
        if (isStringContains($dateRange) && !empty($dateRange)) {
            $startAndEndDate = explode(" to ", $dateRange);

            $date_var = [carbonParse($startAndEndDate[0])->startOfDay()->format("Y-m-d H:i:s"), carbonParse($startAndEndDate[1])->endOfDay()->format("Y-m-d H:i:s")];
        } else {
            $date_var = [now()->subDays(7)->format("Y-m-d H:i:s"), now()->format("Y-m-d H:i:s")];
        }

        return $date_var;
    }
}

if (!function_exists('customExplode')) {
    function customExplode($data, $delimiter = " to ")
    {
        return explode($delimiter, $data);
    }
}

if (!function_exists('isStringContains')) {
    function isStringContains($stringText, $keyword = "to")
    {
        return Str::contains($stringText, $keyword);
    }
}

/**
 * Method Will Return false either array.
 * */
if (!function_exists("isOpenAiRaiseError")) {
    /**
     * @throws JsonException
     */
    function isOpenAiRaiseError($decodedResult)
    {
        if (isset($decodedResult["error"])) {

            wLog(
                "Received Open AI Error Response",
                ["error" => json_encode($decodedResult["error"], JSON_THROW_ON_ERROR)],
                \logService()::LOG_OPEN_AI
            );

            return $decodedResult["error"]["message"];
        }

        return false;
    }
}


if (!function_exists("convertJsonDecode")) {
    function convertJsonDecode($value = null)
    {
        if (empty($value)) {
            return [];
        }

        $jsonDecode = json_decode($value, true, 512, JSON_THROW_ON_ERROR);

        if (is_string($jsonDecode)) {
            $jsonDecode = json_decode($jsonDecode, true, 512, JSON_THROW_ON_ERROR);
        }

        return $jsonDecode;
    }
}


if (!function_exists("isCardPay")) {
    function isCardPay($payType = null)
    {
        if (empty($payType)) {
            return false;
        }

        return $payType == constantFlags()::GATEWAY_CARD;
    }
}

if (!function_exists("isCashPay")) {
    function isCashPay($payType = null)
    {
        if (empty($payType)) {
            return false;
        }

        return $payType == constantFlags()::GATEWAY_CASH;
    }
}

if (!function_exists("isCodPay")) {
    function isCodPay($payType = null)
    {
        if (empty($payType)) {
            return false;
        }

        return $payType == constantFlags()::GATEWAY_COD;
    }
}

if (!function_exists('typeInside')) {
    #get Api key
    function typeInside()
    {
        return "chat/pdf/image/vision";
    }
}


if (!function_exists('getSetting')) {
    # return system settings value
    function getSetting($key, $default = null)
    {
        try {
            $settings = Cache::remember('settings', 86400, function () {
                return \App\Models\SystemSetting::all();
            });

            $invoiceSettingArr = [
                "order_code_prefix",
                "invoice_logo",
                "invoice_font_size",
                "invoice_paper_width",
                "order_code_start",
                "invoice_thanksgiving"
            ];

            if (in_array($key, $invoiceSettingArr) && isVendorUserGroup()) {
                $setting = $settings->where('entity', $key)->where("user_id", getUserParentId())->first();
            }else{
                $setting = $settings->where('entity', $key)->first();
            }

            return is_null($setting) ? $default : $setting->value;
        }
        catch (\Throwable $th) {
            wLog("getSetting Exception : " . $th->getMessage(), ["error" => errorArray($th)], \logService()::LOG_SYSTEM_SETTING);

            return $default;
        }
    }
}

if (!function_exists('setLang')) {
    # return system settings value
    function setLang()
    {
        return request()->lang ?? "English";
    }
}

if (!function_exists('setNumberOfResult')) {
    # return system settings value
    function setNumberOfResult()
    {
        return request()->number_of_results ?? 1;
    }
}

if (!function_exists('setTopic')) {
    # return system settings value
    function setTopic()
    {
        return request()->topic ?? "ai";
    }
}

if (!function_exists('setKeywords')) {
    # return system settings value
    function setKeywords()
    {
        return request()->keywords ?? "AI";
    }
}

if (!function_exists('setMainKeywords')) {
    # return system settings value
    function setMainKeywords()
    {
        return request()->mainKeywords ?? "AI";
    }
}

if (!function_exists('setRelatedKeywords')) {
    # return system settings value
    function setRelatedKeywords()
    {
        return request()->contentKeywords ?? "AI";
    }
}


if (!function_exists('getMetaDescription')) {
    # return system settings value
    function getMetaDescription()
    {
        return request()->meta_description ?? \sessionLab()::SESSION_META_DESCRIPTION;
    }
}

if (!function_exists('setTitle')) {
    /**
     * @throws JsonException
     */
    function setTitle()
    {
        $title = request()->title ?? request()->prompt;

        $title = is_null($title) ? "AI" : $title;

        return is_array($title) ? json_encode($title, JSON_THROW_ON_ERROR) : $title;
    }
}


if (!function_exists('setOutlines')) {
    # return system settings value
    function setOutlines()
    {
        return request()->outline ?? "AI";
    }
}


if (!function_exists("getArticleGenMaxWord")) {
    function getArticleGenMaxWord()
    {

        return session()->get('article_generate_max_word') ?? 0;
    }
}

if (!function_exists("getContentFromResponse")) {
    function getContentFromResponse(array $decodedResult, $onlyChoices = false)
    {
        if ($onlyChoices) {
            $contents = [];
            foreach ($decodedResult["choices"] as $choice) {
                $contents[] = $choice["message"]["content"];
            }
            return $contents;
        }

        $message = $decodedResult["choices"][0]["message"];
        return $message && isset($message["content"]) ? $message["content"] : "";
    }
}

if (!function_exists("stringArrayToArray")) {
    function stringArrayToArray($stringArray)
    {
        return eval("return $stringArray;");
    }
}

/**
 * @incomingParams $decodedResult array of response
 * @incomingParams $platform integer 1=OpenAi, 2=Stable Diffusion, 3=Gemini
 * */
if (!function_exists("getUrlsFromResponse")) {
    function getUrlsFromResponse(array $decodedResult, $platform = 1)
    {
        if ($platform == 1) {

            return $decodedResult['data'] ?? [];
        }

        // TODO:: Stable Diffusion API will implement Later.
    }
}


if (!function_exists("getPromptCompletionToken")) {
    function getPromptCompletionToken($usages)
    {

        return [
            getPromptTokens($usages), getCompletionTokens($usages), getTotalTokens($usages)
        ];
    }
}


if (!function_exists("getPromptTokens")) {
    function getPromptTokens($usages)
    {
        return $usages['prompt_tokens'] ?? 0;
    }
}

if (!function_exists("getCompletionTokens")) {
    function getCompletionTokens($usages)
    {
        return $usages['completion_tokens'] ?? 0;
    }
}

if (!function_exists("getTotalTokens")) {
    function getTotalTokens($usages)
    {
        return $usages['total_tokens'] ?? 0;
    }
}

#Validation Exception
if (!function_exists("validationException")) {
    function validationException($jsonResponse)
    {
        throw new HttpResponseException($jsonResponse);
    }
}


# Text Replace
if (!function_exists("textReplace")) {
    function textReplace($value, $searchKey = ".", $replaceWith = " ")
    {

        return str_replace($searchKey, $replaceWith, $value);
    }
}

# Text Replace
if (!function_exists("isOutlineGenerating")) {
    function isOutlineGenerating(string $contentPurpose)
    {

        info("is Outlines : " . $contentPurpose);

        return $contentPurpose == "outlines";  //TODO::WILL UPDATE THIS LATER raw outlines replace with constant param
    }
}


if (!function_exists("isArticleGenerating")) {
    function isArticleGenerating(string $contentPurpose)
    {

        return $contentPurpose === "articles";  //TODO::WILL UPDATE THIS LATER raw articles replace with constant param
    }
}

if (!function_exists("isCodeGenerating")) {
    function isCodeGenerating(string $contentPurpose)
    {

        return $contentPurpose === "code";  //TODO::WILL UPDATE THIS LATER raw code replace with constant param
    }
}

if (!function_exists("isTemplateGenerating")) {
    function isTemplateGenerating(string $contentPurpose)
    {

        return $contentPurpose === "templateContent";  //TODO::WILL UPDATE THIS LATER raw code replace with constant param
    }
}


// check storage manager active
if (!function_exists('activeStorage')) {
    function activeStorage($type = null)
    {
        return false;
        //TODO::will update later

        $storage_type = $type ?? getSetting('active_storage');
        if (!$storage_type) {
            $storage_type = 'local';
        }
        $data = StorageManager::when($storage_type, function ($q) use ($storage_type) {
            $q->where('type', $storage_type);
        })->where('is_active', 1)->first();
        if ($data) {
            return true;
        }
        return false;
    }
}

// check storage manager active
if (!function_exists('createDynamicDir')) {
    function createDynamicDir($dynamicPath)
    {
        if (!file_exists($dynamicPath)) {
            if (!mkdir($dynamicPath, 0777, TRUE) && !is_dir($dynamicPath)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $dynamicPath));
            }

            return $dynamicPath;
        }
    }
}


# Default Disk
if (!function_exists('setDefaultDisk')) {
    function setDefaultDisk()
    {
        return "public";
    }
}


# Max Paginate No
if (!function_exists("maxPaginateNo")) {
    function maxPaginateNo($max = null)
    {
        // Max Paginate numbers override the default
        return request('perPage', appStatic()::PER_PAGE_DEFAULT);
    }
}


if (!function_exists("urlVersion")) {
    function urlVersion($file = null, $bindStorageKeyword = false)
    {

        if (empty($file)) {
            return defaultImage();
        }

        $version = time();
        $srcFile = $bindStorageKeyword ? "storage/" . $file : $file;

        if (!isFileExists($srcFile)) {
            return defaultImage();
        }

        return asset($srcFile . "?v=" . $version);
    }
}


if (!function_exists("defaultImage")) {
    function defaultImage()
    {
        return url(asset("assets/img/noimage.png?v=" . time()));
    }
}

if (!function_exists("defaultAvatar")) {
    function defaultAvatar()
    {
        return asset('assets/img/avatar/4.jpg');
    }
}

if (!function_exists('avatarImage')) {

    function avatarImage($avatarID = null): string
    {
        if(empty($avatarID)) {
            return defaultAvatar();
        }

        $media_file = MediaManager::query()->find($avatarID);

        if(empty($media_file)) {
            return defaultAvatar();
        }

        return  urlVersion($media_file->media_file);
    }
}

if (!function_exists('mediaImage')) {

    function mediaImage($mediaManagerId = null): string | null
    {
        if(empty($mediaManagerId)) {
            return null;
        }

        $mediaManager = MediaManager::query()->find($mediaManagerId);

        if(empty($mediaManager)) {
            return null;
        }

        return  urlVersion($mediaManager->media_file);
    }
}



# get file height, width
if (!function_exists("imageDimension")) {
    function imageDimension($imageUrl, $withNHeight = false, $width = false, $height = false)
    {
        if (!$imageUrl) return null;
        try {
            [$w, $h] = getimagesize($imageUrl);
            if ($width) {
                return  $w;
            } elseif ($height) {
                return $h;
            } else if ($withNHeight) {
                return  $w . 'x' . $h;
            }
        } catch (Throwable $th) {
            Log::info('image dimension :', errorArray($th));
            return null;
        }
    }
}


if (!function_exists('isSvg')) {
    function isSvg(string $extension)
    {
        return $extension === "svg";
    }
}


# FIle Name Prefix
if (!function_exists('fileRenamePrefix')) {
    function fileRenamePrefix()
    {
        return (new FileService())::FILE_RENAME_PREFIX;
    }
}

if (!function_exists('fileRename')) {
    /**
     * @throws Exception
     */
    function fileRename(): string
    {
        return now()->format("Ymd") . fileRenamePrefix() . time() . random_int(1111, 9999);
    }
}



/**
 * Cache ENGINE Start
 * */

if (!function_exists('getCache')) {
    function getCache($keyword)
    {

        return Cache::get($keyword) ?: null;
    }
}

if (!function_exists('isCacheExists')) {
    function isCacheExists($keyword)
    {
        return Cache::has($keyword);
    }
}

if (!function_exists('setCacheData')) {
    function setCacheData($keyword, $data, $time = (60 * 24 * 30))
    {

        return Cache::remember($keyword, $time, function () use ($data) {
            return $data;
        });
    }
}

if (!function_exists('setCacheData')) {
    function setCacheData($keyword, $data)
    {

        return cache($keyword, $data);
    }
}

/**
 * Cache ENGINE END
 * */



if (!function_exists("hideForVendor")) {
    function hideForVendor(array $customGroupPermissions)
    {

        if (isVendor()) {
            return false;
        }

        foreach ($customGroupPermissions as $key1 => $value) {
            if ($key1 == "hideForVendor") {
                return true;
            }
        }

        return false;
    }
}


# Set Active Status
if (!function_exists("setActiveStatus")) {
    function setActiveStatus()
    {

        return request()->has("is_active") ? request()->is_active : 0;
    }
}



# Set Active Status
if (!function_exists("setHasVariation")) {
    function setHasVariation()
    {
        return request()->has_variation === 'on' ? 1 : 0;
    }
}


if (!function_exists("isMenuGroupShow")) {
    function isMenuGroupShow(array $routeGroups)
    {
        $isShow = false;
        foreach ($routeGroups as $key => $route) {
            $isExists = isRouteExists($route);
            if ($isExists) {
                $isShow = true;
                break;
            }
        }

        return $isShow;
    }
}


# User Permissions
if (!function_exists("userPermissions")) {
    function userPermissions()
    {
        return session("user_powers") ;
    }
}



# Logged in session Destroy
if (!function_exists('loggedInSessionDestroy')) {
    function loggedInSessionDestroy()
    {

        session()->forget("user_powers");
        session()->forget("demo_permissions");
        session()->forget("menu_permission_version");
        session()->forget("user_routes");
    }
}



if (!function_exists('throwMSG')) {
    function throwMSG($msg, $code = 500)
    {
        throw new \RuntimeException($msg, $code);
    }
}


/**
 * @throws Exception
 */
function time_elapsed_string($datetime, $full = false): string
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}


if (!function_exists('isSenderIsMe')) {
    function isSenderIsMe(int $user_id)
    {

        return $user_id === userID();
    }
}

if (!function_exists('dateFormat')) {
    function dateFormat($date_time) {
        if(!$date_time) return null;
        $date_format = getSetting('default_date_format') ?? "Y-m-d H:i";
        return \Carbon\Carbon::parse($date_time)->format($date_format);
    }
}

if (!function_exists('isSideBarCollapsed')) {
    function isSideBarCollapsed() {
        return request()->cookie('isSideBarCollapsed');
    }
}

if (!function_exists('fileExtension')) {
    function fileExtension($format = 'mp3')
    {
        return match ($format) {
            "mp3" => 'mp3',
            "ogg" => 'ogg',
            "webm" => 'webm',
            "wav" => 'wav',
            default    => throw new \Exception("file extension not found"),
        };
    }
}

/*
 * return plain text
 */
if (!function_exists('plainText')) {
    function plainText($speeches)
    {
        $text = '';
        if (is_array($speeches)) {
            foreach ($speeches as $key => $speech) {

                $value = $speech;
                $text .= preg_replace('/<[\s\S]+?>/', '', $value) . '. ';
            }
        } elseif (!is_array($speeches)) {
            $text .= preg_replace('/<[\s\S]+?>/', '', $speeches) . '. ';
        }
        return $text;
    }
}

if (!function_exists("convertJsonDecode")) {
    function convertJsonDecode($value = null)
    {
        if (empty($value)) {
            return [];
        }

        $jsonDecode = json_decode($value, true);

        if (gettype($jsonDecode) == "string") {
            $jsonDecode = json_decode($jsonDecode, true);
        }

        return $jsonDecode;
    }
}
if (!function_exists('cacheClear')) {
    # clear server cache
    function cacheClear()
    {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('optimize:clear');
    }
}

if (!function_exists('fileDelete')) {
    # file delete
    function fileDelete($file)
    {
        if (File::exists('public/' . $file)) {
            File::delete('public/' . $file);
        }
    }
}

if (!function_exists('getFileType')) {
    #  Get file Type
    function getFileType($type)
    {
        $fileTypeArray = [
            // audio
            "mp3"       =>  "audio",
            "wma"       =>  "audio",
            "aac"       =>  "audio",
            "wav"       =>  "audio",

            // video
            "mp4"       =>  "video",
            "mpg"       =>  "video",
            "mpeg"      =>  "video",
            "webm"      =>  "video",
            "ogg"       =>  "video",
            "avi"       =>  "video",
            "mov"       =>  "video",
            "flv"       =>  "video",
            "swf"       =>  "video",
            "mkv"       =>  "video",
            "wmv"       =>  "video",

            // image
            "png"       =>  "image",
            "svg"       =>  "image",
            "gif"       =>  "image",
            "jpg"       =>  "image",
            "jpeg"      =>  "image",
            "webp"      =>  "image",

            // document
            "doc"       =>  "document",
            "txt"       =>  "document",
            "docx"      =>  "document",
            "pdf"       =>  "document",
            "csv"       =>  "document",
            "xml"       =>  "document",
            "ods"       =>  "document",
            "xlr"       =>  "document",
            "xls"       =>  "document",
            "xlsx"      =>  "document",

            // archive
            "zip"       =>  "archive",
            "rar"       =>  "archive",
            "7z"        =>  "archive"
        ];
        return isset($fileTypeArray[$type]) ? $fileTypeArray[$type] : null;
    }

    if (!function_exists('mediaFile')) {
        # file delete
        function mediaFile(int $id)
        {
            $mediaManager = MediaManager::where('id', $id)->first();
            return urlVersion($mediaManager->media_file);
        }
    }

    if(!function_exists('planEndDate')){
        function planEndDate($plan_id) {
            $start_date = date('Y-m-d');
            $end_date = null;
            $plan = SubscriptionPlan::where('id', $plan_id)->where('is_active', 1)->first(['package_type', 'duration']);
            if ($plan->package_type == 'monthly') {
                $end_date = date('Y-m-d', strtotime($start_date . ' + 1 months'));
            } elseif ($plan->package_type == 'yearly') {
                $end_date = date('Y-m-d', strtotime($start_date . ' + 1 years'));
            } elseif ($plan->duration) {
                $end_date = date('Y-m-d', strtotime($start_date . $plan->duration . ' days'));
            }
            return $end_date;
        }
    }

    if(!function_exists("isExpired")){
        function isExpired($expirationValue){
            $now = date('Y-m-d');

            return $now > $expirationValue;

        }
    }

    if(!function_exists('activePlanValidate')){
        function activePlanValidate($plan_id = null): bool
        {

            $plan_id = $plan_id ?? user()->subscription_plan_id;


            // Return false when it's empty
            if(empty($plan_id)){
                return false;
            }

            // Get the Subscription User by user id and subscription plan id

            $userPlan = (new \App\Services\Action\SubscriptionActionService())->getSubscriptionUserByUserIdAndSubscriptionPlanId(
                userID(), user()->subscription_plan_id
            );

            // Return False when user has no plan
            if(empty($userPlan)){
                return false;
            }

            $expire_by_admin_date = date('Y-m-d', strtotime($userPlan->expire_by_admin_date));


            // Is Plan date Expired?
            if(!empty($userPlan->expire_by_admin_date) && isExpired($expire_by_admin_date)) {
                return false;
            }

            // Is plan date and time Expired?
            if(isExpired(date('Y-m-d', strtotime($userPlan->expire_at)))){
                return false;
            }

            // Return true as valid active Plan
            return true;
        }
    }

    if(!function_exists('allowPlanFeature')){
        function allowPlanFeature($feature) {

           $validate  = activePlanValidate();

           if($validate){
                $plan = (new \App\Services\Action\SubscriptionActionService())->getSubscriptionUserUsageByUserIdAndSubscriptionPlanId(userID(), user()->subscription_plan_id);

                return $plan->{$feature} ?? 0;
           }

           return isAdminUserGroup() ? 1 : 0;
        }
    }

    if(!function_exists('checkValidCustomerFeature')){
        function checkValidCustomerFeature($feature) {

            $isAllowed = allowPlanFeature($feature);

            if(!$isAllowed){
                throw new \RuntimeException(localize("You don't have permission to use this feature"));
            }

            return true;
        }
    }

    if(!function_exists('userActivePlan')){
        function userActivePlan() {

            $userUsage = getUserObject()->usage;

            if(!$userUsage){
                throw new \RuntimeException(localize("You don't have any active plan"));
            }

            return [
                "subscription_user_id"      => $userUsage->subscription_user_id,
                "subscription_plan_id"      => $userUsage->subscription_plan_id,
                "has_monthly_limit"         => $userUsage->has_monthly_limit,
                "start_at"                  => $userUsage->start_at,
                "expire_at"                 => $userUsage->expire_at,
                "allow_unlimited_branches"  => $userUsage->allow_unlimited_branches,
                "branch_balance"            => $userUsage->branch_balance,
                "branch_balance_used"       => $userUsage->branch_balance_used,
                "branch_balance_remaining"  => $userUsage->branch_balance_remaining,
                "allow_kitchen_panel"       => $userUsage->allow_kitchen_panel,
                "allow_reservations"        => $userUsage->allow_reservations,
                "allow_support"             => $userUsage->allow_support,
                "allow_team"                => $userUsage->allow_team,
                "is_active"                 => $userUsage->is_active,

            ];
        }
    }


    if(!function_exists('conditionAvoidRouteForValidation')){
        function conditionAvoidRouteForValidation(): array {

            return [
                "admin.chats.aiVisionChat",
                "admin.chats.aiPDFChat",
                "admin.chats.aiImageChat",
            ];
        }
    }
}
if (!function_exists('paymentGateway')) {
    function paymentGateway($type = null)
    {
        $paymentGateway = Cache::remember('paymentGateway', 86400, function () {
            return PaymentGateway::all();
        });
        if ($type) {
            $paymentGateway = $paymentGateway->where('gateway', $type)->first();
        }
        return $paymentGateway;
    }
}
if (!function_exists('paymentGatewayValue')) {
    function paymentGatewayValue($gateway, $key)
    {
        $paymentGateway = paymentGateway($gateway);
        $value = '';
        if ($paymentGateway) {
            $gateway_id = $paymentGateway->id;
            $value = PaymentGatewayDetail::where('payment_gateway_id', $gateway_id)->where('key', $key)->value('value');
        }
        return $value;
    }
}
# overwrite env file

if (!function_exists('writeToEnvFile')) {
    function writeToEnvFile($key, $value) {
        $envFilePath = base_path() . '/.env';
        $env = file_get_contents($envFilePath);
        $env = explode("\n", $env);
        $keyExists = false;

        foreach ($env as $env_key => $env_value) {
            $entry = explode("=", $env_value, 2);
            if ($entry[0] === $key) {
                $env[$env_key] = $key . "=" . (is_string($value) ? '"' . $value . '"' : $value);
                $keyExists = true;
                break;
            }
        }

        if (!$keyExists) {
            $env[] = $key . "=" . (is_string($value) ? '"' . $value . '"' : $value);
        }

        $env = implode("\n", $env);
        file_put_contents($envFilePath, $env);
        return true;
    }
}

// [TODO::need to optimize]
if (!function_exists('systemSetting')) {
    function systemSetting($key)
    {
        $settings = Cache::remember('settings', 86400, function () {
            return SystemSetting::all();
        });

        $setting = $settings->where('entity', $key)->first();
        return $setting;
    }
}

if (!function_exists('systemSettingsLocalization')) {
    function systemSettingsLocalization($entity, $lang_key = null, $defaultText = "Explore")
    {
        if ($lang_key == null) {
            $lang_key = App::getLocale();
        }
        $settings = systemSetting($entity);
        $default_lang = getSetting($entity);
        $lang = $default_lang;
        if ($settings) {
            $data = $settings->collectLocalization($entity, $lang_key);

            $lang = $data ?? $default_lang;
        }
        return $lang ?? $defaultText;
    }
}

if (!function_exists('renderStarRating')) {
    # render ratings
    function renderStarRating($rating, $maxRating = 5)
    {
        $fullStar = "<i data-feather='star' width='16' height='16' class='text-primary'></i>";
        $rating = $rating <= $maxRating ? $rating : $maxRating;
        $fullStarCount = (int)$rating;
        $html = str_repeat($fullStar, $fullStarCount);
        echo $html;
    }
}

if (!function_exists('renderStarRatingFront')) {
    # render ratings frontend
    function renderStarRatingFront($rating, $maxRating = 5)
    {
        $fullStar = '<li><i class="las la-star text-warning"></i></li>';
        $rating = $rating <= $maxRating ? $rating : $maxRating;
        $fullStarCount = (int)$rating;
        $html = str_repeat($fullStar, $fullStarCount);
        echo $html;
    }
}

if (!function_exists('formatWords')) {
    # format Words
    function formatWords($words)
    {
        if ($words < 10000) {
            // less than 10 thousands
            $words = $words;
        } else if ($words < 1000000) {
            // less than a million
            $words = $words / 1000  . 'k';
        } else if ($words < 1000000000) {
            // less than a billion
            $words = $words / 1000000 . 'M';
        } else {
            // at least a billion
            $words = $words / 1000000000 . 'B';
        }

        return $words;
    }
}


if(!function_exists('languages')){
    function languages() {
        return Language::where('is_active', 1)->get();
    }
}
if(!function_exists('currencies')){
    function currencies() {
        return Currency::where('is_active', 1)->get();
    }
}
if(!function_exists('currentCurrency')){
    function currentCurrency() {
        if (Session::has('currency_code')) {
            $currency_code = Session::get('currency_code', Config::get('app.currency_code'));
        } else {
            $currency_code = env('DEFAULT_CURRENCY');
        }
        $currentCurrency = \App\Models\Currency::where('code', $currency_code)->first();

        if (is_null($currentCurrency)) {
            $currentCurrency = \App\Models\Currency::where('code', 'usd')->first();
        }
        return $currentCurrency;
    }
}

if(!function_exists('currentLanguage')){
    function currentLanguage() {
        if (Session::has('locale')) {
            $locale = Session::get('locale', Config::get('app.locale'));
        } else {
            $locale = env('DEFAULT_LANGUAGE');
        }
        $currentLanguage = \App\Models\Language::where('code', $locale)->first();

        if (is_null($currentLanguage)) {
            $currentLanguage = \App\Models\Language::where('code', 'en')->first();
        }
        return $currentLanguage;
    }
}


if (!function_exists("setSession")) {
    function setSession($keyword, $value)
    {

        session([$keyword => $value]);
        session()->save();

        return session($keyword);
    }
}
if (!function_exists('packageSellPrice')) {
    function packageSellPrice($package_id)
    {
        $package = SubscriptionPlan::where('id', $package_id)->first();
        $price = 0;
        if ($package) {
            if ($package->discount_status == 1 && $package->discount) {
                $price = $package->discount_price;
            } else {
                $price = $package->price;
            }
        }
        return $price;
    }
}
if (!function_exists('clearPaymentSession')) {
    # clear session cache
    function clearPaymentSession()
    {
        session()->forget('package_id');
        session()->forget('amount');
        session()->forget('payment_method');
        session()->forget('admin_customer');
        session()->forget('active_now');
    }
}

# adSense
if (!function_exists('adSense')) {
    function adSense($type)
    {
        if (!getSetting('enable_google_adsense')) {
            return null;
        }
        // return  Cache::rememberForever('adSense', function () use ($type) {
        return    AdSense::where('slug', $type)->when(getSetting('dashboard_adSense'), function ($q) {
            $q->where('is_dashboard', 1);
        })->where('is_active', 1)->first();
        // });
    }
}

if (!function_exists('adSense_header_top')) {
    function adSense_header_top()
    {
        if (adSense('header-top')) {
            return  adSense('header-top')->code;
        }
    }
}

if (!function_exists('adSense_top_feature_section')) {
    function adSense_top_feature_section()
    {
        if (adSense('bottom-trusted-by')) {
            return '<center>
                        <div class="google-ads-728 mb-6">' . adSense('top-feature-section')->code . '</div>
                    </center>';
        }
    }
}

if (!function_exists('adSense_top_best_feature')) {
    function adSense_top_best_feature()
    {
        if (adSense('top-best-feature')) {
            return '<center>
                            <div class="google-ads-728 mb-6">' . adSense('top-best-feature')->code . '</div>
                        </center>';
        }
    }
}

if (!function_exists('adSense_top_template_section')) {
    function adSense_top_template_section()
    {
        if (adSense('top-template-section')) {
            return '<center>
                        <div class="google-ads-728 mb-6">' . adSense('top-template-section')->code . '</div>
                    </center>';
        }
    }
}

if (!function_exists('adSense_top_subscription_package')) {
    function adSense_top_subscription_package()
    {
        if (adSense('top-subscription-package')) {
            return '<center>
                        <div class="google-ads-728 mb-6">' . adSense('top-subscription-package')->code . '</div>
                    </center>';
        }
    }
}

if (!function_exists('adSense_top_trail_banner_section')) {
    function adSense_top_trail_banner_section()
    {
        if (adSense('	')) {
            return '<center>
                        <div class="google-ads-728 mb-6">' . adSense('top-trail-banner-section')->code . '</div>
                    </center>';
        }
    }
}

if (!function_exists('adSense_top_footer_section')) {
    function adSense_top_footer_section()
    {
        if (adSense('top-footer-section')) {
            return '<center>
                        <div class="google-ads-728 mb-6">' . adSense('top-footer-section')->code . '</div>
                    </center>';
        }
    }
}
// adSense for backend dashboard

# adSense dashboard header bottom section
if (!function_exists('adSense_dashboard_header_bottom_section')) {
    function adSense_dashboard_header_bottom_section()
    {
        if (!dashboardAdSense()) return null;
        if (adSense('header-bottom')) {
            return '<center>
                        <div class="google-ads-728 mb-6">' . adSense('header-bottom')->code . '</div>
                    </center>';
        }
    }
}

# adSense dashboard footer top section
if (!function_exists('adSense_dashboard_footer_top_section')) {
    function adSense_dashboard_footer_top_section()
    {
        if (!dashboardAdSense()) return null;
        if (adSense('footer-top')) {
            return '<center>
                        <div class="google-ads-728 mb-6">' . adSense('footer-top')->code . '</div>
                    </center>';
        }
    }
}

# adSense dashboard profile bottom section
if (!function_exists('adSense_dashboard_profile_bottom_section')) {
    function adSense_dashboard_profile_bottom_section()
    {
        if (!dashboardAdSense()) return null;
        if (adSense('dashboard-profile-bottom')) {
            return '<center>
                        <div class="google-ads-728 mb-6">' . adSense('dashboard-profile-bottom')->code . '</div>
                    </center>';
        }
    }
}

# adSense sidebar customer profile top section
if (!function_exists('adSense_sidebar_customer_profile_top_section')) {
    function adSense_sidebar_customer_profile_top_section()
    {
        if (!dashboardAdSense()) return null;
        if (adSense('sidebar-customer-profile-top')) {
            return '<center>
                        <div class="google-ads-728 mb-6">' . adSense('sidebar-customer-profile-top')->code . '</div>
                    </center>';
        }
    }
}
# adSense sidebar customer profile top section
if (!function_exists('adSense_recent_project_top_section')) {
    function adSense_recent_project_top_section()
    {
        if (!dashboardAdSense()) return null;
        if (adSense('recent-project-top')) {
            return '<center>
                        <div class="google-ads-728 mb-6">' . adSense('recent-project-top')->code . '</div>
                    </center>';
        }
    }
}
# adSense sidebar customer profile top section
if (!function_exists('dashboardAdSense')) {
    function dashboardAdSense()
    {
        if (!getSetting('dashboard_adSense')) return null;

        if (isCustomer()) {
            $package = user()->subscription_plan_id;
            if (!$package) return true;
            return user()->plan->package_type == 'starter' ? true : false;
        }
        return null;
    }
}
//  end dashboard adSense

if (!function_exists('recaptchaValidation')) {
    // recaptchaValidation
    function recaptchaValidation($request)
    {
        $score = 1;
        if (getSetting('enable_recaptcha') == 1) {
            $score = RecaptchaV3::verify($request->get('g-recaptcha-response'), 'recaptcha_token');
        }
        return $score;
    }
}

if (!function_exists('validatePhone')) {
    # validatePhone
    function validatePhone($phone)
    {
        $phone = str_replace(' ', '', $phone);
        $phone = str_replace('-', '', $phone);
        return $phone;
    }
}

if (!function_exists('validateRecordOwnerCheck')) {
    # validatePhone
    function validateRecordOwnerCheck($model)
    {
        if(!$model) return abort(401);
        if($model->created_by_id !== getUserParentId()) return abort(401);

        return true;
    }
}

if (!function_exists('vendorValidation')) {
    # validatePhone
    function vendorValidation($model)
    {
        if($model->vendor_id !== getUserParentId()) {
            throw new \RuntimeException(localize("You don't have permission to process this request"));
        }
    }
}

if (!function_exists('convertResponseOpenAiChunk')) {
    # validatePhone
    function convertResponseOpenAiChunk($text)
    {

        $data = [
          "id"                 => "chatcmpl-123",
          "object"             => "chat.completion.chunk",
          "created"            => 1694268190,
          "model"              => "gpt-4o-mini",
          "system_fingerprint" => "fp_44709d6fcb",
          "choices"                => [
                [
                   "index"         => 0,
                   "delta"         => [
                      "role"       => "assistant",
                      "content"    => $text
                   ],
                   "logprobs"      => null,
                   "finish_reason" => null
                ]
            ]
       ];
       return $data;


    }
}
# module check
if (!function_exists('isModuleActive')) {
    function isModuleActive($name)
    {
        $status = false;

        $module = Module::find($name);
        if ($module) {
            $status = $module->isEnabled();
            if ($status) {
                $modulePath = $module->getPath() . '/Providers/RouteServiceProvider.php';
                if (file_exists($modulePath)) {
                    $module = ThemeTagModule::where('name', $name)->first();
                    if ($module) {
                        if ($module->is_default == 1) {
                            $status = true;
                        }
                        if ($module->is_paid == 1) {
                            $status = $module->purchase_code && $module->domain  ? true : false;
                        }
                    }
                }
            }
        }
        return $status;
    }
}
# language
if(!function_exists('selectedLanguage'))
{
    function selectedLanguage()
    {
      return request()->lang_key ?? env('DEFAULT_LANGUAGE');
    }
}
# language
if(!function_exists('cacheRemove'))
{
    function cacheRemove()
    {
        Cache::forget('settings');
    }
}
if (!function_exists('sendMail')) {
    function sendMail($receiverEmail, $receiverName, $type, $data = [])
    {
        $senderEmail  = env('MAIL_FROM_ADDRESS');
        $senderName   = env('MAIL_FROM_NAME');
        $email_driver = env('MAIL_MAILER');
        $template     = EmailTemplate::where('type', $type)->where('is_active', 1)->first();
        if (!$template) return false;
        $subject = $template->subject;
        $body    = EmailTemplate::emailTemplateBody($template->code, $data);

        try {

            Mail::send('emails.emailBody', compact('body'), function ($message) use ($receiverEmail, $receiverName, $senderName, $senderEmail, $subject) {
                $message->to($receiverEmail, $receiverName)->subject($subject);
                $message->from($senderEmail, $senderName);
            });
        } catch (\Throwable $th) {

            Log::info('send mail issues :'.$th->getMessage());
        }
    }
}
if (!function_exists('activeEmailTemplate')) {
    function activeEmailTemplate($type)
    {
        $template     = EmailTemplate::where('type', $type)->where('is_active', 1)->first();
        if (!$template) return false;
        return true;
    }
}
if(!function_exists('percentageUsed'))
{
    function percentageUsed($total_used, $total) {
        if($total_used == 0 || is_null($total_used)) return 100;
        $result = ($total_used/$total) * 100;
        return (int) $result;
    }
}


if(!function_exists('percentageResult'))
{
    function percentageResult($obtainMark, $totalMark) {

        return round(($obtainMark / $totalMark) * 100, 2);
    }
}

// Subscription Status
if (!function_exists('subscriptionStatus')) {
    function subscriptionStatus(): array
    {
        return [
            appStatic()::PLAN_STATUS_ACTIVE     => 'Active',
            appStatic()::PLAN_STATUS_EXPIRE     => 'Expired',
            appStatic()::PLAN_STATUS_SUBSCRIBED => 'Subscribed',
            appStatic()::PLAN_STATUS_PENDING    => 'Pending',
            appStatic()::PLAN_STATUS_REJECTED   => 'Rejected',
        ];
    }
}
// Subscription Status
if (!function_exists('getSubscriptionStatusName')) {
    function getSubscriptionStatusName($status_id)
    {
        $list = subscriptionStatus();
        if (array_key_exists($status_id, $list)) {
            return $list[$status_id];
        }
        return 'Invalid Status';
    }
}
if (!function_exists('getStatusColor')) {
    function getStatusColor($status_id, $type = 'payment')
    {
        $status_id = (int)$status_id;
        if($type == 'payment') {

            return match ($status_id) {
                appStatic()::PAYMENT_STATUS_PENDING  => "bg-soft-warning",
                appStatic()::PAYMENT_STATUS_PAID     => "bg-soft-success",
                appStatic()::PAYMENT_STATUS_RESUBMIT => "bg-soft-info",
                appStatic()::PAYMENT_STATUS_REJECTED => "bg-soft-danger",
                default => "bg-soft-success",
            };
        }
        if($type == 'subscription') {
            return match ($status_id) {
                appStatic()::PLAN_STATUS_ACTIVE     => "bg-soft-success",
                appStatic()::PLAN_STATUS_EXPIRE     => "bg-soft-danger",
                appStatic()::PLAN_STATUS_SUBSCRIBED => "bg-soft-info",
                appStatic()::PLAN_STATUS_PENDING    => "bg-soft-warning",
                appStatic()::PLAN_STATUS_REJECTED   => "bg-soft-warning",
                default => "bg-soft-success",
            };
        }
    }
}
// Subscription Status
if (!function_exists('subscriptionPaymentStatus')) {
    function subscriptionPaymentStatus(): array
    {
        return [
            appStatic()::PAYMENT_STATUS_PAID     => 'PAID',
            appStatic()::PAYMENT_STATUS_PENDING  => 'PENDING',
            appStatic()::PAYMENT_STATUS_REJECTED => 'REJECTED',
            appStatic()::PAYMENT_STATUS_RESUBMIT => 'RESUBMIT',

        ];
    }
}
// Subscription Status
if (!function_exists('getSubscriptionPaymentStatusName')) {
    function getSubscriptionPaymentStatusName($status_id)
    {
        $list = subscriptionPaymentStatus();
        if (array_key_exists($status_id, $list)) {
            return $list[$status_id];
        }
        return 'Invalid Status';
    }
}

if(!function_exists('vendorPlanRoute')) {

    function vendorPlanRoute()
    {
        return (new VendorPlanRouteService())->vendorPlanRoutes();
    }
}


if(!function_exists('customerPlanRoute')) {
    function customerPlanRoute()
    {

        $customerRoutes = (new \App\Services\Business\CustomerPlanRouteService())->customerPlanRoutes();


        return $customerRoutes;
    }
}


if(!function_exists('vendorAccessRoute')){
    function vendorAccessRoute($route = null) {
        $route = is_null($route) ? currentRoute() : $route;

        return array_key_exists($route, vendorPlanRoute());
    }
}

if(!function_exists('customerAccessRoute')){
    function customerAccessRoute($route = null) {
        $route = is_null($route) ? currentRoute() : $route;

        return array_key_exists($route, customerPlanRoute()) && allowPlanFeature(customerPlanRoute()[$route]) === 1;
    }
}

if (!function_exists('openAiErrorMessage')) {
    function openAiErrorMessage($openAiKey = null)
    {
        $openAiKey = $openAiKey ?? getSetting('OPENAI_SECRET_KEY');
        $message = null;

        if (!$openAiKey) {
            return  $message = localize('Open AI key is not found. Please setup Open AI key from AI setting');
        }

        $open_ai = initOpenAi($openAiKey);
        $models  = $open_ai->listModels();
        $models  = json_decode($models);

        if ($models) {
            if (property_exists($models, 'error')) {
                $message = str_replace("***********************************************************************************************************", "", $models->error->message);
            }
        }

        return $message;
    }
}
if (!function_exists('getPostStatusLabelClass')) {
    function getPostStatusLabelClass($postStatus = null)
    {
        if ($postStatus === 'publish') {
            $postBgClass = 'bg-soft-success';
        } elseif ($postStatus === 'future') {
            $postBgClass = 'bg-soft-warning';
        } elseif ($postStatus === 'draft') {
            $postBgClass = 'bg-soft-info';
        } elseif ($postStatus === 'pending') {
            $postBgClass = 'bg-soft-warning';
        } elseif ($postStatus === 'private') {
            $postBgClass = 'bg-soft-danger';
        } else {
            $postBgClass = 'bg-soft-info';
        }

        return $postBgClass;
    }
}

if(!function_exists('hasBalance')) {
    function hasBalance($type = null): bool
    {
        // When logged-in user is not customer
        if(isAdmin()){
            return true;
        }

        $totalRemainingBalance = match ($type) {
            appStatic()::PURPOSE_TEXT_TO_VOICE  => userActivePlan()["word_balance_remaining_t2s"] ?? 0,
            appStatic()::PURPOSE_IMAGE          => userActivePlan()["image_balance_remaining"] ?? 0,
            appStatic()::PURPOSE_VOICE_TO_TEXT  => userActivePlan()["speech_balance_remaining"] ?? 0,
            appStatic()::PURPOSE_VIDEO          => userActivePlan()["video_balance_remaining"] ?? 0,
            default => userActivePlan()["word_balance_remaining"] ?? 0,
        };

        return $totalRemainingBalance > 0;
    }
}


if(!function_exists('checkWordBalance')) {
    function checkWordBalance() {

        return (new \App\Services\Balance\BalanceService())->noWordBalance();
    }
}


if(!function_exists('string2JSON')) {
    function string2JSON(string $contents) {

        $isDecoded   = false;
        $lastDecoded = null;


        while (!$isDecoded) {
            if(empty($lastDecoded)){
                $lastDecoded = json_decode($contents);
            }else{
                $lastDecoded = json_decode($lastDecoded);
            }

            if(!is_string($lastDecoded)){
                $isDecoded = true;
                return $lastDecoded;
            }
        }
    }
}


if (!function_exists('areActiveRoutes')) {
    # return active class
    function areActiveRoutes(array $routes, $output = "active")
    {
        $currentRoute = (string) currentRoute();

        return in_array($currentRoute, $routes) ? $output : '';
    }
}

if (!function_exists('convertToHtml')) {
    # return active class
    function convertToHtml($content, $options = []) {
        $content = preg_replace('/<input[^>]*>|<textarea[^>]*>/', '', $content);
        $content = Str::markdown($content, $options);
        $content = str_replace("<table>", "<table class='table table-border'>", $content);
        $content = str_replace("<p>", "<p class='mb-0'>", $content);

        return $content;
    }
}
if(!function_exists('addBrAfterMaxWords')){
    function addBrAfterMaxWords($text, $wordLimit = 3, $class ="" ) {

        $br = $class ? '<br class="$class">' : '<br>';
        $words = explode(' ', $text);

        // Chunk the array into groups of 20 words
        $chunks = array_chunk($words, $wordLimit);

        // Join each chunk back into a string and separate by <br>
        return implode($br, array_map(function($chunk) {
            return implode(' ', $chunk);
        }, $chunks));
    }
}

if (!function_exists('currentVersion')) {
    function currentVersion($isNumber = false)
    {
        $version = env('APP_VERSION') ? str_replace('v', '', env('APP_VERSION')) : null;
        # need to check bcz of setup route
        if (Schema::hasTable('system_settings')) {
            $settings = SystemSetting::where('entity', 'software_version')->first();
            if ($settings) {
                $version = $settings->value;
            }
        }
        if (empty($version)) {
            $version = env('APP_VERSION') ? str_replace('v', '', env('APP_VERSION')) : null;
        }

        return $isNumber ? intval(str_replace(".", "", $version)) : $version;
    }
}

if (!function_exists('getNumberFromString')) {
    function getNumberFromString($str, $replaceValue = ["."], $replaceWith = "")
    {
        return intval(str_replace($replaceValue, $replaceWith, $str));
    }
}

if (!function_exists('isGreater')) {
    function isGreater($currentVersion, $upcomingVersion, $isNumberConversion = false, $replaceValue = ["."], $replaceWith = "")
    {
        if ($isNumberConversion) {
            $currentVersion  = intval(str_replace($replaceValue, $replaceWith, $currentVersion));
            $upcomingVersion = intval(str_replace($replaceValue, $replaceWith, $upcomingVersion));
        }

        return $currentVersion < $upcomingVersion;
    }
}

if (!function_exists('isAjax')) {
    function isAjax()
    {
        return request()->ajax();
    }
}


if (!function_exists('flashMessage')) {
    function flashMessage($message, $type = 'success')
    {
         session()->flash($type, $message);
    }
}

if (!function_exists('getSeoContentOptimizerScoreColor')) {
    function getSeoContentOptimizerScoreColor($score, $type = 'bg') {
        // Determine the color based on the score
        if($score >= 75 && $score <= 100) {
            return "success"; // Green
        } else if ($score >= 51 && $score <= 74) {
            return "warning"; // Warning (Orange)
        } else if ($score >= 0 && $score <= 50) {
            return "danger"; // Red
        } else {
            return "info"; // Gray
        }
    }
}

if (!function_exists('getHelpfulContentAnalysisScoreColor')) {
    function getHelpfulContentAnalysisScoreColor($score) {
        // Determine the color based on the score
        if($score > 70 && $score <= 100) {
            return "success"; // Green
        } else if ($score >= 55 && $score <= 70) {
            return "warning"; // Warning (Orange)
        } else if ($score >= 0 && $score <= 54) {
            return "danger"; // Red
        } else {
            return "info"; // Gray
        }
    }
}


if (!function_exists('isFocusKeyword')) {
    function isFocusKeyword($value) {

        return (int)$value === \appStatic()::IS_FOCUS_KEYWORD;
    }
}

if (!function_exists('isOneTimeAffiliateEarning')) {
    function isOneTimeAffiliateEarning($value = 0): bool
    {

        return (int)$value === \appStatic()::AFFILIATE_EARNING_ONE_TIME;
    }
}

if (!function_exists('getAffiliateCommissionPolicy')) {
    function getAffiliateCommissionPolicy(): int
    {

        return (int) getSetting("enable_affiliate_continuous_commission");
    }
}

if (!function_exists('getAffiliateCommissionRate')) {
    function getAffiliateCommissionRate()
    {

        return getSetting("affiliate_commission") ?? 0;
    }
}

if (!function_exists('isDemoAllowedRoutes')) {
    function isDemoAllowedRoutes(): bool
    {
        $currentRoute = currentRoute();
        $demoRoutes   = (new \App\Services\Models\Permission\PermissionService())->demoRoutes();

        if(in_array($currentRoute, $demoRoutes)) {
            return true;
        }

        return str_ends_with($currentRoute, '.index') || str_ends_with($currentRoute, '.create');
    }
}


if (!function_exists('isDemoOn')) {
    function isDemoOn(): bool
    {
        return (int)env("DEMO_MODE") === 1;
    }
}

if (!function_exists('isColumnExists')) {
    function isColumnExists($model, $column) {

        return Schema::hasColumn($model->getTable(), $column);
    }
}

if (!function_exists("showRequiredStar")) {
    function showRequiredStar()
    {
        return "<strong class='text-danger'> * </strong>";
    }
}

if (!function_exists("getProductPrice")) {
    function getProductPrice($product)
    {

        return getProductPriceByProductAttribute($product?->attributes?->first());
    }
}

if (!function_exists("getProductPriceByProductAttribute")) {
    function getProductPriceByProductAttribute($productAttribute)
    {

        return $productAttribute?->price ?? 0;
    }
}


if (!function_exists("getProductDiscountByProductAttribute")) {
    function getProductDiscountByProductAttribute($productAttribute)
    {

        // product_attributes.discounted_price column
        return $productAttribute?->discounted_price ?? 0;
    }
}


if (!function_exists("getProductThumbnailMediaAndUrl")) {
    function getProductThumbnailMediaAndUrl(object $product)
    {
        if ($product->productThumbnail) {
            $mediaArr[] = [
                "id"         => $product?->productThumbnail?->id,
                "media_file" => $product?->productThumbnail?->media_file,
            ];

            return $mediaArr;
        }

        return [];
    }
}


if (!function_exists("getProductThumbnail")) {
    function getProductThumbnail($product)
    {
        return $product->mediaManager?->media_file ?: null;
    }
}

if (!function_exists("getProductTitle")) {
    function getProductTitle($product)
    {

        return $product->name;
    }
}

if (!function_exists("getSelectableStatuses")) {
    function getSelectableStatuses($filterByColumnName, $value)
    {
        if (!empty($filterByColumnName) && !empty($value)) {
            return Status::where($filterByColumnName, $value)
                ->get()->pluck('title', 'id');
        }else{
            return [];
        }
    }
}

if (!function_exists("isCOD")) {
    function isCOD($orderType)
    {
        return $orderType == \appStatic()::PAYMENT_METHOD_COD || $orderType == \appStatic()::COD;
    }
}

if (!function_exists("getValidatorFieldsError")) {
    function getValidatorFieldsError($validator, $isStringMsg = true)
    {
        $errors = $validator->errors();
        $messages = "";
        foreach ($errors->toArray() as $column => $errorMessages) {
            foreach ($errorMessages as $errorMessage) {
                $messages.= "$errorMessage";
            }
        }
        // TODO:: Later will update as per $isStringMsg

        return $messages;
    }
}

if (!function_exists("getStatuses")) {
    function getStatuses()
    {
        $statusCacheKey = "cache_statuses";

        if(isCacheExists($statusCacheKey)) {

            return getCache($statusCacheKey);
        }

        $statuses = Status::query()->where("is_active",1)->get();

        setCacheData($statusCacheKey, $statuses);

        return $statuses;
    }
}


if (!function_exists("getSelectedStatuses")) {
    function getSelectedStatuses()
    {
        $statusCacheKey = "cache_selected_statuses";

        if(isCacheExists($statusCacheKey)) {

            return getCache($statusCacheKey);
        }
        $statuses = Status::query()
            ->where("is_active", 1)
            ->whereIn('context', ['completed', 'pending', 'cancelled'])
            ->get();

        setCacheData($statusCacheKey, $statuses);

        return $statuses;
    }
}


if (!function_exists("getKitchenStatuses")) {
    function getKitchenStatuses()
    {
        $kitchenStatusCacheKey = "cache_kitchen_statuses";

        if(isCacheExists($kitchenStatusCacheKey)) {

            return getCache($kitchenStatusCacheKey);
        }

        $kitchenStatuses = Status::query()
            ->where("is_active",1)
            ->whereIn('id', [2,5,6,7])
            ->get();

        setCacheData($kitchenStatusCacheKey, $kitchenStatuses);

        return $kitchenStatuses;
    }
}

if (!function_exists("getOrderStatuses")) {
    function getOrderStatuses()
    {
        $orderStatusCacheKey = "cache_order_statuses";

        if(isCacheExists($orderStatusCacheKey)) {

            return getCache($orderStatusCacheKey);
        }

        $orderStatuses = Status::query()
            ->where("order_access",1)
            ->get();

        setCacheData($orderStatusCacheKey, $orderStatuses);

        return $orderStatuses;
    }
}

if (!function_exists("cacheVersion")) {
    function cacheVersion()
    {

        return 1.0;
    }
}


if (!function_exists("showingRangeText")) {
    function showingRangeText($paginateItems)
    {
        // Assuming $products is a paginated collection
        $currentPage = $paginateItems->currentPage();
        $perPage     = $paginateItems->perPage();
        $total       = $paginateItems->total();

        if ($total == 0) {
            return "Showing 0 of 0";
        }

        $from        = ($currentPage - 1) * $perPage + 1;
        $to          = min($total, $currentPage * $perPage);

        return "Showing {$from}-{$to} of {$total}";
    }
}


if (!function_exists('getPaymentStatus')) {
    function getPaymentStatus(): array
    {
        return [
            appStatic()::PAYMENT_STATUS_PAID     => 'PAID',
            appStatic()::PAYMENT_STATUS_PENDING  => 'Not Paid',

        ];
    }
}