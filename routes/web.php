
<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Controllers\Admin\SummerNoteController;
use App\Http\Controllers\Frontend\AboutUsController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Frontend\ContactUsController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Frontend\SubscribersController;
use App\Http\Controllers\Payments\Duitku\DuitkuController;
use App\Http\Controllers\Payments\IyZico\IyZicoController;
use App\Http\Controllers\Payments\Paypal\PaypalController;
use App\Http\Controllers\Admin\Currency\CurrencyController;
use App\Http\Controllers\Admin\Language\LanguageController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Payments\Midtrans\MidtransController;
use App\Http\Controllers\Payments\Paystack\PaystackController;
use App\Http\Controllers\Payments\Razorpay\RazorpayController;
use App\Http\Controllers\Payments\Paytm\PaytmPaymentController;
use App\Http\Controllers\Payments\Molile\MolilePaymentController;
use App\Http\Controllers\Payments\Stripe\StripePaymentController;
use App\Http\Controllers\Payments\Flutterwave\FlutterwaveController;
use App\Http\Controllers\Payments\Yookassa\YookassaPaymentController;
use App\Http\Controllers\Admin\Subscription\SubscriptionPlanController;
use App\Http\Controllers\Payments\Mercadopago\MercadopagoPaymentController;
use App\Http\Controllers\Admin\Subscription\SubscriptionPlanTemplateController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Admin\Permission\PermissionController;

Route::get("read", [PermissionController::class, "storeRoutes"]);

/* Invoice Print */
Route::get('/print-invoice/{id}', [HomeController::class, 'printInvoice'])->name('print.invoice');

Auth::routes();

Route::controller(LoginController::class)->group(function () {
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/social-login/redirect/{provider}', 'redirectToProvider')->name('social.login');
    Route::get('/social-login/{provider}/callback', 'handleProviderCallback')->name('social.callback');
});

Route::controller(VerificationController::class)->group(function () {
    Route::get('/verify-phone', 'verifyPhone')->name('verification.phone');
    Route::get('/email/resend', 'resend')->name('verification.resend');
    Route::get('/verification-confirmation/{code}', 'verification_confirmation')->name('email.verification.confirmation');
    Route::post('/verification-confirmation', 'phone_verification_confirmation')->name('phone.verification.confirmation');
});

Route::controller(ForgotPasswordController::class)->group(function () {
    # forgot password
    Route::get('/reset-password-by-phone', 'resetByPhone')->name('forgotPw.resetByPhone');
    Route::post('/reset-password-by-phone', 'updatePw')->name('forgotPw.update');
});

Route::get('/home', [DashboardController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('permission');
Route::get('/listing', [DashboardController::class, 'listing'])->name('list');

Route::get("quick-view/product/{product_id}", [FrontendController::class, 'quickViewProductDetails'])->name('quick_view_product.show');

Route::group(['prefix' => 'backend'], function () {
    # change settings
    Route::post('/change-currency', [CurrencyController::class, 'changeCurrency'])->name('backend.changeCurrency');
    Route::post('/change-language', [LanguageController::class, 'changeLanguage'])->name('backend.changeLanguage');
});

# subscription packages
Route::post('/subscribe-to-package', [SubscriptionsController::class, 'subscribe'])->name('website.subscriptions.subscribe');
Route::get('/subscribe-to-package', [SubscriptionsController::class, 'index'])->name('website.subscriptions.index');

# Admin Users
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.staffs.index');
});

Route::post('file-upload', [SummerNoteController::class, 'summernoteFileUpload'])->name('file-upload');
Route::get('test', [TestController::class, 'index'])->name('test');


