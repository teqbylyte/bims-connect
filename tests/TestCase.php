<?php

namespace Teqbylyte\BimsConnect\Tests;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\SocialiteServiceProvider;
use Orchestra\Testbench\Concerns\CreatesApplication;
use Teqbylyte\BimsConnect\BimsServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function getPackageProviders($app): array
    {
        return [
            BimsServiceProvider::class
        ];
    }
}
