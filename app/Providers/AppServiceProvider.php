<?php

namespace App\Providers;

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
        //Register the default article gateway
        $this->app->bind(
            'App\Http\Gateways\Contracts\ArticleGateway',
            'App\Http\Gateways\UpLexisArticleGateway');

        $this->app->singleton('\GuzzlleHttp\Client', function() { 
            return new  \GuzzleHttp\Client();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