# payment gateways
Route::group(['prefix' => ''], function () {
    # paypal
    Route::post('/paypal/success', [PaypalController::class, 'success'])->name('paypal.success');
    Route::get('/paypal/cancel', [PaypalController::class, 'cancel'])->name('paypal.cancel');
    Route::post('/paypal/create-paypal-order', [PaypalController::class, 'createOrder'])->name('create.payPal.order');
    Route::post('/paypal/capture-paypal-order', [PaypalController::class, 'capturePayPalOrder'])->name('capture.payPal.order');
    # stripe
    Route::any('/stripe/create-session', [StripePaymentController::class, 'checkoutSession'])->name('stripe.checkoutSession');
    Route::get('/stripe/success', [StripePaymentController::class, 'success'])->name('stripe.success');
    Route::get('/stripe/cancel', [StripePaymentController::class, 'cancel'])->name('stripe.cancel');

    # paytm
    Route::any('/paytm/callback', [PaytmPaymentController::class, 'callback'])->name('paytm.callback');

    # razorpay
    Route::post('razorpay/payment', [RazorpayController::class, 'payment'])->name('razorpay.payment');

    # iyzico
    Route::any('/iyzico/payment/callback', [IyZicoController::class, 'callback'])->name('iyzico.callback');

    # paystack
    Route::any('/paystack/payment/callback', [PaystackController::class, 'callback'])->name('paystack.callback');

    # flutterwave
    Route::any('/flutterwave/payment/callback', [FlutterwaveController::class, 'callback'])->name('flutterwave.callback');

    # duitku
    Route::any('/duitku/payment/callback', [DuitkuController::class, 'paymentCallback'])->name('duitku.callback');
    Route::any('/duitku/payment/submit', [DuitkuController::class, 'pay'])->name('duitku.pay');
    Route::any('/duitku/payment/return', [DuitkuController::class, 'myReturnCallback'])->name('duitku.return');

    # yookassa
    Route::get('/youkassa/finish', [YookassaPaymentController::class, 'finish'])->name('youkassa.finish');

    # molile
    Route::get('/molile/redirect', [MolilePaymentController::class, 'redirect'])->name('molile.redirect');

    # mercadopago
    Route::get('/mercadopago/redirect', [MercadopagoPaymentController::class, 'redirect'])->name('mercadopago.redirect');
    Route::get('/mercadopago/failed', [MercadopagoPaymentController::class, 'failed'])->name('mercadopago.failed');

    # midtrans
    Route::get('/midtrans/payment/callback', [MidtransController::class, 'callback'])->name('midtrans.callback');
    Route::get('/midtrans/payment/finish', [MidtransController::class, 'success'])->name('midtrans.success');
    Route::get('/midtrans/payment/unfinish', [MidtransController::class, 'failed'])->name('midtrans.failed');
    Route::get('/midtrans/payment/error', [MidtransController::class, 'failed'])->name('midtrans.error');
    Route::post('/midtrans/payment/payment-notification', [MidtransController::class, 'paymentNotification'])->name('midtrans.payment-notification');
    Route::post('/midtrans/payment/pay-account-notification', [MidtransController::class, 'payAccountNotification'])->name('midtrans.pay-account-notification');
    Route::post('/midtrans/payment/recurring-notification', [MidtransController::class, 'recurringNotification'])->name('midtrans.recurring-notification');

});

Route::group(['middleware'=>'isAllowFrontend'], function(){
    Route::get("/", [DashboardController::class, "index"])->name("layouts");
    // Route::get("/", [HomeController::class, "index"])->name("layouts");
    Route::get("/teststream", [TestController::class, "testStream"])->name("testStream");
    Route::get("/gemini/teststream", [TestController::class, "geminiTestStream"])->name("geminiTestStream");
    Route::get("/templates", [HomeController::class, "templates"])->name("templates");
    Route::get("/plans", [HomeController::class, "plans"])->name("plans");
    Route::get("/blogs", [HomeController::class, "blogs"])->name("blogs");
    Route::get("/blogs/{slug}", [HomeController::class, "blog"])->name("blog");
    Route::get('/get-package-templates', [SubscriptionPlanTemplateController::class, 'getPackageTemplates'])->name('subscriptions.getPackageTemplates');
    Route::get('about-us', [AboutUsController::class, 'index'])->name('about-us');
    Route::get('privacy-policy', [FrontendController::class, 'privacyPolicy'])->name('privacy-policy');
    Route::get('terms-conditions', [FrontendController::class, 'termsConditions'])->name('terms-conditions');
    Route::get('contact-us', [ContactUsController::class, 'index'])->name('contact-us');
    Route::get('pricing', [FrontendController::class, 'pricing'])->name('pricing');
    Route::post('contact-us', [ContactUsController::class, 'store'])->name('contact-us.store');
    Route::post('subscribe-frontend', [SubscribersController::class, 'store'])->name('subscribe.store');
    Route::get('pages/{slug}', [FrontendController::class, 'page'])->name('pages');
});
