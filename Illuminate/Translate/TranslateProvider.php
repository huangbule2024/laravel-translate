<?php

namespace App\Illuminate\Translate;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TranslateProvider extends ServiceProvider implements DeferrableProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/./config/translate.php', 'translate');

        $this->app->singleton('translate', function ($app) {
            return new TranslateManage($app);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['translate'];
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/./config/translate.php' => config_path('translate.php'),
            ], 'translate');

        }
    }

}
