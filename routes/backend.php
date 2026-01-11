<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\FAQ\FAQController;
use App\Http\Controllers\Admin\Role\RoleController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Customer\BalanceController;
use App\Http\Controllers\Admin\CronJobListController;
use App\Http\Controllers\Admin\Query\QueryController;
use App\Http\Controllers\Admin\StatusUpdateController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Customer\TeamMemberController;
use App\Http\Controllers\Admin\Report\ReportsController;
use App\Http\Controllers\Admin\Support\TicketController;
use App\Http\Controllers\Customer\PlanHistoryController;;
use App\Http\Controllers\Admin\TermsConditionsController;
use App\Http\Controllers\Admin\Utility\UtilityController;
use App\Http\Controllers\Admin\Support\CategoryController;
use App\Http\Controllers\Admin\Support\PriorityController;
use App\Http\Controllers\Admin\User\UserProfileController;
use App\Http\Controllers\Admin\Currency\CurrencyController;
use App\Http\Controllers\Admin\Customer\CustomerController;
use App\Http\Controllers\Admin\Language\LanguageController;
use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Http\Controllers\Admin\Appearance\AboutUsController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Support\TicketReplyController;
use App\Http\Controllers\Admin\Appearance\ContactUsController;
use App\Http\Controllers\Admin\Settings\PWASettingsController;
use App\Http\Controllers\Admin\Appearance\AppearanceController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\Balance\BalanceUpdateController;
use App\Http\Controllers\Admin\Permission\PermissionController;
use App\Http\Controllers\Admin\MediaManager\UppyMediaController;
use App\Http\Controllers\Admin\NewsLetter\NewslettersController;
use App\Http\Controllers\Admin\Subscriber\SubscribersController;
use App\Http\Controllers\Admin\MediaManager\MediaManagerController;
use App\Http\Controllers\Admin\EmailTemplate\EmailTemplateController;
use App\Http\Controllers\Admin\ClientFeedback\ClientFeedbackController;
use App\Http\Controllers\Admin\Language\LanguageLocalizationController;
use App\Http\Controllers\Admin\PaymentGateway\PaymentGatewayController;
use App\Http\Controllers\Admin\PaymentRequest\PaymentRequestController;
use App\Http\Controllers\Admin\Settings\OfflinePaymentMethodController;
use App\Http\Controllers\Admin\Subscription\SubscriptionPlanController;
use App\Http\Controllers\Admin\Subscription\SubscriptionSettingsController;
use App\Http\Controllers\Admin\Subscription\SubscriptionPlanTemplateController;
use App\Http\Controllers\Admin\Official\WriteRapController;
use App\Http\Controllers\Admin\Update\UpdateController;
use App\Http\Controllers\Admin\FilePermissionController;
use App\Http\Controllers\Admin\ItemCategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\Merchant\MerchantController;
use App\Http\Controllers\Admin\Seo\SeoCheckerController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\MenuItemsController;
use App\Http\Controllers\QrCodeController;

Route::get('/offline', function () {
    return view('vendor.laravelpwa.offline');
});

Auth::routes();

Route::get('/listing', [DashboardController::class, 'listing'])->name('list');

Route::middleware(["auth","demo.permission"])->prefix("stripe")->name("stripe.")->group(function () {
    Route::get("/checkout/plan/{stripe_plan}", [CheckoutController::class, "checkoutPlan"])->name("checkout");
    Route::get("success", [CheckoutController::class, "success"])->name("success");
    Route::get("cancel", [CheckoutController::class, "cancel"])->name("cancel");
});

/* Common Routes between Admin & Vendor Start */

