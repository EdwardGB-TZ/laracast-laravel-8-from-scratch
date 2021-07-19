<?php

namespace App\Providers;

use App\Services\NewsLetter;
use MailchimpMarketing\ApiClient;
use Illuminate\Pagination\Paginator;
use App\Services\MailChimpNewsletter;
use Illuminate\Database\Eloquent\Model;
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
        app()->bind(
            NewsLetter::class, function () {
                $client = (new ApiClient())->setConfig(
                    [  
                        'apiKey' => config('services.mailchimp.key'),
                        'server' => 'us6'
                    ]
                );

                return new MailChimpNewsletter($client);
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::unguard();
    }
}
