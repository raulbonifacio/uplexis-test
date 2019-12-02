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