Route::middleware(["auth"])->name("admin.")->prefix("admin")->group(function () {

    Route::prefix("user-role-management")->group(function () {
        Route::resource("permissions", PermissionController::class);
        Route::resource("roles", RoleController::class);
        Route::post("active-status-update/{id}", [StatusUpdateController::class, "updateActiveStatus"])->name("roles.statusUpdate");
        Route::resource("users", UserController::class);
        Route::post("users/active-status-update/{id}", [StatusUpdateController::class, "updateActiveStatus"])->name("users.statusUpdate");
    });

    Route::post("update/active-status", [StatusUpdateController::class, "updateActiveStatus"])->name("status.update");

    Route::get('profile', [UserProfileController::class, 'index'])->name('profile');
    Route::post('profile-info-update', [UserProfileController::class, 'infoUpdate'])->name('info-update');
    Route::post('profile-change-password', [UserProfileController::class, 'changePassword'])->name('change-password');

    Route::prefix("users")->name("users.")->group(function () {
        Route::post("balance-update", [BalanceUpdateController::class, "updateBalance"])->name("updateBalance");
    });

    /**
     * Media manager
     */
    Route::resource("media-managers", MediaManagerController::class);


    Route::get('/media-manager/get-files', [UppyMediaController::class, 'index'])->name('uppy.index');
    Route::get('/media-manager/get-selected-files', [UppyMediaController::class, 'selectedFiles'])->name('uppy.selectedFiles');
    Route::post('/media-manager/add-files', [UppyMediaController::class, 'store'])->name('uppy.store');
    Route::get('/media-manager/delete-files/{id}', [UppyMediaController::class, 'delete'])->name('uppy.delete');


    // Ticket Start
    Route::resource('support-tickets', TicketController::class);
    Route::resource('support-replies', TicketReplyController::class);
    Route::get('support-tickets/reply/{id}',[ TicketController::class, 'reply'])->name('support-tickets.reply');
    // Ticket End


    Route::get('plan-histories', [PlanHistoryController::class, 'index'])->name('plan-histories.index');
    Route::get('plan-histories/{id}', [PlanHistoryController::class, 'show'])->name('plan-histories.show');
    Route::get('plan-invoice/{id}', [PlanHistoryController::class, 'invoice'])->name('plan-invoice.index');
    Route::get('plan-download/{id}', [PlanHistoryController::class, 'download'])->name('plan-invoice.download');
});

/* Common Routes between Admin & Vendor End */


