<?php

namespace App\Providers;

use App\Billing\BankPaymentGateway;
use App\Billing\CreditPaymentGateway;
use App\Billing\PaymentGatewayContract;
use App\Channel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // create new object every time class BankPaymentGateway invoked
//        $this->app->bind(BankPaymentGateway::class, function ($app) {
//            return new BankPaymentGateway('usd');
//        });

        // create and use only object every time class BankPaymentGateway invoked
//        $this->app->singleton(BankPaymentGateway::class, function ($app) {
//            return new BankPaymentGateway('usd');
//        });

        // create singleton of BankPaymentGateway (or CreditPaymentGateway)
        // every time interface PaymentGatewayContract invoked
        $this->app->singleton(PaymentGatewayContract::class, function ($app) {
            if (request('gateway') == 'credit')
            {
                return new CreditPaymentGateway('usd');
            }

            return new BankPaymentGateway('usd');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Option 1 - Every single view
        // View::share('channels', Channel::orderBy('name')->get());

        // Option 2 - Granular views with wildcards
        $views = [
            'channel.*',
            'post.create'
        ];

        View::composer($views, function ($view) {
            $view->with('channels', Channel::orderBy('name')->get());
        });
    }
}
