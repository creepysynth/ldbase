<?php

namespace App\Providers;

use App\Billing\BankPaymentGateway;
use App\Billing\CreditPaymentGateway;
use App\Billing\PaymentGatewayContract;
use App\Channel;
use App\Http\View\Composers\ChannelComposer;
use App\Mixins\StrMixins;
use App\PostcardSendingService;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Service Container. Lesson 1.
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
        // View composers. Lesson 2.
        // Option 1 - Every single view
//        View::share('channels', Channel::orderBy('name')->get());

        // Option 2 - Granular views (with wildcards)
//        $views = [
//            'channel.*',
//            'post.create'
//        ];
//
//        View::composer($views, function ($view) {
//            $view->with('channels', Channel::orderBy('name')->get());
//        });

        // Option 3 - Dedicated class (with wildcards)
        $views = [
            'channel.*',
            'post.create'
        ];

        View::composer($views, ChannelComposer::class);


        // Facades. Lesson 4.
        $this->app->singleton('PostcardSendingService', function($app) {
            return new \App\PostcardSendingService('us', 4, 6);
        });


        // Macros. Lesson 5.
        // Option 1. Macro
//        Str::macro('partNumber', function ($part) {
//            return 'AB-' . substr($part, 0, 3) . '-' . substr($part, 3);
//        });

        ResponseFactory::macro('errorJson', function ($message = 'Default error message') {
            return [
                'message' => $message,
                'error_code' => 333
            ];
        });

        // Option 2. Mixins
        Str::mixin(new StrMixins());
    }
}