# Admin Users
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'verified', 'permission',"demo.middleware"]], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware("permission");

    //------------------------------------------------------
    // Merchant Management ../ Vendor Management
    //------------------------------------------------------
    Route::resource("merchants", MerchantController::class);
    Route::get('merchants-export', [MerchantController::class, 'exports'])->name('merchants.export');
    Route::post("merchants/active-status-update/{id}", [StatusUpdateController::class, "updateActiveStatus"])->name("merchants.statusUpdate");


    // Route::get("documents", [ProjectController::class, 'index'])->name('documents.index');

    Route::resource("settings", SettingsController::class);
    Route::get("settings-credentials", [SettingsController::class, 'credentials'])->name('settings.credentials');

    Route::resource('languages', LanguageController::class);
    Route::resource('localizations', LanguageLocalizationController::class)->only(['show', 'store']);
    Route::resource('currencies', CurrencyController::class);
    Route::post("currencies/active-status-update/{id}", [StatusUpdateController::class, "updateActiveStatus"])->name("currencies.statusUpdate");


    Route::post("pages/active-status-update/{id}", [StatusUpdateController::class, "updateActiveStatus"])->name("pages.statusUpdate");

    Route::resource('faqs', FAQController::class);
    Route::post("faqs/active-status-update/{id}", [StatusUpdateController::class, "updateActiveStatus"])->name("faqs.statusUpdate");

    // support ticket
    Route::resource('support-categories', CategoryController::class);
    Route::post("support-categories/active-status-update/{id}", [StatusUpdateController::class, "updateActiveStatus"])->name("support-categories.statusUpdate");

    Route::resource('support-priorities', PriorityController::class);
    Route::post("support-priorities/active-status-update/{id}", [StatusUpdateController::class, "updateActiveStatus"])->name("support-priorities.statusUpdate");

    // subscriptions
    Route::resource('subscription-plans', SubscriptionPlanController::class);
    Route::post("subscription-plans/active-status-update/{id}", [StatusUpdateController::class, "updateActiveStatus"])->name("subscription-plans.statusUpdate");
    Route::post('subscription-plans/package-update', [SubscriptionPlanController::class, 'updatePlan'])->name('subscription-plans.package-update');
    Route::get('subscription-plans/get-price/{id}', [SubscriptionPlanController::class, 'getPrice'])->name('subscription-plans.get-price');
    Route::post('/update-package-templates', [SubscriptionPlanTemplateController::class, 'updateTemplates'])->name('subscriptions.updateTemplates');

    // customer
    Route::resource('customers', CustomerController::class);
    Route::get('customers-export', [CustomerController::class, 'exports'])->name('customers.export');



    Route::resource("settings", SettingsController::class);
    Route::get("settings-credentials", [SettingsController::class, 'credentials'])->name('settings.credentials');

    Route::resource('payment-gateways', PaymentGatewayController::class);

    # reports
    Route::group(['prefix' => 'reports'], function () {
        Route::get('/subscriptions', [ReportsController::class, 'subscriptionReports'])->name('reports.subscriptions');
    });

    Route::get('appearance', [AppearanceController::class, 'index'])->name('appearance.index');
    Route::post('appearance/update', [AppearanceController::class, 'update'])->name('appearance.update');
    Route::resource('client-feedbacks', ClientFeedbackController::class);

    Route::get('subscription-settings', [SubscriptionSettingsController::class, 'index'])->name('subscription-settings.index');
    Route::post('subscription-settings/gateway-product/store', [SubscriptionSettingsController::class, 'storeGatewayProduct'])->name('subscription-settings.store.gateway.product');


    Route::resource('offline-payment-methods', OfflinePaymentMethodController::class);
    Route::post("offline-payment-methods/active-status-update/{id}", [StatusUpdateController::class, "updateActiveStatus"])->name("offline-payment-methods.statusUpdate");

    Route::get('email-templates', [EmailTemplateController::class, 'index'])->name('email-templates.index');
    Route::post('email-templates/update/{id}', [EmailTemplateController::class, 'update'])->name('email-templates.update');

    Route::get('utilities', [UtilityController::class, 'index'])->name('utilities');
    Route::get('clear-cache', [UtilityController::class, 'clearCache'])->name('clear-cache');
    Route::get('clear-log', [UtilityController::class, 'clearLog'])->name('clearLog');
    Route::get('debug', [UtilityController::class, 'debug'])->name('debug');

    Route::get('cron-list', [CronJobListController::class, 'index'])->name('cron-list');

    Route::resource('team-members', TeamMemberController::class);
    # bulk-emails

    Route::resource('subscribers',SubscribersController::class)->only(['index', 'destroy']);

    Route::get('about-us', [AboutUsController::class, 'index'])->name('about-us.index');
    Route::get('contact-us', [ContactUsController::class, 'index'])->name('contact-us.index');
    Route::post('contact-us', [ContactUsController::class, 'store'])->name('contact-us.store');
    Route::get('contact-queries', [QueryController::class, 'index'])->name('queries.index');
    Route::get('/mark-as-read/{id}', [QueryController::class, 'read'])->name('queries.markRead');
    Route::delete('/delete-queries/{id}/{force?}', [QueryController::class, 'destroy'])->name('queries.delete');
    Route::get('/delete-all-queries', [QueryController::class, 'deleteAll'])->name('queries.deleteAll');
    Route::get('privacy-policy',[PrivacyPolicyController::class, 'index'])->name('privacy-policy.index');
    Route::get('terms-conditions',[TermsConditionsController::class, 'index'])->name('terms-conditions.index');
    Route::get('pwa-settings', [PWASettingsController::class, 'index'])->name('pwa-settings.index');
    Route::post('pwa-settings', [PWASettingsController::class, 'store'])->name('pwa-settings.store');
    Route::get('balance-render', [BalanceController::class, 'index'])->name('balance-render');
    Route::group(['prefix'=>'payment-requests', 'as'=> 'payment-requests.'], function($route){
        $route->get('/', [PaymentRequestController::class, 'index'])->name('index');
        $route->post('/approve', [PaymentRequestController::class, 'approve'])->name('approve');
        $route->post('/feedback', [PaymentRequestController::class, 'feedback'])->name('feedback');
        $route->post('/reject', [PaymentRequestController::class, 'reject'])->name('reject');
        $route->post('/reSubmit', [PaymentRequestController::class, 'reSubmit'])->name('reSubmit');
    });

    /**
     * Health, License, Update
     * */

    Route::prefix("application")->name("systemUpdate.")->group(function () {
        Route::get("/health-check", [WriteRapController::class, "healthCheck"])->name("health-check");
        Route::get("update", [UpdateController::class, "update"])->name("update");
        Route::get("file-permission", [FilePermissionController::class, "filePermission"])->name("file-permission");
        Route::get('one-click-update', [UpdateController::class, 'oneClickUpdate'])->name('oneClickUpdate');
        Route::post('manual-update-system', [UpdateController::class, 'versionUpdateInstall'])->name('update-version');
    });
});
