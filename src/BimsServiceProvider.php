<?php

namespace Teqbylyte\BimsConnect;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\SocialiteServiceProvider;

class BimsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(SocialiteServiceProvider::class);
    }

    public function boot(): void
    {
        Socialite::extend('bims', function () {
            return new BimsProvider(
                $this->app['request'],
                $this->app['config']->get('services.bims.client_id'),
                $this->app['config']->get('services.bims.client_token'),
                $this->app['config']->get('services.bims.redirect')
            );
        });
    }
}