<?php

namespace App\Providers;

use App\Services\Business\PricingService;
use App\Services\Business\WebsiteService;
use App\Services\Email\MailService;
use App\Support\Strategy\ShippingCharge\WeightBasedShippingCalculator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Modules\CartManager\Services\Action\CartActionService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Mail Facade Registering
        $this->app->singleton("mailService", function ($app) {
            return new MailService();
        });

        // Shipping Charge
        $this->app->singleton("shippingChargeFacade", function ($app) {
            return new WeightBasedShippingCalculator();
        });

        // Pricing Service
        $this->app->singleton("pricingFacade", function ($app) {
            return new PricingService();
        });

        // Register the helper function
        $this->app->bind('getFaviconSrc', function () {
            return (new WebsiteService())->getFaviconSrc();
        });

        // Cart Action SingleTon
        $this->app->singleton(CartActionService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Cart Item Registering
        view()->composer('*', function ($view) {
            $view->with('globalCartData', (new \Modules\CartManager\Services\Action\CartActionService())->getCartInfo());
        });

        // Paginator
        Paginator::useBootstrapFive();
    }
}
